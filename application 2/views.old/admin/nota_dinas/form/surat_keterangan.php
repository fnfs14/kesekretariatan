
<?php
if ($action == "edit_nota") {
	$id				= $request->ID;
	$logo		= $detail->logo;
	$nama_instansi = $detail->nama_instansi;
	$alamat_instansi = $detail->alamat_instansi;
	$telepon_instansi	= $detail->telepon_instansi;
	$faksimile_instansi = $detail->faksimile_instansi;
	$nomor		= $detail->nomor;
	$nama_pemberi = $detail->nama_pemberi;
	$nip_pemberi = $detail->nip_pemberi;
	$jabatan_pemberi = $detail->jabatan_pemberi;
	$nama_subjek = $detail->nama_subjek;
	$nip_subjek = $detail->nip_subjek;
	$pangkat_subjek = $detail->pangkat_subjek;
	$jabatan_subjek = $detail->jabatan_subjek;
	$keterangan = $detail->keterangan;
	$tempat 			= $detail->tempat;
	$tanggal = $detail->tanggal;
	
} else {
	$id				= $request->ID;
	$logo		= '';
	$nama_instansi = '';
	$alamat_instansi = '';
	$telepon_instansi	= '';
	$faksimile_instansi = '';
	$nomor		= '';
	$nama_pemberi = '';
	$nip_pemberi = '';
	$jabatan_pemberi = '';
	$nama_subjek = '';
	$nip_subjek = '';
	$pangkat_subjek = '';
	$jabatan_subjek = '';
	$keterangan = '';
	$tempat 			= '';
	$tanggal = '';
}
?>

			<h2>Data Instansi</h2><br>
			<div class="form-group">
				<div class="col-lg-6">
				    <div class="form-group">
				        <label class="col-xs-4">Logo<br>(.gif/.jpg/.png)</label>
				        <div class="image_field" file_index="0">
				        	<div class="col-xs-6">
				        		<input type="file" accept="image/*" name="logo" autofocus tabindex="1" class="form-control file">
				        	</div>
				        	<div class="col-xs-4 current_image">
				        		<?php if($logo != "") {?>
									<img alt="Current Logo" src="<?php echo base_url().$logo; ?>" style="border-width: 0px; border-style: solid;max-height: 100px; max-width: 100px;">
								<?php } ?>
				        	</div>
				        	<div class="col-xs-4 selected_image hide">
				        		<img alt="Selected Logo" src="" style="border-width: 0px; border-style: solid; max-height: 100px; max-width: 100px">
				        	</div>
				        </div>

				    </div>

				    <div class="form-group">
				        <label class="col-xs-4">Nama Instansi</label>
				        <div class="col-xs-6">
				            <input type="text" name="nama_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $nama_instansi; ?>'>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">
					
				    <div class="form-group">
				        <label class="col-xs-4">Alamat Instansi</label>
				        <div class="col-xs-6">
				            <input type="text" name="alamat_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $alamat_instansi; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-4">Telepon Instansi</label>
				        <div class="col-xs-6">
				            <input type="text" name="telepon_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $telepon_instansi; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-4">Faksimile Instansi</label>
				        <div class="col-xs-6">
				            <input type="text" name="faksimile_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $faksimile_instansi; ?>'>
				        </div>
				    </div>
				</div>
			</div>

			<hr style="border-color:#cccccc">
			<h2>Data Umum Surat</h2><br>
			<div class="form-group col-xs-12">
				<div class="form-group">
			    	<div class="col-lg-4">
			    		<div class="form-group">
					        <label class="col-xs-2">Nomor</label>
					        <div class="col-xs-10">
					            <input type="text" name="nomor" autofocus tabindex="1" class="form-control" value='<?php echo $nomor; ?>'>
					        </div>
					    </div>
			    	</div>
			    	<div class="col-lg-4">
			    		<div class="form-group">
					        <label class="col-xs-2">Tempat</label>
					        <div class="col-xs-10">
					            <input type="text" name="tempat" autofocus tabindex="1" class="form-control" value='<?php echo $tempat; ?>'>
					        </div>
					    </div>
			    	</div>
			    	<div class="col-lg-4">
			    		<div class="form-group">
					        <label class="col-xs-2">Tanggal</label>
					        <div class="col-xs-10">
					            <input type="text" name="tanggal" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal; ?>'>
					        </div>
					    </div>
			    	</div>
			    </div>
		    </div>


			<hr style="border-color:#cccccc">
			<h2>Isi Naskah</h2>

			<div class="form-group col-xs-12">
			    <div class="form-group">
			    	<div class="col-lg-6">
			    		<center><h3>Pemberi Keterangan</h3></center><br>
			    		<div class="form-group">
					        <label class="col-xs-2">Nama</label>
					        <div class="col-xs-10">
					            <input type="text" name="nama_pemberi" autofocus tabindex="1" class="form-control" value='<?php echo $nama_pemberi; ?>'>
					        </div>
					    </div>
					    <div class="form-group">
					        <label class="col-xs-2">NIP</label>
					        <div class="col-xs-10">
					            <input type="text" name="nip_pemberi" autofocus tabindex="1" class="form-control" value='<?php echo $nip_pemberi; ?>'>
					        </div>
					    </div>
					    <div class="form-group">
					        <label class="col-xs-2">Jabatan</label>
					        <div class="col-xs-10">
					            <input type="text" name="jabatan_pemberi" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan_pemberi; ?>'>
					        </div>
					    </div>
			    	</div>
			    	<div class="col-lg-6">
			    		<center><h3>Subjek Keterangan</h3></center><br>
			    		<div class="form-group">
					        <label class="col-xs-2">Nama</label>
					        <div class="col-xs-10">
					            <input type="text" name="nama_subjek" autofocus tabindex="1" class="form-control" value='<?php echo $nama_subjek; ?>'>
					        </div>
					    </div>
					    <div class="form-group">
					        <label class="col-xs-2">NIP</label>
					        <div class="col-xs-10">
					            <input type="text" name="nip_subjek" autofocus tabindex="1" class="form-control" value='<?php echo $nip_subjek; ?>'>
					        </div>
					    </div>
					    <div class="form-group">
					        <label class="col-xs-2">Pangkat / Golongan</label>
					        <div class="col-xs-10">
					            <input type="text" name="pangkat_subjek" autofocus tabindex="1" class="form-control" value='<?php echo $pangkat_subjek; ?>'>
					        </div>
					    </div>
					    <div class="form-group">
					        <label class="col-xs-2">Jabatan</label>
					        <div class="col-xs-10">
					            <input type="text" name="jabatan_subjek" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan_subjek; ?>'>
					        </div>
					    </div>
			    	</div>
			    </div>
			    <hr style="border-color:#e6e6e6">
			    <div class="form-group">
			        <label class="col-xs-1">Isi Keterangan</label>
			        <div class="col-xs-11">
			        	<textarea name="keterangan" id="keterangan" class="form-control editor-field" autofocus tabindex="1"><?php echo $keterangan ?></textarea>
			        </div>
			    </div>
			</div>