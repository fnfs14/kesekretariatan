<div class="clearfix">
	<div class="row">
	  <div class="col-lg-12">
	  <!-- breadcrumb -->
		<ol class="breadcrumb breadcrumb-arrow">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li class="active"><span>Master Asal Surat</span></li>
		</ol>
		<!-- End Breadcrumb -->

		<div class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Master Asal Surat</a>
				</div>
			<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">

				<ul class="nav navbar-nav">
					<li><a href="<?php echo base_URL(); ?>administrator/master_tujuan/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>administrator/master_tujuan/cari">
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
		<table id="zame" class="table table-bordered table-hover" style="width: 50%;">
		<thead>
			<tr>
				<th width="">No</th>
				<th width="">Jenis Asal Surat</th>
				<th width="">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(empty($data)){
				echo "<tr><td colspan='2'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
			}else{
				$no = 1;
				foreach ($data as $key) {
				?>
					<tr>
						<td style="text-align: center;"><?php echo $no ?></td>
						<td><?php echo $key->nama; ?></td><!-- ubah mei asalsurat -->
						<td style="text-align: center;">
							<a class="btn btn-success" href="<?php echo site_url('administrator/master_tujuan/edit/'.$key->id.''); ?>">Edit</a>
							<a class="btn btn-danger" href="<?php echo site_url('administrator/master_tujuan/delete/'.$key->id.''); ?>" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
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
