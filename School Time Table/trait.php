<?php 
    // Import the Google API Client Library for PHP
    require_once 'google-api-php/vendor/autoload.php';
    use Google\Client;
    use Google\Service\PeopleService;

    $apiKey = 'AIzaSyBMhYT4EUg83PmoTAnxFppj9DR1AV1PiP0';

    // Create a new Google API client
    $client = new Client();
    $client->setDeveloperKey($apiKey);

    $email = $_POST['email'];
    echo $email;

    $service = new PeopleService($client);
    $person_fields = 'names,photos';
  try {
    $profile = $service->people->get(
        'people/'.$email, array('personFields' => 'names,emailAddresses,photos'));
    $results = $service->people->get(
        'people/me',array('personFields' => $person_fields)
    );
    print_r($profile->getNames());
    
   
    
    
?>
<pre>
<?php
   print_r($results);
   print_r($profile);
} catch(Exception $e) {
    echo $e->getMessage();
}

?>

</pre>