<?php
	
	$logo = ($detail->logo != '') ? $detail->logo : 'NO IMAGE';
	$nama_instansi = ($detail->nama_instansi != '') ? $detail->nama_instansi : '<span style="color:#dddddd;">NAMA INSTANSI</span>';
	$alamat_instansi = ($detail->alamat_instansi != '') ? $detail->alamat_instansi : '<span style="color:#dddddd;">JALAN.............................</span>';
	$telepon_instansi = ($detail->telepon_instansi != '') ? $detail->telepon_instansi : '<span style="color:#dddddd;">..........................</span>';
	$faksimile_instansi = ($detail->faksimile_instansi != '') ? $detail->faksimile_instansi : '<span style="color:#dddddd;">..........................</span>';

	$nomor = ($detail->nomor != '') ? $detail->nomor : '<span style="color:#dddddd;">............................................................. </span>';
	$sifat = ($detail->sifat != '') ? $detail->sifat : '<span style="color:#dddddd;">............................................................. </span>';

	$lampiran = ($detail->lampiran != '') ? (($detail->lampiran > 0 ) ? $detail->lampiran : "-") : '<span style="color:#dddddd;">............................................................. </span>';

	$hal = ($detail->hal != '') ? $detail->hal : '<span style="color:#dddddd;">............................................................. </span>';

	$tempat = ($detail->tempat != '') ? $detail->tempat : '<span style="color:#dddddd;">...(Tempat)</span>';
	setlocale(LC_TIME, 'id');
	$tanggal = ($detail->tanggal != '') ? strftime("%#d %B %Y", strtotime($detail->tanggal)) : '<span style="color:#dddddd;">...(Tgl.,Bln.,Thn.)</span>';


	$yth = ($detail->yth != '') ? $detail->yth : '<span style="color:#dddddd;">.............................................................</span>';

	$alamat = ($detail->alamat != '') ? $detail->alamat : '<span style="color:#dddddd;">.....................................................................<br>
		.....................................................................</span>';

	$pembuka = ($detail->pembuka != '') ? $detail->pembuka : '<span style="color:#dddddd;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';
	$isi = ($detail->isi != '') ? $detail->isi : '<span style="color:#dddddd;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';

	$penutup = ($detail->penutup != '') ? $detail->penutup : '<span style="color:#dddddd;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';

	$jabatan = ($detail->jabatan != '') ? $detail->jabatan : '<span style="color:#dddddd;">Nama Jabatan</span>';
	$nama = ($detail->nama != '') ? $detail->nama : '<span style="color:#dddddd;">Nama Lengkap</span>';

	$tembusan = [];
	foreach ($tembusan_nota as $key => $value) {
		if ($value->isi != '') {
			$tembusan[$key] = $value->isi;
		} else {
			$tembusan[$key] = '<span style="color:#dddddd;">.......................................</span>';
		}
	}
?>

<body contenteditable="true" class="cke_editable cke_editable_themed cke_contents_ltr cke_table-faked-selection-editor" spellcheck="false">
	<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:100%;" class="cke_show_border cke_table-faked-selection-table">
		<tbody>
			<tr>
				<th style="width: 10%; height: 100px; vertical-align: middle;" class="cke_table-faked-selection">
					<img alt="<?php echo $logo ?>" data-cke-saved-src="<?php echo base_url().$logo ?>" src="<?php echo base_url().$logo ?>" style="border-width: 0px; border-style: solid;">
				</th>
				<th>
					<span style="font-size:18px;">
						<?php echo $nama_instansi ?>
					</span>
					<br>
					<span style="font-size:14px;">
						<?php echo $alamat_instansi ?>, 
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
	<table border="0" cellspacing="1" cellpadding="0" style="width:100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="width: 16%;">
					<font face="Arial, Helvetica, sans-serif">
						Nomor
					</font>
				</td>
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						: <?php echo $nomor ?>
					</span>
				</td>
				<td style="text-align: right;">
					<?php echo $tempat ?>, <?php echo $tanggal ?>
				</td>
			</tr>
			<tr>
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						Sifat
					</span>
				</td>
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						: <?php echo $sifat ?>
					</span>
				</td>
				<td>
					<br>
				</td>
			</tr>
			<tr>
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						Lampiran
					</span>
				</td>
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						: <?php echo $lampiran ?>
					</span>
				</td>
				<td>
					<br>
				</td>
			</tr>
			<tr>
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						Hal
					</span>
				</td>
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						: <?php echo $hal ?>
					</span>
				</td>
				<td>
					<br>
				</td>
			</tr>	
		</tbody>
	</table>
	<p>
		<br>
	</p>
	<p>
		Yth. <?php echo $yth ?><br>
		<?php echo $alamat ?><br>
	</p>
	<p>
		<br>
	</p>
	<table border="0" cellspacing="0" cellpadding="0" style="width:100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="text-align: justify;">
					<?php echo $pembuka ?>
				</td>
			</tr>
			<tr>
				<td style="text-align: justify;">
					<br>
				</td>
			</tr>
			<tr>
				<td style="text-align: justify;">
					<?php echo $isi ?>
				</td>
			</tr>
			<tr>
				<td style="text-align: justify;">
					<br>
				</td>
			</tr>
			<tr>
				<td style="text-align: justify;">
					<?php echo $penutup ?>
				</td>
			</tr>
		</tbody>
	</table>
	<p>
		<br>
	</p>
	<table border="0" align="center" cellspacing="1" cellpadding="1" style="width:100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style='width:60%'>
				</td>
				<td style="text-align: center;">
					<?php echo $jabatan ?>
				</td>
			</tr>
			<tr style="height: 40px;">
				<td >
					<br>
				</td>
			</tr>
			<tr>
				<td>
					<br>
				</td>
				<td style="text-align: center;">
					<?php echo $nama ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php if (sizeof($tembusan) > 0) { ?>
		<table border="0" cellspacing="1" cellpadding="1" style="width:100%;" class="cke_show_border">
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