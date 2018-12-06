<?php

namespace Kingsquare\Wercker\Api\Resource;

use Kingsquare\Wercker\Api\Response\Workflow;

class Workflows extends \Kingsquare\Wercker\Api\Resource
{
    /**
     * GET /api/v3/runs
     *
     * @param string $applicationId
     * @param \Kingsquare\Wercker\Api\Request\Filter\Workflows $filter
     * @return \Kingsquare\Wercker\Api\Response\Run[]
     */
    public function find($applicationId, \Kingsquare\Wercker\Api\Request\Filter\Workflows $filter = null)
    {
        if ($filter === null) {
            $filter = new \Kingsquare\Wercker\Api\Request\Filter\Workflows();
        }

        return array_map([Workflow::class, 'fromResponse'], $this->client
            ->get()
            ->addPath('workflows')
            ->withFilter($filter->byApplicationId($applicationId))
            ->call());
    }

    /**
     * GET /api/v3/workflows/:workflowId
     *
     * @param string $workflowId
     * @return \Kingsquare\Wercker\Api\Response\Workflow
     */
    public function get($workflowId)
    {
        return Workflow::fromResponse($this->client
            ->get()
            ->addPath('workflows')
            ->addPath($workflowId)
            ->call());
    }
}
