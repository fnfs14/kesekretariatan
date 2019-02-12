<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <head>
	<title>Kesekretariatan Online</title><!--ubah mei judul-->
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
	#zame_filter {
	    display: none;
	}

	/********************************
	 *	Notification Style CSS
	 *	By: Daniel D Fortuna
	 ********************************/
	 .divider-notification{
		margin: 3px 0px;
		height: 1.5px;
		background-color: rgba(165, 165, 165,0.6);
	}
	.bell {
		width: 100%;
		height: 20em;
		line-height: 2em;
		border: 1px solid #ccc;
		padding: 0;
		margin: 0;
		overflow: scroll;
		overflow-x: hidden;
	}
	.blinkblink{
		color: #38b44a;
		animation: linear blink 0.7s;
		animation-direction: alternate-reverse;
		animation-iteration-count: infinite;
			-webkit-animation: linear blink 0.7s;
			-webkit-animation-direction: alternate-reverse;
			-webkit-animation-iteration-count: infinite;

		border-radius: 100%;
	}
	@keyframes blink{
		0%{
			box-shadow: 0px 0px 3px 15px rgb(239, 71, 71);
		}
		100%{
			box-shadow: 0px 0px 0px -2px rgba(60, 158, 49,1);
		}

	}
	.new-notification-row{
		animation: linear blinkNew 1s;
		animation-direction: alternate-reverse;
		animation-iteration-count: infinite;
	}
	@keyframes blinkNew{
		0%{
			background-color: rgb(219, 87, 72,0);
				-webkit-background-color: rgb(219, 87, 72,0);
		}
		100%{
			background-color: rgb(219, 87, 72,0.3);
				-webkit-background-color: rgb(219, 87, 72,0);
		}

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
  	<link rel="stylesheet" href="<?php echo base_url(); ?>aset/js/jquery/jquery.timepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/style.css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url(); ?>aset/datatables/datatables.min.css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/signature-pad.css" media="screen">

    <script src="<?php echo base_url(); ?>aset/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>aset/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>aset/js/bootswatch.js"></script>
	<script src="<?php echo base_url(); ?>aset/js/jquery/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>aset/js/jquery.timepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>aset/datatables/datatables.min.js"></script>

	<!-- Socket Plugin -->
	<script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>

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
	<!--<script src="https://www.gstatic.com/firebasejs/5.0.2/firebase.js"></script>-->
	<script src="https://www.gstatic.com/firebasejs/5.0.3/firebase.js"></script>
	<script type="text/javascript">
	<?php if(isset($_SESSION['firebase'])){ ?>
  // Initialize Firebase
  /* var zed = "<?php var_dump($_SESSION['firebase']); ?>"; */
  var config = {
    apiKey: "AIzaSyD5SapknBoxGIH6jbCvtfcjYeX2z2LacBQ",
    authDomain: "pushidrosfinal.firebaseapp.com",
    databaseURL: "https://pushidrosfinal.firebaseio.com",
    projectId: "pushidrosfinal",
    storageBucket: "pushidrosfinal.appspot.com",
    messagingSenderId: "491819770830"
  };
  firebase.initializeApp(config);
	// var config = {
			// apiKey: "AIzaSyAyrAgGKUc0r2dMhGXtA5JmNg3Vu7rzpPQ",
			// authDomain: "pushidros-1cbd3.firebaseapp.com",
			// databaseURL: "https://pushidros-1cbd3.firebaseio.com",
			// projectId: "pushidros-1cbd3",
			// storageBucket: "pushidros-1cbd3.appspot.com",
			// messagingSenderId: "634309262621"
		  // };
		  // firebase.initializeApp(config);
		  var firebaseRef = firebase.database().ref();
	<?php for($for=0; $for<count($_SESSION['firebase']); $for++){ ?>
	/*<?= $_SESSION['firebase'][$for]['jabatan']; ?>*/
			 firebaseRef.child("<?php echo $_SESSION['firebase'][$for]['jabatan']; ?>").set({
			   suratmasuk:"<?php echo $_SESSION['firebase'][$for]['suratmasuk']; ?>",
			   notadinas:"<?php echo $_SESSION['firebase'][$for]['notadinas']; ?>",
			   suratkeluar:"<?php echo $_SESSION['firebase'][$for]['suratkeluar']; ?>"
			 });
	<?php
		}
		unset($_SESSION['firebase']);
	} ?>
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
			$( "#updated_at" ).datepicker({
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
         <span class="navbar-brand"><strong style="font-family: verdana;"></strong></span>
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
			        <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/master_kegiatan/m_kegiatan">Master Kegiatan</a></li>
	            <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/nota_dinas/nota_dinas">Pengaturan Permohonan</a></li>
				<li><a tabindex="-1" href="<?php echo base_url(); ?>admin/manage_ruangkrj/m_ruangkrj">Pengaturan Ruang Kerja</a></li>
	            <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/manage_task/m_task">Pengaturan Tugas</a></li>
	            <!-- popo -->
	            <?php if($this->session->userdata('admin_jabatan') == 1 || $this->session->userdata('admin_jabatan') == 28) { ?>
	            <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/manage_ruangkrj/m_ruangkrj">Pengaturan Ruang Kerja</a></li>
	            <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/manage_task/m_task">Pengaturan Tugas</a></li><!--ubah mei bahasa-->
	           <?php } ?>
	            <?php if($this->session->userdata('admin_jabatan') == 2 ) { ?>
	            	 <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/master_ruang/m_ruang">Pengaturan Ruangan</a></li>
	            <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/master_lemari/m_lemari">Pengaturan Lemari</a></li>
	            <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/master_rak/m_rak">Pengaturan Rak</a></li>
	            <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/master_box/m_box">Pengaturan Box</a></li>
	            <?php } ?>
	            <?php if($this->session->userdata('admin_tingkatan') == TINGKATAN_TU_BIRO) { ?>
	            	<li><a tabindex="-1" href="<?php echo base_url(); ?>admin/nota_dinas/view/nota">Pengaturan Nota</a></li>
	            <?php } ?>
	            <?php if($this->session->userdata('admin_tingkatan') > TINGKATAN_TU_BIRO) { ?>
	            	<li><a tabindex="-1" href="<?php echo base_url(); ?>admin/nota_dinas/view/inbox">Nota Masuk</a></li>
	            <?php } ?>
	          </ul>
        </li>
            <li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-list-alt icon-white"> </i> Doktrin <span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="themes">
					<li><a tabindex="-1" href="<?php echo base_url(); ?>administrator/master_kategori/m_kategori">Master Kategori</a></li>
					<li><a tabindex="-1" href="<?php echo base_url(); ?>admin/master_doktrin/m_doktrin">Master Doktrin</a></li>
					<li><a tabindex="-1" href="<?= base_url(); ?>administrator/list_kategori_doktrin">Doktrin</a></li>
				</ul>
            </li>
		<li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-random icon-white"> </i> Catat Surat <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
				<?php if($this->session->userdata('admin_jabatan')== 2 ){ ?>
					<li><a tabindex="-1" href="<?php echo base_url(); ?>administrator/master_arsip_surat/m_arsip_surat">Master Arsip Surat</a></li>
                <li><a tabindex="-1" href="<?php echo base_url(); ?>administrator/master_surat_keluar/m_surat_keluar">Master Surat Keluar</a></li>
                <li><a tabindex="-1" href="<?php echo base_url(); ?>administrator/master_surat_masuk/m_surat_masuk">Master Surat Masuk</a></li>
                <li><a tabindex="-1" href="<?php echo base_url(); ?>administrator/master_klasifikasi_surat_masuk/m_klasifikasi">Master Klasifikasi</a></li>
                <li><a tabindex="-1" href="<?php echo base_url(); ?>administrator/master_derajat/m_derajat">Master Derajat</a></li>
                <li><a tabindex="-1" href="<?php echo base_url(); ?>administrator/master_tujuan/m_tujuan">Master Asal Surat</a></li>
				<?php } ?>
                <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/surat_masuk">Surat Masuk</a></li>
                <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/surat_keluar">Surat Keluar</a></li>
              </ul>
            </li>
            	<?php } ?>
			<?php if($this->session->userdata('admin_tingkatan')==1 or $this->session->userdata('admin_tingkatan')==2){ ?>
			<!--<li>
              <a href="<?= base_url(); ?>admin/surat_antar_kadis" id="themes"><i class="icon-random icon-white"> </i> Surat Antar Kadis</a>
            </li>-->
			<!-- di hide -->
			<?php } ?>


			<?php
			if ($this->session->userdata('admin_level') == "Super Admin") {
			?>
		<li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-wrench icon-white"> </i> Pengaturan <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/manage_admin">Pengaturan User</a></li>
				<li><a tabindex="-1" href="<?php echo base_url(); ?>admin/master_aksi">Pengaturan Aksi</a></li>
                <!-- <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/manage_satker">Pengaturan Satker</a></li> -->
                <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/manage_jabatan">Pengaturan Jabatan</a></li>
                <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/log">Log User</a></li>
              </ul>
            </li>
			<?php
			}
			?>
          </ul>
			<?php
				$bell = $this->db->query("SELECT CASE WHEN notadinas.tembusan_surat_keluar.tanggal IS NULL THEN 'unchecked' ELSE 'checked' END AS ka_waka_setum, updated_at, notadinas.surat_keluar.status_tujuan AS tujuan_status, 'keluar' AS tablenya, 1 AS status, notadinas.surat_keluar.opened, notadinas.surat_keluar.kepada, notadinas.tembusan_surat_keluar.id_jabatan, notadinas.surat_keluar.perihal, notadinas.surat_keluar.status_surat_keluar, notadinas.surat_keluar.id AS idnya 
FROM notadinas.surat_keluar 
LEFT JOIN notadinas.tembusan_surat_keluar ON notadinas.surat_keluar.id = notadinas.tembusan_surat_keluar.id_surat_keluar 
WHERE notadinas.surat_keluar.status_surat_keluar = 1 or notadinas.surat_keluar.status_surat_keluar = 2 or notadinas.surat_keluar.status_surat_keluar = 3 or notadinas.surat_keluar.status_surat_keluar = 4 or notadinas.surat_keluar.status_surat_keluar = 5 or notadinas.surat_keluar.status_surat_keluar = 6  or notadinas.surat_keluar.status_surat_keluar = 8  
UNION SELECT 'hak_akses' AS ka_waka_setum, updated_at, notadinas.surat_masuk.status_tujuan AS tujuan_status, 'masuk' AS tablenya, notadinas.disposisi_surat_masuk.status, notadinas.surat_masuk.opened, notadinas.surat_masuk.kepada, notadinas.disposisi_surat_masuk.penerima_disposisi, notadinas.surat_masuk.perihal, notadinas.surat_masuk.status_surat_masuk, notadinas.surat_masuk.id AS idnya 
FROM notadinas.surat_masuk 
LEFT JOIN notadinas.disposisi_surat_masuk ON notadinas.surat_masuk.id = notadinas.disposisi_surat_masuk.id_surat_masuk 
WHERE notadinas.surat_masuk.status_surat_masuk = 2 or  notadinas.surat_masuk.status_surat_masuk = 3 or notadinas.surat_masuk.status_surat_masuk = 4 
UNION SELECT 'subdis' AS ka_waka_setum, updated_at,notadinas.surat_masuk.status_tujuan AS tujuan_status, 'masuk' AS tablenya, notadinas.disposisi_surat_masuk.status, notadinas.surat_masuk.opened, notadinas.surat_masuk.kepada, notadinas.disposisi_surat_masuk.penerima_disposisi_satuan, notadinas.surat_masuk.perihal, notadinas.surat_masuk.status_surat_masuk, notadinas.surat_masuk.id AS idnya 
FROM notadinas.surat_masuk 
LEFT JOIN notadinas.disposisi_surat_masuk ON notadinas.surat_masuk.id = notadinas.disposisi_surat_masuk.id_surat_masuk 
WHERE (notadinas.surat_masuk.status_surat_masuk = 2 or  notadinas.surat_masuk.status_surat_masuk = 3 or notadinas.surat_masuk.status_surat_masuk = 4) and notadinas.disposisi_surat_masuk.penerima_disposisi_satuan IS NOT NULL 
UNION SELECT ka_waka_setum, updated_at,notadinas.nota_dinas.status_tujuan AS tujuan_status, 'nota' AS tablenya, status AS status, notadinas.nota_dinas.opened, notadinas.nota_dinas.kepada, notadinas.tembusan_nota_dinas.id_jabatan, notadinas.nota_dinas.perihal, notadinas.nota_dinas.status_notadinas, notadinas.nota_dinas.id AS idnya 
FROM notadinas.nota_dinas 
LEFT JOIN notadinas.tembusan_nota_dinas ON notadinas.nota_dinas.id = notadinas.tembusan_nota_dinas.id_notadinas 
WHERE notadinas.nota_dinas.status_notadinas = 4 or notadinas.nota_dinas.status_notadinas = 5 or ka_waka_setum != '4-5-6'
UNION SELECT 'hak_akses' AS ka_waka_setum, tgl_surat, 0 AS tujuan_status, 'kadis' AS tablenya, 1 AS status, notadinas.surat_antar_kadis.opened, notadinas.surat_antar_kadis.kepada, notadinas.tembusan_surat_antar_kadis.id_jabatan, notadinas.surat_antar_kadis.perihal, notadinas.surat_antar_kadis.status_surat_antar_kadis, notadinas.surat_antar_kadis.id AS idnya 
FROM notadinas.surat_antar_kadis 
INNER JOIN notadinas.tembusan_surat_antar_kadis ON notadinas.surat_antar_kadis.id = notadinas.tembusan_surat_antar_kadis.id_surat 
WHERE notadinas.surat_antar_kadis.status_surat_antar_kadis = 1 or notadinas.surat_antar_kadis.status_surat_antar_kadis = 3 
ORDER BY updated_at DESC")->result();
				// var_dump($bell);
				// die();
				if($this->session->userdata('admin_tingkatan')==2){
					$user_subjabatan = $this->db->query("SELECT notadinas.master_jabatan.id AS id FROM notadinas.master_user INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan = notadinas.master_jabatan.id WHERE notadinas.master_user.jabatan = " . $this->session->userdata('admin_jabatan'))->row();
				}
			?>
          <ul class="nav navbar-nav navbar-right">
		  	<li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes" style="padding: 11px 10px;" onclick="document.getElementById('circle-notification').classList.remove('blinkblink')" >
              	<span class="fa-stack">
      				<i style="color: #38b44a;" class="fa fa-stack-2x" id="circle-notification"></i>
              		<i class="fa fa-bell fa-stack-1x"></i></span>
              	<sup class="bell-a" ></sup>
              </a>
              <div class="dropdown-menu" style="width:400px;">
			  <ul class="bell" aria-labelledby="themes">
			  <li>
			  	<table width="100%" style='background:white; border:none' cellpadding='5px' id="new-notification">
					
			  	</table>
			  </li>
			  <li class="divider-notification"></li>
			  <li><table width='100%' style='background:white;' cellpadding='5px'>
			  <?php
			  function abcd($no,$what,$id,$perihal,$updated_at,$link,$req=NULL,$button=NULL){//ubah mei notifikasi
				$result = '<tr style="font-size:12px;margin-top:0px;padding-top:0px;">
				<td style="border:1px solid;border-color:white;border-bottom-color:lightgrey;" width="5%">
				<span class="badge" style="margin-top:0px;">'.$no.'</span></td>
				<td style="border:1px solid white;border-bottom-color:lightgrey;" width="35%"><span style="font-size:0.8em;height:10px;position:static;top:0px;margin:0px;color:magenta">'.$updated_at.'</span></td>
				<td style="border:1px solid;border-color:white;border-bottom-color:lightgrey;padding-top:0px;padding-bottom:0px;margin-bottom:0px;margin-top:0px;" width="30%">
				'.$what.'</td>
				<td style="border:1px solid;border-color:white;border-bottom-color:lightgrey;padding-top:0px;padding-bottom:0px;margin-bottom:0px;margin-top:0px;" width="20%">
				'.$perihal.'</td>
				<td style="border:1px solid;border-color:white;border-bottom-color:lightgrey;padding-top:0px;padding-bottom:0px;margin-bottom:0px;margin-top:0px;" width="10%">';
				if($button!=NULL){
					$result .= "<a class='btn btn-info btn-sm' ";
					$result .= 'onclick="bacasatuan('.$id.','."'$button'".')">Buka</a>';
					
				}else{
					$result .= '<a class="btn btn-info btn-sm" href="'.base_url().'admin'. $link . $id . "/" . $req . '">Buka</a>';
				}
				$result .= '
				</td>
				</tr>';
				echo $result;
			  }
			  $zxc = 0;
			  $notif = [];
			  if(count($bell)>0){//ubah mei notifikasi
				foreach($bell as $bl){
					$get_creator = $this->db->query("SELECT create_by FROM notadinas.surat_keluar WHERE id = " . $bl->idnya)->row();
					if($bl->tablenya=="keluar" and !isset($notif['keluar'][$bl->idnya])){
						if($bl->ka_waka_setum=='unchecked' and $bl->status_surat_keluar==1 and $this->session->userdata('admin_jabatan')==$bl->id_jabatan and $bl->opened==1){
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,'Surat Keluar',$bl->idnya, $bl->perihal,$newDate,'/surat_keluar/verifikasi_surat_keluar/');
							$zxc = $zxc + 1;
							$notif['keluar'][$bl->idnya] = true;
						}else if($bl->status_surat_keluar==2 and $this->session->userdata('admin_jabatan')==1 and $bl->opened==2 and $bl->tujuan_status != 1){
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,'Surat Keluar',$bl->idnya, $bl->perihal,$newDate,'/surat_keluar/verifikasi_surat_keluar/');
							$zxc = $zxc + 1;
							$notif['keluar'][$bl->idnya] = true;
						}else if($bl->status_surat_keluar==2 and $this->session->userdata('admin_jabatan')==28 and $bl->opened==2){
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,'Surat Keluar',$bl->idnya, $bl->perihal,$newDate,'/surat_keluar/verifikasi_surat_keluar/');
							$zxc = $zxc + 1;
							$notif['keluar'][$bl->idnya] = true;
						}else if($bl->status_surat_keluar==3 and $bl->opened==3 and $get_creator->create_by==$this->session->userdata('admin_id')){
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,'Surat Keluar',$bl->idnya, $bl->perihal,$newDate,'/surat_keluar/verifikasi_surat_keluar/');
							$zxc = $zxc + 1;
							$notif['keluar'][$bl->idnya] = true;
						}else if($bl->status_surat_keluar==4 and $this->session->userdata('admin_jabatan')==2 and $bl->opened==4 and $bl->tujuan_status != 1){
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,'Surat Keluar',$bl->idnya, $bl->perihal,$newDate,'/surat_keluar/verifikasi_surat_keluar/');
							$zxc = $zxc + 1;
							$notif['keluar'][$bl->idnya] = true;
						}else if($bl->status_surat_keluar==5 and $this->session->userdata('admin_jabatan')==2 and $bl->opened==5 and $bl->tujuan_status != 1){
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,'Surat Keluar',$bl->idnya, $bl->perihal,$newDate,'/surat_keluar/verifikasi_surat_keluar/');
							$zxc = $zxc + 1;
							$notif['keluar'][$bl->idnya] = true;
						}else if($bl->status_surat_keluar==6 and $this->session->userdata('admin_jabatan')==1 and $bl->opened==6){
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,'Surat Keluar',$bl->idnya, $bl->perihal,$newDate,'/surat_keluar/verifikasi_surat_keluar/');
							$zxc = $zxc + 1;
							$notif['keluar'][$bl->idnya] = true;
						}else if($bl->status_surat_keluar==8 and $bl->opened==88){
							if($get_creator->create_by == $this->session->userdata('admin_id')){
								$originalDate = $bl->updated_at;
								$newDate = date("j M Y H:i", strtotime($originalDate));
								abcd($zxc+1,'Surat Keluar',$bl->idnya, $bl->perihal,$newDate,'/surat_keluar/edit_new_message/');
								$zxc = $zxc + 1;
								$notif['keluar'][$bl->idnya] = true;
							}
						}
					}else if($bl->tablenya=="masuk" and !isset($notif['masuk'][$bl->idnya])){
						$_tembusan = $this->db->query("SELECT COUNT(id) AS z FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = $bl->idnya AND penerima_disposisi = " . $this->session->userdata('admin_jabatan') . "AND status = 1 AND (penerima_disposisi=1 OR penerima_disposisi=28)")->row();
						if($_tembusan->z!=0){
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,"Surat Masuk",$bl->idnya, $bl->perihal,$newDate,'/surat_masuk/disp/');
							$zxc = $zxc + 1;
							$notif['masuk'][$bl->idnya] = true;
						}else if($this->session->userdata('admin_tingkatan')==2 and $bl->status_surat_keluar==4 and $bl->ka_waka_setum=="subdis" and $user_subjabatan!=null and $bl->id_jabatan==$user_subjabatan->id and $bl->opened==4){
							$check_asjdk = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = $bl->idnya and penerima_disposisi_satuan = $user_subjabatan->id")->row();
							if($check_asjdk->disposisi!="yes"){
								$originalDate = $bl->updated_at;
								$newDate = date("j M Y H:i", strtotime($originalDate));
								abcd($zxc+1,"Surat Masuk",$bl->idnya, $bl->perihal,$newDate,'/surat_masuk/subdisp/');
								$zxc = $zxc + 1;
								$notif['masuk'][$bl->idnya] = true;
							}
						}else if($bl->status_surat_keluar==2 and $this->session->userdata('admin_jabatan')==1 /* and $bl->kepada!=28 */ and ($bl->opened==2 or $bl->opened==228)){
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,"Surat Masuk",$bl->idnya, $bl->perihal,$newDate,'/surat_masuk/disp/');
							$zxc = $zxc + 1;
							$notif['masuk'][$bl->idnya] = true;
						}else if($bl->status_surat_keluar==2 and $this->session->userdata('admin_jabatan')==28 and $bl->kepada==28 and ($bl->opened==2 or $bl->opened==21)){
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,"Surat Masuk",$bl->idnya, $bl->perihal,$newDate,'/surat_masuk/disp/');
							$zxc = $zxc + 1;
							$notif['masuk'][$bl->idnya] = true;
						}else if($bl->status_surat_keluar==3 and $this->session->userdata('admin_jabatan')==$bl->id_jabatan and $bl->status==1 and $bl->opened==3){
							$headerButton = NULL;
							if($this->session->userdata('admin_tingkatan')==2){
								$headerButton = 'kadisp';
							}
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,"Surat Masuk",$bl->idnya, $bl->perihal,$newDate,'/surat_masuk/kadisp/',NULL,$headerButton);
							$zxc = $zxc + 1;
							$notif['masuk'][$bl->idnya] = true;
						} else if($bl->status_surat_keluar==4 and $this->session->userdata('admin_jabatan')==$bl->id_jabatan and $bl->status==1){
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,"Surat Masuk",$bl->idnya, $bl->perihal,$newDate,'/surat_masuk/kadisp/');
							$zxc = $zxc + 1;
							$notif['masuk'][$bl->idnya] = true;
						}
						// else if($bl->status_surat_keluar==4 and $this->session->userdata('admin_jabatan')==$bl->penerima_disposisi and $bl->opened==4){
						// 	$originalDate = $bl->updated_at;
						// 	$newDate = date("j M Y H:i", strtotime($originalDate));
						// 	abcd($zxc+1,"Surat Masuk",$bl->idnya, $bl->perihal,$newDate,'/surat_masuk/kadisp/');
						// 	$zxc = $zxc + 1;
						// 	$notif['masuk'][$bl->idnya] = true;
						// }
					}else if($bl->tablenya=="nota" and !isset($notif['nota'][$bl->idnya])){
						$tembusanZ = $this->db->query("SELECT * FROM notadinas.tembusan_nota_dinas WHERE id_jabatan = " . $this->session->userdata('admin_jabatan') . " AND id_notadinas = $bl->idnya")->row();
						if($this->session->userdata('admin_jabatan')==$bl->kepada and $bl->opened==100 and $bl->tujuan_status == 0){
							$pplkasaso = 'kepada';
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,"Nota Dinas",$bl->idnya, $bl->perihal,$newDate,'/nota_dinas/verifikasi_nota_dinas/',$pplkasaso);
							$zxc = $zxc + 1;
							$notif['nota'][$bl->idnya] = true;
						}elseif($tembusanZ!=NULL and $this->session->userdata('admin_jabatan')==$tembusanZ->id_jabatan and $tembusanZ->status!=100){
							$pplkasaso = 'tembusan';
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,"Nota Dinas",$bl->idnya, $bl->perihal,$newDate,'/nota_dinas/verifikasi_nota_dinas/',$pplkasaso);
							$zxc = $zxc + 1;
							$notif['nota'][$bl->idnya] = true;
						}elseif($this->session->userdata('admin_jabatan')==1 and strpos($bl->ka_waka_setum, '1') !== false){
							$pplkasaso = 'kapush';
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,"Nota Dinas",$bl->idnya, $bl->perihal,$newDate,'/nota_dinas/verifikasi_nota_dinas/',$pplkasaso);
							$zxc = $zxc + 1;
							$notif['nota'][$bl->idnya] = true;
						}elseif($this->session->userdata('admin_jabatan')==2 and strpos($bl->ka_waka_setum, '2') !== false){
							$pplkasaso = 'setum';
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,"Nota Dinas",$bl->idnya, $bl->perihal,$newDate,'/nota_dinas/verifikasi_nota_dinas/',$pplkasaso);
							$zxc = $zxc + 1;
							$notif['nota'][$bl->idnya] = true;
						}elseif($this->session->userdata('admin_jabatan')==28 and strpos($bl->ka_waka_setum, '3') !== false){
							$pplkasaso = 'waka';
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,"Nota Dinas",$bl->idnya, $bl->perihal,$newDate,'/nota_dinas/verifikasi_nota_dinas/',$pplkasaso);
							$zxc = $zxc + 1;
							$notif['nota'][$bl->idnya] = true;
						}
					}else if($bl->tablenya=="kadis" and !isset($notif['kadis'][$bl->idnya])){
						if($bl->status_surat_keluar==1 and $this->session->userdata('admin_jabatan')==$bl->id_jabatan and $bl->opened==1 and $this->session->userdata('admin_tingkatan')==1){
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,'Surat Kadis',$bl->idnya, $bl->perihal,$newDate,'/surat_antar_kadis/show/');
							$zxc = $zxc + 1;
							$notif['kadis'][$bl->idnya] = true;
						}else if($bl->status_surat_keluar==1 and $this->session->userdata('admin_jabatan')==$bl->kepada and $bl->opened==1){
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,'Surat Kadis',$bl->idnya, $bl->perihal,$newDate,'/surat_antar_kadis/verifikasi_surat_antar_kadis/');
							$zxc = $zxc + 1;
							$notif['kadis'][$bl->idnya] = true;
						}else if($bl->status_surat_keluar==3 and $this->session->userdata('admin_jabatan')==$bl->id_jabatan and $bl->opened==3 and $this->session->userdata('admin_tingkatan')==2){
							$originalDate = $bl->updated_at;
							$newDate = date("j M Y H:i", strtotime($originalDate));
							abcd($zxc+1,'Surat Kadis',$bl->idnya, $bl->perihal,$newDate,'/surat_antar_kadis/show/');
							$zxc = $zxc + 1;
							$notif['kadis'][$bl->idnya] = true;
						}
					}
				}
			  }
			  echo "<script>$('.bell-a').text('$zxc')</script>";
			  if($zxc==0){
			  	echo "<tr><td colspan='4'><a>Tidak ada data baru</a></li></td></tr>";
			  }else{
			  	  echo "<script>$('#circle-notification').addClass('fa-circle blinkblink')</script>";
				  echo '<audio id="myaudio" controls style="display:none;" autoplay>
				  <source src="'. base_url() .'upload/echoed-ding.ogg" type="audio/ogg">
				Your browser does not support the audio element.sd
				</audio>';?>
				<script>
				var audio = document.getElementById('myaudio');
				var playCount = 0;
				audio.addEventListener('ended', function(){
					playCount++;
					if (playCount < 1) {
					this.play();
				}
				}, false);
				</script>
				<?php
			  }
			  ?>
			  </table></li>
              </ul>
			  </div>
            </li>
			<li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-user icon-white"></i> <?php echo $this->session->userdata('admin_nama'); ?> <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/passwod">Ubah Password</a></li>
                <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/logout">Keluar</a></li>

              </ul>
            </li>
          </ul>

        </div>
      </div>
    </div>
    <audio id="myaudio" controls style="display:none;">
    	<source src="<?=base_url()?>upload/echoed-ding.ogg" type="audio/ogg">Your browser does not support the audio element.sd
	</audio>
    <script type="text/javascript">
    	// var socket = io.connect('http://'+window.location.hostname+':3000');
    </script>
    <?php
		/***************************************
		 ** 	Session Handler
		 **		By : Daniel D Fortuna
		 ***************************************/
		if(isset($_SESSION['socketAdded'])){
			foreach($_SESSION['socketAdded'] as $index => $sA){
			?>
			<script type="text/javascript">
				// socket.emit('notification-sync',{ 
					// loop 					: <?=$index+1?>,
					// ka_waka_setum			: "<?=$sA['ka_waka_setum']?>",
			      	// updated_at				: "<?=$sA['updated_at']?>",
			      	// tablenya				: "<?=$sA['tablenya']?>",
			      	// status 					: <?=$sA['status']?>,
			      	// opened 					: <?=$sA['opened']?>,
			      	// kepada					: <?=$sA['kepada']?>,
			      	// id_jabatan				: <?=$sA['id_jabatan']?>,
			      	// perihal					: "<?=$sA['perihal']?>",
			      	// status_surat_keluar		: <?=$sA['status_surat_keluar']?>,
			      	// idnya					: <?=$sA['idnya']?>,
			      	// create_by				: <?=$sA['create_by']?>
				// });
			</script>
			<?php
			}
			unset($_SESSION['socketAdded']);
		}

		if(isset($_SESSION['socketNotif'])){
			$sA = $_SESSION['socketNotif'];
			?>
			<script type="text/javascript">
				// socket.emit('notification-sync',{ 
					// loop 					: 1,
					// ka_waka_setum			: "<?=$sA['ka_waka_setum']?>",
			      	// updated_at				: "<?=$sA['updated_at']?>",
			      	// tablenya				: "<?=$sA['tablenya']?>",
			      	// status 					: <?=$sA['status']?>,
			      	// opened 					: <?=$sA['opened']?>,
			      	// kepada					: <?=$sA['kepada']?>,
			      	// id_jabatan				: <?=$sA['id_jabatan']?>,
			      	// perihal					: "<?=$sA['perihal']?>",
			      	// status_surat_keluar		: <?=$sA['status_surat_keluar']?>,
			      	// idnya					: <?=$sA['idnya']?>,
			      	// create_by				: <?=$sA['create_by']?>
				// });
			</script>
			<?php
			unset($_SESSION['socketNotif']);
		}
 	?>
 	<script type="text/javascript">
		$(document).ready(function(){
		  // socket.on('notification-sync', function(data){
		  	// console.log(JSON.stringify(data));
		  	// $.ajax({
				// url : "<?=base_url('admin/getLinkForNewNotification'); ?>/",
				// data : {
					// ka_waka_setum 		: data.ka_waka_setum,
					// updated_at			: data.updated_at,
			      	// tablenya			: data.tablenya,
			      	// status 				: data.status,
			      	// opened 				: data.opened,
			      	// kepada				: data.kepada,
			      	// id_jabatan			: data.id_jabatan,
			      	// perihal				: data.perihal,
			      	// status_surat_keluar	: data.status_surat_keluar,
			      	// idnya				: data.idnya,
			      	// create_by			: data.create_by
				// },
				// dataType: "json",
				// type: "POST",
				// success: function(json){
					// console.log(JSON.stringify(json));
					// addNewRowNotification(data.tablenya,data.idnya,data.perihal,data.updated_at,json[0].link,json[0].req);
					// $('#circle-notification').removeClass('fa-circle').addClass('blinkblink fa-circle');
					// var notificationCount = $('.bell-a').text();
					// console.log(notificationCount++);
					// $('.bell-a').html(notificationCount++);

					// var x = document.getElementById('myaudio');
					// x.play();
				// }
			// });
		  // });
		});

		function addNewRowNotification($type, $id, $perihal,$updated_at, $link, $req = null){
			$tipe = '';
			switch($type){
				case 'keluar':
					$tipe = 'surat keluar';
					break;

				case 'masuk':
					$tipe = 'surat masuk';
					break;

				case 'nota':
					$tipe = 'nota dinas';
					break;
			}
			$('#new-notification').append(`<tr style="font-size:12px;" class="new-notification-row"><td style="border:1px solid;border-color:white;border-bottom-color:whitesmoke;" width="5%"><span class="badge">New</span></td><td style="border:1px solid white;border-bottom-color:lightgrey;"><span style="font-size:0.8em;height:10px;position:static;top:0px;margin:0px;color:magenta">`+$updated_at+`</span></td><td style="border-bottom-color:whitesmoke;padding-top:0px;padding-bottom:0px;margin-bottom:0px;margin-top:0px;" width="35%">`+$tipe+`</td><td style="border-bottom-color:whitesmoke;padding-top:0px;padding-bottom:0px;margin-bottom:0px;margin-top:0px;" width="45%">`+$perihal+`</td><td style="border-bottom-color:whitesmoke;padding-top:0px;padding-bottom:0px;margin-bottom:0px;margin-top:0px;" width="15%"><a class="btn btn-info btn-sm" href="<?=base_url()?>admin`+$link+$id+`/">Buka</a></td></tr>`);
		}
	</script>
    <div class="container">
<?php
//var_dump($bell);
// foreach($bell as $bl){
	// echo $bl->perihal ."<br>";
// }
?>
