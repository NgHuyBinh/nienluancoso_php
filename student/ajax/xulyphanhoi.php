<?php
require_once '../../config/config.php';
if (isset($_SESSION['idsv'])) {
    if (isset($_GET['noidung'])) {
        $idsv = $_SESSION['idsv'];
        $noidung = $_GET['noidung'];
        $sql = "SELECT lichphong.id FROM `sinhvien`,bandangky,lichphong WHERE sinhvien.id=$idsv  and sinhvien.id = bandangky.id_sinhvien and bandangky.id_lichphong = lichphong.id ";
        $res = mysqli_query($conn,$sql);
        $id_lichphong = '';
        if($res==true){
            while($rows = mysqli_fetch_array($res)){
                $id_lichphong = $rows['id'];
            }
        }
        $sql = "INSERT INTO `phanhoi`( `id_sv`, `id_lichphong`, `noidung`) VALUES ($idsv,$id_lichphong,'$noidung')";
        $res = mysqli_query($conn,$sql);
        if($res == true){
            echo 1;
        }
        
    } else {
        header('location: ../index.php');
        die();
    }
} else {
    header('location: ../index.php');
    die();
}

?>