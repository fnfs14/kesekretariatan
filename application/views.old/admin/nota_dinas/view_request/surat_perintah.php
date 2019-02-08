<?php
	$jenis_surat = $jenis_surat->jenis_surat;

	$nama_instansi = $data->nama_instansi;
	$alamat_instansi = $data->alamat_instansi;
	$telepon_instansi = $data->telepon_instansi;
	$faksimile_instansi = $data->faksimile_instansi;

	$nomor = $data->nomor;
	$pertimbangan = $data->pertimbangan;
	$tempat =$data->tempat;
	setlocale(LC_TIME, 'id');
	$tanggal = strftime("%#d %B %Y", strtotime($data->tanggal));
	$jabatan =$data->jabatan;
	$nama = $data->nama;


	foreach ($dasar as $key => $value) {
		$dasar[$key] = $value->isi;
	}

	foreach ($perintah as $key => $value) {
		$perintah[$key] = $value->isi;
	}
	foreach ($kepada as $key => $value) {
		if($value->int_kepada == '') {
			$kepada[$key] = $value->ext_kepada;
		} else {
			foreach ($listAdmin as $value2) {
				if($value2->id == $value->int_kepada) {

				$kepada[$key] = $value2->jabatan;			
				}
			}
		}
	}

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
    		Jenis Surat : <?php echo $jenis_surat; ?>
    		<hr>
    		Instansi    : <?php echo $nama_instansi; ?><br>
    		Alamat      : <?php echo $alamat_instansi; ?><br>
    		Telepon     : <?php echo $telepon_instansi; ?><br>
    		Faksimile   : <?php echo $faksimile_instansi; ?>
    		<hr>
			Nomor		: <?php echo $nomor; ?><br>
			<hr>
			Pertimbangan<br>
			<?php echo $pertimbangan; ?>
			<hr>
			Dasar<br>
			<?php 
				$no = 1;
				foreach ($dasar as $value) {

					echo $no.". ".$value."<br>";
					$no++;
				}
			?>
			<hr>
			Kepada<br>
			<?php 
				$no = 1;
				foreach ($kepada as $value) {
					echo $no.". ".$value."<br>";
					$no++;
				}
			?>
			<hr>
			Untuk<br>
			<?php 
				$no = 1;
				foreach ($perintah as $value) {
					echo $no.". ".$value."<br>";
					$no++;
				}
			?>
			<hr>
			TTD<br>
			Tempat	: <?php echo $tempat; ?><br>
			Tanggal	: <?php echo $tanggal; ?><br>
			Nama	: <?php echo $nama; ?><br>
			Jabatan	: <?php echo $jabatan; ?>

			<hr>
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