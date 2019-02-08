<?php
	if($action == 'edit_request') {
		$id = $request->ID;
		$tanggal = $data->tanggal_surat;
		$nomor = $data->nomor_surat;
		$int_dari = $data->int_dari;
		$ext_dari = $data->ext_dari;
		$int_untuk = $data->int_untuk;
		$ext_untuk = $data->ext_untuk;
		$hal = $data->hal;
		$detail = $data->detail;
        $tembusan = $tembusan;

	} else {
		$id = '';
		$tanggal = '';
		$nomor = '';
		$int_dari = '';
		$ext_dari = '';
		$int_untuk = '';
		$ext_untuk = '';
		$hal = '';
		$detail = '';
		$jenis_surat = '';
		$tembusan = [];
	}
?>
<div class="request_umum">
    <div class="form-group">
        <label class="col-xs-2">Nomor Surat</label>
        <div class="col-xs-3">
            <input type="text" name="nomor_surat" autofocus tabindex="1" class="form-control" value='<?php echo $nomor; ?>' required>
        </div>
    </div>

    <div class="form-group person_field">
        <label class="col-xs-2">Dari</label>
        <div class="col-xs-2">
        	<select name="pengirim" class="form-control form_jenis" tabindex="1" autofocus required>
        		<option value=""></option>
            	<option value="external" <?php if($ext_dari != ''){ echo 'selected';}?>>Eksternal</option>
            	<option value="internal" <?php if($int_dari != ''){ echo 'selected';}?>>Internal</option>
            </select>
            
        </div>
        <div class="col-xs-3 person_field_2">
            	<?php if ($ext_dari != '') { ?>
            		<input type='text' name='val_pengirim' autofocus tabindex='1' class='form-control' value='<?php echo $ext_dari; ?>' placeholder='Nama/Jabatan' required>
            	<?php } else if ($int_dari != '') { ?>
            		<select name='val_pengirim' class='form-control' tabindex="1" autofocus required>
    					<option value=''>--Pilih Jabatan--</option>
    					<?php foreach ($listAdmin as $value) { ?>
    						<option value='<?php echo $value->id; ?>' <?php if($int_dari == $value->id) { echo 'selected';}?> ><?php echo $value->jabatan; ?></option>
    					<?php } ?>
                	</select>
            	<?php } ?>
        </div>
    </div>

    <div class="form-group person_field">
        <label class="col-xs-2">Untuk</label>
        <div class="col-xs-2">
        	<select name="penerima" class="form-control form_jenis" tabindex="1" autofocus required>
        		<option value=""></option>
            	<option value="external" <?php if($ext_untuk != ''){ echo 'selected';}?> >Eksternal</option>
            	<option value="internal" <?php if($int_untuk != ''){ echo 'selected';}?>>Internal</option>
            </select>
            
        </div>
        <div class="col-xs-3 person_field_2">
        	<?php if ($ext_untuk != '') { ?>
        		<input type='text' name='val_penerima' autofocus tabindex='1' class='form-control' value='<?php echo $ext_untuk; ?>' placeholder='Nama/Jabatan' required>
        	<?php } else if ($int_untuk != '') { ?>
        		<select name='val_penerima' class='form-control' tabindex="1" autofocus required>
    				<option value=''>--Pilih Jabatan--</option>
    				<?php foreach ($listAdmin as $value) { ?>
    					<option value='<?php echo $value->id; ?>' <?php if($int_untuk == $value->id) { echo 'selected';}?> ><?php echo $value->jabatan; ?></option>
    				<?php } ?>
            	</select>
        	<?php } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-2">Tanggal</label>
        <div class="col-xs-3">
            <input type="text" name="tanggal" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal; ?>' required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-2">Hal</label>
        <div class="col-xs-3">
            <input type="text" name="hal" autofocus tabindex="1" class="form-control" value='<?php echo $hal; ?>' required>
        </div>
    </div>


    <div class="form-group">
        <label class="col-xs-2">Detail</label>
        <div class="col-xs-6">
            <textarea name="detail" tabindex="1" autofocus style="height:250px" class="editor-field" id="notaIsi" required><?php echo $detail; ?></textarea>
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
                <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
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

    <tr><td colspan="2">
    <br><button type="submit" class="btn btn-success" tabindex="1" ><i class="icon icon-ok icon-white"></i> Simpan</button>
    <a href="<?php echo base_URL(); ?>admin/nota_dinas/view/request" class="btn btn-primary" tabindex="1" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
    </td></tr>
</div>