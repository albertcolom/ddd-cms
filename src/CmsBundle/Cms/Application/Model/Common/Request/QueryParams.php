<?php

namespace CmsBundle\Cms\Application\Model\Common\Request;

class QueryParams
{
    const LIMIT = 250;
    const OFFSET = 0;

    /** @var array */
    private $filter;

    /** @var array */
    private $order;

    /** @var int */
    private $limit;

    /** @var int */
    private $offset;

    public function __construct(array $param)
    {
        $this->filter = json_decode($param['filter'], true) ?? [];
        $this->order = json_decode($param['order'], true) ?? [];
        $this->limit = $param['limit'] ?? self::LIMIT;
        $this->offset = $param['page'] && $this->limit ? ($param['page'] - 1) * $this->limit : self::OFFSET;
    }

    /**
     * @return array
     */
    public function order(): array
    {
        return $this->order;
    }

    /**
     * @return array
     */
    public function filter(): array
    {
        return $this->filter;
    }

    /**
     * @return int
     */
    public function limit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function offset(): int
    {
        return $this->offset;
    }
}
