<?php

namespace Kingsquare\Wercker\Api\Response;

class Application
{
    const STACK_CLASSIC = 1;
    const STACK_DOCKER = 6;

    private $id;
    private $url;
    private $name;
    private $owner;
    private $createdAt;
    private $privacy;
    private $stack;
    private $scm;
    private $deploys;
    private $builds;
    private $ignoredBranches;

    /**
     * @param array $data
     * @return \Kingsquare\Wercker\Api\Response\Application
     * @throws \Exception
     */
    public static function fromResponse(array $data)
    {
        $instance = new self();
        $instance->stack = $data['stack'];
        $instance->privacy = $data['privacy'];
        $instance->createdAt = new \DateTimeImmutable($data['createdAt']);
        $instance->owner = User::fromResponse($data['owner']);
        $instance->name = $data['name'];
        $instance->url = $data['url'];
        $instance->id = $data['id'];

        $instance->builds = array_key_exists('builds', $data) ? $data['builds'] : '';
        $instance->deploys = array_key_exists('deploys', $data) ? $data['deploys'] : '';
        $instance->scm = array_key_exists('scm', $data) ? $data['scm'] : [];
        $instance->ignoredBranches = array_key_exists('ignoredBranches', $data) ? $data['ignoredBranches'] : [];
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
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
    public function getPrivacy()
    {
        return $this->privacy;
    }

    /**
     * @return mixed
     */
    public function getStack()
    {
        return $this->stack;
    }

    /**
     * @return mixed
     */
    public function getScm()
    {
        return $this->scm;
    }

    /**
     * @return mixed
     */
    public function getDeploys()
    {
        return $this->deploys;
    }

    /**
     * @return mixed
     */
    public function getBuilds()
    {
        return $this->builds;
    }

    /**
     * @return mixed
     */
    public function getIgnoredBranches()
    {
        return $this->ignoredBranches;
    }
}
