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
<form method="POST" action="testo.php">
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
        <select name="year" class="form-control" >
          <option value="" disabled>3 année</option>
          <option value="4">4 année</option>
          <option value="5">5 année</option>
        </select>
    </div>
    
    <div id="section" style="display:block;">
      <label>Section:</label>
      <input class="form-control" type="text" name="section" pattern="[A,Z]{1}" title="Ecrire une lettre en majuscule" placeholder="A or B ..." required>
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
  <div id="hidden_section" style="display:none;">
      <label>Section:</label>
      <input class="form-control" type="text" name="section" pattern="[A,Z]{1}" title="Ecrire une lettre en majuscule" placeholder="A or B ..." required>
    </div>
</body>
<script type="text/javascript">
  function showNextInput() {
    var filiere = document.getElementById("filiere");
    var nexInput = document.getElementById("next-input");
    var section = document.getElementById("section");
    let hidden_section = document.getElementById("hidden_section").innerHTML;
    if (filiere.value === "cp1" || filiere.value === "cp2") {
      document.getElementById("section").innerHTML = hidden_section;
      nexInput.style.display = "none";
      section.style.display = "block";
    } else {
      nexInput.style.display = "block";
      section.style.display = "none";
      document.getElementById("section").innerHTML = "";
    }
  }
</script>
</html>