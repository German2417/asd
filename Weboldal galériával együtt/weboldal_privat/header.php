<?php
session_start();

include('server/connection.php');

if(isset($_GET['logout'])){

   if(isset($_SESSION['admin_logged_in'])){
       unset($_SESSION['admin_logged_in']);
       unset($_SESSION['admin_felhasznalo_nev']);
       unset($_SESSION['admin_felhasznalo_email']);
       header('location: login.php');
       exit;
   }
 }



?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
  <head><script src="assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lencsevégen</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">

    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">



    
    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
  </head>
  <body>

    


<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="index.php">Lencsevégen</a>
  <?php if(isset($_SESSION['admin_logged_in'])) { ?>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="logout.php?logout=1">
                Kijelentkezés
              </a>
            </li>
            <?php } ?>


</header>