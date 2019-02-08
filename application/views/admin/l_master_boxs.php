<div class="clearfix">
	<div class="row">
	  <div class="col-lg-12">
	  <!-- breadcrumb -->
		<ol class="breadcrumb breadcrumb-arrow">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li class="active"><span>Box</span></li>
		</ol>
		<!-- End Breadcrumb -->

		<div class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Box</a>
				</div>
			<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">

				<ul class="nav navbar-nav">
					<li><a href="<?php echo base_URL(); ?>admin/master_box/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>admin/master_box/cari">
						<input id="searchbox" type="text" class="form-control" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required>
						<!-- <button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button> -->
					</form>
				</ul>
			</div><!-- /.nav-collapse -->
			</div><!-- /.container -->
		</div><!-- /.navbar -->

	  </div>
	</div>
	<?php echo $this->session->flashdata("k"); ?>

	<center>
		<table class="table table-bordered table-hover" style="width: 50%;" id="zame">
			</center>
		<thead>
			<tr>
				<th width="">Id Box</th>
				<th width="">Nama Box</th>
				<th width="">Nama Rak</th>
				<th> Aksi </th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(empty($data)){
				echo "<tr><td colspan='2'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
			}else{
				foreach ($data as $key) {
				?>
					<tr>
						<td style="text-align: center;"><?php echo $key->id_box; ?></td>
						<td><?php echo $key->nama_box; ?></td>
						<td><?php echo $key->nama_rak; ?></td>
						<td class="ctr">
							<div class="btn-group">
								<a href="<?php echo base_URL(); ?>admin/master_box/edt/<?php echo $key->id_box; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Edit</a>
								<a href="<?php echo base_URL(); ?>admin/master_box/del/<?php echo $key->id_box?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Hapus</a>
							</div>
						</td>
					</tr>
				<?php
				}
			}
			?>
		</tbody>
	</table>

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
