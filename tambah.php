<?php
session_start();
require "./functions.php";

if (!isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

if (isset($_POST["submit"])) {
   if ($_POST["nama"] !== "" && $_POST["email"] !== "" && $_POST["npm"] !== "" && $_POST["prodi"] !== "") {
      if ($_FILES["gambar"]["name"] !== "") {
         $nama = htmlspecialchars($_POST["nama"]);
         $email = htmlspecialchars($_POST["email"]);
         $npm = htmlspecialchars($_POST["npm"]);
         $prodi = htmlspecialchars($_POST["prodi"]);
         queryInsert($nama, $email, $npm, $prodi, $_FILES);
      } else {
         echo "<script>
                  alert('Gambar Tidak boleh Kosong!');
               </script>";
      }

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
   <title>Tambah PHP</title>
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
   <h1>Tambah Mahasiswa</h1>

   <form action="" method="post" style="position: relative;" enctype="multipart/form-data">
      <ul>
         <li>
            <input type="file" name="gambar" placeholder="Input Gambar" style="padding: 5px;">
         </li>
         <li>
            <input type="text" name="nama" placeholder="Masukkan Nama" style="padding: 5px;">
         </li>
         <li>
            <input type="email" name="email" placeholder="Masukkan Email" style="padding: 5px;">
         </li>
         <li>
            <input type="text" name="npm" placeholder="Masukkan NPM" style="padding: 5px;">
         </li>
         <li>
            <input type="text" name="prodi" placeholder="Masukkan Prodi" style="padding: 5px;">
         </li>
      </ul>
      <button type="submit" name="submit" style="position: absolute; left: 77px;">Enter</button>
   </form>
   <a href="./index.php">Back</a>
</body>

</html>