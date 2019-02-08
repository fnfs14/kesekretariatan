<style>
#list_table_wrapper #list_table_length {
	display: none;
}
</style>
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
			<?php if($this->session->userdata('admin_tingkatan') != 2 and $this->session->userdata('admin_jabatan')!=1 and $this->session->userdata('admin_jabatan')!=28){ ?>	<!-- ubah ini -->
				<li><a href="<?php echo base_URL(); ?>admin/surat_keluar/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
			<?php } ?>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>admin/surat_keluar/cari">
					<?php $jns = $this->db->query("SELECT * FROM notadinas.master_surat_keluar")->result(); ?>
					
                            <select style="width:200px" name="q2" class="form-control" id="q2">
                                <option value="" selected>Semua</option>
                                <?php
                                foreach ($jns as $jen) { ?>
                                    <option value="<?= $jen->id_master_surat_keluar; ?>"><?php echo $jen->jenis_surat_keluar; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
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
	

<table class="table table-bordered table-hover"  id="zame">
	<thead>
		<tr>
			<th width="">No.</th>
			<th width="">No. Agd/Kode</th>
			<th width="">Perihal, File</th>
			<th width="">Pembuat</th>
			<th width="">Tujuan Surat</th>
			<th width="">Nomor, Tgl. Surat</th>
			<th width="">Status</th>
			<th width="">Aksi</th>
		</tr>
	</thead>
	
	<tbody style="font-size: 13px !important;">
		<?php 
		$order_list = 0;
		if (empty($data)) {
			echo "<tr><td colspan='8'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
		} else {
			$no 	= ($this->uri->segment(4) + 1);
			foreach ($data as $b) {
				if($b->create_by == $this->session->userdata('admin_id') or (isset($tembusan[$this->session->userdata('admin_jabatan')][$b->id])) or $this->session->userdata('admin_jabatan')==1 or $this->session->userdata('admin_jabatan')==28 or $this->session->userdata('admin_satuan')==6){
		?>
		<tr>
			<td><?= $order_list = $order_list + 1; ?></td>
			<td><?php echo $b->no_agenda; ?><br><?php echo $b->id; ?></td>
			<td><?php echo $b->perihal."<br><b>File : </b><i><a href='".base_URL()."upload/surat_keluar/".$b->file_attachment."' target='_blank'>".$b->file_attachment."</a>"?></td>
			<?php
				$get_creator = $this->db->query("SELECT * FROM notadinas.master_user WHERE id = $b->create_by")->row();
			?>
			<td><?php echo $get_creator->nama_lengkap; ?></td>
			<td><?php echo $b->kepada?></td>
			<td><?php echo $b->no_surat."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"?></td>
			<td><?php 
				if($b->status_surat_keluar == 0){
					echo "Surat Baru";
				}else if($b->status_surat_keluar == 1){
					echo "Verifikasi";
					foreach ($status_kadis as $c) {
						if($c->id_surat_keluar == $b->id){
							echo " $c->nama_kadis,";
						}
					
					}
				}else if($b->status_surat_keluar == 2){
					if($b->kirim_ke==28){
						echo "Verifikasi WAKAPUSHIDROSAL";
					}else{
						echo "Verifikasi KAPUSHIDROSAL";
					}
				}else if($b->status_surat_keluar == 3){
					echo "Dikoreksi";
				}else if($b->status_surat_keluar == 4){
					echo "Diproses SETUM";
				}else if($b->status_surat_keluar == 5){
					echo "Verifikasi SETUM";
				}else if($b->status_surat_keluar == 6){
					echo "Verifikasi KAPUSHIDROSAL";
				}else if($b->status_surat_keluar == 7){
					echo "Selesai";
				}else if($b->status_surat_keluar == 8){
					echo "Revisi";
				}
			?></td>
			<td class="ctr">
				<div class="btn-group">
			<!-- <a target="_blank" href="<?= base_URL(); ?>admin/cetak_surat_keluar/<?= $b->id; ?>" class="btn btn-success btn-sm"> Cetak</a> -->
				<?php  
				if ($b->create_by == $this->session->userdata('admin_id')) {
					if ($b->status_surat_keluar == 0 or $b->status_surat_keluar == 3 or $b->status_surat_keluar == 8) {
				?>
						
							<a href="<?= base_URL(); ?>admin/surat_keluar/show/<?= $b->id; ?>" class="btn btn-default btn-sm">Tampil</a>
							<a href="<?php echo base_URL()?>admin/surat_keluar/edit_new_message/<?php echo $b->id?>" class="btn btn-success btn-sm">Edit</a>
							<a onclick="return confirm('Anda yakin ingin menghapus surat ini?');" href="<?php echo base_URL()?>admin/surat_keluar/delete_new_message/<?php echo $b->id?>" class="btn btn-info btn-sm">Hapus</a>
							<a href="<?php echo base_URL()?>admin/surat_keluar/kirim_kelain/<?= $b->id?>" class="btn btn-primary btn-sm"> Kirim</a>
				<?php 
					}else if($b->status_surat_keluar == 5 and $this->session->userdata('admin_satuan')==6){ 
					echo '
										<a href="'.base_URL().'admin/surat_keluar/verifikasi_surat_keluar/'.$b->id .'" class="btn btn-success btn-sm"> verifikasi</a>
									';
					}else if($b->status_surat_keluar == 4 and $this->session->userdata('admin_satuan')==6){ 
					echo '<a href="' . base_URL() . 'admin/surat_keluar/show/' . $b->id . '" class="btn btn-default btn-sm">Tampil</a>
										<a href="'.base_URL().'admin/surat_keluar/verifikasi_surat_keluar/'.$b->id .'" class="btn btn-success btn-sm"> Proses</a>
									';
					}else if($b->status_surat_keluar == 7){ 
						echo '
							<a target="_blank" href="'. base_URL(); ?>admin/cetak_surat_keluar/<?= $b->id . '" class="btn btn-success btn-sm"> Cetak</a>
							<a href="' . base_URL() . 'admin/surat_keluar/show/' . $b->id . '" class="btn btn-default btn-sm">Tampil</a>
							<a href="#" class="btn btn-success btn-sm"> Selesai</a>';
					}else{
						echo '<a href="#diproses" class="btn btn-danger btn-sm">Diproses</a>';
					} 
				} else {
					// var_dump($b);/*
					if ($b->status_surat_keluar == 0 or $b->status_surat_keluar == 8) {
						if ($this->session->userdata("admin_jabatan")==1 or $this->session->userdata("admin_jabatan")==2 or $this->session->userdata("admin_tingkatan")==1) {
							echo '<a href="#diproses" class="btn btn-danger btn-sm">Diproses</a>';
						}else{
							echo '<a href="#noaction" class="btn btn-danger btn-sm">No Action</a>';
						}
					}else if ($b->status_surat_keluar == 1) {
						if ($this->session->userdata("admin_jabatan")==1 or $this->session->userdata("admin_jabatan")==2) {
							echo '<a href="#diproses" class="btn btn-danger btn-sm">Diproses</a>';
						}else if ($this->session->userdata("admin_tingkatan")==1 or (isset($tembusan[$this->session->userdata('admin_jabatan')][$b->id]) and $this->session->userdata("admin_tingkatan")==2)) {
							if(isset($tembusan[$this->session->userdata('admin_jabatan')][$b->id]) and $tembusan[$this->session->userdata('admin_jabatan')][$b->id]==1){
								echo '<a href="' . base_URL() . 'admin/surat_keluar/show/' . $b->id . '" class="btn btn-default btn-sm">Tampil</a>';
								if(isset($status_tembusan[$this->session->userdata('admin_jabatan')][$b->id][2]) or isset($status_tembusan[$this->session->userdata('admin_jabatan')][$b->id][1])){
									echo '<a href="#" class="btn btn-danger btn-sm"> Diproses</a>
									';
								}else{
									echo '<a href="'.base_URL().'admin/surat_keluar/verifikasi_surat_keluar/'.$b->id .'" class="btn btn-success btn-sm"> verifikasi</a>
									';
								}
							}else{
								echo '<a href="#noaction" class="btn btn-danger btn-sm">No Action</a>';
							}
						}else{
							echo '<a href="#noaction" class="btn btn-danger btn-sm">No Action</a>';
						}
					}else if ($b->status_surat_keluar == 2) {
						if ($this->session->userdata("admin_jabatan")==$b->kirim_ke) {
							echo '<a href="' . base_URL() . 'admin/surat_keluar/show/' . $b->id . '" class="btn btn-default btn-sm">Tampil</a>
										<a href="'.base_URL().'admin/surat_keluar/verifikasi_surat_keluar/'.$b->id .'" class="btn btn-success btn-sm"> verifikasi</a>
									';
						}else if($this->session->userdata("admin_jabatan")== 1){
							echo '<a href="' . base_URL() . 'admin/surat_keluar/show/' . $b->id . '" class="btn btn-default btn-sm">Tampil</a>
										<a href="'.base_URL().'admin/surat_keluar/verifikasi_surat_keluar/'.$b->id .'" class="btn btn-success btn-sm"> verifikasi</a>
									';
						}
						else if ($this->session->userdata("admin_tingkatan")==1 or $this->session->userdata("admin_jabatan")==2) {
							echo '<a href="#diproses" class="btn btn-danger btn-sm">Diproses</a>';
						}else{
							echo '<a href="#noaction" class="btn btn-danger btn-sm">No Action</a>';
						}
					}else if ($b->status_surat_keluar == 3) {
						if ($this->session->userdata("admin_tingkatan")==1 or $this->session->userdata("admin_jabatan")==1 or $this->session->userdata("admin_jabatan")==2) {
							echo '<a href="#diproses" class="btn btn-danger btn-sm">Diproses</a>';
							echo '<a href="'.base_URL().'admin/surat_keluar/show/'.$b->id .'" class="btn btn-default btn-sm"> Tampil</a>';
						}else{
							echo '<a href="#noaction" class="btn btn-danger btn-sm">No Action</a>';
						}
					}else if ($b->status_surat_keluar == 4) {
						if ($this->session->userdata("admin_jabatan")==2) {
							echo '<a href="' . base_URL() . 'admin/surat_keluar/show/' . $b->id . '" class="btn btn-default btn-sm">Tampil</a>
										<a href="'.base_URL().'admin/surat_keluar/verifikasi_surat_keluar/'.$b->id .'" class="btn btn-success btn-sm"> Proses</a>
									';										   
						}else if ($this->session->userdata("admin_tingkatan")==1 or $this->session->userdata("admin_jabatan")==$b->kirim_ke) {
							echo '<a href="#diproses" class="btn btn-danger btn-sm">Diproses</a>';
						}else{
							echo '<a href="#noaction" class="btn btn-danger btn-sm">No Action</a>';
						}
					}else if ($b->status_surat_keluar == 5) {
						if ($this->session->userdata("admin_satuan")==6) {
							echo '
										<a href="'.base_URL().'admin/surat_keluar/verifikasi_surat_keluar/'.$b->id .'" class="btn btn-success btn-sm"> verifikasi</a>
									';
						}else if ($this->session->userdata("admin_tingkatan")==1 or $this->session->userdata("admin_jabatan")==1) {
							echo '<a href="#diproses" class="btn btn-danger btn-sm">Diproses</a>';
							echo '<a href="'.base_URL().'admin/surat_keluar/show/'.$b->id .'" class="btn btn-default btn-sm"> Tampil</a>';
						}else{
							echo '<a href="#noaction" class="btn btn-danger btn-sm">No Action</a>';
						}
					}else if ($b->status_surat_keluar == 6) {
						if ($this->session->userdata("admin_jabatan")==1) {
							echo '<a href="' . base_URL() . 'admin/surat_keluar/show/' . $b->id . '" class="btn btn-default btn-sm">Tampil</a>
							<a href="'.base_URL().'admin/surat_keluar/verifikasi_surat_keluar/'.$b->id .'" class="btn btn-success btn-sm"> Proses</a>';
						}else if ($this->session->userdata("admin_tingkatan")==1 or $this->session->userdata("admin_jabatan")==1) {
							echo '<a href="#diproses" class="btn btn-danger btn-sm">Diproses</a>';
						}else{
							echo '<a href="#noaction" class="btn btn-danger btn-sm">No Action</a>';
						}
					}else if ($b->status_surat_keluar == 7) {
							echo '
							<a target="_blank" href="'. base_URL(); ?>admin/cetak_surat_keluar/<?= $b->id . '" class="btn btn-success btn-sm"> Cetak</a>
							<a href="' . base_URL() . 'admin/surat_keluar/show/' . $b->id . '" class="btn btn-default btn-sm">Tampil</a>
							<a href="#" class="btn btn-success btn-sm"> Selesai</a>';
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
		}
		?>
	</tbody>
</table>
<!--<center><ul class="pagination"><?php echo $pagi; ?></ul></center>-->
</div>
<script>
// $(document).ready(function () {
// 	$("#list_table").dataTable({
// 		searching: false
// 		// ,lengthMenu: [[1], [1]]
// 	});
// });
$(window).load(function(){
    $('#zame').DataTable({
    	"searching": true,
    	 "bLengthChange" : false,
    	"bInfo":false,
    	"paging": true  
    });
} );
</script>