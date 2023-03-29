<?php
require_once '../../config/config.php';
if (isset($_SESSION['admin'])) {
    if (isset($_GET['idsv']) && isset($_GET['idbandk']) && isset($_GET['idlich']) && isset($_GET['idsv'])) {
        $idsv = $_GET['idsv'];
        $idbandk = $_GET['idbandk'];
        $idlich = $_GET['idlich'];
        // Kiểm tra lịch phòng còn trống không
        $sql = "SELECT * from lichphong where id=$idlich";
        $res = mysqli_query($conn, $sql);
        $kiemtra = 0;
        $dl = '';
        if ($res) {
            while ($rows = mysqli_fetch_assoc($res)) {
                if ($rows['songuoihientai'] == $rows['songuoitoida']) {
                    $kiemtra = 1;
                }
            }
        }
        if ($kiemtra == 1) {
            //Trường hơp này phòng đã đủ
        } else { //Trường hợp này phòng còn trống
            //Câp nhật sinh viên lên trangthai=1
            $sql = "UPDATE `sinhvien` SET `trangthai`=1 where id=$idsv";
            mysqli_query($conn, $sql);
            //Tăng số lượng trong phòng
            $sql = "UPDATE `lichphong` SET `songuoihientai`=songuoihientai+1 where id = $idlich";
            mysqli_query($conn, $sql);
            //UPDATE vào bản dky
            $sql = "UPDATE `bandangky` SET kiemtra=1 where id = $idbandk";
            $res = mysqli_query($conn, $sql);
            if ($res == true) {
                $sql = "SELECT * FROM `sinhvien`,bandangky,lichphong where sinhvien.id = bandangky.id_sinhvien and lichphong.id = bandangky.id_lichphong";
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
            }
        }
        $dulieu = array(
            "dulieu"=>$dl,
            "kiemtra"=>$kiemtra
        );echo json_encode($dulieu);
        
    } else {
        header('location: ../index.php');
        die();
    }
} else {
    header('location: ../index.php');
    die();
}

?>