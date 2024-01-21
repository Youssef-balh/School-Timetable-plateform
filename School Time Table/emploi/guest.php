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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Alkalami&family=Cinzel&family=Inter+Tight&family=Satisfy&display=swap');
        body{
            background-image: url('../ph.jpg');
            background-repeat: no-repeat;

        }
        form {
            font-family: 'Inter Tight', sans-serif;
          width: 40%;
          margin: auto;
          margin-top: 140px;
          display: flex;
          flex-direction: column;
          background-color: rgba(247, 237, 226, 0.75);
          border-radius: 12px;
          padding: 30px;
          backdrop-filter: blur(5px);   
        }
        .btn {
          margin-top: 10px;
        }
        header{
            height: 80px;
            background-color:#457b9d ;
            display: flex;
            justify-content: space-between;
          backdrop-filter: blur(5px);   
            
        }
        .conn-guest{
            padding-left: 20px;
            padding-top: 15px;
            margin-left: 10px;
            color: whitesmoke;
            font-family: 'Inter Tight', sans-serif;
        }
        .login{
            display: flex;
            font-family: 'Inter Tight', sans-serif;
            padding: 22px;
            background-color:rgba(253, 126, 20, 0.78) ;
            margin-right: 20px;
            border-radius: 12px;
            flex-direction: column;
            justify-content: center;
            margin: 8px;
        }
        .login:hover{
            box-shadow:2px 2px black;
        }
        .login a{
            text-decoration: none;
            color: white;
        }
  </style>
</head>
<body>
<header>
        <div class="conn-guest">
            <h1>Connexion en tant qu'invité</h1>
        </div>
        <div class="login">
            <a href="#">Login</a>
        </div>
</header>
<form method="POST" action="emploi_index.php">
<label for="nom">Votre Nom :</label>
    <input type="text" class="form-control" placeholder="Nom" name="nom" required>
    <label for="filiere"></label>
    <label for="Filiere">Filiere</label>
        <select name="filiere" class="form-control" id="filiere" onchange="showNextInput()">
            <?php
            $sql = "SELECT DISTINCT nom_filiere FROM filiere";
            $result = mysqli_query($link, $sql);
            while ($data = mysqli_fetch_assoc($result)) {
                $filiere = $data['nom_filiere'];
                echo "<option value='$filiere'>";
                echo $filiere;
                echo '</option>';
            }
            ?>
    </select>
    <div id="cp1" style="display:block;">
      <label for="cp1">Semestre</label>
        <select name="cp1" class="form-control">
          <option value="1">S1</option>
          <option value="2">S2</option>
        </select>
    </div>
    <div id="cp2" style="display:none;">
      <label for="cp2">Semestre</label>
        <select name="cp2" class="form-control">
          <option value="3">S3</option>
          <option value="4">S4</option>
          </select>
    </div>
    <div id="ci" style="display:none;">
      <label for="ci">Semestre</label>
        <select name="ci" class="form-control">
          <option value="5">S5</option>
          <option value="6">S6</option>
          <option value="7">S7</option>
          <option value="8">S8</option>
          <option value="9">S9</option>
          <option value="10">S10</option>
        </select>
    </div>
    <br>
    <div id=""></div>
    <input class="btn btn-primary" type="submit" name="submit" value="Chercher">
  </form>
</body>
<?php 
    if(isset($_POST['submit'])){
        $nom=$_POST['nom'];
        $nom=addslashes($nom);
        $fil=$_POST['filiere'];
        if($_POST['filiere']=='cp1'){
            $sem=$_POST['cp1'];
            setcookie('nom', $nom, time() + (86400 ), "/"); 
            setcookie('sem', $sem, time() + (86400 ), "/"); 
            setcookie('fil', $fil, time() + (86400 ), "/"); 
        }
        else if ($_POST['filiere']=='cp2'){
            $sem=$_POST['cp2'];
            setcookie('nom', $nom, time() + (86400 ), "/"); 
            setcookie('sem', $sem, time() + (86400 ), "/"); 
            setcookie('fil', $fil, time() + (86400 ), "/"); 
        }
        else {
            $sem=$_POST['ci'];
            setcookie('nom', $nom, time() + (86400 ), "/"); 
            setcookie('sem', $sem, time() + (86400 ), "/"); 
            setcookie('fil', $fil, time() + (86400 ), "/"); 
        }
        header("location:emploidetemps.php");
    }
?>
<script type="text/javascript">
  function showNextInput() {
    var filiere = document.getElementById("filiere");
    var cp1 = document.getElementById("cp1");
    var cp2 = document.getElementById("cp2");
    var ci = document.getElementById("ci");
    if (filiere.value === "cp1") {
      cp1.style.display = "block";
      cp2.style.display = "none";
      ci.style.display = "none";

    } else if(filiere.value === "cp2") {
      cp2.style.display = "block";
      cp1.style.display = "none";
      ci.style.display = "none";
    } else {
      cp2.style.display = "none";
      cp1.style.display = "none";
      ci.style.display = "block";
    }
  }
  
</script>
</html>
