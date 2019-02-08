<!-- breadcrumb -->
<ol class="breadcrumb breadcrumb-arrow">
    <li><a href="#"><i class="fa fa-home"></i></a></li>
    <li><a href="<?= base_url().'administrator/master_box' ?>">  Master Box </a></li>
    <li class="active"><span>Tambah Master Box</span></li>
</ol>
<!-- End Breadcrumb -->
<div class="navbar navbar-inverse">
    <div class="container z0">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Form Master Box</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

<div class="row-fluid well" style="overflow: hidden">
	<div class="col-md-8">
		<div class="row">
			<form action="<?= base_url().'administrator/save_master_box' ?>" method="post">

				<div class="col-md-12">
					<div class="row">
					<div class="col-md-2">
						<div class="row">
						  Ruang
					    </div>
				    </div>
					<div class="col-md-5">
						<select class="form-control ruang" name="ruang">
							<option value="">PILIH RUANG</option>
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
						  Lemari
					    </div>
				    </div>
					<div class="col-md-5">
						<select class="form-control lemari" name="lemari">
							
						</select>
					</div>
					</div>
				</div>


				<br>
				<div class="col-md-12">
					<div class="row">
					<div class="col-md-2">
						<div class="row">
						   Rak
					    </div>
				    </div>
					<div class="col-md-5">
						<select class="form-control rak" name="rak">
							
						</select>
						
					</div>
					</div>
				</div>

				<br>
				<div class="col-md-12">
					<div class="row">
					<div class="col-md-2">
						<div class="row">
						  Nama Box
					    </div>
				    </div>
					<div class="col-md-5">
						<input type="text" class="form-control box" name="box">
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

<script type="text/javascript">
	$('.ruang').change(function () {
       var id =  $('.ruang option:selected').val();
      

       $.get('<?=  base_url().'administrator/get_lemari' ?>',{ids:id},function (data) {

           $('.lemari').html(data);
          
       })
    });


    $('.lemari').change(function () {
       var id =  $('.lemari option:selected').val();
       
       $.get('<?=  base_url().'administrator/get_rak' ?>',{ids:id},function (data) {
           $('.rak').html(data);
       })
    });
</script>