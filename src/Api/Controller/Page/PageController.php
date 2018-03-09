<?php

namespace App\Api\Controller\Page;

use App\Application\Common\Request\QueryParams;
use App\Application\Page\CommandHandler\CreatePage\CreatePageCommand;
use App\Application\Page\CommandHandler\FindPages\FindPagesCommand;
use App\Application\Page\CommandHandler\GetPage\GetPageCommand;
use App\Domain\Page\Entity\Page;
use App\Infrastructure\Services\Bus\CommandBus;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PageController
 * @package CmsApiRestBundle\Controller\Page
 *
 * @RouteResource("page", pluralize=false)
 */
class PageController extends Controller
{
    /** @var CommandBus  */
    private $commandBus;

    /**
     * PageController constructor.
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
     * @return \App\Application\Page\CommandHandler\GetPage\GetPageCommandResult
     */
    public function getAction(string $id)
    {
        return $this->commandBus->handle(GetPageCommand::instance($id));
    }

    /**
     * @QueryParam(
     *     name="filter",
     *     description="Order fields in Json Format ie. filter={""user"":[""user_id"", ""user_id""], ""status"":1}"
     * )
     * @QueryParam(name="order", description="Filter by fields in Json Format ie. order={""createdOn"":""DESC""}")
     * @QueryParam(name="limit", requirements="\d+", default="250", description="Items per page")
     * @QueryParam(name="page", requirements="\d+", default="1", description="Page number")
     *
     * @View(statusCode=200, serializerGroups={"Default"})
     *
     * @param ParamFetcher $fetcher
     * @return Page[]
     * @internal param Request $request
     */
    public function cgetAction(ParamFetcher $fetcher)
    {
        $paramFetcher = new QueryParams($fetcher->all());

        return $this->commandBus->handle(FindPagesCommand::instance($paramFetcher));
    }

    /**
     * @RequestParam(name="user_id", description="The user id")
     * @RequestParam(name="site_id", description="The site id")
     * @RequestParam(name="content", description="The page content")
     *
     * @View(statusCode=202, serializerGroups={"Default"})
     *
     * @param Request $request
     *
     * @return \App\Application\Page\CommandHandler\CreatePage\CreatePageCommandResult
     */
    public function postAction(Request $request)
    {
        $command = CreatePageCommand::instance(
            $request->request->get('user_id'),
            $request->request->get('site_id'),
            $request->request->get('content')
        );

        return $this->commandBus->handle($command);
    }
}
