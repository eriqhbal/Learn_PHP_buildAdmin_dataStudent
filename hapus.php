<?php
require "./functions.php";

$id = $_GET["id"];

$getFileImagePersonal = mysqli_query($conn, "SELECT gambar FROM student
                                             WHERE npm = $id");
$getName = mysqli_fetch_assoc($getFileImagePersonal);

$nameFile = $getName["gambar"];

if (hapusData($id) > 0) {
   unlink("img/$nameFile");
   header("Location: ./index.php");
   exit;
} else {
   echo "Gagal menghapus!";
}
