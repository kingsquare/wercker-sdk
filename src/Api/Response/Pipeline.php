<?php

namespace Kingsquare\Wercker\Api\Response;

class Pipeline
{
    private $type;
    private $setScmProviderStatus;
    private $pipelineName;
    private $permissions;
    private $name;
    private $createdAt;
    private $url;
    private $id;

    /**
     * @param array $data
     * @return \Kingsquare\Wercker\Api\Response\Pipeline
     * @throws \Exception
     */
    public static function fromResponse(array $data)
    {
        $instance = new self();

        $instance->id = $data['id'];
        $instance->url = $data['url'];
        $instance->createdAt = new \DateTimeImmutable($data['createdAt']);
        $instance->name = $data['name'];
        $instance->permissions = $data['permissions'];
        $instance->pipelineName = $data['pipelineName'];
        $instance->setScmProviderStatus = $data['setScmProviderStatus'];
        $instance->type = $data['type'];
        return $instance;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getSetScmProviderStatus()
    {
        return $this->setScmProviderStatus;
    }

    /**
     * @return mixed
     */
    public function getPipelineName()
    {
        return $this->pipelineName;
    }

    /**
     * @return mixed
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}
