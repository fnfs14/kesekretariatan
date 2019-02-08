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
			<span class="navbar-brand" href="#">Master Kategori</span>
		</div>
	</div><!-- /.container -->
</div>
<?php foreach ($data_kategori as $value) {?>
<form action="<?php echo site_url('administrator/master_kategori/update/'.$value->id_kategori.'')?>" method="post" id="formnya">
	<div class="row-fluid well" style="overflow: hidden">
		<div class="col-lg-12">
			<!-- <center> -->
				<table width="60%" class="table-form">
					<tr>
						<td>Nama Kategori</td>
						<td><textarea style="width: 400px;" tabindex="9" id="nama_kat" name="nama_kat" class="form-control"><?php echo $value->nama_kategori?></textarea></td>
					</tr>
				</table>
				<br/>
				<!-- <a tabindex="11" style="float:right;" class="btn btn-success" id="proses">
					Update
				</a>
			</center> -->
		</div>
		<div style="text-align: right; margin-top: 2%;">
			<button id="proses" class="btn btn-primary" tabindex="7" ><i class="icon icon-ok icon-white"></i> Update</button>
			<a href="<?php echo base_URL(); ?>administrator/master_kategori/m_kategori" class="btn btn-success" tabindex="8" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
		</div>
	</div>
</form>
<?php } ?>
<script>
	$('#proses').click(function(){
		var validate_ket = validate($("textarea[name='nama_kat']").val());
		if($("textarea[name='nama_kat']").val()==""){
			alert("Harap isi nama kategori");
		}else if(validate_ket=="failed"){
			alert("Harap tidak menggunakan kutip (') dan backslash (\\)");
		}else{
			$('#formnya').submit();
		}
	});

</script>
