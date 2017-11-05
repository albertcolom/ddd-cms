<?php

namespace CmsApiRestBundle\Controller\Site;

use CmsBundle\Cms\Application\Model\Site\CommandHandler\CreateSite\CreateSiteCommand;
use CmsBundle\Cms\Application\Model\Site\CommandHandler\GetSite\GetSiteCommand;
use CmsBundle\Cms\Infrastructure\Services\Bus\CommandBus;
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
    /** @var CommandBus  */
    private $commandBus;

    /**
     * SiteController constructor.
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
     * @return \CmsBundle\Cms\Application\Model\Site\CommandHandler\GetSite\GetSiteCommandResult
     */
    public function getAction(string $id)
    {
        return $this->commandBus->handle(GetSiteCommand::instance($id));
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
        $command = CreateSiteCommand::instance(
            $request->request->get('name'),
            $request->request->get('description')
        );

        return $this->commandBus->handle($command);
    }
}
