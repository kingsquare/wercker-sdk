<?php

namespace Kingsquare\Wercker\Api\Response;

class Build
{
    private $result;
    private $progress;
    private $message;
    private $finishedAt;
    private $createdAt;
    private $branch;
    private $url;
    private $id;
    private $startedAt;
    private $status;

    /**
     * @param array $data
     * @return \Kingsquare\Wercker\Api\Response\Build
     * @throws \Exception
     */
    public static function fromResponse(array $data)
    {
        $instance = new self();
        $instance->status = $data['status'];
        $instance->startedAt = new \DateTimeImmutable($data['startedAt']);
        $instance->id = $data['id'];
        $instance->url = $data['url'];
        $instance->branch = $data['branch'];
        $instance->createdAt = new \DateTimeImmutable($data['createdAt']);
        $instance->finishedAt = new \DateTimeImmutable($data['finishedAt']);
        $instance->message = $data['message'];
        $instance->progress = (int) $data['progress'];
        $instance->result = $data['result'];

        return $instance;
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
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
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
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getBranch()
    {
        return $this->branch;
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
    public function getId()
    {
        return $this->id;
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


}
