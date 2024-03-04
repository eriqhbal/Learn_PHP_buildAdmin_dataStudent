<?php
session_start();
require "./functions.php";

if (isset($_COOKIE['loginAuto'])) {
   $code = $_COOKIE["code"];
   $id = $_COOKIE["id"];
   $getDataAssoc = mysqli_query($conn, "SELECT name FROM user
                                       WHERE id = '$code'");

   $getData = mysqli_fetch_assoc($getDataAssoc);

   if ($id === hash('sha256', $getData['name'])) {
      $_SESSION["login"] = true;
   }
}

if (isset($_SESSION["login"])) {
   header("Location: index.php");
   exit;
}

if (isset($_POST["submit"])) {
   $username = $_POST["username"];
   $password = $_POST["password"];

   if (!$username || !$password) {
      echo "<script>
               alert('Form Tidak Boleh Ada yang kosong!');
            </script>";
   } else {
      $getUser = mysqli_query($conn, "SELECT * FROM user
                        WHERE name = '$username'");

      if (mysqli_num_rows($getUser) > 0) {
         $isExist = mysqli_fetch_assoc($getUser);
         $convertPass = password_verify($password, $isExist["password"]);

         if ($convertPass) {
            header("Location: index.php");
            $_SESSION["login"] = true;

            if (isset($_POST['remember'])) {
               setcookie('loginAuto', 'true', time() + 120);
               setcookie('code', $isExist['id'], time() + 120);
               setcookie('id', hash('sha256', $isExist['name']), time() + 120);
            }
            exit;
         } else {
            echo "<script>
                alert('Username or Password salah!');
               </script>";
         }
      } else {
         echo "<script>
               alert('User Belum Terdaftar!');
            </script>";
      }
   }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <title>Login User</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="css/style.css" rel="stylesheet">

   <style>
      label {
         display: block;
      }

      .remember {
         display: inline;
      }

      li {
         margin: 4px;
      }
   </style>
</head>

<body>
   <h1>Login</h1>

   <form action="" method="post">
      <ul>
         <li>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" style="padding: 5px;" placeholder="Masukkan Username">
         </li>
         <li>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" style="padding: 5px;" placeholder="Masukkan Password">
         </li>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember" class="remember">Remember Me!</label>
      </ul>
      <button type="submit" name="submit" style="margin-left: 90px;">Enter</button>
   </form>
</body>

</html>