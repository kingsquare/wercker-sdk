<?php

namespace Kingsquare\Wercker\Api\Resource;

use Kingsquare\Wercker\Api\Header\ContentType;
use Kingsquare\Wercker\Api\Request\Filter\Builds;
use Kingsquare\Wercker\Api\Request\Filter\Deploys;
use Kingsquare\Wercker\Api\Request\Filter\Applications as Filter;
use Kingsquare\Wercker\Api\Response\Application;
use Kingsquare\Wercker\Api\Response\Build;
use Kingsquare\Wercker\Api\Response\Deploy;

/**
 * Class Applications
 * @package Kingsquare\Wercker\Api\Resource
 */
class Applications extends \Kingsquare\Wercker\Api\Resource
{

    /**
     * GET /api/v3/applications/:username
     *
     * @param string $username
     * @param \Kingsquare\Wercker\Api\Request\Filter\Applications|null $filter
     * @return \Kingsquare\Wercker\Api\Response\Application[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function find($username, Filter $filter = null)
    {
        $username = (string)$username;

        $this->guardAgainstInvalidUsername($username);

        return array_map([Application::class, 'fromResponse'], $this->getClient()
            ->get()
            ->addPath('applications')
            ->addPath($username)
            ->withFilter($filter)
            ->call()
        );
    }

    /**
     * GET /api/v3/applications/:username/:application
     *
     * @param string $username
     * @param string $application
     * @return \Kingsquare\Wercker\Api\Response\Application
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($username, $application)
    {
        $username = (string)$username;
        $application = (string)$application;

        $this->guardAgainstInvalidUsername($username);
        $this->guardAgainstInvalidApplicationName($application);

        return Application::fromResponse($this->client
            ->get()
            ->addPath('applications')
            ->addPath($username)
            ->addPath($application)
            ->call()
        );
    }

    /**
     * PATCH /api/v3/applications/:username/:application
     *
     * @param string $username
     * @param string $application
     * @param array $ignoredBranches
     * @return \Kingsquare\Wercker\Api\Response\Application
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($username, $application, array $ignoredBranches = [])
    {
        $username = (string)$username;
        $application = (string)$application;

        $this->guardAgainstInvalidUsername($username);
        $this->guardAgainstInvalidApplicationName($application);

        return Application::fromResponse($this->client
            ->patch()
            ->addPath('applications')
            ->addPath($username)
            ->addPath($application)
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode(['ignoredBranches' => array_slice($ignoredBranches, 0, 10)]))
            ->call()
        );
    }

    /**
     * GET /api/v3/applications/:username/:application/builds
     *
     * @param string $username
     * @param string $application
     * @param \Kingsquare\Wercker\Api\Request\Filter\Builds|null $filter
     * @return \Kingsquare\Wercker\Api\Response\Build[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBuilds($username, $application, Builds $filter = null)
    {
        $username = (string)$username;
        $application = (string)$application;

        $this->guardAgainstInvalidUsername($username);
        $this->guardAgainstInvalidApplicationName($application);

        return array_map([Build::class, 'fromResponse'], $this->client
            ->get()
            ->addPath('applications')
            ->addPath($username)
            ->addPath($application)
            ->addPath('builds')
            ->withFilter($filter)
            ->call()
        );
    }

    /**
     * @param string $username
     * @param string $application
     * @param \Kingsquare\Wercker\Api\Request\Filter\Deploys|null $filter
     * @return \Kingsquare\Wercker\Api\Response\Deploy[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDeploys($username, $application, Deploys $filter = null)
    {
        $username = (string)$username;
        $application = (string)$application;

        $this->guardAgainstInvalidUsername($username);
        $this->guardAgainstInvalidApplicationName($application);

        return array_map([Deploy::class, 'fromResponse'], $this->getClient()
            ->get()
            ->addPath('applications')
            ->addPath($username)
            ->addPath($application)
            ->addPath('deploys')
            ->withFilter($filter)
            ->call()
        );
    }

    /**
     * @param string $username
     */
    private function guardAgainstInvalidUsername($username)
    {
        if ($username === '') {
            throw new \InvalidArgumentException('Missing / empty username');
        }
    }

    /**
     * @param string $application
     */
    private function guardAgainstInvalidApplicationName($application)
    {
        if ($application === '') {
            throw new \InvalidArgumentException('Missing / empty application');
        }
    }
}
