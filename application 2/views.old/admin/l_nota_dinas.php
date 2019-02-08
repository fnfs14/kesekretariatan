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

<?php echo $this->session->flashdata("k");?>
	

<table class="table table-bordered table-hover">
	<thead>
		<?php 
		if($this->session->userdata('admin_jabatan') == 1){ ?>
		<tr>	
			<th width="">No</th>
			<th width="">Kegiatan Dinas</th>
			<th width="">Aksi</th>
		</tr>
		<?php 
		}else{ ?>
		<tr>
			<th width="">No. Agd/Tgl.SETUM</th>
			<th width="">Isi Ringkas, File</th>
			<th width="">Asal Surat</th>
			<th width="">Nomor, Tgl. Surat</th>
			<th width="">Status</th>
			<th width="">Aksi</th>
		</tr>
		<?php } ?>
	</thead>
	
	<tbody>
		<?php 
		if (empty($data)) {
			echo "<tr><td colspan='5'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
		} else {
			$no 	= ($this->uri->segment(4) + 1);
			if($this->session->userdata('admin_jabatan') == 2){
			foreach ($data as $b) {
				if(($b->status_notadinas == 4 || $b->status_notadinas == 5 || $b->jabatan_id == 2)){
		?>
		<tr>
			<td><?php echo $b->id."/".$b->tgl_surat;?></td>
			<td><?php echo $b->isi."<br><b>File : </b><i><a href='".base_URL()."upload/nota_dinas/".$b->file_attachment."' target='_blank'>".$b->file_attachment."</a>"?></td>
			<td><?php echo $b->nama_lengkap;?></td>
			<td><?php echo $b->no_surat."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"?></td>
			<td><?php 
				if($b->status_notadinas == 1){
					echo "KADIS";
				}elseif($b->status_notadinas == 2 && $b->jabatan_id == 2){
					echo "TEMBUSAN";
				}elseif($b->status_notadinas == 4 or $b->status_notadinas == 5){
					echo "SETUM";
				}
			?>
			</td>
			<td class="ctr">
				<?php  
				if ($b->create_by == $this->session->userdata('admin_id')) {
					if ($b->status_notadinas == 1) {
				?>
						<div class="btn-group">
							<a href="<?php echo base_URL()?>admin/nota_dinas/edt/<?php echo $b->id?>" class="btn btn-success btn-sm">Edit</a>
							<a href="<?php echo base_URL()?>admin/nota_dinas/kirim_kelain/<?php echo $b->id?>" class="btn btn-primary btn-sm"> Kirim</a>
						</div>	
				<?php
				}else if($b->status_notadinas == 2){ ?>
					<a href="<?php echo base_URL()?>admin/nota_dinas/edt/<?php echo $b->id?>" class="btn btn-success btn-sm">Lihat</a>
				<?php 
					}else if($b->status_notadinas == 0 or $b->status_notadinas == 3 or $b->status_notadinas == 4 or $b->status_notadinas == 5){ ?>
					<div class="label label-danger">Diproses</div>
				<?php
					} 
				} else {
					// var_dump($b);/*
					if ($b->status_notadinas == 1) {
						if ($data_user->jabatan==1 or $data_user->jabatan==2 or $data_user->tingkatan==1) {
							echo '<div class="label label-danger">Diproses</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_notadinas == 0 or $b->status_notadinas == 3) {
						if ($data_user->jabatan==1 or $data_user->jabatan==2) {
							echo '<div class="label label-danger">Diproses</div>';
						}else if ($data_user->tingkatan==1) {
							echo '<div class="btn-group">
										<a href="'.base_URL().'admin/nota_dinas/verifikasi_nota_dinas/'.$b->id .'" class="btn btn-default btn-sm"> Lihat</a>
									</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_notadinas == 2) {
						if ($data_user->jabatan==1) {
							echo '<div class="btn-group">
										<a href="'.base_URL().'admin/nota_dinas/verifikasi_nota_dinas/'.$b->id .'" class="btn btn-success btn-sm"> verifikasi</a>
									</div>';
						}else if ($data_user->tingkatan==1 or $data_user->jabatan==2) {
							echo '<a href="'.base_URL().'admin/nota_dinas/edt/'.$b->id .'" class="btn btn-success btn-sm">Lihat</a>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_notadinas == 4) {
						if ($data_user->jabatan==2) {
							echo '<div class="btn-group">
										<a href="'.base_URL().'admin/nota_dinas/verifikasi_nota_dinas/'.$b->id .'" class="btn btn-success btn-sm"> Proses</a>
									</div>';										   
						}else if ($data_user->tingkatan==1 or $data_user->jabatan==1) {
							echo '<div class="label label-danger">Diproses</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_notadinas == 5) {
						if ($data_user->jabatan==2) {
							echo '<div class="btn-group">
										<a href="'.base_URL().'admin/nota_dinas/cetak_nota_dinas/'.$b->id .'" class="btn btn-success btn-sm"> Cetak</a>
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
			}
		else if($this->session->userdata('admin_jabatan') == 3){
			foreach ($data as $b) {
		?>
		<tr>
			<td><?php echo $b->id."/".$b->tgl_surat;?></td>
			<td><?php echo $b->isi."<br><b>File : </b><i><a href='".base_URL()."upload/nota_dinas/".$b->file_attachment."' target='_blank'>".$b->file_attachment."</a>"?></td>
			<td><?php echo $b->nama_lengkap; ?></td>
			<td><?php echo $b->no_surat."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"?></td>
			<td><?php 
				if($b->status_notadinas == 1){
					echo "KADIS";
				}elseif($b->status_notadinas == 2){
					if($b->jabatan_id==3){
						echo "TEMBUSAN";
					}else{
					echo "KAPUSHIDROSAL";
					}
				}elseif($b->status_notadinas == 4 or $b->status_notadinas == 5){
					echo "SETUM";
				}
				
			?>
			
			</td>
			<td class="ctr">
				<?php  
				if ($b->create_by == $this->session->userdata('admin_id')) {
					if ($b->status_notadinas == 1) {
				?>
						<div class="btn-group">
							<a href="<?php echo base_URL()?>admin/nota_dinas/edt/<?php echo $b->id?>" class="btn btn-success btn-sm">Edit</a>
							<a href="<?php echo base_URL()?>admin/nota_dinas/kirim_kelain/<?php echo $b->id?>" class="btn btn-primary btn-sm"> Kirim</a>
						</div>	
				<?php 
					}else if($b->status_notadinas == 2){
						if($b->jabatan_id == 3){?>
						<a href="<?php echo base_URL()?>admin/nota_dinas/verifikasi_nota_dinas/<?php echo $b->id?>" class="btn btn-success btn-sm">Lihat</a>
				<?php
						}else{	
				?>
					<div class="label label-danger">Diproses</div>
				<?php
					}
					}else if($b->status_notadinas == 0 or $b->status_notadinas == 3){ ?>
						<div class="label label-danger">Diproses</div>
				<?php
					}else if($b->status_notadinas == 4 or $b->status_notadinas == 5){
						if($b->no_surat != null){?>
					<a href="<?php echo base_URL()?>admin/nota_dinas/verifikasi_nota_dinas/<?php echo $b->id?>" class="btn btn-success btn-sm">Lihat</a>
					<a href="<?php echo base_URL()?>admin/nota_dinas/cetak_nota_dinas/<?php echo $b->id ?>" class="btn btn-success btn-sm"> Cetak</a>
				<?php
						}else{ ?>
							<div class="label label-danger">Diproses</div>
				<?php
						}
					}
				} else {
					// var_dump($b);/*
					if ($b->status_notadinas == 1) {
						if ($data_user->jabatan==1 or $data_user->jabatan==2 or $data_user->tingkatan==1) {
							echo '<div class="label label-danger">Diproses</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_notadinas == 0 or $b->status_notadinas == 3) {
						if ($data_user->jabatan==1 or $data_user->jabatan==2) {
							echo '<div class="label label-danger">Diproses</div>';
						}else if ($data_user->tingkatan==1) {
							echo '<div class="btn-group">
										<a href="'.base_URL().'admin/nota_dinas/verifikasi_nota_dinas/'.$b->id .'" class="btn btn-default btn-sm"> Lihat</a>
									</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_notadinas == 2) {
						if ($data_user->jabatan==1) {
							echo '<div class="btn-group">
										<a href="'.base_URL().'admin/nota_dinas/verifikasi_nota_dinas/'.$b->id .'" class="btn btn-success btn-sm"> verifikasi</a>
									</div>';
						}else if ($data_user->tingkatan==1 or $data_user->jabatan==2) {
							echo '<div class="label label-danger">Diproses</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_notadinas == 4) {
						if ($data_user->jabatan==2) {
							echo '<div class="btn-group">
										<a href="'.base_URL().'admin/nota_dinas/verifikasi_nota_dinas/'.$b->id .'" class="btn btn-success btn-sm"> Proses</a>
									</div>';										   
						}else if ($data_user->tingkatan==1 or $data_user->jabatan==1) {
							echo '<div class="label label-danger">Diproses</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_notadinas == 5) {
						if ($data_user->jabatan==2) {
							echo '<div class="btn-group">
										<a href="'.base_URL().'admin/nota_dinas/cetak_nota_dinas/'.$b->id .'" class="btn btn-success btn-sm"> Cetak</a>
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
		else if($this->session->userdata('admin_jabatan') == 1){
			foreach ($keg as $b) {
		?>
		<tr>
			<td><?php echo $b->id_kegiatan;?></td>
			<td><?php echo $b->nama_kegiatan;?></td>
			<td class="ctr">
				<div class="btn-group">
					<a href="<?php echo base_URL()?>admin/nota_dinas/getDetailKegiatan/<?php echo $b->id_kegiatan?>" class="btn btn-default btn-sm"> Verifikasi</a>
				</div>
			</td>
		</tr>
		<?php 
			$no++;
			}
			}
		else if($this->session->userdata('admin_jabatan') == 5){
			foreach ($data as $b) {
				if(($b->status_notadinas == 0 || $b->status_notadinas == 3 )){
		?>
		<tr>
			<td><?php echo $b->id."/".$b->tgl_surat;?></td>
			<td><?php echo $b->isi."<br><b>File : </b><i><a href='".base_URL()."upload/nota_dinas/".$b->file_attachment."' target='_blank'>".$b->file_attachment."</a>"?></td>
			<td><?php echo $b->nama_lengkap;?></td>
			<td><?php echo $b->no_surat."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"?></td>
			<td><?php 
				if($b->status_notadinas == 1){
					echo "KADIS";
				}elseif($b->status_notadinas == 2){
					echo "KAPUSHIDROSAL";
				}elseif($b->status_notadinas == 4 or $b->status_notadinas == 5){
					echo "SETUM";
				}
				
			?>
			
			</td>
			<td class="ctr">
				<?php  
				if ($b->create_by == $this->session->userdata('admin_id')) {
					if ($b->status_notadinas == 1) {
				?>
						<div class="btn-group">
							<a href="<?php echo base_URL()?>admin/nota_dinas/edt/<?php echo $b->id?>" class="btn btn-success btn-sm">Edit</a>
							<a href="<?php echo base_URL()?>admin/nota_dinas/kirim_kelain/<?php echo $b->id?>" class="btn btn-primary btn-sm"> Kirim</a>
						</div>	
				<?php 
					}else if($b->status_notadinas == 0 or $b->status_notadinas == 2 or $b->status_notadinas == 3 or $b->status_notadinas == 4 or $b->status_notadinas == 5){ ?>
					<div class="label label-danger">Diproses</div>
				<?php
					} 
				} else {
					// var_dump($b);/*
					if ($b->status_notadinas == 1) {
						if ($data_user->jabatan==1 or $data_user->jabatan==2 or $data_user->tingkatan==1) {
							echo '<div class="label label-danger">Diproses</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_notadinas == 0 or $b->status_notadinas == 3) {
						if ($data_user->jabatan==1 or $data_user->jabatan==2) {
							echo '<div class="label label-danger">Diproses</div>';
						}else if ($data_user->tingkatan==1) {
							echo '<div class="btn-group">
										<a href="'.base_URL().'admin/nota_dinas/verifikasi_nota_dinas/'.$b->id .'" class="btn btn-default btn-sm"> Lihat</a>
									</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_notadinas == 2) {
						if ($data_user->jabatan==1) {
							echo '<div class="btn-group">
										<a href="'.base_URL().'admin/nota_dinas/verifikasi_nota_dinas/'.$b->id .'" class="btn btn-success btn-sm"> verifikasi</a>
									</div>';
						}else if ($data_user->tingkatan==1 or $data_user->jabatan==2) {
							echo '<div class="label label-danger">Diproses</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_notadinas == 4) {
						if ($data_user->jabatan==2) {
							echo '<div class="btn-group">
										<a href="'.base_URL().'admin/nota_dinas/verifikasi_nota_dinas/'.$b->id .'" class="btn btn-success btn-sm"> Proses</a>
									</div>';										   
						}else if ($data_user->tingkatan==1 or $data_user->jabatan==1) {
							echo '<div class="label label-danger">Diproses</div>';
						}else{
							echo '<div class="label label-danger">No Action</div>';
						}
					}else if ($b->status_notadinas == 5) {
						if ($data_user->jabatan==2) {
							echo '<div class="btn-group">
										<a href="'.base_URL().'admin/nota_dinas/cetak_nota_dinas/'.$b->id .'" class="btn btn-success btn-sm"> Cetak</a>
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
			}
		}
		?>
	</tbody>
</table>
<center><ul class="pagination"><?php echo $pagi; ?></ul></center>
</div>
