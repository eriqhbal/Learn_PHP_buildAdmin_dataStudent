<?php
require "../functions.php";

$keyword = $_GET["keyword"];

$mahasiswa = query("SELECT * FROM student
                        WHERE nama LIKE '%$keyword%' OR npm LIKE '%$keyword%'");
?>

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