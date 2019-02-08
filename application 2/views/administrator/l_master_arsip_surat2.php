<div class="clearfix">
	<div class="row">
	  <div class="col-lg-12">
	  <!-- breadcrumb -->
		<ol class="breadcrumb breadcrumb-arrow">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li class="active"><span>Master Arsip Surat</span></li>
		</ol>
		<!-- End Breadcrumb -->

		<div class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Master Arsip Surat</a>
				</div>
			<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">

				<ul class="nav navbar-nav">
					<li><a href="<?php echo base_URL(); ?>administrator/master_arsip_surat/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
					<li>
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes" class="btn-info">Surat yang belum terarsip<span class="caret" style="border-top-color: white; border-bottom-color: white;"></span></a>
						  <ul class="dropdown-menu" aria-labelledby="themes">
							<li><a tabindex="-1" href="<?php echo base_url(); ?>administrator/master_arsip_surat/m_arsip_surat_keluar">Surat Keluar</a></li>
							<li><a tabindex="-1" href="<?php echo base_url(); ?>administrator/master_arsip_surat/m_arsip_surat_masuk">Surat Masuk</a></li>
						  </ul>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<?php if($q==0){ ?>
					<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>administrator/master_arsip_surat/cari">
					<?php }else if($q==1){ ?>
					<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>administrator/master_arsip_surat/cari2">
					<?php }else{ ?>
					<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>administrator/master_arsip_surat/cari3">
					<?php } ?>
						<input type="text" class="form-control" id="searchbox" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required><!-- ubah mei admin -->
						<!-- <button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button> -->
					</form>
				</ul>
			</div><!-- /.nav-collapse -->
			</div><!-- /.container -->
		</div><!-- /.navbar -->

	  </div>
	</div>
	<?php echo $this->session->flashdata("k"); ?>
	<?php if($this->uri->segment(3) == "m_arsip_surat"){?>
	<ul class="nav nav-tabs">
	  <li class="active"><a data-toggle="tab" href="#home">Arsip Surat Masuk</a></li>
	  <li><a data-toggle="tab" href="#menu1">Arsip Surat Keluar</a></li>
	</ul>
	<?php } else {} ?>
	<div class="tab-content">
	  <div id="home" class="tab-pane fade in active">
	    <center>
		<table class="table table-bordered table-hover" style="width: 100%;"  id="zame">
		<thead>
			<tr>
				<th width="">No</th>
				<th width="">No Agenda</th><?php if($q==0){ ?>
				<th width="">Jenis</th>
				<th width="">Perihal</th>
				<th width="">Nama Ruangan</th>
				<th width="">Nama Lemari</th>
				<th width="">Nama Rak</th>
				<th width="">Nama Box</th>
				<th width="">Aksi</th><?php }else{ ?>
				<th width="">Perihal</th><?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php
			if(empty($data)){
				echo "<tr><td colspan='10'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
			}else{
				$no = 1;
				foreach ($data as $key) {
				?>
					<tr>
						<td style="text-align: center;"><?php echo $no ?></td>
						<td><?php echo $key->agenda; ?></td><?php if($q==0){ ?>
						<td><?php
							$exp = explode('_',$key->tipe_surat);
							echo "<span style='text-transform:capitalize;'>$exp[0] $exp[1]</span>"
						?></td>
						<td><?php echo $key->perihal; ?></td>
						<td><?php echo $key->nama_ruang; ?></td>
						<td><?php echo $key->nama_lemari; ?></td>
						<td><?php echo $key->nama_rak; ?></td>
						<td><?php echo $key->nama_box; ?></td>
						<td style="text-align: center;">
							<!-- <a class="btn btn-success" href="<?php //echo site_url('administrator/master_arsip_surat/edit/'.$key->id_arsip_surat.''); ?>">Edit</a>
							<a class="btn btn-danger" href="<?php //echo site_url('administrator/master_arsip_surat/delete/'.$key->id_arsip_surat.''); ?>" onclick="return confirm('Apakah anda yakin?')">Hapus</a> -->
							<div class="btn-group">
								<center><a href="<?php echo base_URL(); ?>administrator/master_arsip_surat/edit/<?php echo $key->id_arsip_surat; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Edit</a></center>
								<center><a href="<?php echo base_URL(); ?>administrator/master_arsip_surat/delete/<?php echo $key->id_arsip_surat?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Hapus</a></center>
							</div>
						</td><?php }else{ ?>
						<td><?php echo $key->perihal; ?></td><?php } ?>
					</tr>
				<?php
				$no++;
				}
			}
			?>
		</tbody>
	</table>
<center><ul class="pagination"><?php ?></ul></center>
</center>
	  </div>
	  <div id="menu1" class="tab-pane fade">
	    <center>
		<table class="table table-bordered table-hover" style="width: 100%;"  id="zame2">
		<thead>
			<tr>
				<th width="">No</th>
				<th width="">No Agenda</th><?php if($q==0){ ?>
				<th width="">Jenis</th>
				<th width="">Perihal</th>
				<th width="">Nama Ruangan</th>
				<th width="">Nama Lemari</th>
				<th width="">Nama Rak</th>
				<th width="">Nama Box</th>
				<th width="">Aksi</th><?php }else{ ?>
				<th width="">Perihal</th><?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php
			if(empty($datas)){
				echo "<tr><td colspan='10'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
			}else{
				$no = 1;
				foreach ($datas as $key) {
				?>
					<tr>
						<td style="text-align: center;"><?php echo $no ?></td>
						<td><?php echo $key->agenda; ?></td><?php if($q==0){ ?>
						<td><?php
							$exp = explode('_',$key->tipe_surat);
							echo "<span style='text-transform:capitalize;'>$exp[0] $exp[1]</span>"
						?></td>
						<td><?php echo $key->perihal; ?></td>
						<td><?php echo $key->nama_ruang; ?></td>
						<td><?php echo $key->nama_lemari; ?></td>
						<td><?php echo $key->nama_rak; ?></td>
						<td><?php echo $key->nama_box; ?></td>
						<td style="text-align: center;">
							<!-- <a class="btn btn-success" href="<?php //echo site_url('administrator/master_arsip_surat/edit/'.$key->id_arsip_surat.''); ?>">Edit</a>
							<a class="btn btn-danger" href="<?php //echo site_url('administrator/master_arsip_surat/delete/'.$key->id_arsip_surat.''); ?>" onclick="return confirm('Apakah anda yakin?')">Hapus</a> -->
							<div class="btn-group">
								<center><a href="<?php echo base_URL(); ?>administrator/master_arsip_surat/edit/<?php echo $key->id_arsip_surat; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Edit</a></center>
								<center><a href="<?php echo base_URL(); ?>administrator/master_arsip_surat/delete/<?php echo $key->id_arsip_surat?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Hapus</a></center>
							</div>
						</td><?php }else{ ?>
						<td><?php echo $key->perihal; ?></td><?php } ?>
					</tr>
				<?php
				$no++;
				}
			}
			?>
		</tbody>
	</table>
<!-- <center><ul class="pagination"><?php //echo $pagik; ?></ul></center> -->
</center>
	  </div>
	</div>
</div>
<script>
$(window).load(function(){
    $('#zame').DataTable({
    	"searching": true,
    	 "bLengthChange" : false,
    	"bInfo":false
    });
});
$(window).load(function(){
    $('#zame2').DataTable({
    	"searching": true,
    	 "bLengthChange" : false,
    	"bInfo":false
    });
    document.getElementById('zame2_filter').style.display = "none";
});

$(window).load(function(){
    var dataTable = $('#zame').dataTable();
    var dataTable2 = $('#zame2').dataTable();
    $("#searchbox").keyup(function() {
        dataTable.fnFilter(this.value);
        dataTable2.fnFilter(this.value);
    });
});
</script>
