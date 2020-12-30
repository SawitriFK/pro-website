<?php
    if (isset($_SESSION["ses_id"])==""){
		header("location: login");
		
		}else{
		  $data_id = $_SESSION["ses_id"];
		  $data_user = $_SESSION["ses_user"];
		  $data_sandi = $_SESSION["ses_sandi"];
		  $data_tipe = $_SESSION["ses_tipe"];
		}
?>


<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Mahasiswa</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=AmAddma" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nama</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
              $sql = $koneksi->query("select * from user where tipe_user='Mahasiswa'");
              while ($data= $sql->fetch_assoc()) {
            ?>

					<tr>
						<td>
							<?php echo $data['id_user']; ?>
						</td>
						<td>
							<?php echo $data['nama_user']; ?>
						</td>
						<td>
							<a href="?page=AmDitma&kode=<?php echo $data['id_user']; ?>" title="Ubah"
							 class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=AmDelma&kode=<?php echo $data['id_user']; ?>" onclick="return confirm('Hapus Data Ini ?')"
							 title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
								</>
						</td>
					</tr>

					<?php
              }
            ?>
				</tbody>

			</table>
		</div>
	</div>
	<!-- /.card-body -->