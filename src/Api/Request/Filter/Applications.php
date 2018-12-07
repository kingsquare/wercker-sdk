<?php

namespace Kingsquare\Wercker\Api\Request\Filter;

use Kingsquare\Wercker\Api\Request\Filter;

/**
 */
class Applications extends Filter
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
     * @param $stack
     * @return $this
     */
    public function byStack($stack)
    {
        $this->stack($stack);
        return $this;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function limitBy($limit)
    {
        $this->limit = $this->sanitizeLimit((int) $limit, 20, 1, 100);
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
        $this->sort = $this->sanitizeEnum((string) $sort, 'nameAsc',
            ['nameAsc', 'nameDesc', 'createdAtAsc', 'createdAtDesc', 'updatedAtAsc', 'updatedAtDesc']);
        return $this;
    }
}
