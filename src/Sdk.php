<?php

namespace Kingsquare\Wercker;

use Kingsquare\Wercker\Api\Resource\Applications;
use Kingsquare\Wercker\Api\Resource\Runs;
use Kingsquare\Wercker\Api\Resource\Workflows;
use Kingsquare\Wercker\Api\Client;

class Sdk
{
    /**
     * string
     */
    const API_VERSION = 'v3';

    /**
     * @var string
     */
    private $token;

    /**
     * @var Client
     */
    private $apiClient;

    /**
     * @var array
     */
    private $guzzleOptions;

    /**
     * @var Runs
     */
    public $runs;

    /**
     * @var Applications
     */
    public $applications;

    /**
     * @var Workflows
     */
    public $workflows;

    /**
     * Constructor.
     *
     * @param string $token
     * @param array $guzzleOptions
     */
    public function __construct($token, array $guzzleOptions = [])
    {
        $this->token = $token;
        $this->guzzleOptions = $guzzleOptions;

        $this->setApiClient();

        $this->applications = new Applications($this->apiClient);
        $this->runs = new Runs($this->apiClient);
        $this->workflows = new Workflows($this->apiClient);
    }

    protected function setApiClient()
    {
        $this->apiClient = new Client([
            'basePath' => '/api/' . self::API_VERSION . '/',
            'guzzleOptions' => $this->guzzleOptions,
            'headers' => [
                'User-Agent' => $this->getPackageData('name',
                        'kingsquare/wercker-sdk') . '-' . $this->getPackageData('verson', 'n/a'),
                'Authorization' => 'Bearer ' . $this->token,
            ]
        ]);
    }

    /**
     * @param null|string $key
     * @param null|mixed $default
     * @return array|mixed|null
     */
    private function getPackageData($key = null, $default = null)
    {
        static $data;
        if ($data === null) {
            $data = [];
            $composerData = json_decode(file_get_contents(__DIR__ . '/../composer.json'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $data = $composerData;
            }
            unset($composerData);
        }
        if ($key === null) {
            return $data;
        }
        return array_key_exists($key, $data) ? $data[$key] : $default;
    }
}
