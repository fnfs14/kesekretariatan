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
			<span class="navbar-brand" href="#">Master Surat Masuk</span>
		</div>
	</div><!-- /.container -->
</div>
<?php foreach ($data_surat_masuk as $value) {?>
<form action="<?php echo site_url('administrator/master_surat_masuk/update/'.$value->id_jenis_surat_masuk.'')?>" method="post" id="formnya">
	<div class="row-fluid well" style="overflow: hidden">
		<div class="col-lg-12">
			<center>
				<table width="90%" class="table-form">
                    <tr>
                        <td>Jenis Surat Masuk</td>
                        <td>
                            <div class="col-lg-6">
                                <input type="text" class="form-control col-md-2" id="jenis_surat_masuk"
                                       name="jenis_surat_masuk" value='<?php echo $value->nama_jenis_surat?>'>
                            </div>
                        </td>
                    </tr>
					<tr style="display: none !important;">
						<td>Isi Surat Masuk</td>
						<td><div class="col-lg-6"><textarea style="width: 400px;" tabindex="9" id="isi_surat_masuk"
                                                            name="isi_surat_masuk"
                                                            class="form-control"><?php echo $value->isi_jenis_surat?></textarea></div>
                            </td>
					</tr>
				</table>
				<br/><a tabindex="11" style="float:right;margin-right: 80px;" class="btn btn-success" id="proses">
					Update
				</a>
			</center>
		</div>
	</div>
</form>
<?php } ?>
<script>
	$('#proses').click(function(){
		var jenis_surat_masuk = validate($("input[name='jenis_surat_masuk']").val());
		if($("input[name='jenis_surat_masuk']").val()==""){
			alert("Harap isi jenis surat masuk");
		}else if(jenis_surat_masuk=="failed"){
			alert("Harap tidak menggunakan kutip (') dan backslash (\\)");
		}else{
			$('#formnya').submit();
		}
	});

</script>
<script src="<?php echo base_url(); ?>aset/tinymce/jquery.tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>aset/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
    $(function () {
        tinymce.init({
            selector: '#isi_surat_masuk',
            theme: "modern",
            width: 800,
            height: 400,
            relative_urls: false,
            remove_script_host: false,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager code"
            ],
            toolbar: "insertfile undo redo pastetext | styleselect | sizeselect | bold italic | fontselect | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | responsivefilemanager | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ],
            fontsize_formats: "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 24pt 36pt",
            external_filemanager_path:"<?php echo base_url()?>/filemanager/",
            filemanager_title:"Responsive Filemanager" ,
            external_plugins: { "filemanager" : "<?php echo base_url()?>/filemanager/plugin.min.js"},
            branding: false
        });
    })
</script>
