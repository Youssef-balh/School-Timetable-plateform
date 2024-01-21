<?php 
    if(!isset($_COOKIE['nom'])){
        header("location:emploi_index.php");
        exit ;
    }
    include("config.php");
    function getDayWeek() { // get the first day of the week
        $date = new DateTime();
        $date->modify('this week');
        $first_day_of_week= $date->format('Y-m-d');
        return $first_day_of_week;
    }
    
    function addDayByOne($first) { // next day
        $first_day_of_week = new DateTime($first);
        $new_date = $first_day_of_week->format("Y-m-d");
        $new_date= new DateTime($new_date);
        $new_date->add(new DateInterval("P1D"));
        $new_date = $new_date->format("Y-m-d");
        return $new_date;
    }
    

    function day_of_week($date) {
        $date = DateTime::createFromFormat("Y-m-d", "$date");
        return $date->format("l");
    }
   
    $fil=$_COOKIE['fil'];

   
    function addTime($time) {
        $mid = new DateTime("10:45:00");
        if ($time->format("H:i:s") == $mid->format("H:i:s")) {
            $time->add(new DateInterval("PT3H15M"));
        } else {
            $time->add(new DateInterval("PT2H15M"));
        }
        return $time->format("H:i:s");
    }

   

    function dateto_string($d) {
        $datenew = DateTime::createFromFormat("Y-m-d", $d);
        return $datenew->format("Y-m-d");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
    <style>
        nav {
            margin-bottom: 10px;
        }
        .table {
            height: 400px;
        }
        .th {
            text-align: center;
        }
    </style>
</head>
<body>
<div class='alert alert-success d-flex align-items-center' role='alert'>
    <svg class='bi flex-shrink-0 me-2' width='20' height='24' role='img' aria-label='Success:'><use xlink:href='check-circle-fill'/></svg>
      <div style='font-size: 18px;'><b>Bienvenue!! Voici Votre emploi du temps !!</b>
      </div>
    </div><br>
<table class="table">
  <thead> 
    <tr class="table-dark table-secondary">
      <th scope="col"></th>
      <th scope="col">8:30 - 10 :30</th>
      <th scope="col">10:45 - 12:45</th>
      <th scope="col">14:00- 16:00</th>
      <th scope="col">16:15 - 18:15</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $day = getDayWeek();
    $day = dateto_string($day);
    for($i=1; $i<6; $i++) {
        $time_query0 = new DateTime("08:30:00");
        $time_query = $time_query0->format("H:i:s");

        echo '<tr>';
        echo '<th scope="row">'.day_of_week($day).'</th>';
        for($j=1; $j<5;$j++) {
            $query="SELECT * FROM seance se 
            JOIN groupe grp on se.id_groupe=grp.id_groupe
            JOIN salle sal on sal.id_salle=se.id_salle
            JOIN filiere fil on fil.id_filiere = grp.id_filiere
            JOIN module modu on modu.id_module =se.id_module
            JOIN enseignant ens on ens.id_enseignant =modu.id_enseignant
            WHERE se.date='$day'
            and se.heure_deb ='$time_query'
            and fil.nom_filiere='$fil'";

            $result=mysqli_query($link,$query);
            $data = mysqli_fetch_assoc($result);
            if (!empty($data['nom_module'])) {
                echo '<th scope=row>'.$data['nom_module'].' <br>
                    M . '.$data['nom'].' '.$data['prenom'].'<br>
                    '.$data['type_salle'].'  '.$data['id_batiment'].''.$data['id_salle'].'
                    </th>';
            } else {
                echo '<th scope=row></th>';
            }
            $time_query = addTime($time_query0);
        }
        echo '</tr>';
        $day = addDayByOne($day);
        
    }
    ?>
  </tbody>
</table>
</body>
</html>