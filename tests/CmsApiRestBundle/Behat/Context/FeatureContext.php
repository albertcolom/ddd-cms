<?php

namespace Tests\CmsApiRestBundle\Behat\Context;

use Behat\Behat\Context\Context;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\HttpFoundation\Response;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends WebTestCase implements Context
{
    const HTTP_HOST = 'localhost';

    /** @var Client */
    private $client;

    /** @var  Response */
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

    protected function request(string $method, string $uri, array $options = [])
    {
        $this->client->request($method, $uri);
        $this->response = $this->client->getResponse();
    }

    /**
     * @When /^I send a "([^"]*)" request to "([^"]*)"$/
     */
    public function iSendARequestTo($method, $uri)
    {
        $this->request($method, $uri);
    }

    /**
     * @Given /^the response code is "([^"]*)"$/
     */
    public function theResponseCodeIs($code)
    {
        $this->assertEquals($code, $this->response->getStatusCode());
    }

    /**
     * @Given /^the response message is '([^']+)'$/
     */
    public function theResponseMessageIs($message)
    {
        $response = json_decode($this->response->getContent(), true);
        $this->assertEquals($message, $response['message']);
    }
}
