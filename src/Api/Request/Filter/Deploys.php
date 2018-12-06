<?php

namespace Kingsquare\Wercker\Api\Request\Filter;

use Kingsquare\Wercker\Api\Request\Filter;

class Deploys extends Filter
{
    public function byBuild($build)
    {
        $this->build = (string)$build;
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
