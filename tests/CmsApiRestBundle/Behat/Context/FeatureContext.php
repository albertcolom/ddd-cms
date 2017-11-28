<?php

namespace Tests\CmsApiRestBundle\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Coduo\PHPMatcher\Factory\SimpleFactory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Nelmio\Alice\Loader\NativeLoader;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends WebTestCase implements Context
{
    const HTTP_HOST = 'localhost';

    /** @var Client */
    private $client;

    /** @var Response */
    protected $response;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        parent::__construct();
        $_SERVER['KERNEL_DIR'] = __DIR__ . '/../../../../app/';
        $this->client = self::createClient([], ['HTTP_HOST' => self::HTTP_HOST]);
    }

    protected function setUpDatabase()
    {
        $entityManager = $this->getEntityManager();
        $schemaTool = new SchemaTool($entityManager);
        $schemaTool->dropDatabase();
        $classes = $entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool->createSchema($classes);
    }

    protected function loadDoctrineFixtures(array $files)
    {
        $loader = new NativeLoader();
        $objectSet = $loader->loadFiles($files);
        $entityManager = $this->getEntityManager();

        foreach ($objectSet->getObjects() as $object) {
            $entityManager->persist($object);
            $entityManager->flush();
        }
    }

    protected function getEntityManager(): EntityManager
    {
        /** @var ContainerInterface $container */
        $container = $this->getContainer();

        /** @var ManagerRegistry $registry */
        $registry = $container->get('doctrine');

        /** @var EntityManager $entityManager */
        $entityManager = $registry->getManager();

        return $entityManager;
    }

    protected function getRabbitMqProducer()
    {
        /** @var ContainerInterface $container */
        $container = $this->getContainer();

        return $container->get('old_sound_rabbit_mq.events_producer');
    }

    protected function getQueuedMessages($producerName)
    {
        $producer = $this->getRabbitMqProducer();
        $channel = $producer->getChannel();

        $queuedMessages = [];
        do {
            /** @var AMQPMessage $message */
            $message = $channel->basic_get($producerName);
            if (!$message instanceof AMQPMessage) {
                break;
            }

            $queuedMessages[] = json_decode($message->getBody(), true);

            if ($message->get('message_count') == 0) {
                break;
            }
        } while (true);

        return $queuedMessages;
    }

    protected function request(string $method, string $uri, array $parameters = [])
    {
        $this->client->request($method, $uri, $parameters);
        $this->response = $this->client->getResponse();
    }

    /**
     * @When /^I send a "([^"]*)" request on "([^"]*)"$/
     * @param string $method
     * @param string $uri
     */
    public function iSendARequestOn(string $method, string $uri)
    {
        $this->request($method, $uri);
    }

    /**
     * @When /^I send a "([^"]*)" request on "([^"]*)" with params '([^']*)'$/
     * @param string $method
     * @param string $uri
     * @param string $params
     */
    public function iSendARequestOnWithParams(string $method, string $uri, string $params)
    {
        $this->request($method, $uri.'?'.$params);
    }


    /**
     * @When /^I send a "([^"]*)" on "([^"]*)" with:$/
     * @param string $method
     * @param string $uri
     * @param PyStringNode $string
     */
    public function iSendAOnWith(string $method, string $uri, PyStringNode $string)
    {
        $this->request($method, $uri, json_decode($string->getRaw(), true));
    }

    /**
     * @Given /^the response code is "([^"]*)"$/
     * @param int $code
     */
    public function theResponseCodeIs(int $code)
    {
        $this->assertEquals($code, $this->response->getStatusCode());
    }

    /**
     * @Then /^the response status code should be "([^"]*)"$/
     * @param int $code
     */
    public function theResponseStatusCodeShouldBe(int $code)
    {
        $this->assertEquals($code, $this->response->getStatusCode());
    }

    /**
     * @Given /^the response message is '([^']*)'$/
     * @param string $message
     */
    public function theResponseMessageIs(string $message)
    {
        $response = json_decode($this->response->getContent(), true);
        $this->assertEquals($message, $response['message']);
    }

    /**
     * @Given /^the JSON response should match:$/
     * @param PyStringNode $string
     */
    public function theJSONResponseShouldMatch(PyStringNode $string)
    {
        $matcher = (new SimpleFactory())->createMatcher();
        $this->assertTrue(
            $matcher->match($this->response->getContent(), $string->getRaw()),
            'Response match error'
        );
    }

    /**
     * @Given /^the queue associated to "([^"]*)" producer is empty$/
     * @param string $producerName
     */
    public function theQueueAssociatedToProducerIsEmpty(string $producerName)
    {
        $producer = $this->getRabbitMqProducer();
        $channel = $producer->getChannel();

        $channel->queue_declare($producerName, false, true, false, false);
        $channel->queue_purge($producerName);

        $this->assertEmpty($channel->basic_get($producerName));
    }

    /**
     * @Given /^the queue associated to "([^"]*)" producer has messages should match:$/
     * @param string $producerName
     * @param PyStringNode $expectedMessages
     */
    public function theQueueAssociatedToProducerHasMessagesShouldMatch(
        string $producerName,
        PyStringNode $expectedMessages
    ) {
        $messages = $this->getQueuedMessages($producerName);

        $matcher = (new SimpleFactory())->createMatcher();
        $this->assertTrue(
            $matcher->match(json_encode($messages), $expectedMessages->getRaw()),
            'Response match error'
        );
    }
}
