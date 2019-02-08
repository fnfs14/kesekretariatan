<!-- breadcrumb -->
<ol class="breadcrumb breadcrumb-arrow">
    <li><a href="#"><i class="fa fa-home"></i></a></li>
    <li><a href="<?= base_url().'administrator/add_master_rak' ?>"><i class="fa fa-plus-circle"></i> Tambah Master Rak </a></li>
    <li class="active"><span>Master Rak</span></li>
</ol>
<!-- End Breadcrumb -->
<div class="navbar navbar-inverse">
    <div class="container z0">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Master Rak</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

<div class="row-fluid well" style="overflow: hidden">
	<div class="col-md-8">
		<div class="row">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th width="45px">No</th>
						<th>Nama</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					foreach ($rak as $val) { ?>
						<tr>
							<td><?= $no ?></td>
							<td><?= $val->nama_rak ?></td>
							<td><center><a title="hapus" href="<?= base_url().'administrator/hapus_master_rak/'.$val->id_rak ?>" class="btn btn-sm btn-danger">Hapus</a></center></td>
						</tr>
					<?php $no++;} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>