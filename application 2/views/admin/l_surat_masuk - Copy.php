<style>/*ubah surat masuk mei*/
#zame_wrapper #zame_length {
display: none;
}
</style>
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
						<input type="text" id="searchbox" class="form-control" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required>
						<!-- <button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button> -->
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

<table class="table table-bordered table-hover" id="zame">
	<thead>
		<tr>
			<th width="">No</th><!-- ubah surat masuk mei -->
			<th width="15%">No. Agd/Kode</th>
			<th width="20%">Perihal, File</th>
			<th width="10%">Asal Surat</th><!-- ubah surat masuk mei -->
			<th width="15%">Nomor, Tgl. Surat</th>
			<th width="10%">Jenis Surat</th><!-- ubah surat masuk mei -->
			<th width="10%">Status</th><!-- ubah surat masuk mei -->
			<?php if($this->session->userdata('admin_jabatan')==1 || $this->session->userdata('admin_jabatan')==28 || $this->session->userdata('admin_satuan')==6){ ?>
			<th width="10%">Status Disposisi</th><!-- ubah surat masuk mei -->
		<?php } ?>
			<th width="30%">Aksi</th><!-- ubah surat masuk mei -->
		</tr>
	</thead>
	
	<tbody style="font-size: 13px;"><!-- ubah surat masuk mei -->
		<?php
		if($this->session->userdata('admin_tingkatan')==2){
			$user_subjabatan = $this->db->query("SELECT notadinas.master_jabatan.id AS id FROM notadinas.master_user INNER JOIN notadinas.master_jabatan ON notadinas.master_user.jabatan = notadinas.master_jabatan.id WHERE notadinas.master_user.id = " . $this->session->userdata('admin_id'))->row();					
			$jabsatan = $user_subjabatan->id;
		}else{
			$jabsatan = $this->session->userdata('admin_jabatan');
		}

		if (empty($data)) { 
			 if($this->session->userdata('admin_jabatan')==1 || $this->session->userdata('admin_jabatan')==28 || $this->session->userdata('admin_satuan')==6){ 
			echo "<tr><td colspan='9'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";//ubah surat masuk mei
			}else{
			echo "<tr><td colspan='8'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";//ubah surat masuk mei
			}
		} else {
			// $no 	= ($this->uri->segment(4) + 1);
				$no = 1;//ubah surat masuk mei
			foreach ($data as $b) {
				$noset = str_replace("/","_", $b->no_setum);
				// echo $noset;
				if(isset($tembusan[$b->id][$jabsatan]) or 6==$this->session->userdata('admin_satuan') or ($this->session->userdata('admin_jabatan')==1) or $this->session->userdata('admin_jabatan')==28 or (isset($b->penerima_disposisi) AND $b->penerima_disposisi==$this->session->userdata('admin_jabatan') AND $this->session->userdata('admin_tingkatan')==2)){
		?>
		<tr>
			<td style="text-align: center;"><?php echo $no++; ?></td><!-- ubah mei surmas6 -->
			<td><?php echo $b->no_setum."</br>".tgl_jam_sql($b->tgl_setum);?></td>
			<td><?php echo $b->perihal."<br><b>Dokumen : </b><i><a href='".base_URL()."upload/surat_masuk/".$b->file_attachment."' target='_blank'>".$b->file_attachment."</a>"?></td><!--ubah mei bahasa-->
			<td><?php echo $b->instansi; ?></td>
			<td><?php echo $b->no_surat."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"?></td>
			<td><!-- ubah surat masuk mei -->
				<?php if(!empty($b->id_jenis_surat_masuk)){
				 		foreach ($jenis_surat as $key => $js) { 
							if(isset($b->id_jenis_surat_masuk)){
			                    if($js->id_master_surat_masuk == $b->id_jenis_surat_masuk)echo $js->jenis_surat_masuk;
			                }
		            	}
		            }else{
		            	
		            }
	            ?>
			</td>
			<td><!--ubah surat masuk mei-->
				<?php if($b->status_surat_masuk == 1 or $b->status_surat_masuk == 2){
					$_tmp_query = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = $b->kepada")->row();
					echo $_tmp_query->nama_jabatan;
				}elseif ($b->status_surat_masuk == 3){
					if($this->session->userdata('admin_satuan') == 6 || $this->session->userdata('admin_jabatan') == 1 || $this->session->userdata('admin_jabatan') == 28){
						$_tmp_query = $this->db->query("SELECT * FROM notadinas.log_proses_surat_masuk WHERE id_suratmasuk = $b->id")->row();
						$_waktu = "";
						if($_tmp_query->waktu!=""){
							$_waktu = explode('.',$_tmp_query->waktu);
							$_waktu = "<br/>" . $_tmp_query->tanggal_proses . " " . $_waktu[0];
						}
						echo "DISPOSISI $_waktu";
					}else{
						$posisi = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id =  notadinas.disposisi_surat_masuk.penerima_disposisi WHERE id_surat_masuk = '.$b->id.'ORDER BY urut_jabatan ASC' )->result();//ubah surat masuk mei

						foreach($posisi as $res){

							echo $res->nama_jabatan.", ";
						}

						$posisis = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id =  notadinas.disposisi_surat_masuk.penerima_disposisi_satuan JOIN notadinas.master_subjabatan ON notadinas.master_jabatan.subdis = notadinas.master_subjabatan.id_subjabatan WHERE notadinas.disposisi_surat_masuk.id_surat_masuk = '.$b->id.'ORDER BY notadinas.master_subjabatan.id_jabatan ASC, notadinas.master_subjabatan.urut_subjabatan')->result();//ubah surat masuk mei

						foreach($posisis as $rex){

							echo $rex->nama_jabatan.", ";
						}
					}

				}else{
					//popo
					if($this->session->userdata('admin_satuan') == 6 || $this->session->userdata('admin_jabatan') == 1 || $this->session->userdata('admin_jabatan') == 28){
						$_tmp_query = $this->db->query("SELECT * FROM notadinas.log_proses_surat_masuk WHERE id_suratmasuk = $b->id")->row();
						$_waktu = "";
						if($_tmp_query->waktu!=""){
							$_waktu = explode('.',$_tmp_query->waktu);
							$_waktu = "<br/>" . $_tmp_query->tanggal_proses . " " . $_waktu[0];
						}
						echo "DISPOSISI $_waktu";
					}else{
						$posisis = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id =  notadinas.disposisi_surat_masuk.penerima_disposisi WHERE id_surat_masuk = '.$b->id.'ORDER BY urut_jabatan ASC')->result();//ubah surat masuk mei

						foreach($posisis as $rex){

							echo $rex->nama_jabatan.", ";
						}

						$posisi = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id =  notadinas.disposisi_surat_masuk.penerima_disposisi_satuan JOIN notadinas.master_subjabatan ON notadinas.master_jabatan.subdis = notadinas.master_subjabatan.id_subjabatan WHERE notadinas.disposisi_surat_masuk.id_surat_masuk = '.$b->id.'ORDER BY notadinas.master_subjabatan.id_jabatan ASC, notadinas.master_subjabatan.urut_subjabatan')->result();//ubah surat masuk mei

						foreach($posisi as $res){

							echo $res->nama_jabatan.", ";
						}
					}

				}

				 ?>
				
			</td>
			<!--ubah surat masuk mei-->
			<?php if($this->session->userdata('admin_jabatan')==1 || $this->session->userdata('admin_jabatan')==28 || $this->session->userdata('admin_satuan')==6){ ?>
			<td>
				<?php if ($b->status_surat_masuk == 3){
					
					$posisi = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id =  notadinas.disposisi_surat_masuk.penerima_disposisi WHERE id_surat_masuk = '.$b->id.'ORDER BY urut_jabatan ASC' )->result();//ubah surat masuk mei

					foreach($posisi as $res){
						echo $res->nama_jabatan;
						echo " : ";
						if($res->status == 1){
							echo "<i class='fa fa-circle-o' aria-hidden='true' style='color: green !important;'></i> <i class='fa fa-circle' aria-hidden='true' style='color: red !important'></i><br>";
						}else{
							echo "<i class='fa fa-circle' aria-hidden='true' style='color: green !important;'></i> <i class='fa fa-circle-o' aria-hidden='true' style='color: red !important'></i><br>";
						}
					}

					$posisis = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id =  notadinas.disposisi_surat_masuk.penerima_disposisi_satuan JOIN notadinas.master_subjabatan ON notadinas.master_jabatan.subdis = notadinas.master_subjabatan.id_subjabatan WHERE notadinas.disposisi_surat_masuk.id_surat_masuk = '.$b->id.'ORDER BY notadinas.master_subjabatan.id_jabatan ASC, notadinas.master_subjabatan.urut_subjabatan')->result();//ubah surat masuk mei

					foreach($posisis as $rex){

						echo $rex->nama_jabatan;
						echo " : ";
						if($rex->status == 1){
							echo "<i class='fa fa-circle-o' aria-hidden='true' style='color: green !important;'></i> <i class='fa fa-circle' aria-hidden='true' style='color: red !important'></i><br>";
						}else{
							echo "<i class='fa fa-circle' aria-hidden='true' style='color: green !important;'></i> <i class='fa fa-circle-o' aria-hidden='true' style='color: red !important'></i><br>";
						}
					}

				}else{
					//popo
					$posisis = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id =  notadinas.disposisi_surat_masuk.penerima_disposisi WHERE id_surat_masuk = '.$b->id.'ORDER BY urut_jabatan ASC')->result();//ubah surat masuk mei

					foreach($posisis as $rex){

						echo $rex->nama_jabatan;
						echo " : ";
						if($rex->status == 1){
							echo "<i class='fa fa-circle-o' aria-hidden='true' style='color: green !important;'></i> <i class='fa fa-circle' aria-hidden='true' style='color: red !important'></i><br>";
						}else{
							echo "<i class='fa fa-circle' aria-hidden='true' style='color: green !important;'></i> <i class='fa fa-circle-o' aria-hidden='true' style='color: red !important'></i><br>";
						}
					}

					$posisi = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id =  notadinas.disposisi_surat_masuk.penerima_disposisi_satuan JOIN notadinas.master_subjabatan ON notadinas.master_jabatan.subdis = notadinas.master_subjabatan.id_subjabatan WHERE notadinas.disposisi_surat_masuk.id_surat_masuk = '.$b->id.'ORDER BY notadinas.master_subjabatan.id_jabatan ASC, notadinas.master_subjabatan.urut_subjabatan')->result();//ubah surat masuk mei

					foreach($posisi as $res){

						echo $res->nama_jabatan;
						echo " : ";
						if($res->status == 1){
							echo "<i class='fa fa-circle-o' aria-hidden='true' style='color: green !important;'></i> <i class='fa fa-circle' aria-hidden='true' style='color: red !important'></i><br>";
						}else{
							echo "<i class='fa fa-circle' aria-hidden='true' style='color: green !important;'></i> <i class='fa fa-circle-o' aria-hidden='true' style='color: red !important'></i><br>";
						}
					}

				} ?>
			</td>
		<?php } ?>
			<td class="ctr">
				<?php  

				$feedback = $this->db->query("SELECT * FROM notadinas.feedback_surat_masuk WHERE notadinas.feedback_surat_masuk.baca IS NULL AND  notadinas.feedback_surat_masuk.id_surat_masuk = '".$b->id."'AND notadinas.feedback_surat_masuk.penerima = '".$this->session->userdata('admin_jabatan')."'")->result();

				if ($this->session->userdata('admin_satuan') == 6) {//ubah surat masuk mei

					if($b->opened == 10){ ?>
						
						<div class="btn-group">
							<a href="<?php echo base_URL()?>admin/surat_masuk/edt/<?php echo $b->id?>" class="btn btn-default btn-sm" title="Lihat"> Lihat</a>
							<a target="_blank" href="<?php echo base_URL()?>admin/cetak_surat_masuk/<?php echo $noset?>" class="btn btn-info btn-sm" title="Cetak">Cetak</a><!--ubah mei surmas5-->
						</div>

					<?php
					}elseif($b->status_surat_masuk != 1){//ubah surat masuk mei
						$posisi2 = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id =  notadinas.disposisi_surat_masuk.penerima_disposisi WHERE id_surat_masuk = '.$b->id.'AND notadinas.disposisi_surat_masuk.penerima_disposisi = 2 ORDER BY urut_jabatan ASC' )->row();
						if($posisi2==null){ ?>
						
						<div class="btn-group">
							<a href="<?php echo base_URL()?>admin/surat_masuk/edt/<?php echo $b->id?>" class="btn btn-default btn-sm" title="Lihat"> Lihat</a>
							<a href="#" class="btn btn-warning btn-sm"> Terkirim</a><br>
							<?php
							$sm_waka = $this->db->query("SELECT * FROM notadinas.surat_masuk_waka WHERE surat_masuk = $b->id")->row();
							$sm_waka_status = "Belum Feedback";
							if(isset($sm_waka->status)){
								if($sm_waka->status == "Sudah Feedbak = Selesai"){
									$sm_waka_status = "Sudah Feedbak = Selesai";
								}
							}
							?>
							<?php //if($b->status_surat_masuk == 3 || $b->status_surat_masuk == 4){ ?>
							<?php if($b->status_surat_masuk == 4 or $sm_waka_status=="Sudah Feedbak = Selesai"){ ?>
							<center><a target="_blank" href="<?php echo base_URL()?>admin/cetak_surat_masuk/<?php echo $noset?>" class="btn btn-info btn-sm" title="Cetak">Cetak</a></center><!--ubah mei surmas5-->
							<?php } ?>
						</div>
						<?php 
						}else{
							if(!isset($disp_tembusan[$b->id][$this->session->userdata('admin_jabatan')]['yes'])){ ?>
							<div class="btn-group">
								<a href="<?php echo base_URL()?>admin/surat_masuk/kadisp/<?php echo $b->id?>" class="btn btn-warning btn-sm" title="Disposisi"><i class="icon-print icon-white"> </i>Disposisi</a>
							</div><?php
							}else{ ?>
					<?php 
						$fdsat = $this->db->query("SELECT * FROM notadinas.feedback_surat_masuk_satuan WHERE notadinas.feedback_surat_masuk_satuan.baca IS NULL AND  notadinas.feedback_surat_masuk_satuan.id_surat_masuk = '".$b->id."'AND notadinas.feedback_surat_masuk_satuan.penerima = '".$this->session->userdata('admin_jabatan')."' AND NOT notadinas.feedback_surat_masuk_satuan.pengirim = '".$this->session->userdata('admin_jabatan')."'")->result(); 
					?>
<div class="btn-group">
						<button onclick="bacasatuan(<?= $b->id ?>)" type="button" class="btn btn-warning btn-sm" title="Lihat"><i class="icon-print icon-white"> </i>Lihat <sup class="label label-danger"><?php 
							$nil2 = count($fdsat);
							if($nil2 != 0){
								foreach ($fdsat as $key) {
									if($key->penerima!=NULL){
										echo $nil2;
										break;
									}
									// var_dump($this->session->userdata('admin_jabatan'));
								}
							}
							 ?></sup></button>
						<!-- <a href="<?php echo base_URL()?>admin/surat_masuk/subdisp/<?php echo $b->id?>" class="btn btn-warning btn-sm" title="Lihat"><i class="icon-print icon-white"> </i>Lihat</a> -->
					</div>
							<?php }
						}
					}else{?>
						<div class="btn-group"><!-- ubah surat masuk mei -->
							<a href="<?php echo base_URL()?>admin/surat_masuk/edited/<?php echo $b->id?>" class="btn btn-success btn-sm">Edit</a>
							<a href="<?php echo base_URL()?>admin/surat_masuk/kirim/<?php echo $b->id?>/<?php echo $b->kepada?>" class="btn btn-info btn-sm" title="Kirim" onclick="return confirm('Kirimkan surat?')" ><i class="icon-print icon-white"> </i>Kirim</a>
							<a href="<?php echo site_url('admin/surat_masuk/del/'.$b->id.''); ?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm">Hapus</a>
						</div>	<?php
					} 
				}else if ($this->session->userdata('admin_jabatan') == 1 || $this->session->userdata('admin_jabatan') == 28) {


					if($b->opened == 10){ ?>
						
						
						<div class="btn-group">
							<a target="_blank" href="<?php echo base_URL()?>admin/cetak_surat_masuk/<?php echo $noset?>" class="btn btn-info btn-sm" title="Cetak"><i class="icon-print icon-white"> </i>Cetak</a><!--ubah mei surmas5-->
							
							<a href="<?php echo base_URL()?>admin/surat_masuk/disp/<?php echo $b->id?>" class="btn btn-warning btn-sm" title="Lihat"><i class="icon-print icon-white"> </i>Lihat</a>
						</div>
						 <?php
					}elseif($b->status_surat_masuk != 2){ ?>
						
						
						<div class="btn-group">
							<a target="_blank" href="<?php echo base_URL()?>admin/cetak_surat_masuk/<?php echo $noset?>" class="btn btn-info btn-sm" title="Cetak"><i class="icon-print icon-white"> </i>Cetak</a><!--ubah mei surmas5-->
							
							<button onclick="baca(<?= $b->id ?>)" type="button" class="btn btn-success btn-sm" title="Terkirim">Terkirim <sup class="label label-danger"><?php 
							$nil = count($feedback);
							if($nil != 0){
								foreach ($feedback as $key) {
									if($key->pengirim != $this->session->userdata('admin_jabatan')){
										echo $nil;
										break;
									}
									// var_dump($this->session->userdata('admin_jabatan'));
								}
							}
							 ?></sup></button>
						</div>
						 <?php
					}else{ ?>
						<div class="btn-group">
							<a href="<?php echo base_URL()?>admin/surat_masuk/disp/<?php echo $b->id?>" class="btn btn-warning btn-sm" title="Lihat"><i class="icon-print icon-white"> </i>Disposisi</a>
						</div><?php
					} 
				}else if ($this->session->userdata('admin_tingkatan') == 2) {?>
					<?php 
						$fdsat = $this->db->query("SELECT * FROM notadinas.feedback_surat_masuk_satuan WHERE notadinas.feedback_surat_masuk_satuan.baca IS NULL AND  notadinas.feedback_surat_masuk_satuan.id_surat_masuk = '".$b->id."'AND notadinas.feedback_surat_masuk_satuan.penerima = '".$this->session->userdata('admin_jabatan')."' AND NOT notadinas.feedback_surat_masuk_satuan.pengirim = '".$this->session->userdata('admin_jabatan')."'")->result(); 
					?>

					<div class="btn-group">
						<button onclick="bacasatuan(<?= $b->id ?>)" type="button" class="btn btn-warning btn-sm" title="Lihat"><i class="icon-print icon-white"> </i>Lihat <sup class="label label-danger"><?php 
							$nil2 = count($fdsat);
							if($nil2 != 0){
								foreach ($fdsat as $key) {
									if($key->penerima!=NULL){
										echo $nil2;
										break;
									}
									// var_dump($this->session->userdata('admin_jabatan'));
								}
							}
							 ?></sup></button>
						<!-- <a href="<?php echo base_URL()?>admin/surat_masuk/subdisp/<?php echo $b->id?>" class="btn btn-warning btn-sm" title="Lihat"><i class="icon-print icon-white"> </i>Lihat</a> -->
					</div><?php
				}else{ 

					if($b->opened == 10){ ?>
					<?php 
						$fdsat = $this->db->query("SELECT * FROM notadinas.feedback_surat_masuk_satuan WHERE notadinas.feedback_surat_masuk_satuan.baca IS NULL AND  notadinas.feedback_surat_masuk_satuan.id_surat_masuk = '".$b->id."'AND notadinas.feedback_surat_masuk_satuan.penerima = '".$this->session->userdata('admin_jabatan')."' AND NOT notadinas.feedback_surat_masuk_satuan.pengirim = '".$this->session->userdata('admin_jabatan')."'")->result(); 
					?>
<div class="btn-group">
						<button onclick="bacasatuan(<?= $b->id ?>)" type="button" class="btn btn-warning btn-sm" title="Lihat"><i class="icon-print icon-white"> </i>Lihat <sup class="label label-danger"><?php 
							$nil2 = count($fdsat);
							if($nil2 != 0){
								foreach ($fdsat as $key) {
									if($key->penerima!=NULL){
										echo $nil2;
										break;
									}
									// var_dump($this->session->userdata('admin_jabatan'));
								}
							}
							 ?></sup></button>
						<!-- <a href="<?php echo base_URL()?>admin/surat_masuk/subdisp/<?php echo $b->id?>" class="btn btn-warning btn-sm" title="Lihat"><i class="icon-print icon-white"> </i>Lihat</a> -->
					</div>

			  <?php }else if($b->status_surat_masuk == 4){ ?>
						<div class="btn-group">
							<a target="_blank" href="<?php echo base_URL()?>admin/cetak_surat_masuk/<?php echo $noset?>" class="btn btn-info btn-sm" title="Cetak"><i class="icon-print icon-white"> </i>Cetak</a><!--ubah mei surmas5-->
							<?php 
								$fdsat2 = $this->db->query("SELECT * FROM notadinas.feedback_surat_masuk_satuan WHERE notadinas.feedback_surat_masuk_satuan.baca IS NULL AND  notadinas.feedback_surat_masuk_satuan.id_surat_masuk = '".$b->id."'AND notadinas.feedback_surat_masuk_satuan.penerima = '".$this->session->userdata('admin_jabatan')."' AND NOT notadinas.feedback_surat_masuk_satuan.pengirim = '".$this->session->userdata('admin_jabatan')."'")->result();
							?>
							<button type="button" onclick="bacaKadis(<?= $b->id ?>)"  class="btn btn-warning btn-sm" title="Proses">Proses. <sup class="label label-danger"><?php 
							$nil = count($feedback);
							$nil2 = count($fdsat2);
							if($nil != 0){
								foreach ($feedback as $key) {
									if($key->pengirim != $this->session->userdata('admin_jabatan')){
										echo $nil+$nil2;
										break;
									}
									// var_dump($this->session->userdata('admin_jabatan'));
								}
							}else if($nil2 != 0){
								foreach ($fdsat2 as $key2) {
									if($key2->pengirim != $this->session->userdata('admin_jabatan')){
										echo $nil+$nil2;
										break;
									}
									// var_dump($this->session->userdata('admin_jabatan'));
								}
							}
							 ?></sup></button>
						</div>

			  <?php }else{
			  		// var_dump($disp_tembusan[$b->id][$this->session->userdata('admin_jabatan')]); 
						if(!isset($disp_tembusan[$b->id][$this->session->userdata('admin_jabatan')]['yes'])){ ?>
						<div class="btn-group">
							<!-- <a href="<?php echo base_URL()?>admin/surat_masuk/kadisp/<?php echo $b->id?>" class="btn btn-warning btn-sm" title="Disposisi"><i class="icon-print icon-white"> </i>Disposisi</a> -->
							<!-- ubah ini -->
							<button type="button" onclick="bacaKadis(<?= $b->id ?>)"  class="btn btn-warning btn-sm" title="Proses">Disposisi <sup class="label label-danger"><?php 
							$nil = count($feedback);
							if($nil != 0){
								foreach ($feedback as $key) {
									if($key->pengirim != $this->session->userdata('admin_jabatan')){
										echo $nil;
										break;
									}
									// var_dump($this->session->userdata('admin_jabatan'));
								}
							}
							 ?></sup></button>
						</div><?php
						}else{ ?>
							
					<?php 
						$fdsat = $this->db->query("SELECT * FROM notadinas.feedback_surat_masuk_satuan WHERE notadinas.feedback_surat_masuk_satuan.baca IS NULL AND  notadinas.feedback_surat_masuk_satuan.id_surat_masuk = '".$b->id."'AND notadinas.feedback_surat_masuk_satuan.penerima = '".$this->session->userdata('admin_jabatan')."' AND NOT notadinas.feedback_surat_masuk_satuan.pengirim = '".$this->session->userdata('admin_jabatan')."'")->result(); 
					?>
<div class="btn-group">
						<button onclick="bacasatuan(<?= $b->id ?>)" type="button" class="btn btn-warning btn-sm" title="Lihat"><i class="icon-print icon-white"> </i>Lihat <sup class="label label-danger"><?php 
							$nil2 = count($fdsat);
							if($nil2 != 0){
								foreach ($fdsat as $key) {
									if($key->penerima!=NULL){
										echo $nil2;
										break;
									}
									// var_dump($this->session->userdata('admin_jabatan'));
								}
							}
							 ?></sup></button>
						<!-- <a href="<?php echo base_URL()?>admin/surat_masuk/subdisp/<?php echo $b->id?>" class="btn btn-warning btn-sm" title="Lihat"><i class="icon-print icon-white"> </i>Lihat</a> -->
					</div>
						
					<?php }
					} 
				} ?>
			</td>
		</tr>
		<?php 
				}
			// $no++;//ubah mei surmas6
			}
		}
		?>
	</tbody>
</table>
<?php 
    $jbt = $this->db->query("SELECT subdis FROM notadinas.master_jabatan WHERE id = '".$this->session->userdata('admin_jabatan')."'")->row();
    if($jbt->subdis==null){
        $isact = "kadisp";
    }else{
        $isact = "subdisp";
    }
?>
<!-- <center><ul class="pagination"><?php echo $pagi; ?></ul></center> -->
</div>
<script type="text/javascript">
	// function baca(e) {
		
	// 	$.get('<?= base_url()."administrator/baca_feedback" ?>',{id:e},function (data) {

	// 		<?php if($this->session->userdata('admin_jabatan') != 1){ ?>
	// 		window.location.assign("<?php echo base_url();?>admin/surat_masuk/kadisp/"+e);
	// 		<?php }else{ ?>
	// 		window.location.assign("<?php echo base_url();?>admin/surat_masuk/disp/"+e);
	// 		<?php } ?>
	// 	})
	// }
</script>

<script>
$(window).load(function(){
    $('#zame').DataTable({
    	"searching": true,
    	 "bLengthChange" : false,
    	"bInfo":false,
    	"paging": true  
    });
} );

$(window).load(function(){
    var dataTable = $('#zame').dataTable();
    $("#searchbox").keyup(function() {
        dataTable.fnFilter(this.value);
    });
});
 function baca(e) {
		
		$.get('<?= base_url()."administrator/baca_feedback" ?>',{id:e},function (data) {

			<?php if($this->session->userdata('admin_jabatan') != 1 && $this->session->userdata('admin_jabatan') != 28){ ?>
			window.location.assign("<?php echo base_url();?>admin/surat_masuk/kadisp/"+e);
			<?php }else{ ?>
			window.location.assign("<?php echo base_url();?>admin/surat_masuk/disp/"+e);
			<?php } ?>
		})
	}

function bacasatuan(e) {
		// alert(e);
		var actlan = "<?php echo $isact ?>";
		$.get('<?= base_url()."administrator/baca_feedback_satuan" ?>',{id:e},function (data) {
			window.location.assign("<?php echo base_url();?>admin/surat_masuk/"+actlan+"/"+e);
		})
	}
function bacaKadis(e) {
		var actlan = "<?php echo $isact ?>";
		$.get('<?= base_url()."administrator/baca_feedback_kadis" ?>',{id:e},function (data) {
			window.location.assign("<?php echo base_url();?>admin/surat_masuk/"+actlan+"/"+e);
		})
	}
</script>