
<?php
if ($action == "edit_request") {
	$id				= $request->ID;
	$logo		= $data->logo;
	$nama_instansi = $data->nama_instansi;
	$alamat_instansi = $data->alamat_instansi;
	$telepon_instansi	= $data->telepon_instansi;
	$faksimile_instansi = $data->faksimile_instansi;
	$nomor 			= $data->nomor;
	$pertimbangan	= $data->pertimbangan;
	$dasar 		= $dasar;
	$kepada 		= $kepada;
	$perintah 		= $perintah;
	$tempat 		= $data->tempat;
	$tanggal 		= $data->tanggal;
	$jabatan		= $data->jabatan;
	$nama			= $data->nama;
	$tembusan 		= $tembusan;
	
} else {
	$id				= '';
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
	$tembusan 		= [];
}
?>

<div class='request_surat_perintah'>

		<h2>Kepala Naskah</h2><br>
		<div class="form-group">
			<div class="col-lg-6">
				
				<div class="form-group">
					
			        <label class="col-xs-4">Logo<br>(.gif/.jpg/.png)</label>
			        <div class="image_field" file_index="0">
			        	<div class="col-xs-6">
			        		<input type="file" accept="image/*" name="logo" autofocus tabindex="1" class="form-control file" <?php echo ($action == "edit_request") ? '' : 'required' ?> >
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
			            <input type="text" name="nama_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $nama_instansi; ?>' required>
			        </div>
			    </div>

			    <div class="form-group">
			        <label class="col-xs-4">Alamat Instansi</label>
			        <div class="col-xs-6">
			            <input type="text" name="alamat_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $alamat_instansi; ?>' required>
			        </div>
			    </div>

			    

				
			</div>
			<div class="col-lg-6">
				<div class="form-group">
			        <label class="col-xs-4">Telepon Instansi</label>
			        <div class="col-xs-6">
			            <input type="text" name="telepon_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $telepon_instansi; ?>' required>
			        </div>
			    </div>

			    <div class="form-group">
			        <label class="col-xs-4">Faksimile Instansi</label>
			        <div class="col-xs-6">
			            <input type="text" name="faksimile_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $faksimile_instansi; ?>' required>
			        </div>
			    </div>		
				<div class="form-group">
			        <label class="col-xs-4">Nomor Surat</label>
			        <div class="col-xs-6">
			            <input type="text" name="nomor" autofocus tabindex="1" class="form-control" value='<?php echo $nomor; ?>' required>
			        </div>
			    </div>
			</div>
		</div>
		<hr style="border-color:#cccccc">
		<h2>Isi Naskah</h2><br>
		<div class="form-group">
	        <label class="col-xs-1">Pertimbangan</label>
	        <div class="col-xs-11">
	            <input type="text" name="pertimbangan" autofocus tabindex="1" class="form-control" value='<?php echo $pertimbangan; ?>' required>
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
		    	<div class="form-group dynamic_field col-xs-12">
					<div class="form-group row">
				        <label class="col-xs-2">Kepada</label>
				        <div class="col-xs-10" id="addTembusan"> 
				            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
				        </div>
				    </div>

				    <?php foreach ($kepada as $value) { ?>
					    <div class="form-group person_field clone">
					        <label class="col-xs-2"></label>
					        <div class="col-xs-2">
					            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
					        </div>
					        <div class="col-xs-3">
					        	<select name="kepada[]" class="form-control form_jenis" tabindex="1" autofocus>
					        		<option value=""></option>
					            	<option value="external" <?php if($value->ext_kepada != ''){ echo 'selected';}?>>Eksternal</option>
				            		<option value="internal" <?php if($value->int_kepada != ''){ echo 'selected';}?>>Internal</option>
					            </select>
					        </div>
					        <div class="col-xs-5 person_field_2">
					        	<?php if ($value->ext_kepada != '') { ?>
				            		<input type='text' name='val_kepada[]' autofocus tabindex='1' class='form-control' value='<?php echo $value->ext_kepada; ?>' placeholder='Nama/Jabatan'>
				            	<?php } else if ($value->int_kepada != '') { ?>
				            		<select name='val_kepada[]' class='form-control' tabindex="1" autofocus>
										<option value=''>--Pilih Jabatan--</option>
										<?php foreach ($listAdmin as $value2) { ?>
											<option value='<?php echo $value2->id; ?>' <?php if($value->int_kepada == $value2->id) { echo 'selected';}?> ><?php echo $value2->jabatan; ?></option>
										<?php } ?>
					            	</select>
				            	<?php } ?>
					        </div>
					    </div>
				    <?php } ?>

				    <div class="form-group person_field template hide">
				        <label class="col-xs-2"></label>
				        <div class="col-xs-2">
				            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
				        </div>
				        <div class="col-xs-3">
				        	<select name="kepada[]" class="form-control form_jenis" tabindex="1" autofocus>
				        		<option value=""></option>
				            	<option value="external">Eksternal</option>
				            	<option value="internal">Internal</option>
				            </select>
				        </div>
				        <div class="col-xs-5 person_field_2"></div>
				    </div>
				</div>
			</div>
			
		</div>

		<div class="dynamic_field">
		    <div class="form-group row">
		    	<label class="col-xs-1">Perintah</label>
		        <div class="col-xs-7"> 
		            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
		        </div>
		    </div>

		    <?php foreach ($perintah as $value) { ?>
			    <div class="form-group clone">
			    	<div class="col-xs-1"></div>
			        <div class="col-xs-1">
			            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
			        </div>

			        <div class="col-xs-6">
			        	<textarea name="perintah[]" class="form-control" tabindex="1" autofocus placeholder="Perintah..."><?php echo $value->isi?></textarea>
			        </div>
			    </div>
		    <?php } ?>

		    <div class="form-group template hide">
		    	<div class="col-xs-1"></div>
		        <div class="col-xs-1">
		            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
		        </div>
		        <div class="col-xs-6">
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
			            <input type="text" name="tempat" autofocus tabindex="1" class="form-control" value='<?php echo $tempat; ?>' required>
			        </div>
			    </div>

			    <div class="form-group">
			        <label class="col-xs-2">Tanggal</label>
			        <div class="col-xs-10">
			            <input type="text" name="tanggal" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal; ?>' required>
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-xs-2">Nama Jabatan</label>
			        <div class="col-xs-10">
			            <input type="text" name="jabatan" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan; ?>' required>
			        </div>
			    </div>

			    <div class="form-group">
			        <label class="col-xs-2">Nama Lengkap</label>
			        <div class="col-xs-10">
			            <input type="text" name="nama" autofocus tabindex="1" class="form-control" value='<?php echo $nama; ?>' required>
			        </div>
			    </div>
			</div>
			<div class="col-lg-6">
				
			    <div class="form-group dynamic_field col-xs-12">
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
					        <div class="col-xs-3">
					        	<select name="tembusan[]" class="form-control form_jenis" tabindex="1" autofocus>
					        		<option value=""></option>
					            	<option value="external" <?php if($value->ext_tembusan != ''){ echo 'selected';}?>>Eksternal</option>
				            		<option value="internal" <?php if($value->int_tembusan != ''){ echo 'selected';}?>>Internal</option>
					            </select>
					        </div>
					        <div class="col-xs-5 person_field_2">
					        	<?php if ($value->ext_tembusan != '') { ?>
				            		<input type='text' name='val_tembusan[]' autofocus tabindex='1' class='form-control' value='<?php echo $value->ext_tembusan; ?>' placeholder='Nama/Jabatan'>
				            	<?php } else if ($value->int_tembusan != '') { ?>
				            		<select name='val_tembusan[]' class='form-control' tabindex="1" autofocus>
										<option value=''>--Pilih Jabatan--</option>
										<?php foreach ($listAdmin as $value2) { ?>
											<option value='<?php echo $value2->id; ?>' <?php if($value->int_tembusan == $value2->id) { echo 'selected';}?> ><?php echo $value2->jabatan; ?></option>
										<?php } ?>
					            	</select>
				            	<?php } ?>
					        </div>
					    </div>
				    <?php } ?>

				    <div class="form-group person_field template hide">
				        <label class="col-xs-2"></label>
				        <div class="col-xs-2">
				            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
				        </div>
				        <div class="col-xs-3">
				        	<select name="tembusan[]" class="form-control form_jenis" tabindex="1" autofocus>
				        		<option value=""></option>
				            	<option value="external">Eksternal</option>
				            	<option value="internal">Internal</option>
				            </select>
				        </div>
				        <div class="col-xs-5 person_field_2"></div>
				    </div>
				</div>
			</div>
		</div>
		<tr><td colspan="2">
		<br><button type="submit" class="btn btn-success" tabindex="1" ><i class="icon icon-ok icon-white"></i> Simpan</button>
		<a href="<?php echo base_URL(); ?>admin/nota_dinas/view/request" class="btn btn-primary" tabindex="1" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
		</td></tr>
	</div>

	