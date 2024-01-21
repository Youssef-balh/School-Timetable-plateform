<?php


use GuzzleHttp\Client;

$client = new Client();

$response = $client->get('https://www.googleapis.com/oauth2/v2/userinfo', [
    'headers' => [
        'Authorization' => "Bearer $accessToken",
    ],
]);

$userInfo = json_decode($response->getBody(), true);

?>
