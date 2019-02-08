
<?php
if ($action == "edit_nota") {
	$id			= $request->ID;
	$logo		= $detail->logo;
	$nama_instansi = $detail->nama_instansi;
	$alamat_instansi = $detail->alamat_instansi;
	$telepon_instansi	= $detail->telepon_instansi;
	$faksimile_instansi = $detail->faksimile_instansi;
	$nomor 		= $detail->nomor;
	$nama_pemberi 		= $detail->nama_pemberi;
	$jabatan_pemberi 		= $detail->jabatan_pemberi;
	$alamat_pemberi 		= $detail->alamat_pemberi;
	$nama_penerima 		= $detail->nama_penerima;
	$jabatan_penerima 		= $detail->jabatan_penerima;
	$alamat_penerima 		= $detail->alamat_penerima;
	$untuk	= $detail->untuk;
	$tempat 		= $detail->tempat;
	$tanggal 	= $detail->tanggal;
	$nip_pemberi = $detail->nip_pemberi;
	$nip_penerima = $detail->nip_penerima;
} else {
	$id			= $request->ID;
	$logo		= '';
	$nama_instansi = '';
	$alamat_instansi = '';
	$telepon_instansi	= '';
	$faksimile_instansi = '';
	$nomor 		= '';
	$nama_pemberi 		= '';
	$jabatan_pemberi 		= '';
	$alamat_pemberi 		= '';
	$nama_penerima 		= '';
	$jabatan_penerima 		= '';
	$alamat_penerima 		= '';
	$untuk	= '';
	$tempat 		= '';
	$tanggal 	= '';
	$nip_pemberi = '';
	$nip_penerima = '';
}
?>

			<h2>Data Instansi</h2><br>

			<div class="form-group">
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
				        		<img alt="Selected Logo" src="" style="border-width: 0px; border-style: solid; max-height: 100px; max-width: 100px">
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
		    	<div class="col-lg-6">
		    		<h2>Data Pemberi Kuasa</h2><br>
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
				    <div class="form-group">
				        <label class="col-xs-2">Alamat</label>
				        <div class="col-xs-10">
				            <input type="text" name="alamat_pemberi" autofocus tabindex="1" class="form-control" value='<?php echo $alamat_pemberi; ?>'>
				        </div>
				    </div>
		    	</div>
		    	<div class="col-lg-6">
		    		<h2>Data Penerima Kuasa</h2><br>
				    <div class="form-group">
				        <label class="col-xs-2">Nama</label>
				        <div class="col-xs-10">
				            <input type="text" name="nama_penerima" autofocus tabindex="1" class="form-control" value='<?php echo $nama_penerima; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-2">NIP</label>
				        <div class="col-xs-10">
				            <input type="text" name="nip_penerima" autofocus tabindex="1" class="form-control" value='<?php echo $nip_penerima; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-2">Jabatan</label>
				        <div class="col-xs-10">
				            <input type="text" name="jabatan_penerima" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan_penerima; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-2">Alamat</label>
				        <div class="col-xs-10">
				            <input type="text" name="alamat_penerima" autofocus tabindex="1" class="form-control" value='<?php echo $alamat_penerima ?>'>
				        </div>
				    </div>
		    	</div>
		    </div>		    
		    

		    <hr style="border-color:#cccccc">
		    <h2>Data Surat</h2><br>

		    <div class="form-group"> 
		    	<div class="col-lg-6">
		    		<div class="form-group">
				        <label class="col-xs-2">Nomor</label>
				        <div class="col-xs-10">
				            <input type="text" name="nomor" autofocus tabindex="1" class="form-control" value='<?php echo $nomor; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Tempat</label>
				        <div class="col-xs-10">
				            <input type="text" name="tempat" autofocus tabindex="1" class="form-control" value='<?php echo $tempat; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Tanggal</label>
				        <div class="col-xs-10">
				            <input type="text" name="tanggal" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal; ?>'>
				        </div>
				    </div>
		    	</div>
		    	<div class="col-lg-6">
		    		<div class="form-group">
				        <label class="col-xs-2">Aktivitas yang Kuasanya Diberikan</label>
				        <div class="col-xs-10">
				            <textarea name="untuk" tabindex="1" autofocus style="height:250px" class="editor-simple" id="aktivitas"><?php echo $untuk; ?></textarea>
				        </div>
				    </div>
		    	</div>
		    </div>


			
