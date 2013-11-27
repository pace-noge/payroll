<?php
   include "../../lib/php/DB_Functions.php";

   if(isset($_POST)) {

      $nama = $_POST['nama'];
      $tlp = $_POST['tlp'];
      $alamat = $_POST['alamat'];
      $foto = $_FILES['foto']['name'];
      $gol_sub = $_POST['gol_sub'];
      $jabatan = $_POST['jabatan'];
      $tgl_masuk = $_POST['tgl_masuk'];
      $nik = $_POST['nik'];


      if($_FILES['foto']['name']) {
         $namaFileBaru = strtolower($_FILES['foto']['tmp_name']);


         move_uploaded_file($_FILES['foto']['tmp_name'], '../foto/' .$_FILES['foto']['name']);

      } else {
        $namaFileBaru = 'default.jpg';
      }

      $db = new DB_Functions();

      $db->connect();
      $isi = $db->insert('karyawan', array($nik, $nama, $alamat, $tlp, $jabatan, $gol_sub, $tgl_masuk, '../foto/' .$_FILES['foto']['name']), 'nik,nm_karyawan,alamat, telp, kd_jbt,kd_sub, msk_krj, foto');

      if($isi) {
         echo "Success";
      } else {
        echo "gagal";
      }

     echo '<script type="text/javascript">';
     echo '  window.location="../#/karyawan";';
     echo '</script>';
   }

?>
