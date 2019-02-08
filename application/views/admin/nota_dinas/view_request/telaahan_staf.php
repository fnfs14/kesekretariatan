<?php
	$jenis_surat = $jenis_surat->jenis_surat;

	$tentang 		= $data->tentang;
	$persoalan 		= $data->persoalan;
	$praanggapan 		= $data->praanggapan;
	$fakta 		= $data->fakta;
	$analisis 		= $data->analisis;
	$simpulan 		= $data->simpulan;
	$saran 		= $data->saran;
	$jabatan	= $data->jabatan;
	$nama		= $data->nama;

	$html = $html;

?>

<div id=content_request>
	<ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#detail_request">Data Request</a></li>
        <li><a data-toggle="tab" href="#list_komentar">Komentar</a></li>
        <li><a data-toggle="tab" href="#preview_dokumen">Preview</a></li>
    </ul>
    <div class="tab-content">
    	<div class="tab-pane fade in active" id="detail_request">
    		<hr>
    		Jenis Surat : <?php echo $jenis_surat; ?>
    		<hr>
    		Nama        : <?php echo $nama; ?><br>
    		Jabatan     : <?php echo $jabatan; ?><br>
    		Tentang     : <?php echo $tentang; ?>
    		<hr>
    		Persoalan<br>
			<?php echo $persoalan; ?>
			<hr>
			Praanggapan<br>
			<?php echo $praanggapan; ?>
			<hr>
			Fakta<br>
			<?php echo $fakta; ?>
			<hr>
			Analisis<br>
			<?php echo $analisis; ?>
			<hr>
			Simpulan<br>
			<?php echo $simpulan; ?>
			<hr>
			Saran<br>
			<?php echo $saran; ?>
			<hr>
		</div>
		<div class="tab-pane fade" id="list_komentar">
			<textarea class='editor-view' id='content_komentar'>
				<?php foreach($listKomentar as $value) { ?>
					<strong>
						[<?php echo strftime("%A, %#d %B %Y | %H:%M", strtotime($value->created_at)) ?>]<br>
						[<?php echo str_replace('|expired', '', $value->flag)?> by <?php echo $value->jabatan?>]
					</strong><br>
					<?php echo $value->komentar?><br>
					<br>
				<?php } ?>
			</textarea>
		</div>
		<div class="tab-pane fade" id="preview_dokumen">
			<textarea disabled id='textarea-preview-request' class='editor-view'><?php echo $html ?></textarea>
		</div>
	</div>
</div>