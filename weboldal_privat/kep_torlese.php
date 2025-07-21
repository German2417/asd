<?php session_start();
include('server/connection.php');
?>
 <?php if(!isset($_SESSION['admin_logged_in'])){
      header('location: login.php');
      exit();
 } 
 
 if(isset($_GET['ID'])){
    $ID=$_GET['ID'];
    $stmt1 = $conn->prepare("DELETE FROM fileok WHERE ID=?");
    $stmt1->bind_param('i',$ID);
    if($stmt1->execute()){

    header('location: kepek.php?kep_torles_success=A kép sikeresen törölve');
    }else{
        header('location: kepek.php?kep_torles_error=A képet nem sikerült törölni');

    }
 }
 
 ?>
