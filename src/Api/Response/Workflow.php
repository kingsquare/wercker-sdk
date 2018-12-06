<?php

namespace Kingsquare\Wercker\Api\Response;

class Workflow
{
    private $user;
    private $updatedAt;
    private $trigger;
    private $startedAt;
    private $items;
    private $id;
    private $data;
    private $createdAt;
    private $url;

    public static function fromResponse(array $data)
    {
        $instance = new self();

        $instance->url = $data['url'];
        $instance->createdAt = new \DateTimeImmutable($data['createdAt']);
        $instance->data = $data['data'];
        $instance->id = $data['id'];
        $instance->items = $data['items'];
        $instance->startedAt = new \DateTimeImmutable($data['startedAt']);
        $instance->trigger = $data['trigger'];
        $instance->updatedAt = new \DateTimeImmutable($data['updatedAt']);
        $instance->user = User::fromResponse($data['user']);
        return $instance;
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
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return mixed
     */
    public function getTrigger()
    {
        return $this->trigger;
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
    public function getItems()
    {
        return $this->items;
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
    public function getData()
    {
        return $this->data;
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
    public function getUrl()
    {
        return $this->url;
    }

}
