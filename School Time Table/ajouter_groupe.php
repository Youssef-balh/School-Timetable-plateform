<?php
include "check_disc.php";
include "config.php";
$error = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <h1>Hello You are in!!</h1>
  <?php
  print_r($_SESSION);
  ?>
  <a href="logout.php">logout</a><br><br>
  <table class="table" cellpadding="2">
    <thead class="thead-dark">
      <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Email</th>
        <th>Photo</th>
      </tr>
    </thead>
    <?php
    $requete = "SELECT nom,prenom,login,photo FROM utilisateur u JOIN enseignant e ON u.id = e.id_utilisateur";
    $resultat = mysqli_query($link, $requete);
    while ($data = mysqli_fetch_assoc($resultat)) {
      $email = $data['login'];
      $nom = $data['nom'];
      $prenom = $data['prenom'];
      $photo = $data['photo'];

      echo "<tr>
            <td>$email</td>
            <td>$nom</td>
            <td>$prenom</td>
            <td><img src=\"photo/$photo\" alt=\"image\" height=50 width=50/></td>
            </tr>";
    }
    ?>
  </table>

  <form method="POST" action="dashboard.php">
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
    <div id="next-input" style="display:none;">
      <label for="year">Year</label>
        <select name="year" class="form-control">
          <option value="3">3 année</option>
          <option value="4">4 année</option>
          <option value="5">5 année</option>
        </select>
    </div>
    <div id="section" style="display:block;">
      <label>Section:</label>
      <input class="form-control" type="text" name="section" required>
    </div>
      <label>Effectif:</label>
    <input class="form-control" type="number" name="effectif" required><br>
    <label for="type">Type de groupe</label>
    <select name="type">
      <option value="cours">Cours</option>
      <option value="tp">TP</option>
      <option value="td">TD</option>
    </select>
    <br>
    <input class="btn btn-info" type="submit" name="submit" value="Ajouter">
  </form>
 

</body>
<?php
    if (isset($_POST['submit'])) {
        $error = $_POST['error'] = "";
        $effectif = $_POST['effectif'];
        $type_seance  = $_POST['type'];
        $array_diff = ['cp1','cp2'];

        if(isset($_POST['filiere'])) {
          $filiere = $_POST['filiere'];
          if (in_array($filiere,$array_diff)) {
            $section = $_POST['section'];
            $requete = "SELECT * FROM filiere where nom_filiere ='$filiere'";
            $sql = mysqli_query($link,$requete);
            $array_id = array();
            while($data = mysqli_fetch_assoc($sql)) {
              $id_filiere = $data['id_filiere'];
              $id_semestre = $data['id_semestre'];
              $array_id[$id_filiere] = $id_semestre;
            }
            foreach($array_id as $key => $value) {
              $insertion = "INSERT INTO `groupe` (`id_groupe`, `id_filiere`, `id_semestre`, `type`, `effectif`, `section`) VALUES (NULL, '$key', '$value', '$type_seance', '$effectif', '$section')";
              $sql_exec = mysqli_query($link,$insertion);
            }
            print_r($array_id);
          } 
          if (!in_array($filiere,$array_diff)) {
            $year = $_POST['year'];
            $semestre = $year*2-1;
            $semestre2 = $year*2;
            $requete = "SELECT * FROM filiere where nom_filiere ='$filiere' and (id_semestre = '$semestre' or id_semestre ='$semestre2')";
            $sql = mysqli_query($link,$requete);
            $array_id = array();
            while($data = mysqli_fetch_assoc($sql)) {
              $id_filiere = $data['id_filiere'];
              $id_semestre = $data['id_semestre'];
              $array_id[$id_filiere] = $id_semestre;
            }
            foreach($array_id as $key => $value) {
              $insertion = "INSERT INTO `groupe` (`id_groupe`, `id_filiere`, `id_semestre`, `type`, `effectif`, `section`) VALUES (NULL, '$key', '$value', '$type_seance', '$effectif', 'NULL')";
              $sql_exec = mysqli_query($link,$insertion);
            }
          }
          echo $error;
        }
        
    } else {
          echo "errror";
    }
?>
<script>
  function showNextInput() {
    var filiere = document.getElementById("filiere");
    var nexInput = document.getElementById("next-input");
    var section = document.getElementById("section");
    if (filiere.value === "cp1" || filiere.value === "cp2") {
      nexInput.style.display = "none";
      section.style.display = "block";
    } else {
      nexInput.style.display = "block";
      section.style.display = "none";
    }
  }
</script>


</html>


