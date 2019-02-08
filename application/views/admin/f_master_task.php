<?php
$aksi		= $this->uri->segment(3);

if ($aksi == "edt" || $aksi == "act_edt") {
	$aksi		= "act_edt";
	$nama_task		= $datas->nama_task;
	$idp 	= $datas->id_task;
	$id_rk = $datas->id_etask;
	// var_dump($id_rk);
	// die();
	// var_dump($datas);
	// die();	
}else{
	$aksi	="save";
	$nama_task = "";
	$idp 	= "";
	$id_rk = "";
}
?>
<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Master Task</span>
		</div>
	</div><!-- /.container -->
</div>

<form action="<?php echo base_URL()?>admin/manage_task/<?php echo $aksi; ?>" method="post" id="formnya">
	<div class="row-fluid well" style="overflow: hidden">
		<div class="col-lg-12">
				<input type="hidden" name="idp" value="<?php echo $idp; ?>">
				<table width="60%" class="table-form">
					<tr>
						<td>Ruang Kerja</td>
						<td>
							<select name="rknya" id="rknya" class="form-control">
							<option value="0">-- Pilih Ruang Kerja --</option>	
							<?php foreach ($query as $key){ 
								if($id_rk != $key->id_ruang_kerja){
							?>
							<option value="<?php echo $key->id_ruang_kerja ?>"><?php echo $key->nama_krj ?></option>
							<?php }else{
							 ?>
							<option value="<?php echo $id_rk ?>" selected="selected"><?php echo $key->nama_krj ?></option>
							<?php } } ?>
							</select>
							<input type="text" name="namaworkspace" hidden="hidden">
						</td>
					</tr>
					<tr>
						<td>Nama Tugas</td>
						<td><textarea tabindex="9" id="nama_task" name="nama_task" class="form-control"><?php echo $nama_task; ?></textarea></td>
					</tr>
				</table>
				<br/>
				<!-- <a tabindex="11" style="float:right;" class="btn btn-success" id="proses">
					Simpan
				</a> -->
		</div>
				<div style="text-align: right; margin-top: 2%;">
					<button id="proses" class="btn btn-primary" tabindex="7" ><i class="icon icon-ok icon-white"></i> Simpan</button>
					<a href="<?php echo base_URL(); ?>admin/manage_task/m_task" class="btn btn-success" tabindex="8" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
				</div>
	</div>
</form>
<script>
	$('#proses').click(function(){
		$('#formnya').submit();
	});
	
</script>