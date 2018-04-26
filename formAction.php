<?php
require_once("functions.php");
session_start();
header('Content-Type: text/html; charset=utf-8');

global $CLIENT_ID, $CLIENT_SECRET, $REDIRECT_URI;

$client = new Google_Client();
$client->setClientId($CLIENT_ID);
$client->setClientSecret($CLIENT_SECRET);
$client->setRedirectUri($REDIRECT_URI);
$client->setScopes('email');

$authUrl = $client->createAuthUrl();
$credentials = getCredentials($_GET['code'], $authUrl);

$client->setAccessToken($credentials);

$service = new Google_Service_AdSense($client);
$accounts =  $service->accounts->listAccounts();
$exampleAccountId = $accounts[0]['id']; // por ejemplo: pub-358XXX9598273364

$startDate = '2018-01-01';
$endDate = '2018-02-15';

$optParams = array(
    'metric' => array('INDIVIDUAL_AD_IMPRESSIONS', 'EARNINGS'),
    'dimension' => 'DATE',
    // 'filter' => array('AD_UNIT_ID==ca-pub-5035025648894332:3442683203'),
    'useTimezoneReporting' => true
);

$report = $service->accounts_reports->generate($exampleAccountId, $startDate, $endDate, $optParams);

print_r($report);