<?php
/**
 * A bunch of code to display all the various calls
 */
require __DIR__ . '/../vendor/autoload.php';

use Kingsquare\Wercker\Sdk;
use Kingsquare\Wercker\Api\Request\Filter\Applications as ApplicationFilter;
use Kingsquare\Wercker\Api\Request\Filter\Runs as RunFilter;

$token = getenv('WERCKER_API_TOKEN');
if (empty($token)) {
    throw new RuntimeException('No wercker token found. Please set your token as provided by Wercker (see https:devcenter.wercker.com/development/api/authentication/');
}
// username is required for certain API calls, but only with regards to the applications endpoint
$username = getenv('WERCKER_USER');

$wercker = new Sdk($token);

// APPLICATIONS
$filter = (new ApplicationFilter())->limitBy(10);
$applications = $wercker->applications->find($username, $filter);

$application = $wercker->applications->getDeploys($username, $applications[5]);


// DEPLOYS
$deploys = $wercker->applications->getDeploys($username, $applications[0]);

// RUNS
$filter = (new RunFilter)
    ->byApplicationId($applications[0]->getId())
    ->limitBy(1);
$runs = $wercker->runs->find($filter);

// TRIGGERING A NEW RUN
//$triggeredRun = $wercker->runs->trigger(new \Kingsquare\Wercker\Api\Request\Run\Trigger($runs[0]->getPipeline()));

// Aborting A RUN
//$wercker->runs->abort($runId)

// STEPS
$steps = $wercker->runs->getSteps($runs[0]->getId());

// WORKFLOWS
$workflows = $wercker->workflows->find($applications[0]->getId());
// $workflow = $wercker->workflows->get($workflowId);
