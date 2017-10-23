<?php

namespace CmsApiRestBundle\Controller\Site;

use CmsBundle\Cms\Application\Model\Site\CommandHandler\CreateSite\CreateSiteCommand;
use CmsBundle\Cms\Application\Model\Site\CommandHandler\CreateSite\CreateSiteCommandHandler;
use CmsBundle\Cms\Application\Model\Site\CommandHandler\GetSite\GetSiteCommand;
use CmsBundle\Cms\Application\Model\Site\CommandHandler\GetSite\GetSiteCommandHandler;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
     * @View(statusCode=200, serializerGroups={"Default"})
     *
     * @param string $id
     * @return \CmsBundle\Cms\Application\Model\Site\CommandHandler\GetSite\GetSiteCommandResult
     */
    public function getAction(string $id)
    {
        /** @var GetSiteCommandHandler $getSiteCommandHandler */
        $getSiteCommandHandler = $this->get('cms.application.model.site.get_site.get_site_command_handler');

        return $getSiteCommandHandler->handle(GetSiteCommand::instance($id));
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Create user",
     * )
     *
     * @RequestParam(name="name", description="The site name")
     * @RequestParam(name="description", description="The site description")
     *
     * @View(statusCode=202, serializerGroups={"Default"})
     *
     * @param Request $request
     *
     * @return \CmsBundle\Cms\Application\Model\Site\CommandHandler\CreateSite\CreateSiteCommandResult
     */
    public function postAction(Request $request)
    {
        /** @var CreateSiteCommandHandler $createSiteCommandHandler */
        $createSiteCommandHandler = $this->get('cms.application.model.site.create_site.create_site_command_handler');

        $command = CreateSiteCommand::instance(
            $request->request->get('name'),
            $request->request->get('description')
        );

        return $createSiteCommandHandler->handle($command);
    }
}
