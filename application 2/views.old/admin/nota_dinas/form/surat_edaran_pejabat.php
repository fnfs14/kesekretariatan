
<?php
if ($action == "edit_nota") {
	$id				= $request->ID;
	$instansi		= $detail->instansi;
	$nomor			= $detail->nomor;
	$tahun			= $detail->tahun;
	$judul			= $detail->judul;
	$tempat			= $detail->tempat;
	$tanggal		= $detail->tanggal;
	$jabatan		= $detail->jabatan;
	$nama			= $detail->nama;
	$yth 			= $yth;
	$poin 			= $poin;
	
} else {
	$id				= $request->ID;
	$instansi		= '';
	$nomor			= '';
	$tahun			= '';
	$judul			= '';
	$tempat			= '';
	$tanggal			= '';
	$jabatan		= '';
	$nama			= '';
	$yth 			= [];
	$poin 			= [];
	$poin[0] 		= new \stdClass();
	$poin[0]->judul = "Latar Belakang";
	$poin[0]->isi 	= "";
	$poin[1] 		= new \stdClass();
	$poin[1]->judul = "Maksud dan Tujuan";
	$poin[1]->isi 	= "";
	$poin[2] 		= new \stdClass();
	$poin[2]->judul = "Ruang Lingkup";
	$poin[2]->isi 	= "";
	$poin[3] 		= new \stdClass();
	$poin[3]->judul = "Dasar";
	$poin[3]->isi 	= "";
}
?>

			<div class="form-group">
				
				<div class="col-lg-6">
					<h2>Kepala Naskah</h2><br>
					<div class="form-group">
				        <label class="col-xs-4">Instansi</label>
				        <div class="col-xs-6">
				            <input type="text" name="instansi" autofocus tabindex="1" class="form-control" value='<?php echo $instansi; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-4">Judul</label>
				        <div class="col-xs-6">
				            <input type="text" name="judul" autofocus tabindex="1" class="form-control" value='<?php echo $judul; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-4">Nomor</label>
				        <div class="col-xs-6">
				            <input type="text" name="nomor" autofocus tabindex="1" class="form-control" value='<?php echo $nomor; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-4">Tahun</label>
				        <div class="col-xs-6">
				            <input type="text" name="tahun" autofocus tabindex="1" class="form-control" value='<?php echo $tahun; ?>'>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">
					<h2>Kaki Naskah</h2><br>
					<div class="form-group">
				        <label class="col-xs-4">Ditetapkan di</label>
				        <div class="col-xs-6">
				            <input type="text" name="tempat" autofocus tabindex="1" class="form-control" value='<?php echo $tempat; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-4">Pada Tanggal</label>
				        <div class="col-xs-6">
				            <input type="text" name="tanggal" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-4">Nama Jabatan</label>
				        <div class="col-xs-6">
				            <input type="text" name="jabatan" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-4">Nama Lengkap</label>
				        <div class="col-xs-6">
				            <input type="text" name="nama" autofocus tabindex="1" class="form-control" value='<?php echo $nama; ?>'>
				        </div>
				    </div>

				    
				</div>
			</div>
			<hr style="border-color:#cccccc">
			<h2>Tujuan Surat</h2>
			<div class="form-group">
				
		    	<div class="dynamic_field level-1 col-xs-12">
				    <div class="form-group row">
				        <label class="col-xs-1">Yth.</label>
				        <div class="col-xs-8"> 
				            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
				        </div>
				    </div>

				    <?php foreach ($yth as $key => $value) { ?>
				    	<div class="form-group clone" data-id="<?php echo $key+1 ?>">
					    	<label class="col-xs-1"></label>

				    		<div class="form-group col-xs-8">
						        <div class="col-xs-1">
						            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
						        </div>
						        <label class="col-xs-2">Jabatan/Nama Yang Dituju </label>
						        <div class="col-xs-9">
						        	<input type="text" name="yth[]" autofocus tabindex="1" class="form-control" value=<?php echo $value->nama ?>  >
						        </div>
						    </div>
					    </div>
				    <?php } ?>

				    <div class="form-group template hide">
				    	<label class="col-xs-1"></label>
			    		<div class="form-group col-xs-8">
					        <div class="col-xs-1">
					            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
					        </div>
					        <label class="col-xs-2">Jabatan/Nama Yang Dituju </label>
					        <div class="col-xs-9">
					        	<input type="text" name="yth[]" autofocus tabindex="1" class="form-control" >
					        </div>
					    </div>
				    </div>
				</div>
			</div>
			<hr style="border-color:#cccccc">
			<h2>Batang Tubuh</h2><br>
			<div class="form-group">
		    	<div class="dynamic_field level-1 col-xs-12">
		    		
				    <div class="form-group row">
				        <label class="col-xs-1">Isi Surat</label>
				        <div class="col-xs-8"> 
				            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
				        </div>
				    </div>

				    <?php foreach ($poin as $key => $value) { ?>
				    	<div class="form-group clone" data-id="<?php echo $key+1 ?>">
					    	<label class="col-xs-1"></label>
					    	<div class="col-xs-8">
					    		<div class="form-group">
							        <div class="col-xs-1">
							            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
							        </div>
							        <label class="col-xs-2">Judul Poin</label>
							        <div class="col-xs-9">
							        	<input type="text" name="poin[]" autofocus tabindex="1" class="form-control" value="<?php echo $value->judul?>">
							        </div>
							    </div>
							    <div class="form-group">
							        <div class="col-xs-1">
							        </div>
							        <label class="col-xs-2">Isi Poin</label>
							        <div class="col-xs-9">
							        	<textarea name="isi[]" id="isi[<?php echo $key+1 ?>]" class="form-control editor-simple" rows="5"><?php echo $value->isi ?></textarea>
							        </div>
							    </div>
							</div>
					    </div>
				    <?php } ?>

				    <div class="form-group template hide">
				    	<label class="col-xs-1"></label>
				    	<div class="col-xs-8">
				    		<div class="form-group">
						        <div class="col-xs-1">
						            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
						        </div>
						        <label class="col-xs-2">Judul Poin</label>
						        <div class="col-xs-9">
						        	<input type="text" name="poin[]" autofocus tabindex="1" class="form-control" >
						        </div>
						    </div>
						    <div class="form-group">
						        <div class="col-xs-1">
						        </div>
						        <label class="col-xs-2">Isi Poin</label>
						        <div class="col-xs-9">
						        	<textarea name="isi[]" id="isi[]" class="form-control editor-simple" rows="5"></textarea>
						        </div>
						    </div>
						</div>
				    </div>
				</div>
			</div>

	