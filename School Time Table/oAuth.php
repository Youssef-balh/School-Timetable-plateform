<?php
ob_start();
require_once 'google-api-php/vendor/autoload.php';
include('config.php');
use GuzzleHttp\Client;

session_start();
$_SESSION['error'] = '';

//include "check_ifconnected.php";

$client_id = "521170435745-71oq5ap5prnb2h4197bp2ri5i3k941if.apps.googleusercontent.com";
$client_secret = "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";
$url_redirect =  "http://localhost/php/OAuth2%20-%20Copie/oAuth.php";
//$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

$client = new Google\Client();
//$client->setAuthConfig('Client.json');
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($url_redirect);
$client->setAccessType('online');
$client->addScope('profile');
$client->addScope('email');


if (isset($_GET['code'])) {
    $code = $_GET['code'];
    echo $code."<br><br>";
    $token = $client->fetchAccessTokenWithAuthCode($code);
    print_r($token);
    if(!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);
        $accessToken = $token['access_token'];
        $client_request = new Client();
        $response = $client_request->get('https://www.googleapis.com/oauth2/v2/userinfo', [
            'headers' => [
                'Authorization' => "Bearer $accessToken",
            ],
        ]);
        $userInfo = json_decode((string) $response->getBody(),true);
?> 
        <pre>
            <?php 
                print_r($token);
                echo $accessToken; 
                print_r($userInfo);
                print_r($_GET);
            ?>
        </pre>
<?php 
    }
    $check_db = "SELECT * FROM utilisateur where type = 'enseignant'";
    $result = mysqli_query($link,$check_db);    
    $_SESSION['logged_in'] = false;
    while($data = mysqli_fetch_assoc($result)) {
        print_r($data);
        echo "<br><br>";
        // check for user in table utilisateur and check host domain uit.ac.ma 
        if (($data['login'] == $userInfo['email']) && ($userInfo['verified_email'] == 1) && (isset($userInfo['hd'])) && ($userInfo['hd'] == 'uit.ac.ma'))  { //
            // check if the enseignant in table enseignant . if it s not then insert it 
            $nom = strtolower($userInfo['family_name']);
            $prenom = strtolower($userInfo['given_name']);
            $picture  = $userInfo['picture'];
            $id_utilisateur = $data['id'];
            $requete_check = "SELECT * FROM enseignant where nom = '$nom' and prenom = '$prenom'";
            $sql_check = mysqli_query($link,$requete_check);
            if (mysqli_num_rows($sql_check) == 0) {
                $insert_ens = "INSERT INTO `enseignant` (`id_enseignant`, `id_utilisateur`, `nom`, `prenom`) VALUES (NULL, '$id_utilisateur', '$nom', '$prenom')";
                $sql = mysqli_query($link,$insert_ens);
                $update_phot = "UPDATE utilisateur SET photo = '$picture' WHERE id = '$id_utilisateur'";
                $sql = mysqli_query($link,$update_phot);
            }
            // create session 
            $_SESSION['id_utilisateur'] = $data['id']; 
            $_SESSION['email'] = $userInfo['email'];
            $_SESSION['logged_in'] = true;
            $_SESSION['type'] = $data['type'];
            $_SESSION['name'] = $userInfo['name'];
            $_SESSION['photo'] = $picture;
            $_SESSION['error'] = "";
            break;
            //exit(header('location: dashboard.php'));
        } else {
            $_SESSION['error']= 'Use your organization email';
            //$client->revokeToken();
            //exit(header('location: index.php'));
        }
    }
    print_r($_SESSION);
    // if error exists then revoke token if its not redirect to dashboard.php 


    // if (!empty($_SESSION['error'])) {
    //     $client->revokeToken();
    //     exit(header('location: index.php'));
    // } else {
    //     exit(header('location: dashboard.php'));
    // }
    
} else {
    // no code = new url to login in via google
    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
}

ob_end_flush();
?>
