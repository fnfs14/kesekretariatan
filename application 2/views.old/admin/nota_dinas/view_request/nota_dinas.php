<?php
	$jenis_surat = $jenis_surat->jenis_surat;
	$nomor = $data->nomor;
	$instansi = $data->instansi;
	$dari = '';
	if($data->ext_dari != '') {
		$dari = $data->ext_dari;
	} else if($data->int_dari != '') {
		foreach ($listAdmin as $value) {
			if($value->id == $data->int_dari) {
				$dari = $value->jabatan;			
			}
		}
	}
	$yth = '';
	if($data->ext_yth != '') {
		$yth = $data->ext_yth;
	} else if($data->int_yth != '') {
		foreach ($listAdmin as $value) {
			if($value->id == $data->int_yth) {
				$yth = $value->jabatan;			
			}
		}
	}

	setlocale(LC_TIME, 'id');
	$tanggal = strftime("%#d %B %Y", strtotime($data->tanggal));
	$hal = $data->hal;
	$isi = $data->isi;
	$nama_ttd = $data->nama_ttd;
	foreach ($tembusan as $key => $value) {
		if($value->int_tembusan == '') {
			$tembusan[$key] = $value->ext_tembusan;
		} else {
			foreach ($listAdmin as $value2) {
				if($value2->id == $value->int_tembusan) {

				$tembusan[$key] = $value2->jabatan;			
				}
			}
		}
	}

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
			Jenis Surat : <?php echo $jenis_surat; ?><hr>
			Nomor		: <?php echo $nomor; ?><hr>

			Instansi 	: <?php echo $instansi; ?><hr>
			
			Tanggal		: <?php echo $tanggal; ?><br>
			Yth		: <?php echo $yth; ?><br>
			Dari 	 	: <?php echo $dari; ?><br>
			
			Hal 		: <?php echo $hal; ?><hr>
			Isi 		: <br><?php echo $isi; ?><hr>

			Nama TTD	: <?php echo $nama_ttd; ?><hr>
			Tembusan :<br>
			<?php 
				$no = 1;
				foreach ($tembusan as $value) {

					echo $no.". ".$value."<br>";
					$no++;
				}
			?>
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