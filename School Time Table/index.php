<?php 
session_start();
if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['type'] == 'enseignant')) {
    header('location: dashboard_enseignant.php');
    exit;
}
if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true) && ($_SESSION['type'] == 'admin')) {
    header('location: dashboard_admin.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="css/login_page.css" />
</head>
<body>
    <h1>Hello </h1>
    
    
    <?php
    if(isset($_SESSION['error'])) {
        echo $_SESSION['error'];
    }
    ?>

    <a href="oAuth.php">Se connecter</a>
</body>
</html>