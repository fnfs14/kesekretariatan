<div class="clearfix">
<div class="row">
  <div class="col-lg-12">
	<ol class="breadcrumb breadcrumb-arrow">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li class="active"><span>Pengaturan User</span></li>
		</ol>
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<span class="navbar-brand">Pengaturan User</span>
			</div>
		<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_URL(); ?>admin/manage_admin/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
			</ul> 
			
			<ul class="nav navbar-nav navbar-right">
				<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>admin/manage_admin/cari">
					<input type="text" class="form-control" id="searchbox" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required><!--ubah mei admin -->
					<!-- <button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button> --><!--ubah mei admin -->
				</form>
			</ul>
		</div><!-- /.nav-collapse -->
		</div><!-- /.container -->
	</div><!-- /.navbar -->

  </div>
</div>

<?php echo $this->session->flashdata("k");?>
<center>
<table class="table table-bordered table-hover" id="zame" style="width: 90%;">
	<thead>
		<tr>
			<th width="5%">ID</th>
			<th width="20%">Username</th>
			<th width="20%">Nama</th>
			<th width="20%">Email</th>
			<th width="10%">Level</th>
			<th width="15%">Aksi</th>
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
			<td><?php echo $b->username?></td>
			<td><?php echo $b->nama_lengkap?></td>
			<td><?php echo $b->email ?></td>
			<td><?php echo $b->level ?></td>
			<td class="ctr">
				<div class="btn-group">
					<a href="<?php echo base_URL(); ?>admin/manage_admin/edt/<?php echo $b->id; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Edt</a>
					<a href="<?php echo base_URL(); ?>admin/manage_admin/del/<?php echo $b->id?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Hap</a><!--ubah mei bahasa-->	
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
<script>
$(window).load(function(){
    $('#zame').DataTable({
    	"searching": true,
    	 "bLengthChange" : false,
    	"bInfo":false
    });
} );

$(window).load(function(){
    var dataTable = $('#zame').dataTable();
    $("#searchbox").keyup(function() {
        dataTable.fnFilter(this.value);
    });
});
</script>
