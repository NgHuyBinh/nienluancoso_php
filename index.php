<?php
	require_once 'config/config.php';
	if(isset($_POST['login'])){
		$mssv = $matkhau ='';
		if(isset($_POST['mssv']) && isset($_POST['pass'])){
			$mssv = $_POST['mssv'];
			$matkhau = $_POST['pass'];
		}
		$matkhau = md5($matkhau);
		if($mssv == ''||$matkhau ==''){
			$_SESSION['mes'] = "Đăng nhập thất bại!";
		}else{
			if(isset($_POST['admin'])){
				$sql = "SELECT * FROM admin where taikhoan = '$mssv' and matkhau='$matkhau'";
				$res = mysqli_query($conn,$sql);
				if(mysqli_num_rows($res) > 0){
					while($rows = mysqli_fetch_assoc($res)){
						$_SESSION['admin'] = $rows['id'];
					}
					header('location: admin/index.php');
				}else{
					$_SESSION['mes']="Đăng nhập thất bại";
				}
			}else{
				$sql = "SELECT * FROM sinhvien where mssv = '$mssv' and matkhau='$matkhau'";
				$res = mysqli_query($conn,$sql);
				if(mysqli_num_rows($res) > 0){
					while($rows = mysqli_fetch_assoc($res)){
						$_SESSION['idsv'] = $rows['id'];
					}
					header('location: student/index.php');
				}else{
					$_SESSION['mes']="Đăng nhập thất bại";
				}
			}
			
		}
		// Fix SQL Inj
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form method="POST" class="login100-form validate-form">
					<b><span class="login100-form-title" style="font-family: Arial, Helvetica, sans-serif;">
						ĐĂNG NHẬP
					</span></b>

					<div class="wrap-input100 validate-input" data-validate = "MSSV là bắt buộc">
						<input class="input100" type="text" name="mssv" placeholder="MSSV">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Mật khẩu là bắt buộc">
						<input class="input100" type="password" name="pass" placeholder="Mật khẩu">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						
					</div>
					Check vào đây, nếu là admin<input type="checkbox" name="admin">					
					<div class="container-login100-form-btn">

						<button name="login" class="login100-form-btn">
							ĐĂNG NHẬP
						</button>
					</div>


					
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>