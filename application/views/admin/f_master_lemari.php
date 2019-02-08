<!-- breadcrumb -->
<ol class="breadcrumb breadcrumb-arrow">
    <li><a href="#"><i class="fa fa-home"></i></a></li>
    <li><a href="<?= base_url().'administrator/master_jenis_surat' ?>">  Master Lemari </a></li>
    <li class="active"><span>Tambah Master Lemari</span></li>
</ol>
<!-- End Breadcrumb -->
<div class="navbar navbar-inverse">
    <div class="container z0">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Form Master Lemari</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

<div class="row-fluid well" style="overflow: hidden">
	<div class="col-md-8">
		<div class="row">
			<form action="<?= base_url().'administrator/save_master_lemari' ?>" method="post">

				<div class="col-md-12">
					<div class="row">
					<div class="col-md-2">
						<div class="row">
						  Nama Ruang
					    </div>
				    </div>
					<div class="col-md-5">
						<select class="form-control" name="ruang">
							<?php foreach ($ruang as $re) { ?>
								<option value="<?= $re->id_ruang ?>"><?= $re->nama_ruang ?></option>
						    <?php } ?>
						</select>
					</div>
					</div>
				</div>

				<br>
				<div class="col-md-12">
					<div class="row">
					<div class="col-md-2">
						<div class="row">
						  Nama Lemari
					    </div>
				    </div>
					<div class="col-md-5">
						<input type="text" name="lemari" class="form-control">
					</div>
					</div>
				</div>


				<br>
				<div class="col-md-12">
					<div class="row">
					<div class="col-md-2">
						<div class="row">
						  
					    </div>
				    </div>
					<div class="col-md-5">
						<button class="btn btn-info">Simpan</button>
					</div>
					</div>
				</div>
				
				
				<!-- <div class="col-md-offset-2">
					<button class="btn btn-info">Simpan</button>
				</div> -->

			</form>
		</div>
	</div>
</div>