<?php
session_start();
require "./functions.php";

if (!isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

$mahasiswa = query("SELECT * FROM student");

if (isset($_POST["oke"])) {

   if (isset($_POST["search"]) && $_POST["search"] !== "") {

      $keyword = $_POST["search"];
      $mahasiswa = query("SELECT * FROM student
                          WHERE nama LIKE '%$keyword%' OR npm LIKE '%$keyword%' 
                        ");
   } else {
      echo "Tidak Boleh Memasukkan Keyword Kosong!";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <title>Halaman Admin</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="css/style.css" rel="stylesheet">

   <style>
      .buttonTambah {
         padding: 5px;
         margin-bottom: 15px;

      }

      .buttonTambah,
      a {
         text-decoration: none;
      }

      .searchComp {
         padding: 6px;
         margin: 10px 0;
      }
   </style>
</head>

<body>
   <a href="./logout.php">Keluar</a>
   <a href="./print.php">pri</a>
   <h1>Daftar Mahasiswa</h1>
   <button type="button" class="buttonTambah">
      <a href="./tambah.php">Tambah Data</a>
   </button>
   <form action="" method="post">
      <input id="searchKey" type="text" name="search" autocomplete="off" class="searchComp" size="30px" placeholder="Masukkan Nama atau NPM">
      <button id="buttonSearch" type="submit" name="oke" style="padding: 6px;">Search</button>
   </form>
   <div id="container">
      <table border="1" cellpadding="10" cellspacing="0">
         <tr>
            <th>No</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>NPM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
         </tr>
         <?php $i = 1; ?>
         <?php foreach ($mahasiswa as $mhs) : ?>
            <tr>
               <td>
                  <?php echo $i ?>
               </td>
               <td>
                  <a href="edit.php?id=<?= $mhs["id"] ?>">Edit</a> &
                  <a href="hapus.php?id=<?php echo $mhs["npm"] ?>" onclick="return confirm('Yakin Ingin Menghapus');">Remove</a>
               </td>
               <td>
                  <img src="img/<?php echo $mhs["gambar"] ?>" alt="<?php echo $mhs["gambar"] ?>" width="50px">
               </td>
               <td>
                  <?php echo $mhs["npm"] ?>
               </td>
               <td>
                  <?php echo $mhs["nama"] ?>
               </td>
               <td>
                  <?php echo $mhs["email"] ?>
               </td>
               <td>
                  <?php echo $mhs["prodi"] ?>
               </td>
            </tr>
            <?php $i++; ?>
         <?php endforeach; ?>
      </table>
   </div>

<script src="./javascriptFile/index.js"></script>
</body>

</html>