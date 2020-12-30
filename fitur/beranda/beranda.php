<div class="realtime">

<?php
$koneksi = new mysqli ("localhost","id15797428_root","PengWeb2020=","id15797428_pro");

date_default_timezone_set('Asia/Jakarta');
$today= date("Y-m-d");
$today2 = date("l, d F Y");

?>


<div class="text-center jumbotron">
<h3 class="font-weight-bold">JADWAL HARI INI</h3>
<p> <?php echo $today2;?></p>

</div>
<div class="row">
<?php

		$sql = $koneksi->query("select * from ruang");
		while ($data= $sql->fetch_assoc()) {

		?>
	<div class="col-lg-4 col-sm-4">
		<!-- small box -->
		<div class="small-box bg-info">
			<div class="inner text-center">
				<h5>
					<?php echo $data['nama_ruang']; ?>
				</h5>
			</div>
			<tbody>
			<div class="small-box-footer">
			
				<?php
				$sqli = $koneksi->query("select * from pinjam 
										join konfirmasi ON
										konfirmasi.id_pinjam=pinjam.id_pinjam
										where pinjam.id_ruang = '".$data['id_ruang']."' 
										AND konfirmasi.tanggapan=1 
										AND pinjam.tanggal='".$today."'
										ORDER BY pinjam.waktu_mulai ASC");
				$cek_kosong = mysqli_num_rows($sqli);

				if ($cek_kosong==0){
					echo "<div class='font-italic'>Jadwal Kosong</div>";
				}
				while ($datawaktu= $sqli->fetch_assoc()) {
					echo $datawaktu['waktu_mulai'];
					echo " - ";
					echo $datawaktu['waktu_akhir']; 
					echo "<br>";
				}
			
				?>
				</div>
				</tbody>
		</div>
	</div>
	<?php
}
?>
</div>
</div>