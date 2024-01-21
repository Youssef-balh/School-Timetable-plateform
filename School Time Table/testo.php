<?php
include("config.php");
if(isset($_POST['submit'])) {
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
              $check = "SELECT * FROM groupe g WHERE g.id_filiere = '$key' and g.id_semestre = '$value' and g.type = '$type_seance'";
              $sql_check = mysqli_query($link,$check);
              if (mysqli_num_rows($sql_check) > 0) {  
                  echo $error;
              } else {
                  $insertion = "INSERT INTO `groupe` (`id_groupe`, `id_filiere`, `id_semestre`, `type`, `effectif`, `section`) VALUES (NULL, '$key', '$value', '$type_seance', '$effectif', '$section')";
                  $sql_exec = mysqli_query($link,$insertion);
              }
            }   
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
              $check = "SELECT * FROM groupe g WHERE g.id_filiere = '$key' and g.id_semestre = '$value' and g.type = '$type_seance'";
              $sql_check = mysqli_query($link,$check);
              if ($sql_check->num_rows) {  
                  echo $error;
              } else {
                  $insertion = "INSERT INTO `groupe` (`id_groupe`, `id_filiere`, `id_semestre`, `type`, `effectif`, `section`) VALUES (NULL, '$key', '$value', '$type_seance', '$effectif', '')";
                  $sql_exec = mysqli_query($link,$insertion);
              }
            }
          }
        }
        
    } else {
        $error = "erreur";
    }
    header('location:dashboardd.php');
?> 
