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
					<div class="navbar-form navbar-left">
						<input type="text" id="searchbox" class="form-control" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required>
						<!-- <button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button> -->
					</div>
				</ul>
			</div><!-- /.nav-collapse -->
		</div><!-- /.container -->
	</div><!-- /.navbar -->

  </div>
</div>
<?php
	echo $this->session->flashdata("k");
	$StatDisp = 0;
	if($this->session->userdata('admin_jabatan')==1 || $this->session->userdata('admin_jabatan')==28 || $this->session->userdata('admin_jabatan')==2){		
		$StatDisp = 1;
	}
?>
<table class="table table-bordered table-hover" id="zame" style=" table-layout: fixed!important; font-size : 12px!important;
        word-wrap: break-word!important;">
	<thead>
		<tr>
			<th width="5%">No</th><!-- ubah surat masuk mei -->
			<th width="10%">No. Agd/Kode</th>
			<th width="20%">Perihal, File</th>
			<th width="10%">Asal Surat</th><!-- ubah surat masuk mei -->
			<th width="13%">Nomor, Tgl. Surat</th>
			<th width="10%">Jenis Surat</th><!-- ubah surat masuk mei -->
			<th width="10%">Status</th><!-- ubah surat masuk mei -->
			<?php if($StatDisp==1){ ?>
			<th width="17%">Status Disposisi</th><!-- ubah surat masuk mei -->
			<?php } ?>
			<th width="10%">Aksi</th><!-- ubah surat masuk mei -->
		</tr>
	</thead>
	<tbody style="font-size: 12px!important;">
	<?php $no=1; foreach($data as $b){ ?>
		<tr>
			<td style="text-align: center;"><?php echo $no++; ?></td><!-- ubah mei surmas6 -->
			<td><?php echo $b->no_setum."</br>".tgl_jam_sql($b->tgl_setum);?></td>
			<td><?php echo $b->perihal."<br><b>Dokumen : </b><i><a href='".base_URL()."upload/surat_masuk/".$b->file_attachment."' target='_blank'>".$b->file_attachment."</a>"?></td><!--ubah mei bahasa-->
			<td><?php echo $this->db->query("SELECT * FROM notadinas.master_tujuan WHERE id = $b->instansi")->row()->nama; ?></td>
			<td><?php echo $b->no_surat."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"?></td>
			<td>
			<?php if(!empty($b->id_jenis_surat_masuk)){
					foreach ($jenis_surat as $key => $js) { 
						if(isset($b->id_jenis_surat_masuk)){
							if($js->id_master_surat_masuk == $b->id_jenis_surat_masuk){
								echo $js->jenis_surat_masuk;
							}
						}
					}
				} ?>
			</td>
			<td>
			<?php 
			$feedback = $this->db->query("SELECT * FROM notadinas.feedback_surat_masuk WHERE notadinas.feedback_surat_masuk.baca IS NULL AND  notadinas.feedback_surat_masuk.id_surat_masuk = '".$b->id."'AND notadinas.feedback_surat_masuk.penerima = '".$this->session->userdata('admin_jabatan')."'")->result();
			$nil = count($feedback);
			if($nil != 0){
				foreach ($feedback as $key) {
					if($key->penerima != $this->session->userdata('admin_jabatan')){
						$nil = $nil + 1;
						break;
					}
				}
			}
			$feedbackZ = $this->db->query("SELECT * FROM notadinas.feedback_surat_masuk_satuan WHERE notadinas.feedback_surat_masuk_satuan.baca IS NULL AND  notadinas.feedback_surat_masuk_satuan.id_surat_masuk = '".$b->id."'AND notadinas.feedback_surat_masuk_satuan.penerima = '".$this->session->userdata('admin_jabatan')."'")->result();
			$nilZ = count($feedbackZ);
			if($nilZ != 0){
				foreach ($feedbackZ as $keyZ) {
					if($keyZ->penerima != $this->session->userdata('admin_jabatan')){
						$nilZ = $nilZ + 1;
						break;
					}
				}
			}
			$nil = $nil + $nilZ;
			if($nil!=0){				
				$nil = '<sup class="label label-danger">'.$nil.'</sup>';
			}else{
				$nil = "";
			}
			$disposisiQ = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = $b->id")->result();
			if($b->status_surat_masuk == 1 or $b->status_surat_masuk == 2){
					$_tmp_query = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = $b->kepada")->row();
					echo $_tmp_query->nama_jabatan;
				}elseif($b->status_surat_masuk == 3 or $b->status_surat_masuk == 4){
					if($this->session->userdata('admin_jabatan') == 2 || $this->session->userdata('admin_jabatan') == 1 || $this->session->userdata('admin_jabatan') == 28){
						$_tmp_query = $this->db->query("SELECT * FROM notadinas.log_proses_surat_masuk WHERE id_suratmasuk = $b->id")->row();
						$_waktu = "";
						if($_tmp_query->waktu!=""){
							$_waktu = explode('.',$_tmp_query->waktu);
							
							$a = explode('-',$_tmp_query->tanggal_proses);
							if($a[1] == 1){ $bl = "Jan"; }else if($a[1] == 2){ $bl = "Feb"; }else if($a[1] == 3){ $bl = "Mar"; }else if($a[1] == 4){ $bl = "Apr"; }else if($a[1] == 5){ $bl = "Mei"; }else if($a[1] == 6){ $bl = "Jun"; }
							else if($a[1] == 7){ $bl = "Jul"; }else if($a[1] == 8){ $bl = "Agu"; }else if($a[1] == 9){ $bl = "Sep"; }else if($a[1] == 10){ $bl = "Okt"; }else if($a[1] == 11){ $bl = "Nov"; }else if($a[1] == 12){ $bl = "Des"; }
							$_waktu = "<br/>" . $a[2] . " " . $bl . " " . $a[0] . " " . $_waktu[0];
						}
						echo "DISPOSISI $_waktu";
					}else{
						foreach($disposisiQ as $q){
							if($q->penerima_disposisi!=null){
								$tmpJabatan = $q->penerima_disposisi;
								$tmpStatus = $q->status;
							}else{
								$tmpJabatan = $q->penerima_disposisi_satuan;
								$tmpStatus = $q->disposisi;
							}
							$jabatanQ = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = $tmpJabatan")->row();
						//	echo $jabatanQ->nama_jabatan . ", ";
						}
						$disposisiQz = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk INNER JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id =  notadinas.disposisi_surat_masuk.penerima_disposisi WHERE id_surat_masuk = $b->id ORDER BY urut_jabatan ASC")->result();
				$StatDispC = 0;
				// while($StatDispC < 2){
					foreach($disposisiQz as $q){
						if($q->penerima_disposisi!=null){
							$tmpJabatan = $q->penerima_disposisi;
							$tmpStatus = $q->status;
						}else{
							$tmpJabatan = $q->penerima_disposisi_satuan;
							$tmpStatus = $q->disposisi;
						}
						// echo $tmpJabatan."hhh";
						$jabatanQ = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = $tmpJabatan")->row();
						echo "<b>".$jabatanQ->nama_jabatan . "</b> : ";
						$tmptingkatan = $jabatanQ->tingkatan;
						// echo "<br>".$tmptingkatan."-".$tmpStatus."<br>";
						if(($tmptingkatan==1 and $tmpStatus==1) or ($tmptingkatan==2 and $tmpStatus!="yes") or ($jabatanQ->tingkatan=="" and $tmpStatus==1)){
							echo "<i class='fa fa-circle-o' aria-hidden='true' style='color: green !important;'></i> <i class='fa fa-circle' aria-hidden='true' style='color: red !important'></i><br>";
						}else{
							echo "<i class='fa fa-circle' aria-hidden='true' style='color: green !important;'></i> <i class='fa fa-circle-o' aria-hidden='true' style='color: red !important'></i><br>";
						}
					//n
					$disposisio = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk INNER JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id =  notadinas.disposisi_surat_masuk.penerima_disposisi_satuan WHERE id_surat_masuk = '".$b->id."' ORDER BY urut_jabatan ASC")->result();
					foreach($disposisio as $u){
						$a1 = $q->satuan;
						$a2 = $q->tingkatan;
						$b1 = $u->satuan;
						$b2 = $u->tingkatan;
						$tmpJabatanu = $u->penerima_disposisi_satuan;
						$tmpStatusu = $u->disposisi;
						// echo $a1."".$a2;
						if($a1 == $b1 && $b2 == 2){
							// echo "asasa";
							$jabatanQu = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = $tmpJabatanu")->row();
						echo "".$jabatanQu->nama_jabatan . " : ";
						$tmptingkatanu = $jabatanQu->tingkatan;
						// echo "<br>".$tmptingkatan."-".$tmpStatus."<br>";
						if(($tmptingkatanu==1 and $tmpStatusu==1) or ($tmptingkatanu==2 and $tmpStatusu!="yes") or ($jabatanQu->tingkatan=="" and $tmpStatusu==1)){
							echo "<i class='fa fa-circle-o' aria-hidden='true' style='color: green !important;'></i> <i class='fa fa-circle' aria-hidden='true' style='color: red !important'></i><br>";
						}else{
							echo "<i class='fa fa-circle' aria-hidden='true' style='color: green !important;'></i> <i class='fa fa-circle-o' aria-hidden='true' style='color: red !important'></i><br>";
						}
							
						}
					}
					//n
						
					}
					}
				} ?>
				
				
				<?php 
				
				?>
			</td>
			<?php 
			$jabatan = $this->session->userdata('admin_jabatan');
			$tingkatan = $this->session->userdata('admin_tingkatan');
			$satuan = $this->session->userdata('admin_satuan');
			if($StatDisp==1){
				echo "<td>";
				$disposisiQz = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk INNER JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id =  notadinas.disposisi_surat_masuk.penerima_disposisi WHERE id_surat_masuk = $b->id ORDER BY urut_jabatan ASC")->result();
				$StatDispC = 0;
				// while($StatDispC < 2){
					foreach($disposisiQz as $q){
						if($q->penerima_disposisi!=null){
							$tmpJabatan = $q->penerima_disposisi;
							$tmpStatus = $q->status;
						}else{
							$tmpJabatan = $q->penerima_disposisi_satuan;
							$tmpStatus = $q->disposisi;
						}
						// echo $tmpJabatan."hhh";
						$jabatanQ = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = $tmpJabatan")->row();
						echo "<b>".$jabatanQ->nama_jabatan . "</b> : ";
						$tmptingkatan = $jabatanQ->tingkatan;
						// echo "<br>".$tmptingkatan."-".$tmpStatus."<br>";
						if(($tmptingkatan==1 and $tmpStatus==1) or ($tmptingkatan==2 and $tmpStatus!="yes") or ($jabatanQ->tingkatan=="" and $tmpStatus==1)){
							echo "<i class='fa fa-circle-o' aria-hidden='true' style='color: green !important;'></i> <i class='fa fa-circle' aria-hidden='true' style='color: red !important'></i><br>";
						}else{
							echo "<i class='fa fa-circle' aria-hidden='true' style='color: green !important;'></i> <i class='fa fa-circle-o' aria-hidden='true' style='color: red !important'></i><br>";
						}
					//n
					$disposisio = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk INNER JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id =  notadinas.disposisi_surat_masuk.penerima_disposisi_satuan WHERE id_surat_masuk = '".$b->id."' ORDER BY urut_jabatan ASC")->result();
					foreach($disposisio as $u){
						$a1 = $q->satuan;
						$a2 = $q->tingkatan;
						$b1 = $u->satuan;
						$b2 = $u->tingkatan;
						$tmpJabatanu = $u->penerima_disposisi_satuan;
						$tmpStatusu = $u->disposisi;
						// echo $a1."".$a2;
						if($a1 == $b1 && $b2 == 2){
							// echo "asasa";
							$jabatanQu = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = $tmpJabatanu")->row();
						echo "".$jabatanQu->nama_jabatan . " : ";
						$tmptingkatanu = $jabatanQu->tingkatan;
						// echo "<br>".$tmptingkatan."-".$tmpStatus."<br>";
						if(($tmptingkatanu==1 and $tmpStatusu==1) or ($tmptingkatanu==2 and $tmpStatusu!="yes") or ($jabatanQu->tingkatan=="" and $tmpStatusu==1)){
							echo "<i class='fa fa-circle-o' aria-hidden='true' style='color: green !important;'></i> <i class='fa fa-circle' aria-hidden='true' style='color: red !important'></i><br>";
						}else{
							echo "<i class='fa fa-circle' aria-hidden='true' style='color: green !important;'></i> <i class='fa fa-circle-o' aria-hidden='true' style='color: red !important'></i><br>";
						}
							
						}
					}
					//n
						
					}
					// $disposisiQz = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk INNER JOIN notadinas.master_jabatan ON notadinas.master_jabatan.id =  notadinas.disposisi_surat_masuk.penerima_disposisi_satuan WHERE id_surat_masuk = $b->id ORDER BY urut_jabatan ASC")->result();
					$StatDispC+=1;
				// }
				echo "</td>";
			} ?>
			<td>
			<?php
			$arrayDisp = [];
			$arrDispJenis = [];
			foreach($disposisiQ as $q){
				if($q->penerima_disposisi!=null){
					$tmpJabatan = $q->penerima_disposisi;
					$tmpStatus = $q->status;
				}else{
					$tmpJabatan = $q->penerima_disposisi_satuan;
					$tmpStatus = $q->disposisi;
				}
				$arrayDisp[$tmpJabatan] = $tmpStatus;
				$arrDispJenis[$tmpJabatan] = $q->jenis;
			}
			$sm_waka = $this->db->query("SELECT * FROM notadinas.surat_masuk_waka WHERE surat_masuk = $b->id")->row();
			$sm_waka_status = "Belum Feedback";
			if(isset($sm_waka->status)){
				if($sm_waka->status == "Sudah Feedbak = Selesai"){
					$sm_waka_status = "Sudah Feedbak = Selesai";
				}
			}
			echo '<div class="btn-group">';
			if($b->status_surat_masuk==1 or $b->status_surat_masuk==30 or $b->status_surat_masuk==40){ // setum create
				if($jabatan==2){
			?>
				<a href="<?php echo base_URL()?>admin/surat_masuk/edited/<?php echo $b->id?>" class="btn btn-success btn-sm">Edit</a>
				<a href="<?php echo base_URL()?>admin/surat_masuk/kirim/<?php echo $b->id?>/<?php echo $b->kepada?>" class="btn btn-info btn-sm" title="Kirim" onclick="return confirm('Kirimkan surat?')" ><i class="icon-print icon-white"> </i>Kirim</a>
				<a href="<?php echo site_url('admin/surat_masuk/del/'.$b->id.''); ?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm">Hapus</a>
			<?php 
				}
			}elseif($b->status_surat_masuk==2){ // dikirim setum
				if($jabatan==1 or $jabatan==28){ // kapush/waka menerima ?>
					<a href="<?php echo base_URL()?>admin/surat_masuk/disp/<?php echo $b->id?>" class="btn btn-warning btn-sm" title="Lihat"><i class="icon-print icon-white"> </i>Disposisi</a>
			<?php }elseif($jabatan==2){ // dikirim setum?>
					<a href="<?php echo base_URL()?>admin/surat_masuk/edt/<?php echo $b->id?>" class="btn btn-default btn-sm" title="Lihat"> Lihat</a>
					<a href="#" class="btn btn-warning btn-sm"> Terkirim</a>
			<?php }
			}elseif($b->status_surat_masuk==3){ // kadis menerima
				if($jabatan==1 or $jabatan==28){ // kapush/waka sudah mengirim ?>
					<button onclick="baca(<?= $b->id ?>,'disp')" type="button" class="btn btn-success btn-sm" title="Terkirim">Terkirim <?= $nil; ?></button>
					<a target="_blank" href="<?php echo base_URL()?>admin/cetak_surat_masuk/<?php echo $b->id; ?>" class="btn btn-info btn-sm" title="Cetak"><i class="icon-print icon-white"> </i>Cetak</a>
			<?php }else if($tingkatan==1 and isset($arrayDisp[$jabatan])){ // kadis mendisposisi
					$kadisDisp = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = $b->id AND penerima_disposisi = $jabatan")->row();
					if(($kadisDisp!=NULL and $kadisDisp->status == 1) and isset($arrDispJenis[$jabatan]) and $arrDispJenis[$jabatan]=="INFORMASI"){?>
						<a href="<?php echo base_URL()?>admin/surat_masuk/kadisp/<?=$b->id;?>" class="btn btn-warning btn-sm" title="Lihat"> Proses</a>
					<?php }elseif(($kadisDisp!=NULL and $kadisDisp->disposisi == 'yes') or (isset($arrDispJenis[$jabatan]) and $arrDispJenis[$jabatan]=="INFORMASI")){
					?>
						<a href="<?php echo base_URL()?>admin/surat_masuk/kadisp/<?=$b->id;?>" class="btn btn-default btn-sm" title="Lihat"> Lihat</a>
						<?php
						if($sm_waka_status=="Sudah Feedbak = Selesai"){ ?>
						<a target="_blank" href="<?php echo base_URL()?>admin/cetak_surat_masuk/<?=$b->id;?>" class="btn btn-info btn-sm" title="Cetak">Cetak</a>
						<?php } ?>
					<?php }else{ ?>						
						<button type="button" onclick="bacaKadis(<?= $b->id ?>,'kadisp')"  class="btn btn-warning btn-sm" title="Proses"><i class="icon-print icon-white"> </i> Disposisi <?= $nil; ?></button>
					<?php } ?>
			<?php }else if($jabatan==2){ // info di setum
					$funZ = "edt";
					if($tingkatan==1 and isset($arrayDisp[$jabatan])){
						$funZ = "kadisp";						
					} ?>
					<a href="<?php echo base_URL()?>admin/surat_masuk/<?=$funZ;?>/<?=$b->id;?>" class="btn btn-default btn-sm" title="Lihat"> Lihat</a>
					<a href="#" class="btn btn-warning btn-sm"> Terkirim</a>
					<?php
					if($sm_waka_status=="Sudah Feedbak = Selesai"){ ?>
					<a target="_blank" href="<?php echo base_URL()?>admin/cetak_surat_masuk/<?=$b->id;?>" class="btn btn-info btn-sm" title="Cetak">Cetak</a>
					<?php }
				}elseif($tingkatan==2){ // info di kasubdis ?>
					<button onclick="bacasatuan(<?= $b->id ?>,'kadisp')" type="button" class="btn btn-success btn-sm" title="Terkirim">Lihat <?= $nil; ?></button>
					<?php if($sm_waka_status=="Sudah Feedbak = Selesai"){ ?>
					<a target="_blank" href="<?php echo base_URL()?>admin/cetak_surat_masuk/<?=$b->id;?>" class="btn btn-info btn-sm" title="Cetak">Cetak</a>
					<?php }
				}
			}elseif($b->status_surat_masuk==4){
				if($jabatan==1 or $jabatan==28){ // kapush/waka sudah mengirim ?>
					<button onclick="baca(<?= $b->id ?>,'disp')" type="button" class="btn btn-success btn-sm" title="Terkirim">Terkirim <?= $nil; ?></button>
					<a target="_blank" href="<?php echo base_URL()?>admin/cetak_surat_masuk/<?php echo $b->id; ?>" class="btn btn-info btn-sm" title="Cetak"><i class="icon-print icon-white"> </i>Cetak</a>
			<?php }elseif($jabatan==2){ ?>
					<a href="<?php echo base_URL()?>admin/surat_masuk/edt/<?=$b->id;?>" class="btn btn-default btn-sm" title="Lihat"> Lihat</a>
					<a href="#" class="btn btn-warning btn-sm"> Terkirim</a>
					<a target="_blank" href="<?php echo base_URL()?>admin/cetak_surat_masuk/<?=$b->id;?>" class="btn btn-info btn-sm" title="Cetak">Cetak</a>
				<?php }elseif($tingkatan==1){ ?>
					<button type="button" onclick="bacaKadis(<?= $b->id ?>,'kadisp')"  class="btn btn-warning btn-sm" title="Lihat">Lihat <?=$nil;?></button>
					<a target="_blank" href="<?php echo base_URL()?>admin/cetak_surat_masuk/<?=$b->id;?>" class="btn btn-info btn-sm" title="Cetak">Cetak</a>
				<?php }elseif($tingkatan==2){ ?>
					<button onclick="bacasatuan(<?= $b->id ?>,'subdisp')" type="button" class="btn btn-success btn-sm" title="Terkirim">Lihat <?= $nil; ?></button>
					<a target="_blank" href="<?php echo base_URL()?>admin/cetak_surat_masuk/<?=$b->id;?>" class="btn btn-info btn-sm" title="Cetak">Cetak</a>
				<?php }
			}
			echo '</div>';?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
</div>

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
function baca(e,j) {	
	$.get('<?= base_url()."administrator/baca_feedback" ?>',{id:e},function (data) {
		window.location.assign("<?php echo base_url();?>admin/surat_masuk/"+j+"/"+e);
	})
}
function bacasatuan(e,j) {
	$.get('<?= base_url()."administrator/baca_feedback_satuan" ?>',{id:e},function (data) {
		window.location.assign("<?php echo base_url();?>admin/surat_masuk/"+j+"/"+e);
	})
}
function bacaKadis(e,j) {
	$.get('<?= base_url()."administrator/baca_feedback_kadis" ?>',{id:e},function (data) {
		window.location.assign("<?php echo base_url();?>admin/surat_masuk/"+j+"/"+e);
	})
}
</script>