<?php
require_once '../../config/config.php';
if (isset($_SESSION['admin'])) {
    if (isset($_GET['mssv']) ) {
        $mssv = $_GET['mssv'];

        $dl = '';
        
                $sql = "SELECT * FROM `sinhvien`,bandangky,lichphong where sinhvien.id = bandangky.id_sinhvien and lichphong.id = bandangky.id_lichphong and mssv like '%$mssv%'";
                $ketqua = mysqli_query($conn, $sql);
                if ($ketqua) {
                    $i = 0;
                    while ($rows = mysqli_fetch_array($ketqua)) {
                        $i++;
                        $kt='';
                        $a = '';
                        if($rows['kiemtra'] ==0 ){
                            $kt= '<a style="font-size:1.1rem" href="" data-id-sinhvien="' . $rows[0] . '" data-id-ban="' . $rows[10] . '" data-id-lich="' . $rows[16] . '"  class="duyet_dk text-success">Duyệt</a>
                            <a style="font-size:1.1rem"  data-id="' . $rows[10] . '" data-id-sinhvien="' . $rows[0] . '"  class="huy_dk text-danger">Hủy</a>';
                        }
                        if($rows['kiemtra']==1){
                            $kt= "<span class='text-success' style='font-size:1.1rem'>DUYỆT</span>";
                        }
                        if($rows['kiemtra']==-1){
                            $kt= "<span class='text-danger' style='font-size:1.1rem'>HỦY</span>";
                        }
                        if($rows['ghichu'] ==''){
                            $a = 'Không';
                        }else{
                            $a = $rows['ghichu'];
                        }
                        $dl.= "
                            <tr>
                                <td>".$i."</td>
                                <td>".$rows['mssv']."</td>
                                <td>".$rows['hoten']."</td>
                                <td>".$rows['nganh']."</td>
                                <td>".$rows['thu']."</td>
                                <td>".$rows['buoi']."</td>
                                <td>".$rows['phong']."</td>
                                <td>".$kt."</td>
                                <td>".$a."</td>
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