<?php
	$idp		= $datpil->id;
	// $no_agenda	= $datpil->no_agenda;
	// $kode		= $datpil->kode;
	$dari		= $datpil->kepada;
	$kepada		= $datpil->dari;
	$no_surat	= $datpil->no_surat;
	$tgl_surat	= $datpil->tgl_surat;
	$uraian		= $datpil->isi;
	$ket		= $datpil->keterangan;
	$perihal	= $datpil->perihal;
	$isi_surat	= $datpil->isi;
?>
<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Detail Surat</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->
	<form action="#" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="formnya">
	
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	<div class="row-fluid well" style="overflow: hidden">
	
	<div class="col-lg-6">
		<caption><h3>Agenda SETUM</h3></caption>
		<table width="100%" class="table-form">
		<tr>
			<td>No. Agenda</td>
			<td><b><input type="text" name="noagenda" required value="<?php //echo $dari; ?>" id="noagenda" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Tanggal SETUM</td>
			<td><b><input type="text" name="noagenda" required value="<?php //echo $dari; ?>" id="noagenda" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Klasifikasi</td>
			<td><b><input type="text" name="noagenda" required value="<?php //echo $dari; ?>" id="noagenda" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Derajat</td>
			<td><b><input type="text" name="noagenda" required value="<?php //echo $dari; ?>" id="noagenda" style="" class="form-control"></b></td>
		</tr>
		</table>
	</div>
	<div class="col-lg-6">
		<caption><h3>Detail Surat</h3></caption>
		<table width="100%" class="table-form">
		<tr>
			<td>Dari</td>
			<td><b><input type="text" name="dari" required value="<?php
				foreach($user_n as $a){
					if($a->id == $kepada){
						echo "$a->nama_lengkap";
					}
				}
			?>" id="dari" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Nomor Surat</td>
			<td><b><input type="text" name="no_surat" required value="<?php echo $no_surat; ?>" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Tanggal Surat</td>
			<td><b><input type="text" name="tgl_surat" required value="<?php echo $tgl_surat; ?>" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Perihal</td>
			<td><b><textarea name="perihal" required style="" class="form-control"><?php echo $perihal; ?></textarea></b></td>
		</tr>
		<tr>
			<td>Diteruskan Kepada</td>
			<td><b>
				<select class="form-control">
					<?php
						foreach($user_n as $a){
							if($a->id == $dari){
								echo "<option selected>$a->nama_lengkap</option>";
							}
						}
					?>
				</select>
			</b></td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td><b><textarea name="ket" required style="" class="form-control"><?php echo $ket; ?></textarea></b></td>
		</tr>
		<tr>
			<td>Lampiran</td>
			<td><b><input type="file" name="file_surat" class="form-control" style=""></b></td>
		</tr>
		</table>
	</div>
	</div>
	</form>

<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Disposisi KADIS</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->
	
	<div class="row-fluid well" style="overflow: hidden;padding:30px;">
	
	<div class="col-lg-12">
	<div style="border:solid 1px black;padding:20px;border-radius:10px;background:white;">
		<table width="100%" class="table-form" style="background:white;">
			<thead>
				<tr>
					<th colspan="4" style="text-align:center;">Alamat Aksi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><label><input type="checkbox" name="" id="" class=""> KASUBDIS BANGSIS</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> PAREN</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> ADMIN SERVER</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> KAUR TU</label></td>
				</tr>
				<tr>
					<td><label><input type="checkbox" name="" id="" class=""> KASUBDIS DUKNIS</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> UR KEU</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> WEB MASTER</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> </label></td>
				</tr>
				<tr>
					<td><label><input type="checkbox" name="" id="" class=""> KASUBDIS PEN</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> UR LOG</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> UR DATA  RAHASIA</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> </label></td>
				</tr>
			</tbody>
		</table>
	</div>
	<br/>
	<div style="border:solid 1px black;padding:20px;border-radius:10px;background:white;">
		<table width="100%" class="table-form" style="background:white;">
			<thead>
				<tr>
					<th colspan="4" style="text-align:center;">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><label><input type="checkbox" name="" id="" class=""> ACC</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> TANGGAPAN DAN SARAN</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> WAKILI / TENTATIF</label></td>
				</tr>
				<tr>
					<td><label><input type="checkbox" name="" id="" class=""> TINDAK LANJUTI</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> LAPORKAN</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> HADIR</label></td>
				</tr>
				<tr>
					<td><label><input type="checkbox" name="" id="" class=""> ACARAKAN</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> KORDINASIKAN</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> TIDAK HADIR</label></td>
				</tr>
				<tr>
					<td><label><input type="checkbox" name="" id="" class=""> SIAPKAN</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> IKUTI PERKEMBANGAN</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> SEBAGAI BAHAN</label></td>
				</tr>
				<tr>
					<td><label><input type="checkbox" name="" id="" class=""> DUKUNG</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> SUPERVISI</label></td>
					<td><label><input type="checkbox" name="" id="" class=""> ARSIP</label></td>
				</tr>
			</tbody>
		</table>
	</div>
	<br/>
	<div>
		<h4>DISPOSISI / CATATAN :</h4>
		<b><textarea name="ket" required style="" class="form-control"></textarea></b>
	</div>
	</div>
	</div>
	<script>
		$(document).ready(function(){
			$('label').css('font-weight','normal');
			$('h4').css('font-weight','bold');
		});
	</script>