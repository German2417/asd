

<?php
include('header.php');?>
 <?php if(!isset($_SESSION['admin_logged_in'])){
      header('location: login.php');
      exit();
 } ?>

 <?php


if(isset($_GET['page_no']) && $_GET['page_no'] !=""){
  $page_no = $_GET['page_no'];
}else{

  $page_no = 1;
}
$stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM fileok");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

$total_records_per_page = 5;
$offset = ($page_no-1) * $total_records_per_page;

$elozo_oldal = $page_no-1;
$kovetkezo_oldal = $page_no+1;
$adjactens="2";

$total_no_of_pages = ceil($total_records/$total_records_per_page);

$stmt2 = $conn->prepare("SELECT * FROM fileok LIMIT $offset,$total_records_per_page");
$stmt2->execute();
$kepek=$stmt2->get_result();






?>
<?php include('sidemenu.php'); ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


      <h2>Termékek</h2>
      <?php if(isset($_GET['kep_modositas_success_message'])){ ?>
      <p class="text-center" style="color: green;"><?php echo $_GET['tkep_modositas_success_message'] ?></p>
      <?php } ?>
      <?php if(isset($_GET['kep_modositas_error_message'])){ ?>
      <p class="text-center" style="color: red;"><?php echo $_GET['kep_modositas_error_message'] ?></p>
      <?php } ?>
      <?php if(isset($_GET['kep_torles_success'])){ ?>
      <p class="text-center" style="color: green;"><?php echo $_GET['kep_torles_success'] ?></p>
      <?php } ?>
      <?php if(isset($_GET['kep_torles_error'])){ ?>
      <p class="text-center" style="color: red;"><?php echo $_GET['kep_torles_error'] ?></p>
      <?php } ?>
      <?php if(isset($_GET['kep_hozzaadas_success_message'])){ ?>
      <p class="text-center" style="color: green;"><?php echo $_GET['kep_hozzaadas_success_message'] ?></p>
      <?php } ?>
      <?php if(isset($_GET['kep_hozzaadas_error_message'])){ ?>
      <p class="text-center" style="color: red;"><?php echo $_GET['kep_hozzaadas_error_message'] ?></p>
      <?php } ?>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Kép ID</th>
              <th scope="col">Kép</th>
              <th scope="col">Fájlnév</th>
              <th scope="col">Fájlelérési út</th>
              <th scope="col">Típus</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($kepek as $kep){ ?>
            <tr>
              <td><?php echo $kep['ID'] ?></td>
              <td><img src="<?php echo $kep['filepath']; ?>" style="width: 70px; height: 70px;"> <?php echo $kep['filepath'] ?></td>
              <td><?php echo $kep['filename'] ?></td>
              <td><?php echo $kep['filepath'] ?></td>
              <td><?php echo $kep['type'] ?></td>
              <td><a class="btn btn-danger" href="kep_torlese.php?ID=<?php echo $kep['ID'];?>">Törlés</a></td>
            </tr>

            <?php } ?>
          </tbody>
        </table>

        <nav aria-label="Oldal navigáció" class="mx-auto" >
                           <ul class="pagination mt-5 mx-auto">
                                 <li class="page-item">
                                 <a class="page-link" href="<?php if($page_no <= 1){ echo '#';}else{ echo "?page_no=".$page_no-1;}?>">Előző</a></li>
                                 <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                                 <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
                                 <?php if( $page_no >= 3){?>
                                 <li class="page-item"><a class="page-link" href="#">...</a></li>
                                 <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no+1;?>"><?php echo $page_no+1; ?></a></li>
                                <?php } ?>
                                 <li class="page-item"><a class="page-link" href="<?php if($page_no >= $total_no_of_pages){echo '#';}else{ echo "?page_no=".$page_no+1;}?>">Következő</a></li>
                           </ul>
                  </nav>
      </div>
    </main>
  </div>
</div>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js" integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous"></script><script src="dashboard.js"></script></body>
</html>
