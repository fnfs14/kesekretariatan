<div class="navbar navbar-inverse">
    <div class="container z0">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Master Arsip Surat</span>
        </div>
    </div><!-- /.container -->
</div>

<form action="<?php echo base_URL() ?>administrator/master_arsip_surat/update/<?= $data->id_arsip_surat; ?>" method="post" id="formnya">
    <div class="row-fluid well" style="overflow: hidden">
        <div class="col-lg-12">
            <center>
                <table width="90%" class="table-form">
                    <tr>
                        <td width="20%">Jenis Surat</td>
                        <td>
                            <div class="col-lg-6">
                                <select class="form-control col-md-2" id="jenis_surat"
                                       name="jenis_surat" disabled>
									   <option value="surat_masuk" <?= ($data->tipe_surat=='surat_masuk')?'selected':'';?>>Surat Masuk</option>
									   <option value="surat_keluar" <?= ($data->tipe_surat=='surat_keluar')?'selected':'';?>>Surat Keluar</option>
								</select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">Surat</td>
                        <td>
                            <div class="col-lg-5">
								<input type="text" id="agenda" class="form-control" value="<?= $data->agenda ?>" name="agenda" disabled>
                            </div>
                            <div class="col-lg-1">
								<a class="btn btn-primary btn-md" id="check_agenda" disabled><span class="icon-search icon-white"></span></a>
                            </div>
                            <div class="col-lg-6" id="result_search" style="color:red;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Ruang</td>
                        <td>
                            <div class="col-lg-6">
                                <select class="form-control col-md-2" id="ruang"
                                       name="ruang" required>
									   <option value="" style="display:none;">Pilih</option>
								<?php $ruang = $this->db->query("SELECT * FROM master_ruang")->result();
								foreach ($ruang as $key) {
									echo "<option value='$key->id_ruang'>$key->nama_ruang</option>";
								} ?>
								</select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Lemari</td>
                        <td>
                            <div class="col-lg-6">
                                <select class="form-control col-md-2" id="lemari"
                                       name="lemari" required>
									   <option value="" style="display:none;">Pilih</option>
								</select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Rak</td>
                        <td>
                            <div class="col-lg-6">
                                <select class="form-control col-md-2" id="rak"
                                       name="rak" required>
									   <option value="" style="display:none;">Pilih</option>
								</select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Box</td>
                        <td>
                            <div class="col-lg-6">
                                <select class="form-control col-md-2" id="box"
                                       name="box" required>
									   <option value="" style="display:none;">Pilih</option>
								</select>
                            </div>
                        </td>
                    </tr>
                </table>
                <br/><a tabindex="11" style="float:right;margin-right: 80px;" class="btn btn-success" id="proses">
                    Simpan
                </a>
            </center>
        </div>
    </div>
</form>
<script>
    $('#proses').click(function () {
		if($("#ruang").val()=="" || $("#lemari").val()=="" || $("#rak").val()=="" || $("#box").val()==""){
			alert("Harap untuk mengisi semua data.");
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
            selector: '#isi_arsip_surat',
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
	
	function click_check(id,table,primary,where,result_){
		$.ajax({
			url: "<?php echo base_url(); ?>administrator/get_data_db_surat",
			type: 'post',
			data: {
				id:id,
				table:table,
				primary:primary,
				where:where
			},
			success: function(result){
				// alert(result);
				if(result_=="result_search"){
					if(result==1){
						$("#result_search").html("Surat belum terarsip. Silakan diarsip.");
						$('#proses').removeAttr('disabled');
					}else if(result==2){
						$("#result_search").html("Surat tidak ada.");
						$('#proses').attr('disabled','disabled');
					}else{
						$("#result_search").html("Surat sudah terarsip.");
						$('#proses').attr('disabled','disabled');
					}
				}
			}
		});
	}
	function click_a(id,table,primary,where,result_,name){
		$.ajax({
			url: "<?php echo base_url(); ?>administrator/get_data_db_arsip",
			type: 'post',
			data: {
				id:id,
				table:table,
				primary:primary,
				where:where,
				name:name
			},
			success: function(result){
				$("#" + result_).html(result);
				if(table=="master_lemari"){
					$("#rak").html("<option value='' style='display:none;'>Pilih</option>");
					$("#box").html("<option value='' style='display:none;'>Pilih</option>");
				}else if(table=="master_rak"){
					$("#box").html("<option value='' style='display:none;'>Pilih</option>");
				}
			}
		});
	}
	$("#check_agenda").click(function(){
		click_check($('#agenda').val(),$('#jenis_surat').val(),'id','no_surat','result_search');
	});
	$("#ruang").change(function(){
		click_a($('#ruang').val(),'master_lemari','id_lemari','id_ruang','lemari','nama_lemari');
	});
	$("#lemari").change(function(){
		click_a($('#lemari').val(),'master_rak','id_rak','id_lemari','rak','nama_rak');
	});
	$("#rak").change(function(){
		click_a($('#rak').val(),'master_box','id_box','id_rak','box','nama_box');
	});
	var ruang_db = <?= $data->ruang; ?>;
	var lemari_db = <?= $data->lemari; ?>;
	var rak_db = <?= $data->rak; ?>;
	var box_db = <?= $data->box; ?>;
	$('#ruang').val(ruang_db);
	// click_a($('#ruang').val(),'master_lemari','id_lemari','id_ruang','lemari','nama_lemari');
	// $('#lemari').val(lemari_db);
	// click_a($('#lemari').val(),'master_rak','id_rak','id_lemari','rak','nama_rak');
	// $('#rak').val(rak_db);
	// click_a($('#rak').val(),'master_box','id_box','id_rak','box','nama_box');
	// $('#box').val(box_db);
	$.ajax({
		url: "<?php echo base_url(); ?>administrator/get_data_db_arsip",
		type: 'post',
		data: {
			id:$('#ruang').val(),
			table:'master_lemari',
			primary:'id_lemari',
			where:'id_ruang',
			name:'nama_lemari'
		},
		success: function(result){
			$("#lemari").html(result);
			$('#lemari').val(lemari_db);
			$.ajax({
				url: "<?php echo base_url(); ?>administrator/get_data_db_arsip",
				type: 'post',
				data: {
					id:$('#lemari').val(),
					table:'master_rak',
					primary:'id_rak',
					where:'id_lemari',
					name:'nama_rak'
				},
				success: function(result){
					$("#rak").html(result);
					$('#rak').val(rak_db);
					$.ajax({
						url: "<?php echo base_url(); ?>administrator/get_data_db_arsip",
						type: 'post',
						data: {
							id:$('#rak').val(),
							table:'master_box',
							primary:'id_box',
							where:'id_rak',
							name:'nama_box'
						},
						success: function(result){
							$("#box").html(result);
							$('#box').val(rak_db);
						}
					});
				}
			});
		}
	});
</script>