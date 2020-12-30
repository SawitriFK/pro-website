<?php
session_start();
  include "inc/koneksi.php";
   
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Masuk</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<br>
			<a href="login.php">
				Aplikasi
				<b>PRO V.1.0</b>
			</a>
		</div>
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg">Sistem Masuk</p>

				<form action="" method="post">
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="id_user" placeholder="ID" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" name="sandi_user" placeholder="Sandi" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<button type="submit" class="btn btn-warning btn-block btn-flat" name="btnLogin" title="Masuk Sistem">
								<b>Masuk</b>
							</button>
						</div>
				</form>

				</div>
			</div>
		</div>
		<!-- /.login-box -->

		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.min.js"></script>
		<!-- Alert -->
		<script src="plugins/alert.js"></script>

</body>

</html>

<?php





if (isset($_POST['btnLogin'])) {  
	//anti inject sql
	$id_user=mysqli_real_escape_string($koneksi,$_POST['id_user']);
	$sandi_user=mysqli_real_escape_string($koneksi,$_POST['sandi_user']);

	//query login
	$sql_login = "SELECT * FROM user WHERE id_user='$id_user'";
	$query_login = mysqli_query($koneksi, $sql_login);
	$data_login = mysqli_fetch_array($query_login,MYSQLI_BOTH);
	$jumlah_login = 0;
	if(password_verify($sandi_user,$data_login["sandi_user"])){
		$jumlah_login = mysqli_num_rows($query_login);
	}



	if ($jumlah_login ==1 ){

		$_SESSION["ses_id"]=$data_login["id_user"];
		$_SESSION["ses_user"]=$data_login["nama_user"];
		$_SESSION["ses_sandi"]=$data_login["sandi_user"];
		$_SESSION["ses_tipe"]=$data_login["tipe_user"];

		
		echo "<script>
			
				window.location = 'index.php';
			</script>";
		}else{
		echo "<script>
			Swal.fire({title: 'Login Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
			}).then((result) => {if (result.value)
				{window.location = 'login.php';}
			})</script>";
		}
		}
