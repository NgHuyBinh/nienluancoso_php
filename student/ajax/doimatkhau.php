<?php
    
    require_once '../../config/config.php';
    if(isset($_SESSION['idsv'])){
        if(isset($_POST['matkhaucu']) && isset($_POST['matkhaumoi']) && isset($_POST['nhaplaimkmoi'])){
            $taikhoan = $_SESSION['idsv'];
            $sql ="SELECT * FROM sinhvien where id = '$taikhoan'";
            $run = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($run);
            $matkhausv = $row['matkhau'];
            $idsv = $row['id'];
            $nhapmatkhaucu = $_POST['matkhaucu'];
            $nhapmatkhaumoi = $_POST['matkhaumoi'];
            $nhaplaimkmoi = $_POST['nhaplaimkmoi'];

            $nhapmatkhaucu = str_replace('\'','\\\'',$nhapmatkhaucu);
            $nhapmatkhaumoi = str_replace('\'','\\\'',$nhapmatkhaumoi);
            $nhaplaimkmoi = str_replace('\'','\\\'',$nhaplaimkmoi);
            $nhapmatkhaucu = md5($nhapmatkhaucu);
          
            
            if($nhapmatkhaucu == $matkhausv){
                if($nhapmatkhaumoi == $nhaplaimkmoi){
                    $nhapmatkhaumoi = md5($nhapmatkhaumoi);
                    $nhaplaimkmoi = md5($nhaplaimkmoi);
                    $sql = "UPDATE sinhvien set matkhau = '$nhapmatkhaumoi' where id = $idsv";
                    $run = mysqli_query($conn,$sql);
                    if($run == true){
                        echo '<script>
                        alert("Thay đổi mật khẩu thành công")
                        </script>';
                    }else{
                        echo '<script>
                        alert("Thay đổi mật khẩu thất bại")
                    </script>';
                    }
                }
                else{
                    echo '<script>
                    alert("Mật khẩu mới và nhập lại mật khẩu mới phải giống nhau")
                </script>';
                }
            }
            else{
                echo '<script>
                alert("Mật khẩu cũ không chính xác")
            </script>';
            }
        }
    }else{
        header('location: ../index.php');
    }
?>