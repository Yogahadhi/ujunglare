<?php
include "../inc/koneksi.php";

if (isset($_POST['Cetak'])) {
	$id = $_POST['id_mendu'];
}

$tanggal = date("m/y");
$tgl = date("d/m/y");
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>CETAK SURAT</title>
	<style>
		@page {
			size: auto;
			margin: 0;
		}

		body {
			padding: 50px;
		}

		img {
			width: 80px;
			margin-left: 0px;
		}

		table.kop {
			width: 100%;
			border-bottom: 5px solid #000;
		}

		p.ttd {
			margin-left: 60%;
		}
	</style>
</head>

<body>
	<table class="kop">
		<tr>
			<td><img src="../dist/img/pare.png"></td>
			<td class="tekskop">
				<center>
					<h2>PEMERINTAH KABUPATEN PAREPARE</h2>
					<h3>KECAMATAN SOREANG
						<br>KELURAHAN UJUNG LARE
					</h3>
				</center>
			</td>
			<td><img src="../dist/img/pare.png"></td>
		</tr>
	</table>
	<?php
	$sql_tampil = "select m.id_mendu, m.tgl_mendu, m.sebab, p.nik, p.nama from tb_mendu m 
	inner join tb_pdd p on m.id_pdd=p.id_pend
	where id_mendu ='$id'";

	$query_tampil = mysqli_query($koneksi, $sql_tampil);
	$no = 1;
	while ($data = mysqli_fetch_array($query_tampil, MYSQLI_BOTH)) {
	?>

		<center>
			<h4>
				<u>SURAT KETERANGAN KEMATIAN</u>
			</h4>
			<h4>No Surat :
				<?php echo $data['id_mendu']; ?>/Ket.Kematian/
				<?php echo $tanggal; ?>
			</h4>
		</center>
		<p>Yang bertandatangan dibawah ini kepala Kelurahan Ujung Lare, Kecamatan Soreang, Kabupaten Parepare, dengan ini menerangkan
			bahwa :</P>
		<table>
			<tbody>
				<tr>
					<td>NIK</td>
					<td>:</td>
					<td>
						<?php echo $data['nik']; ?>
					</td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td>
						<?php echo $data['nama']; ?>
					</td>
				</tr>
				<tr>
					<td>Tanggal Kematian</td>
					<td>:</td>
					<td>
						<?php echo $data['tgl_mendu']; ?>
					</td>
				</tr>
				<tr>
					<td>Sebab</td>
					<td>:</td>
					<td>
						<?php echo $data['sebab']; ?>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		<p>Benar-benar telah
			<b>Meninggal Dunia</b>, pada waktu yang telah disebutkan diatas.
			Demikian Surat ini dibuat, agar dapat digunakan sebagai mana mestinya.
		</P>
		<br>
		<br>
		<br>
		<br>
		<p align="center" class="ttd">
			Ujung Lare,
			<?php echo $tgl; ?>
			<br>Kepala Kelurahan Ujung Lare
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>(Muhammad Suryanzah, ST.)
		</p>

		<script>
			window.print();
		</script>

</body>

</html>