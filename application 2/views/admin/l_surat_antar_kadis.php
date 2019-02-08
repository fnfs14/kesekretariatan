<div class="clearfix">
<div class="row">
  <div class="col-lg-12">
  <!-- breadcrumb -->
	<ol class="breadcrumb breadcrumb-arrow">
		<li><a href="#"><i class="fa fa-home"></i></a></li>
		<li class="active"><span>Surat Keluar</span></li>
	</ol>
	<!-- End Breadcrumb -->
	
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Surat Antar Kadis</a>
			</div>
		<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
			<ul class="nav navbar-nav">
			<?php if($this->session->userdata('admin_tingkatan') == 1){ ?>	
				<li><a href="<?php echo base_URL(); ?>admin/surat_antar_kadis/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
			<?php } ?>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>admin/surat_antar_kadis/cari">
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
	

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th width="">No. Agd/Kode</th>
			<th width="">Perihal, File</th>
			<th width="">Tujuan Surat</th>
			<th width="">Nomor, Tgl. Surat</th>
			<th width="">Status</th>
			<th width="">Aksi</th>
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
			<td><?php echo $b->id."/".$b->id;?></td>
			<td><?php echo $b->perihal."<br><b>Dokumen : </b><i><a href='".base_URL()."upload/surat_antar_kadis/".$b->file_attachment."' target='_blank'>".$b->file_attachment."</a>"?></td><!--ubah mei bahasa-->
			<td><?php echo $b->kepadanya?></td>
			<td><?php echo $b->no_surat."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"?></td>
			<td><?php 
				if($b->status_surat_antar_kadis == 0){
					echo "Surat Baru";
				}else if($b->status_surat_antar_kadis == 1){
					echo "Verifikasi Kadis";
				}else if($b->status_surat_antar_kadis == 2){
					echo "Koreksi";
				}else if($b->status_surat_antar_kadis == 3){
					echo "Selesai";
				}
			?></td>
			<td class="ctr"><div class="btn-group">
				<?php  
				if ($b->create_by == $this->session->userdata('admin_id')) {
					if ($b->status_surat_antar_kadis == 0 or $b->status_surat_antar_kadis == 2) {
				?>
						
							<a href="<?= base_URL(); ?>admin/surat_antar_kadis/show/<?= $b->id; ?>" class="btn btn-default btn-sm">Tampil</a>
							<a href="<?php echo base_URL()?>admin/surat_antar_kadis/edt/<?php echo $b->id?>" class="btn btn-success btn-sm">Edit</a>
							<a href="<?php echo base_URL()?>admin/surat_antar_kadis/kirim_kelain/<?php echo $b->id?>" class="btn btn-primary btn-sm"> Kirim</a>
				<?php 
					}else if($b->status_surat_antar_kadis == 3){ 
						echo '<a href="#noaction" class="btn btn-danger btn-sm">Selesai</a>';
					}else{
						echo '<a href="#diproses" class="btn btn-danger btn-sm">Diproses</a>';
					} 
				} else {
					// var_dump($b);/*
					if ($b->status_surat_antar_kadis == 0) {
						echo '<a href="#noaction" class="btn btn-danger btn-sm">No Action</a>';
					}else if ($b->status_surat_antar_kadis == 1) {
						if($this->session->userdata('admin_jabatan')==$b->kepada){?>
							<a href="<?= base_URL(); ?>admin/surat_antar_kadis/show/<?= $b->id; ?>" class="btn btn-default btn-sm">Tampil</a>
							<a href="<?= base_URL(); ?>admin/surat_antar_kadis/verifikasi_surat_antar_kadis/<?= $b->id; ?>" class="btn btn-info btn-sm">Verifikasi</a><?php
						}else if(isset($tembusan[$this->session->userdata('admin_jabatan')][$b->id]) AND $this->session->userdata('admin_tingkatan')==1){ ?>
							<a href="<?= base_URL(); ?>admin/surat_antar_kadis/show/<?= $b->id; ?>" class="btn btn-info btn-sm">Tampil</a><?php
						}else{
							echo '<a href="#noaction" class="btn btn-danger btn-sm">No Action</a>';
						}
					}else if ($b->status_surat_antar_kadis == 3) {
						if(isset($tembusan[$this->session->userdata('admin_jabatan')][$b->id]) AND $this->session->userdata('admin_tingkatan')==2){ ?>
							<a href="<?= base_URL(); ?>admin/surat_antar_kadis/show/<?= $b->id; ?>" class="btn btn-info btn-sm">Tampil</a><?php
							echo '<a href="'. base_URL() .'admin/cetak_surat_antar_kadis/'.$b->id.'" class="btn btn-success btn-sm" target="_blank">Cetak</a>';
						}else{
							echo '<a href="#noaction" class="btn btn-danger btn-sm">Selesai</a>';
						}
					}
					//*/
				} ?>
				</div>
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
