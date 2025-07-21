<?php
include('server/connection.php');
$target_dir1 = "../weboldal/uploads/";
$target_dir2 = "uploads/";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tipus'])) {
        $tipus = $_POST['tipus'];
    } else {
        $tipus = '';
    }

    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $filename = basename($_FILES['file']['name']);
        $target_file1 = $target_dir1 . $filename;
        $target_file2 = $target_dir2 . $filename;

        // Move the file to the first directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file1)) {
            // Copy the file to the second directory
            if (copy($target_file1, $target_file2)) {
                $sql = "INSERT INTO fileok (filename, filepath, type) VALUES ('$filename', '$target_file2', '$tipus')";
                if ($conn->query($sql) === TRUE) {
                    echo "A Fájl sikeresen feltöltve és elmentve az adatbázisba.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                error_log("Failed to copy file from $target_file1 to $target_file2");
                echo "Valami hiba történt a fájl másolásakor.";
            }
        } else {
            error_log("Failed to move uploaded file to $target_file1");
            echo "Valami hiba történt a fájl feltöltésekor.";
        }
    } else {
        error_log("File upload error: " . $_FILES['file']['error']);
        echo "Nem lett semmi sem feltöltve, valami hiba történt.";
    }
}
$conn->close();
?>
<?php
    include('header.php');
?>
 <?php if(!isset($_SESSION['admin_logged_in'])){
      header('location: login.php');
      exit();
 } ?>
<?php include('sidemenu.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(33, 37, 41);
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        .form-group input[type="file"] {
            display: block;
            margin-top: 5px;
            font-size: 16px;
            padding: 10px;
            width: calc(100% - 20px);
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
        }

        .form-group select {
            display: block;
            margin-top: 5px;
            font-size: 16px;
            padding: 10px;
            width: calc(100% - 20px);
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
        }

        .form-group .btn {
            margin-top: 10px;
            padding: 10px 20px;
            font-size: 18px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group .btn:hover {
            background-color: #45a049;
        }

        .form-group .btn-reset {
            background-color: #f44336;
        }

        .form-group .btn-reset:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="form-title">Fájlfeltöltés</h2>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="form-group" style="color: black">
                <label for="file">Válassza ki a fájlt:</label>
                <input type="file" name="file" id="file" accept=".jpg, .png, .jpeg" required>
            </div>
            <div class="form-group" style="color: black">
                <label for="tipus">Válassza ki a fotó típusát:</label>
                <select name="tipus" id="tipus" style="color: black">
                    <option value="eskuvoi">Esküvői</option>
                    <option value="portre">Portré</option>
                    <option value="brand">Brand/Business</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Feltöltés">
                <input type="reset" class="btn btn-reset" value="Törlés">
            </div>
        </form>
    </div>
</body>
</html>
