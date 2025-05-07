<?php session_start(); 
include('server/connection.php'); ?>
<?php include('assets/header.php'); ?>
<section id="index-gallery" class="wrapper-gallery">
    <div class="gallery-container">
        <?php
        $query = "SELECT * FROM fileok WHERE type = 'brand' ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $filepath = $row['filepath'];
                echo "<div class='gallery-item'>";
                echo "<img src='$filepath' alt='Brand fotó' />";
                echo "</div>";
            }
        } else {
            echo "<p>No images found.</p>";
        }
        ?>
    </div>
</section>
<?php include('assets/footer.php'); ?>
</body>
</html>