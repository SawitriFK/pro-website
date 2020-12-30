

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

?>

<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Validasi</h3>
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
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
			  $sql = $koneksi->query("select pinjam.*, ruang.*, user.*, konfirmasi.* from pinjam 
									  join ruang on pinjam.id_ruang = ruang.id_ruang
									  join user on pinjam.id_user= user.id_user
									  join konfirmasi on konfirmasi.id_pinjam = pinjam.id_pinjam
									  where konfirmasi.tanggapan = 0");
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
						

						<td>
						<a href="?page=uLsRHna&kode=<?php echo $data['id_pinjam'];?>" onclick="return confirm('Setujui Peminjaman Ruangan Ini ?')"
						title="Izinkan" class="btn btn-primary btn-sm">
						   <i class="fa fa-check"></i>
					   </a>
							<a href="?page=uPsRHlo&kode=<?php echo $data['id_pinjam'];?>" onclick="return confirm('Tolak dan Hapus Peminjaman Ruangan Ini ?')"
							 title='Tolak' class='btn btn-warning btn-sm'>
								<i class='fa fa-ban'></i>
								</a>
						</td>
					</tr>

					<?php
              }
            ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
