<?php

/**
 * A hacked togehter script to make sure all wercker apps have their respective git-push-webhooks installed
 * @see https://devcenter.wercker.com/supplementary-information/faqs/bitbucket-support-changes/
 */
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use Kingsquare\Wercker\Sdk;
use Kingsquare\Wercker\Api\Request\Filter\Applications as ApplicationFilter;

require __DIR__ . '/../vendor/autoload.php';

$token = getenv('WERCKER_API_TOKEN');
if (empty($token)) {
    throw new RuntimeException('No wercker token found. Please set your token as provided by Wercker (see https:devcenter.wercker.com/development/api/authentication/');
}

$wercker = new Sdk($token);
$applications = $wercker->applications->find('', (new ApplicationFilter())->limitBy(300));
$bitbucket = new GuzzleHttp\Client([
    'base_uri' => 'https://api.bitbucket.org/2.0/repositories/',
    // add your 'auth' => [username, password] here!
    'headers' => [
        'User-Agent' => 'kingsquare/wercker-sdk',
        'Accept' => 'application/json',
    ]
]);

foreach ($applications as $application) {
    // v2 includes the pushKey which wercker hasnt included in the v3 API (yet)
    $v2Details = $wercker->v2->get()->addPath('applications')->addPath($application->getId())->call();
    if (empty($v2Details['pushKey']) || strpos($v2Details['url'], 'bitbucket') === false) {
        echo ' ☠ ' . $application->getName(). '('.$application->getUrl().'): v2 failed with empty pushkey or without bitbucket url ?' . PHP_EOL;
        continue;
    }

    $hookUrl = 'https://app.wercker.com/commits/' . $v2Details['pushKey'];

    // crummy but works
    list (, $repo_slug) = explode(':', $v2Details['url']);
    list ($owner, $repo) = explode('/', $repo_slug);
    $repo = pathinfo($repo, PATHINFO_FILENAME);
    $appName = $owner . '/' . $application->getName();
    $bitbucketPath = $owner . '/' . $repo . '/hooks';
    try {
        $hooks = json_decode($bitbucket->get($bitbucketPath)->getBody(), true);
        if (!empty($hooks['values'])) {
            foreach ($hooks['values'] as $hook) {
                if (stripos($hook['url'], $hookUrl) === 0) {
                    echo ' ✔ ' . $appName . PHP_EOL;
                    continue 2;
                }
            }
        }

        $response = $bitbucket->post($bitbucketPath, [
            RequestOptions::JSON => [
                'description' => 'Wercker webhook',
                'url' => $hookUrl,
                'active' => true,
                'events' => [
                    'repo:push',
                ]
            ]
        ]);
        if ($response->getStatusCode() !== 201) {
            echo ' ☠ ' . $appName . '(' . $response->getStatusCode() . ':' . $response->getReasonPhrase() . ')' . PHP_EOL;
            continue;
        }
        echo ' ⨄ ' . $appName . PHP_EOL;
    } catch (ClientException $e) {
        if ($e->getResponse()->getStatusCode() === 403) {
            echo ' 🔒 ' . $appName . ': DENIED ' . PHP_EOL;
        }
    }
}
die('done, made with 💙 in Beverwijk');
