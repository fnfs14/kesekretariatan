<div class="clearfix">
	<div class="row">
	  <div class="col-lg-12">
	  <!-- breadcrumb -->
		<ol class="breadcrumb breadcrumb-arrow">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li class="active"><span>Doktrin</span></li>
		</ol>
		<!-- End Breadcrumb -->

		<div class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Doktrin</a>
				</div>
			<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">

				<ul class="nav navbar-nav">
					<li><a href="<?php echo base_URL(); ?>admin/master_doktrin/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>admin/master_doktrin/cari">
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
		<table class="table table-bordered table-hover" style="width: 100%;" id="zame">
		<thead>
			<tr>
				<th width="">No</th>
				<th width="">Tanggal</th>
				<th width="">Kategori</th>
				<th width="">Judul Peraturan</th>
				<th width="">Deskripsi Peraturan</th>
				<th width="">Nama Buku</th>
				<th width="">Pengarang</th>
				<th width="">Judul Halaman</th>
				<th width="">Terbit</th>
				<th width="">Dokumen</th><!--ubah mei bahasa-->
				<th width="">Aksi</th>
			</tr>
		</thead>
		<tbody style="font-size: 13px;"><!--ubah master doktrin mei-->
			<?php
			if(empty($data)){
				echo "<tr><td colspan='11'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
			}else{
				$no = 1;
				foreach ($data as $value) {
				?>
					<tr>
						<td style="text-align: center;"><?php echo $no ?></td>
						<td><?php echo (date('d-m-Y', strtotime($value->tanggal))); ?></td><!--ubah master doktrin mei-->
						<td>
                            <?php foreach ($kategori as $value2):?>
                                <?php if($value2->id_kategori == $value->id_kategori):?>
                                    <?php echo $value2->nama_kategori ?>
                                <?php endif;?>
                            <?php endforeach;?>
                        </td>
						<td><?php echo $value->judul_peraturan ?></td>
						<td><?php echo substr($value->deskripsi_peraturan,0,58).'...'; ?></td>
						<td><?php echo substr($value->nama_buku,0,58).'...'; ?></td>
						<td><?php echo substr($value->pengarang,0,58).'...'; ?></td>
						<td><?php echo substr($value->judul_halaman,0,58).'...'; ?></td>
						<td><?php echo $value->terbit;?></td>
                        <td style="text-align: center;">
                        	<a href="<?php echo site_url('upload/master_doktrin/'.$value->file.'') ?>" class="btn btn-info" target="_blank"><span class="glyphicon glyphicon-download">Unduh</span></a></td><!--ubah mei bahasa-->
						<td style="text-align: center;">
							<div class="btn-group">
								<center><a href="<?php echo base_URL(); ?>admin/master_doktrin/edit/<?php echo $value->id_doktrin; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Edit</a></center>
								<center><a href="<?php echo base_URL(); ?>admin/master_doktrin/delete/<?php echo $value->id_doktrin?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Hapus</a></center>
							</div>
							<!-- <a class="btn btn-success" href="<?php //echo site_url('admin/master_doktrin/edit/'.$value->id_doktrin.''); ?>">Edit</a>
							<a class="btn btn-danger" href="<?php //echo site_url('admin/master_doktrin/delete/'.$value->id_doktrin.''); ?>" onclick="return confirm('Apakah anda yakin?')">Hapus</a> -->
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

