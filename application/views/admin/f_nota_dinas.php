<style>
    .custom-combobox {
        position: relative;
        display: inline-block;
    }

    .custom-combobox-toggle {
        position: absolute;
        top: 0;
        bottom: 0;
        margin-left: -1px;
        padding: 0;
    }

    .custom-combobox-input {
        margin: 0;
        padding: 5px 10px;
    }

    input.ui-state-default {
        background: white;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/bootstrap-datetimepicker.min.css" media="screen">
<script src="<?php echo base_url(); ?>aset/js/moment-with-locales.min.js"></script>
<script src="<?php echo base_url(); ?>aset/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?= base_url() ?>aset/js/autocomplete.js"></script>
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
<?php
$mode		= $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt" || $mode == "verifikasi_nota_dinas") {
	$act		= "act_edt";
	$idp		= $datpil->id;
	$nama_tujuan = $datpil->nama_tujuan;
	// $no_agenda	= $datpil->no_agenda;
	// $kode		= $datpil->kode;
	$dari		= $datpil->kepada;
	$no_surat	= $datpil->no_surat;
	$tgl_surat	= $datpil->tgl_surat;
	$str = explode("-", $tgl_surat);
	$tgl_asleli = $str[2]."-".$str[1]."-".$str[0];
	$uraian		= $datpil->isi;
	$ket		= $datpil->keterangan;
	$perihal	= $datpil->perihal;
	$isi	= $datpil->isi;
	$status	= $datpil->status_notadinas;
	$file_attachment	= $datpil->file_attachment;
	$keg_id = $datpil->kegiatan_id;
	$staf_id = $datpil->staf_tugas;
	//$jabatan	= $datpil->jabatan_id;
	$tgl_mulai_tugas = $datpil->tgl_mulai_tugas;
	$tgl_akhir_tugas = $datpil->tgl_akhir_tugas;
	if($mode == "verifikasi_nota_dinas"){
		if($this->session->userdata('admin_jabatan')==1){
			$act = 'verifikasi_submit_kapushidrosal/'.$idp;
		}elseif($this->session->userdata('admin_jabatan')==2){
			$act = 'verifikasi_submit_setum/'.$idp;
		}else{
			$act = 'verifikasi_submit/'.$idp;
		}
	}
	
} else {
	$datpil_tembusan = [];
	$act		= "act_add";
	$tgl_mulai_tugas = "";
	$tgl_akhir_tugas = "";
	$nama_tujuan = "";
	$tgl_asleli = "";
	$idp		= "";
	$no_agenda	= "";
	$kode		= "";
	$dari		= "";
	$no_surat	= "";
	$tgl_surat	= "";
	$uraian		= "";
	$ket		= "";
	$perihal	= "";
	$isi		= "";
	$keg_id 	= "";
	$staf_id 	= "";
	$file_attachment 	= "";
}
if($this->session->userdata('admin_jabatan')==2){
	$disabled = "";
}else{
	$disabled = "disabled";
}
?>
<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Nota Dinas</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->

<div class="modal fade" id="modalKegiatan" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Kegiatan</h4>
                <br/>
                <input type="text" name="tagInputKegiatan" class="form-control" id="tagInputKegiatan"/>
                <br/>
                <input type="submit" class="btn btn-default btn-sm" id="tagSubmitKegiatan"/>
            </div>
        </div>
    </div>
</div>
	<form action="<?php echo base_URL()?>admin/nota_dinas/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="formnya">
	
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	<div class="row-fluid well" style="overflow: hidden">
	
	<div class="col-lg-12">
		<table width="100%" class="table-form">
		<tr>
			<td width="15%">Tujuan Surat</td>
			<td width="30%"><b>
			<?php 
				echo "<select tabindex='1' name='dari' required class='form-control' id='dari'>";
			?>
			 <?php
				foreach($user_n as $a){
					if($a->id == $dari){
						echo "<option value='$a->id' selected>$a->nama_jabatan</option>";
					}else{
						echo "<option value='$a->id' id='$a->nama_jabatan'>$a->nama_jabatan</option>";
					}
				}
			?></select></b></td>
			<input type="hidden" name="nama_tujuan" value="<?php echo $nama_tujuan; ?>">
			<td width="10%"></td>
			<td width="15%">Tanggal Surat</td>
			<td width='30%'>
			
			<div class="form-group">
					<div class='input-group date-time-picker-ff1' id=''>
						<input type="text" tabindex="2" name="tgl_surat" required
                                              value="<?php echo $tgl_asleli; ?>" id="tgl_surat" style=""
                                              class="form-control" required>
						</span>
					</div>
				</div>
			</td>
						<?php 
						// if($this->session->userdata('admin_jabatan')==2){
						// echo "<td width='30%'><b><input type='text' tabindex='2' name='tgl_surat' required value='".($tgl_surat != "" ? date("d-m-Y", strtotime($tgl_surat)) : "" )."' id='tgl_surat' style='' class='form-control' disabled></b></td>";
						// } else{
							// echo "<b><input type='text' tabindex='2' name='tgl_surat' required value=' ($tgl_surat != "" ? date("d-m-Y", strtotime($tgl_surat)) : date("d-m-Y") )' id='tgl_surat' style='' class='form-control'></b>
							// ";
						// }
						?>
		</tr><!-- <tr>
			<td>Klasifikasi</td>
			<td><b><select name="klasifikasi" required class="form-control" id="klasifikasi" onchange="ganti(this.value)" >
					<option value="SANGAT RAHASIA" <?= (isset($datpil->klasifikasi) and $datpil->klasifikasi=="SANGAT RAHASIA")? 'selected' : '' ; ?>>SANGAT RAHASIA</option>
					<option value="RAHASIA" <?= (isset($datpil->klasifikasi) and $datpil->klasifikasi=="RAHASIA")? 'selected' : '' ; ?>>RAHASIA</option>
					<option value="BIASA" <?= (isset($datpil->klasifikasi) and $datpil->klasifikasi=="BIASA")? 'selected' : '' ; ?>>BIASA</option>
				</select></b>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr> -->
		<tr>
			<td>Nomor Surat</td>
			<td><b><input type="text" tabindex="3" name="no_surat" id="no_surat" required value="<?= (isset($generated_no_surat))?$generated_no_surat:$no_surat; ?>" style="" class="form-control"></b><span class="label label-danger" id="warning_nosu" style="display: none">* No surat sudah ada!</span></td>
			<td></td>
			<td><!--Tanggal Mulai Surat--></td>
			<td>
				<div class="form-group">
					<div class='input-group date-time-picker-ff2' id=''>
						<input type='hidden' class="form-control" name="tgl_mulai_tugas" value='<?= ($tgl_mulai_tugas != "" ? date("d-m-Y H:i", strtotime($tgl_mulai_tugas)) : date("d-m-Y H:i") ) ?>' readonly/>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<!--<td width="15%">Jenis Surat</td>
			<td width="30%"><b>
			
			<select tabindex='1' name='jenis_surat' required class='form-control'>
                <option value="" disabled>-Pilih Jenis Surat-</option>
			 <?php
				$jenis_surat_db = $this->db->query('SELECT * FROM notadinas.master_surat_keluar')->result();
				foreach($jenis_surat_db as $a){
					if($a->id_master_surat_keluar == $datpil->jenis_surat){
						echo "<option value='$a->id_klasifikasi' selected>$a->nama</option>";
					}else{
						echo "<option value='$a->id_klasifikasi'>$a->nama</option>";
					}
				}
			?>
			</select>
			</b></td>-->
			<td></td>
			<td></td>
			<td></td>
			<td><!--Tanggal Selesai Surat--></td>
			<td>
				<div class="form-group">
					<div class='input-group date-time-picker-ff2' id=''>
						<input type='hidden' class="form-control" name="tgl_akhir_tugas" value='<?= ($tgl_akhir_tugas != "" ? date("d-m-Y H:i", strtotime($tgl_akhir_tugas)) : date("d-m-Y H:i") ) ?>' readonly/>
					</div>
				</div>
			</td>
		</tr>
		<style>
			.fa.fa-clock-o,
			.fa.fa-calendar,
			.fa.fa-arrow-up,
			.fa.fa-arrow-down {
				color: #333333 !important ;
			}
		</style>
		<script>
		 $(function () {
			var bindDatePicker = function() {
					$(".date-time-picker-ff2").datetimepicker({
					format:'DD-MM-YYYY HH:mm',
						icons: {
							time: "fa fa-clock-o",
							date: "fa fa-calendar",
							up: "fa fa-arrow-up",
							down: "fa fa-arrow-down"
						}
					}).find('input:first').on("blur",function () {
						// check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
						// update the format if it's yyyy-mm-dd
						var date = parseDate($(this).val());

						if (! isValidDate(date)) {
							//create date based on momentjs (we have that)
							date = moment().format('DD-MM-YYYY');
						}

						$(this).val(date);
					});
					$(".date-time-picker-ff1").datetimepicker({
					format:'DD-MM-YYYY',
						icons: {
							time: "fa fa-clock-o",
							date: "fa fa-calendar",
							up: "fa fa-arrow-up",
							down: "fa fa-arrow-down"
						}
					}).find('input:first').on("blur",function () {
						// check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
						// update the format if it's yyyy-mm-dd
						var date = parseDate($(this).val());

						if (! isValidDate(date)) {
							//create date based on momentjs (we have that)
							date = moment().format('DD-MM-YYYY');
						}

						$(this).val(date);
					});
				}
			
			var isValidDate = function(value, format) {
					format = format || false;
					// lets parse the date to the best of our knowledge
					if (format) {
						value = parseDate(value);
					}

					var timestamp = Date.parse(value);

					return isNaN(timestamp) == false;
			}
			
			var parseDate = function(value) {
					var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
					if (m)
						value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);

					return value;
			}
			
			bindDatePicker();
			});
		</script>
		<tr>
			<td width="15%">Rujukan Kegiatan</td>
			<td width="30%">
				<div class="ui-widget">
					<select tabindex='1' name='kegiatan' id="combobox" required class='form-control' >
						<option value="" style="display: none;">- Pilih Kegiatan -</option>
						<?php foreach ($kegiatan as $a) {
							if ($a->id_kegiatan == $keg_id) {
							echo "<option value='$a->id_kegiatan' selected>$a->nama_kegiatan</option>";
							} else {
								echo "<option value='$a->id_kegiatan'>$a->nama_kegiatan</option>";
							}
						} ?>
					</select>
				</div>
			</td>
			<td>
			<button id="addNewKegiatan" class="btn btn-default btn-sm" type="button">
				<span class="icon icon-plus icon-white"></span>
			</button>
			</td>
			<td></td>
			<td></td>
		</tr>	
		<script>
			$("#addNewKegiatan").on('click', function(){
				$("#modalKegiatan").modal("show");
			});
			$("#tagSubmitKegiatan").on('click', function(){
				$.ajax({
					method: 'post',
					url:"<?php echo base_url(); ?>admin/master_kegiatan/alternateSave",
					data:{
						nama_keg:$("#tagInputKegiatan").val()
					},success: function(result) {
						if(result=="exist"){
							alert("Kegiatan sudah ada.");
						}else if(result=="null"){
							alert("mohon untuk mengisi data dengan benar.");
						}else{
							$("#combobox").html(result);
						}
					},
			        error: function(){
			            alert("Terjadi Kesalahan");
			        }
				});
				$("#modalKegiatan").modal("hide");
			});
		</script>
		<!-- <tr> ubah mei error
			<td>Derajat</td>
			<td><b><select name="derajat" required class="form-control" id="derajat">
					<option value="KILAT" <?= (isset($datpil->drajat) and $datpil->drajat=="KILAT")? 'selected' : '' ; ?>>KILAT</option>
					<option value="SEGERA" <?= (isset($datpil->drajat) and $datpil->drajat=="SEGERA")? 'selected' : '' ; ?>>SEGERA</option>
					<option value="BIASA" <?= (isset($datpil->drajat) and $datpil->drajat=="BIASA")? 'selected' : '' ; ?>>BIASA</option>
				</select></b>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr> -->
		<tr>
			<td style="vertical-align: top;">Perihal</td>
			<?php
			 echo "<td><b><textarea tabindex='4' name='perihal' required style='' class='form-control'>".$perihal."</textarea></b></td>";
			?>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td style="vertical-align: top;">Isi Surat</td>
			<?php
			 echo "<td colspan='4'><b><textarea tabindex='5' name='isi' required style='' rows='5' class='form-control'>".$isi."</textarea></b></td>";
			?>
		</tr>
		<!--<tr>
			<td width="15%">Staf yang Bertugas</td>
			<td width="30%"><b>
			<select tabindex='1' name='staf_tugas' required class='form-control'>
			 <?php
				foreach($user_n as $a){
					if($a->id == $staf_id){
						echo "<option value='$a->id' selected>$a->nama_lengkap - $a->NRP</option>";
					}else{
						echo "<option value='$a->id'>$a->nama_lengkap - $a->NRP</option>";
					}
				}
			?>
			</select>
			</b></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>-->
		<tr>
			<td width="20%">Lampiran</td>
			<td>
			<?php
				if ($act!="view"  && $act != "kadisp"){ ?>
				<b><input id="filenya" type="file" name="file_attachment" tabindex="11" class="form-control" style="width: 200px"></b>File lama:
				<?php } ?>	
				 <a href="<?php echo base_URL(); ?>upload/nota_dinas/<?php echo $file_attachment; ?>" target='_blank'><?php echo $file_attachment; ?></a>

			</td>
			<td><a class="btn btn-default btn-sm" id="generate_no">Generate Nomor Lampiran</a></td>
			<td><input readonly type='text' tabindex='2' name='no_lampiran' id='no_lampiran' style='' class='form-control'></td>
			<td><a href="" target="_blank" id="cetak_no_lampiran" class="btn btn-default btn-sm">Cetak Nomor</a></td>
		</tr>
		<script>
			/***********************************************
             ** Feature Cetak nomer Notadinas
             ** By: Muhamad Farhan Badrussalam
             ***********************************************/
			$("#generate_no").click(function(){
				// alert(document.getElementById("filenya").files[0].name);
				var a = new Date();
				var month = a.getMonth();
				var roman = romanize(month + 1);
			 	$.ajax({
					method: 'post',
					url:"<?php echo base_url(); ?>admin/generate_filename",
					success: function(result) {
						$("#no_lampiran").attr("value","ND-" + result + "-" + roman + "-" + a.getFullYear());
						$("#cetak_no_lampiran").attr("href","<?php echo base_URL(); ?>admin/cetak_no_lampiran/ND/" + result + "/" + roman + "/" + a.getFullYear());
					},
			        error: function(){
			            alert("Terjadi Kesalahan");
			        }

				});
			});

			function romanize (num) {
				if (!+num)
					return false;
				var	digits = String(+num).split(""),
					key = ["","C","CC","CCC","CD","D","DC","DCC","DCCC","CM",
					       "","X","XX","XXX","XL","L","LX","LXX","LXXX","XC",
					       "","I","II","III","IV","V","VI","VII","VIII","IX"],
					roman = "",
					i = 3;
				while (i--)
					roman = (key[+digits.pop() + (i * 10)] || "") + roman;
				return Array(+digits.join("") + 1).join("M") + roman;
			}

			/*
                ||  Ajax validasi ID berdasarkan database
                ||  Putri Dewi Punamasari
                */

                //START
                //Deklarasi fungsi delay agar callback ditunda selama sekian miliseconds
                var delay = (function(){
                  var timer = 0;
                  return function(callback, ms){
                    clearTimeout (timer);
                    timer = setTimeout(callback, ms);
                  };
                })();

                //Trigger keyup untuk id no_surat
                // $(document).on('keyup', '#no_surat', function() {
                   // delay(function(){
                    // var id = $('#no_surat').val();
                    // var idp = <?php echo ($idp != "") ? $idp : "0"; ?>;
                      // $.ajax({
                        // method: 'post',
                        // data: {id:id,id_surat:idp,table:'nota_dinas'},
                        // url:"<?php echo base_url(); ?>admin/validasi_id",
                        // success: function(data) {

                            // if(data>0){
                                // $('#warning_nosu').css('display','block');
                            // }else{
                                // $('#warning_nosu').css('display','none');
                            // }
                        // },
                        // error: function(error){
                            // console.log(error);
                        // }

                        // });
                    // }, 1000 );
                // });
                
                //Ketika webpage diload, langsung melakukan pengecekan
                  $(window).load(function(){
                    $('#no_surat').keyup();
                 }); 

                //END
		 </script>
		<tr>
			<td style="vertical-align: top;">Keterangan</td>
			<?php
			 echo "<td colspan='4'><b><textarea tabindex='7' name='ket' required style='' rows='5' class='form-control'>".$ket."</textarea></b></td>";
			?>
		</tr>
		<!-- <tr>
			<td width="20%"><?php if((isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')) or $mode == 'add' or ($mode=="verifikasi_nota_dinas" and $datpil->kepada==$this->session->userdata('admin_jabatan'))){ ?>Tembusan<?php } ?></td>
			<td><?php if((isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')) or $mode == 'add' or ($mode=="verifikasi_nota_dinas" and $datpil->kepada==$this->session->userdata('admin_jabatan'))){ ?>
				<select name="tembusan" class="form-control" id="tembusan" tabindex="8">
				<option value="none" hidden>Pilih</option>
				<?php
				$arr = [];
				foreach ($datpil_tembusan as $b) {
					$arr[] = $b->id_jabatan;
				}
				foreach ($data as $b) {
					if(!in_array($b->id,$arr)){
						echo "<option value='".$b->id."'>".$b->nama_jabatan."</option>";
					}
				}
				?>
				</select>
			<?php } ?>
			</td>
			<td><?php if((isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')) or $mode == 'add' or ($mode=="verifikasi_nota_dinas" and $datpil->kepada==$this->session->userdata('admin_jabatan'))){ ?><a class="btn btn-default btn-sm" tabindex="9" id="tambah_tebusan" style="float:right; margin-left:10px;"><i class="icon icon-ok icon-white"></i> Tambah</a><?php } ?></td>
			<td><?php if((isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')) or $mode == 'add' or ($mode=="verifikasi_nota_dinas" and $datpil->kepada==$this->session->userdata('admin_jabatan'))){ ?><a onclick="myFunction()" class="btn btn-primary btn-sm" tabindex="9" id="hapus_tebusan" style="float:right; margin-left:10px;">Hapus</a><?php } ?></td>
			<td></td>
		</tr>
		<tr>
			<td width="20%" style="vertical-align:top;"><?php if(isset($datpil->create_by) and $datpil->create_by != $this->session->userdata('admin_id')){ ?>Tembusan<?php } ?></td>
			<td colspan="4">
				<table class="table table-bordered" id="tembusan_table" style="text-align:center;" <?= $disabled ?>>
					<tr>
						<td>No</td>
						<td>Jabatan</td>
						<td>Status</td>
						<td>Keterangan</td>
					</tr>
					<?php
					$count = 1;
						
						foreach($datpil_tembusan as $aa){
							if($aa->status==0){
								$asd = "background:#9b9389";
								$qwe = "background:#9b9389";
							}else if($aa->status==1){
								$asd = "background:#9b9389";
								$qwe = "background:#97310e";
							}else if($aa->status==2){
								$asd = "background:#97310e";
								$qwe = "background:#9b9389";
							} 
							echo "
							<tbody>
								<tr style='vertical-align:top;'>
									<td>".$count ."</td>
									<td>".$aa->nama_jabatan ."</td>
									<td></td>";
							if($this->session->userdata('admin_jabatan') == 2){
									// echo "<td><textarea name='keterangan_tembusan[]' class='form-control' readonly>".$aa->keterangan."</textarea></td>";
								
							}else{
								// echo "<td><textarea name='keterangan_tembusan[]' class='form-control'>".$aa->keterangan."</textarea></td>";
							}
								echo "<td></td></tr>
							</tbody>";
							$count+=1;
						}
					?>
				</table>
			</td>
		</tr> -->
		<tr>
						<td width="20%"><?php if((isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')) or $mode == 'add' or ($mode=="verifikasi_nota_dinas" and $datpil->kepada==$this->session->userdata('admin_jabatan'))){ ?>Tembusan<?php } ?></td>
                        <td width="20%"><?php if((isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')) or $mode == 'add' or ($mode=="verifikasi_nota_dinas" and $datpil->kepada==$this->session->userdata('admin_jabatan'))) {?>
                                <select name="tembusan" class="form-control" id="tembusan" tabindex="8">
                                    <option value="none" hidden>Pilih</option>
                                    <?php
                                    $arr = [];
                                    foreach ($datpil_tembusan as $b) {
                                        $arr[] = $b->id_jabatan;
                                    }
                                    foreach ($data as $b) {
                                        if (!in_array($b->id, $arr)) {
                                            echo "<option value='$b->id'>$b->nama_jabatan</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </td>
                        <td><?php if ((isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')) or $mode == 'add') { ?>
                                <a class="btn btn-default btn-sm" tabindex="9" id="tambah_tebusan"
                                   style="float:right; margin-left:10px;"><i class="icon icon-ok icon-white"></i> Tambah</a><?php } ?>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>


                    <tr>
                        <td width="20%"
                            style="vertical-align:top;"><?php if(isset($datpil->create_by) and $datpil->create_by != $this->session->userdata('admin_id')) { ?>Tembusan<?php } ?></td>
                        <td colspan="4">
                            <table class="table table-bordered" id="tembusan_table" style="text-align:center;">
                                <tr>
                                    <td>No</td>
                                    <td>Jabatan</td>
                                    <td>Keterangan</td>
                                    <td>Aksi</td>
                                </tr>
                                <?php
                                $count = 1;

                                foreach ($datpil_tembusan as $aa) {
                                    if ($aa->status == 0) {
                                        $asd = "background:#9b9389";
                                        $qwe = "background:#9b9389";
                                    } else if ($aa->status == 1) {
                                        $asd = "background:#9b9389";
                                        $qwe = "background:#97310e";
                                    } else if ($aa->status == 2) {
                                        $asd = "background:#97310e";
                                        $qwe = "background:#9b9389";
                                    }
                                    echo "
							<tbody>
								<tr id='remdeb".$count."' style='vertical-align:top;'>
									<td>" . $count . "</td>
									<td>" . $aa->nama_jabatan . "</td>
									<td>";//ubah mei error
									if($aa->status == 100){
                                    echo "
									<textarea name='keterangan_tembusan[]' class='form-control'>Telah Membaca</textarea>";
									}
									echo "</td>";
									if($this->uri->segment(3)=='add'){
                                     echo "	<td> <a class='btn btn-danger' onclick='removeDB(". $count .",". $aa->id .",". $aa->idnya_tembusan .",&#39;". $aa->nama_jabatan ."&#39;)'>HAPUS</a></td>";
									}else{
										echo "<td></td>";
									}

									echo "
										</tr>
							</tbody>";
                                    $count += 1;
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
		<?php 
		if(isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id') and $mode == "edt" and $datpil->status_notadinas==3){
			echo "
		<tr>
			<td style='vertical-align:top;'>Komentar</td>
			<td colspan='4'><textarea name='komentar_kapushidrosal' class='form-control' disabled>$lognya->komentar</textarea></td>
		</tr>
			";
		}
		?>
		<tr>
			<td id="tembusan_input">
                        <?php
                        foreach ($datpil_tembusan as $aa) {
                            echo "<input type='text' name='jabatan[]' status_tembusan='" . $aa->idnya_tembusan . "' value='" . $aa->id . "' class='idjabatantembusan" . $aa->idnya_tembusan . "' id='idjabatantembusan" . $aa->idnya_tembusan . "' readonly hidden/>
						<input type='text' name='status[]' value='" . $aa->status . "' class='idstatustembusan" . $aa->idnya_tembusan . "' id='idstatustembusan" . $aa->idnya_tembusan . "' status_tembusan='" . $aa->idnya_tembusan . "' readonly hidden/>";
                        }
                        ?>
                    </td>
			<td></td>
			<td></td>
			<td></td>
			<td><?php if(isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')){
							if($this->uri->segment(3) == "verifikasi_nota_dinas"){
								echo '<br><a href="'.base_URL().'admin/nota_dinas" tabindex="11" style="float:right;" class="btn btn-success">
								<i class="icon icon-arrow-left icon-white"></i> Kembali
							</a>';
							}else{?>
				<br/>
				<!--<button type="submit" class="btn btn-primary" tabindex="10" style="float:right; margin-left:10px;"><i class="icon icon-ok icon-white"></i> Simpan</button>-->
				<a href="#" id="simpan_edit" tabindex="11" style="float:right; margin-left:10px;" class="btn btn-primary">
					<i class="icon icon-ok icon-white"></i> Simpan
				</a>
	
				<script>
					
				$('#simpan_edit').click(function(){
						var validate_perihal = validate($("textarea[name='perihal']").val());
						var validate_isi = validate($("textarea[name='isi']").val());
						var validate_ket = validate($("textarea[name='ket']").val());

						if ($('#warning_nosu').is(':visible')) {
							alert("No surat sudah ada.");
						}else{
							if($("textarea[name='perihal']").val()==""){
								alert("Harap isi perihal");
							}else if(validate_perihal=="failed" || validate_isi=="failed" || validate_ket=="failed"){
								alert("Harap tidak menggunakan kutip (') dan backslash (\\)");
							}else{
								$('#formnya').submit();
							}
						}
					});
				</script>
				<a href="<?php echo base_URL()?>admin/nota_dinas" tabindex="11" style="float:right;" class="btn btn-success">
					<i class="icon icon-arrow-left icon-white"></i> Kembali
				</a>
				<?php } 
				}elseif($this->session->userdata('admin_jabatan')==1 or $this->session->userdata('admin_jabatan')==28){?>
					<br/>
					<?php if($mode == "verifikasi_nota_dinas"){ ?>
					
					<?php } else{ ?>
					<button type="submit" class="btn btn-default" tabindex="10" style="float:right; margin-left:10px;">Simpan</button>
					
					<?php } ?>
					<a href="<?php echo base_URL()?>admin/nota_dinas" tabindex="11" style="float:right;" class="btn btn-success">
					<i class="icon icon-arrow-left icon-white"></i> Kembali
				</a>
				<?php } elseif((isset($tembusan) and isset($datpil) and isset($tembusan[$datpil->id][$this->session->userdata('admin_jabatan')])) and $tembusan[$datpil->id][$this->session->userdata('admin_jabatan')]){
echo '<a href="'.base_URL().'admin/nota_dinas" tabindex="11" style="float:right;" class="btn btn-success">
<i class="icon icon-arrow-left icon-white"></i> Kembali
</a>';
				}else{?>
				<br/>					
				<?php if($mode == "add"){ ?>
					<a tabindex="11" style="float:right;" class="btn btn-success" id="proses">
						Proses
					</a><!--ga bisa di hide-->

				<?php } else { ?>
				<?php if($this->session->userdata('admin_jabatan') != 2 && $this->session->userdata('admin_jabatan') != 1){ ?>
				<?php 
						$status = $this->db->query("SELECT status FROM notadinas.tembusan_nota_dinas WHERE status = 100 AND id_notadinas = '$datpil->id'" )->num_rows();
						$tembus = $this->db->query("SELECT id_notadinas FROM notadinas.tembusan_nota_dinas WHERE id_notadinas = '$datpil->id'")->num_rows();
						
				?>
				<a href="<?php echo base_URL()?>admin/nota_dinas" tabindex="11" style="float:right;" class="btn btn-success">
					<i class="icon icon-arrow-left icon-white"></i> Kembali
				</a>
				<?php } else { ?>
				<a href="<?php echo base_URL()?>admin/nota_dinas" tabindex="11" style="float:right;" class="btn btn-success">
					<i class="icon icon-arrow-left icon-white"></i> Kembali
				</a>
				<?php } ?>
				<?php } ?>
<?php if($mode == "edt"){ ?>

<?php } ?>

				<script>
					$('.status_tembusan_koreksi').click(function(){
						$(this).css('background','#97310e');
						var a = $(this).attr('status_tembusan');
						$('.status_tembusan_setuju'+a).css('background','#9b9389');
						$('.idstatustembusan'+a).attr('value','1');
					});
					$('.status_tembusan_setuju').click(function(){
						$(this).css('background','#97310e');
						var a = $(this).attr('status_tembusan');
						$('.status_tembusan_koreksi'+a).css('background','#9b9389');
						$('.idstatustembusan'+a).attr('value','2');
					});
					<?php if($mode=="add"){ ?>
					$('#proses').click(function(){
						var validate_perihal = validate($("textarea[name='perihal']").val());
						var validate_isi = validate($("textarea[name='isi']").val());
						var validate_ket = validate($("textarea[name='ket']").val());

						if($("textarea[name='perihal']").val()==""){
							alert("Harap isi perihal");
						}else if(document.getElementById("filenya").files.length==0){
							$('#formnya').submit();
						}else if(document.getElementById("filenya").files.length==1){
							if($("input[name='no_lampiran']").val()==""){
								alert("Harap generate nomor lampiran");
							}else{										
								$('#formnya').submit();
							}
						}else if(validate_perihal=="failed" || validate_isi=="failed" || validate_ket=="failed"){
							alert("Harap tidak menggunakan kutip (') dan backslash (\\)");
						}else{
							$.ajax({
								method: 'post',
								url:"http://192.168.0.189/eoffice/tasknota/surat_keluar.php", //mei
								// url:"http://192.168.2.10:90/eoffice/tasknota/nota_dinas.php", //jakarta
								// url:"http://192.168.3.12:88/eoffice/tasknota/nota_dinas.php", //pushidrosal
								data: {
									dari : <?= $this->session->userdata('admin_id'); ?>,
									kepada : $("select[name='dari']").val(),
									isi : $("textarea[name='isi']").val(),
									perihal : $("textarea[name='perihal']").val(),
									tglmulai: $("input[name='tgl_mulai_tugas']").val(),
									tgldeadline: $("input[name='tgl_akhir_tugas']").val()
								},success:function(){

								},error:function(){

								}
							});
							$('#formnya').submit();
						}
					});
					<?php } ?>
				</script>
				<?php } ?>
			</td>
		</tr>
		</table>
		<?php if($mode == "verifikasi_nota_dinas"){ ?>
		<div class="row-fluid well" style="overflow: hidden">
        <div class="navbar navbar-inverse">
            <div class="container z0">
                <div class="navbar-header">
                    <span class="navbar-brand" href="#">FEEDBACK</span>
                </div>
            </div><!-- /.container -->
        </div>

        <div class="row">
             <div class="col-lg-12">
                <div class="col-md-12" style="border: 1px solid #ccc; background-color: #fff; max-height: 250px; overflow-y: scroll;">
                    <div class="col-md-12 pesan" style="margin: 15px;">
                        <div class="row">
                        <div class="media">

                            <?php $chat = $this->db->query('SELECT  a.pengirim, a.penerima, a.pesan_feedback, a.created_at, a.waktu, b.id, b.nama_jabatan from notadinas.feedback_nota_dinas a, notadinas.master_jabatan b where a.pengirim = b.id AND id_nota_dinas ='.$idp.' ORDER BY a.id_feednota')->result(); 

                                foreach ($chat as $key => $res) {
                                 
                            ?>

                         
                          <div class="media-body">

                            <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
                            <div class="col-md-12">
                            <div class="row">
                            <div class="col-md-6">
                            	<?php if($res->penerima == $this->session->userdata('admin_jabatan')){ ?>
                                <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
                                <p class="media-heading"><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span class="pull-right"><?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></span> </p> 
                                <?php } ?>

                                <p class="pull-left" style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background: #FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?> <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){ ?> <sub style="color: #555";>&nbsp; <?= date('H:i',strtotime($res->waktu)) ?></sub> <?php } ?></p>
                            <?php } ?>
                            </div>
                            </div>

                            </div>

                            <?php }else{ ?>

                            <div class="col-md-12">
                            <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-5">
                            	<?php if($res->penerima == $this->session->userdata('admin_jabatan')){ ?>
                                <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>

                                <p><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span class="pull-right"><?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></span> </p> 

                                <?php } ?>

                                <p class="pull-right" style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background:#FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?>  <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){ ?> <sub style="color: #555";>&nbsp; <?= date('H:i',strtotime($res->waktu)) ?></sub> <?php } ?></p>
                            <?php } ?>
                            </div>
                            </div>

                            </div>

                            <?php } ?>

                          </div>
                          
                             
                           
                           

                            <?php } ?>
                        </div>
                    </div>
                    </div>

                </div>   

                <div class="col-md-12">
                    <br>
                    <div class="row">
                    <form>
                        <textarea class="form-control" id="pesan_feedback" name="pesan_feedback"></textarea>
                        <br>
                       <center> <button type="button" id="feedbacknota" class="btn btn-info">KIRIM</button></center>
                    </form>
                    </div>
                </div>     
             </div>
        </div>
     </div>
     <?php } ?>
		<script>
			$('#feedbacknota').on('click',function () {
				        var msg = $('#pesan_feedback').val();
				        var ids = <?php echo ($idp != "") ? $idp : "0"; ?>;
				        
				        $.ajax({ //ubah disposisi mei
				            url: "<?php echo base_URL()."administrator/feedbacknotas" ?>",
				            data: {pesan: msg, id:ids},
				            // dataType: "json",
				            type: "POST",
				            success: function(data){
				                // response(data);
				                // console.log(data);
				                $('#pesan_feedback').val('');
				            	$('.media').load('<?= base_URL()."admin/nota_dinas/verifikasi_nota_dinas/"  ?>'+ids+' .media');
				            },
				            error: function(data){
				                alert('Feedback Gagal Dikirim!');
				            }
				        });
				    });
			<?php if(!isset($datpil_tembusan)){ ?>
			var count = 1;
			$('#tambah_tebusan').click(function(){
				var a = $('#tembusan').val();
				if(a!="none"){
					$.ajax({
					url: "<?php echo base_URL()?>admin/nota_dinas/tambah_tembusan/",
					type: 'POST',
					data: {data:a,count:count},
					success: function(msg)
					{
						$("#tembusan_table").append(msg);
						$.ajax({
						url: "<?php echo base_URL()?>admin/nota_dinas/cetak_input_tembusan/",
						type: 'POST',
						data: {data:a,count:count},
						success: function(msg)
						{
							$("#tembusan_input").append(msg);
							count = count + 1;
							$('#tembusan').find(":selected").css('display','none');
							$("#tembusan").val('none');
						}
						});
					}
					});
				}else{
					alert('Pilih dengan benar');
				}
			});
			<?php }else{ ?>
			var count = <?php echo $count; ?>;
			$('#tambah_tebusan').click(function(){
				var a = $('#tembusan').val();
				if(a!="none"){
					$.ajax({
					url: "<?php echo base_URL()?>admin/nota_dinas/tambah_tembusan/",
					type: 'POST',
					data: {data:a,count:count},
					success: function(msg)
					{

						$("#tembusan_table").append(msg);
						$.ajax({
						url: "<?php echo base_URL()?>admin/nota_dinas/cetak_input_tembusan/",
						type: 'POST',
						data: {data:a,count:count},
						success: function(msg)
						{
							$("#tembusan_input").append(msg);
							count = count + 1;
							$('#tembusan').find(":selected").css('display','none');
							$("#tembusan").val('none');
						}
						});
					}
					});
				}else{
					alert('Pilih dengan benar');
				}
			});
			<?php } ?>
			
			function removeD(e,z) {
					//namvanka start
					$('#tembusan').find('option[value='+z+']').css('display','block');
					//end
                    $('#remove' + e).remove();
					$("#idstatustembusan" + z).remove();
					$("#idjabatantembusan" + z).remove();
                    // $('#tembusan_input').remove();
                }

            function removeDB(e,a,z,y) {
					
					
					$.ajax({
					url: "<?php echo base_URL()?>admin/nota_dinas/hapus_tembusan",
					type: 'POST',
					data: {id:z},
					success: function(msg)
					{
						//namvanka start
						var selection = "<option value='"+a+"'>"+y+"</option>";
						$('#tembusan').append(selection);
						//end
	                    $('#remdeb' + e).remove();						
					}
					});
            }
		    
		</script>
		<script>
		</script>
	</div>
	
	</div>
<?php if($this->session->userdata('admin_jabatan')==0){
			?>
<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js'></script>
<script>
	$('head').append('<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"">');
</script>
<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Verifikasi Konsep</span>
		</div>
	</div><!-- /.container -->
</div>
<div class="row-fluid well" style="overflow: hidden">
	<div class="col-lg-12">
		<table width="100%" class="table-form">
			<tr>
				<td width="15%"></td>
				<td width="30%"></td>
				<td width="10%"></td>
				<td width="15%"></td>
				<td width="30%">
					<button class='btn-default btn btn-sm' type='button' data-toggle="modal" data-target="#myModal" style="float:right;">Log Nota Dinas</button>
				</td>
			</tr>
			<tr>
				<td style="vertical-align:top;">Komentar</td>
				<td colspan='4'><textarea name='komentar_kapushidrosal' class='form-control'></textarea></td>
			</tr>
			<tr>
				<td colspan='5'>
					<a href="<?php echo base_URL()?>admin/nota_dinas/verifikasi_submit_kapushidrosal_setuju/<?= $idp ?>" tabindex="11" style="float:right;margin-left:10px;" class="btn btn-success">Setuju</a>
					<button type="submit" class="btn btn-primary" tabindex="10" style="float:right">Koreksi</button>
				</td>
			</tr>
		</table>
	</div>
</div>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="width:70% !important;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background:#194896;color:white;font-weight:bold;text-align:center;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Log Nota Dinas</h4>
        </div>
        <div class="modal-body">
			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal Proses</th>
						<th>Keterangan</th>
						<th>Komentar</th>
						<th>Proses</th>
					</tr>
				</thead>
				<tfoot>
				</tfoot>
				<tbody>
					<?php $azx=1;foreach($log_surat_keluarnya as $m){
					echo "<tr>
						<td>$azx</td>
						<td>$m->tanggal_proses</td>
						<td>$m->keterangan</td>
						<td>$m->komentar</td>
						<td>$m->nama_proses</td>
					</tr>";
					$azx+=1;
					} ?>
				</tbody>
			</table>
			<script>
				$(document).ready(function() {
					$('#example').DataTable();
				});
			</script>
        </div>
      </div>
      
    </div>
  </div>

<?php 
} else if($this->session->userdata('admin_jabatan')==3){
	$qazwsx = 0;
	if(empty($log)){
		
	}else if($no_surat != null){
	
	}
	elseif($qazwsx!=0){
			?>
<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js'></script>
<script>
	$('head').append('<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"">');
</script>
<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Verifikasi Konsep</span>
		</div>
	</div><!-- /.container -->
</div>
<div class="row-fluid well" style="overflow: hidden">
	<div class="col-lg-12">
		<table width="100%" class="table-form">
			<tr>
				<td width="15%"></td>
				<td width="30%"></td>
				<td width="10%"></td>
				<td width="15%"></td>
				<td width="30%">
					
				</td>
			</tr>
			<tr>
				<td style="vertical-align:top;">Komentar</td>
				<td colspan='4'><textarea name='komentar_kapushidrosal' class='form-control'><?php echo $log->komentar; ?></textarea></td>
			</tr>
		</table>
	</div>
</div>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="width:70% !important;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background:#194896;color:white;font-weight:bold;text-align:center;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Log Nota Dinas</h4>
        </div>
        <div class="modal-body">
			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal Proses</th>
						<th>Keterangan</th>
						<th>Komentar</th>
						<th>Proses</th>
					</tr>
				</thead>
				<tfoot>
				</tfoot>
				<tbody>
					<?php $azx=1;
					foreach($lognya as $m){
					echo "<tr>
						<td>$azx</td>
						<td>$m->tanggal_proses</td>
						<td>$m->keterangan</td>
						<td>$m->komentar</td>
						<td>$m->nama_proses</td>
					</tr>";
					$azx+=1;
					} ?>
				</tbody>
			</table>
			<script>
				$(document).ready(function() {
					$('#example').DataTable();
				});
			</script>
        </div>
      </div>
      
    </div>
  </div>
 <div class="modal fade" id="myModal123" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Tujuan</h4>
                    <br/>
                    <input type="text" name="nama_tambah_tujuan" class="form-control" id="nama_tambah_tujuan"/>
                    <br/>
                    <a href="#" class="btn btn-default btn-sm" id="button_tambah_tujuan">Simpan</a>
                </div>
            </div>
        </div>
    </div>
<?php } 
} ?>
	</form>
<script type="text/javascript">
	$("#button_tambah_tujuan").click(function () {
            $.ajax({
                method: 'get',
                url: "<?php echo base_URL()?>admin/surat_keluar/tambah_tujuan?q=" + $("#nama_tambah_tujuan").val(),
                data: {}, success: function (result) {
                    $("#combobox").html(result);
                    console.log(result);
                    $(".custom-combobox-input").val($("#nama_tambah_tujuan").val());
                }, error: function () {
                    alert("Nama tujuan sudah tersedia");
                }
            });
            $("#myModal123").modal("hide");
        });
	$('#tgl_surat').datepicker({dateFormat: 'dd-mm-yy'}).val();
	function ganti(isi){
        // alert(isi);
        // 
       }
       function masukinnama(value){
       	alert(value);
       }

</script>