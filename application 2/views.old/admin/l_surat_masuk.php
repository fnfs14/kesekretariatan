<div class="clearfix">
<div class="row">
  <div class="col-lg-12">	
	
	<!-- breadcrumb -->
	<ol class="breadcrumb breadcrumb-arrow">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li class="active"><span>Surat Masuk</span></li>
	</ol>
	<!-- End Breadcrumb -->

	<div class="navbar navbar-inverse">
		<div class="container">		
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Surat Masuk</a>
			</div>
			<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
				<ul class="nav navbar-nav">
					<?php
					if ($this->session->userdata('admin_jabatan') == 2) {
					?>
					<li><a href="<?php echo base_URL(); ?>admin/surat_masuk/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
					<?php }?>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>admin/surat_masuk/cari">
						<input type="text" class="form-control" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required>
						<button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button>
					</form>
				</ul>
			</div><!-- /.nav-collapse -->
		</div><!-- /.container -->
	</div><!-- /.navbar -->

  </div>
</div>

<?php echo $this->session->flashdata("k");?>
	
<!--	
<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Well done!</strong> You successfully read <a href="http://bootswatch.com/amelia/#" class="alert-link">this important alert message</a>.
</div>
	
<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Oh snap!</strong> <a href="http://bootswatch.com/amelia/#" class="alert-link">Change a few things up</a> and try submitting again.
</div>	
-->

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th width="10%">No. Agd/Kode</th>
			<th width="27%">Isi Ringkas, File</th>
			<th width="25%">Asal Surat</th>
			<th width="15%">Nomor, Tgl. Surat</th>
			<th width="15%">Status</th>
			<th width="23%">Aksi</th>
		</tr>
	</thead>
	
	<tbody>
		<?php 
		if (empty($data)) {
			echo "<tr><td colspan='5'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
		} else {
			$no 	= ($this->uri->segment(4) + 1);
			foreach ($data as $b) {
		?>
		<tr>
			<td><?php echo $b->no_setum."</br>".tgl_jam_sql($b->tgl_setum);?></td>
			<td><?php echo $b->perihal."<br><b>File : </b><i><a href='".base_URL()."upload/surat_masuk/".$b->file_attachment."' target='_blank'>".$b->file_attachment."</a>"?></td>
			<td><?php echo $b->instansi; ?></td>
			<td><?php echo $b->no_surat."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"?></td>
			<td>
				<?php if($b->status_surat_masuk == 1){
					echo "SETUM";
				}elseif ($b->status_surat_masuk == 2) {
					echo "KAPUSHIDROS";
				}elseif ($b->status_surat_masuk == 3){
					echo "KADIS";
				}else{
					echo "KASUBDIS PEN";
				}

				 ?>
				
			</td>
			
			<td class="ctr">
				<?php  
				if ($this->session->userdata('admin_jabatan') == 2) {
				?>

				<?php if($b->status_surat_masuk != 1){ ?>
				Terkirim.
				<?php }else{?>
				<div class="btn-group">
					<a href="<?php echo base_URL()?>admin/surat_masuk/kirim/<?php echo $b->id?>/<?php echo $b->kepada?>" class="btn btn-info btn-sm" title="Kirim" onclick="return confirm('Kirimkan surat?')" ><i class="icon-print icon-white"> </i>Kirim</a>
				</div>	
				<?php }?>
				<?php 
				}else if ($this->session->userdata('admin_jabatan') == 1) {
				?>
				<?php if($b->status_surat_masuk != 2){ ?>
				Terkirim.
				<?php }else{ ?>
				<div class="btn-group">
					<a href="<?php echo base_URL()?>admin/surat_masuk/disp/<?php echo $b->id?>" class="btn btn-warning btn-sm" title="Lihat"><i class="icon-print icon-white"> </i>Lihat</a>
				</div>
				<?php }?>
				<?php 
				}else if ($this->session->userdata('admin_jabatan') == 3) {?>
				<?php if($b->status_surat_masuk != 3){ ?>
				Terkirim.
				<?php }else{ ?>
				<div class="btn-group">
					<a href="<?php echo base_URL()?>admin/surat_masuk/kadisp/<?php echo $b->id?>" class="btn btn-warning btn-sm" title="Disposisi"><i class="icon-print icon-white"> </i>Disposisi</a>
				</div>
				<?php }?>
				<?php 
				}else if ($this->session->userdata('admin_jabatan') == 5) {
				?>
				<div class="btn-group">
					<a href="<?php echo base_URL()?>admin/surat_masuk/subdisp/<?php echo $b->id?>" class="btn btn-warning btn-sm" title="Lihat"><i class="icon-print icon-white"> </i>Lihat</a>
				</div>
				<?php } ?>
				
			</td>
		</tr>
		<?php 
			$no++;
			}
		}
		?>
	</tbody>
</table>
<center><ul class="pagination"><?php echo $pagi; ?></ul></center>
</div>
