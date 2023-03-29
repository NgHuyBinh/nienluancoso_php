<?php
require_once '../../config/config.php';
if (isset($_SESSION['idsv'])) {
    if (isset($_GET['thu']) && isset($_GET['buoi']) && isset($_GET['phong']) && isset($_GET['idsv'])) {
        $thu = $_GET['thu'];
        $buoi = $_GET['buoi'];
        $phong = $_GET['phong'];
        $idsv = $_GET['idsv'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $d = date('Y-m-d');
        // Fix lỗi SQL Injection
        $thu = str_replace('\' ', '\\\' ', $thu);
        $buoi = str_replace('\' ', '\\\' ', $buoi);
        $phong = str_replace('\' ', '\\\' ', $phong);
        // Kiểm tra thứ,buổi,phòng có hợp lệ không
        $sql = "SELECT * FROM lichphong where thu='$thu' and buoi='$buoi' and phong='$phong'";
        $res = mysqli_query($conn,$sql);
        $thongbao=0;
        if(mysqli_num_rows($res) ==0){//Thông báo lỗi
            $thongbao = 1;
        }else{
            $id_lichphong = '';
            $soluong=0;
            while($rows = mysqli_fetch_array($res)){
                $id_lichphong = $rows['id'];
                $soluong = $rows['songuoitoida']-$rows['songuoihientai'];
            }
            if($soluong==0){
                $thongbao = 2;
            }else{
                $sql = "SELECT * FROM bandangky where id_sinhvien = $idsv";
                $res = mysqli_query($conn,$sql);
                if(mysqli_num_rows($res)==0){
                    $sql = "INSERT INTO `bandangky`(`id_lichphong`, `id_sinhvien`, `ngaydangky`, `kiemtra`) 
                    VALUES ($id_lichphong,$idsv,'$d','0')";
                    mysqli_query($conn,$sql);
                }else{
                    $sql = "UPDATE `bandangky` 
                    SET `id_lichphong`=$id_lichphong,`ngaydangky`='$d',ghichu='',kiemtra=0
                    WHERE id_sinhvien = $idsv
                    ";
                    mysqli_query($conn,$sql);
                    $sql = "UPDATE `sinhvien` 
                    SET `trangthai`=0
                    WHERE id = $idsv
                    ";
                    mysqli_query($conn,$sql);
                }
                
            }
            
        }echo $thongbao;
        


    }else{
        header('location: ../index.php');
        die();
    }
} else {
    header('location: ../index.php');
    die();
}

?>