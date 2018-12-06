<?php

namespace Kingsquare\Wercker\Api\Request\Filter;

use Kingsquare\Wercker\Api\Request\Filter;

class Workflows extends Filter
{
    public function byApplicationId($applicationId)
    {
        $this->applicationId = (string) $applicationId;
        return $this;
    }

    public function limitBy($limit)
    {
        $this->limit = $this->sanitizeLimit($limit, 10, 0, 20);
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
