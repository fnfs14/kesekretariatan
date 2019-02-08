
<?php
if ($action == "edit_nota") {
	$id				= $request->ID;
	$instansi		= $detail->instansi;
	$nomor 			= $detail->nomor;
	$tahun 			= $detail->tahun;
	$judul			= $detail->judul;
	$alasan			= $detail->alasan;
	$kepada 		= $kepada;
	$instruksi		= $instruksi;
	$tempat 		= $detail->tempat;
	$tanggal 		= $detail->tanggal;
	$jabatan		= $detail->jabatan;
	$nama			= $detail->nama;
	
} else {
	$id				= $request->ID;
	$instansi		= '';
	$nomor 			= '';
	$tahun 			= '';
	$judul			= '';
	$alasan			= '';
	$kepada 		= [];
	$instruksi		= [];
	$tempat 		= '';
	$tanggal 		= '';
	$jabatan		= '';
	$nama			= '';
}
?>

			<h2>Kepala Naskah</h2><br>
			<div class="form-group">
				<div class="col-lg-6">
					
					<div class="form-group">
				        <label class="col-xs-2">Instansi</label>
				        <div class="col-xs-10">
				            <input type="text" name="instansi" autofocus tabindex="1" class="form-control" value='<?php echo $instansi; ?>'>
				        </div>
				    </div>

					<div class="form-group">
				        <label class="col-xs-2">Nomor</label>
				        <div class="col-xs-10">
				            <input type="text" name="nomor" autofocus tabindex="1" class="form-control" value='<?php echo $nomor; ?>'>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
				        <label class="col-xs-2">Tahun</label>
				        <div class="col-xs-10">
				            <input type="text" name="tahun" autofocus tabindex="1" class="form-control" value='<?php echo $tahun; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Judul</label>
				        <div class="col-xs-10">
				            <input type="text" name="judul" autofocus tabindex="1" class="form-control" value='<?php echo $judul; ?>'>
				        </div>
				    </div>
				</div>
			</div>
			<hr style="border-color:#cccccc">
			<h2>Isi Naskah</h2><br>
			<div class="form-group">
		        <label class="col-xs-1">Alasan</label>
		        <div class="col-xs-11">
		            <input type="text" name="alasan" autofocus tabindex="1" class="form-control" value='<?php echo $alasan; ?>'>
		        </div>
		    </div>
		    <br>
			<div class="form-group">
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
				<div class="col-lg-6">
					
					<div class="dynamic_field">
					    <div class="form-group row">
					    	<label class="col-xs-2">Instruksi</label>
					        <div class="col-xs-10"> 
					            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
					        </div>
					    </div>

					    <?php foreach ($instruksi as $value) { ?>
						    <div class="form-group clone">
						    	<div class="col-xs-2"></div>
						        <div class="col-xs-2">
						            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
						        </div>

						        <div class="col-xs-8">
						        	<textarea name="instruksi[]" class="form-control" tabindex="1" autofocus placeholder="Instruksi"><?php echo $value->isi?></textarea>
						        </div>
						    </div>
					    <?php } ?>

					    <div class="form-group template hide">
					    	<div class="col-xs-2"></div>
					        <div class="col-xs-2">
					            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
					        </div>
					        <div class="col-xs-8">
					        	<textarea name="instruksi[]" class="form-control" tabindex="1" autofocus placeholder="Instruksi"></textarea>
					        </div>
					    </div>
					</div>
				</div>
			</div>

			<hr style="border-color:#cccccc">
			<h2>Kaki Naskah</h2><br>
			<div class="form-group">
				<div class="col-lg-6">
				    <div class="form-group">
				        <label class="col-xs-2">Ditetapkan di</label>
				        <div class="col-xs-10">
				            <input type="text" name="tempat" autofocus tabindex="1" class="form-control" value='<?php echo $tempat; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Pada Tanggal</label>
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
