<?php
	$logo = ($detail->logo != '') ? $detail->logo : 'NO IMAGE';
	$nama_instansi = ($detail->nama_instansi != '') ? $detail->nama_instansi : '<span style="color:#dddddd;">NAMA INSTANSI</span>';
	$alamat_instansi = ($detail->alamat_instansi != '') ? $detail->alamat_instansi : '<span style="color:#dddddd;">JALAN.............................</span>';
	$telepon_instansi = ($detail->telepon_instansi != '') ? $detail->telepon_instansi : '<span style="color:#dddddd;">..........................</span>';
	$faksimile_instansi = ($detail->faksimile_instansi != '') ? $detail->faksimile_instansi : '<span style="color:#dddddd;">..........................</span>';

	$instansi = $nama_instansi;
	$nomor = ($detail->nomor != '') ? $detail->nomor : '<span style="color:#dddddd;">.......</span>';

	$pertimbangan = ($detail->pertimbangan != '') ? $detail->pertimbangan : '<span style="color:#dddddd;">............................................................. </span>';
	
	$tempat = ($detail->tempat != '') ? $detail->tempat : '<span style="color:#dddddd;">...(Tempat)</span>';
	setlocale(LC_TIME, 'id');
	$tanggal = ($detail->tanggal != '') ? strftime("%#d %B %Y", strtotime($detail->tanggal)) : '<span style="color:#dddddd;">...(Tgl.,Bln.,Thn.)</span>';


	$jabatan = ($detail->jabatan != '') ? $detail->jabatan : '<span style="color:#dddddd;">Nama Jabatan</span>';
	$nama = ($detail->nama != '') ? $detail->nama : '<span style="color:#dddddd;">Nama Lengkap</span>';

	$val_dasar = [];
	foreach ($dasar as $key => $value) {
		$val_dasar[$key] = ($value->isi != '') ? $value->isi : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';
	}

	$val_kepada = [];
	foreach ($kepada as $key => $value) {
		if ($value->int_kepada != '') {
			$i = 0;
			while($listAdmin[$i]->id != $value->int_kepada) {
				$i++;
			}
			$val_kepada[$key] = $listAdmin[$i]->jabatan;

		} else if ($value->ext_kepada != '') {
			$val_kepada[$key] = $value->ext_kepada;
		} else {
			$val_kepada[$key] = '<span style="color:#dddddd;">.......................................</span>';
		}
	}

	$val_perintah = [];
	foreach ($perintah as $key => $value) {
		$val_perintah[$key] = ($value->isi != '') ? $value->isi : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';
	}

	$tembusan = [];
	foreach ($tembusan_request as $key => $value) {
		if ($value->int_tembusan != '') {
			$i = 0;
			while($listAdmin[$i]->id != $value->int_tembusan) {
				$i++;
			}
			$tembusan[$key] = $listAdmin[$i]->jabatan;

		} else if ($value->ext_tembusan != '') {
			$tembusan[$key] = $value->ext_tembusan;
		} else {
			$tembusan[$key] = '<span style="color:#dddddd;">.......................................</span>';
		}
	}
?>

<body contenteditable="true" class="cke_editable cke_editable_themed cke_contents_ltr" spellcheck="false">
	<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:100%;" class="cke_show_border cke_table-faked-selection-table">
		<tbody>
			<tr>
				<th style="width: 10%; height: 100px; vertical-align: middle;" class="cke_table-faked-selection">
					<img alt="<?php echo base_url().$logo ?>" data-cke-saved-src="<?php echo base_url().$logo ?>" src="<?php echo base_url().$logo ?>" style="border-width: 0px; border-style: solid;">
				</th>
				<th>
					<span style="font-size:18px;">
						<?php echo $nama_instansi ?>
					</span>
					<br>
					<span style="font-size:14px;">
						<?php echo $alamat_instansi ?><br>
						Telp. <?php echo $telepon_instansi ?>, 
						Fax. <?php echo $faksimile_instansi ?>
					</span>
					<br>
				</th>
				<th style="width: 10%; height: 100px;">
				</th>
			</tr>
		</tbody>
	</table>
	<hr>
	<br>
	
	<table border="0" cellspacing="0" cellpadding="0" align="center" class="cke_show_border" style="width:100%;">
		<tbody>
			<tr>
				<th>
					<span style="font-size:18px;">
						SURAT PERINTAH
					</span><br>
					<span style="font-size:16px;">
						NOMOR : <?php echo $nomor ?>
					</span>
				</th>
			</tr>
			<tr>
				<td>
					<br>
				</td>
			</tr>
		</tbody>
	</table>
	
	
	<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
		<tbody>
			<tr>
				<td style="vertical-align: top; width:13%;">Pertimbangan
				</td>
				<td style="vertical-align: top; width:2%;">:
				</td>
				<td style="vertical-align: top; width:85%" rowspan="1" colspan="2"><?php echo $pertimbangan?>;
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;">
					<br>
				</td>
				<td style="vertical-align: top;">
					<br>
				</td>
				<td style="vertical-align: top;">
					<br>
				</td>
				<td style="vertical-align: top;">
					<br>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top; width:13%;">Dasar
				</td>
				<td style="vertical-align: top; width:2%;">:
				</td>
			<?php foreach ($val_dasar as $key => $value) {?>
				<td style="vertical-align: top; width:3%;"><?php echo $key+1 ?>.
				</td>
				<td style="vertical-align: top; width:83%;"><?php echo $value ?>;
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;">
					<br>
				</td>
				<td style="vertical-align: top;">
					<br>
				</td>
			<?php } ?>
				<td style="vertical-align: top;">
					<br>
				</td>
				<td style="vertical-align: top;">
					<br>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="text-align: center; vertical-align: top;">Memberi Perintah
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;">
					<br>
				</td>
				<td style="vertical-align: top;">
					<br>
				</td>
				<td style="vertical-align: top;">
					<br>
				</td>
				<td style="vertical-align: top;">
					<br>
				</td>
			</tr>
		</tbody>
	</table>
	<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
		<tbody>
			<tr>
				<td style="vertical-align: top; width:10%;">Kepada
				</td>
				<td style="vertical-align: top; width:2%;">:
				</td>

			<?php foreach ($val_kepada as $key => $value) {?>
				<td style="vertical-align: top; width:3%;"><?php echo $key+1 ?>.
				</td>
				<td style="vertical-align: top; width:85%;"><?php echo $value ?>;
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;">
					<br>
				</td>
				<td style="vertical-align: top;">
					<br>
				</td>
			<?php } ?>
				<td style="vertical-align: top;">
					<br>
				</td>
				<td style="vertical-align: top;">
					<br>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top; width:10%;">Untuk
				</td>
				<td style="vertical-align: top; width:2%;">:
				</td>
			<?php foreach ($val_perintah as $key => $value) {?>
				<td style="vertical-align: top; width:3%;"><?php echo $key+1 ?>.
				</td>
				<td style="vertical-align: top; width:85%;"><?php echo $value ?>;
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;">
					<br>
				</td>
				<td style="vertical-align: top;">
					<br>
				</td>
			<?php } ?>
				<td style="vertical-align: top;">
					<br>
				</td>
				<td style="vertical-align: top;">
					<br>
				</td>
			</tr>
			<tr style="height: 10px">
			</tr>
		</tbody>
	</table>
	<br>
	<table border="0" align="center" cellspacing="1" cellpadding="1" style="width:100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="width:70%">
				</td>
				<td>
					<?php echo $tempat ?>, <?php echo $tanggal ?>
				</td>
			</tr>
			<tr>
				<td style="width:70%">
				</td>
				<td>
					<?php echo $jabatan ?>,
				</td>
			</tr>
			<tr>
				<td style="height: 50px;"><br></td><td style="height: 50px;">
					<br>
				</td>
			</tr>
			<tr>
				<td>
					<br>
				</td>
				<td>
					<?php echo $nama ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php if (sizeof($tembusan) > 0) { ?>
		<table border="0" cellspacing="1" cellpadding="1" style="width:100%	;" class="cke_show_border">
			<tbody>
				<tr>
					<td>
						Tembusan:
					</td>
				</tr>
				<?php foreach ($tembusan as $key => $value) { ?>
					<tr>
						<td>
							<?php echo $key+1; ?>. <?php echo $value; ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php }?>
</body>