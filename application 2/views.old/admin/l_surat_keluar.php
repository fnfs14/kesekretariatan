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
				<a class="navbar-brand" href="#">Surat Keluar</a>
			</div>
		<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_URL(); ?>admin/surat_keluar/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>admin/surat_keluar/cari">
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
			<th width="">Isi Ringkas, File</th>
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
			<td><?php echo $b->isi."<br><b>File : </b><i><a href='".base_URL()."upload/surat_keluar/".$b->file_attachment."' target='_blank'>".$b->file_attachment."</a>"?></td>
			<td><?php echo $b->kepada?></td>
			<td><?php echo $b->no_surat."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"?></td>
			<td><?php 
				if($b->status_surat_keluar == 0 or $b->status_surat_keluar == 3){
					echo "SUBDIS";
				}elseif($b->status_surat_keluar == 1){
					echo "KADIS";
				}elseif($b->status_surat_keluar == 2){
					echo "KAPUSHIDROSAL";
				}elseif($b->status_surat_keluar == 4 or $b->status_surat_keluar == 5){
					echo "SETUM";
				}
			?></td>
			<td class="ctr">
				<?php  
				if ($b->create_by == $this->session->userdata('admin_id')) {
					if ($b->status_surat_keluar == 0 or $b->status_surat_keluar == 3) {
				?>
						<div class="btn-group">
							<a href="<?php echo base_URL()?>admin/surat_keluar/edt/<?php echo $b->id?>" class="btn btn-success btn-sm">Edit</a>
							<a href="<?php echo base_URL()?>admin/surat_keluar/kirim_kelain/<?php echo $b->id?>" class="btn btn-primary btn-sm"> Kirim</a>
						</div>	
				<?php 
					}else if($b->status_surat_keluar == 1 or $b->status_surat_keluar == 2 or $b->status_surat_keluar == 4 or $b->status_surat_keluar == 5){ ?>
					<div class="label label-danger">Diproses</div>
				<?php
					} 
				} else {
					// var_dump($b);/*
					if ($b->status_surat_keluar == 0) {
						if ($data_user->jabatan==1 or $data_user->jabatan==2 or $data_user->tingkatan==1) {
							echo '<div class="label label-danger">Diproses</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_surat_keluar == 1) {
						if ($data_user->jabatan==1 or $data_user->jabatan==2) {
							echo '<div class="label label-danger">Diproses</div>';
						}else if ($data_user->tingkatan==1) {
							echo '<div class="btn-group">
										<a href="'.base_URL().'admin/surat_keluar/verifikasi_surat_keluar/'.$b->id .'" class="btn btn-success btn-sm"> verifikasi</a>
									</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_surat_keluar == 2) {
						if ($data_user->jabatan==1) {
							echo '<div class="btn-group">
										<a href="'.base_URL().'admin/surat_keluar/verifikasi_surat_keluar/'.$b->id .'" class="btn btn-success btn-sm"> verifikasi</a>
									</div>';
						}else if ($data_user->tingkatan==1 or $data_user->jabatan==2) {
							echo '<div class="label label-danger">Diproses</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_surat_keluar == 3) {
						if ($data_user->tingkatan==1 or $data_user->jabatan==1 or $data_user->jabatan==2) {
							echo '<div class="label label-danger">Diproses</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_surat_keluar == 4) {
						if ($data_user->jabatan==2) {
							echo '<div class="btn-group">
										<a href="'.base_URL().'admin/surat_keluar/verifikasi_surat_keluar/'.$b->id .'" class="btn btn-success btn-sm"> Proses</a>
									</div>';										   
						}else if ($data_user->tingkatan==1 or $data_user->jabatan==1) {
							echo '<div class="label label-danger">Diproses</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_surat_keluar == 5) {
						if ($data_user->jabatan==2) {
							echo '<div class="btn-group">
										<a href="'.base_URL().'admin/surat_keluar/cetak_surat_keluar/'.$b->id .'" class="btn btn-success btn-sm"> Cetak</a>
									</div>';
						}else if ($data_user->tingkatan==1 or $data_user->jabatan==1) {
							echo '<div class="label label-danger">Diproses</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}
					//*/
				} ?>
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
