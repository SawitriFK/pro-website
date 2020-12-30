<?php
	//Mulai Sesion
	session_start();
    if (isset($_SESSION["ses_id"])==""){
		$data_user = "Anonim";
		$data_tipe = "Anonim";
	}
else{
      $data_id = $_SESSION["ses_id"];
	  $data_tipe = $_SESSION["ses_tipe"];

	  include "inc/koneksi.php";
	  $sql_cek = "SELECT * FROM user WHERE id_user='".$data_id."'";
	  $query_cek = mysqli_query($koneksi, $sql_cek);
	  $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
	  $data_user = $data_cek["nama_user"];

	  $sql = $koneksi->query("SELECT COUNT(id_pinjam) as tot_pinjam  from konfirmasi where tanggapan = 0");
	  while ($data= $sql->fetch_assoc()) {
		$tot_pinjam=$data['tot_pinjam'];
	}
	  }

  //KONEKSI DB


?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Aplikasi PRO</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- Alert -->
	<script src="plugins/alert.js"></script>
	<!-- Auto Refresh -->
	<script src="jquery-3.1.1.js" type="text/javascript"></script>
	<script>
		setInterval(function() {
			$(".realtime").load("fitur/beranda/beranda.php").fadeIn("slow");
		}, 1000);
		</script>
</head>

<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#">
						<i class="fas fa-bars"></i>
					</a>
				</li>
				<?php
				if($data_tipe!="Mahasiswa" AND $data_tipe!="Administrator"){
				?>
				<li class='nav-item'>
					<a href="login.php" title="Masuk">
						<input type="submit" name="masuk" value='Masuk' class='btn'>
					</a>
					
					</li>
				<?php
				}
				?>
			</ul>


			<!-- SEARCH FORM -->
			<ul class="navbar-nav ml-auto">

				<li class="nav-item d-none d-sm-inline-block">
					<a href="index.php" class="nav-link">
						<b>Sistem Peminjaman Ruangan Online (PRO)</b>
					</a>
				</li>
			</ul>

		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="index.php" class="brand-link">
				<span class="brand-text font-weight-light"> PRO V.1.0</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="index.php" class="d-block">
							<?php echo $data_user; ?>
						</a>
						<span class="badge badge-success">
							<?php echo $data_tipe; ?>
						</span>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


					<li class="nav-item">
							<a href="index.php" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Beranda
								</p>
							</a>
						</li>



						<!-- Level  -->
						<?php
							if ($data_tipe=="Administrator"){
						?>
						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-file"></i>
								<p>
									Jadwal
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="?page=qAplwsO" class="nav-link">
										<i class="nav-icon far fa-circle text-info"></i>
										<p>Jadwal Saya</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=dfiYrmk" class="nav-link">
										<i class="nav-icon far fa-circle text-info"></i>
										<p>Jadwal Lainnya</p>
									</a>
							</ul>
						</li>
						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-cogs"></i>
								<p>
									Pengguna
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="?page=AmDatma" class="nav-link">
										<i class="nav-icon far fa-circle text-success"></i>
										<p>Data Mahasiswa</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=WgtyAot" class="nav-link">
										<i class="nav-icon far fa-circle text-success"></i>
										<p>Data Administrator</p>
									</a>
								</li>
							</ul>
						</li>


						<li class="nav-item">
							<a href="?page=uHsRHju" class="nav-link">
								<i class="nav-icon far fa fa-table"></i>
								<p>
									Validasi
									<?php

									if ($tot_pinjam >=1){
									?>
									<span class="badge badge-danger"><?php echo $tot_pinjam?></span>
									<?php
									}
									?>
								</p>
							</a>
						</li>

						<li class="nav-header">Setting</li>
						<li class="nav-item">
							<a href="?page=CdjiydX" class="nav-link">
								<i class="nav-icon far fa-user"></i>
								<p>
									Profil
								</p>
							</a>
						</li>

						<li class="nav-item">
							<a onclick="return confirm('Apakah anda yakin akan keluar ?')" href="logout.php" class="nav-link">
								<i class="nav-icon far fa-circle text-danger"></i>
								<p>
									Logout
								</p>
							</a>
						</li>
					
						<?php
							} elseif($data_tipe=="Mahasiswa"){
						?>

						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-file"></i>
								<p>
									Jadwal
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="?page=qAplwsO" class="nav-link">
										<i class="nav-icon far fa-circle text-info"></i>
										<p>Jadwal Saya</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=dfiYrmk" class="nav-link">
										<i class="nav-icon far fa-circle text-info"></i>
										<p>Jadwal Lainnya</p>
									</a>
							</ul>
						</li>


						<li class="nav-header">Setting</li>
						<li class="nav-item">
							<a href="?page=CdjiydX" class="nav-link">
								<i class="nav-icon far fa-user"></i>
								<p>
									Profil
								</p>
							</a>
						</li>

						<li class="nav-item">
							<a onclick="return confirm('Apakah anda yakin akan keluar ?')" href="logout.php" class="nav-link">
								<i class="nav-icon far fa-circle text-danger"></i>
								<p>
									Logout
								</p>
							</a>
						</li>

						<?php
							} else{
						?>
						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-file"></i>
								<p>
									Jadwal
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="?page=dfiYrmk" class="nav-link">
										<i class="nav-icon far fa-circle text-info"></i>
										<p>Jadwal Lainnya</p>
									</a>
							</ul>
						</li>

						<?php
							}
							?>



				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
			</section>

			<!-- Main content -->
			<section class="content">
				<!-- /. WEB DINAMIS DISINI ############################################################################### -->
				<div class="container-fluid">

					<?php 
      if(isset($_GET['page'])){
          $hal = $_GET['page'];
  
          switch ($hal) {
              //Klik Halaman Home Pengguna
              	case 'admin':
                  include "home/admin.php";
                  break;


				//Pengguna
				case 'AmDatma':
					include "fitur/mahasiswa/data_mahasiswa.php";
					break;
				case 'AmAddma':
					include "fitur/mahasiswa/add_mahasiswa.php";
					break;
				case 'AmDitma':
					include "fitur/mahasiswa/edit_mahasiswa.php";
					break;
				case 'AmDelma':
					include "fitur/mahasiswa/del_mahasiswa.php";
					break;
					
					//Admin
				case 'WgtyAot':
					include "fitur/admin/data_admin.php";
					break;
				case 'WfttAot':
					include "fitur/admin/add_admin.php";
					break;
				case 'WjtiAot':
					include "fitur/admin/edit_admin.php";
					break;
				case 'WhtuAot':
					include "fitur/admin/del_admin.php";
					break;
					
					//Jadwal Saya
				case 'qAplwsO':
					include "fitur/jadwalSaya/data_jadwalSaya.php";
					break;
				case 'qSplwsK':
					include "fitur/jadwalSaya/add_jadwalSaya.php";
					break;
				case 'qDplwsM':
					include "fitur/jadwalSaya/del_jadwalSaya.php";
					break;


				//Jadwal
				case 'dfiYrmk':
					include "fitur/jadwal/data_jadwal.php";
					break;
				case 'dfuUtmk':
					include "fitur/jadwal/del_jadwal.php";
					break;

				//Validasi
				case 'uHsRHju':
					include "fitur/validasi/data_validasi.php";
					break;
				case 'uLsRHna':
					include "fitur/validasi/val_validasi.php";
					break;
				case 'uPsRHlo':
					include "fitur/validasi/del_validasi.php";
					break;

				//Profil
				case 'CdjiydX':
					include "fitur/profil/edit_profil.php";
					break;
          
              //default
              default:
                  echo "<center><h1> ERROR !</h1></center>";
                  break;    
          }
      }else{
        // Auto Halaman Home Pengguna
              include "fitur/beranda/beranda.php";

          }
    ?>

				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer bg-light">
			<div class="float-right d-none d-sm-block">
				Copyright &copy;
				<a target="_blank" href="https://github.com/SawitriFK">
					<strong> Sawitri Fina Kartika</strong>
				</a>
			</div>
			Create 2020
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Select2 -->
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<!-- DataTables -->
	<script src="plugins/datatables/jquery.dataTables.js"></script>
	<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="dist/js/demo.js"></script>
	<!-- page script -->
	<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

	<script>
		$(function() {
			$("#example1").DataTable();
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
			});
		});
	</script>

	<script>
		$(function() {
			//Initialize Select2 Elements
			$('.select2').select2()

			//Initialize Select2 Elements
			$('.select2bs4').select2({
				theme: 'bootstrap4'
			})
		})
	</script>

</body>

</html>