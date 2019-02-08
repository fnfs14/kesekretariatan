<?php
	$idp		= $datpil->id;
	// $no_agenda	= $datpil->no_agenda;
	// $kode		= $datpil->kode;
	$dari		= $datpil->create_by;
	$kepada		= $datpil->kepada;
	$no_surat	= $datpil->no_surat;
	$tgl_surat	= $datpil->tgl_surat;
	$uraian		= $datpil->isi;
	$ket		= $datpil->keterangan;
	$perihal	= $datpil->perihal;
	$isi_surat	= $datpil->isi;
	$file	= $datpil->file_attachment;
?>
<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Detail Nota Dinas</span>
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
			<td><b><input type="text" name="noagenda" required value="<?php echo $datpil->no_agenda; ?>" id="noagenda" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Tanggal SETUM</td>
			<td><b><input type="text" name="noagenda" required value="<?php echo $datpil->tgl_setum; ?>" id="noagenda" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Klasifikasi</td>
			<td><b><input type="text" name="noagenda" required value="<?php echo $datpil->klasifikasi; ?>" id="noagenda" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Derajat</td>
			<td><b><input type="text" name="noagenda" required value="<?php echo $datpil->drajat; ?>" id="noagenda" style="" class="form-control"></b></td>
		</tr>
		</table>
	</div>
	<div class="col-lg-6">
		<caption><h3>Detail Nota Dinas</h3></caption>
		<table width="100%" class="table-form">
		<tr>
			<td>Dari</td>
			<td><b><input type="text" name="dari" required value="<?php
				foreach($user_n as $a){
					if($a->id == $dari){
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
			<td><b><input type="text" name="kepada" required value="<?php
				foreach($user_n as $a){
					if($a->id == $kepada){
						echo "$a->nama_lengkap";
					}
				}
			?>" id="dari" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td><b><textarea name="ket" required style="" class="form-control"><?php echo $ket; ?></textarea></b></td>
		</tr>
		<tr>
			<td>Lampiran</td>
			<td><b><a href="<?php echo base_URL()?>upload/nota_dinas/<?php echo $file ?>" target="_blank"><?php echo $file; ?></a></b></td>
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
		<div class="row">
			<div class="col-md-6">
				<h4>List Alamat Aksi</h4>
				<table cellspacing="5px" cellpadding="5px" border="1" width="100%">
					<tr>
						<td width="10%">No</td>
						<td>Nama Jabatan</td>
					</tr>
					<?php
						$dsfghj = 1;
						foreach($tembusan as $a){
							echo "<tr>
								<td>$dsfghj</td>
								<td>$a->nama_jabatan</td>
							</tr>";
							$dsfghj = $dsfghj + 1;
						}
					?>
				</table>
			</div>
			<div class="col-md-6">
				<h4>DISPOSISI / CATATAN</h4>
				<textarea class="form-control"><?= $tembusan['0']->keterangan; ?></textarea>
			</div>
		</div>
	</div>
	</div>
	</div>
	<script>
		$(document).ready(function(){
			$('label').css('font-weight','normal');
			$('h4').css('font-weight','bold');
		});
	</script>