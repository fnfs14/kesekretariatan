<?php
	$jenis_surat = $jenis_surat->jenis_surat;
	$nomor = $data->nomor_surat;
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
	$untuk = '';
	if($data->ext_untuk != '') {
		$untuk = $data->ext_untuk;
	} else if($data->int_untuk != '') {
		foreach ($listAdmin as $value) {
			if($value->id == $data->int_untuk) {
				$untuk = $value->jabatan;			
			}
		}
	}

	setlocale(LC_TIME, 'id');
	$tanggal = strftime("%#d %B %Y", strtotime($data->tanggal_surat));
	$hal = $data->hal;
	$detail = $data->detail;

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
?>

<div id=content_request>
	<ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#detail_request">Data Request</a></li>
        <li><a data-toggle="tab" href="#list_komentar">Komentar</a></li>
    </ul>
    <div class="tab-content">
    	<div class="tab-pane fade in active" id="detail_request">
    		<hr>
			Jenis Surat : <?php echo $jenis_surat; ?><hr>
			Nomor		: <?php echo $nomor; ?><br>
			Tanggal		: <?php echo $tanggal; ?><hr>

			
			Dari 	 	: <?php echo $dari; ?><br>
			Untuk		: <?php echo $untuk; ?><br><hr>
			Hal 		: <?php echo $hal; ?><hr>
			Detail 		: <br><?php echo $detail; ?><hr>

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
	</div>
</div>