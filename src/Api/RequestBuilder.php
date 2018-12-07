<?php

namespace Kingsquare\Wercker\Api;

use Kingsquare\Wercker\Api\Request\Filter;

/**
 * Class RequestBuilder
 *
 * @package Kingsquare\Wercker\Api
 */
class RequestBuilder
{

    /**
     * @var string
     */
    protected $domain = 'https://app.wercker.com';

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var array
     */
    protected $path = [];

    /**
     * @var array
     */
    protected $method = [];

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var array
     */
    protected $form_params = [];

    /**
     * @var array
     */
    protected $files = [];

    /**
     * @var array
     */
    protected $guzzleOptions = [];

    /**
     * @var string
     */
    protected $body;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->method = $config['method'];
        $this->basePath = array_key_exists('basePath', $config) ? $config['basePath'] : '';
        $this->guzzleOptions = array_key_exists('guzzleOptions', $config) ? $config['guzzleOptions'] : [];
        $this->headers = array_key_exists('headers', $config) ? $config['headers'] : [];
        if (array_key_exists('path', $config)) {
            $this->path = $config['path'];
        }
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return RequestBuilder
     */
    public function __call($name, $arguments)
    {
        $argument = null;
        if (count($arguments) > 0) {
            $argument = $arguments[0];
        }
        $this->addPath($name, $argument);
        return $this;
    }

    /**
     * @param string $name
     * @param string|null $argument
     * @return RequestBuilder
     */
    public function addPath($name, $argument = null)
    {
        $this->path[] = $name;
        if ($argument !== null) {
            $this->path[] = $argument;
        }
        return $this;
    }

    /**
     * @param string $variable
     * @return RequestBuilder
     */
    public function addPathVariable($variable)
    {
        $this->path[] = $variable;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return trim(implode('/', $this->path), '/') . $this->getParams();
    }

    /**
     * @return string
     */
    public function getParams()
    {
        if (empty($this->params)) {
            return '';
        }
        return '?' . http_build_query($this->params, null, '&');
    }

    /**
     * @param string $field
     * @param string $file_path
     * @return RequestBuilder
     */
    public function addFile($field, $file_path)
    {
        $this->files[$field] = $file_path;
        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @return RequestBuilder
     */
    public function addFormParam($key, $value)
    {
        $this->form_params[$key] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getGuzzleOptions()
    {
        return array_merge(
            ['base_uri' => $this->domain . $this->basePath],
            $this->guzzleOptions
        );
    }

    /**
     * @return array|mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function call()
    {
        $client = new \GuzzleHttp\Client($this->getGuzzleOptions());

        try {
            $data = [
                'headers' => $this->headers,
                'body' => $this->body,
            ];

            if (!empty($this->form_params)) {
                $data['form_params'] = $this->form_params;
            }

            $response = $client->request($this->method, $this->getUrl(), $data);
            $body = (string)$response->getBody();

            if (strpos($response->getHeaderLine('content-type'), 'json') !== false) {
                return json_decode($body, true);
            }

            return $body;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw $e;
        }
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function withHeaders(array $headers)
    {
        foreach ($headers as $header) {
            $this->withHeader($header);
        }
        return $this;
    }

    /**
     * @param Header|string $header
     * @param null|string $value
     * @return $this
     */
    public function withHeader($header, $value = null)
    {
        if ($header instanceof Header) {
            $this->headers[$header->getHeader()] = $header->getValue();
        } else {
            $this->headers[$header] = $value;
        }

        return $this;
    }

    /**
     * @param string $body
     * @return $this
     */
    public function withBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function withParam($key, $value)
    {
        if (is_bool($value)) {
            $value = $value ? 'true' : 'false';
        }
        $this->params[$key] = $value;
        return $this;
    }

    /**
     * @param \Kingsquare\Wercker\Api\Request\Filter $filter
     * @return $this
     */
    public function withFilter(Filter $filter = null)
    {
        if ($filter === null) {
            return $this;
        }

        foreach ($filter->forRequest() as $key => $value)
        {
            $this->withParam($key, $value);
        }
        return $this;
    }
}
