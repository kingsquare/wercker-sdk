<?php

namespace Kingsquare\Wercker\Api\Request\Filter;

use Kingsquare\Wercker\Api\Request\Filter;

class Applications extends Filter
{
    public function byStack($stack)
    {
        $this->stack($stack);
        return $this;
    }

    public function limitBy($limit)
    {
        $this->limit = $this->sanitizeLimit($limit, 20, 1, 100);
        return $this;
    }

    public function skipBy($skip)
    {
        $this->skip($skip);
        return $this;
    }

    public function sortBy($sort)
    {
        $this->sort = $this->sanitizeEnum($sort, 'nameAsc',
            ['nameAsc', 'nameDesc', 'createdAtAsc', 'createdAtDesc', 'updatedAtAsc', 'updatedAtDesc']);
        return $this;
    }
}
