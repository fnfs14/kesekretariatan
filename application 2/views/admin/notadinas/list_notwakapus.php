<div class="clearfix">
<div class="row">
  <div class="col-lg-12">
  <!-- breadcrumb -->
	<ol class="breadcrumb breadcrumb-arrow">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li class="active"><span>Nota Dinas</span></li>
		<li class="active"><span>Review</span></li>
	</ol>
	<!-- End Breadcrumb -->
	
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo base_URL(); ?>admin/nota_dinas">Nota Dinas</a>
			</div>
		<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
			<?php 
			if($this->session->userdata('admin_jabatan') == 3){
			?>
			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_URL(); ?>admin/nota_dinas/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
			</ul>
			<?php
			}
			else{
			}
			?>
			<ul class="nav navbar-nav navbar-right">
				<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>admin/nota_dinas/cari">
					<input type="text" class="form-control" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required>
					<button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button>
				</form>
			</ul>
		</div><!-- /.nav-collapse -->
		</div><!-- /.container -->
	</div><!-- /.navbar -->

  </div>
</div>
<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">List Nota Dinas</span>
		</div>
	</div><!-- /.container -->
</div>
<div class="row-fluid well" style="overflow: hidden">
	<div class="col-lg-12">
		<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th width="">No. Agd/Tgl.SETUM</th>
			<th width="">Isi Ringkas, File</th>
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
			<td><?php echo $b->id."/".$b->tgl_surat;?></td>
			<td><?php echo $b->perihal."<br><b>File : </b><i><a href='".base_URL()."upload/nota_dinas/".$b->file_attachment."' target='_blank'>".$b->file_attachment."</a>"?></td>
			<td><?php echo $b->nama_lengkap;?></td>
			<td><?php echo $b->no_surat."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"?></td>
			<td><?php


						if($b->status_notadinas==1){
							echo "Nota Dinas Baru";
						}elseif($b->status_notadinas==0){
							echo "Diterima subdis";
						}elseif($b->status_notadinas==4){
							if($b->opened==100){
							echo "SELESAI";	
							}else{
							echo "Diterima";
								foreach ($status_kadis as $c) {
									if($c->id_nota == $b->id){
									echo " $c->nama_kadis,";
									}
								}
								foreach ($status_tembus as $d) {
									if($d->id_tembus == $b->id){
									echo " $d->nama_kadis,";
									}
								}
							}
						}if($b->status_notadinas == 5){
							echo "SELESAI";
					 	}
			?>

			</td>
			<td class="ctr">
					<?php if($b->status_notadinas == 1){?>
						<a href="<?php echo base_URL()?>admin/nota_dinas/del/<?php echo $b->id?>" class="btn btn-danger btn-sm"></i> Hapus</a>

						<a href="<?php echo base_URL()?>admin/nota_dinas/edt/<?php echo $b->id?>" class="btn btn-success btn-sm"></i> Edit</a>

						<a href="<?php echo base_URL()?>admin/nota_dinas/kirim_kelain/<?php echo $b->id?>" class="btn btn-primary btn-sm"> Kirim</a>


					<?php }else{ ?>

						<a href="<?php echo base_URL()?>admin/nota_dinas/verifikasi_nota_dinas/<?php echo $b->id?>" class="btn btn-warning btn-sm">Lihat</a>

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
<center><ul class="pagination"><?php echo $pagi; ?></ul></center>
</div>
