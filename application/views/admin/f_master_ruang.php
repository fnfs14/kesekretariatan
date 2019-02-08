<!-- breadcrumb -->
<ol class="breadcrumb breadcrumb-arrow">
    <li><a href="#"><i class="fa fa-home"></i></a></li>
    <li><a href="<?= base_url().'administrator/master_jenis_surat' ?>">  Master Ruang </a></li>
    <li class="active"><span>Tambah Master Ruang</span></li>
</ol>
<!-- End Breadcrumb -->
<div class="navbar navbar-inverse">
    <div class="container z0">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Form Master Ruang</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

<div class="row-fluid well" style="overflow: hidden">
	<div class="col-md-8">
		<div class="row">
			<form action="<?= base_url().'administrator/save_master_ruang' ?>" method="post">
				<div class="col-md-2">
					<div class="row">
					  Nama Ruang
				    </div>
			    </div>
				<div class="col-md-5">
					<input type="text" name="ruang" class="form-control">
				</div>

				<div class="col-md-offset-2">
					<button class="btn btn-info">Simpan</button>
				</div>

			</form>
		</div>
	</div>
</div>