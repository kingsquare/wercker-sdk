<?php

namespace Kingsquare\Wercker\Api\Response;

class Run
{
    private $pipeline;
    private $user;
    private $status;
    private $startedAt;
    private $result;
    private $progress;
    private $message;
    private $finishedAt;
    private $createdAt;
    private $commitHash;
    private $branch;
    private $url;
    private $id;

    public static function fromResponse(array $data)
    {
        $instance = new self();

        $instance->id = $data['id'];
        $instance->url = $data['url'];
        $instance->branch = $data['branch'];
        $instance->commitHash = $data['commitHash'];
        $instance->createdAt = new \DateTimeImmutable($data['createdAt']);
        $instance->finishedAt = new \DateTimeImmutable($data['finishedAt']);
        $instance->message = $data['message'];
        $instance->progress = (int) $data['progress'];
        $instance->result = $data['result'];
        $instance->startedAt = new \DateTimeImmutable($data['startedAt']);
        $instance->status = $data['status'];
        $instance->user = User::fromResponse($data['user']);
        $instance->pipeline = Pipeline::fromResponse($data['pipeline']);
        return $instance;
    }


    /**
     * @return mixed
     */
    public function getPipeline()
    {
        return $this->pipeline;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
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
    public function getStartedAt()
    {
        return $this->startedAt;
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
    public function getCommitHash()
    {
        return $this->commitHash;
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
}
