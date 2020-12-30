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
			<i class="fa fa-table"></i> Data Adminitrator</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=WfttAot" class="btn btn-primary">
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
			  $sql = $koneksi->query("select * from user where tipe_user='Administrator'");
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
						
						<?php if ($data['id_user'] != $data_id){
							$data_pengguna = $data['id_user']; 
							echo "<a href='?page=WjtiAot&kode=$data_pengguna' title='Ubah'
							 class='btn btn-success btn-sm'>
								<i class='fa fa-edit'></i>
							</a>
							<a href='?page=WhtuAot&kode=$data_pengguna' onclick='return confirm('Hapus Data Ini ?')'
							 title='Hapus' class='btn btn-danger btn-sm'>
								<i class='fa fa-trash'></i>
								</a>

							";}?>
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
	<!-- /.card-body -->