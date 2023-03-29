<?php // header
require_once 'include/header.php';

?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</script>
<div class="content" style="height: 700px;">
    <div class="homeIntro bottomBorder" style=" text-align:Center;">
        <h1><b class="bigTitle">DANH SÁCH PHẢN HỒI</b></h1>
        <!-- <form action="" method="GET">
            <div class="">
                <input type="text" style="width:50%;margin-bottom:2%" placeholder="Nhập mã phòng hoặc phòng..."
                    id="timkiemphong">
            </div>
        </form> -->
        <div>
            <table class="table">
                <col width="1%" />
                <col width="3%" />
                <col width="12%" />
                <col width="10%" />
                <col width="16%" />
                <col width="4%" />
                <col width="4%" />
                <col width="12%" />
                <col width="5%" />
                <col width="%" />
                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>MSSV</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Ngành</th>
                        <th>Thứ</th>
                        <th>Buổi</th>
                        <th>Ngày đăng ký</th>
                        <th>Phòng</th>
                        <th>Nội dung</th>
                    </tr>
                </thead>
                <tbody id="form">
                    <?php
                    $sql = "SELECT * FROM `sinhvien`,bandangky,lichphong,phanhoi where sinhvien.id = bandangky.id_sinhvien and lichphong.id = bandangky.id_lichphong and sinhvien.id = phanhoi.id_sv";
                    $ketqua = mysqli_query($conn, $sql);
                    if ($ketqua) {
                        $i = 0;
                        while ($rows = mysqli_fetch_array($ketqua)) {
                            $i++;
                    ?>
                    <tr>
                        <td>
                            <?php echo $i; ?>
                        </td>
                        <td>
                            <?php echo $rows['mssv'] ?>
                        </td>
                        <td>
                            <?php echo $rows['hoten'] ?>
                        </td>
                        <td>
                            <?php echo $rows['email'] ?>
                        </td>
                        <td>
                            <?php echo $rows['nganh'] ?>
                        </td>
                        <td>
                            <?php echo $rows['thu'] ?>
                        </td>
                        <td>
                            <?php echo $rows['buoi'] ?>
                        </td>
                        <td>
                            <?php echo $rows['ngaydangky'] ?>
                        </td>
                        <td>
                            <?php echo $rows['phong'] ?>
                        </td>
                        <td>
                            <?php echo $rows['noidung'] ?>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <hr>
        </div>
    </div>


    <?php
    require_once 'include/footer.php';
    ?>