<?php
$mode		= $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt" || $mode == "verifikasi_nota_dinas") {
	$act		= "act_edt";
	$idp		= $datpil->id;
	// $no_agenda	= $datpil->no_agenda;
	// $kode		= $datpil->kode;
	$dari		= $datpil->kepada;
	$no_surat	= $datpil->no_surat;
	$tgl_surat	= $datpil->tgl_surat;
	$uraian		= $datpil->isi;
	$ket		= $datpil->keterangan;
	$perihal	= $datpil->perihal;
	$isi	= $datpil->isi;
	$status	= $datpil->status_notadinas;
	$file_attachment	= $datpil->file_attachment;
	$keg_id = $datpil->kegiatan_id;
	$staf_id = $datpil->staf_tugas;
	//$jabatan	= $datpil->jabatan_id;
	
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
	<form action="<?php echo base_URL()?>admin/nota_dinas/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="formnya">
	
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	<div class="row-fluid well" style="overflow: hidden">
	
	<div class="col-lg-12">
		<table width="100%" class="table-form">
		<tr>
			<td width="15%">Tujuan Surat</td>
			<td width="30%"><b>
			<?php 
			if($this->session->userdata('admin_jabatan')==2){
			 echo "<select tabindex='1' name='dari' required class='form-control' id='dari' disabled>";
			} else{
				echo "<select tabindex='1' name='dari' required class='form-control' id='dari'>";
			}
			?>
			 <?php
				foreach($user_n as $a){
					if($a->id == $dari){
						echo "<option value='$a->id' selected>$a->nama_lengkap</option>";
					}else{
						echo "<option value='$a->id'>$a->nama_lengkap</option>";
					}
				}
			?></select></b></td>
			<td width="10%"></td>
			<td width="15%">Tanggal Surat</td>
			<?php 
			if($this->session->userdata('admin_jabatan')==2){
			echo "<td width='30%'><b><input type='text' tabindex='2' name='tgl_surat' required value='".($tgl_surat != "" ? date("d-m-Y", strtotime($tgl_surat)) : "" )."' id='tgl_surat' style='' class='form-control' disabled></b></td>";
			} else{
				echo "<td width='30%'><b><input type='text' tabindex='2' name='tgl_surat' required value='".($tgl_surat != "" ? date("d-m-Y", strtotime($tgl_surat)) : "" )."' id='tgl_surat' style='' class='form-control'></b></td>";
			}
			?>
		</tr>
		<tr>
			<td>Nomor Surat</td>
			<td><b><input <?= $disabled ?> type="text" tabindex="3" name="no_surat" required value="<?php echo $no_surat; ?>" style="" class="form-control"></b></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td width="15%">Rujukan Kegiatan</td>
			<td width="30%"><b>
			<select tabindex='1' name='kegiatan' required class='form-control'>
			 <?php
                echo "<option value='' disabled selected>-Pilih Rujukan Kegiatan-</option>";
				foreach($kegiatan as $a){
					if($a->id_kegiatan == $keg_id){
						echo "<option value='$a->id_kegiatan' selected>$a->nama_kegiatan</option>";
					}else{
						echo "<option value='$a->id_kegiatan'>$a->nama_kegiatan</option>";
					}
				}
			?>
			</select>
			</b></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td style="vertical-align: top;">Perihal</td>
			<?php
			if($this->session->userdata('admin_jabatan')==2){
			 echo "<td><b><textarea tabindex='4' name='perihal' required style='' class='form-control' readonly>".$perihal."</textarea></b></td>";
			}else{
			 echo "<td><b><textarea tabindex='4' name='perihal' required style='' class='form-control'>".$perihal."</textarea></b></td>";
			}
			?>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td style="vertical-align: top;">Isi Surat</td>
			<?php
			if($this->session->userdata('admin_jabatan')==2){
			 echo "<td colspan='4'><b><textarea tabindex='5' name='isi' required style='' rows='5' class='form-control' readonly>".$isi."</textarea></b></td>";
			}else{
			 echo "<td colspan='4'><b><textarea tabindex='5' name='isi' required style='' rows='5' class='form-control'>".$isi."</textarea></b></td>";
			}
			?>
		</tr>
		<tr>
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
		</tr>
		<tr>
			<td width="20%">Lampiran</td>
			<td>
			<?php
			if($this->session->userdata('admin_jabatan')==2){
			 echo "<b><input type='file' name='file_attachment' tabindex='11' class='form-control' style='width: 200px' disabled></b>File lama: <a href='".base_URL()."upload/nota_dinas/".$file_attachment."' target='_blank'>".$file_attachment."</a>";
			}else{
				if ($act!="view"  && $act != "kadisp"){ ?>
				<b><input id="filenya" type="file" name="file_attachment" tabindex="11" class="form-control" style="width: 200px"></b>File lama:
				<?php } ?>	
				 <a href="<?php echo base_URL(); ?>upload/nota_dinas/<?php echo $file_attachment; ?>" target='_blank'><?php echo $file_attachment; ?></a>
				<?php
			}
			?>
			</td>
			<td><a class="btn btn-default btn-sm" id="generate_no">Generate Nomor Lampiran</a></td>
			<td><input type='text' tabindex='2' name='no_lampiran' id='no_lampiran' style='' class='form-control'></td>
			<td><a href="" target="_blank" id="cetak_no_lampiran" class="btn btn-default btn-sm">Cetak Nomor</a></td>
		</tr>
		<script>
			$("#generate_no").click(function(){
				// alert(document.getElementById("filenya").files[0].name);
			 	$.ajax({
					method: 'post',
					url:"<?php echo base_url(); ?>admin/generate_filename",
					success: function(result) {
						var a = new Date();
						$("#no_lampiran").attr("value","ND-" + result + "-" + a.getFullYear());
						$("#cetak_no_lampiran").attr("href","<?php echo base_URL(); ?>admin/cetak_no_lampiran/ND-" + result + "-" + a.getFullYear());
					},
			        error: function(){
			            alert("Terjadi Kesalahan");
			        }

				});
			});
		 </script>
		<tr>
			<td style="vertical-align: top;">Keterangan</td>
			<?php
			if($this->session->userdata('admin_jabatan')==2){
			 echo "<td colspan='4'><b><textarea tabindex='7' name='ket' required style='' rows='5' class='form-control' readonly>".$ket."</textarea></b></td>";
			}else{
			 echo "<td colspan='4'><b><textarea tabindex='7' name='ket' required style='' rows='5' class='form-control'>".$ket."</textarea></b></td>";
			}
			?>
		</tr>
		<tr>
			<td width="20%"><?php if((isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')) or $mode == 'add'){ ?>Tembusan<?php } ?></td>
			<td><?php if((isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')) or $mode == 'add'){ ?>
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
			<td><?php if((isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')) or $mode == 'add'){ ?><a class="btn btn-default btn-sm" tabindex="9" id="tambah_tebusan" style="float:right; margin-left:10px;"><i class="icon icon-ok icon-white"></i> Tambah</a><?php } ?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td width="20%" style="vertical-align:top;"><?php if(isset($datpil->create_by) and $datpil->create_by != $this->session->userdata('admin_id')){ ?>Tembusan<?php } ?></td>
			<td colspan="4">
				<table class="table table-bordered" id="tembusan_table" style="text-align:center;" <?= $disabled ?>>
					<tr>
						<td>No</td>
						<td>Jabatan</td>
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
									<td>".$aa->nama_jabatan ."</td>";
							if($this->session->userdata('admin_jabatan') == 2){
									echo "<td><textarea name='keterangan_tembusan[]' class='form-control' readonly>".$aa->keterangan."</textarea></td>";
								
							}else{
								echo "<td><textarea name='keterangan_tembusan[]' class='form-control'>".$aa->keterangan."</textarea></td>";
							}
								echo "</tr>
							</tbody>";
							$count+=1;
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
					foreach($datpil_tembusan as $aa){
						echo "<input type='text' name='jabatan[]' status_tembusan='".$aa->idnya_tembusan."' value='".$aa->id."' class='idjabatantembusan".$aa->idnya_tembusan."' readonly hidden/>
						<input type='text' name='status[]' value='".$aa->status."'class='idstatustembusan".$aa->idnya_tembusan."' status_tembusan='".$aa->idnya_tembusan."' readonly hidden/>";
					}
				?>
			</td>
			<td></td>
			<td></td>
			<td></td>
			<td><?php if(isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')){
							if($this->uri->segment(3) == "verifikasi_nota_dinas"){
								
							}else{?>
				<br/><button type="submit" class="btn btn-primary" tabindex="10" style="float:right; margin-left:10px;"><i class="icon icon-ok icon-white"></i> Simpan</button>
				<a href="<?php echo base_URL()?>admin/nota_dinas" tabindex="11" style="float:right;" class="btn btn-success">
					<i class="icon icon-arrow-left icon-white"></i> Kembali
				</a>
				<?php } 
				}elseif($this->session->userdata('admin_jabatan')==1){ ?>
					<a href="<?php echo base_URL()?>admin/nota_dinas/getDetailKegiatan/<?php echo $keg_id?>" tabindex="11" style="float:right;" class="btn btn-success">
					<i class="icon icon-arrow-left icon-white"></i> Kembali
				</a>
				<?php
				}elseif($this->session->userdata('admin_jabatan')==2){?>
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
		</script>
	</div>
	
	</div>
<?php if($this->session->userdata('admin_jabatan')==1){
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
	if(empty($log)){
		
	}else if($no_surat != null){
	
	}
	else{
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
<?php } 
} ?>
	</form>
<script type="text/javascript">
	$('#tgl_surat').datepicker({ dateFormat: 'dd-mm-yy' }).val();
</script>