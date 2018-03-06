<?php

namespace App\Application\Page\CommandHandler\FindPages;

use App\Application\Common\CommandHandler\Command;
use App\Application\Common\Request\QueryParams;

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
