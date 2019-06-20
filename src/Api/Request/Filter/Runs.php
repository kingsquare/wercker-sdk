<?php

namespace Kingsquare\Wercker\Api\Request\Filter;

use Kingsquare\Wercker\Api\Request\Filter;

/**
 * Class Runs
 * @package Kingsquare\Wercker\Api\Request\Filter
 */
class Runs extends Filter
{
    /**
     * @var string
     */
    protected $author;

    /**
     * @var string
     */
    protected $sourceRun;

    /**
     * @var string
     */
    protected $pipelineId;

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
     * @return bool
     */
    public function isValid()
    {
        return $this->getId() !== null;
    }

    /**
     * @return string|null
     */
    public function getId()
    {
        if (!empty($this->applicationId)) {
            return $this->applicationId;
        }
        if (!empty($this->pipelineId)) {
            return $this->pipelineId;
        }
        return null;
    }

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
        $this->limit = $this->sanitizeLimit((int) $limit, 20, 1, 20);
        return $this;
    }

    /**
     * NOTE the docs same something weird? Optional Skip the first X runs. Min: 1, default: 0 ?
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
        $this->sort = $this->sanitizeEnum((string) $sort, 'creationDateDesc', ['creationDateAsc', 'creationDateDesc']);
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
     * @param string $result
     * @return $this
     */
    public function byResult($result)
    {
        $this->result($result);
        return $this;
    }

    /**
     * @param string $branch
     * @return $this
     */
    public function byBranch($branch)
    {
        $this->branch = (string)$branch;
        return $this;
    }

    /**
     * @param string $pipelineId
     * @return $this
     */
    public function byPipelineId($pipelineId)
    {
        $pipelineId = (string) $pipelineId;
        $this->guardAgainstMalformedId($pipelineId, 'pipelineId');
        if ($pipelineId === '') {
            return $this;
        }

        $this->pipelineId = $pipelineId;
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
     * @param string $sourceRun
     * @return $this
     */
    public function bySourceRun($sourceRun)
    {
        $this->sourceRun = (string)$sourceRun;
        return $this;
    }

    /**
     * @param string $author
     * @return $this
     */
    public function byWerckerUser($author)
    {
        $this->author = (string)$author;
        return $this;
    }

}
