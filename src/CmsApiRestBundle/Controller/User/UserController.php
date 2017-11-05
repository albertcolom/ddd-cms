<?php

namespace CmsApiRestBundle\Controller\User;

use CmsBundle\Cms\Application\Model\User\CommandHandler\CreateUser\CreateUserCommand;
use CmsBundle\Cms\Application\Model\User\CommandHandler\GetUser\GetUserCommand;
use CmsBundle\Cms\Infrastructure\Services\Bus\CommandBus;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package CmsApiRestBundle\Controller\Page
 *
 * @RouteResource("user", pluralize=false)
 */
class UserController extends Controller
{
    /** @var CommandBus  */
    private $commandBus;

    /**
     * UserController constructor.
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Get user",
     * )
     *
     * @View(statusCode=200, serializerGroups={"Default"})
     *
     * @param string $id
     * @return \CmsBundle\Cms\Application\Model\User\CommandHandler\GetUser\GetUserCommandResult
     */
    public function getAction(string $id)
    {
        return $this->commandBus->handle(GetUserCommand::instance($id));
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Create user",
     * )
     *
     * @RequestParam(name="name", allowBlank=false, description="The user name")
     * @RequestParam(name="email", allowBlank=false, description="The user email")
     *
     * @View(statusCode=202, serializerGroups={"Default"})
     *
     * @param Request $request
     *
     * @return \CmsBundle\Cms\Application\Model\User\CommandHandler\CreateUser\CreateUserCommandResult
     */
    public function postAction(Request $request)
    {
        $command = CreateUserCommand::instance(
            $request->request->get('name'),
            $request->request->get('email')
        );

        return $this->commandBus->handle($command);
    }
}
