<?php
    if (isset($_SESSION["ses_id"])==""){
        header("location: login");
        
        }else{
          $data_id = $_SESSION["ses_id"];
          $data_user = $_SESSION["ses_user"];
          $data_sandi = $_SESSION["ses_sandi"];
          $data_tipe = $_SESSION["ses_tipe"];
        }

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM user WHERE id_user='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ubah Data Mahasiswa</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">ID</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="id_user" name="id_user" value="<?php echo $data_cek['id_user']; ?>"
					readonly/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_user" name="nama_user" value="<?php echo $data_cek['nama_user']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Sandi</label>
				<div class="col-sm-6">
					<input type="password" class="form-control" id="pass" name="sandi_user"	/>
					<input id="mybutton" onclick="change()" type="checkbox" class="form-checkbox"> Lihat Password
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=AmDatma" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>



<?php

    if (isset ($_POST['Ubah'])){

        if(!empty($_POST['sandi_user'])){
                $options = [
                    'cost' => 10,
                ];
                $hashedPass = password_hash($_POST['sandi_user'], PASSWORD_DEFAULT, $options);
                $sql_ubah = "UPDATE user SET
                    nama_user='".$_POST['nama_user']."',
                    sandi_user='".$hashedPass."'
                    WHERE id_user='".$_POST['id_user']."'";
                $query_ubah = mysqli_query($koneksi, $sql_ubah);
                mysqli_close($koneksi);
        }else{
                $sql_ubah = "UPDATE user SET
                nama_user='".$_POST['nama_user']."'
                WHERE id_user='".$_POST['id_user']."'";
                $query_ubah = mysqli_query($koneksi, $sql_ubah);
                mysqli_close($koneksi);
        }


    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=AmDatma';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=AmDatma';
        }
      })</script>";
    }}
?>

<script type="text/javascript">
    function change()
    {
    var x = document.getElementById('pass').type;

    if (x == 'password')
    {
        document.getElementById('pass').type = 'text';
        document.getElementById('mybutton').innerHTML;
    }
    else
    {
        document.getElementById('pass').type = 'password';
        document.getElementById('mybutton').innerHTML;
    }
    }
</script>