
<?php
if ($action == "edit_nota") {
	$id			= $request->ID;
	$nama_instansi = $detail->nama_instansi;
	$alamat_instansi = $detail->alamat_instansi;
	$telepon_instansi	= $detail->telepon_instansi;
	$faksimile_instansi = $detail->faksimile_instansi;
	$tanggal_surat 	= $detail->tanggal_surat;
	$yth 		= $detail->yth;
	$alamat_yth = $detail->alamat_yth;
	$nomor 		= $detail->nomor;
	$tanggal_diterima 	= $detail->tanggal_diterima;
	$jabatan_penerima = $detail->jabatan_penerima;
	$nama_penerima = $detail->nama_penerima;
	$nip_penerima = $detail->nip_penerima;
	$telepon_penerima = $detail->telepon_penerima;
	$jabatan_pengirim = $detail->jabatan_pengirim;
	$nama_pengirim = $detail->nama_pengirim;
	$nip_pengirim = $detail->nip_pengirim;
	$naskah_dinas 	= $naskah_dinas;
	
	
} else {
	$id			= $request->ID;
	$nama_instansi = '';
	$alamat_instansi = '';
	$telepon_instansi	= '';
	$faksimile_instansi = '';
	$tanggal_surat 	= '';
	$yth 		= '';
	$alamat_yth = '';
	$nomor 		= '';
	$tanggal_diterima 	= '';
	$jabatan_penerima = '';
	$nama_penerima = '';
	$nip_penerima = '';
	$telepon_penerima = '';
	$jabatan_pengirim = '';
	$nama_pengirim = '';
	$nip_pengirim = '';
	$naskah_dinas 	= [];
}
?>
		    
		    <div class="form-group">
		    	<div class="col-lg-6">
			    	<h2>Data Instansi</h2><br>
				    <div class="form-group">
				        <label class="col-xs-2">Nama Instansi</label>
				        <div class="col-xs-10">
				            <input type="text" name="nama_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $nama_instansi; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Alamat Instansi</label>
				        <div class="col-xs-10">
				            <input type="text" name="alamat_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $alamat_instansi; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Telepon Instansi</label>
				        <div class="col-xs-10">
				            <input type="text" name="telepon_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $telepon_instansi; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Faksimile Instansi</label>
				        <div class="col-xs-10">
				            <input type="text" name="faksimile_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $faksimile_instansi; ?>'>
				        </div>
				    </div>
			    </div>

			    <div class="col-lg-6">
			    	<h2>Kepala Surat</h2><br>
			    	<div class="form-group">
				        <label class="col-xs-2">Tanggal Surat</label>
				        <div class="col-xs-10">
				            <input type="text" name="tanggal_surat" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal_surat; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Yth</label>
				        <div class="col-xs-10">
				            <input type="text" name="yth" autofocus tabindex="1" class="form-control" value='<?php echo $yth; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Alamat Tujuan</label>
				        <div class="col-xs-10">
				        	<textarea name="alamat_yth" tabindex="1" autofocus style="height:100px" class="form-control editor-simple" id="alamat_yth"><?php echo $alamat_yth; ?></textarea>
				        </div>
				    </div>

					<div class="form-group">
				        <label class="col-xs-2">Nomor</label>
				        <div class="col-xs-10">
				            <input type="text" name="nomor" autofocus tabindex="1" class="form-control" value='<?php echo $nomor; ?>'>
				        </div>
				    </div>
			    </div>

			    
			</div>

		    <hr style="border-color:#cccccc">
		    <h2>Batang Tubuh Surat</h2><br>
		    <div class="dynamic_field">
			    <div class="form-group row">
			        <label class="col-xs-1">Detail Naskah Dinas</label>
			        <div class="col-xs-11" id="add"> 
			            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
			        </div>
			    </div>

			    <?php foreach ($naskah_dinas as $value) { ?>
				     <div class="form-group clone">
				        <label class="col-xs-1"></label>
				        <div class="col-xs-1">
				            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
				        </div>
				        <div class="col-xs-5">
				        	<input type='text' name='nama_naskah[]' autofocus tabindex='1' class='form-control' placeholder='Nama Naskah Dinas' value='<?php echo $value->nama_naskah?>'>
				        </div>
				        <div class="col-xs-2">
				        	<input type='number' name='banyaknya[]' autofocus tabindex='1' class='form-control' placeholder='Banyaknya' value='<?php echo $value->banyaknya?>'>
				        </div>
				        <div class="col-xs-3">
				        	<input type='text' name='keterangan[]' autofocus tabindex='1' class='form-control' placeholder='Keterangan' value='<?php echo $value->keterangan?>'>
				        </div>
				    </div>
			    <?php } ?>

			    <div class="form-group template hide">
			        <label class="col-xs-1"></label>
			        <div class="col-xs-1">
			            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
			        </div>
			        <div class="col-xs-5">
			        	<input type='text' name='nama_naskah[]' autofocus tabindex='1' class='form-control' placeholder='Nama Naskah Dinas'>
			        </div>
			        <div class="col-xs-2">
			        	<input type='number' name='banyaknya[]' autofocus tabindex='1' class='form-control' placeholder='Banyaknya'>
			        </div>
			        <div class="col-xs-3">
			        	<input type='text' name='keterangan[]' autofocus tabindex='1' class='form-control' placeholder='Keterangan' '>
			        </div>
			    </div>
			</div>

			<hr style="border-color:#cccccc">
		    <h2>Kaki Surat</h2>

		    <div class="form-group">
		    	<div class="col-lg-6">
		    		<h3>Data Penerima</h3><br>
		    		<div class="form-group">
				        <label class="col-xs-2">Tanggal Diterima</label>
				        <div class="col-xs-10">
				            <input type="text" name="tanggal_diterima" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal_diterima; ?>'>
				        </div>
				    </div>


				    <div class="form-group">
				        <label class="col-xs-2">Jabatan Penerima</label>
				        <div class="col-xs-10">
				            <input type="text" name="jabatan_penerima" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan_penerima; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Nama Lengkap Penerima</label>
				        <div class="col-xs-10">
				            <input type="text" name="nama_penerima" autofocus tabindex="1" class="form-control" value='<?php echo $nama_penerima; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">NIP Penerima</label>
				        <div class="col-xs-10">
				            <input type="text" name="nip_penerima" autofocus tabindex="1" class="form-control" value='<?php echo $nip_penerima; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Nomor Telepon Penerima</label>
				        <div class="col-xs-10">
				            <input type="text" name="telepon_penerima" autofocus tabindex="1" class="form-control" value='<?php echo $telepon_penerima; ?>'>
				        </div>
				    </div>
		    	</div>
		    	<div class="col-lg-6">
		    		<h3>Data Pengirim</h3><br>
		    		<div class="form-group">
				        <label class="col-xs-2">Jabatan Pengirim</label>
				        <div class="col-xs-10">
				            <input type="text" name="jabatan_pengirim" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan_pengirim; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Nama Lengkap Pengirim</label>
				        <div class="col-xs-10">
				            <input type="text" name="nama_pengirim" autofocus tabindex="1" class="form-control" value='<?php echo $nama_pengirim; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">NIP Pengirim</label>
				        <div class="col-xs-10">
				            <input type="text" name="nip_pengirim" autofocus tabindex="1" class="form-control" value='<?php echo $nip_pengirim; ?>'>
				        </div>
				    </div>
		    	</div>
		    </div>
