<?php

namespace Kingsquare\Wercker\Api\Request\Filter;

use Kingsquare\Wercker\Api\Request\Filter;

/**
 * Class Builds
 * @package Kingsquare\Wercker\Api\Request\Filter
 */
class Builds extends Filter
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
     * @var int
     */
    private $skip;

    /**
     * @param string $branch
     * @return $this
     */
    public function byBranch($branch)
    {
        $this->branch($branch);
        return $this;
    }

    /**
     * @param string $commit
     * @return $this
     */
    public function byCommit($commit)
    {
        $this->commit($commit);
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
        $this->limit = $this->sanitizeLimit((int) $limit, 10, 1, 20);
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
