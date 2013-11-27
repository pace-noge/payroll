<?php
  include "../../lib/php/DB_Functions.php";

  $db = new DB_Functions();
  $db->connect();



  $postData = file_get_contents('php://input');
  $postData = json_decode($postData, true);

 $action = $postData['action'];

switch($action) {
  case "list_karyawan":
      $db->select('karyawan');
      echo json_encode($db->getResult());
      break;

  case "select_jabatan_sub":
      $db->select('jabatan');
      $hasil['jabatan'] = $db->getResult();
      $db->disconnect();
      $db->connect();
      $db->select('golongan_sub');
      $hasil['golongan_sub'] = $db->getResult();
      echo json_encode($hasil);
      break;

  case "get_last_nik":
      $db->select('karyawan', 'max(nik) as nik');
      echo json_encode($db->getResult());
      break;

  case "list_lembur":
      $db->select('lembur');
      echo json_encode($db->getResult());
      break;

   case "detail_karyawan":
      $nik = $postData['nik'];
      $db->select('karyawan', '*', "nik='".$nik."'");
      echo json_encode($db->getResult());
      break;

   case "hapus_lembur":
      $kd_lembur = $postData['kd_lembur'];
      $db->delete('lembur', "kd_lembur='".$kd_lembur."'");
      echo "dihapus ".$kd_lembur;
      echo json_encode($postData);
      break;

  case "hapus_karyawan";
      $nik = $postData['nik'];
      $hasil = $db->delete('karyawan', "nik='".$nik."'");
      if($hasil) {
        echo "Karyawan dengan nik ".$nik." telah di hapus.. dari php";
      }
}

?>
