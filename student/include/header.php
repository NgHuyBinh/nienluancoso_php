<?php
require_once '../config/config.php';
if (!isset($_SESSION['idsv'])) {
    header('location: ../index.php');
    die();
}
$idsv = $_SESSION['idsv'];
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Đăng ký phòng báo cáo luận văn</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="" type="image/x-icon" />
    <!-- STYLE -->
    <link rel="stylesheet" type="text/css" href="/luanvan2/css/home.css" media="screen" />
    <link rel="stylesheet" href="/luanvan2/css/queryslidemenu.css" type="text/css" />
    <!-- SCRIPT -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <link href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <!-- <script type="text/javascript" src="js/coin-slider.min.js"></script> -->
    <!-- <script src="js/galleria-1.2.6.min.js"></script> -->
    <link rel="stylesheet" href="/luanvan2/coin-slider-styles.css" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        body {
            background-color: #212529;
        }

        .inl>div {
            display: inline-block;
            font-size: 1.2rem;
            margin-top: 2%;
        }

        .inl>div:first-child {
            width: 20%;
            text-align: left;
        }

        .inl>div:last-child {
            width: 25%;
            text-align: left;
        }

        .homeIntro {
            margin: 0 auto;
        }
    </style>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function () {
            $('#coinSlider').coinslider({
                width: 960, // width of slider panel
                height: 400, // height of slider panel
                spw: 8, // squares per width
                sph: 6, // squares per height
                delay: 3000, // delay between images in ms
                sDelay: 30, // delay beetwen squares in ms
                opacity: 0.70, // opacity of title and navigation
                titleSpeed: 500, // speed of title appereance in ms
                effect: '', // random, swirl, rain, straight
                navigation: true, // prev next and buttons
                links: true, // show images as links
                hoverPause: true // pause on hover

            });

            //Focus textbox
            $('.inputLabel').each(function () {
                this.value = $(this).attr('title');
                $(this).focus(function () {
                    if (this.value == $(this).attr('title')) {
                        this.value = '';
                    }
                });
                $(this).blur(function () {
                    if (this.value == '') {
                        this.value = $(this).attr('title');
                    }
                });
            });
           
            


        });

    </script>

    <script type="text/javascript" src="/luanvan2/js/jqueryslidemenu.js"></script>
    <!-- định nghĩa các bảng trong body -->
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>

</head>

<body>
    <div class=""> <!-- bỏ all container -->
        <!--HEADER-->
        <div class="header">
            <div class=""><a href="#"><img src="/luanvan2/images/logo.jpg" alt="photo" /></a></div>

        </div>
        <!--MENU-->
        <div id="myslidemenu" class="jqueryslidemenu headerMenu">
            <ul class="topMenu">
                <li><a href="index.php">TRANG CHỦ</a></li>
                <li><a href="doimatkhau.php">ĐỔI MẬT KHẨU</a></li>
                <li ><a <?php 
                
                    $sql = "SELECT trangthai from sinhvien where id = $idsv";
                    $res = mysqli_query($conn,$sql);
                    if($res == true){
                        while($rows = mysqli_fetch_array($res)){
                            if($rows['trangthai'] == 0){
                                echo "style='display:none'";
                            }
                        }
                    }
                ?> href="" data-toggle="modal" data-target="#myModal">PHẢN HỒI THIẾT BỊ</a></li>
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div>
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="bigTitle"><b>Phản hồi</b></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="" id="form-phan-hoi">
                                        <div>
                                            <label for="noidung" style="width:30%;font-size:1.3rem">Nội dung</label>
                                            <input type="text" id="noidung" style="width:60%;font-size:1.3rem" required>
                                        </div>
                                        <div style="text-align:left;margin-top:2%">
                                            <button id="guiphanhoi" class="btn btn-success">Gửi</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <li id="phai">
                    <?php
                    if (isset($_SESSION['idsv'])) {
                        echo '<a href="/luanvan2/dangxuat.php">Đăng xuất</a>';
                    } else {
                        echo '<a href="/luanvan2/index.php">Đăng nhập</a>';
                    }
                    ?>
                </li>

            </ul>
        </div>