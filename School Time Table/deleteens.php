
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
<?php 
    include("config.php");
    $query="SELECT * FROM enseignant ens JOIN utilisateur uti on ens.id_utilisateur = uti.id"; 
    $result =mysqli_query($link,$query);
    while($data=mysqli_fetch_assoc($result)){
        $id_uti = $data['id_utilisateur'];
        echo $id_uti;
        if($data['charge']!=NULL){
            $data['charge']=number_format($data['charge'], 2);
            echo 'La Charge Horaire de MR '.$data['nom'].' '.$data['prenom'].' est : '.$data['charge'].'h ';
        }else {
            echo 'La Charge Horaire de MR '.$data['nom'].' '.$data['prenom'].' est : 0h ';
        }
        ?>
        <form action="#" method="post">
            <button class="ghost-button" type="submit" name="remove" value="<?php echo $id_uti;?>"><i class="sidebar-svg-profile align-middle" data-feather="x-circle" onclick="return confirm('Voulez vous vraiment supprimer l\'enseignant?')"></i></button>
        </form>
        <?php
        echo "<br><br>";
    }

?>
<pre>
    <?php print_r($_POST); ?>
</pre>
</body>
</html>

<?php 
    if(isset($_POST['remove'])) {
        $id_utilisateur = $_POST['remove'];
        $requete = "DELETE FROM utilisateur WHERE id = '$id_utilisateur'";
        $sql = mysqli_query($link,$requete);
        if($sql) {
            header('location: deleteens.php');
        }
    }


?>