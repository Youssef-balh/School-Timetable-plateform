<?php 
    include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<form method="post" action ="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
  <input type="text" name="text" required>
  <input type="submit" name="submit">
</form>

</body>
</html>

<?php 
  if(isset($_POST['submit'])) {
    if(isset($_POST['text'])) {
      $login = addslashes($_POST['text']."@uit.ac.ma");
      $requete = "INSERT INTO `utilisateur` (`id`, `login`, `type`, `photo`) VALUES (NULL, '$login', 'enseignant', '2.png')";
      $sql_exec = mysqli_query($link,$requete);
    }
  }


?>