<?php
require_once '../../config/config.php';
if (isset($_SESSION['admin'])) {
    if (isset($_GET['id']) ) {
        $id = $_GET['id'];



        $dl = '';
            
            $sql = "SELECT * FROM `lichphong`,bandangky,sinhvien,lop where sinhvien.id = bandangky.id_sinhvien and bandangky.id_lichphong = lichphong.id and lichphong.id=$id and lop.id = sinhvien.id_lop";
            $ketqua = mysqli_query($conn, $sql);
                if ($ketqua) {
                    $i = 0;
                    while ($rows = mysqli_fetch_array($ketqua)) {
                        $i++;
                        
                        $dl.= "
                            <tr>
                                <td>".$i."</td>
                                <td>".$rows['mssv']."</td>
                                <td>".$rows['hoten']."</td>
                                <td>".$rows['email']."</td>
                                <td>".$rows['sodienthoai']."</td>
                                <td>".$rows['tenlop']."</td>
                                
                            </tr>
                        ";
                    }
                }
            
        
        
        echo $dl;
        
    } else {
        header('location: ../index.php');
        die();
    }
} else {
    header('location: ../index.php');
    die();
}

?>