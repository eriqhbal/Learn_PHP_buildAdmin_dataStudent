let searchKeyword = document.getElementById('searchKey');
let buttonSearch = document.getElementById('buttonSearch');
let containerDiv = document.getElementById('container');

searchKeyword.addEventListener('keyup', () => {

   let ajax = new XMLHttpRequest();

   // Cek Kesiapan AJAX
   ajax.onreadystatechange = function() {
      if (ajax.readyState === 4 && ajax.status === 200) {
         containerDiv.innerHTML = ajax.responseText;
         
      }
   }

   // Menjalankan Ajaxnya
   ajax.open(
     "GET",
     `FolderData/mahasiswa.php?keyword=${searchKeyword.value}`,
     true
   );
   ajax.send();
});