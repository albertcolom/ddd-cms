<?php

namespace CmsBundle\Cms\Application\Model\Page\CommandHandler\FindPages;

use CmsBundle\Cms\Application\Model\Common\CommandHandler\Command;
use CmsBundle\Cms\Application\Model\Common\Request\QueryParams;

class FindPagesCommand implements Command
{
    /** @var QueryParams  */
    private $param;

    private function __construct(QueryParams $param)
    {
        $this->param = $param;
    }

    /**
     * @param QueryParams $param
     * @return FindPagesCommand
     */
    public static function instance(QueryParams $param): FindPagesCommand
    {
        return new self($param);
    }

    /**
     * @return QueryParams
     */
    public function param(): QueryParams
    {
        return $this->param;
    }
}
