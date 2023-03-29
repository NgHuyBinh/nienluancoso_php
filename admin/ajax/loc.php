<?php
require_once '../../config/config.php';
if (isset($_SESSION['admin'])) {
    if (isset($_GET['phong']) ) {
        $phong = $_GET['phong'];
        $dl = '';
        $sql = "SELECT lichphong.id,lichphong.phong,lichphong.thu,lichphong.buoi,lichphong.songuoihientai,lichphong.songuoitoida FROM lichphong";
        if($phong!=""){
            $sql = "SELECT lichphong.id,lichphong.phong,lichphong.thu,lichphong.buoi,lichphong.songuoihientai,lichphong.songuoitoida FROM lichphong where phong = '$phong' "; 
        }
                $ketqua = mysqli_query($conn, $sql);
                if ($ketqua) {
                    $i = 0;
                    while ($rows = mysqli_fetch_array($ketqua)) {
                        $tt='';
                        if ($rows['songuoitoida'] - $rows['songuoihientai'] > 0) {
                            $tt= "Trống";
                        } else {
                            $tt= "Đủ";
                        }
                        $dl.= "
                            <tr>
                                <td>".$i."</td>
                                <td>".$rows['thu']."</td>
                                <td>".$rows['buoi']."</td>
                                <td>".$rows['phong']."</td>
                                <td>".$rows['songuoihientai']."</td>
                                <td>".$rows['songuoitoida']."</td>
                                <td>".$tt."</td>
                                <td>
                                <a style='font-size:1.1rem' data-id='".$rows['id']."' data-toggle='modal' data-target='#myModal1' href='' class='view'>View</a>
                                </td>
                                
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