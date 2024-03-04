<?php 
require "./functions.php";

if (isset($_POST["submitButton"])) {
   if (registrasi($_POST) > 0) {
      echo "<script>
            alert('User Berhasil Didaftarkan');
         </script>";
         header("Location: index.php");
         exit;
   } else {
      echo "<script>
            alert('User Gagal Didaftarkan');
         </script>";
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <title>Register Admin</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="css/style.css" rel="stylesheet">

   <style>
      label {
         display: block;
      }
      li {
         margin: 5px 0;
      }
   </style>
</head>

<body>

   <h1>Register User</h1>
   <form action="" method="post">
      <ul>
         <li>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Masukkan Username" style="padding: 5px;">
         </li>
         <li>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Masukkan Password" style="padding: 5px;">
         </li>
         <li>
            <label for="confirmPass">Konfirmasi Password</label>
            <input type="password" name="confirmPass" id="confirmPass" placeholder="Konfirmasi Password" style="padding: 5px;">
         </li>
      </ul>
      <button type="submit" name="submitButton" style="padding: 5px; margin-left: 90px;">Register</button>
   </form>
</body>

</html>