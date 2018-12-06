<?php

namespace Kingsquare\Wercker\Api\Request\Filter;

use Kingsquare\Wercker\Api\Request\Filter;

class Runs extends Filter
{
    public function isValid()
    {
        return $this->getId() !== null;
    }

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

    // /^[0-9a-fA-F]{24}$/
    public function byApplicationId($applicationId)
    {
        $this->applicationId = (string) $applicationId;
        return $this;
    }

    public function limitBy($limit)
    {
        $this->limit = $this->sanitizeLimit($limit, 20, 1, 20);
        return $this;
    }

    /**
     * NOTE the docs same something weird? Optional Skip the first X runs. Min: 1, default: 0 ?
     */
    public function skipBy($skip)
    {
        $this->skip = $this->sanitizeLimit($skip, 0, 0, 100);
        return $this;
    }


    public function sortBy($sort)
    {
        $this->sort = $this->sanitizeEnum($sort, 'creationDateDesc', ['creationDateAsc', 'creationDateDesc']);
        return $this;
    }

    public function byStatus($status)
    {
        $this->status($status);
        return $this;
    }

    public function byResult($result)
    {
        $this->result($result);
        return $this;
    }

    public function byBranch($branch)
    {
        $this->branch = (string)$branch;
        return $this;
    }

    public function byPipelineId($pipelineId)
    {
        $this->pipelineId = (string)$pipelineId;
        return $this;
    }

    public function byCommit($commit)
    {
        $this->commit($commit);
        return $this;
    }

    public function bySourceRun($sourceRun)
    {
        $this->sourceRun = (string) $sourceRun;
        return $this;
    }

    public function byWerckerUser($author)
    {
        $this->author = (string) $author;
        return $this;
    }

}
