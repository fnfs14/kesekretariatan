
<?php
if ($action == "edit_nota") {
	$id			= $request->ID;
	$tentang 		= $detail->tentang;
	$persoalan 		= $detail->persoalan;
	$praanggapan 		= $detail->praanggapan;
	$fakta 		= $detail->fakta;
	$analisis 		= $detail->analisis;
	$simpulan 		= $detail->simpulan;
	$saran 		= $detail->saran;
	$jabatan	= $detail->jabatan;
	$nama		= $detail->nama;
	
} else {
	$id			= $request->ID;
	$tentang 		= '';
	$persoalan 		= '';
	$praanggapan 		= '';
	$fakta 		= '';
	$analisis 		= '';
	$simpulan 		= '';
	$saran 		= '';
	$jabatan	= '';
	$nama		= '';
}
?>

		    <div class="form-group">
		        <label class="col-xs-2">Tentang</label>
		        <div class="col-xs-3">
		            <input type="text" name="tentang" autofocus tabindex="1" class="form-control" value='<?php echo $tentang; ?>'>
		        </div>
		    </div>

		    <div class="form-group">
		        <label class="col-xs-2">Jabatan Pembuat</label>
		        <div class="col-xs-3">
		            <input type="text" name="jabatan" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan; ?>'>
		        </div>
		    </div>

		    <div class="form-group">
		        <label class="col-xs-2">Nama Lengkap Pembuat</label>
		        <div class="col-xs-3">
		            <input type="text" name="nama" autofocus tabindex="1" class="form-control" value='<?php echo $nama; ?>'>
		        </div>
		    </div>


		    <div class="form-group">
		        <label class="col-xs-2">Persoalan</label>
		        <div class="col-xs-6">
		            <textarea name="persoalan" tabindex="1" autofocus style="height:250px" class="editor-field" id="persoalan"><?php echo $persoalan; ?></textarea>
		        </div>
		    </div>

		    <div class="form-group">
		        <label class="col-xs-2">Praanggapan</label>
		        <div class="col-xs-6">
		            <textarea name="praanggapan" tabindex="1" autofocus style="height:250px" class="editor-field" id="praanggapan"><?php echo $praanggapan; ?></textarea>
		        </div>
		    </div>

		    <div class="form-group">
		        <label class="col-xs-2">Fakta yang Mempengaruhi</label>
		        <div class="col-xs-6">
		            <textarea name="fakta" tabindex="1" autofocus style="height:250px" class="editor-field" id="fakta"><?php echo $fakta; ?></textarea>
		        </div>
		    </div>

		    <div class="form-group">
		        <label class="col-xs-2">Analisis</label>
		        <div class="col-xs-6">
		            <textarea name="analisis" tabindex="1" autofocus style="height:250px" class="editor-field" id="analisis"><?php echo $analisis; ?></textarea>
		        </div>
		    </div>

		    <div class="form-group">
		        <label class="col-xs-2">Simpulan</label>
		        <div class="col-xs-6">
		            <textarea name="simpulan" tabindex="1" autofocus style="height:250px" class="editor-field" id="simpulan"><?php echo $simpulan; ?></textarea>
		        </div>
		    </div>

		    <div class="form-group">
		        <label class="col-xs-2">Saran</label>
		        <div class="col-xs-6">
		            <textarea name="saran" tabindex="1" autofocus style="height:250px" class="editor-field" id="saran"><?php echo $saran; ?></textarea>
		        </div>
		    </div>
