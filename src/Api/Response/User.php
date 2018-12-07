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
}
