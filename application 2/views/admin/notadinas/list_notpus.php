<div class="clearfix">
<div class="row">
  <div class="col-lg-12">
  <!-- breadcrumb -->
	<ol class="breadcrumb breadcrumb-arrow">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li class=""><span>Nota Dinas </span></li>
		<li class="active"><span>List Permohonan 
			<?php if($this->session->userdata('admin_jabatan') == 1){ ?>
					Kapus
					<?php }elseif($this->session->userdata('admin_jabatan') == 28){ ?>
					Wakapus
				<?php }?>
				</a></li>
				</span></li>
	</ol>
	<!-- End Breadcrumb -->

	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo base_URL(); ?>admin/nota_dinas">Nota Dinas</a>
			</div>
		<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">

			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_URL(); ?>admin/nota_dinas/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
				<?php
				if($this->session->userdata('admin_jabatan') == 1){ ?>
				<li><a href="<?php echo base_URL(); ?>admin/nota_dinas/getDetailSendiri" class="btn-info active"><i class=""> </i> List Permohonan Kapus</a></li>
				<?php } elseif($this->session->userdata('admin_jabatan') == 28) { ?>
				<li><a href="<?php echo base_URL(); ?>admin/nota_dinas/getDetailSendiri" class="btn-info active"><i class=""> </i> List Permohonan Wakapus</a></li>
				<?php } else {} ?>


			</ul>
			<?php
$total_row = 0;
			?>
			<ul class="nav navbar-nav navbar-right">
				<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>admin/nota_dinas/cari">
					<input id="searchbox" type="text" class="form-control" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required>
					<!-- <button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button> -->
				</form>
			</ul>
		</div><!-- /.nav-collapse -->
		</div><!-- /.container -->
	</div><!-- /.navbar -->

  </div>
</div>

	<div class="dataTables_wrapper no-footer">
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
	</thead>
	
	<tbody>
		<?php 		
			foreach ($keg_nota as $b) {
		?>
		<tr>
			<td><?php echo $b->no_agenda."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"; ?></td>
			<td><?php echo $b->perihal."<br><b>File : </b><i><a href='".base_URL()."upload/nota_dinas/".$b->file_attachment."' target='_blank'>".$b->file_attachment."</a>"?></td>
			<td><?php echo $b->nama_lengkap;?></td>
			<td><?php echo $b->no_surat."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"?></td>
			<td>
				<?php
						if($b->status_notadinas==1){
							echo "Nota Dinas Baru";
						}elseif($b->status_notadinas==0){
							echo "Diterima subdis";
						}elseif($b->status_notadinas==4){
							echo "Diterima tujuan surat";
						}elseif($b->status_notadinas==5){
							echo "Terkirim";
						}
					?>
			</td>
			<td class="ctr">
					<?php if($b->status_notadinas == 1){?>
						<a href="<?php echo base_URL()?>admin/nota_dinas/del/<?php echo $b->id?>" class="btn btn-danger btn-sm"></i> Hapus</a>

						<a href="<?php echo base_URL()?>admin/nota_dinas/edt/<?php echo $b->id?>" class="btn btn-success btn-sm"></i> Edit</a>

						<a href="<?php echo base_URL()?>admin/nota_dinas/kirim_kelain/<?php echo $b->id?>" class="btn btn-primary btn-sm"> Kirim</a>


					<?php }else{ 

						if($b->status_notadinas==5){
							echo '<a href="'.base_URL().'admin/cetak_nota_dinas/'.$b->id.'" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
						}
						
						?>
						<a href="<?php echo base_URL()?>admin/nota_dinas/verifikasi_nota_dinas/<?php echo $b->id?>/kapush" class="btn btn-success btn-sm">Lihat</a>

					<?php } ?>
			</td>
		</tr>
		<?php 
			}
		?>
	</tbody>
</table>
	</div>
</div>



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
