<?php

namespace Kingsquare\Wercker\Api\Resource;

use Kingsquare\Wercker\Api\Header\ContentType;
use Kingsquare\Wercker\Api\Request\Run\Trigger;
use Kingsquare\Wercker\Api\Response\Run;
use Kingsquare\Wercker\Api\Response\Step;

class Runs extends \Kingsquare\Wercker\Api\Resource
{

    /**
     * GET /api/v3/runs
     *
     * @param \Kingsquare\Wercker\Api\Request\Filter\Runs $filter
     * @return \Kingsquare\Wercker\Api\Response\Run[]
     */
    public function find(\Kingsquare\Wercker\Api\Request\Filter\Runs $filter = null)
    {
        $this->guardAgainstInvalidFilter($filter);
        $result = $this->client
            ->get()
            ->addPath('runs')
            ->withFilter($filter)
            ->call();
        if (empty($result)) {
            return [];
        }
        if (!is_numeric(key($result))) {
            $result = [$result];
        }
        return array_map([Run::class, 'fromResponse'], $result);
    }

    /**
     * GET /api/v3/runs/:run
     *
     * @param string $runId
     * @return \Kingsquare\Wercker\Api\Response\Run
     */
    public function get($runId)
    {
        return Run::fromResponse($this->client
            ->get()
            ->addPath('runs')
            ->addPath($runId)
            ->call());
    }

    /**
     * GET /api/v3/runs/:runId/steps
     *
     * @param string $runId
     * @return array
     */
    public function getSteps($runId)
    {
        return array_map([Step::class, 'fromResponse'], $this->client
            ->get()
            ->addPath('runs')
            ->addPath($runId)
            ->addPath('steps')
            ->call());
    }

    /**
     * POST /api/v3/runs/
     *
     * @param \Kingsquare\Wercker\Api\Request\Run\Trigger $payload
     * @return \Kingsquare\Wercker\Api\Response\Run
     */
    public function trigger(Trigger $payload)
    {
        return Run::fromResponse($this->client
            ->post()
            ->addPath('runs')
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($payload))
        );
    }

    // PUT /api/v3/runs/:runId/abort
    public function abort($runId)
    {
        return Run::fromResponse($this->client
            ->put()
            ->addPath('runs')
            ->addPath($runId)
            ->addPath('abort')
        );
    }

    private function guardAgainstInvalidFilter(\Kingsquare\Wercker\Api\Request\Filter\Runs $filter)
    {
        if (!$filter->isValid()) {
            throw new \InvalidArgumentException('Must have atleast a application or pipeline to filter by');
        }
    }
}
