
<?php
if ($action == "edit_request") {
	$id			= $request->ID;
	$instansi  	= $data->instansi;
	$nomor 		= $data->nomor;
	$int_yth 	= $data->int_yth;
	$ext_yth	= $data->ext_yth;
	$int_dari   = $data->int_dari;
	$ext_dari   = $data->ext_dari;
	$hal 		= $data->hal;
	$tanggal 	= $data->tanggal;
	$isi 		= $data->isi;
	$nama_ttd	= $data->nama_ttd;
	$tembusan 	= $tembusan;
	$file		= $file;
	
} else if ($action == "edit_request_setum") {
	$id			= $request->ID;
	$instansi  	= $data->instansi;
	$nomor 		= $data->nomor;
	$int_yth 	= $data->int_yth;
	$ext_yth	= $data->ext_yth;
	$int_dari   = $data->int_dari;
	$ext_dari   = $data->ext_dari;
	$hal 		= $data->hal;
	$tanggal 	= $data->tanggal;
	$isi 		= $data->isi;
	$nama_ttd	= $data->nama_ttd;
	$tembusan 	= $tembusan;
}else {

	$id			= "";
	$instansi  	= "";
	$nomor 		= "";
	$int_yth 	= "";
	$ext_yth	= "";
	$int_dari   = "";
	$ext_dari   = "";
	$hal 		= "";
	$tanggal 	= "";
	$isi 		= "";
	$nama_ttd	= "";
	$ket		="";
	$file		="";
	$tembusan 	= [];
}
?>
<?php if ($action == "edit_request") { ?>
<div class="request_nota_dinas">
    <div class="form-group person_field">
        <label class="col-xs-2">Tujuan Surat</label>
        <div class="col-xs-2">
        	<select name="tujuan_surat" class="form-control form_jenis" tabindex="1" autofocus  required>
        		<option value=""></option>
            	<option value="Kapushidrosal">Kapushidrosal</option>
            	<option value="Jejeran Lain">Jejeran Lain</option>
            </select>
        </div>
	</div>

	
	<div class="form-group">
        <label class="col-xs-2">Instansi</label>
        <div class="col-xs-3">
            <textarea name="instansi" autofocus tabindex="1" class="form-control editor-simple" id="instansi" ><?php echo $instansi; ?></textarea>
        </div>
    </div>
	
	<div class="form-group">
        <label class="col-xs-2">Nomor Surat</label>
        <div class="col-xs-3">
            <input type="text" name="nomor_surat" autofocus tabindex="1" class="form-control" value='<?php echo $nomor; ?>' >
        </div>
    </div>
	
    <div class="form-group">
        <label class="col-xs-2">Hal</label>
        <div class="col-xs-3">
            <input type="text" name="hal" autofocus tabindex="1" class="form-control" value='<?php echo $hal; ?>' required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-2">Tanggal</label>
        <div class="col-xs-3">
            <input type="text" name="tanggal" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal; ?>' required>
        </div>
    </div>

    

    <div class="form-group">
        <label class="col-xs-2">Isi</label>
        <div class="col-xs-6">
            <textarea name="isi" tabindex="1" autofocus style="height:250px" class="editor-field" id="notaIsi" required><?php echo $isi; ?></textarea>
        </div>
    </div>
	
	<div class="form-group">
        <label class="col-xs-2">Lampiran</label>
        <div class="col-xs-6">
            <input type="file" name="file_nota" tabindex="1" class="form-control" style="width: 200px" value="<?php echo $file; ?>">
        </div>
    </div>

    <div class="dynamic_field">
	    <div class="form-group row">
	        <label class="col-xs-2">Tembusan</label>
	        <div class="col-xs-3" id="addTembusan"> 
	            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
	        </div>
	    </div>

	    <?php foreach ($tembusan as $value) { ?>
		    <div class="form-group person_field clone">
		        <label class="col-xs-2"></label>
		        <div class="col-xs-1">
		            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
		        </div>
		        <div class="col-xs-2">
		        	<select name="tembusan[]" class="form-control form_jenis" tabindex="1" autofocus>
        				<option value=""></option>
            			<option value="Kapushidrosal">Kapushidrosal</option>
            			<option value="Jejeran Lain">Jejeran Lain</option>
           			 </select>
		        </div>
		    </div>
	    <?php } ?>

	    <div class="form-group person_field template hide">
	        <label class="col-xs-2"></label>
	        <div class="col-xs-1">
	            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
	        </div>
	        <div class="col-xs-2">
	        	<select name="tembusan[]" class="form-control form_jenis" tabindex="1" autofocus>
        				<option value=""></option>
            			<option value="Kapushidrosal">Kapushidrosal</option>
            			<option value="Jejeran Lain">Jejeran Lain</option>
           			 </select>
	        </div>
	        <div class="col-xs-3 person_field_2"></div>
	    </div>
	</div>

    <tr><td colspan="2">
	<br><button type="submit" class="btn btn-success" tabindex="1" ><i class="icon icon-ok icon-white"></i> Simpan</button>
	<a href="<?php echo base_URL(); ?>admin/nota_dinas/view/request" class="btn btn-primary" tabindex="1" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
	</td></tr>
</div>
<?php } else if ($action == "edit_request_setum") {?>
<div class="request_nota_dinas">
    <div class="form-group">
        <label class="col-xs-2">Instansi</label>
        <div class="col-xs-3">
            <textarea name="instansi" autofocus tabindex="1" class="form-control editor-simple" id="instansi" required><?php echo $instansi; ?></textarea>
        </div>
    </div>

	<div class="form-group">
        <label class="col-xs-2">Nomor Surat</label>
        <div class="col-xs-3">
            <input type="text" name="nomor_surat" autofocus tabindex="1" class="form-control" value='<?php echo $nomor; ?>' required>
        </div>
    </div>

    <div class="form-group person_field">
        <label class="col-xs-2">Yth.</label>
        <div class="col-xs-2">
        	<select name="yth" class="form-control form_jenis" tabindex="1" autofocus  required>
        		<option value=""></option>
            	<option value="external" <?php if($ext_yth != ''){ echo 'selected';}?>>Eksternal</option>
            	<option value="internal" <?php if($int_yth != ''){ echo 'selected';}?>>Internal</option>
            </select>
        </div>
        <div class="col-xs-3 person_field_2">
        	<?php if ($ext_yth != '') { ?>
        		<input type='text' name='val_yth' autofocus tabindex='1' class='form-control' value='<?php echo $ext_yth; ?>' placeholder='Nama/Jabatan' required required>
        	<?php } else if ($int_yth != '') { ?>
        		<select name='val_yth' class='form-control' tabindex="1" autofocus required>
					<option value=''>--Pilih Jabatan--</option>
					<?php foreach ($listAdmin as $value) { ?>
						<option value='<?php echo $value->id; ?>' <?php if($int_yth == $value->id) { echo 'selected';}?> ><?php echo $value->jabatan; ?></option>
					<?php } ?>
            	</select>
        	<?php } ?>
        </div>
    </div>

    <div class="form-group person_field">
        <label class="col-xs-2">Dari</label>
        <div class="col-xs-2">
        	<select name="dari" class="form-control form_jenis" tabindex="1" autofocus required>
        		<option value=""></option>
            	<option value="external" <?php if($ext_dari != ''){ echo 'selected';}?>>Eksternal</option>
            	<option value="internal" <?php if($int_dari != ''){ echo 'selected';}?>>Internal</option>
            </select>
            
        </div>
        <div class="col-xs-3 person_field_2">
            	<?php if ($ext_dari != '') { ?>
            		<input type='text' name='val_dari' autofocus tabindex='1' class='form-control' value='<?php echo $ext_dari; ?>' placeholder='Nama/Jabatan' required>
            	<?php } else if ($int_dari != '') { ?>
            		<select name='val_dari' class='form-control' tabindex="1" autofocus required>
						<option value=''>--Pilih Jabatan--</option>
						<?php foreach ($listAdmin as $value) { ?>
							<option value='<?php echo $value->id; ?>' <?php if($int_dari == $value->id) { echo 'selected';}?> ><?php echo $value->jabatan; ?></option>
						<?php } ?>
	            	</select>
            	<?php } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-2">Hal</label>
        <div class="col-xs-3">
            <input type="text" name="hal" autofocus tabindex="1" class="form-control" value='<?php echo $hal; ?>' required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-2">Tanggal</label>
        <div class="col-xs-3">
            <input type="text" name="tanggal" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal; ?>' required>
        </div>
    </div>

    

    <div class="form-group">
        <label class="col-xs-2">Isi</label>
        <div class="col-xs-6">
            <textarea name="isi" tabindex="1" autofocus style="height:250px" class="editor-field" id="notaIsi" required><?php echo $isi; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-2">Nama Tanda Tangan</label>
        <div class="col-xs-3">
            <input type="text" name="nama_ttd" autofocus tabindex="1" class="form-control" value='<?php echo $nama_ttd; ?>' required>
        </div>
    </div>

    <div class="dynamic_field">
	    <div class="form-group row">
	        <label class="col-xs-2">Tembusan</label>
	        <div class="col-xs-3" id="addTembusan"> 
	            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
	        </div>
	    </div>

	    <?php foreach ($tembusan as $value) { ?>
		    <div class="form-group person_field clone">
		        <label class="col-xs-2"></label>
		        <div class="col-xs-1">
		            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
		        </div>
		        <div class="col-xs-2">
		        	<select name="tembusan[]" class="form-control form_jenis" tabindex="1" autofocus>
		        		<option value=""></option>
		            	<option value="external" <?php if($value->ext_tembusan != ''){ echo 'selected';}?>>Eksternal</option>
	            		<option value="internal" <?php if($value->int_tembusan != ''){ echo 'selected';}?>>Internal</option>
		            </select>
		        </div>
		        <div class="col-xs-3 person_field_2">
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
	        <div class="col-xs-1">
	            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
	        </div>
	        <div class="col-xs-2">
	        	<select name="tembusan[]" class="form-control form_jenis" tabindex="1" autofocus>
	        		<option value=""></option>
	            	<option value="external">Eksternal</option>
	            	<option value="internal">Internal</option>
	            </select>
	        </div>
	        <div class="col-xs-3 person_field_2"></div>
	    </div>
	</div>
<?php } else { ?>

<!-- bukan edit -->
<div class="row-fluid well" style="overflow: hidden">
	
	<div class="col-lg-12">
		<table width="100%" class="table-form">
		<tr>
			<td width="15%">Tujuan Surat</td>
			<td width="30%"><b><select name="tujuan_surat" class="form-control form_jenis" tabindex="1" autofocus  required>
        		<option value=""></option>
            	<option value="Kapushidrosal">Kapushidrosal</option>
            	<option value="Jejeran Lain">Jejeran Lain</option>
            </select></b></td>
			<td width="10%"></td>
			<td width="15%">Tanggal Surat</td>
			<td width="30%"><b><input type="text" name="tanggal" autofocus tabindex="2" class="form-control tgl" value='<?php echo $tanggal; ?>' required></b></td>
		</tr>
		<tr>
			<td>Nomor Surat</td>
			<td><b><input type="text" name="nomor_surat" autofocus tabindex="3" class="form-control" value='<?php echo $nomor; ?>' disabled="disabled" ></b></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Instansi</td>
			<td><b><textarea name="instansi" autofocus tabindex="1" class="form-control editor-simple" id="instansi" ><?php echo $instansi; ?></textarea></b></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td style="vertical-align: top;">Perihal</td>
			<td><b><input type="text" name="hal" autofocus tabindex="4" class="form-control" value='<?php echo $hal; ?>' required></b></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td style="vertical-align: top;">Isi Surat</td>
			<td colspan="4"><b> <textarea name="isi" tabindex="5" autofocus style="height:250px" class="editor-field" id="notaIsi" required><?php echo $isi; ?></textarea></b></td>
		</tr>
		<tr>
			<td width="20%">Lampiran</td>
			<td><b><input type="file" tabindex="6" name="file_surat" class="form-control" style=""></b></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td style="vertical-align: top;">Keterangan</td>
			<td colspan="4"><b><textarea tabindex="7" name="ket" required style="" rows="5" class="form-control"><?php echo $ket; ?></textarea></b></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		</table>
	</div>
	
	<div class="dynamic_field">
	    <div class="form-group row">
	        <label class="col-xs-2">Tembusan</label>
	        <div class="col-xs-3" id="addTembusan"> 
	            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
	        </div>
	    </div>

	    <?php foreach ($tembusan as $value) { ?>
		    <div class="form-group person_field clone">
		        <label class="col-xs-2"></label>
		        <div class="col-xs-1">
		            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
		        </div>
		        <div class="col-xs-2">
		        	<select name="tembusan[]" class="form-control form_jenis" tabindex="1" autofocus>
        				<option value=""></option>
            			<option value="5">KADIS A</option>
            			<option value="6">KADIS B</option>
           			 </select>
		        </div>
		    </div>
	    <?php } ?>

	    <div class="form-group person_field template hide">
	        <label class="col-xs-2"></label>
	        <div class="col-xs-1">
	            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
	        </div>
	        <div class="col-xs-2">
	        	<select name="tembusan[]" class="form-control form_jenis" tabindex="1" autofocus>
        				<option value=""></option>
            			<option value="5">KADIS A</option>
            			<option value="6">KADIS B</option>
           			 </select>
	        </div>
	        <div class="col-xs-3 person_field_2"></div>
	    </div>
	</div>
	
	</div>

    <tr><td colspan="2">
	<br><button type="submit" class="btn btn-success" tabindex="1" ><i class="icon icon-ok icon-white"></i> Simpan</button>
	<a href="<?php echo base_URL(); ?>admin/nota_dinas/view/request" class="btn btn-primary" tabindex="1" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
	</td></tr>
</div>
<?php } ?>