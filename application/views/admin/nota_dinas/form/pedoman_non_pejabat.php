
<?php
if ($action == "edit_nota") {
	$id				= $request->ID;
	$logo		= $detail->logo;
	$nama_instansi = $detail->nama_instansi;
	$alamat_instansi = $detail->alamat_instansi;
	$telepon_instansi	= $detail->telepon_instansi;
	$faksimile_instansi = $detail->faksimile_instansi;
	$lampiran		= $detail->lampiran;
	$judul			= $detail->judul;
	$jabatan		= $detail->jabatan;
	$nama			= $detail->nama;
	$bab 			= $bab;
	$subbab 		= $subbab;
	
} else {
	$id				= $request->ID;
	$logo		= '';
	$nama_instansi = '';
	$alamat_instansi = '';
	$telepon_instansi	= '';
	$faksimile_instansi = '';
	$lampiran		= '';
	$judul			= '';
	$jabatan		= '';
	$nama			= '';
	$bab 			= [];
	$bab[0] = new \stdClass();
	$bab[0]->ID = 1;
	$bab[0]->judul = "PENDAHULUAN";
	$subbab = [];
	$subbab[0] = new \stdClass();
	$subbab[0]->id_bab = 1;
	$subbab[0]->judul =  "Latar Belakang";
	$subbab[0]->isi = "";
	$subbab[1] = new \stdClass();
	$subbab[1]->id_bab = 1;
	$subbab[1]->judul =  "Maksud dan Tujuan";
	$subbab[1]->isi = "";
	$subbab[2] = new \stdClass();
	$subbab[2]->id_bab = 1;
	$subbab[2]->judul =  "Sasaran";
	$subbab[2]->isi = "";
	$subbab[3] = new \stdClass();
	$subbab[3]->id_bab = 1;
	$subbab[3]->judul =  "Asas";
	$subbab[3]->isi = "";
	$subbab[4] = new \stdClass();
	$subbab[4]->id_bab = 1;
	$subbab[4]->judul =  "Ruang Lingkup";
	$subbab[4]->isi = "";
	$subbab[5] = new \stdClass();
	$subbab[5]->id_bab = 1;
	$subbab[5]->judul =  "Pengertian Umum";
	$subbab[5]->isi = "";
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
			<div class="form-group">
				
				<div class="col-lg-6">
					<h2>Kepala Naskah</h2><br>
				    <div class="form-group">
				        <label class="col-xs-4">Judul</label>
				        <div class="col-xs-6">
				            <input type="text" name="judul" autofocus tabindex="1" class="form-control" value='<?php echo $judul; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-4">Lampiran</label>
				        <div class="col-xs-6">
				            <textarea name="lampiran" tabindex="1" autofocus class="form-control editor-simple" id="lampiran"><?php echo $lampiran?></textarea>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">
					<h2>Kaki Naskah</h2><br>
				    <div class="form-group">
				        <label class="col-xs-4">Nama Jabatan</label>
				        <div class="col-xs-8">
				            <input type="text" name="jabatan" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-4">Nama Lengkap</label>
				        <div class="col-xs-8">
				            <input type="text" name="nama" autofocus tabindex="1" class="form-control" value='<?php echo $nama; ?>'>
				        </div>
				    </div>

				    
				</div>
			</div>

			<hr style="border-color:#cccccc">
			
			<div class="form-group">
				
		    	<div class="dynamic_field level-1 col-xs-12">
		    		<h2>Isi Naskah</h2><br>
				    <div class="form-group row">
				        <label class="col-xs-1">Bab</label>
				        <div class="col-xs-11"> 
				            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
				        </div>
				    </div>

				    <?php foreach ($bab as $key => $value) { ?>
				    	<div class="form-group clone" data-id="<?php echo $key+1 ?>">
					    	<label class="col-xs-1"></label>
					    	<div class="col-xs-11">
					    		<div class="form-group">
							        <div class="col-xs-1">
							            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
							        </div>
							        <label class="col-xs-1">Judul Bab</label>
							        <div class="col-xs-10">
							        	<input type="text" name="bab[]" autofocus tabindex="1" class="form-control" value="<?php echo $value->judul ?>">
							        </div>
							    </div>
							    <div class="form-group">
							    	<label class="col-xs-2"></label>
							        <div class="dynamic_field col-xs-10">
									    <div class="form-group row">
									        <div class="col-xs-12"> 
									            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
									        </div>
									    </div>

									    <?php foreach ($subbab as $key2 => $value2) { ?>
									    	<?php if($value2->id_bab == $value->ID) {  ?>
										    	<div class="form-group clone" data-id="<?php echo $key2 ?>">
											    	<div class="form-group col-xs-12">
												        <div class="col-xs-1">
												            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
												        </div>
												        <label class="col-xs-1">Judul SubBab</label>
												        <div class="col-xs-10">
												        	<input type="text" name="judul_subbab<?php echo '['.$key.']' ?>[]" autofocus tabindex="1" class="form-control" value="<?php echo $value2->judul ?>">
												        </div>
												    </div>
												    <div class="form-group col-xs-12">
												    	<label class="col-xs-1"></label>
												        <label class="col-xs-1">Isi SubBab</label>
												        <div class="col-xs-10">
												        	<textarea name="isi_subbab<?php echo '['.$key.']' ?>[]" class="form-control editor-field" rows="5" id="isi_subbab[<?php echo $key ?>][<?php echo $key2 ?>]"><?php echo $value2->isi ?></textarea>
												        </div>
											        </div>
											    </div>
											<?php } ?>
									    <?php } ?>

									    <div class="form-group template hide">
									    	<div class="form-group col-xs-12">
										        <div class="col-xs-1">
										            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
										        </div>
										        <label class="col-xs-1">Judul SubBab</label>
										        <div class="col-xs-10">
										        	<input type="text" name="judul_subbab<?php echo '['.$key.']' ?>[]"" autofocus tabindex="1" class="form-control">
										        </div>
										    </div>
										    <div class="form-group col-xs-12">
										    	<label class="col-xs-1"></label>
										        <label class="col-xs-1">Isi SubBab</label>
										        <div class="col-xs-10">
										        	<textarea name="isi_subbab<?php echo '['.$key.']' ?>[]" class="form-control editor-field" id="isi_subbab<?php echo '['.$key.']' ?>[]" rows="5"></textarea>
										        </div>
									        </div>
									    </div>
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
						        <label class="col-xs-1">Judul Bab</label>
						        <div class="col-xs-10">
						        	<input type="text" name="bab[]" autofocus tabindex="1" class="form-control" >
						        </div>
						    </div>
						    <div class="form-group">
						    	<label class="col-xs-2"></label>
						        <div class="dynamic_field col-xs-10">
								    <div class="form-group row">
								        <div class="col-xs-12"> 
								            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
								        </div>
								    </div>

								    <div class="form-group template hide">
								    	<div class="form-group col-xs-12">
									        <div class="col-xs-1">
									            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
									        </div>
									        <label class="col-xs-1">Judul SubBab</label>
									        <div class="col-xs-10">
									        	<input type="text" name="judul_subbab[]" autofocus tabindex="1" class="form-control">
									        </div>
									    </div>
									    <div class="form-group col-xs-12">
									    	<label class="col-xs-1"></label>
									        <label class="col-xs-1">Isi SubBab</label>
									        <div class="col-xs-10">
									        	<textarea name="isi_subbab[]" id="isi_subbab[]" class="form-control editor-field" rows="5"></textarea>
									        </div>
								        </div>
								    </div>
								</div>
							</div>
						</div>
				    </div>
				</div>
			</div>