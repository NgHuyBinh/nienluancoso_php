<?php 
    require_once '../../config/config.php';
    if(isset($_SESSION['idsv'])){
        if(isset($_GET['giatri'])){
            $giatri = $_GET['giatri'];
            // SQL injection 
            $giatri = str_replace('\' ', '\\\' ', $giatri);
            // ...
            $kq = '';
            $sql = "SELECT lichphong.phong,lichphong.thu,lichphong.buoi,lichphong.songuoihientai,lichphong.songuoitoida FROM lichphong where (thu like '%$giatri%' or buoi like '%$giatri%')";
            $res = mysqli_query($conn,$sql);
            $i=0;
            if($res == true){
                while($rows = mysqli_fetch_array($res)){
                    $i++;
                    $tt='';
                    if($rows['songuoitoida'] - $rows['songuoihientai'] == 0){
                        $tt = 'Đủ';
                    }else{
                        $tt = 'Trống';
                    }
                    $mes = '';
                    $kq .= "
                    <tr>
                    <td>
                        ". $i ."
                    </td>
                    <td>
                        ". $rows['thu']  ."
                    </td>
                    <td>
                        ". $rows['buoi']  ."
                    </td>
                    <td>
                        ". $rows['phong']  ."
                    </td>
                    <td>
                        ". $rows['songuoihientai']  ."
                    </td>
                    <td>
                        ". $rows['songuoitoida']  ."
                    </td>
                    <td>".$tt."</td>
                </tr>
                    ";
                }
            }
            echo $kq;
        }
    }else{
        header('location: ../index.php');
        die();
    }
?>