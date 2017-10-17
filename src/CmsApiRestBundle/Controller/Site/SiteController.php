<?php

namespace CmsApiRestBundle\Controller\Site;

use CmsBundle\Application\Page\CommandHandler\FindPagesBySiteId\FindPagesBySiteIdCommand;
use CmsBundle\Application\Page\CommandHandler\FindPagesBySiteId\FindPagesBySiteIdCommandHandler;
use CmsBundle\Application\Page\CommandHandler\FindPagesByUserId\FindPagesByUserIdCommandHandler;
use CmsBundle\Application\Site\CommandHandler\GetSite\GetSiteCommand;
use CmsBundle\Application\Site\CommandHandler\GetSite\GetSiteCommandHandler;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class SiteController
 * @package CmsApiRestBundle\Controller\Site
 *
 * @RouteResource("site", pluralize=false)
 */
class SiteController extends Controller
{
    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Get user",
     * )
     *
     *
     * @param string $id
     * @return \CmsBundle\Application\Site\CommandHandler\GetSite\GetSiteCommandResult
     */
    public function getAction(string $id)
    {
        /** @var GetSiteCommandHandler $getSiteCommandHandler */
        $getSiteCommandHandler = $this->get('cms.application.site.get_site.get_site_command_handler');

        return $getSiteCommandHandler->handle(GetSiteCommand::instance($id));
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Get site pages",
     * )
     *
     * @param string $id
     * @return array
     */
    public function getPagesAction(string $id)
    {
        /** @var FindPagesByUserIdCommandHandler $findPagesByuserIdCommandHandler */

        /** @var FindPagesBySiteIdCommandHandler $findPagesBySiteIdCommandHandler */
        $findPagesBySiteIdCommandHandler = $this->get('cms.application.page.find_pages_by_site_id.find_pages_by_site_id_command_handler');

        return $findPagesBySiteIdCommandHandler->handle(FindPagesBySiteIdCommand::instance($id));
    }
}
