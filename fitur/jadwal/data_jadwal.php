<?php
    //Mulai Sesion
    if (isset($_SESSION["ses_id"])==""){
		$data_user = "Anonim";
		$data_tipe = "Anonim";
    
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
	$date_time = date ("Y-m-d H:i:s");

?>

<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Jadwal Lainnya</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Ruangan</th>
						<th>Peminjam</th>
						<th>Waktu Mulai</th>
						<th>Waktu Akhir</th>
						<th>Tanggal</th>
						<?php
						if($data_tipe=="Administrator"){
							echo "<th>Aksi</th>";}
						?>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
			  $sql = $koneksi->query("select pinjam.*, ruang.*, user.*, pinjam.* from pinjam 
									  join ruang on pinjam.id_ruang = ruang.id_ruang
									  join user on pinjam.id_user= user.id_user
									  join konfirmasi on pinjam.id_pinjam=konfirmasi.id_pinjam
									  where konfirmasi.tanggapan = 1
									  AND CONCAT(pinjam.tanggal,' ',pinjam.waktu_akhir) >= '".$date_time."';");
              while ($data= $sql->fetch_assoc()) {
				  $data_idpinjam = $data['id_pinjam'];
            ?>

					<tr>
						<td>
							<?php echo $data['nama_ruang']; ?>
						</td>
						<td>
							<?php echo $data['nama_user']; ?>
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
						<?php
						if($data_tipe=="Administrator"){
							echo"
						<td>

							<a href='?page=dfuUtmk&kode=$data_idpinjam;' onclick='return confirm('Hapus Data Ini ?')'
							 title='Hapus' class='btn btn-danger btn-sm'>
								<i class='fa fa-trash'></i>
								</>
						</td>";}
						?>
					</tr>

					<?php
              }
            ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
