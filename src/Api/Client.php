<?php

namespace Kingsquare\Wercker\Api;

/**
 * Class Client
 * @package Kingsquare\Wercker\Api
 */
class Client
{
    /**
     *
     */
    const API_VERSION = '3';

    /**
     * @var
     */
    protected $basePath;
    /**
     * @var array
     */
    protected $headers;
    /**
     * @var array
     */
    protected $guzzleOptions;

    /**
     * Client constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->basePath = $config['basePath'];
        $this->headers = array_key_exists('headers', $config) ? $config['headers'] : [];
        $this->guzzleOptions = array_key_exists('guzzleOptions', $config) ? $config['guzzleOptions'] : [];
    }

    /**
     * @param string $name
     * @param mixed $arguments
     * @return \Kingsquare\Wercker\Api\RequestBuilder
     */
    public function __call($name, $arguments)
    {
        $builder = new RequestBuilder(array(
            'basePath' => $this->basePath,
            'method' => $name,
            'guzzleOptions' => $this->guzzleOptions
        ));
        return $builder->withHeaders($this->headers);
    }

}
