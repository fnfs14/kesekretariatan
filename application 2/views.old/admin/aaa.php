<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <head>
	<title>Nota Dinas Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?=base_url()?>aset/img/favicon.ico" type="image/gif">
    <meta charset="utf-8">
	<style type="text/css">
	@font-face {
	  font-family: 'Cabin';
	  font-style: normal;
	  font-weight: 400;
	  src: local('Cabin Regular'), local('Cabin-Regular'), url(<?php echo base_url(); ?>aset/font/satu.woff) format('woff');
	}
	@font-face {
	  font-family: 'Cabin';
	  font-style: normal;
	  font-weight: 700;
	  src: local('Cabin Bold'), local('Cabin-Bold'), url(<?php echo base_url(); ?>aset/font/dua.woff) format('woff');
	}
	@font-face {
	  font-family: 'Lobster';
	  font-style: normal;
	  font-weight: 400;
	  src: local('Lobster'), url(<?php echo base_url(); ?>aset/font/tiga.woff) format('woff');
	}	
	
	</style>
    <link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../bower_components/bootstrap/assets/js/html5shiv.js"></script>
      <script src="../bower_components/bootstrap/assets/js/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>aset/js/jquery/jquery-ui.css" />
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>aset/css/nota_dinas_pdf/ckeditor_style.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>aset/js/jquery/jquery.timepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/style.css" media="screen">
  	
    <script src="<?php echo base_url(); ?>aset/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>aset/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>aset/js/bootswatch.js"></script>
	<script src="<?php echo base_url(); ?>aset/js/jquery/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
	<script src="<?php echo base_url(); ?>aset/js/jquery.timepicker.min.js"></script>
	<!--
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=2v8enrqhueks9e1uq6cu94fagp60azqcbead1zncoyox5utu"></script>
  	<script>
  		tinymce.init({ 
  			selector:'textarea',
  			setup: function(editor) {
			    editor.on('keydown', function(event) {
			    	if (event.keyCode == 9 ){
						editor.execCommand('mceInsertContent', false, "&emsp;");
						tinymce.dom.Event.cancel(event);
			    	}
			    });
			}
    	});
    </script>
    -->
	<script type="text/javascript">
	// <![CDATA[
	$(document).ready(function () {
		$(function () {
			$( "#kode_surat" ).autocomplete({
				source: function(request, response) {
					$.ajax({ 
						url: "<?php echo site_url('admin/get_klasifikasi'); ?>",
						data: { kode: $("#kode_surat").val()},
						dataType: "json",
						type: "POST",
						success: function(data){
							response(data);
						}    
					});
				},
			});
		});
		
		$(function () {
			$( "#dari" ).autocomplete({
				source: function(request, response) {
					$.ajax({ 
						url: "<?php echo site_url('admin/get_instansi_lain'); ?>",
						data: { kode: $("#dari").val()},
						dataType: "json",
						type: "POST",
						success: function(data){
							response(data);
						}    
					});
				},
			});
		});
		
		
		$(function() {
			$( "#tgl_surat" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd'
			});
		});

		$(function() {
			$( ".tgl" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd'
			});
		});	

		$(function() {
			$( ".time" ).timepicker({
				timeFormat: "HH:mm",
				interval: 10,
				scrollbar: true,
				dynamic: false	
			});
		});	


		$(function() {
			var textarea = $("textarea");
			for (var i = 0; i < textarea.length; i++) {
				if(!($(textarea[i]).parents().is(".template"))) {
					if ($(textarea[i]).hasClass('editor-field')) {
						CKEDITOR.replace( $(textarea[i]).attr('id'), {
						    customConfig: '<?php echo base_url(); ?>ckeditor/custom/config/field_config.js'
						});
					} else if ($(textarea[i]).hasClass('editor-view')) {
						CKEDITOR.replace( $(textarea[i]).attr('id'), {
						    customConfig: '<?php echo base_url(); ?>ckeditor/custom/config/view_config.js'
						});
					} else if ($(textarea[i]).hasClass('editor-simple')) {
						CKEDITOR.replace( $(textarea[i]).attr('id'), {
						    customConfig: '<?php echo base_url(); ?>ckeditor/custom/config/simple_config.js'
						});
					} else if ($(textarea[i]).hasClass('editor-download')) {
						CKEDITOR.replace( $(textarea[i]).attr('id'), {
						    customConfig: '<?php echo base_url(); ?>ckeditor/custom/config/download_config.js'
						});
					} else if ($(textarea[i]).hasClass('editor-document')) {
						CKEDITOR.replace( $(textarea[i]).attr('id'), {
						    customConfig: '<?php echo base_url(); ?>ckeditor/custom/config/template_config.js'
						});
					}
				}
			}
			
		});	
		$('#form-container').on("change", ".form_jenis", function () {
		    var jenis = $(this).find(':selected').val();
		    var name = this.getAttribute('name');
		    var content = "";
	    	if(jenis == "external") {
	    		
	    		content += "<input type='text' name='val_"+name+"' autofocus tabindex='1' class='form-control' placeholder='Nama/Jabatan'>";
	    		$(this).parents(".person_field").find(".person_field_2").get(0).innerHTML = content;

	    	} else if(jenis == "internal") {
	    		$.ajax({ 
	    			context: this,
					url: "<?php echo site_url('admin/nota_dinas/ajax/list_internal'); ?>",
					data: {},
					dataType: "json",
					type: "POST",
					success: function(data){
						content += "<select name='val_"+name+"' class='form-control' tabindex='1' autofocus>";
						content +=	"<option value=''>--Pilih Jabatan--</option>";
						for (var i = 0; i < data['data'].length; i++) {
				        	content +=	"<option value='"+data['data'][i].id+"'>"+data['data'][i].jabatan+"</option>";
				        }
			            content += "</select>";
			    		$(this).parents(".person_field").find(".person_field_2").get(0).innerHTML = content;        
					}    
				});

	    	} else {
	    		$(this).parents(".person_field").find(".person_field_2").get(0).innerHTML = content;
	    	}
	    });

	    $('form').on('change', '.image_field', function() {
	    	var file = $(this).find('.file')[0];

	    	var current = $(this).find('.current_image');
	    	var selected = $(this).find('.selected_image');

	    	if (file.files && file.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $(selected).find("img").attr('src', e.target.result);
		        }

		        reader.readAsDataURL(file.files[0]);
		        $(current).addClass('hide');
	    		$(selected).removeClass('hide');
		    } else {
		    	$(current).removeClass('hide');
	    		$(selected).addClass('hide');
	    		$(selected).attr('src','');
		    }
	    });

		//untuk dynamic field tembusan surat masuk
        // Add button click handler
        $('form').on('click', '.addButton', function() {
        	//console.log(this);

        	var $cloneList = $(this).closest(".dynamic_field").children(".clone");
        	var $dataId = [];
			for(var i=0; typeof($cloneList[i])!='undefined'; $dataId.push($cloneList[i++].getAttribute('data-id')));
        	var $last = Math.max(...($dataId), -1);
        	var $next = $last + 1;

            var $template = $(this).closest(".dynamic_field").children(".template");

            var $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeClass('template')
                                .addClass('clone')
                                .attr('data-id', $next)
                                .insertBefore($template);

            

            var input = $($clone).find(".template").find("input");
            for(var i=0; typeof(input[i])!='undefined'; i++){
            	var name = $(input[i]).attr('name');
            	$(input[i]).attr('name', name.replace("[]", "["+$next+"][]"));
            }

            var textarea = $($clone).find(".template").find("textarea");
            for(var i=0; typeof(textarea[i])!='undefined'; i++){

            	var name = $(textarea[i]).attr('name');
            	$(textarea[i]).attr('name', name.replace("[]", "["+$next+"][]"));
            }

            var select = $($clone).find(".template").find("select");
            for(var i=0; typeof(select[i])!='undefined'; i++){
            	var name = $(select[i]).attr('name');
            	$(select[i]).attr('name', name.replace("[]", "["+$next+"][]"));
            }


            var dynamic = $($clone).find(".dynamic_field");
            var textarea = $($clone).find("textarea");
            for(var i=0; typeof(textarea[i])!='undefined'; i++) {
            	if(!($(textarea[i]).parents().is(dynamic))) {
            		if($(textarea[i]).hasClass('editor-field')) {
		            	var name = $(textarea[i]).attr('name');
		            	$(textarea[i]).attr('id',name.replace("[]", "["+$next+"]")).addClass('editor-field');
		            	CKEDITOR.replace( $(textarea[i]).attr('id'), {
						    customConfig: '<?php echo base_url(); ?>ckeditor/custom/config/field_config.js'
						});
					} else if($(textarea[i]).hasClass('editor-simple')) {
		            	var name = $(textarea[i]).attr('name');
		            	$(textarea[i]).attr('id',name.replace("[]", "["+$next+"]")).addClass('editor-simple');
		            	CKEDITOR.replace( $(textarea[i]).attr('id'), {
						    customConfig: '<?php echo base_url(); ?>ckeditor/custom/config/simple_config.js'
						});
					}
	            }
            }
        });


        // Remove button click handler
        $('form').on('click', '.removeButton', function() {
            var $row    = $(this).closest('.clone');

            // Remove element containing the tembusan
            $row.remove();

        });

		$('.addComment').click(function() {
			var id = $(this).data('id');
			console.log($("#komentar").text());
			CKEDITOR.instances['komentar'].setData('');
			document.getElementById("id_nota").value = id;
			if ($(this).hasClass('send')) {
				$('#form_komentar').attr('action', '<?php echo base_url()?>admin/nota_dinas/act/approve_request');
				$('#submit_komentar').text('Send');
			} else if ($(this).hasClass('approve')) {
				$('#form_komentar').attr('action', '<?php echo base_url()?>admin/nota_dinas/act/approve_request');
				$('#submit_komentar').text('Approve');
			} else if ($(this).hasClass('assign')) {
				$('#form_komentar').attr('action', '<?php echo base_url()?>admin/nota_dinas/act/approve_request');
				$('#submit_komentar').text('Assign');
			} else if ($(this).hasClass('reject')) {
				$('#form_komentar').attr('action', '<?php echo base_url()?>admin/nota_dinas/act/reject_request');
				$('#submit_komentar').text('Reject');
			} else if ($(this).hasClass('pass')) {
				$('#form_komentar').attr('action', '<?php echo base_url()?>admin/nota_dinas/act/reject_request');
				$('#submit_komentar').text('Pass');
			} else if ($(this).hasClass('to_sesjen')) {
				$('#form_komentar').attr('action', '<?php echo base_url()?>admin/nota_dinas/act/approve_request/sesjen');
				$('#submit_komentar').text('Approve');
			} else if ($(this).hasClass('to_tata_usaha')) {
				$('#form_komentar').attr('action', '<?php echo base_url()?>admin/nota_dinas/act/approve_request/tata_usaha');
				$('#submit_komentar').text('Assign');
			}
		});

		$('.aksi').on("click", ".optionBiro", function () {
		    var id = $(this).data('id');
		    $('.to_sesjen').attr('data-id' , id);
		    $('.to_tata_usaha').attr('data-id' , id);
		});

		$('.aksi').on("click", ".viewNota", function () {
		    var id = $(this).data('id');
			$.ajax({ 
				url: "<?php echo site_url('admin/nota_dinas/ajax/view'); ?>",
				data: {id: id},
				dataType: "json",
				type: "POST",
				success: function(data){
					document.getElementById("notaContent").innerHTML = data;
					var textarea = $("#notaContent .editor-view");
					for (var i = 0; i < textarea.length; i++) {
						CKEDITOR.replace( $(textarea[i]).attr('id'), {
						    customConfig: '<?php echo base_url(); ?>ckeditor/custom/config/view_config.js'
						});
					}
				}
			});
		});

		$('.aksi').on("click", ".downloadNota", function () {
		    var id = $(this).data('id');
			$.ajax({ 
				url: "<?php echo site_url('admin/nota_dinas/ajax/get_nota'); ?>",
				data: {id: id},
				dataType: "json",
				type: "POST",
				success: function(data){
					document.getElementById("textarea-download").innerHTML = data;
					CKEDITOR.instances['textarea-download'].setData(data);
				}    

			});
		});

		$('.aksi').on("click", ".previewNota", function () {
		    var id = $(this).data('id');
			$.ajax({ 
				url: "<?php echo site_url('admin/nota_dinas/ajax/get_nota'); ?>",
				data: {id: id},
				dataType: "json",
				type: "POST",
				success: function(data){
					document.getElementById("textarea-view").innerHTML = data;
					CKEDITOR.instances['textarea-view'].setData(data);
				}    

			});
		});

		$('#jenis_surat').on("change", function() {
			var id = $(this).find(":selected").val();
			$.ajax({ 
				url: "<?php echo site_url('admin/nota_dinas/ajax/form_request'); ?>",
				data: {id: id},
				dataType: "json",
				type: "POST",
				success: function(data){
					if(!$('#ajax-form-container').hasClass(data['form-type'])) {
						$('#ajax-form-container').html(data['html']);
						$('#ajax-form-container').removeClass();
						$('#ajax-form-container').addClass(data['form-type']);
						var textarea = $("#ajax-form-container .editor-field");
						for (var i = 0; i < textarea.length; i++) {
							if(!($(textarea[i]).parents().is(".template"))) {
								CKEDITOR.replace( $(textarea[i]).attr('id'), {
								    customConfig: '<?php echo base_url(); ?>ckeditor/custom/config/field_config.js'
								});
							}
						}
						textarea = $("#ajax-form-container .editor-simple");
						for (var i = 0; i < textarea.length; i++) {
							if(!($(textarea[i]).parents().is(".template"))) {
								CKEDITOR.replace( $(textarea[i]).attr('id'), {
								    customConfig: '<?php echo base_url(); ?>ckeditor/custom/config/simple_config.js'
								});
							}
						}
						$(function() {
							$( ".tgl" ).datepicker({
								changeMonth: true,
								changeYear: true,
								dateFormat: 'yy-mm-dd'
							});
						});	
					}
				}    

			});
		});
	});


	// ]]>
	</script>
	</head>
<img style="width:100%;height:30%;" src="<?php echo base_url(); ?>aset/img/header.jpg" class="user-image" alt=""/>		
<body style="">
    <div class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
         <span class="navbar-brand"><strong style="font-family: verdana;">NOTADINAS</strong></span>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">	
			<li><a href="<?php echo base_url(); ?>admin"><i class="icon-home icon-white"> </i> Beranda</a></li>
            
		<?php
		if ($this->session->userdata('admin_level') != "Super Admin") {
		?>	
		<li class="dropdown">
	          <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-list-alt icon-white"> </i> Nota Dinas <span class="caret"></span></a>
	          <ul class="dropdown-menu" aria-labelledby="themes">
	            <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/nota_dinas/nota_dinas">Manage Permohonan</a></li>
	            <?php if($this->session->userdata('admin_tingkatan') == TINGKATAN_TU_BIRO) { ?>
	            	<li><a tabindex="-1" href="<?php echo base_url(); ?>admin/nota_dinas/view/nota">Manage Nota</a></li>
	            <?php } ?>
	            <?php if($this->session->userdata('admin_tingkatan') > TINGKATAN_TU_BIRO) { ?>
	            	<li><a tabindex="-1" href="<?php echo base_url(); ?>admin/nota_dinas/view/inbox">Nota Masuk</a></li>
	            <?php } ?>
	          </ul>
        </li>
		<li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-random icon-white"> </i> Catat Surat <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/surat_masuk">Surat Masuk</a></li>
                <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/surat_keluar">Surat Keluar</a></li>
              </ul>
            </li>
            	<?php } ?>
			
		
			<?php
			if ($this->session->userdata('admin_level') == "Super Admin") {
			?>
		<li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-wrench icon-white"> </i> Pengaturan <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/manage_admin">Manajemen Admin</a></li>
              </ul>
            </li>
			<?php 
			}
			?>
          </ul>

          <ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-user icon-white"></i> <?php echo $this->session->userdata('admin_nama'); ?> <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/passwod">Ubah Password</a></li>
                <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/logout">Logout</a></li>                
              </ul>
            </li>
          </ul>

        </div>
      </div>
    </div>

	
    <div class="container">
    	
    
		<?php $this->load->view('admin/'.$page); ?>
	  
	  <div class="span12 well well-sm">
		<h4 style="font-weight: bold">NOTA DINAS ONLINE</a></h4>
		<h6>&copy;  2017. Waktu Eksekusi : {elapsed_time}, Penggunaan Memori : {memory_usage}</h6>
	  </div>
 
    </div>

  
</body></html>
