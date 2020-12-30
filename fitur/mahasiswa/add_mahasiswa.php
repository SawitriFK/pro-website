<?php 

if (isset($_SESSION["ses_id"])==""){
	header("location: login");
    
    }else{
      $data_id = $_SESSION["ses_id"];
	  $data_user = $_SESSION["ses_user"];
	  $data_sandi = $_SESSION["ses_sandi"];
	  $data_tipe = $_SESSION["ses_tipe"];
    }
	//membuat acak angka
	$pass_acak = mt_rand(1000, 9999);
?>

<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data Mahasiswa</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">ID</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="id_user" name="id_user"  required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_user" name="nama_user" required>
				</div>
			</div>

            <div class="form-group row">
				<label class="col-sm-2 col-form-label">Sandi</label>
				<div class="col-sm-6">
					<input type="password" class="form-control" id="sandi_user" name="sandi_user" required>
				</div>
			</div>


		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=AmDatma" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

    if (isset ($_POST['Simpan'])){
	//mulai proses simpan data
		$options = [
			'cost' => 10,
		];
		$hashedPass = password_hash($_POST['sandi_user'], PASSWORD_DEFAULT, $options);
        $sql_simpan = "INSERT INTO user (id_user, nama_user, sandi_user, tipe_user) VALUES (
        '".$_POST['id_user']."',
        '".$_POST['nama_user']."',
        '".$hashedPass."',
        'Mahasiswa')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=AmDatma';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=AmDatma';
          }
      })</script>";
    }}
     //selesai proses simpan data
