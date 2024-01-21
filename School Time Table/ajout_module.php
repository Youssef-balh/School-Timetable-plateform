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
<form method="POST" action="#">
    <label for="nom">Nom module:</label>
    <input type="text" name="module" required><br>
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

    <label for="enseignant">Enseignant</label>
        <select name="enseignant" class="form-control" id="enseignant" onchange="showNextInput()">
            <?php
            $sql = "SELECT * FROM utilisateur where type= 'enseignant'";
            $result = mysqli_query($link, $sql);
            while ($data = mysqli_fetch_assoc($result)) {
                $enseignant = $data['login'];
                echo "<option>";
                echo $enseignant;
                echo '</option>';
            }
            ?>
    </select>
    <br>
    <div id=""></div>
    <input class="btn btn-info" type="submit" name="submit" value="Ajouter">
  </form>
<pre>
<?php 
if(isset($_POST['submit'])) {
  print_r($_POST);
}

?>

</pre>


</body>
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
