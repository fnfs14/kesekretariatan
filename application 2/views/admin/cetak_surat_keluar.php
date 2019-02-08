<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Detail Surat</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->
	<form action="#" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="formnya">
	
	<input type="hidden" name="idp" value="<?php //echo $idp; ?>">
	
	<div class="row-fluid well" style="overflow: hidden">
	
	<div class="col-lg-6">
		<caption><h3>Agenda SETUM</h3></caption>
		<table width="100%" class="table-form">
		<tr>
			<td>No. Agenda</td>
			<td><b><input type="text" name="noagenda" required value="<?php echo $data->no_setum; ?>" id="noagenda" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Tanggal SETUM</td>
			<td><b><input type="text" name="noagenda" required value="<?php echo $data->tgl_setum; ?>" id="noagenda" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Klasifikasi</td>
			<td><b><input type="text" name="noagenda" required value="<?php echo $data->klasifikasi; ?>" id="noagenda" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Derajat</td>
			<td><b><input type="text" name="noagenda" required value="<?php echo $data->drajat; ?>" id="noagenda" style="" class="form-control"></b></td>
		</tr>
		</table>
	</div>
	<div class="col-lg-6">
		<caption><h3>Detail Surat</h3></caption>
		<table width="100%" class="table-form">
		<tr>
			<td>Dari</td>
			<td><b><input type="text" name="dari" required value="<?=$data->nama_instansi;?>" id="dari" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Nomor Surat</td>
			<td><b><input type="text" name="no_surat" required value="<?php echo $data->no_surat; ?>" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Tanggal Surat</td>
			<td><b><input type="text" name="tgl_surat" required value="<?php echo $data->tgl_surat; ?>" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Perihal</td>
			<td><b><textarea name="perihal" required style="" class="form-control"><?php echo $data->perihal; ?></textarea></b></td>
		</tr>
		<tr>
			<td>Diteruskan Kepada</td>
			<td><b><input type="text" name="kepada" required value="<?php echo $jabatan->nama_jabatan; ?>" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td><b><textarea name="ket" required style="" class="form-control"><?php echo $data->keterangan; ?></textarea></b></td>
		</tr>
		<tr>
			<td>Lampiran</td>
			<td><b><a href="<?= site_url(); ?>upload/surat_masuk/<?= $data->file_attachment; ?>"><?= $data->file_attachment; ?></a></b></td>
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
			<?php
				$selected = "";
				$count_alamat_aksi = 1;
				foreach($alamat_aksi as $abc){
					if($count_alamat_aksi==1){
						echo "<tr>";
					}
					if(isset($jabatan_tembusan[$abc->id])){
						$selected = "checked";
					}else{
						$selected = "";
					}
					echo '<td><label><input type="checkbox" name="" id="" class=""'. $selected .'> '. $abc->nama_jabatan .'</label></td>';
					if($count_alamat_aksi==3){
						echo "</tr>";
						$count_alamat_aksi = 0;
					}
					$count_alamat_aksi = $count_alamat_aksi + 1;
				}
			?>
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
			<?php
				$count_aksinya = 1;
				$selectednya = "";
				foreach($aksinya as $abc){
					if($count_aksinya==1){
						echo "<tr>";
					}
					if(isset($aksi_tembusan[$abc->id])){
						$selected = "checked";
					}else{
						$selected = "";
					}
					echo '<td><label><input type="checkbox" name="" id="" class=""'. $selected .'> '. $abc->nama_aksi .'</label></td>';
					if($count_aksinya==3){
						echo "</tr>";
						$count_aksinya = 0;
					}
					$count_aksinya = $count_aksinya + 1;
				}
			?>
			</tbody>
		</table>
	</div>
	<br/>
	<div>
		<h4>DISPOSISI / CATATAN :</h4>
		<b><textarea name="ket" required style="" class="form-control"><?= $tembusan[0]->keterangan; ?></textarea></b>
		<br/>
		<?php 
		$noset = str_replace("/","_", $data->no_setum);
		?>
		<a href="<?= base_url(); ?>admin/cetak_surat_masuk/<?= $noset; ?>" class="btn btn-info" target="_blank">Cetak</a>
	</div>
	</div>
	</div>
	<script>
		$(document).ready(function(){
			$('label').css('font-weight','normal');
			$('h4').css('font-weight','bold');
		});
	</script>