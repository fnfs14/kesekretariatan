<?php
	$nomor = ($detail->nomor != '') ? $detail->nomor : '<span style="color:#dddddd;">............................................................. </span>';
	$instansi = ($detail->instansi != '') ? $detail->instansi : '<span style="color:#dddddd;">.....(INSTANSI)..... </span>';
	$sifat = ($detail->sifat != '') ? $detail->sifat : '<span style="color:#dddddd;">............................................................. </span>';

	$lampiran = ($detail->lampiran != '') ? (($detail->lampiran > 0 ) ? $detail->lampiran : "-") : '<span style="color:#dddddd;">............................................................. </span>';

	$hal = ($detail->hal != '') ? $detail->hal : '<span style="color:#dddddd;">............................................................. </span>';

	$tempat = ($detail->tempat != '') ? $detail->tempat : '<span style="color:#dddddd;">...(Tempat)</span>';
	setlocale(LC_TIME, 'id');
	$tanggal = ($detail->tanggal != '') ? strftime("%#d %B %Y", strtotime($detail->tanggal)) : '<span style="color:#dddddd;">...(Tgl.,Bln.,Thn.)</span>';


	$yth = ($detail->yth != '') ? $detail->yth : '<span style="color:#dddddd;">.............................................................</span>';

	$alamat = ($detail->alamat != '') ? $detail->alamat : '<span style="color:#dddddd;">.....................................................................<br>
		.....................................................................</span>';

	$pembuka = ($detail->pembuka != '') ? $detail->pembuka :'<span style="color:#dddddd;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';

	$isi = ($detail->isi != '') ? $detail->isi : '<span style="color:#dddddd;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';
	$penutup = ($detail->penutup != '') ? $detail->penutup : '<span style="color:#dddddd;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';

	$jabatan = ($detail->jabatan != '') ? $detail->jabatan : '<span style="color:#dddddd;">.....(JABATAN).....</span>';
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

<body contenteditable="true" class="cke_editable cke_editable_themed cke_contents_ltr" spellcheck="false">
	<p style="text-align: center;">
		<img alt="" data-cke-saved-src="http://localhost/notadinas_umum/aset/img/lambang_negara_1.jpg" src="http://localhost/notadinas_umum/aset/img/lambang_negara_1.jpg" style="border-width: 0px; border-style: solid; width: 12%;">
	</p>
	<table border="0" cellspacing="0" cellpadding="0" align="center" class="cke_show_border" style="width:100%;">
		<tbody>
			<tr>
				<th>
					<span style="font-size:14px;">
						<?php echo strtoupper($jabatan); ?>
						<br>
						<?php echo strtoupper($instansi); ?>
					</span>
				</th>
			</tr>
		</tbody>
	</table>
	<p>
		<br>
	</p>
	<p>
		<br>
	</p>
	<table border="0" cellspacing="1" cellpadding="0" style="width:100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="width: 12%;">
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