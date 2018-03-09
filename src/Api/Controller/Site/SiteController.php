<?php

namespace App\Api\Controller\Site;

use App\Application\Site\CommandHandler\CreateSite\CreateSiteCommand;
use App\Application\Site\CommandHandler\GetSite\GetSiteCommand;
use App\Infrastructure\Services\Bus\CommandBus;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
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
     * @View(statusCode=200, serializerGroups={"Default"})
     *
     * @param string $id
     * @return \App\Application\Site\CommandHandler\GetSite\GetSiteCommandResult
     */
    public function getAction(string $id)
    {
        return $this->commandBus->handle(GetSiteCommand::instance($id));
    }

    /**
     * @RequestParam(name="name", description="The site name")
     * @RequestParam(name="description", description="The site description")
     *
     * @View(statusCode=202, serializerGroups={"Default"})
     *
     * @param Request $request
     *
     * @return \App\Application\Site\CommandHandler\CreateSite\CreateSiteCommandResult
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
