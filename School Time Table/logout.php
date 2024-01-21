<?php 
//require_once 'google-api-php/vendor/autoload.php';

session_start();
/*$client_id = "521170435745-71oq5ap5prnb2h4197bp2ri5i3k941if.apps.googleusercontent.com";
$client_secret = "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";

$client = new Google_Client();
$client->setApplicationName('My Application');
$client->setDeveloperKey($apiKey);
$client->setClientId($clientId);

$client->setAccessToken($_SESSION['access_token']);
$client->revokeToken();

*/
unset($_SESSION);


session_destroy();

exit(header('location: index.php'));
?>