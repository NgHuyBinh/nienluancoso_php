<?php // header
require_once 'include/header.php';

?>
<script>
    $(document).ready(function (e) {
        $("#dangkyphong").on('click', function (e) {
            e.preventDefault();
            var thu = $("#dk_thu").val();
            var phong = $("#dk_phong").val();
            var buoi = $("#dk_buoi").val();
            var idsv = $("#dk_sv").val();
            if (thu == '' || phong == '' || buoi == '') {
                alert("Vui lòng nhập tất cả thông tin");
            } else {
                $.ajax({
                    url: "ajax/xulyformdangky.php",
                    type: "GET",
                    data: { thu: thu, buoi: buoi, phong: phong, idsv: idsv },
                    success: function (data) {
                        if (data == 2) {
                            alert("Phòng đã đầy");
                        }
                        if (data == 1) {
                            alert("Không hợp lệ. Vui lòng kiểm tra lại thông tin!");
                        }
                        if (data == 0) {
                            alert("Bạn đã đăng ký thành công. Vui lòng chờ phản hồi");
                            $("#message").html("");
                        }
                    }
                })
            }
        })
        $("#timkiemphong").on('input', function (e) {

            var giatri = $(this).val();

            $.ajax({
                url: "ajax/xulytimkiemphong.php",
                type: "GET",
                data: { giatri: giatri },
                success: function (data) {
                    $("#search").html(data);
                }
            })

        })
        $("#guiphanhoi").on('click', function (e) {
            e.preventDefault();
            var noidung = $("#noidung").val();
            if (noidung == '') {
                alert("Vui lòng nhập nội dung")
            } else {
                $.ajax({
                    url: "ajax/xulyphanhoi.php",
                    type: "GET",
                    data: { noidung: noidung },
                    success: function (data) {
                        if (data == 1) {
                            alert("Bạn đã gửi phản hồi thành công");
                            $("#form-phan-hoi")[0].reset();
                        }
                    }
                })
            }

        })
        
    })
</script>

<div class="content">

    <!--LEFT-->
    <div class="row" class="container p-3" style="height: auto;">
        <div class="colLeft fl col-8">
            <div class="homeIntro bottomBorder" style=" text-align:Center;">
                <h1><b class="bigTitle">THÔNG TIN CÁ NHÂN </b></h1>
                <div>
                    <div>
                        <?php

                        $sql = "SELECT * FROM sinhvien,lop,giangvien where sinhvien.id = $idsv and  sinhvien.id_lop=lop.id and giangvien.id=lop.id_giangvien
                        ";
                        $res = mysqli_query($conn, $sql);
                        if ($res == true) {
                            while ($rows = mysqli_fetch_assoc($res)) {
                        ?>
                        <div class="inl" style="font-weight:bold">
                            <div style="margin-right: 0%">MSSV:</div>
                            <div style="width: 45%;">
                                <?php echo $rows['mssv']; ?>
                            </div>
                        </div>
                        <div class="inl" style="font-weight:bold">
                            <div style="margin-right:0%">Họ tên:</div>
                            <div style="width: 45%;">
                                <?php echo $rows['hoten']; ?>
                            </div>
                        </div>
                        <div class="inl" style="font-weight:bold">
                            <div style="margin-right:0%">Lớp:</div>
                            <div style="width: 45%;">
                                <?php echo $rows['tenlop']; ?>
                            </div>
                        </div>
                        <div class="inl" style="font-weight:bold">
                            <div style="margin-right:0%">Ngành:</div>
                            <div style="width: 45%;">
                                <?php echo $rows['nganh']; ?>
                            </div>
                        </div>
                        <div class="inl" style="font-weight:bold">
                            <div style="margin-right:0%">Giới tính:</div>
                            <div style="width: 45%;">
                                <?php echo $rows['gioitinh']; ?>
                            </div>
                        </div>
                        <div class="inl" style="font-weight:bold">
                            <div style="margin-right:0%">Cố vấn</div>
                            <div style="width: 45%;">
                                <?php echo $rows['tengiangvien']; ?>
                            </div>
                        </div>
                        <div id="message" class="mt-3" style="font-weight:bold">
                            <?php
                                if ($rows['trangthai'] == 1) {
                                    echo "<div class='text-success' style='font-size:1.1rem'>Bạn đã đăng ký lịch phòng thành công</div>";
                                }
                                if ($rows['trangthai'] == -1) {
                                    echo "<div class='text-danger' style='font-size:1.1rem'>Phòng bạn đăng ký đã đầy. Vui lòng chọn lịch phòng khác</div>";
                                }
                            ?>
                        </div>
                        <?php
                            }
                        }
                        ?>
                        <hr>
                    </div>
                </div>
            </div>


        </div>

        
        <!-- Đăng ký Phòng  RIGHT-->
        <div class="colRight fr">
            <div class="bookingFormOutline" id="hidden">
                <div class="bookingForm">
                    
                    <h2 class="bookingFormTitle"><b>Đăng ký phòng</b></h2>
                    <form method="POST">
                        <ul class="bookingFormContent">
                            <?php
                            $sql = "SELECT * FROM bandangky,lichphong where bandangky.id_lichphong=lichphong.id and id_sinhvien=$idsv";
                            $res = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($res);
                            ?>
                            <li>
                                <label style="width: 100px ;"><b>Thứ :</b></label>
                                <input type="text" <?php if (isset($row['trangthai']) && $row['trangthai'] == 1) {
                                    echo 'disabled';
                                } ?> value="<?php if ( isset($row['thu'])) {echo $row['thu'];}else{echo "";}?>" style="width:180px" id="dk_thu">
                            </li>
                            <li>
                                <label style="width: 100px ;"><b>Buổi :</b></label>
                                <input type="text" <?php if (isset($row['trangthai']) && $row['trangthai'] == 1) {
                                    echo 'disabled';
                                } ?> value="<?php if (isset($row['buoi'])) {echo $row['buoi'];}else{echo "";}?>" style="width:180px" id="dk_buoi">
                            </li>
                            <li>
                                <label style="width: 100px ;"><b>Phòng :</b></label>
                                <input type="text" <?php if (isset($row['trangthai']) && $row['trangthai'] == 1) {
                                    echo 'disabled';
                                } ?> value="<?php if (isset($row['phong']) && isset($row['phong'])) {echo $row['phong'];}else{echo "";}?>" style="width:180px"
                                id="dk_phong">
                            </li>
                            <li>
                                
                                <input class="" <?php if (isset($row['trangthai']) && $row['trangthai'] == 1) {
                                    echo 'disabled';
                                } ?> type="hidden"
                                id="dk_sv" value="
                                <?php echo $idsv; ?>" id="" name="">
                            </li>

                            <li>
                                <label>&nbsp;</label>
                                <input type="submit" <?php if (isset($row['trangthai']) && $row['trangthai'] == 1) {
                                    echo 'disabled';
                                } ?>
                                id="dangkyphong" value="Đăng ký" name="save">
                            </li>

                            <!-- form đăng ký -->

                        </ul>
                    </form>
                </div>
            </div>
        </div>
        <div class="homeIntro bottomBorder" style=" text-align:Center;">
            <div>


                <h1><b class="bigTitle">DANH SÁCH PHÒNG</b></h1>
                <!-- <form action="" method="GET">
                <div class="">
                    <input type="text" style="width:50%;margin-bottom:2%" placeholder="Nhập mã phòng hoặc phòng..."
                        id="timkiemphong">
                </div>
            </form> -->
                <div class="m-3">
<div>

                    <div>
                        <table style="margin-left:2%;width:95%" id="dsphong">
                            <col width="10%" />
                            <col width="10%" />
                            <col width="10%" />
                            <col width="10%" />
                            <col width="20%" />
                            <col width="20%" />
                            <col width="10%" />
                            <thead style="font-weight:bold">
                                <tr>
                                    <th>STT</th>
                                    <th>Thứ</th>
                                    <th>Buổi</th>
                                    <th>Số phòng</th>
                                    <th>Số người hiện tại</th>
                                    <th>Số người tối đa</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody id="search">
                                <?php
                        $sql = "SELECT lichphong.phong,lichphong.thu,lichphong.buoi,lichphong.songuoihientai,lichphong.songuoitoida FROM lichphong  ";
                        $res = mysqli_query($conn, $sql);
                        if ($res == true) {
                            $i = 0;
                            while ($rows = mysqli_fetch_assoc($res)) {
                                $i++;
                        ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
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
                                        <?php echo $rows['songuoihientai'] ?>
                                    </td>
                                    <td>
                                        <?php echo $rows['songuoitoida'] ?>
                                    </td>

                                    <td>
                                        <?php
                                if ($rows['songuoitoida'] - $rows['songuoihientai'] > 0) {
                                    echo "Trống";
                                } else {
                                    echo "Đủ";
                                }
                                ?>
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
        </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"> </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"> </script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"> </script>

        <script>
            $(document).ready(function () {
                $('#dsphong').DataTable();
                $('.dataTables_length').addClass('bs-select');
            });
        </script>
        <?php
        require_once 'include/footer.php';
        ?>