<?php

namespace Kingsquare\Wercker\Api\Response;

class Step
{
    private $id;
    private $url;
    private $artifactsUrl;
    private $createdAt;
    private $finishedAt;
    private $logUrl;
    private $order;
    private $result;
    private $startedAt;
    private $status;
    private $step;

    public static function fromResponse(array $data)
    {
        $instance = new self();

        $instance->id = $data['id'];
        $instance->url = $data['url'];
        $instance->artifactsUrl = $data['artifactsUrl'];
        $instance->createdAt = new \DateTimeImmutable($data['createdAt']);
        $instance->finishedAt = new \DateTimeImmutable($data['finishedAt']);
        $instance->logUrl = $data['logUrl'];
        $instance->order = $data['order'];
        $instance->result = $data['result'];
        $instance->startedAt = new \DateTimeImmutable($data['startedAt']);
        $instance->status = $data['status'];
        $instance->step = array_key_exists('step', $data) ? $data['step'] : '';
        return $instance;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getArtifactsUrl()
    {
        return $this->artifactsUrl;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getFinishedAt()
    {
        return $this->finishedAt;
    }

    /**
     * @return mixed
     */
    public function getLogUrl()
    {
        return $this->logUrl;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return mixed
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getStep()
    {
        return $this->step;
    }
}
