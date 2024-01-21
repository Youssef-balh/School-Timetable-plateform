<?php 
session_start();
if((!isset($_SESSION['logged_in'])) or ($_SESSION['logged_in'] === false)) {
    header('location: index.php');
}
?>