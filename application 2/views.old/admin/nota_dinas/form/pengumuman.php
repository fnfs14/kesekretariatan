
<?php
if ($action == "edit_nota") {
	$id			= $request->ID;
	$logo		= $detail->logo;
	$nama_instansi = $detail->nama_instansi;
	$alamat_instansi = $detail->alamat_instansi;
	$telepon_instansi	= $detail->telepon_instansi;
	$faksimile_instansi = $detail->faksimile_instansi;
	$nomor 		= $detail->nomor;
	$tentang 		= $detail->tentang;
	$isi 		= $detail->isi;
	$tempat 	= $detail->tempat;
	$tanggal 	= $detail->tanggal;
	$jabatan	= $detail->jabatan;
	$nama		= $detail->nama;
	
} else {
	$id			= $request->ID;
	$logo		= '';
	$nama_instansi = '';
	$alamat_instansi = '';
	$telepon_instansi	= '';
	$faksimile_instansi = '';
	$nomor 		= '';
	$tentang 		= '';
	$isi 		= '';
	$tempat 	= '';
	$tanggal 	= '';
	$jabatan	= '';
	$nama		= '';
}
?>
			<div class="form-group">
				<h2>Data Instansi</h2><br>
				<div class="col-lg-6">			
					<div class="form-group">
						
				        <label class="col-xs-2">Logo<br>(.gif/.jpg/.png)</label>
				        <div class="image_field" file_index="0">
				        	<div class="col-xs-8">
				        		<input type="file" accept="image/*" name="logo" autofocus tabindex="1" class="form-control file">
				        	</div>
				        	<div class="col-xs-2 current_image">
				        		<?php if($logo != "") {?>
									<img alt="Current Logo" src="<?php echo base_url().$logo; ?>" style="border-width: 0px; border-style: solid;max-height: 100px; max-width: 100px;">
								<?php } ?>
				        	</div>
				        	<div class="col-xs-2 selected_image hide">
				        		<img alt="Selected Logo" src="" style="border-width: 0px; border-style: solid; max-height: 100px; max-width: 100px;">
				        	</div>
				        </div>

				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Nama Instansi</label>
				        <div class="col-xs-10">
				            <input type="text" name="nama_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $nama_instansi; ?>'>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">
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
			</div>

			

		    <hr style="border-color:#cccccc">
		    <div class="form-group">
		    	<h2>Data Pengumuman</h2><br>
		    	<div class="col-lg-5">
		    		<div class="form-group">
				        <label class="col-xs-3">Nomor</label>
				        <div class="col-xs-9">
				            <input type="text" name="nomor" autofocus tabindex="1" class="form-control" value='<?php echo $nomor; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-3">Tentang</label>
				        <div class="col-xs-9">
				            <input type="text" name="tentang" autofocus tabindex="1" class="form-control" value='<?php echo $tentang; ?>'>
				        </div>
				    </div>
				    
				    <div class="form-group">
				        <label class="col-xs-3">Tempat</label>
				        <div class="col-xs-9">
				            <input type="text" name="tempat" autofocus tabindex="1" class="form-control" value='<?php echo $tempat; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-3">Tanggal</label>
				        <div class="col-xs-9">
				            <input type="text" name="tanggal" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-3">Nama Jabatan</label>
				        <div class="col-xs-9">
				            <input type="text" name="jabatan" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-3">Nama Lengkap</label>
				        <div class="col-xs-9">
				            <input type="text" name="nama" autofocus tabindex="1" class="form-control" value='<?php echo $nama; ?>'>
				        </div>
				    </div>

		    	</div>
		    	<div class="col-lg-7">
		    		<div class="form-group">
				        <label class="col-xs-2">Isi Pengumuman</label>
				        <div class="col-xs-10">
				            <textarea name="isi" tabindex="1" autofocus style="height:250px" class="editor-field" id="isi"><?php echo $isi; ?></textarea>
				        </div>
				    </div>
		    	</div>
		    </div>
		    
			
	