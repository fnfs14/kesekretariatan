<div class="clearfix">
<div class="row">
  <div class="col-lg-12">
	<ol class="breadcrumb breadcrumb-arrow">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li class="active"><span>Pengaturan Jabatan</span></li>
		</ol>
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<span class="navbar-brand">Pengaturan Jabatan</span>
			</div>
		<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_URL(); ?>admin/manage_jabatan/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
			</ul> 
			
			<ul class="nav navbar-nav navbar-right">
				<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>admin/manage_jabatan/cari">
					<input type="text" class="form-control" id="searchbox" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required><!-- ubah mei admin -->
					<!-- <button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button> --><!-- ubah mei admin -->
				</form>
			</ul>
		</div><!-- /.nav-collapse -->
		</div><!-- /.container -->
	</div><!-- /.navbar -->

  </div>
</div>

<?php echo $this->session->flashdata("k");?>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#jabshow">Data Jabatan</a></li>
  <li><a data-toggle="tab" href="#subshow">Data Sub Jabatan</a></li>
</ul>
<div class="tab-content">
	<div id="jabshow" class="tab-pane fade in active">
	<center>
	<table class="table table-bordered table-hover" id="zame">
		<thead>
			<tr>
				<th width="10%">ID</th>
				<th width="33%">Nama Jabatan</th>
				<th width="23%">Nama Satuan Kerja</th>
				<th width="10%">Tingkatan</th>
				<th width="14%">Urutan View</th>
				<th width="20%">Aksi</th>
			</tr>
		</thead>
		
		<tbody>
			<?php 
			$nos=1;
			if (empty($data)) {
				echo "<tr><td colspan='5'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
			} else {
				$no 	= ($this->uri->segment(4) + 1);
				foreach ($data as $b) {
			?>
			<tr>
				<td class="ctr"><?php echo $nos++;?></td>
				<td><?php echo $b->nama_jabatan?></td>
				<td><?php echo $b->nama_satuan?></td>
				<td><?php echo $b->tingkatan ?></td>
				<td><center><?php echo $b->urutan_view ?></center></td>
				<td class="ctr">
					<div class="btn-group">
						<a href="<?php echo base_URL(); ?>admin/manage_jabatan/edt/1/<?php echo $b->ids; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Edit&nbsp;&nbsp;&nbsp;&nbsp;</a>
						<a href="<?php echo base_URL(); ?>admin/manage_jabatan/del/1/<?php echo $b->ids?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Hapus</a> <!--ubah mei bahasa-->		
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
	</center>
	</div>

	<div id="subshow" class="tab-pane fade">
	<center>
	<table class="table table-bordered table-hover" id="zame2">
		<thead>
			<tr>
				<th width="10%">ID</th>
				<th width="35%">Nama Sub Jabatan</th>
				<th width="35%">Nama Satuan Kerja</th>
				<th width="10%">Tingkatan</th>
				<th width="10%">Aksi</th>
			</tr>
		</thead>
		
		<tbody>
			<?php 
			$nosu=1;
			if (empty($data2)) {
				echo "<tr><td colspan='5'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
			} else {
				$no 	= ($this->uri->segment(4) + 1);
				foreach ($data2 as $b) {
			?>
			<tr>
				<td class="ctr"><?php echo $nosu++;?></td>
				<td><?php echo $b->nama_jabatan?></td>
				<td><?php echo $b->nama_satuan?></td>
				<td><?php echo $b->tingkatan ?></td>
				<td class="ctr">
					<div class="btn-group">
						<a href="<?php echo base_URL(); ?>admin/manage_jabatan/edt/2/<?php echo $b->ids; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Edit</a>
						<!-- <a href="<?php echo base_URL(); ?>admin/manage_jabatan/del/2/<?php echo $b->ids?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Hap</a> --><!--ubah mei bahasa-->		
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
