# Wercker PHP SDK

This is an unofficial PHP SDK for the [Wercker service](https:www.wercker.com)

Much of the underlying library code was derived from the [Auth0/Sdk](https://github.com/auth0/auth0-PHP)

# Installation

``` composer require kingsquare/wercker-sdk ```

# Usage

After using the composer autoloader

```php
<?php

require_once 'vendor/autoload.php';

$token = getenv('WERCKER_API_TOKEN');
if (empty($token)) {
    throw new RuntimeException('No wercker token found. Please set your token as provided by Wercker (see https:devcenter.wercker.com/development/api/authentication/');
}
// username is required for certain API calls, but only with regards to the applications endpoint
$username = getenv('WERCKER_USER');

$wercker = new \Kingsquare\Wercker\Sdk($token, ['http_errors' => false]);

// APPLICATIONS
$filter = (new \Kingsquare\Wercker\Api\Request\Filter\Applications())
    ->limitBy(1);
$applications = $wercker->applications->find($username, $filter);

// DEPLOYS
$deploys = $wercker->applications->getDeploys($username, $applications[0]->getId());

// RUNS
$filter = (new \Kingsquare\Wercker\Api\Request\Filter\Runs)
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
```
