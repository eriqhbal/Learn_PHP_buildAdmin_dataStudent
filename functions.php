<?php

$conn = mysqli_connect("localhost", "root", "", "mahasiswa");

// Method Read
function query($query)
{
   global $conn;
   $result = mysqli_query($conn, $query);

   $rows = [];
   while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
   }

   return $rows;
}

// Method Create
function queryInsert($nama, $email, $npm, $prodi, $dataImage)
{
   global $conn;

   $gambar = handleUploadImage($dataImage);

   if ($gambar) {
      try {
         $data = "INSERT INTO student(nama, email, npm, prodi, gambar)
            VALUES ('$nama', '$email', '$npm', '$prodi', '$gambar')";

         $result = mysqli_query($conn, $data);
         var_dump($result);

         if ($result) {
            header("Location: ./index.php");
            return exit;
         }
      } catch (mysqli_sql_exception $e) {
         var_dump($e);
         exit;
      }
   } else {
      echo "<script>
               alert('Gagal Menambahkan data!');
           </script>";
   }
}

function handleUploadImage($dataImage)
{
   var_dump($dataImage);

   $nameImage = $dataImage["gambar"]["name"];
   $sizeImage = $dataImage["gambar"]["size"];
   $tmpNameImage = $dataImage["gambar"]["tmp_name"];

   // Handle Type File Gambar
   $ekstensiImage = ['jpg', 'jpeg', 'png'];
   $searchFormatImage = explode(".", $nameImage);
   $getFormat = strtolower(end($searchFormatImage));

   if (!in_array($getFormat, $ekstensiImage)) {
      echo "<script>
               alert('Format Tidak sesuai!');
           </script>";
      return false;
   }

   // Handle Size Gambar
   if ($sizeImage > 1000000) {
      echo "<script>
               alert('Format Gambar Terlalu besar!');
           </script>";
      return false;
   }

   $namaFileBaru = uniqid();
   $namaFileBaru .= '.';
   $namaFileBaru .= $getFormat;

   move_uploaded_file($tmpNameImage, 'img/' . $namaFileBaru);

   return $namaFileBaru;
}

// Method Update
function handleEdit($nama, $email, $gambarOld, $npm, $prodi, $id, $dataImageNew)
{
   global $conn;
   if ($dataImageNew["gambar"]["error"] === 4) {
      $gambar = $gambarOld;
   } else if ($dataImageNew["gambar"]["error"] === 0) {
      $gambar = handleUploadImage($dataImageNew);
   }

   try {
      $data = "UPDATE student 
               SET nama = '$nama',
                   email = '$email',
                   gambar = '$gambar',
                   npm = '$npm',
                   prodi = '$prodi'
               WHERE id = '$id'";

      $result = mysqli_query($conn, $data);
      var_dump($result);

      if ($result) {
         header("Location: ./index.php");
         return exit;
      }
   } catch (mysqli_sql_exception $e) {
      var_dump($e);
      exit;
   }
}

// Method Delete
function hapusData($id)
{
   global $conn;
   mysqli_query($conn, "DELETE FROM student WHERE npm = $id");
   return mysqli_affected_rows($conn);
}

// Method Register
function registrasi($data)
{
   global $conn;

   $username = strtolower(stripslashes($data["username"]));
   $password = mysqli_real_escape_string($conn, $data["password"]);
   $confirmPass = mysqli_real_escape_string($conn, $data["confirmPass"]);

   // Jika Field Kosong
   if ($data["username"] === "" || !$data["password"] || !$data["confirmPass"]) {
      echo "<script>
               alert('Field tidak boleh kosong!');
            </script>";
      return false;
   }

   // Jika username sudah ada
   $checkName = mysqli_query($conn, "SELECT * FROM user WHERE name = '$username'");
   $ifExistName = mysqli_fetch_assoc($checkName);

   if ($ifExistName) {
      echo "<script>
               alert('Username Sudah digunakan!');
            </script>";
      return false;
   }

   // Jika Password tidak sama dengan konfirmasi
   if ($password !== $confirmPass) {
      echo "<script>
               alert('Password Tidak sama!');
            </script>";
      return false;
   }

   $hashPassword = password_hash($password, PASSWORD_DEFAULT);

   mysqli_query($conn, "INSERT INTO user(name, password)
                        VALUES ('$username', '$hashPassword')");

   return mysqli_affected_rows($conn);
}
