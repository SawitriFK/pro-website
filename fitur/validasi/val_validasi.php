<?php
//Mulai Sesion
if (isset($_SESSION["ses_id"])==""){
header("location: login");

}else{
  $data_id = $_SESSION["ses_id"];
  $data_user = $_SESSION["ses_user"];
  $data_tipe = $_SESSION["ses_tipe"];

}

//KONEKSI DB
include "inc/koneksi.php";

if(isset($_GET['kode'])){

    $sql_kode = "SELECT * FROM pinjam JOIN konfirmasi ON pinjam.id_pinjam=konfirmasi.id_pinjam 
                where pinjam.id_pinjam='".$_GET['kode']."'";
    $query_kode = mysqli_query($koneksi, $sql_kode);
    $data_kode = mysqli_fetch_array($query_kode,MYSQLI_BOTH);


    $cek = "SELECT * FROM pinjam JOIN konfirmasi ON pinjam.id_pinjam=konfirmasi.id_pinjam";
    $sql_waktu = $koneksi->query($cek);			
    $jawab=true;
    while ($data_waktu= $sql_waktu->fetch_assoc()) {


        if($data_kode['id_ruang']==$data_waktu['id_ruang'] AND $data_kode['tanggal']==$data_waktu['tanggal'] AND $data_waktu['tanggapan']==1){
            if (($data_kode['waktu_mulai']<=$data_waktu['waktu_mulai'] AND $data_waktu['waktu_akhir']<=$data_kode['waktu_akhir']) OR
                ($data_kode['waktu_mulai']<=$data_waktu['waktu_mulai'] AND $data_waktu['waktu_mulai']<=$data_kode['waktu_akhir'] AND $data_kode['waktu_akhir']<=$data_waktu['waktu_akhir']) OR
                ($data_waktu['waktu_mulai']<=$data_kode['waktu_mulai'] AND $data_kode['waktu_mulai']<=$data_waktu['waktu_akhir'] AND $data_waktu['waktu_akhir']<=$data_kode['waktu_akhir']) OR
                ($data_waktu['waktu_mulai']<=$data_kode['waktu_mulai'] AND $data_kode['waktu_mulai']<=$data_waktu['waktu_akhir'] AND $data_waktu['waktu_mulai']<=$data_kode['waktu_akhir'] AND $data_kode['waktu_akhir']<=$data_waktu['waktu_akhir'])
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
        Swal.fire({title: 'Sudah Dipinjam dan Divalidasi',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value){
            window.location = 'index.php?uPsRHlo';
            }
        })</script>";
        
     }elseif($jawab==true){



        $sql_ubah = "UPDATE konfirmasi SET tanggapan='1', id_user=$data_id WHERE id_pinjam='".$_GET['kode']."'";
        $query_ubah = mysqli_query($koneksi, $sql_ubah);
        mysqli_close($koneksi);

            if ($query_ubah) {
                echo "<script>
                    window.location = 'index.php?page=uHsRHju';
                    </script>";
                }else{
                echo "<script>
                Swal.fire({title: 'Validasi Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=uHsRHju';
                    }
                })</script>";
            }
        }
    }

