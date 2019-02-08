
<?php
if ($action == "edit_nota") {
	$id				= $request->ID;
	$instansi		= $detail->instansi;
	$nomor 			= $detail->nomor;
	$tahun 			= $detail->tahun;
	$judul			= $detail->judul;
	$konsiderans 	= $konsiderans;
	$dasar_hukum 	= $dasar_hukum;
	$nama_keputusan = $detail->nama_keputusan;
	$tentang 		= $detail->tentang;
	$keputusan		= $keputusan;
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
	$konsiderans 	= [];
	$dasar_hukum 	= [];
	$nama_keputusan	= '';
	$tentang 		= '';
	$keputusan		= [];
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
				        <label class="col-xs-4">Instansi</label>
				        <div class="col-xs-6">
				            <input type="text" name="instansi" autofocus tabindex="1" class="form-control" value='<?php echo $instansi; ?>'>
				        </div>
				    </div>

					<div class="form-group">
				        <label class="col-xs-4">Nomor</label>
				        <div class="col-xs-6">
				            <input type="text" name="nomor" autofocus tabindex="1" class="form-control" value='<?php echo $nomor; ?>'>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">
				    <div class="form-group">
				        <label class="col-xs-4">Tahun</label>
				        <div class="col-xs-6">
				            <input type="text" name="tahun" autofocus tabindex="1" class="form-control" value='<?php echo $tahun; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-4">Judul</label>
				        <div class="col-xs-6">
				            <input type="text" name="judul" autofocus tabindex="1" class="form-control" value='<?php echo $judul; ?>'>
				        </div>
				    </div>
				</div>
			</div>
			<hr style="border-color:#cccccc">
			<div class="form-group">
				<div class="col-lg-6">
					<h2>Konsiderans</h2><br>
			    	<div class="dynamic_field">
					    <div class="form-group row">
					        
					        <div class="col-xs-12"> 
					            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
					        </div>
					    </div>

					    <?php foreach ($konsiderans as $value) { ?>
						    <div class="form-group clone">
						        <div class="col-xs-2">
						            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
						        </div>

						        <div class="col-xs-10">
						        	<textarea name="konsiderans[]" class="form-control" tabindex="1" autofocus placeholder="Menimbang bahwa ....."><?php echo $value->isi?></textarea>
						        </div>
						    </div>
					    <?php } ?>

					    <div class="form-group template hide">
					        <div class="col-xs-2">
					            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
					        </div>
					        <div class="col-xs-10">
					        	<textarea name="konsiderans[]" class="form-control" tabindex="1" autofocus placeholder="Menimbang bahwa ....."></textarea>
					        </div>
					    </div>
					</div>
				</div>
				<div class="col-lg-6">
					<h2>Dasar Hukum</h2><br>
					<div class="dynamic_field">
					    <div class="form-group row">
					        <div class="col-xs-12"> 
					            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
					        </div>
					    </div>

					    <?php foreach ($dasar_hukum as $value) { ?>
						    <div class="form-group clone">
						        <div class="col-xs-2">
						            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
						        </div>

						        <div class="col-xs-10">
						        	<textarea name="dasar_hukum[]" class="form-control" tabindex="1" autofocus placeholder="Mengingat ....."><?php echo $value->isi?></textarea>
						        </div>
						    </div>
					    <?php } ?>

					    <div class="form-group template hide">
					        <div class="col-xs-2">
					            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
					        </div>
					        <div class="col-xs-10">
					        	<textarea name="dasar_hukum[]" class="form-control" tabindex="1" autofocus placeholder="Mengingat ....."></textarea>
					        </div>
					    </div>
					</div>
				</div>
			</div>

			<hr style="border-color:#cccccc">
			<h2>Isi Keputusan</h2><br>
		    <div class="form-group">
		        <label class="col-xs-2">Nama Keputusan</label>
		        <div class="col-xs-8">
		            <input type="text" name="nama_keputusan" autofocus tabindex="1" class="form-control" value='<?php echo $nama_keputusan; ?>'>
		        </div>
		    </div>

			<div class="form-group">
		        <label class="col-xs-2">Tentang</label>
		        <div class="col-xs-8">
		            <input type="text" name="tentang" autofocus tabindex="1" class="form-control" value='<?php echo $tentang; ?>'>
		        </div>
		    </div>

		    <div class="dynamic_field">
			    <div class="form-group row">
			        <label class="col-xs-2">Poin-poin Keputusan</label>
			        <div class="col-xs-8"> 
			            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
			        </div>
			    </div>

			    <?php foreach ($keputusan as $value) { ?>
				    <div class="form-group clone">
				        <label class="col-xs-2"></label>
				        <div class="col-xs-1">
				            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
				        </div>
				        <div class="col-xs-7">
				        	<textarea name="keputusan[]" class="form-control editor-field" tabindex="1" autofocus placeholder="Isi Keputusan ....."><?php echo $value->isi?></textarea>
				        </div>
				    </div>
			    <?php } ?>

			    <div class="form-group template hide">
			        <label class="col-xs-2"></label>
			        <div class="col-xs-1">
			            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
			        </div>
			        <div class="col-xs-7">
			        	<textarea name="keputusan[]" id="keputusan[]" class="form-control editor-field" tabindex="1" autofocus placeholder="Isi Keputusan ....."></textarea>
			        </div>
			    </div>
			</div>

			<hr style="border-color:#cccccc">
			<h2>Kaki Naskah</h2><br>
			<div class="form-group">
				<div class="col-lg-6">
				    <div class="form-group">
				        <label class="col-xs-4">Ditetapkan di</label>
				        <div class="col-xs-8">
				            <input type="text" name="tempat" autofocus tabindex="1" class="form-control" value='<?php echo $tempat; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-4">Pada Tanggal</label>
				        <div class="col-xs-8">
				            <input type="text" name="tanggal" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal; ?>'>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">

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

	