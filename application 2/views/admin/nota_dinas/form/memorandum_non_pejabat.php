
<?php
if ($action == "edit_nota") {
	$id			= $request->ID;
	$nama_instansi 	= $detail->nama_instansi;
	$nomor 		= $detail->nomor;
	$yth   = $detail->yth;
	$dari   = $detail->dari;
	$hal 		= $detail->hal;
	$tanggal 	= $detail->tanggal;
	$isi 		= $detail->isi;
	$nama_ttd	= $detail->nama_ttd;
	$tembusan 	= $tembusan_nota;
	
} else {
	$id			= $request->ID;
	$nama_instansi 	= "";
	$nomor 		= "";
	$yth   		= "";
	$dari   	= "";
	$hal 		= "";
	$tanggal 	= "";
	$isi 		= "";
	$nama_ttd	= "";
	$tembusan 	= [];
}
?>
			<div class="form-group">
				<div class="col-lg-6">
					<div class="form-group">
				        <label class="col-xs-2">Nama Instansi</label>
				        <div class="col-xs-10">
				            <input type="text" name="nama_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $nama_instansi; ?>'>
				        </div>
				    </div>

					<div class="form-group">
				        <label class="col-xs-2">Nomor Surat</label>
				        <div class="col-xs-10">
				            <input type="text" name="nomor_surat" autofocus tabindex="1" class="form-control" value='<?php echo $nomor; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Yth</label>
				        <div class="col-xs-10">
				            <input type="text" name="yth" autofocus tabindex="1" class="form-control" value='<?php echo $yth; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Dari</label>
				        <div class="col-xs-10">
				            <input type="text" name="dari" autofocus tabindex="1" class="form-control" value='<?php echo $dari; ?>'>
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
				        <label class="col-xs-2">Tanggal</label>
				        <div class="col-xs-10">
				            <input type="text" name="tanggal" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal; ?>'>
				        </div>
				    </div>

				    <div class="form-group">
				        <label class="col-xs-2">Nama Tanda Tangan</label>
				        <div class="col-xs-10">
				            <input type="text" name="nama_ttd" autofocus tabindex="1" class="form-control" value='<?php echo $nama_ttd; ?>'>
				        </div>
				    </div>
				</div>
			</div>
			
			<hr style="border-color: #cccccc">

		    <div class="form-group">
		        <label class="col-xs-1">Isi</label>
		        <div class="col-xs-11">
		            <textarea name="isi" tabindex="1" autofocus style="height:250px" class="editor-field" id="notaIsi"><?php echo $isi; ?></textarea>
		        </div>
		    </div>

		    <hr style="border-color: #cccccc">

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
