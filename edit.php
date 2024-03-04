<?php
session_start();
require "./functions.php";

$id = $_GET["id"];

if (!isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

$detailData = query("SELECT * FROM student WHERE id = $id")[0];

if (isset($_POST["submit"])) {
   if ($_POST["nama"] !== "" && $_POST["email"] !== "" && $_POST["npm"] !== "" && $_POST["prodi"] !== "") {
         $id = $_POST["id"];
         $nama = htmlspecialchars($_POST["nama"]);
         $email = htmlspecialchars($_POST["email"]);
         $npm = htmlspecialchars($_POST["npm"]);
         $prodi = htmlspecialchars($_POST["prodi"]);
         $gambarOld = $_POST["gambarOld"];
         handleEdit($nama, $email, $gambarOld, $npm, $prodi, $id, $_FILES);
         unset($_POST);
   } else {
      echo "gagal, Masukkan field dengan lengkap";
      unset($_POST);
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <title>Ubah PHP</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="css/style.css" rel="stylesheet">
</head>

<style>
   li {
      margin: 10px 0;
   }
</style>

<body>
   <h1>Ubah Data Mahasiswa</h1>

   <form action="" method="post" style="position: relative;" enctype="multipart/form-data">
   <input type="hidden" name="gambarOld" value="<?php echo $detailData["gambar"] ?>">
   <input type="hidden" name="id" value="<?php echo $detailData["id"] ?>">
      <ul>
         <li>
            <input type="file" name="gambar">
         </li>
            <img src="img/<?php echo $detailData["gambar"] ?>" alt="/profile picture" width="40px">
         <li>
            <input type="text" value="<?php echo $detailData["nama"]?>" name="nama" placeholder="Masukkan Nama" style="padding: 5px;">
         </li>
         <li>
            <input type="email" value="<?= $detailData["email"] ?>" name="email" placeholder="Masukkan Email" style="padding: 5px;">
         </li>
         <li>
            <input type="text" name="npm" value="<?= $detailData["npm"] ?>" placeholder="Masukkan NPM" style="padding: 5px;">
         </li>
         <li>
            <input type="text" name="prodi" value="<?= $detailData["prodi"] ?>" placeholder="Masukkan Prodi" style="padding: 5px;">
         </li>
      </ul>
      <button type="submit" name="submit" style="position: absolute; left: 77px;">Enter</button>
   </form>
   <a href="./index.php">Back</a>
</body>

</html>