<?php
namespace Kingsquare\Wercker;

use Kingsquare\Wercker\Api\Resource\Applications;
use Kingsquare\Wercker\Api\Resource\Runs;
use Kingsquare\Wercker\Api\Resource\Workflows;

use Kingsquare\Wercker\Api\Client;
use Kingsquare\Wercker\Api\Header\AuthorizationBearer;

class Sdk
{
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
            'basePath' => '/api/v3/',
            'guzzleOptions' => $this->guzzleOptions,
            'headers' => [
                new AuthorizationBearer($this->token)
            ]
        ]);
    }
}
