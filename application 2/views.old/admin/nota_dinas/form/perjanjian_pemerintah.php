
<?php
if ($action == "edit_nota") {
	$id				= $request->ID;
	$nomor1			= $detail->nomor1;
	$nomor2			= $detail->nomor2;
	$instansi1		= $detail->instansi1;
	$jabatan1		= $detail->jabatan1;
	$nama1			= $detail->nama1;
	$instansi2		= $detail->instansi2;
	$jabatan2		= $detail->jabatan2;
	$nama2			= $detail->nama2;
	$program 		= $detail->program;
	$pasal 			= $pasal;
	
} else {
	$id				= $request->ID;
	$nomor1			= '';
	$nomor2			= '';
	$instansi1		= '';
	$jabatan1		= '';
	$nama1			= '';
	$instansi2		= '';
	$jabatan2		= '';
	$nama2			= '';
	$program 		= '';

	$pasal 			= [];
	$pasal[0] = new \stdClass();
	$pasal[0]->judul = '';
	$pasal[0]->isi = '';
	$pasal[1] = new \stdClass();
	$pasal[1]->judul = 'RUANG LINGKUP KERJA SAMA';
	$pasal[1]->isi = '';
	$pasal[2] = new \stdClass();
	$pasal[2]->judul = 'PELAKSAANAAN KEGIATAN';
	$pasal[2]->isi = '';
	$pasal[3] = new \stdClass();
	$pasal[3]->judul = 'PEMBIAYAAN';
	$pasal[3]->isi = '';
	$pasal[4] = new \stdClass();
	$pasal[4]->judul = 'PENYELESAIAN PERSELISIHAN';
	$pasal[4]->isi = '';
	$pasal[5] = new \stdClass();
	$pasal[5]->judul = 'LAIN-LAIN';
	$pasal[5]->isi = '';
	$pasal[6] = new \stdClass();
	$pasal[6]->judul = 'PENUTUP';
	$pasal[6]->isi = '';

	
}
?>
			<h2>Nomor Surat</h2><br>
			<div class="form-group">
				<div class="col-lg-6">
					<div class="form-group">
				        <label class="col-xs-2">Nomor Surat 1</label>
				        <div class="col-xs-10">
				            <input type="text" name="nomor1" autofocus tabindex="1" class="form-control" value='<?php echo $nomor1; ?>'>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
				        <label class="col-xs-2">Nomor Surat 2</label>
				        <div class="col-xs-10">
				            <input type="text" name="nomor2" autofocus tabindex="1" class="form-control" value='<?php echo $nomor2; ?>'>
				        </div>
				    </div>
				</div>
			</div>
			<hr style="border-color:#cccccc">
			<h2>Kerjasama Antara</h2>
			<div class="form-group">
				<div class="col-lg-6">
					<h3>Pihak I</h3><br>
					<div class="form-group">
				        <label class="col-xs-2">Instansi</label>
				        <div class="col-xs-10">
				            <input type="text" name="instansi1" autofocus tabindex="1" class="form-control" value='<?php echo $instansi1; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-2">Jabatan</label>
				        <div class="col-xs-10">
				            <input type="text" name="jabatan1" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan1; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-2">Nama</label>
				        <div class="col-xs-10">
				            <input type="text" name="nama1" autofocus tabindex="1" class="form-control" value='<?php echo $nama1; ?>'>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">
					<h3>Pihak II</h3><br>
					<div class="form-group">
				        <label class="col-xs-2">Instansi</label>
				        <div class="col-xs-10">
				            <input type="text" name="instansi2" autofocus tabindex="1" class="form-control" value='<?php echo $instansi2; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-2">Jabatan</label>
				        <div class="col-xs-10">
				            <input type="text" name="jabatan2" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan2; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-2">Nama</label>
				        <div class="col-xs-10">
				            <input type="text" name="nama2" autofocus tabindex="1" class="form-control" value='<?php echo $nama2; ?>'>
				        </div>
				    </div>
				</div>
			</div>
			<hr style="border-color:#cccccc">
			<h2>Detail</h2><br>
			
			<div class="form-group">
				<div class="form-group col-xs-12">
			        <label class="col-xs-2">Program</label>
			        <div class="col-xs-10">
			            <input type="text" name="program" autofocus tabindex="1" class="form-control" value='<?php echo $program ?>'>
			        </div>
			    </div>
			</div>

			<hr style="border-color:#cccccc">
			<h2>Ketentuan</h2><br>
			<div class="dynamic_field">
			    <div class="form-group row">
			        <label class="col-xs-2">Pasal</label>
			        <button type="button" class="btn btn-default addButton col-xs-8" tabindex="1" autofocus><b>+</b></button>
			    </div>

			    <?php foreach ($pasal as $key => $value) { ?>
				    <div class="form-group clone">
				    	<div class="form-group">
					        <label class="col-xs-2"></label>
					        <div class="col-xs-1">
					            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
					        </div>
					        <div class="col-xs-7">
					        	<div class="form-group">
					        		<input name="judul_pasal[]" type="text" class="form-control" tabindex="1" autofocus placeholder="Judul Pasal" value="<?php echo $value->judul?>">
					        	</div>
					        	<div class="form-group">
							        <textarea name="isi_pasal[]" class="form-control editor-field" id="isi_pasal[<?php echo $key ?>]" tabindex="1" autofocus placeholder="Isi Pasal ....."><?php echo $value->isi?></textarea>
					        	</div>
					        </div>
					    </div>
				    </div>
			    <?php } ?>

			    <div class="form-group template hide">
			    	<div class="form-group">
				        <label class="col-xs-2"></label>
				        <div class="col-xs-1">
				            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
				        </div>
				        <div class="col-xs-7">
				        	<div class="form-group">
				        		<input name="judul_pasal[]" type="text" class="form-control" tabindex="1" autofocus placeholder="Judul Pasal">
				        	</div>
				        	<div class="form-group">
						        <textarea name="isi_pasal[]" class="form-control editor-field" id="isi_pasal[]" tabindex="1" autofocus placeholder="Isi Pasal ....."></textarea>
				        	</div>
				        </div>
				    </div>
			    </div>
			</div>