<?php 
//Mulai Sesion
if (isset($_SESSION["ses_id"])==""){
header("location: login");

}else{
  $data_id = $_SESSION["ses_id"];
  $data_user = $_SESSION["ses_user"];
  $data_sandi = $_SESSION["ses_sandi"];
  $data_tipe = $_SESSION["ses_tipe"];
}

//KONEKSI DB
include "inc/koneksi.php";



	//membuat acak angka
	$pass_acak = mt_rand(1000, 9999);

?>

<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i>Jadwal Saya</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

		<input type='hidden' class="form-control" name="id_user" value="<?php echo $data_id; ?>"/>

		<div class="form-group row">
				<label class="col-sm-2 col-form-label">Ruangan</label>
				<div class="col-sm-6">
					<select name="id_ruang" class="form-control">
						<option value="h5">Ruang H5</option>
						<option value="h17">Ruang H17</option>
						<option value="h18">Ruang H18</option>
						<option value="h19">Ruang H19</option>
						<option value="h20">Ruang H20</option>
					</select>
				</div>
			</div>


			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Waktu Awal</label>
				<div class="col-sm-6">
					<input type="time" class="form-control" name="waktu_mulai" required >
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Waktu Akhir</label>
				<div class="col-sm-6">
					<input type="time"class="form-control" name="waktu_akhir" required>
				</div>
			</div>

            <div class="form-group row">
				<label class="col-sm-2 col-form-label">Tanggal</label>
				<div class="col-sm-6">
					<input type="date" class="form-control" name="tanggal"  required>
				</div>
			</div>


		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=qAplwsO" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

    if (isset ($_POST['Simpan'])){

		$cek = "SELECT * FROM pinjam JOIN konfirmasi ON pinjam.id_pinjam=konfirmasi.id_pinjam";
		$sql_waktu = $koneksi->query($cek);			
		$jawab=true;
		while ($data_waktu= $sql_waktu->fetch_assoc()) {


			if($_POST['id_ruang']==$data_waktu['id_ruang'] AND $_POST['tanggal']==$data_waktu['tanggal'] AND $data_waktu['tanggapan']==1){
				if (($_POST['waktu_mulai']<=$data_waktu['waktu_mulai'] AND $data_waktu['waktu_akhir']<=$_POST['waktu_akhir']) OR
					($_POST['waktu_mulai']<=$data_waktu['waktu_mulai'] AND $data_waktu['waktu_mulai']<=$_POST['waktu_akhir'] AND $_POST['waktu_akhir']<=$data_waktu['waktu_akhir']) OR
					($data_waktu['waktu_mulai']<=$_POST['waktu_mulai'] AND $_POST['waktu_mulai']<=$data_waktu['waktu_akhir'] AND $data_waktu['waktu_akhir']<=$_POST['waktu_akhir']) OR
					($data_waktu['waktu_mulai']<=$_POST['waktu_mulai'] AND $_POST['waktu_mulai']<=$data_waktu['waktu_akhir'] AND $data_waktu['waktu_mulai']<=$_POST['waktu_akhir'] AND $_POST['waktu_akhir']<=$data_waktu['waktu_akhir'])
					){
						$jawab = false;
						break;}
				else{
					$jawab = true;
				}
			}

			else {
				$jawab = true;
				
			}
		}
		

		if($jawab == false){	
        
			echo "<script>
			Swal.fire({title: 'Sudah Dipinjam',text: '',icon: 'error',confirmButtonText: 'OK'
			}).then((result) => {if (result.value){
				window.location = 'index.php?page=qAplwsO';
				}
			})</script>";
			
		 }elseif($jawab==true){

    //mulai proses simpan data
        $sql_simpan = "INSERT INTO pinjam (id_ruang, id_user, waktu_mulai, waktu_akhir, tanggal) VALUES (
        '".$_POST['id_ruang']."',
        '".$_POST['id_user']."',
        '".$_POST['waktu_mulai']."',
		'".$_POST['waktu_akhir']."',
		'".$_POST['tanggal']."')";

	$sql_simpan2= "INSERT INTO konfirmasi (id_pinjam, tanggapan) VALUES (
		LAST_INSERT_ID(),
		'0'
		)";
		$query_simpan = mysqli_query($koneksi, $sql_simpan);
		$query_simpan2 = mysqli_query($koneksi, $sql_simpan2);
        mysqli_close($koneksi);

    if ($query_simpan AND $query_simpan2) {
		echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=qAplwsO';
          }
      })</script>";
      
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=qAplwsO';
          }
      })</script>";
	}
}
}


     //selesai proses simpan data
