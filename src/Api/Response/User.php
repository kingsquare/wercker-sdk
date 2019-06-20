<?php

namespace Kingsquare\Wercker\Api\Response;

class User
{
    private $type;
    private $name;
    private $avatar;
    private $id;
    private $meta;

    /**
     * @param array $data
     * @return \Kingsquare\Wercker\Api\Response\User
     */
    public static function fromResponse(array $data)
    {
        $instance = new self();

        $instance->meta = $data['meta'];
        $instance->avatar = $data['avatar'];
        $instance->name = $data['name'];
        $instance->type = $data['type'];
        $instance->id = $data['userId'];
        return $instance;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array [?gravatar: string]
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array [username:string, type:string, werckerEmployee: bool]
     */
    public function getMeta()
    {
        return $this->meta;
    }
}
