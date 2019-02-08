<div class="clearfix">
	<div class="row">
	  <div class="col-lg-12">
	  <!-- breadcrumb -->
		<ol class="breadcrumb breadcrumb-arrow">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li class="active"><span>Task</span></li>
		</ol>
		<!-- End Breadcrumb -->
		
		<div class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Task</a>
				</div>
			<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
				
				<ul class="nav navbar-nav">
					<li><a href="<?php echo base_URL(); ?>admin/manage_task/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>admin/task/cari">
						<input type="text" class="form-control" id="searchbox" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required><!-- ubah mei tasknya -->
						<!-- <button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button> --><!-- ubah mei tasknya -->
					</form>
				</ul>
			</div><!-- /.nav-collapse -->
			</div><!-- /.container -->
		</div><!-- /.navbar -->

	  </div>
	</div>
	<?php echo $this->session->flashdata("k"); ?>

	<center>
		<table class="table table-bordered table-hover" style="width: 100%;"  id="zame"><!-- ubah mei tasknya -->
		<thead>
			<tr>
				<th width="10%">No</th>
				<th width="30%">Nama Task</th>
				<th width="30%">Ruang Kerja</th>
				<th width="30%">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if(empty($data)){
				echo "<tr><td colspan='4'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
			}else{
				$kjewjhele = 0;
				foreach ($data as $key) {
				?>
					<tr>
						<td style="text-align: center;"><?php echo $kjewjhele = $kjewjhele + 1; ?></td>
						<td><?php echo $key->nama_task; ?></td>
						<td>
							<?php 
								foreach ($data2 as $key2) {
									if($key2->id_ruang_kerja==$key->id_etask){
										echo $key2->nama_krj;
									}
								}
							?>
						</td>
						<td style="text-align: center;">
							<a href="<?php echo base_URL(); ?>admin/manage_task/edt/<?php echo $key->id_task; ?>" class="btn btn-success" title="Edit Data"> Ubah</a>
							<a class="btn btn-danger" href="<?php echo site_url('admin/manage_task/delete/'.$key->id_task.''); ?>" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
						</td>
					</tr>
				<?php
				}
			}
			?>
		</tbody>
	</table>
</center>
</div>
<!-- ubah mei tasknya -->
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