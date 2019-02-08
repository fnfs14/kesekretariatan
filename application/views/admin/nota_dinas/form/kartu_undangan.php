
<?php
if ($action == "edit_nota") {
	$id			= $request->ID;
	$instansi	= $detail->instansi;
	$jabatan	= $detail->jabatan;
	$nama_acara 		= $detail->nama_acara;
	$tanggal_acara 		= $detail->tanggal_acara;
	$tempat_acara 		= $detail->tempat_acara;
	$waktu_acara 		= strftime("%H:%M", strtotime($detail->waktu_acara));
	$konfirmasi 		= $detail->konfirmasi;
	$pakaian_laki_laki 		= $detail->pakaian_laki_laki;
	$pakaian_perempuan	= $detail->pakaian_perempuan;
	$pakaian_tni_polri 		= $detail->pakaian_tni_polri;
	
} else {
	$id			= '';
	$instansi	= '';
	$jabatan	= '';
	$nama_acara 		= '';
	$tanggal_acara 		= '';
	$tempat_acara 		= '';
	$waktu_acara 		= '';
	$konfirmasi 		= '';
	$pakaian_laki_laki 		= '';
	$pakaian_perempuan	= '';
	$pakaian_tni_polri 		= 	'';
}
?>

			
		    <div class="form-group col-xs-12">
		    	<center><h3>Data Pembuat Surat </h3><br></center>
		    	<div class="col-lg-6">
		    		<div class="form-group">
				        <label class="col-xs-2">Instansi</label>
				        <div class="col-xs-10">
				            <input type="text" name="instansi" autofocus tabindex="1" class="form-control" value='<?php echo $instansi; ?>'>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
				        <label class="col-xs-2">Jabatan</label>
				        <div class="col-xs-10">
				            <input type="text" name="jabatan" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan; ?>'>
				        </div>
				    </div>
				</div>
			</div>

			<hr style="border-color: #cccccc">
			<div class="form-group col-xs-12">
				<center><h3>Data Acara</h3><br></center>
				<div class="col-lg-6">
					<div class="form-group">
				        <label class="col-xs-2">Nama</label>
				        <div class="col-xs-10">
				        	<textarea name="nama_acara" tabindex="1" autofocus style="height:250px" class="editor-simple" id="penutup"><?php echo $nama_acara; ?></textarea>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
				        <label class="col-xs-2">Tanggal</label>
				        <div class="col-xs-10">
				            <input type="text" name="tanggal_acara" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal_acara; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-2">Waktu</label>
				        <div class="col-xs-10">
				            <input type="text" name="waktu_acara" autofocus tabindex="1" class="form-control time" value='<?php echo $waktu_acara; ?>'>
				        </div>
				    </div>
					<div class="form-group">
				        <label class="col-xs-2">Tempat</label>
				        <div class="col-xs-10">
				            <input type="text" name="tempat_acara" autofocus tabindex="1" class="form-control" value='<?php echo $tempat_acara; ?>'>
				        </div>
				    </div>
				</div>
		    </div>

		    <hr style="border-color: #cccccc">
			<div class="form-group col-xs-12">
				
				<div class="col-lg-6">
					<center><h3>Konfirmasi</h3><br></center>
					<div class="form-group">
				        <label class="col-xs-2">Kontak Konfirmasi</label>
				        <div class="col-xs-10">
				            <input type="text" name="konfirmasi" autofocus tabindex="1" class="form-control" value='<?php echo $konfirmasi; ?>'>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">
					<center><h3>Pakaian</h3><br></center>
					<div class="form-group">
				        <label class="col-xs-2">Laki-laki</label>
				        <div class="col-xs-10">
				            <input type="text" name="pakaian_laki_laki" autofocus tabindex="1" class="form-control" value='<?php echo $pakaian_laki_laki; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-2">Perempuan</label>
				        <div class="col-xs-10">
				            <input type="text" name="pakaian_perempuan" autofocus tabindex="1" class="form-control" value='<?php echo $pakaian_perempuan; ?>'>
				        </div>
				    </div>
					<div class="form-group">
				        <label class="col-xs-2">TNI/Polri </label>
				        <div class="col-xs-10">
				            <input type="text" name="pakaian_tni_polri" autofocus tabindex="1" class="form-control" value='<?php echo $pakaian_tni_polri; ?>'>
				        </div>
				    </div>
				</div>
		    </div>
