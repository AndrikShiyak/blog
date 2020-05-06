<?php
require_once('configDB.php');
session_start();
$_SESSION['IdRecord'] = $_POST['IdRecord'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = mysqli_connect(servername, username, password, dbname);   
        if (!$conn) {
            die('Помилка при підключенні до БД.' . mysqli_connect_error());
        }
        
        $sql = "INSERT INTO comment(IdRecord,IdAutor,Text) VALUES ('".$_POST['IdRecord']."','".$_POST['IdAutor']."','".$_POST['Text']."')";        
        $result = mysqli_query($conn,$sql);
        
           
    }
?>

