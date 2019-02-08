
<div class="navbar navbar-inverse">
	<div class="container" style="z-index: 0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Edit Aksi</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->
	
	<form action="<?php echo base_URL(); ?>admin/aksi_update/<?php  echo $idnya; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
	<input type="hidden" name="idp" value="<?php echo $idnya; ?>">
	
	<div class="row-fluid well" style="overflow: hidden">
	<?php foreach($data as $re){ ?>
	<div class="col-lg-6">
		<table width="100%" class="table-form">
			<tr>
				<td width="40%">Nama Aksi</td><td><b><input type="text" name="nama_aksi" required value="<?php  echo $re->nama_aksi; ?>" style="width: 300px" class="form-control" tabindex="1" autofocus></b></td>
			</tr>
			<tr>
				<td width="40%">Urutan</td><td><b><input type="text" name="urutan" required value="<?php  echo $re->urutan; ?>" style="width: 300px" class="form-control" tabindex="1" autofocus></b></td>
			</tr>
		</table>
		<br><br><br>
	</div>
	<?php } ?>
		<div style="text-align: right; margin-top: 5%;">
			<button type="submit" class="btn btn-primary" tabindex="7" ><i class="icon icon-ok icon-white"></i> Simpan</button>
			<a href="<?php echo base_URL(); ?>admin/master_aksi" class="btn btn-success" tabindex="8" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
		</div>
	</div>
	
	</form>
