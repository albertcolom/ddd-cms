<?php

namespace CmsApiRestBundle\Controller\User;

use CmsBundle\Application\Page\CommandHandler\FindPagesByUserId\FindPagesByUserIdCommand;
use CmsBundle\Application\Page\CommandHandler\FindPagesByUserId\FindPagesByUserIdCommandHandler;
use CmsBundle\Application\User\CommandHandler\GetUser\GetUserCommand;
use CmsBundle\Application\User\CommandHandler\GetUser\GetUserCommandHandler;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
     *  description="Get user pages",
     * )
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
