<!-- breadcrumb -->
<ol class="breadcrumb breadcrumb-arrow">
    <li><a href="#"><i class="fa fa-home"></i></a></li>
    <li><a href="<?= base_url().'administrator/arsip_surat_masuk' ?>"><i class="fa fa-plus-circle"></i> Tambah Tempat Arsip </a></li>
    <li class="active"><span>Tempat Arsip</span></li>
</ol>
<!-- End Breadcrumb -->
<div class="navbar navbar-inverse">
    <div class="container z0">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Tempat Arsip</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

<div class="row-fluid well" style="overflow: hidden">

	<div class="col-md-12">
		<div class="row">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th width="45px"> No</th>
						<th>Nama Jenis Surat</th>
						<th> Ruang</th>
						<th> Lemari</th>
						<th> Rak</th>
						<th> Box</th>
						<th> Hapus</th>
					</tr>
				</thead>
				<tbody>
				 <?php 
				 $no = 1;
				 foreach ($arsip as $val) { ?>
						<tr>
							<td><?= $no ?></td>
							<td><?= $val->nama_jenis_surat_masuk?></td>
							<td><?= $val->nama_ruang ?></td>
							<td><?= $val->nama_lemari ?></td>
							<td><?= $val->nama_rak ?></td>
							<td><?= $val->nama_box ?></td>
							<td><center><a href="<?= base_url().'administrator/hapus_tempat_arsip/'.$val->id_arisp_surat_masuk ?>" title="Hapus" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></center></td>
						</tr>
				 <?php $no++;} ?>
				</tbody>
			</table>
		</div>
	</div>


</div>