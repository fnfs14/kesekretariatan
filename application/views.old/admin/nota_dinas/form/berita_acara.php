
<?php
if ($action == "edit_nota") {
	$id				= $request->ID;
	$logo		= $detail->logo;
	$nama_instansi = $detail->nama_instansi;
	$alamat_instansi = $detail->alamat_instansi;
	$telepon_instansi	= $detail->telepon_instansi;
	$faksimile_instansi = $detail->faksimile_instansi;
	$nomor		= $detail->nomor;
	$tanggal = $detail->tanggal;
	$identitas_pihak_satu	= $detail->identitas_pihak_satu;
	$nama_ttd_pihak_satu = $detail->nama_ttd_pihak_satu;
	$identitas_pihak_dua	= $detail->identitas_pihak_dua;
	$nama_ttd_pihak_dua = $detail->nama_ttd_pihak_dua;
	$jabatan_saksi		= $detail->jabatan_saksi;
	$nama_saksi			= $detail->nama_saksi;
	$berdasarkan		= $detail->berdasarkan;
	$tempat 			= $detail->tempat;
	$kegiatan = $kegiatan;
	
} else {
	$id				= $request->ID;
	$logo		= '';
	$nama_instansi = '';
	$alamat_instansi = '';
	$telepon_instansi	= '';
	$faksimile_instansi = '';
	$nomor		= '';
	$tanggal = '';
	$identitas_pihak_satu	= '';
	$nama_ttd_pihak_satu = '';
	$identitas_pihak_dua	= '';
	$nama_ttd_pihak_dua = '';
	$jabatan_saksi		= '';
	$nama_saksi			= '';
	$berdasarkan = '';
	$tempat 			= '';
	$kegiatan = [];
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
			<h2>Kepala Naskah</h2><br>
			<div class="form-group col-xs-12">
				<div class="form-group">
			    	<div class="col-lg-6">
			    		<div class="form-group">
					        <label class="col-xs-2">Nomor</label>
					        <div class="col-xs-10">
					            <input type="text" name="nomor" autofocus tabindex="1" class="form-control" value='<?php echo $nomor; ?>'>
					        </div>
					    </div>
			    	</div>
			    	<div class="col-lg-6">
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
			    	<div class="col-lg-4">
			    		<center><h3>Pihak Pertama</h3></center><br>
			    		<div class="form-group">
					        <label class="col-xs-2">Identitas</label>
					        <div class="col-xs-10">
					            <input type="text" name="identitas_pihak_satu" autofocus tabindex="1" class="form-control" placeholder="Nama, Jabatan, NIP" value='<?php echo $identitas_pihak_satu; ?>'>
					        </div>
					    </div>
					    <div class="form-group">
					        <label class="col-xs-2">Nama TTD</label>
					        <div class="col-xs-10">
					            <input type="text" name="nama_ttd_pihak_satu" autofocus tabindex="1" class="form-control" placeholder="Nama Lengkap" value='<?php echo $nama_ttd_pihak_satu; ?>'>
					        </div>
					    </div>
			    	</div>
			    	<div class="col-lg-4">
			    		<center><h3>Pihak Kedua</h3></center><br>
			    		<div class="form-group">
					        <label class="col-xs-2">Identitas</label>
					        <div class="col-xs-10">
					            <input type="text" name="identitas_pihak_dua" autofocus tabindex="1" class="form-control" placeholder="Nama, Jabatan, NIP" value='<?php echo $identitas_pihak_dua; ?>'>
					        </div>
					    </div>
					    <div class="form-group">
					        <label class="col-xs-2">Nama TTD</label>
					        <div class="col-xs-10">
					            <input type="text" name="nama_ttd_pihak_dua" autofocus tabindex="1" class="form-control" placeholder="Nama Lengkap" value='<?php echo $nama_ttd_pihak_dua; ?>'>
					        </div>
					    </div>
			    	</div>
			    	<div class="col-lg-4">
			    		<center><h3>Saksi</h3></center><br>
			    		<div class="form-group">
					        <label class="col-xs-2">Jabatan</label>
					        <div class="col-xs-10">
					            <input type="text" name="jabatan_saksi" autofocus tabindex="1" class="form-control" placeholder="Jabatan" value='<?php echo $jabatan_saksi ?>'>
					        </div>
					    </div>
					    <div class="form-group">
					        <label class="col-xs-2">Nama TTD</label>
					        <div class="col-xs-10">
					            <input type="text" name="nama_saksi" autofocus tabindex="1" class="form-control" placeholder="Nama Lengkap" value='<?php echo $nama_saksi; ?>'>
					        </div>
					    </div>
			    	</div>
			    </div>
			    <hr style="border-color:#e6e6e6">
			    <div class="dynamic_field level-1">
				    <div class="form-group row">
				        <label class="col-xs-1">Kegiatan</label>
				        <div class="col-xs-11"> 
				            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
				        </div>
				    </div>

				    <?php foreach ($kegiatan as $key => $value) { ?>
				    	<div class="form-group clone" data-id="<?php echo $key+1 ?>">
					    	<label class="col-xs-1"></label>
					    	<div class="col-xs-11">
					    		<div class="form-group">
							        <div class="col-xs-1">
							            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
							        </div>
							        <div class="col-xs-11">
							        	<textarea name="kegiatan[]" id="isi[<?php echo $key+1 ?>]" class="form-control" autofocus tabindex="1"><?php echo $value->isi ?></textarea>
							        </div>
							    </div>
							</div>
					    </div>
				    <?php } ?>

				    <div class="form-group template hide">
				    	<label class="col-xs-1"></label>
				    	<div class="col-xs-11">
				    		<div class="form-group">
						        <div class="col-xs-1">
						            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
						        </div>
						        <div class="col-xs-11">
						        	<textarea name="kegiatan[]" class="form-control" autofocus tabindex="1"></textarea>
						        </div>
						    </div>
						</div>
				    </div>
				</div>
			</div>

			<hr style="border-color:#cccccc">
			<h2>Kaki Naskah</h2><br>
			<div class="form-group col-xs-12">
				<div class="form-group">
			    	<div class="col-lg-6">
			    		<div class="form-group">
					        <label class="col-xs-2">Dasar Pembuatan Berita Acara</label>
					        <div class="col-xs-10">
					            <input type="text" name="berdasarkan" autofocus tabindex="1" class="form-control" value='<?php echo $berdasarkan; ?>'>
					        </div>
					    </div>
			    	</div>
			    	<div class="col-lg-6">
			    		<div class="form-group">
					        <label class="col-xs-2">Tempat Pelaksanaan</label>
					        <div class="col-xs-10">
					            <input type="text" name="tempat" autofocus tabindex="1" class="form-control" value='<?php echo $tempat; ?>'>
					        </div>
					    </div>
			    	</div>
			    </div>
		    </div>