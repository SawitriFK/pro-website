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

	date_default_timezone_set('Asia/Jakarta');
	$time_now= date("H:i:s");
	$today= date("Y-m-d");
	$date_time = date ("Y-m-d H:i:s")

?>

<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Jadwal Saya</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=qSplwsK" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Ruangan</th>
						<th>Waktu Mulai</th>
						<th>Waktu Akhir</th>
						<th>Tanggal</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
			
              $no = 1;
			  $sql = $koneksi->query("select pinjam.*, ruang.*, konfirmasi.* from pinjam 
									  join ruang on pinjam.id_ruang = ruang.id_ruang 
									  join konfirmasi on pinjam.id_pinjam = konfirmasi.id_pinjam
									  where pinjam.id_user = $data_id 
									  AND CONCAT(pinjam.tanggal,' ',pinjam.waktu_akhir) >= '".$date_time."';
									  
									  ");
              while ($data= $sql->fetch_assoc()) {
            ?>

					<tr>
						<td>
							<?php echo $data['nama_ruang']; ?>
						</td>
						<td>
							<?php echo $data['waktu_mulai']; ?>
						</td>
						<td>
							<?php echo $data['waktu_akhir']; ?>
						</td>
						<td>
							<?php echo $data['tanggal']; ?>
						</td>

						<td>
							<?php $tanggapan = $data['tanggapan']  ?>
							<?php if($tanggapan == '0'){ ?>
							<span class="badge badge-warning">Belum Validasi</span>
							<?php }elseif($tanggapan == '1'){ ?>
							<span class="badge badge-primary">Sudah Validasi</span>
							<?php } ?>
						</td>

						<td>

							<a href="?page=qDplwsM&kode=<?php echo $data['id_pinjam']; ?>" onclick="return confirm('Hapus Data Ini ?')"
							 title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
								</a>
						</td>
					</tr>

					<?php
              ;}
            ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- /.card-body -->