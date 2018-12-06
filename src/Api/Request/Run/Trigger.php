<?php

namespace Kingsquare\Wercker\Api\Request\Run;

/**
 * Class Trigger
 * @package Kingsquare\Wercker\Api\Request\Run
 */
class Trigger implements \JsonSerializable
{
    private $pipelineId;
    private $envVars;
    private $sourceRun;
    private $branch;
    private $commitHash;
    private $message;

    /**
     * Trigger constructor.
     * @param string $pipelineId
     */
    private function __construct($pipelineId)
    {
        $this->pipelineId = (string) $pipelineId;
    }

    /**
     * @param string $pipelineId
     * @return \Kingsquare\Wercker\Api\Request\Run\Trigger
     */
    public static function forRequest($pipelineId)
    {
        return new self($pipelineId);
    }

    /**
     * @param $run
     * @return $this
     */
    public function setSourceRun($run)
    {
        $this->sourceRun = (string) $run;
        return $this;
    }

    /**
     * @param $branch
     * @return $this
     */
    public function setBranch($branch)
    {
        $this->branch = (string) $branch;
        return $this;
    }

    /**
     * @param $commitHash
     * @return $this
     */
    public function setCommitHash($commitHash)
    {
        $this->commitHash = (string) $commitHash;
        return $this;
    }


    /**
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = (string) $message;
        return $this;
    }

    /**
     * @param array $envVars
     * @return $this
     */
    public function setEnvVars(array $envVars)
    {
        $this->envVars = $envVars;
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this), function($var) {
            if (is_array($var)) {
                $var = array_filter($var);
                return !empty($var);
            }
            if ($var === null) {
                return false;
            }
            return $var !== '';
        });
    }
}
