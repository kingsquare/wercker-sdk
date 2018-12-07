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

    /**
     * @param string $id
     * @param string $field
     */
    protected function guardAgainstMalformedId($id, $field = 'applicationId')
    {
        static $pattern = '/^[0-9a-fA-F]{24}$/';
        $id = (string)$id;
        if ($id !== '' && !preg_match($pattern, $id)) {
            throw new \InvalidArgumentException('Malformed ' . $field . ' given (' . $id . '), must match ' . $pattern);
        }
    }
}
