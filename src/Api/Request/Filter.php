<?php

namespace Kingsquare\Wercker\Api\Request;

use Kingsquare\Wercker\Api\Response\Application;

abstract class Filter
{

    public function forRequest()
    {
        return get_object_vars($this);
    }

    protected function branch($branch)
    {
        $this->branch = (string)$branch;
        return $this;
    }

    protected function commit($commit)
    {
        $this->commit = (string)$commit;
        return $this;
    }

    protected function result($result)
    {
        $this->result = $this->sanitizeEnum((string)$result, null, ['aborted', 'unknown', 'passed', 'failed']);
        return $this;
    }

    protected function stack($stack)
    {
        $stack = (int)$stack;
        if (!in_array($stack, [Application::STACK_CLASSIC, Application::STACK_DOCKER], true)) {
            return $this;
        }
        $this->stack = $stack;
        return $this;
    }

    protected function status($status)
    {
        $this->status = $this->sanitizeEnum((string)$status, null, ['notstarted', 'started', 'finished', 'running']);
        return $this;
    }

    protected function sanitizeLimit($value, $default, $min, $max)
    {
        if (empty($value)) {
            $value = (int)$default;
        }
        return max($min, min((int)$value, $max));
    }

    protected function sanitizeEnum($value, $default, array $options)
    {
        if (empty($value)) {
            return $default;
        }

        if (!in_array($value, $options, true)) {
            return $default;
        }
        return $value;
    }

    protected function skip($skip)
    {
        $this->skip = $this->sanitizeLimit($skip, 0, 0, 100);
    }
}
