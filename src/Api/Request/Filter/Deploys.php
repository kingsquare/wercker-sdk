<?php

namespace Kingsquare\Wercker\Api\Request\Filter;

use Kingsquare\Wercker\Api\Request\Filter;

/**
 * Class Deploys
 * @package Kingsquare\Wercker\Api\Request\Filter
 */
class Deploys extends Filter
{
    /**
     * @var string
     */
    private $sort;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var string
     */
    private $build;

    /**
     * @var int
     */
    private $skip;

    /**
     * @param string $build
     * @return $this
     */
    public function byBuild($build)
    {
        $this->build = (string)$build;
        return $this;
    }

    /**
     * @param string $result
     * @return $this
     */
    public function byResult($result)
    {
        $this->result($result);
        return $this;
    }

    /**
     * @param int $stack
     * @return $this
     */
    public function byStack($stack)
    {
        $this->stack($stack);
        return $this;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function byStatus($status)
    {
        $this->status($status);
        return $this;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function limitBy($limit)
    {
        $this->limit = $this->sanitizeLimit($limit, 10, 1, 20);
        return $this;
    }

    /**
     * @param int $skip
     * @return $this
     */
    public function skipBy($skip)
    {
        $this->skip = $this->sanitizeLimit((int) $skip, 0, 0, 100);
        return $this;
    }

    /**
     * @param string $sort
     * @return $this
     */
    public function sortBy($sort)
    {
        $this->sort = $this->sanitizeEnum($sort, 'creationDateDesc', ['creationDateAsc', 'creationDateDesc']);
        return $this;
    }

}
