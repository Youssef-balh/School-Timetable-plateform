<!DOCTYPE html>
<?php 
include('config.php');

$errors = "";
if (isset($_POST['submit'])) {
    if (isset($_POST['batiment'])) {
        $batiment = addslashes($_POST['batiment']);
        $requete = "INSERT INTO `batiment` (`id_batiment`) VALUES ('$batiment')";
        $sql = mysqli_query($link,$requete);
        if (!$sql) {
            $errors = $batiment."Déja existe";
        }else {
            echo "modification avec succés!!";
        }
    } else {
        $errors = "Veuillez entrer nom de batiment";
    }
}
print_r($_POST);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="#">
        <label>Ajouter Batiment: </label>
        <input type="text" name="batiment" pattern="[A-Z]{1}" title="Ecrire une lettre en majuscule" required><span style="color:red"><?php if(isset($errors)) { echo $errors;} ?></span>
        <input type="submit" name="submit">
    </form>
    
</body>
</html>