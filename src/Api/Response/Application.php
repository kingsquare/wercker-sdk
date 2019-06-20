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

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getPrivacy()
    {
        return $this->privacy;
    }

    /**
     * @return int
     */
    public function getStack()
    {
        return $this->stack;
    }

    /**
     * @return array
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
     * @return array
     */
    public function getIgnoredBranches()
    {
        return $this->ignoredBranches;
    }
}
