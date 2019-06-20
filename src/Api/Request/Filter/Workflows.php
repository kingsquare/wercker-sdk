<?php

namespace Kingsquare\Wercker\Api\Request\Filter;

use Kingsquare\Wercker\Api\Request\Filter;

/**
 * Class Workflows
 * @package Kingsquare\Wercker\Api\Request\Filter
 */
class Workflows extends Filter
{
    /**
     * @var string
     */
    protected $sort;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var string
     */
    protected $applicationId;

    /**
     * @var int
     */
    protected $skip;

    /**
     * @param string $applicationId
     * @return $this
     */
    public function byApplicationId($applicationId)
    {
        $applicationId = (string) $applicationId;
        $this->guardAgainstMalformedId($applicationId);
        if ($applicationId === '') {
            return $this;
        }

        $this->applicationId = $applicationId;
        return $this;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function limitBy($limit)
    {
        $this->limit = $this->sanitizeLimit($limit, 10, 0, 20);
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
