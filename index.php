<?php
require_once("functions.php");
session_start();

header('Content-Type: text/html; charset=utf-8');

$authUrl = getAuthorizationUrl("640xxxx41979-68efh4dj7bka1t9la3vcrm9524t37jqo.apps.googleusercontent.com", "rnIyF9VvCe4lGhdwk-DqqZr5");
header("Location:".$authUrl);
?>