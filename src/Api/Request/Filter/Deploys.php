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
     * @param $build
     * @return $this
     */
    public function byBuild($build)
    {
        $this->build = (string)$build;
        return $this;
    }

    /**
     * @param $result
     * @return $this
     */
    public function byResult($result)
    {
        $this->result($result);
        return $this;
    }

    /**
     * @param $stack
     * @return $this
     */
    public function byStack($stack)
    {
        $this->stack($stack);
        return $this;
    }

    /**
     * @param $status
     * @return $this
     */
    public function byStatus($status)
    {
        $this->status($status);
        return $this;
    }

    /**
     * @param $limit
     * @return $this
     */
    public function limitBy($limit)
    {
        $this->limit = $this->sanitizeLimit($limit, 10, 1, 20);
        return $this;
    }

    /**
     * @param $skip
     * @return $this
     */
    public function skipBy($skip)
    {
        $this->skip = $this->sanitizeLimit((int) $skip, 0, 0, 100);
        return $this;
    }

    /**
     * @param $sort
     * @return $this
     */
    public function sortBy($sort)
    {
        $this->sort = $this->sanitizeEnum($sort, 'creationDateDesc', ['creationDateAsc', 'creationDateDesc']);
        return $this;
    }

}
