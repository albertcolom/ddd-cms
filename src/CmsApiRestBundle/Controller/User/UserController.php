<?php

namespace CmsApiRestBundle\Controller\User;

use CmsBundle\Application\Page\CommandHandler\FindPagesByUserId\FindPagesByUserIdCommand;
use CmsBundle\Application\Page\CommandHandler\FindPagesByUserId\FindPagesByUserIdCommandHandler;
use CmsBundle\Application\User\CommandHandler\CreateUser\CreateUserCommand;
use CmsBundle\Application\User\CommandHandler\CreateUser\CreateUserCommandHandler;
use CmsBundle\Application\User\CommandHandler\GetUser\GetUserCommand;
use CmsBundle\Application\User\CommandHandler\GetUser\GetUserCommandHandler;
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
    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Get user",
     * )
     *
     * @View(statusCode=200, serializerGroups={"Default"})
     *
     * @param string $id
     * @return \CmsBundle\Application\User\CommandHandler\GetUser\GetUserCommandResult
     */
    public function getAction(string $id)
    {
        /** @var GetUserCommandHandler $getUserCommandHandler */
        $getUserCommandHandler = $this->get('cms.application.user.get_user.get_user_command_handler');

        return $getUserCommandHandler->handle(GetUserCommand::instance($id));
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
     * @return \CmsBundle\Application\User\CommandHandler\CreateUser\CreateUserCommandResult
     */
    public function postAction(Request $request)
    {
        /** @var CreateUserCommandHandler $createUserCommandHandler */
        $createUserCommandHandler = $this->get('cms.application.user.create_user.create_user_command_handler');

        $command = CreateUserCommand::instance(
            $request->request->get('name'),
            $request->request->get('email')
        );

        return $createUserCommandHandler->handle($command);
    }


    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Get user pages",
     * )
     *
     * @View(statusCode=200, serializerGroups={"Default"})
     *
     * @param string $id
     * @return \CmsBundle\Application\Page\CommandHandler\GetPage\GetPageCommandResult
     */
    public function getPagesAction(string $id)
    {
        /** @var FindPagesByUserIdCommandHandler $findPagesByuserIdCommandHandler */
        $findPagesByUserIdCommandHandler = $this->get('cms.application.page.find_pages_by_user_id.find_pages_by_user_id_command_handler');

        return $findPagesByUserIdCommandHandler->handle(FindPagesByUserIdCommand::instance($id));
    }
}
