<?php 
        for($i;$i<5;$i++){
            echo '<th scope="row">Lundi</th>';
        $query="SELECT * FROM seance se 
        JOIN groupe grp on se.id_groupe=grp.id_groupe
        JOIN salle sal on sal.id_salle=se.id_salle
        JOIN filiere fil on fil.id_filiere = grp.id_filiere
        JOIN module modu on modu.id_module =se.id_module
        JOIN enseignant ens on ens.id_enseignant =modu.id_enseignant
        WHERE se.date='2023-01-12'
        and se.heure_deb ='08:30:00'
        and fil.nom_filiere='$fil'";

        $result=mysqli_query($link,$query);
        $data=mysqli_fetch_assoc($result);


        if($data!=NULL){
        echo '<td>'.$data['nom_module'].' <br>
        M.'.$data['nom'].' '.$data['prenom'].'<br>
         '.$data['type_salle'].'  '.$data['id_batiment'].''.$data['id_salle'].'
        </td>';}
        else echo '<td> </td>';
        }


        $query="SELECT * FROM seance se 
        JOIN groupe grp on se.id_groupe=grp.id_groupe
        JOIN salle sal on sal.id_salle=se.id_salle
        JOIN filiere fil on fil.id_filiere = grp.id_filiere
        JOIN module modu on modu.id_module =se.id_module
        JOIN enseignant ens on ens.id_enseignant =modu.id_enseignant
        WHERE se.date='2023-01-12'
        and se.heure_deb ='10:45:00'
        and fil.nom_filiere='$fil'";

        $result=mysqli_query($link,$query);
        $data=mysqli_fetch_assoc($result);


        if($data!=NULL){
        echo '<td>'.$data['nom_module'].' <br>
        M.'.$data['nom'].' '.$data['prenom'].'<br>
         '.$data['type_salle'].'  '.$data['id_batiment'].''.$data['id_salle'].'
        </td>';}
        


        $query="SELECT * FROM seance se 
        JOIN groupe grp on se.id_groupe=grp.id_groupe
        JOIN salle sal on sal.id_salle=se.id_salle
        JOIN filiere fil on fil.id_filiere = grp.id_filiere
        JOIN module modu on modu.id_module =se.id_module
        JOIN enseignant ens on ens.id_enseignant =modu.id_enseignant
        WHERE se.date='2023-01-12'
        and se.heure_deb ='14:00:00'
        and fil.nom_filiere='$fil'";

        $result=mysqli_query($link,$query);
        $data=mysqli_fetch_assoc($result);


        if($data!=NULL){
        echo '<td>'.$data['nom_module'].' <br>
        M.'.$data['nom'].' '.$data['prenom'].'<br>
         '.$data['type_salle'].'  '.$data['id_batiment'].''.$data['id_salle'].'
        </td>';}
        else echo '<td> </td>';



        $query="SELECT * FROM seance se 
        JOIN groupe grp on se.id_groupe=grp.id_groupe
        JOIN salle sal on sal.id_salle=se.id_salle
        JOIN filiere fil on fil.id_filiere = grp.id_filiere
        JOIN module modu on modu.id_module =se.id_module
        JOIN enseignant ens on ens.id_enseignant =modu.id_enseignant
        WHERE se.date='2023-01-12'
        and se.heure_deb ='16:15:00'
        and fil.nom_filiere='$fil'";

        $result=mysqli_query($link,$query);
        $data=mysqli_fetch_assoc($result);


        if($data!=NULL){
        echo '<td>'.$data['nom_module'].' <br>
        M.'.$data['nom'].' '.$data['prenom'].'<br>
         '.$data['type_salle'].'  '.$data['id_batiment'].''.$data['id_salle'].'
        </td>';
}

 ?>