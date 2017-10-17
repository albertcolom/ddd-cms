<?php

namespace CmsApiRestBundle\Controller\Page;

use CmsBundle\Application\Page\CommandHandler\GetPage\GetPageCommand;
use CmsBundle\Application\Page\CommandHandler\GetPage\GetPageCommandHandler;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class PageController
 * @package CmsApiRestBundle\Controller\Page
 *
 * @RouteResource("page", pluralize=false)
 */
class PageController extends Controller
{
    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Get a page",
     * )
     *
     * @param string $id
     * @return \CmsBundle\Application\Page\CommandHandler\GetPage\GetPageCommandResult
     */
    public function getAction(string $id)
    {
        /** @var GetPageCommandHandler $getPageCommandHandler */
        $getPageCommandHandler = $this->get('cms.application.page.get_page.get_page_command_handler');

        return $getPageCommandHandler->handle(GetPageCommand::instance($id));
    }
}