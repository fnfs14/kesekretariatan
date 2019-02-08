
<?php
if ($action == "edit_nota") {
	$id			= $request->ID;
	$logo		= $detail->logo;
	$nama_instansi = $detail->nama_instansi;
	$alamat_instansi = $detail->alamat_instansi;
	$telepon_instansi	= $detail->telepon_instansi;
	$faksimile_instansi = $detail->faksimile_instansi;
	$nomor 		= $detail->nomor;
	$sifat 		= $detail->sifat;
	$lampiran	= $detail->lampiran;
	$hal 		= $detail->hal;
	$tempat 	= $detail->tempat;
	$tanggal 	= $detail->tanggal;
	$yth 		= $detail->yth;
	$alamat		= $detail->alamat;
	$nama_acara 		= $detail->nama_acara;
	$tanggal_acara 		= $detail->tanggal_acara;
	$tempat_acara 		= $detail->tempat_acara;
	$waktu_acara 		= strftime("%H:%M", strtotime($detail->waktu_acara));
	$pembuka 	= $detail->pembuka;
	$penutup	= $detail->penutup;

	$jabatan	= $detail->jabatan;
	$nama		= $detail->nama;
	$tembusan 	= $tembusan_nota;
	$list_diundang 	= $list_diundang;
	
} else {
	$id			= $request->ID;
	$logo		= '';
	$nama_instansi = '';
	$alamat_instansi = '';
	$telepon_instansi	= '';
	$faksimile_instansi = '';
	$nomor 		= "";
	$sifat 		= "";
	$lampiran	= "";
	$hal 		= "";
	$tempat 	= "";
	$tanggal 	= "";
	$yth 	= "";
	$alamat		= "";
	$pembuka 	= "";
	$nama_acara 		= "";
	$tanggal_acara 		= "";
	$tempat_acara 		= "";
	$waktu_acara 		= "";
	$penutup	= "";
	$jabatan	= "";
	$nama		= "";
	$tembusan 	= [];
	$list_diundang 	= [];
}
?>
			
			<div class="form-group col-xs-12">
				<center><h3>Data Instansi</h3><br></center>
				<div class="col-lg-6">
					<div class="form-group">
						
				        <label class="col-xs-2">Logo<br>(.gif/.jpg/.png)</label>
				        <div class="image_field" file_index="0">
				        	<div class="col-xs-10">
				        		<input type="file" accept="image/*" name="logo" autofocus tabindex="1" class="form-control file">
				        	</div>
				        	<div class="col-xs-2 current_image">
				        		<?php if($logo != "") {?>
									<img alt="Current Logo" src="<?php echo base_url().$logo; ?>" style="border-width: 0px; border-style: solid;max-height: 100px; max-width: 100px">
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

			<hr style="border-color: #cccccc">
			
		    <div class="form-group">
		    	<div class="col-lg-4">
		    		<center><h3>Data Pembuat Surat </h3><br></center>
				    <div class="form-group">
				        <label class="col-xs-2">Jabatan</label>
				        <div class="col-xs-10">
				            <input type="text" name="jabatan" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-2">Nama</label>
				        <div class="col-xs-10">
				            <input type="text" name="nama" autofocus tabindex="1" class="form-control" value='<?php echo $nama; ?>'>
				        </div>
				    </div>
				</div>

		    	<div class="col-lg-8">
		    		<center><h3>Kepala Surat</h3><br></center>
		    		<div class="col-lg-6">
				    
					    <div class="form-group">
					        <label class="col-xs-2">Nomor</label>
					        <div class="col-xs-10">
					            <input type="text" name="nomor" autofocus tabindex="1" class="form-control" value='<?php echo $nomor; ?>'>
					        </div>
					    </div>

					    <div class="form-group">
					        <label class="col-xs-2">Sifat</label>
					        <div class="col-xs-10">
					            <input type="text" name="sifat" autofocus tabindex="1" class="form-control" value='<?php echo $sifat; ?>'>
					        </div>
					    </div>

					    <div class="form-group">
					        <label class="col-xs-2">Lampiran</label>
					        <div class="col-xs-10">
					            <input type="number" name="lampiran" autofocus tabindex="1" class="form-control" value='<?php echo $lampiran; ?>'>
					        </div>
					    </div>
					</div>
					<div class="col-lg-6">
					    <div class="form-group">
					        <label class="col-xs-2">Hal</label>
					        <div class="col-xs-10">
					            <input type="text" name="hal" autofocus tabindex="1" class="form-control" value='<?php echo $hal; ?>'>
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
				</div>
			</div>
			<hr style="border-color: #cccccc">
			<div class="form-group">
				<div class="col-lg-6">
					<center><h3>Data Tujuan Surat</h3><br></center>
				    <div class="form-group">
				        <label class="col-xs-2">Yth</label>
				        <div class="col-xs-10">
				            <input type="text" name="yth" autofocus tabindex="1" class="form-control" value='<?php echo $yth; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-2">Alamat</label>
				        <div class="col-xs-10">
				        	<textarea name="alamat" tabindex="1" autofocus style="height:100px" class="form-control editor-simple" id="alamat"><?php echo $alamat; ?></textarea>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">
					<center><h3>Data Acara</h3><br></center>
					<div class="form-group">
				        <label class="col-xs-2">Nama</label>
				        <div class="col-xs-10">
				            <input type="text" name="nama_acara" autofocus tabindex="1" class="form-control" value='<?php echo $nama_acara; ?>'>
				        </div>
				    </div>
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
		    <div class="form-group">
				<center><h3>Isi Surat</h3><br></center>
				<div class="col-lg-6">
				    <div class="form-group">
				        <label class="col-xs-2">Alinea Pembuka</label>
				        <div class="col-xs-10">
				            <textarea name="pembuka" tabindex="1" autofocus style="height:250px" class="editor-field" id="pembuka"><?php echo $pembuka; ?></textarea>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
				        <label class="col-xs-2">Alinea Penutup</label>
				        <div class="col-xs-10">
				            <textarea name="penutup" tabindex="1" autofocus style="height:250px" class="editor-field" id="penutup"><?php echo $penutup; ?></textarea>
				        </div>
				    </div>
				</div>
		    </div>
		    <hr style="border-color: #cccccc">

		    <div class="form-group">
		    	<div class="col-lg-6">
				    <div class="dynamic_field">
					    <div class="form-group row">
					        <label class="col-xs-2">Tembusan</label>
					        <div class="col-xs-10" id="addTembusan"> 
					            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
					        </div>
					    </div>

					    <?php foreach ($tembusan as $value) { ?>
						    <div class="form-group person_field clone">
						        <label class="col-xs-2"></label>
						        <div class="col-xs-2">
						            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
						        </div>
						        <div class="col-xs-8">
					            	<input type='text' name='tembusan[]' autofocus tabindex='1' class='form-control' value='<?php echo $value->isi; ?>' placeholder='Nama/Jabatan'>
						        </div>
						    </div>
					    <?php } ?>

					    <div class="form-group person_field template hide">
					        <label class="col-xs-2"></label>
					        <div class="col-xs-2">
					            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
					        </div>
					        <div class="col-xs-8">
				            	<input type='text' name='tembusan[]' autofocus tabindex='1' class='form-control' placeholder='Nama/Jabatan'>
					        </div>
					    </div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="dynamic_field">
					    <div class="form-group row">
					        <label class="col-xs-2">Daftar Diundang</label>
					        <div class="col-xs-10" id="addTembusan"> 
					            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
					        </div>
					    </div>

					    <?php foreach ($list_diundang as $value) { ?>
						    <div class="form-group clone">
						        <label class="col-xs-2"></label>
						        <div class="col-xs-2">
						            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
						        </div>
						        <div class="col-xs-8">
					            	<input type='text' name='list_diundang[]' autofocus tabindex='1' class='form-control' value='<?php echo $value->isi; ?>' placeholder='Nama/Jabatan'>
						        </div>
						    </div>
					    <?php } ?>

					    <div class="form-group template hide">
					        <label class="col-xs-2"></label>
					        <div class="col-xs-2">
					            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
					        </div>
					        <div class="col-xs-8">
				            	<input type='text' name='list_diundang[]' autofocus tabindex='1' class='form-control' placeholder='Nama/Jabatan'>
					        </div>
					    </div>
					</div>
				</div>
			</div>