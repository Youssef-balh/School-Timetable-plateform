<?php 
include('config.php');
$id = '1'; // bakouch mstocki id_admin f $_Session[''];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
    <style>
        form {
          width: 50%;
          margin: auto;
          margin-top: 20px;
        }

        .btn {
          margin-top: 10px;
        }
  </style>
</head>
<body>
    <form method="POST" action="#" enctype="multipart/form-data">
        <label for="ancien_pass">Ancien password :<label>
        <input type="password" name="oldmdp">
        <label for="pass">Password:</label>
        <input type="password" name="newmdp"><br>
        <input type="file" class="form-control" name="pdp"><br>
        <input type="submit" name="confirmPDPUpload" value="Modifier">    
    </form>
</body>
</html>

<?php 
    if(isset($_POST['confirmpasswrdchng'])) {
        if(isset($_POST['pass']) and isset($_POST['pass_check'])) {
            $oldmdp = addslashes($_POST['oldmdp']);
            
            $query = "SELECT * FROM admin where id_admin='$id'";
            $sql = mysqli_query($link,$query);
            
            $newmdp = addslashes($_POST['newmdp']);
            

            while($data = mysqli_fetch_assoc($sql)) {
                if (password_verify($oldmdp,$data['password'])){
                    $hash_pass = password_hash($newmdp,PASSWORD_DEFAULT);
                    $requete = "UPDATE admin SET password = '$hash_pass' WHERE id_admin= '$id'";
                    $sql = mysqli_query($link,$requete);
                }   
            }
        }
    }
    if (isset($_POST['confirmPDPUpload'])) {
        if(isset($_FILES['photo']) and $_FILES['photo']['error']==0){
		    $dossier= 'photo/';
		    $temp_name=$_FILES['photo']['tmp_name'];
		    if(!is_uploaded_file($temp_name))
		    {
		        exit("le photo est untrouvable");
		    }
		    if ($_FILES['photo']['size'] >= 1000000){
		    	exit("Erreur, le photo est volumineux");
		    }
		    $infosphoto = pathinfo($_FILES['photo']['name']);
		    $extension_upload = $infosphoto['extension'];
		    $extension_upload = strtolower($extension_upload);
		    $nom_photo="avatar.".$extension_upload;
		    if(!move_uploaded_file($temp_name,$dossier.$nom_photo)){
		        exit("Problem dans le telechargement de l'image, Ressayez");
		    }
            
        }

    }

    

?>