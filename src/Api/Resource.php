<?php

namespace Kingsquare\Wercker\Api;

abstract class Resource
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * GenericResource constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }
}
