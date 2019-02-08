<?php
$aksi		= $this->uri->segment(3);

if ($aksi == "edt" || $aksi == "act_edt") {
	$aksi		= "act_edt";
	$namkeg		= $datas->nama_lemari;
	$idp 	= $datas->id_lemari;
	$rk		= $datas->id_ruang;
	// var_dump($datas);
	// die();	
}else{
	$aksi	="save";
	$namkeg = "";
	$idp 	= "";
	$rk		= "";
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
			<span class="navbar-brand" href="#">Master Lemari</span>
		</div>
	</div><!-- /.container -->
</div>

<form action="<?php echo base_URL()?>admin/master_lemari/<?php echo $aksi; ?>" method="post" id="formnya">
	<div class="row-fluid well" style="overflow: hidden">
		<div class="col-lg-12">
			<!-- <center> -->
				<input type="hidden" name="idp" value="<?php echo $idp; ?>">
				<table width="60%" class="table-form">
					<tr>
						<td>Ruangan</td>
						<td>
							<select name="rknya" id="rknya" class="form-control" style="width: 400px;"><option value="" style="display:none;">- Pilih Ruang -</option>
							<?php foreach ($data as $key){ 
								if($rk != $key->id_ruang){
							?>
							<option value="<?php echo $key->id_ruang ?>"><?php echo $key->nama_ruang ?></option>
							<?php }else{
							 ?>
							<option value="<?php echo $rk ?>" selected="selected"><?php echo $key->nama_ruang ?></option>
							<?php } } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Nama Lemari</td>
						<td><textarea style="width: 400px;" tabindex="9" id="nama_lemari" name="nama_lemari" class="form-control"><?php echo $namkeg; ?></textarea></td>
					</tr>
				</table>
				<br/>
<!-- 				<?php //if($aksi == "edt"){ ?>
				<button type="submit" class="btn btn-success" tabindex="7" >Simpan</button>
				<?php //} else { ?>
				<a tabindex="11" style="float:right;" class="btn btn-success" id="proses">
					Simpan
				</a>
				<?php //} ?>
			</center> -->
		</div>
		<div style="text-align: right; margin-top: 2%;">
			<?php if($aksi == "edt"){ ?>
				<button type="submit" class="btn btn-primary" tabindex="7" ><i class="icon icon-ok icon-white"></i> Simpan</button>
			<?php }else{ ?>
				<button id="proses" class="btn btn-primary" tabindex="7" ><i class="icon icon-ok icon-white"></i> Simpan</button>
			<?php } ?>
			<a href="<?php echo base_URL(); ?>admin/master_lemari/m_lemari" class="btn btn-success" tabindex="8" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
		</div>
	</div>
</form>
<script>
	$('#proses').click(function(){						
		var validate_perihal = validate($("textarea[name='nama_lemari']").val());
		if($("textarea[name='nama_lemari']").val()==""){
			alert("Harap isi nama lemarinya");
		}else if(validate_perihal=="failed"){
			alert("Harap tidak menggunakan kutip (') dan backslash (\\)");
		}else{
			$('#formnya').submit();
		}
	});
	
</script>