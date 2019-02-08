<?php
$mode		= $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
	$act		= "act_edt";
	$idp		= $datpil->id;
	$nama_satuan	= $datpil->nama_satuan;
	
} else {
	$act				= "act_add";
	$idp				= "";
	$nama_satuan			= "";
}
?>
<div class="navbar navbar-inverse">
	<div class="container" style="z-index: 0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Pengaturan Satker</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->
	
	<form action="<?php echo base_URL(); ?>admin/manage_satker/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	<div class="row-fluid well" style="overflow: hidden">
	
	<div class="col-lg-6">
		<table width="100%" class="table-form">
			<tr>
				<td width="40%">Nama Satuan Kerja</td><td><b><input type="text" name="nama_satuan" required value="<?php echo $nama_satuan; ?>" style="width: 300px" class="form-control" tabindex="1" autofocus></b></td>
			</tr>
		</table>
		<br><br>
	</div>
		<div style="text-align: right; margin-top: 5%;">
			<button type="submit" class="btn btn-primary" tabindex="7" ><i class="icon icon-ok icon-white"></i> Simpan</button>
			<a href="<?php echo base_URL(); ?>admin/manage_satker" class="btn btn-success" tabindex="8" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
		</div>
	</div>
	
	</form>
