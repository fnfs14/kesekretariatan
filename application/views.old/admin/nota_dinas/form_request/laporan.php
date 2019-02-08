
<?php
if ($action == "edit_request") {
$id				= $request->ID;
$logo			= $data->logo;
$nama_instansi 	= $data->nama_instansi;
$alamat_instansi = $data->alamat_instansi;
$telepon_instansi	= $data->telepon_instansi;
$faksimile_instansi = $data->faksimile_instansi;
$tentang			= $data->tentang;
$tempat			= $data->tempat;
$tanggal		= $data->tanggal;
$jabatan		= $data->jabatan;
$nama			= $data->nama;
$poin 			= $poin;

} else {
$id				= '';
$logo			= '';
$nama_instansi 	= '';
$alamat_instansi = '';
$telepon_instansi	= '';
$faksimile_instansi = '';
$tentang			= '';
$tempat			= '';
$tanggal			= '';
$jabatan		= '';
$nama			= '';
$yth 			= [];
$poin 			= [];
$poin[0] 		= new \stdClass();
$poin[0]->judul = "Pendahuluan";
$poin[0]->isi 	= "";
$poin[1] 		= new \stdClass();
$poin[1]->judul = "Kegiatan Yang Dilaksanakan";
$poin[1]->isi 	= "";
$poin[2] 		= new \stdClass();
$poin[2]->judul = "Hasil yang Dicapai";
$poin[2]->isi 	= "";
$poin[3] 		= new \stdClass();
$poin[3]->judul = "Simpulan dan Saran";
$poin[3]->isi 	= "";
$poin[4] 		= new \stdClass();
$poin[4]->judul = "Penutup";
$poin[4]->isi 	= "";
}
?>

<div class="request_laporan">

	<input type='hidden' name='id' value='<?php echo $id;?>'>
	<h2>Data Instansi</h2><br>
	<div class="form-group">
		<div class="col-lg-6">
		    <div class="form-group">
		        <label class="col-xs-4">Logo<br>(.gif/.jpg/.png)</label>
		        <div class="image_field" file_index="0">
		        	<div class="col-xs-6">
		        		<input type="file" accept="image/*" name="logo" autofocus tabindex="1" class="form-control file" <?php echo ($action == "edit_request") ? '' : 'required' ?>>
		        	</div>
		        	<div class="col-xs-4 current_image">
		        		<?php if($logo != "") {?>
							<img alt="Current Logo" src="<?php echo base_url().$logo; ?>" style="border-width: 0px; border-style: solid;max-height: 100px; max-width: 100px;" >
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
		            <input type="text" name="nama_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $nama_instansi; ?>' required>
		        </div>
		    </div>
		</div>
		<div class="col-lg-6">
			
		    <div class="form-group">
		        <label class="col-xs-4">Alamat Instansi</label>
		        <div class="col-xs-6">
		            <input type="text" name="alamat_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $alamat_instansi; ?>' required>
		        </div>
		    </div>

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
		</div>
	</div>
	<hr style="border-color:#cccccc">
	<div class="form-group">
		
		<div class="col-lg-6">
			<h2>Kepala Naskah</h2><br>
		    <div class="form-group">
		        <label class="col-xs-4">Tentang</label>
		        <div class="col-xs-6">
		            <input type="text" name="tentang" autofocus tabindex="1" class="form-control" value='<?php echo $tentang; ?>' required>
		        </div>
		    </div>
		</div>
		<div class="col-lg-6">
			<h2>Kaki Naskah</h2><br>
			<div class="form-group">
		        <label class="col-xs-4">Ditetapkan di</label>
		        <div class="col-xs-6">
		            <input type="text" name="tempat" autofocus tabindex="1" class="form-control" value='<?php echo $tempat; ?>' required>
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-xs-4">Pada Tanggal</label>
		        <div class="col-xs-6">
		            <input type="text" name="tanggal" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal; ?>' required>
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-xs-4">Nama Jabatan</label>
		        <div class="col-xs-6">
		            <input type="text" name="jabatan" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan; ?>' required>
		        </div>
		    </div>

		    <div class="form-group">
		        <label class="col-xs-4">Nama Lengkap</label>
		        <div class="col-xs-6">
		            <input type="text" name="nama" autofocus tabindex="1" class="form-control" value='<?php echo $nama; ?>' required>
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
					        	<textarea name="isi[]" id="isi[<?php echo $key+1 ?>]" class="form-control editor-simple" rows="5" autofocus tabindex="1"><?php echo $value->isi ?></textarea>
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
				        	<textarea name="isi[]" id="isi[]" class="form-control editor-simple" rows="5" autofocus tabindex="1"></textarea>
				        </div>
				    </div>
				</div>
		    </div>
		</div>
	</div>

	

    <tr><td colspan="2">
	<br><button type="submit" class="btn btn-success" tabindex="1" ><i class="icon icon-ok icon-white"></i> Simpan</button>
	<a href="<?php echo base_URL(); ?>admin/nota_dinas/view/request" class="btn btn-primary" tabindex="1" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
	</td></tr>
</div>

