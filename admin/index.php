<?php // header
require_once 'include/header.php';

?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    // duyệt đăng ký phòng
    $(document).ready(function (e) {
        function duyet_dk(){
            $(".duyet_dk").on('click', function (e) {
      
                e.preventDefault();
                var idsv = $(this).attr("data-id-sinhvien");
                var idbandk = $(this).attr("data-id-ban");
                var idlich = $(this).attr("data-id-lich");
                
                $.ajax({
                    url: "ajax/bandangky.php",
                    data: { idsv: idsv, idbandk: idbandk, idlich: idlich },
                    type: "GET",
                    success: function (data) {

                        var layDuLieu = JSON.parse(data);
                        
                        if (layDuLieu.kiemtra == 1) {
                            alert("Phòng đã đầy")
                        } else {

                            $("#form").html(layDuLieu.dulieu);
                            
                        }
                        duyet_dk()
                        huy_dk()
                        timkiem()
                    }

                });
            })
        }
        duyet_dk()

        // hủy đăng ký phòng
        function huy_dk(){
            $(".huy_dk").on('click', function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var idsv = $(this).attr("data-id-sinhvien");
            if (confirm("Bạn có chắc chắn muốn hủy bỏ")) {
                $.ajax({
                        url: "ajax/huydangky.php",
                        data: { id: id,idsv:idsv},
                        type: "GET",
                        success: function (data) {
                            var layDuLieu = JSON.parse(data);
                            console.log(layDuLieu.dulieu)
                            $("#form").html(layDuLieu.dulieu);
                            huy_dk()
                            duyet_dk()
                            timkiem()
                        }
                    });
            }
            
            
            })
        }
        huy_dk()

        // tìm kiếm phòng
        function timkiem(){
            $("#timkiemphong").on('input', function (e) {
            var mssv = $(this).val();
            $.ajax({
                url: "ajax/xulytimkiemphong.php",
                type: "GET",
                data: { mssv: mssv },
                success: function (data) {
                    $("#form").html(data);
                    huy_dk()
                    duyet_dk()
                    timkiem()
                }
            })

        })
        }
        timkiem()


        // 
        
        // 
    })
</script>

<div class="content">
    <div class="homeIntro bottomBorder" style=" text-align:Center;">
        <h1><b class="bigTitle">DANH SÁCH PHÒNG</b></h1>
        <form action="" method="GET">
            <div class="">
                <input type="text" style="width:50%;margin-bottom:2%" placeholder="Nhập mã phòng hoặc phòng..."
                    id="timkiemphong">
            </div>
        </form>

        <div>
            <div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>MSSV</th>
                        <th>Họ tên</th>
                        <th>Ngành</th>
                        <th>Thứ</th>
                        <th>Buổi</th>
                        <th>Phòng</th>
                        <th>Duyệt</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody id="form">
                    <?php
                    $sql = "SELECT * FROM `sinhvien`,bandangky,lichphong where sinhvien.id = bandangky.id_sinhvien and lichphong.id = bandangky.id_lichphong";
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
                            <?php echo $rows['nganh'] ?>
                        </td>
                        <td>
                            <?php echo $rows['thu'] ?>
                        </td>
                        <td>
                            <?php echo $rows['buoi'] ?>
                        </td>
                        <td>
                            <?php echo $rows['phong'] ?>
                        </td>
                        <td>
                            <?php
                            if ($rows['kiemtra'] == 0) {
                                echo '<a style="font-size:1.1rem" href="" data-id-sinhvien="' . $rows[0] . '" data-id-ban="' . $rows[10] . '" data-id-lich="' . $rows[16] . '"  class="duyet_dk text-success">Duyệt</a>
                                    <a style="font-size:1.1rem"  data-id="' . $rows[10] . '" data-id-sinhvien="' . $rows[0] . '"  class="huy_dk text-danger">Hủy</a>';
                            }
                            if ($rows['kiemtra'] == 1) {
                                echo "<span class='text-success' style='font-size:1.1rem'>DUYỆT</span>";
                            }
                            if ($rows['kiemtra'] == -1) {
                                echo "<span class='text-danger' style='font-size:1.1rem'>HỦY</span>";
                            }
                            ?>

                        </td>
                        <td>
                            <?php if ($rows['ghichu'] == '') {
                                echo "Không";
                            } else {
                                echo $rows['ghichu'];
                            } ?>
                        </td>
                    </tr>
                    <?php
                    }
                        }
                    ?>


                </tbody>
            </table>
            <hr>
        </div>
        </div>
    </div>


    <?php
    require_once 'include/footer.php';
    ?>