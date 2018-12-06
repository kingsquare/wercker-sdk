<?php

namespace Kingsquare\Wercker\Api\Response;

class Deploy
{
    private $id;
    private $url;
    private $status;
    private $createdAt;
    private $progress;

    public static function fromResponse(array $data)
    {
        $instance = new self();
        $instance->progress = (int) $data['progress'];
        $instance->createdAt = new \DateTimeImmutable($data['createdAt']);
        $instance->status = $data['status'];
        $instance->url = $data['url'];
        $instance->id = $data['id'];
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
    public function getStatus()
    {
        return $this->status;
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
    public function getProgress()
    {
        return $this->progress;
    }
}
