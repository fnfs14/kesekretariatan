<?php
$mode		= $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt" || $mode == "verifikasi_surat_antar_kadis" || $mode == "show") {
	$act		= "act_edt";
	$idp		= $datpil->id;
	$perihal    = $datpil->perihal;
	// $no_agenda	= $datpil->no_agenda;
	// $kode		= $datpil->kode;
	$file_attachment = $datpil->file_attachment;
	$dari		= $datpil->kepada;
	$no_surat	= $datpil->no_surat;
	$tgl_surat	= $datpil->tgl_surat;
	$uraian		= $datpil->isi;
	$ket		= $datpil->keterangan;
	$isi_surat	= $datpil->isi;
	if($mode == "verifikasi_surat_antar_kadis"){
		if($this->session->userdata('admin_jabatan')==1){
			$act = 'verifikasi_submit_kapushidrosal/'.$idp;
		}elseif($this->session->userdata('admin_satuan')==6){
			$act = 'verifikasi_submit_setum/'.$idp;
		}else{
			$act = 'verifikasi_submit/'.$idp;
		}
	}
	
} else {
	$datpil_tembusan = [];
	$act		= "act_add";
	$idp		= "";
	$no_agenda	= "";
	$kode		= "";
	$dari		= "";
	$no_surat	= "";
	$tgl_surat	= "";
	$uraian		= "";
	$ket		= "";
	$perihal	= "";
	$isi_surat	= "";
	$file_attachment = "";
}
if($this->session->userdata('admin_satuan')==6){
	$disabled = "";
}else{
	$disabled = "disabled";
}
?>
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
<script src="<?= base_url() ?>aset/js/autocomplete.js"></script>
<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Surat Antar Kadis</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->


	<form action="<?php echo base_URL()?>admin/surat_antar_kadis/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="formnya">
	
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	<div class="row-fluid well" style="overflow: hidden">
	
	<div class="col-lg-12">
		<table width="100%" class="table-form">
		<tr>
			<td width="15%">Tujuan Surat</td>
			<td width="30%">
			<?php if($dari==""){ ?>
				<select class="form-control" name="dari">
					<?php foreach($tujuan as $a){ 
						echo "<option value='$a->id'>$a->nama_lengkap</option>";
					 } ?>
				</select>
			<?php }else{
				?>
				<select class="form-control" name="dari">
					<?php foreach($tujuan as $a){ 
						// $datpil->create_by==$this->session->userdata('admin_id')
						if($dari==$a->id){
							echo "<option value='$a->id' selected>$a->nama_lengkap</option>";
						}else{
							echo "<option value='$a->id'>$a->nama_lengkap</option>";
						}
					 } ?>
				</select>
			<?php } ?>
			</td>
			<td width="10%"></td>
			<td width="15%">Tanggal Surat</td>
			<td width="30%"><b><input type="text" tabindex="2" name="tgl_surat" required value="<?php echo $tgl_surat; ?>" id="tgl_surat" style="" class="form-control"></b></td>
		</tr>
		<tr>
			<td>Nomor Surat</td>
			<td><b><input readonly type="text" tabindex="3" name="no_surat" required value="<?= (isset($generated_no_surat))? $generated_no_surat : $no_surat; ?>" style="" class="form-control"></b></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Klasifikasi</td>
			<td><b><select name="klasifikasi" required class="form-control" id="klasifikasi" >
					<option value="SANGAT RAHASIA" <?= (isset($datpil->klasifikasi) and $datpil->klasifikasi=="SANGAT RAHASIA")? 'selected' : '' ; ?>>SANGAT RAHASIA</option>
					<option value="RAHASIA" <?= (isset($datpil->klasifikasi) and $datpil->klasifikasi=="RAHASIA")? 'selected' : '' ; ?>>RAHASIA</option>
					<option value="BIASA" <?= (isset($datpil->klasifikasi) and $datpil->klasifikasi=="BIASA")? 'selected' : '' ; ?>>BIASA</option>
				</select></b>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>	
		<tr>
			<td>Derajat</td>
			<td><b><select name="derajat" required class="form-control" id="derajat">
					<option value="KILAT" <?= (isset($datpil->derajat) and $datpil->derajat=="KILAT")? 'selected' : '' ; ?>>KILAT</option>
					<option value="SEGERA" <?= (isset($datpil->derajat) and $datpil->derajat=="SEGERA")? 'selected' : '' ; ?>>SEGERA</option>
					<option value="BIASA" <?= (isset($datpil->derajat) and $datpil->derajat=="BIASA")? 'selected' : '' ; ?>>BIASA</option>
				</select></b>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td style="vertical-align: top;">Perihal</td>
			<td><b><textarea tabindex="4" name="perihal" required style="" class="form-control"><?php echo $perihal; ?></textarea></b></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td style="vertical-align: top;">Isi Surat</td>
			<td colspan="4"><b><textarea tabindex="5" name="isi_surat" required style="" rows="5" class="form-control"><?php echo $isi_surat; ?></textarea></b></td>
		</tr>
		<tr>
			<td width="20%">Lampiran</td>
			<td>
				<?php if ($file_attachment==""){ ?>
					<b><input type="file" name="file_attachment" tabindex="11" class="form-control" style="width: 200px"></b>
				<?php }else{ ?>	
					File lama:
				 <a href="<?php echo base_URL(); ?>upload/surat_antar_kadis/<?php echo $file_attachment; ?>" target='_blank'><?php echo $file_attachment; ?></a>
				 <?php } ?>
			 </td>
			 <?php if($mode!="show" and $mode!="edt" and $mode!="verifikasi_surat_antar_kadis"){ ?>
			<td><a class="btn btn-default btn-sm" id="generate_no">Tampilkan Nomor Lampiran</a></td><!--ubah mei bahasa-->
			<td><input type='text' tabindex='2' name='no_lampiran' id='no_lampiran' style='' class='form-control'></td>
			<td><a href="" target="_blank" id="cetak_no_lampiran" class="btn btn-default btn-sm">Cetak Nomor</a></td>
			 <?php }else{ ?>
			 <td></td>
			 <td></td>
			 <td></td>
			 <?php } ?>
		 </tr>
		<script>
			$("#generate_no").click(function(){
				// alert(document.getElementById("filenya").files[0].name);
			 	$.ajax({
					method: 'post',
					url:"<?php echo base_url(); ?>admin/generate_filename?q=21",
					success: function(result) {
						var a = new Date();
						$("#no_lampiran").attr("value","SAK-" + result + "-" + a.getFullYear());
						$("#cetak_no_lampiran").attr("href","<?php echo base_URL(); ?>admin/cetak_no_lampiran/SAK-" + result + "-" + a.getFullYear());
					},
			        error: function(){
			            alert("Terjadi Kesalahan");
			        }

				});
			});
		 </script>
		<tr>
			<td style="vertical-align: top;">Keterangan</td>
			<td colspan="4"><b><textarea tabindex="7" name="ket" required style="" rows="5" class="form-control"><?php echo $ket; ?></textarea></b></td>
		</tr>
		<?php //if($this->session->userdata('admin_satuan')!=6){ ?>
		<tr>
			<td width="20%"><?php if((isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')) or $mode == 'add' or $mode == 'verifikasi_surat_antar_kadis'){ ?>Tembusan<?php } ?></td>
			<td><?php if((isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')) or $mode == 'add' or $mode == 'verifikasi_surat_antar_kadis'){ ?>
				<select name="tembusan" class="form-control" id="tembusan" tabindex="8">
				<option value="none" hidden>Pilih</option>
				<?php
				$arr = [];
				foreach ($datpil_tembusan as $b) {
					$arr[] = $b->id_jabatan;
				}
				foreach ($data as $b) {
					if(!in_array($b->id,$arr)){
						echo "<option value='$b->id'>$b->nama_jabatan</option>";
					}
				}
				?>
				</select>
			<?php } ?>
			</td>
			<td><?php if((isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')) or $mode == 'add' or $mode == 'verifikasi_surat_antar_kadis'){ ?><a class="btn btn-default btn-sm" tabindex="9" id="tambah_tebusan" style="float:right; margin-left:10px;"><i class="icon icon-ok icon-white"></i> Tambah</a><?php } ?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td width="20%" style="vertical-align:top;"><?php if(isset($datpil->create_by) and $datpil->create_by != $this->session->userdata('admin_id')){if($mode != 'verifikasi_surat_antar_kadis'){ ?>Tembusan<?php }} ?></td>
			<td colspan="4">
				<table class="table table-bordered" id="tembusan_table" style="text-align:center;">
					<tr>
						<td>No</td>
						<td>Jabatan</td>
						<td>Status</td>
						<td>Keterangan</td>
					</tr>
					<?php
					$count = 1;
					if($mode != 'verifikasi_surat_antar_kadis'){
						
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
									<td>";
							if($this->session->userdata('admin_jabatan')==1){
								echo "<div class='col-md-12'><a class='btn-default btn btn-xs status_tembusan_setuju status_tembusan_setuju".$aa->idnya_tembusan."' style='; $asd' status_tembusan='".$aa->idnya_tembusan."'>Setuju</a></div>";
							}else if(isset($datpil->create_by) and $datpil->create_by != $this->session->userdata('admin_id') or $mode == "edt"){
								if($aa->idnya_jabatan!=$this->session->userdata('admin_jabatan')){
									$tembusan_hidden_show = "hidden";
								}else{
									$tembusan_hidden_show = "";
								}
									// echo "<div class='col-md-6' $tembusan_hidden_show><a class='btn-default btn btn-xs status_tembusan_setuju status_tembusan_setuju".$aa->idnya_tembusan."' style='float:right; $asd' status_tembusan='".$aa->idnya_tembusan."'>Setuju</a></div>
									// <div class='col-md-6' $tembusan_hidden_show><a class='btn-default btn btn-xs status_tembusan_koreksi status_tembusan_koreksi".$aa->idnya_tembusan."' style='float:left; $qwe' status_tembusan='".$aa->idnya_tembusan."'>Koreksi</a></div>";
							}
									echo "</td>";
									if($this->session->userdata('admin_id')==$datpil->create_by){
										$tembusan_hidden_show = "";
									}else if($aa->idnya_jabatan!=$this->session->userdata('admin_jabatan')){
										$tembusan_hidden_show = "style='display:none;'";
									}else{
										$tembusan_hidden_show = "";
									}
									echo "<td></td>";
									// <td><textarea name='keterangan_tembusan[]' class='form-control' $tembusan_hidden_show>".$aa->keterangan."</textarea></td>";
								echo "</tr>
							</tbody>";
							$count+=1;
						}
					}
					?>
				</table>
			</td>
		</tr>
		<?php //}
		if(isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id') and $mode == "edt" and $datpil->status_surat_antar_kadis==3){
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
				if($mode != "verifikasi_surat_antar_kadis"){
					foreach($datpil_tembusan as $aa){
						echo "<input type='text' name='jabatan[]' status_tembusan='".$aa->idnya_tembusan."' value='".$aa->id."' class='idjabatantembusan".$aa->idnya_tembusan."' readonly hidden/>
						<input type='text' name='status[]' value='".$aa->status."'class='idstatustembusan".$aa->idnya_tembusan."' status_tembusan='".$aa->idnya_tembusan."' readonly hidden/>";
					}
				}
				?>
			</td>
			<td></td>
			<td></td>
			<td></td>
			<td><?php if($mode=="show"){ ?>
				<a href="<?php echo base_URL()?>admin/surat_antar_kadis" tabindex="11" style="float:right; margin-left:10px;" class="btn btn-success">
					<i class="icon icon-arrow-left icon-white"></i> Kembali
				</a>
			<?php } else if(isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id') || $this->session->userdata('admin_jabatan')==0 ){ ?>
				<?php if ($this->session->userdata('admin_jabatan')!=0){ ?>
				<br/><button type="submit" class="btn btn-primary" tabindex="10" style="float:right; margin-left:10px;"><i class="icon icon-ok icon-white"></i> Simpan</button>
				<a href="<?php echo base_URL()?>admin/surat_antar_kadis" tabindex="11" style="float:right;" class="btn btn-success">
					<i class="icon icon-arrow-left icon-white"></i> Kembali
				</a>
				<?php } else {?>
				<br/><button type="submit" class="btn btn-primary" tabindex="10" style="float:right; margin-left:10px;"><i class="icon icon-ok icon-white"></i> Simpan</button>
				<a href="<?php echo base_URL()?>admin/agenda_surat_antar_kadis" tabindex="11" style="float:right;" class="btn btn-success">
					<i class="icon icon-arrow-left icon-white"></i> Kembali
				</a>
				<?php } ?>
				<?php }elseif($this->session->userdata('admin_jabatan')==1){
					
				}elseif($this->session->userdata('admin_satuan')==6){?>
					<br/><button type="submit" class="btn btn-default" tabindex="10" style="float:right; margin-left:10px;">Simpan</button>
				<?php } else{?>
				<br/><a tabindex="11" style="float:right;" class="btn btn-success" id="proses">
					Proses
				</a>
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
					$('#proses').click(function(){
						$('#formnya').submit();
					});
				</script>
				<?php } ?>
			</td>
		</tr>
		</table>
		<script>
			<?php if(!isset($datpil_tembusan)){ ?>
			var count = 1;
			$('#tambah_tebusan').click(function(){
				var a = $('#tembusan').val();
				if(a!="none"){
					$.ajax({
					url: "<?php echo base_URL()?>admin/surat_keluar/tambah_tembusan/",
					type: 'POST',
					data: {data:a,count:count},
					success: function(msg)
					{
						$("#tembusan_table").append(msg);
						$.ajax({
						url: "<?php echo base_URL()?>admin/surat_keluar/cetak_input_tembusan/",
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
			var count = <?= (isset($count))? $count : 0; ?>;
			$('#tambah_tebusan').click(function(){
				var a = $('#tembusan').val();
				if(a!="none"){
					$.ajax({
					url: "<?php echo base_URL()?>admin/surat_keluar/tambah_tembusan/",
					type: 'POST',
					data: {data:a,count:count},
					success: function(msg)
					{
						$("#tembusan_table").append(msg);
						$.ajax({
						url: "<?php echo base_URL()?>admin/surat_keluar/cetak_input_tembusan/",
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
		</script>
	</div>
	
	</div>
<?php if($this->session->userdata('admin_jabatan')==1){ ?>
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
					<button class='btn-default btn btn-sm' type='button' data-toggle="modal" data-target="#myModal" style="float:right;">Log Surat</button>
				</td>
			</tr>
			<tr>
				<td style="vertical-align:top;">Komentar</td>
				<td colspan='4'><textarea name='komentar_kapushidrosal' class='form-control'></textarea></td>
			</tr>
			<tr>
				<td colspan='5'>
					<a href="<?php echo base_URL()?>admin/surat_antar_kadis/verifikasi_submit_kapushidrosal_setuju/<?= $idp ?>" tabindex="11" style="float:right;margin-left:10px;" class="btn btn-success">Setuju</a>
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
          <h4 class="modal-title">Log Surat</h4>
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
					<?php $azx=1;foreach($log_surat_antar_kadisnya as $m){
					echo "<tr>
						<td>$azx</td>
						<td>$m->tanggal_proses</td>
						<td>$m->Keterangan</td>
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
<?php } ?>
	</form>


<script type="text/javascript">
	$('#tgl_surat').datepicker({ dateFormat: 'dd-mm-yy' }).val();

	$(document).ready(function () {
		$('input[type=file]').change(function () {
			var val = $(this).val().toLowerCase();
			var regex = new RegExp("(.*?)\.(gif|jpg|png|pdf|doc|docx)$");
			if(!(regex.test(val))) {
				$(this).val('');
				alert('Tipe file salah!  Pilih: gif / jpg / png / pdf / doc / docx');
			} 
		}); 
	});
</script>