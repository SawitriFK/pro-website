<?php


    if (isset($_SESSION["ses_id"])==""){
	    header("location: login");
    
    }else{
      $data_id = $_SESSION["ses_id"];


        $sql_cek = "SELECT * FROM user WHERE id_user='".$data_id."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);

?>

<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ubah Data</h3>
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
				<label class="col-sm-2 col-form-label">Sandi Lama</label>
				<div class="col-sm-6">
					<input type="password" class="form-control" id="pass" name="sandi_user0"/>
				</div>
			</div>

            <div class="form-group row">
				<label class="col-sm-2 col-form-label">Sandi Baru</label>
				<div class="col-sm-6">
					<input type="password" class="form-control" id="pass" name="sandi_user"/>
                    </div>
			</div>
		</div>
		<div class="card-footer">
			<input type="submit" name="ubah" value="Simpan" class="btn btn-success">
			<a href="?page=CdjiydX" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>



<?php

    if (isset ($_POST['ubah'])){
      if(!empty($_POST['sandi_user0']) AND !empty($_POST['sandi_user'])){
            
        if(password_verify($_POST['sandi_user0'], $data_cek["sandi_user"])){
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
        } else{
        echo 
        "<script>alert('Password Lama Anda Salah')</script>";
        die();}
        


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
        {window.location = 'index.php?page=CdjiydX';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=CdjiydX';
        }
      })</script>";
    }}}
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
