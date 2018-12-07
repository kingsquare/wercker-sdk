<?php

namespace Kingsquare\Wercker\Api\Request;

use Kingsquare\Wercker\Api\Response\Application;

/**
 * Class Filter
 * @package Kingsquare\Wercker\Api\Request
 */
abstract class Filter
{
    /**
     * @var string
     */
    protected $status;
    /**
     * @var int
     */
    protected $stack;
    /**
     * @var string
     */
    protected $result;
    /**
     * @var string
     */
    protected $commit;
    /**
     * @var string
     */
    protected $branch;

    /**
     * @return array
     */
    public function forRequest()
    {
        return get_object_vars($this);
    }

    /**
     * @param string $branch
     * @return $this
     */
    protected function branch($branch)
    {
        $this->branch = (string)$branch;
        return $this;
    }

    /**
     * @param string $commit
     * @return $this
     */
    protected function commit($commit)
    {
        $this->commit = (string)$commit;
        return $this;
    }

    /**
     * @param string $result
     * @return $this
     */
    protected function result($result)
    {
        $this->result = $this->sanitizeEnum((string)$result, null, ['aborted', 'unknown', 'passed', 'failed']);
        return $this;
    }

    /**
     * @param int $stack
     * @return $this
     */
    protected function stack($stack)
    {
        $stack = (int)$stack;
        if (!in_array($stack, [Application::STACK_CLASSIC, Application::STACK_DOCKER], true)) {
            return $this;
        }
        $this->stack = $stack;
        return $this;
    }

    /**
     * @param string $status
     * @return $this
     */
    protected function status($status)
    {
        $this->status = $this->sanitizeEnum((string)$status, null, ['notstarted', 'started', 'finished', 'running']);
        return $this;
    }

    /**
     * @param null|int $value
     * @param int|null $default
     * @param int $min
     * @param int $max
     * @return int
     */
    protected function sanitizeLimit($value, $default, $min, $max)
    {
        /** @noinspection IsEmptyFunctionUsageInspection */
        if (empty($value)) {
            $value = (int)$default;
        }
        return max($min, min((int)$value, $max));
    }

    /**
     * @param int|string|null $value
     * @param int|string|null $default
     * @param array $options
     * @return int|string|null
     */
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

    /**
     * @param string $id
     * @param string $field
     */
    protected function guardAgainstMalformedId($id, $field = 'applicationId')
    {
        static $pattern = '/^[0-9a-fA-F]{24}$/';
        $id = (string)$id;
        if ($id !== '' && !preg_match($pattern, $id)) {
            throw new \InvalidArgumentException('Malformed ' . $field . ' given (' . $id . '), must match ' . $pattern);
        }
    }
}
