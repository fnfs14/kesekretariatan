<!-- breadcrumb -->
<ol class="breadcrumb breadcrumb-arrow">
    <li><a href="#"><i class="fa fa-home"></i></a></li>
    <li><a href="#"><i class="fa fa-envelope"></i> Tempat Arsip Surat Masuk</a></li>
    <li class="active"><span>Tambah Tempat Arsip</span></li>
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
	<form action="<?= base_url().'administrator/save_tempat_arsip' ?>" method="post">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-3 row">Jenis Surat</div>
				<div class="col-md-6">
					<select class="form-control jenis_surat" name="jenis_surat">
						<option>PILIH JENIS SURAT</option>
						 <?php foreach ($jenis_surat as $key => $js) { ?>

                           <option  <?php if(isset($datpil->id_jenis_surat_masuk)){

                            if($js->id_jenis_surat_masuk == $datpil->id_jenis_surat_masuk)echo "selected='selected'";
                           }  ?> nam="<?= $js->nama_jenis_surat ?>"  value="<?= $js->id_jenis_surat_masuk ?>" 


                            ><?= $js->nama_jenis_surat ?></option>
                        <?php  } ?>
					</select>

					<input type="hidden" name="jns" class="jns">
				</div>
			</div>

			<br>
			<div class="row">
				<div class="col-md-3 row">Ruang</div>
				<div class="col-md-6">
					<select class="form-control ruang" name="ruang">
						<option>PILIH RUANG</option>
						<?php foreach ($ruang as $re) { ?>
							
							<option nam="<?= $re->nama_ruang ?>" value="<?= $re->id_ruang ?>"><?= $re->nama_ruang ?></option>
						<?php } ?>
					</select>
					<input type="hidden" name="nm_ruang" class="nm_ruang">
				</div>
			</div>

			<br>
			<div class="row">
				<div class="col-md-3 row">Lemari</div>
				<div class="col-md-6">
					<select class="form-control lemari" name="lemari">
						<option>PILIH LEMARI</option>

					</select>

					<input type="hidden" name="nm_lemari" class="nm_lemari">
				</div>
			</div>

			<br>
			<div class="row">
				<div class="col-md-3 row">Rak</div>
				<div class="col-md-6">
					<select class="form-control rak" name="rak">
						<option>PILIH RAK</option>
					</select>

					<input type="hidden" name="nm_rak" class="nm_rak">
				</div>
			</div>


			<br>
			<div class="row">
				<div class="col-md-3 row">Box</div>
				<div class="col-md-6">
					<select class="form-control box" name="box">
						<option>PILIH BOX</option>
					</select>

					<input type="hidden" name="nm_box" class="nm_box">
				</div>
			</div>

			<br>
			<div class="row">
				<div class="col-md-3 row"></div>
				<div class="col-md-6">
					<button class="btn btn-info">Simpan</button>
				</div>
			</div>

		</div>
	</form>
</div>


<script type="text/javascript">
	 $('.ruang').change(function () {
       var id =  $('.ruang option:selected').val();
       var nm = $('.ruang option:selected').attr('nam');

        $('.nm_ruang').val(nm);

       $.get('<?=  base_url().'administrator/get_lemari' ?>',{ids:id},function (data) {

           $('.lemari').html(data);
          
       })


    });


	$('.lemari').change(function () {
       var id =  $('.lemari option:selected').val();
       var nm = $('.lemari option:selected').attr('nam');
       $('.nm_lemari').val(nm);
       $.get('<?=  base_url().'administrator/get_rak' ?>',{ids:id},function (data) {
           $('.rak').html(data);
       })
    });


     $('.rak').change(function () {
       var id =  $('.rak option:selected').val();
       var nm = $('.rak option:selected').attr('nam');
       $('.nm_rak').val(nm);

       $.get('<?=  base_url().'administrator/get_box' ?>',{ids:id},function (data) {
           $('.box').html(data);
       })
    });

     $('.box').change(function () {
     	var nm = $('.box option:selected').attr('nam');
        $('.nm_box').val(nm);
     })


     $('.jenis_surat').change(function () {
     	var nm = $('.jenis_surat option:selected').attr('nam');
        $('.jns').val(nm);
     })
</script>