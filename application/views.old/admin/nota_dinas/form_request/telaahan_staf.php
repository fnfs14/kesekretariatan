
<?php
if ($action == "edit_request") {
	$id			= $request->ID;
	$tentang 		= $data->tentang;
	$persoalan 		= $data->persoalan;
	$praanggapan 		= $data->praanggapan;
	$fakta 		= $data->fakta;
	$analisis 		= $data->analisis;
	$simpulan 		= $data->simpulan;
	$saran 		= $data->saran;
	$jabatan	= $data->jabatan;
	$nama		= $data->nama;
	
} else {
	$id			= '';
	$tentang 		= '';
	$persoalan 		= '';
	$praanggapan 		= '';
	$fakta 		= '';
	$analisis 		= '';
	$simpulan 		= '';
	$saran 		= '';
	$jabatan	= '';
	$nama		= '';
}
?>

<div class="request_telaahan_staf">
	<input type='hidden' name='id' value='<?php echo $id;?>'>
    <div class="form-group">
        <label class="col-xs-2">Tentang</label>
        <div class="col-xs-3">
            <input type="text" name="tentang" autofocus tabindex="1" class="form-control" value='<?php echo $tentang; ?>' required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-2">Jabatan Pembuat</label>
        <div class="col-xs-3">
            <input type="text" name="jabatan" autofocus tabindex="1" class="form-control" value='<?php echo $jabatan; ?>' required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-2">Nama Lengkap Pembuat</label>
        <div class="col-xs-3">
            <input type="text" name="nama" autofocus tabindex="1" class="form-control" value='<?php echo $nama; ?>' required>
        </div>
    </div>


    <div class="form-group">
        <label class="col-xs-2">Persoalan</label>
        <div class="col-xs-6">
            <textarea name="persoalan" tabindex="1" autofocus style="height:250px" class="editor-field" id="persoalan"><?php echo $persoalan; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-2">Praanggapan</label>
        <div class="col-xs-6">
            <textarea name="praanggapan" tabindex="1" autofocus style="height:250px" class="editor-field" id="praanggapan"><?php echo $praanggapan; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-2">Fakta yang Mempengaruhi</label>
        <div class="col-xs-6">
            <textarea name="fakta" tabindex="1" autofocus style="height:250px" class="editor-field" id="fakta"><?php echo $fakta; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-2">Analisis</label>
        <div class="col-xs-6">
            <textarea name="analisis" tabindex="1" autofocus style="height:250px" class="editor-field" id="analisis"><?php echo $analisis; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-2">Simpulan</label>
        <div class="col-xs-6">
            <textarea name="simpulan" tabindex="1" autofocus style="height:250px" class="editor-field" id="simpulan"><?php echo $simpulan; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-2">Saran</label>
        <div class="col-xs-6">
            <textarea name="saran" tabindex="1" autofocus style="height:250px" class="editor-field" id="saran"><?php echo $saran; ?></textarea>
        </div>
    </div>

    <tr><td colspan="2">
	<br><button type="submit" class="btn btn-success" tabindex="1" ><i class="icon icon-ok icon-white"></i> Simpan</button>
	<a href="<?php echo base_URL(); ?>admin/nota_dinas/view/request" class="btn btn-primary" tabindex="1" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
	</td></tr>
</div>

