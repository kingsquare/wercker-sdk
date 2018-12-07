<?php

namespace Kingsquare\Wercker\Api;

/**
 * Class Client
 * @package Kingsquare\Wercker\Api
 */
class Client
{

    /**
     * @var string
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
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->basePath = $config['basePath'];
        $this->headers = array_key_exists('headers', $config) ? $config['headers'] : [];
        $this->guzzleOptions = array_key_exists('guzzleOptions', $config) ? $config['guzzleOptions'] : [];
    }

    /**
     * @return \Kingsquare\Wercker\Api\RequestBuilder
     */
    public function get()
    {
        return $this->doA('get');
    }

    /**
     * @return \Kingsquare\Wercker\Api\RequestBuilder
     */
    public function post()
    {
        return $this->doA('post');
    }

    /**
     * @return \Kingsquare\Wercker\Api\RequestBuilder
     */
    public function put()
    {
        return $this->doA('post');
    }

    /**
     * @return \Kingsquare\Wercker\Api\RequestBuilder
     */
    public function patch()
    {
        return $this->doA('patch');
    }

    /**
     * @param string $method
     * @return \Kingsquare\Wercker\Api\RequestBuilder
     */
    private function doA($method)
    {
        static $allowedMethods = ['get', 'post', 'put', 'patch', 'delete', 'options'];

        if (!in_array($method, $allowedMethods, true)) {
            throw new \InvalidArgumentException(
                'Invalid method passed. Please issue one of the HTTP Methods: ' . implode(', ', $allowedMethods));
        }

        return (new RequestBuilder([
            'basePath' => $this->basePath,
            'method' => $method,
            'guzzleOptions' => $this->guzzleOptions
        ]))->withHeaders($this->headers);
    }

}
