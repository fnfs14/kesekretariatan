<?php
	$jenis_surat = $jenis_surat->jenis_surat;

	$logo			= $data->logo;
	$nama_instansi 	= $data->nama_instansi;
	$alamat_instansi = $data->alamat_instansi;
	$telepon_instansi	= $data->telepon_instansi;
	$faksimile_instansi = $data->faksimile_instansi;
	$tentang			= $data->tentang;
	$tempat			= $data->tempat;
	setlocale(LC_TIME, 'id');
	$tanggal = strftime("%#d %B %Y", strtotime($data->tanggal));
	$jabatan		= $data->jabatan;
	$nama			= $data->nama;
	$poin			= $poin;

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
    		Instansi    : <?php echo $nama_instansi; ?><br>
    		Alamat      : <?php echo $alamat_instansi; ?><br>
    		Telepon     : <?php echo $telepon_instansi; ?><br>
    		Faksimile   : <?php echo $faksimile_instansi; ?>
    		<hr>
			Tentang  	: <?php echo $tentang; ?>
			<hr>
			<?php 
				foreach ($poin as $value) {
					echo "<strong>".$value->judul."</strong><br>";
					echo $value->isi;
					echo "<hr>";
				}
			?>
			TTD<br>
			Tempat	: <?php echo $tempat; ?><br>
			Tanggal	: <?php echo $tanggal; ?><br>
			Nama	: <?php echo $nama; ?><br>
			Jabatan	: <?php echo $jabatan; ?>

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