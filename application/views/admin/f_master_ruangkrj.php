<?php
$aksi		= $this->uri->segment(3);

if ($aksi == "edt" || $aksi == "act_edt") {
	$aksi		= "act_edt";
	$nama_krj		= $datas->nama_krj;
	$id_jenissurat		= $datas->id_jenissurat;
	$idp 	= $datas->id_ruang_kerja;
	$id_rk = $datas->id_workspace;
	// var_dump($id_rk);
	// die();
	// var_dump($datas);
	// die();	
}else{
	$aksi	="save";
	$nama_krj = "";
	$id_jenissurat = "";
	$idp 	= "";
	$id_rk = "";
}
?>
<script>
function validate(str) {
	// var n = str.includes("/");
    // if(n===false){
    	var n = str.includes("\\");
        if(n===false){
        	var n = str.includes("'");
            if(n===false){
            	// var n = str.includes('"');
                // if(n===false){
					return "success";
                // }else{
					// return "failed";
				// }
            }else{
				return "failed";
			}
        }else{
			return "failed";
		}
    // }else{
		// return "failed";
	// }
}
</script>
<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Master Ruang Kerja</span>
		</div>
	</div><!-- /.container -->
</div>

<form action="<?php echo base_URL()?>admin/manage_ruangkrj/<?php echo $aksi; ?>" method="post" id="formnya">
	<div class="row-fluid well" style="overflow: hidden">
		<div class="col-lg-12">
				<input type="hidden" name="idp" value="<?php echo $idp; ?>">
				<?php // echo $aksi; ?>
				<table width="60%" class="table-form">
					<!-- <tr>
						<td>Ruang Kerja</td>
						<td>
							<select name="rknya" id="rknya">
							<?php //foreach ($query as $key){ 
								//if($id_rk != $key->id){
							?>
							<option value="<?php //echo $key->id ?>"><?php //echo $key->name ?></option>
							<?php //}else{
							 ?>
							<option value="<?php //echo $id_rk ?>" selected="selected"><?php //echo $key->name ?></option>
							<?php //} } ?>
							</select>
							<input type="text" name="namaworkspace" hidden="hidden">
						</td>
					</tr> -->
					<tr>
						<td>Jenis Surat</td>
						<td>
						 <select name="id_jenissurat" id="id_jenissurat" class="form-control" width="80%">
                    <option value="0">-- Pilih Jenis Surat --</option>  
                    <?php foreach ($jenissurat as $key){                         
                    ?>
                    <option value="<?php echo $key->id_master_surat_masuk; ?>" <?php if($id_jenissurat == $key->id_master_surat_masuk){ echo "selected"; }?>><?php echo $key->jenis_surat_masuk ?></option>
                    <?php } ?>
                    </select>
						</td>
					</tr>
					<tr>
						<td>Nama Ruang Kerja</td>
						<td><textarea tabindex="9" id="nama_krj" name="nama_krj" class="form-control"><?php echo $nama_krj; ?></textarea></td>
					</tr>
				</table>
				<br/>
				<!-- <a tabindex="11" style="float:right;" class="btn btn-success" id="proses">Simpan</a> -->
		</div>
		<div style="text-align: right; margin-top: 2%;">
			<button id="proses" class="btn btn-primary" tabindex="7" ><i class="icon icon-ok icon-white"></i> Simpan</button>
			<a href="<?php echo base_URL(); ?>admin/manage_ruangkrj/m_ruangkrj" class="btn btn-success" tabindex="8" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
		</div>
	</div>
</form>
<script>
	$('#proses').click(function(){
		var validate_ket = validate($("textarea[name='nama_krj']").val());
		if(validate_ket=="failed"){
			alert("Harap tidak menggunakan kutip (') dan backslash (\\)");
		}else{
			$('#formnya').submit();
		}
	});
		var text = $("#rknya option:selected").text();
		console.log(text);

	
	
</script>