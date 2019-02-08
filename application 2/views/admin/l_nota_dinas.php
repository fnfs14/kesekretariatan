<div class="clearfix">
<div class="row">
  <div class="col-lg-12">
  <!-- breadcrumb -->
	<ol class="breadcrumb breadcrumb-arrow">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li class="active"><span>Nota Dinas</span></li>
	</ol>
	<!-- End Breadcrumb -->

	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Nota Dinas</a>
			</div>
		<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">

			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_URL(); ?>admin/nota_dinas/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
				<?php
				if($this->session->userdata('admin_jabatan') == 1){ ?>
				<li><a href="<?php echo base_URL(); ?>admin/nota_dinas/getDetailSendiri" class="btn-info"><i class=""> </i> List Permohonan Kapus</a></li>
				<?php } elseif($this->session->userdata('admin_jabatan') == 28) { ?>
				<li><a href="<?php echo base_URL(); ?>admin/nota_dinas/getDetailSendiri" class="btn-info"><i class=""> </i> List Permohonan Wakapus</a></li>
				<?php } else {} ?>


			</ul>
			<?php
$total_row = 0;
			?>
			<ul class="nav navbar-nav navbar-right">
				<div class="navbar-form navbar-left">
					<input id="searchbox" type="text" class="form-control" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required>
					<!-- <button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button> -->
				</div>
			</ul>
		</div><!-- /.nav-collapse -->
		</div><!-- /.container -->
	</div><!-- /.navbar -->

  </div>
</div>

<?php echo $this->session->flashdata("k");?>

<?php if($this->session->userdata('admin_satuan') == 6){
	$req = (isset($_GET['r']))?$_GET['r']:1;
	$activeClass = 'class="active"';
	?>
	<ul class="nav nav-pills">
	  <li <?= ($req==1)?$activeClass:''; ?>><a href="<?php echo base_URL(); ?>admin/nota_dinas?r=1">Setum</a></li>
	  <li <?= ($req==2)?$activeClass:''; ?>><a href="<?php echo base_URL(); ?>admin/nota_dinas?r=2">Permohonan Satker</a></li>
	  <li <?= ($req==3)?$activeClass:''; ?>><a href="<?php echo base_URL(); ?>admin/nota_dinas?r=3">Permohonan Kapus/Wakapus</a></li>
	</ul>

<?php } ?>
</div>
<div class="tab-content">
<div id="home" class="tab-pane fade in active">
	<br>
	<table class="table table-bordered table-hover" id="zame">
		<thead>
			<tr>
				<th width="">No. Agd/Tgl.SETUM</th>
				<th width="">Perihal, File</th>
				<th width="">Asal Surat</th>
				<th width="">Nomor, Tgl. Surat</th>
				<th width="">Status</th>
				<th width="">Aksi</th>
			</tr>
			<?php $array_id = []; ?>
		</thead>

		<tbody>
			<?php
			if (empty($data)) {
				echo "<tr><td colspan='6'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
			} else { 
				foreach ($data as $b) {
			?>
				<tr>
					<td><?php echo $b->no_agenda."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"; ?></td>
					<td><?php echo $b->perihal."<br><b>File : </b><i><a href='".base_URL()."upload/nota_dinas/".$b->file_attachment."' target='_blank'>".$b->file_attachment."</a>"?></td>
					<td><?php echo $b->nama_lengkap;?></td>
					<td><?php echo $b->no_surat."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"?></td>
					<td><?php
						if($b->status_notadinas==4){
							echo "Diterima tujuan surat";
						}elseif($b->status_notadinas==5){
							echo "Selesai";
						}
					?>
					</td>
					<td>
						<?php
						$tembusan = $this->db->query("SELECT * FROM notadinas.tembusan_nota_dinas WHERE id_jabatan = " . $this->session->userdata('admin_jabatan') . " AND id_notadinas = $b->id")->row();
						$urlZ = "";
						if($this->session->userdata('admin_jabatan')==$b->kepada){ // kepada
							if($b->opened==100 and $b->status_tujuan == 0){
								$urlZ = "/kepada";
							}
						}elseif($tembusan!=NULL and $this->session->userdata('admin_jabatan')==$tembusan->id_jabatan){
							$urlZ = "/tembusan";
						}elseif($this->session->userdata('admin_jabatan')==1){ // kapushidrosal
							if(strpos($b->ka_waka_setum, '1') !== false){ // ka-waka-setum
								$urlZ = "/kapush";
							}
						}elseif($this->session->userdata('admin_satuan')==6){ // setum
							if(strpos($b->ka_waka_setum, '2') !== false){ // ka-waka-setum
								$urlZ = "/setum";
							}
						}elseif($this->session->userdata('admin_jabatan')==28){ // setum
							if(strpos($b->ka_waka_setum, '3') !== false){ // ka-waka-setum
								$urlZ = "/waka";
							}
						}
						if($b->status_notadinas==5){
							echo '<a href="'.base_URL().'admin/cetak_nota_dinas/'.$b->id.'" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
						}
						?>
						<a href="<?php echo base_URL()?>admin/nota_dinas/verifikasi_nota_dinas/<?php echo $b->id.$urlZ;?>"
						type="button" class="btn btn-warning btn-sm" title="Lihat">Lihat
							<?php
							$feedbacksetum = $this->db->query("SELECT * FROM notadinas.feedback_nota_dinas WHERE notadinas.feedback_nota_dinas.baca IS NULL AND  notadinas.feedback_nota_dinas.id_nota_dinas = '".$b->id."' AND notadinas.feedback_nota_dinas.penerima = '".$this->session->userdata('admin_jabatan')."'")->result();
							$nil = count($feedbacksetum);
							if($nil != 0){
								echo '<sup class="label label-danger">';
								foreach ($feedbacksetum as $key) {
									if($key->pengirim != $this->session->userdata('admin_jabatan')){
										echo $nil;
										break;
									}
								}
								echo '</sup>';
							}?>
						</a>
					</td>
				</tr>
			<?php
				}
			}
			?>
		</tbody>
	</table>
</div>
</div>
<?php //$pagi  = _page($total_row, 10, 4, base_url()."admin/nota_dinas/p"); ?>
<!-- <center><ul class="pagination"><?php echo $pagi; ?></ul></center> -->

<script>
  $(window).load(function(){
    $('#zame').DataTable({
    	"searching": true,
    	 "bLengthChange" : false,
    	"bInfo":false,
    	"aaSorting" : [[0,'desc']]//ubah ini
    });
} );

 $(window).load(function(){
    var dataTable = $('#zame').dataTable();
    $("#searchbox").keyup(function() {
        dataTable.fnFilter(this.value);
    });
});
</script>
