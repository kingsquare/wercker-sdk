<?php

namespace Kingsquare\Wercker\Api\Request\Filter;

use Kingsquare\Wercker\Api\Request\Filter;

class Builds extends Filter
{
    public function byBranch($branch)
    {
        $this->branch($branch);
        return $this;
    }

    public function byCommit($commit)
    {
        $this->commit($commit);
        return $this;
    }

    public function byResult($result)
    {
        $this->result($result);
        return $this;
    }

    public function byStack($stack)
    {
        $this->stack($stack);
        return $this;
    }

    public function byStatus($status)
    {
        $this->status($status);
        return $this;
    }

    public function limitBy($limit)
    {
        $this->limit = $this->sanitizeLimit($limit, 10, 1, 20);
        return $this;
    }

    public function skipBy($skip)
    {
        $this->skip($skip);
        return $this;
    }

    public function sortBy($sort)
    {
        $this->sort = $this->sanitizeEnum($sort, 'creationDateDesc', ['creationDateAsc', 'creationDateDesc']);
        return $this;
    }

}
