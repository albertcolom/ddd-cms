<?php

namespace CmsBundle\Application\Page\CommandHandler\FindPages;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Application\Common\Request\QueryParams;

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
