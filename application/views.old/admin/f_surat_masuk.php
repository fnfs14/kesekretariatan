

<?php
$mode		= $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
	$act		= "act_edt";
	$idp		= $datpil->id;
	$no_setum	= $datpil->no_setum;
	$tgl_setum = $datpil->tgl_setum;
	$file_attachment= $datpil->file_attachment;
	$instansi		= $datpil->instansi;
	$no_surat	= $datpil->no_surat;
	$tgl_surat	= $datpil->tgl_surat;
	$perihal		= $datpil->perihal;
	$ket		= $datpil->keterangan;
	
} else if ($mode == "disp" ) {
	$act		= "view";
	$idp		= $datpil->id;
	$no_setum	= $datpil->no_setum;
	$tgl_setum = $datpil->tgl_setum;
	$file_attachment= $datpil->file_attachment;
	$instansi		= $datpil->instansi;
	$no_surat	= $datpil->no_surat;
	$tgl_surat	= $datpil->tgl_surat;
	$perihal		= $datpil->perihal;
	$klasifikasi		= $datpil->klasifikasi;
	$derajat		= $datpil->drajat;
	$ket		= $datpil->keterangan;
	$kepada		= $datpil->kepada;
	$aksi 		= $dataksi;
	$jabatan	= $datajabat;
	$dataksi = [];
	$datajabat = [];
} else if ($mode == "kadisp" ) {
	$act		= "kadisp";
	$idp		= $datpil->id;
	$no_setum	= $datpil->no_setum;
	$tgl_setum = $datpil->tgl_setum;
	$file_attachment= $datpil->file_attachment;
	$instansi		= $datpil->instansi;
	$no_surat	= $datpil->no_surat;
	$tgl_surat	= $datpil->tgl_surat;
	$perihal		= $datpil->perihal;
	$ket		= $datpil->keterangan;
	$dataksi = $dataksi;
	$aksi 		= $dataksi;
	$jabatan	= $datajabat;
} else if ($mode == "subdisp" ) {
	$act		= "subdisp";
	$idp		= $datpil->id;
	$no_setum	= $datpil->no_setum;
	$tgl_setum = $datpil->tgl_setum;
	$file_attachment= $datpil->file_attachment;
	$instansi		= $datpil->instansi;
	$no_surat	= $datpil->no_surat;
	$tgl_surat	= $datpil->tgl_surat;
	$perihal		= $datpil->perihal;
	$ket		= $datpil->keterangan;
	$dataksi = $dataksi;
	$aksi 		= $dataksi;
	$jabatan	= $datajabat;
}else {
	$act		= "act_add";
	$idp		= "";
	$no_setum	= ""; //gli("notadinas.surat_masuk", "no_setum", 4);
	$tgl_setum 	= date('d-m-Y');
	$file_attachment="";
	$kode		= "";
	$instansi	= "";
	$no_surat	= "";
	$tgl_surat	= "";
	$perihal	= "";
	$ket		= "";
}
?>
	<!-- breadcrumb -->
	<ol class="breadcrumb breadcrumb-arrow">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li><a href="#"><i class="fa fa-envelope"></i> Surat Masuk</a></li>
		<li class="active"><span>Tambah Surat</span></li>
	</ol>
	<!-- End Breadcrumb -->
<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Surat Masuk</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->
	
	
	<form action="<?php echo base_URL(); ?>admin/surat_masuk/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data"

	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	
	<div class="row-fluid well" style="overflow: hidden">
		
	<div class="col-lg-6">
		<table  class="table-form">
		<tr><td width="20%">No. Agenda</td><td><b><input type="text" name="no_setum" autofocus tabindex="1" required value="<?php echo $no_setum; ?>" style="width: 100px" class="form-control" <?php echo ($idp != "") ? "disabled" : ""; ?> ></b></td></tr>
		<tr><td width="20%">Tgl SETUM</td><td><b><input type="text" name="tgl_setum" tabindex="2" required value="<?php echo $tgl_setum;?>" id="tgl_setum" style="width: 200px" class="form-control" disabled></b></td></tr>	
		<tr><td width="20%">Klasifikasi</td><td><b>
		<select name="klasifikasi" tabindex="3" required class="form-control" id="klasifikasi" style="width: 200px" <?php echo ($idp != "") ? "disabled" : ""; ?> >
			<option value="SANGAT RAHASIA">SANGAT RAHASIA</option>
			<option value="RAHASIA">RAHASIA</option>
			<option value="BIASA">BIASA</option>
		</select>
		</b>
		</td></tr>	
		<tr><td width="20%">Derajat</td><td><b>
		<select name="derajat" tabindex="4" required class="form-control" id="derajat" style="width: 200px" <?php echo ($idp != "") ? "disabled" : ""; ?> >
			<option value="KILAT">KILAT</option>
			<option value="SEGERA">SEGERA</option>
			<option value="BIASA">BIASA</option>
		</select>
		</b>
		</td></tr>	
		
		</table>
	</div>
	
	<div class="col-lg-6">	
		<table  class="table-form">
		<tr><td width="20%">Dari</td><td><b><input type="text" name="instansi" tabindex="5" required value="<?php echo $instansi; ?>" id="instansi" style="width: 400px" class="form-control" <?php echo ($idp != "") ? "disabled" : ""; ?>></b></td></tr>		
		<tr><td width="20%">Nomor Surat</td><td><b><input type="text" name="no_surat" tabindex="6" required value="<?php echo $no_surat; ?>" style="width: 200px" class="form-control" <?php echo ($idp != "") ? "disabled" : ""; ?>></td></tr>	
		<tr><td width="20%">Tanggal Surat</td><td><b><input type="text" name="tgl_surat" tabindex="7" required value="<?php echo $tgl_surat; ?>" id="tgl_surat" style="width: 200px" class="form-control" <?php echo ($idp != "") ? "disabled" : ""; ?>></b></td></tr>	
		<tr><td width="20%">Perihal</td><td><b><input type="text"  name="perihal" tabindex="8" required class="form-control" style="width: 400px" value="<?php echo $perihal; ?>" <?php echo ($idp != "") ? "disabled" : ""; ?>></b></td></tr>	
		
		<tr><td width="20%">Diteruskan Kepada</td><td><b>
		<select name="kepada" tabindex="9" required class="form-control" id="derajat" style="width: 200px" <?php echo ($idp != "") ? "disabled" : ""; ?> >
			<option value="1">KAPUSHIDROSAL</option>
			<option value="3">KADIS INFOLAHTA</option>
			<option value="5">KASUBDIS PEN</option>
		</select></b>
		</td></tr>
		<tr><td width="20%">Keterangan</td><td><b><textarea name="ket" tabindex="10" style="width: 400px" class="form-control" <?php echo ($idp != "") ? "disabled" : ""; ?> ><?php echo $ket; ?></textarea></b></td></tr>
		<tr><td width="20%">File Surat (Scan)</td>
		<td>
		<?php if ($act!="view"  && $act != "kadisp"){ ?>
			<b><input type="file" name="file_attachment" tabindex="11" class="form-control" style="width: 200px"></b>File lama:
		<?php } ?>	
		 <a href="<?php echo base_URL(); ?>upload/surat_masuk/<?php echo $file_attachment; ?>" target='_blank'><?php echo $file_attachment; ?></a></td></tr>

		<?php if ($act=="act_add" || $act=="act_edt") {?>
		<tr><td colspan="2">
		<br><button type="submit" class="btn btn-primary" tabindex="12" ><i class="icon icon-ok icon-white"></i> Simpan</button>
		<a href="<?php echo base_URL(); ?>admin/surat_masuk" class="btn btn-success" tabindex="13" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
		</td></tr>
	<?php } ?>
		</table>	
	</div>

	</div>

	<?php if($this->session->userdata('admin_jabatan') =="4" || $this->session->userdata('admin_jabatan') =="3" || $this->session->userdata('admin_jabatan') =="2" && $act=="kadisp" || $act=="subdisp") { ?>
	<?php if(!empty($tabaksi)){ ?>
	<div class="row-fluid well" style="overflow: hidden">
	<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Disposisi Pushidrosal </span>
		</div>
	</div><!-- /.container -->
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered" id="disp-table" style="text-align:center;">
					<tr>
						<td>No</td>
						<td>Jabatan</td>
						<td>Jenis Aksi</td>
						<td>Aksi</td>
					</tr>
					<?php $a=1; foreach ($tabaksi as $d) {?>
						<tr>
						<td><?php echo $a; ?></td>
						<td><?php echo $d->nama_jabatan; ?></td>
						<td><?php echo $d->jenis; ?></td>
						<td><?php echo $d->nama_aksi; ?></td>
						</tr>
					<?php $a= $a+1; }?>	
				</table>
			
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
		<h3>DISPOSISI / KETERANGAN</h3>
		<b><textarea name="ketdis" id="ketdis" tabindex="10" style="width: 100%;height: 150px" class="form-control" disabled><?php foreach ($tabaksi as $d) { echo $d->keterangan; break; }?></textarea></b>
		</div>
	</div>
	<br>
	
	</div>
	<?php } }?>

	<?php if( $this->session->userdata('admin_jabatan') =="5" && $act=="subdisp") { ?>
	<?php if(!empty($subaksi)){ ?>
	<div class="row-fluid well" style="overflow: hidden">
	<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Disposisi Kadis </span>
		</div>
	</div><!-- /.container -->
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered" id="disp-table" style="text-align:center;">
					<tr>
						<td>No</td>
						<td>Jabatan</td>
						<td>Jenis Aksi</td>
						<td>Aksi</td>
					</tr>
					<?php $a=1; foreach ($subaksi as $d) {?>
						<tr>
						<td><?php echo $a; ?></td>
						<td><?php echo $d->nama_jabatan; ?></td>
						<td><?php echo $d->jenis; ?></td>
						<td><?php echo $d->nama_aksi; ?></td>
						</tr>
					<?php $a= $a+1; }?>	
				</table>
			
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
		<h3>DISPOSISI / KETERANGAN</h3>
		<b><textarea name="ketdis" id="ketdis" tabindex="10" style="width: 100%;height: 150px" class="form-control" disabled><?php foreach ($subaksi as $d) { echo $d->keterangan; break; }?></textarea></b>
		</div>
	</div>
	<br>
	
	</div>
	<?php } }?>


	<?php if ($this->session->userdata('admin_jabatan') =="1" && $act=="view" || $this->session->userdata('admin_jabatan') =="3" || $act=="kadisp"){?>

	<div class="row-fluid well" style="overflow: hidden">
	<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Disposisi</span>
		</div>
	</div><!-- /.container -->
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<div class="col-md-6">
				<table class="table-form">
					<tr>
						<td width="20%">Nama Jabatan</td><td><b>
						<select name="jabatan" tabindex="1" required class="form-control" id="jabatan" style="width: 200px" >
							<option value="none" hidden>Pilih</option>
							<?php
							foreach ($jabatan as $c) {
								echo "<option value='".$c->id."' name='".$c->nama_jabatan."'>".$c->nama_jabatan."</option>";
							}
							?>
						</select>
						</b>
						</td>
					</tr>
					<tr>
						<td width="20%">Jenis Tembusan</td><td><b>
						<select name="tembusan" tabindex="2" required class="form-control" id="tembusan" style="width: 200px" >
							<option value="none" hidden>Pilih</option>
							<option value="AKSI">AKSI</option>
							<option value="INFORMASI">INFORMASI</option>
						</select>
						</b>
						</td>
					</tr>
					<tr>
						<td width="20%">Aksi</td>
						<td>
							<select tabindex="3" required class="form-control" id="aksi" style="width: 200px">
							<option value="none" hidden>Pilih</option>
							<?php
							foreach ($aksi as $c) {
								echo "<option value='".$c->id."' name='".$c->nama_aksi."'>".$c->nama_aksi."</option>";
							}
							?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="text-center" colspan="2"><a class="btn btn-primary btn-sm" tabindex="4" id="tambah_aksi"><i class="icon icon-ok icon-white"></i> Tambah</a></td>
					</tr>
				</table>
			</div>
			<div class="col-md-6">
				<td colspan="4">
				<table class="table table-bordered" id="aksi_table" style="text-align:center;">
					<tr>
						<td>No</td>
						<td>Jabatan</td>
						<td>Jenis Aksi</td>
						<td>Aksi</td>
					</tr>
					
				</table>
			</td>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
		<h3>DISPOSISI / KETERANGAN</h3>
		<b><textarea name="disket" id="disket" tabindex="10" style="width: 100%;height: 150px" class="form-control"></textarea></b>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12 text-right">
			<td class="text-center" colspan="2"><a class="btn btn-primary btn-sm" tabindex="4" id="batal"><i class="icon icon-remove icon-white"></i> BATAL</a></td>
			<td class="text-center" colspan="2"><a class="btn btn-info btn-sm" tabindex="4" id="disposisikan"><i class="icon icon-ok icon-white"></i> DISPOSISI</a></td>
		</div>
	</div>
	</div>
	<?php } ?>
	
	</form>

	<script type="text/javascript">
		$('#tgl_surat').datepicker({ dateFormat: 'dd-mm-yy' }).val();
	</script>

	<script>
			var aksi = [];
			var total = [];
			var count = 1;

			$('#tambah_aksi').click(function(){
				var a = $('#jabatan').val();
				var b = $('#tembusan').val();
				var c = $('#aksi').val();
				var aa = $("#jabatan option:selected").attr("name");
				var cc = $("#aksi option:selected").attr("name");
				if(a!="none" && b!="none" && c!="none"){
					$("#aksi_table").append(	
				"<tr style='vertical-align:top;'>"+
					"<td>"+count+"</td>"+
					"<td>"+aa+"</td>"+
					"<td>"+b+"</td>"+
					"<td>"+cc+"</td>"+
				"</tr>"
				);
					count= count+1;

					aksi.push(a,b,c);
					total.push(aksi);

					aksi = [];
					console.log(total);
				}else{
					alert('Pilih dengan benar');
				}
			});	

			$('#disposisikan').click(function(){
				var id = <?php echo ($idp != "") ? $idp : "0"; ?>;
				var d = $('#disket').val();
				for(a=0;a<total.length;a++){
					total[a].push(d);
				}
				console.log(total);
				console.log(id);
				$.ajax({
					<?php if ($act == "view") {?>
					url: "<?php echo base_URL()?>admin/surat_masuk/disp_proses/",
					<?php }else if($act == "kadisp"){?>
					url: "<?php echo base_URL()?>admin/surat_masuk/kadisp_proses/",
					<?php }?>
					type: 'POST',
					data: {data:total,no:id},
					success: function(msg)
					{
						window.location.assign("<?php echo base_url();?>admin/surat_masuk/");
						console.log("success");
				}
					});	
			});
		</script>