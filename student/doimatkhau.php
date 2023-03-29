<?php
require_once 'include/header.php';
?>
<script>
    $(document).ready(function (e) {
        //Doi mat khau
        $("#luumatkhau").on('click', function (e) {
            e.preventDefault();
            var matkhaucu = $("#matkhaucu").val();
            var matkhaumoi = $("#matkhaumoi").val();
            var nhaplaimkmoi = $("#nhaplaimkmoi").val();
            if (matkhaucu == '' || matkhaumoi == '' || nhaplaimkmoi == '') {
                alert("Bạn phải nhập đầy đủ tất cả các trường")
            } else {
                $.ajax({
                    url: "./ajax/doimatkhau.php",
                    type: "POST",
                    data: { matkhaucu: matkhaucu, matkhaumoi: matkhaumoi, nhaplaimkmoi: nhaplaimkmoi },
                    success: function (data) {
                        $("#mes_submitpw").html(data);
                        setTimeout(function () {
                            $("#mes_submitpw").fadeOut("slow");
                            $("#matkhaucu").val("");
                            $("#matkhaumoi").val("");
                            $("#nhaplaimkmoi").val("");
                        }, 3000)
                    }
                })
            }
        })
    })
</script>
<div class="content " style="height: 700px;">
    <div class="text-center row">
        <div class="col-3">

        </div>
        <div class="col-6">
            <h4 class="text-center mt-3 mb-3" style="border-bottom:none;">ĐỔI MẬT KHẨU</h4>
            <div id="thongtincanhan" class="mb-3 text-center ">
                <form method="POST">
                    <div class="text">
                        <div>
                            Tài khoản
                        </div>
                        <div>
                            <?php
                            $sql = "SELECT mssv from sinhvien where id = $idsv";
                            $res = mysqli_query($conn, $sql);
                            if ($res == true) {
                                while ($rows = mysqli_fetch_array($res)) {
                            ?>
                            <input disabled type="text width: 500px;" class="form-control"
                                value="<?php echo $rows['mssv']; ?>" disabled>
                            <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                    <div class="text">
                        <div>
                            Mật khẩu cũ
                        </div>
                        <div>
                            <input id="matkhaucu" type="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="text">
                        <div>
                            Mật khẩu mới
                        </div>
                        <div>
                            <input id="matkhaumoi" type="password" class="form-control" placeholder="New Password">
                        </div>
                    </div>

                    <div class="text">
                        <div>
                            Nhập lại mật khẩu mới
                        </div>
                        <div>
                            <input id="nhaplaimkmoi" type="password" class="form-control"
                                placeholder="New Password (2)">
                        </div>
                    </div>

                    <div class=" mt-3 mb-3" id="mes_submitpw">

                    </div>
                    <div class="text mt-3 mb-3">
                        <input id="luumatkhau" type="submit" value="Lưu" class="btn btn-success">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="col-3">

    </div>


</div>

<?php
require_once 'include/footer.php'
    ?>