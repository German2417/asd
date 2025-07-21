<?php include('header.php'); ?>



<?php


include('server/connection.php');

if(isset($_SESSION['admin_logged_in'])){
   header('location: index.php');
   exit;

}

if(isset($_POST['bejelentkezesgomb'])){


   $email = $_POST['email'];
   $jelszo = md5($_POST['jelszo']);

   $stmt = $conn->prepare('SELECT admin_id, admin_nev, admin_email, admin_jelszo FROM admins WHERE admin_email=? AND admin_jelszo=? LIMIT 1');

   $stmt->bind_param('ss',$email,$jelszo);

   if($stmt->execute()){
      $stmt->bind_result($admin_id, $admin_nev, $admin_email, $admin_jelszo);
      $stmt->store_result();

      if($stmt->num_rows() == 1){

         $stmt->fetch();
         $_SESSION['admin_id'] = $admin_id;
         $_SESSION['admin_nev'] = $admin_nev;
         $_SESSION['admin_email'] = $admin_email;
         $_SESSION['admin_logged_in'] = true;

         header('location: index.php?login_success=Bejelentkezés sikeres');
      }else{

         header('location: login.php?error=Nincs felhasználó ilyen adatokkal');


      }

   }else{
      //error
      header('location: login.php?error=Valami hiba történt');
   }

}

?>
<section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
                <h2 class="form-weight-bold">Bejelentkezés</h2>
                <hr class="mx-auto">
        </div>
    <div class="mx-auto container">
        <form id="login-form" enctype="multipart/form-data" method="POST" action="login.php">
            <p style="color: red"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
            <div class="form-group mt-2">
                <label>Email</label>
                <input type="email" class="form-control" id="Neve" name="email" placeholder="Email" required>
            </div>
            <div class="form-group mt-2">
                <label>Jelszó</label>
                <input type="password" class="form-control" id="Leiras" name="jelszo" placeholder="Jelszó" required>
            </div>
            <div class="form-group mt-3">
                <input type="submit" class="btn btn-primary" name="bejelentkezesgomb" value="Bejelentkezés">
            </div>
        </form>
</section>
    </div>
   </body>
</html>