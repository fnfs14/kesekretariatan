
<?php
if ($action == "edit_nota") {
	$id				= $request->ID;
	$logo		= $detail->logo;
	$nama_instansi = $detail->nama_instansi;
	$alamat_instansi = $detail->alamat_instansi;
	$telepon_instansi	= $detail->telepon_instansi;
	$faksimile_instansi = $detail->faksimile_instansi;
	$nomor 			= $detail->nomor;
	$pertimbangan	= $detail->pertimbangan;
	$dasar 		= $dasar;
	$kepada 		= $kepada;
	$perintah 		= $perintah;
	$tempat 		= $detail->tempat;
	$tanggal 		= $detail->tanggal;
	$jabatan		= $detail->jabatan;
	$nama			= $detail->nama;
	$tembusan 	= $tembusan_nota;
	
} else {
	$id				= $request->ID;
	$logo		= '';
	$nama_instansi = '';
	$alamat_instansi = '';
	$telepon_instansi	= '';
	$faksimile_instansi = '';
	$nomor 			= '';
	$pertimbangan	= '';
	$dasar 			= [];
	$kepada 		= [];
	$perintah		= [];
	$tempat 		= '';
	$tanggal 		= '';
	$jabatan		= '';
	$nama			= '';
	$tembusan 	= [];
}
?>

			<h2>Kepala Naskah</h2><br>
			<div class="form-group">
				<div class="col-lg-6">
					
					<div class="form-group">
						
				        <label class="col-xs-4">Logo<br>(.gif/.jpg/.png)</label>
				        <div class="image_field" file_index="0">
				        	<div class="col-xs-6">
				        		<input type="file" accept="image/*" name="logo" autofocus tabindex="1" class="form-control file">
				        	</div>
				        	<div class="col-xs-2 current_image">
				        		<?php if($logo != "") {?>
									<img alt="Current Logo" src="<?php echo base_url().$logo; ?>" style="border-width: 0px; border-style: solid; max-height: 100px; max-width: 100%;">
								<?php } ?>
				        	</div>
				        	<div class="col-xs-2 selected_image hide">
				        		<img alt="Selected Logo" src="" style="border-width: 0px; border-style: solid; max-height: 100px; max-width: 100%;">
				        	</div>
				        </div>

				    </div>

				    <div class="form-group">
				        <label class="col-xs-4">Nama Instansi</label>
				        <div class="col-xs-6">
				            <input type="text" name="nama_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $nama_instansi; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-4">Alamat Instansi</label>
				        <div class="col-xs-6">
				            <input type="text" name="alamat_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $alamat_instansi; ?>'>
				        </div>
				    </div>

				    

					
				</div>
				<div class="col-lg-6">
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
					<div class="form-group">
				        <label class="col-xs-4">Nomor Surat</label>
				        <div class="col-xs-6">
				            <input type="text" name="nomor" autofocus tabindex="1" class="form-control" value='<?php echo $nomor; ?>'>
				        </div>
				    </div>
				</div>
			</div>
			<hr style="border-color:#cccccc">
			<h2>Isi Naskah</h2><br>
			<div class="form-group">
		        <label class="col-xs-1">Pertimbangan</label>
		        <div class="col-xs-11">
		            <input type="text" name="pertimbangan" autofocus tabindex="1" class="form-control" value='<?php echo $pertimbangan; ?>'>
		        </div>
		    </div>
		    <br>
			<div class="form-group">
				<div class="col-lg-6">
			    	<div class="dynamic_field">
					    <div class="form-group row">
					    	<label class="col-xs-2">Dasar</label>
					        <div class="col-xs-10"> 
					            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
					        </div>
					    </div>

					    <?php foreach ($dasar as $value) { ?>
						    <div class="form-group clone">
						    	<div class="col-xs-2"></div>
						        <div class="col-xs-2">
						            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
						        </div>

						        <div class="col-xs-8">
						        	<textarea name="dasar[]" class="form-control" tabindex="1" autofocus><?php echo $value->isi?></textarea>
						        </div>
						    </div>
					    <?php } ?>

					    <div class="form-group template hide">
					    	<div class="col-xs-2"></div>
					        <div class="col-xs-2">
					            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
					        </div>
					        <div class="col-xs-8">
					        	<textarea name="dasar[]" class="form-control" tabindex="1" autofocus></textarea>
					        </div>
					    </div>
					</div>
				</div>
				<div class="col-lg-6">
			    	<div class="dynamic_field">
					    <div class="form-group row">
					    	<label class="col-xs-2">Kepada</label>
					        <div class="col-xs-10"> 
					            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
					        </div>
					    </div>

					    <?php foreach ($kepada as $value) { ?>
						    <div class="form-group clone">
						    	<div class="col-xs-2"></div>
						        <div class="col-xs-2">
						            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
						        </div>

						        <div class="col-xs-8">
						        	<input type="text" name="kepada[]" autofocus tabindex="1" class="form-control" value='<?php echo $value->nama; ?>' placeholder="Nama/Jabatan">
						        </div>
						    </div>
					    <?php } ?>

					    <div class="form-group template hide">
					    	<div class="col-xs-2"></div>
					        <div class="col-xs-2">
					            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
					        </div>
					        <div class="col-xs-8">
					        	<input type="text" name="kepada[]" autofocus tabindex="1" class="form-control" placeholder="Nama/Jabatan">
					        </div>
					    </div>
					</div>
				</div>
				
			</div>

			<div class="dynamic_field">
			    <div class="form-group row">
			    	<label class="col-xs-1">Perintah</label>
			        <div class="col-xs-11"> 
			            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
			        </div>
			    </div>

			    <?php foreach ($perintah as $value) { ?>
				    <div class="form-group clone">
				    	<div class="col-xs-1"></div>
				        <div class="col-xs-1">
				            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
				        </div>

				        <div class="col-xs-10">
				        	<textarea name="perintah[]" class="form-control" tabindex="1" autofocus placeholder="Perintah..."><?php echo $value->isi?></textarea>
				        </div>
				    </div>
			    <?php } ?>

			    <div class="form-group template hide">
			    	<div class="col-xs-1"></div>
			        <div class="col-xs-1">
			            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
			        </div>
			        <div class="col-xs-10">
			        	<textarea name="perintah[]" class="form-control" tabindex="1" autofocus placeholder="Perintah..."></textarea>
			        </div>
			    </div>
			</div>

			<hr style="border-color:#cccccc">
			<h2>Kaki Naskah</h2><br>
			<div class="form-group">
				<div class="col-lg-6">
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
				        <label class="col-xs-2">Nama Jabatan</label>
				        <div class="col-xs-10">
				            <input type="text" name="jabatan" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Nama Lengkap</label>
				        <div class="col-xs-10">
				            <input type="text" name="nama" autofocus tabindex="1" class="form-control" value='<?php echo $nama; ?>'>
				        </div>
				    </div>
				</div>
			</div>
			
			<div class="dynamic_field">
			    <div class="form-group row">
			        <label class="col-xs-1">Tembusan</label>
			        <div class="col-xs-11" id="addTembusan"> 
			            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
			        </div>
			    </div>

			    <?php foreach ($tembusan as $value) { ?>
				    <div class="form-group person_field clone">
				        <label class="col-xs-1"></label>
				        <div class="col-xs-1">
				            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
				        </div>
				        <div class="col-xs-10">
			            	<input type='text' name='tembusan[]' autofocus tabindex='1' class='form-control' value='<?php echo $value->isi; ?>' placeholder='Nama/Jabatan'>
				        </div>
				    </div>
			    <?php } ?>

			    <div class="form-group person_field template hide">
			        <label class="col-xs-1"></label>
			        <div class="col-xs-1">
			            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
			        </div>
			        <div class="col-xs-10">
		            	<input type='text' name='tembusan[]' autofocus tabindex='1' class='form-control' placeholder='Nama/Jabatan'>
			        </div>
			    </div>
			</div>