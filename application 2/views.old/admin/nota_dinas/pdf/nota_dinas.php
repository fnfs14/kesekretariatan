<?php
	$instansi = ($detail->instansi != '') ? $detail->instansi : '<span style="color:#dddddd;">.....(INSTANSI).....</span>';
	$nomor = ($detail->nomor != '') ? $detail->nomor : '<span style="color:#dddddd;">ND - ../...../BULAN/TAHUN</span>';
	$yth = ($detail->yth != '') ? $detail->yth : '<span style="color:#dddddd;">.............................................................</span>';
	$dari = ($detail->dari != '') ? $detail->dari : '<span style="color:#dddddd;">.............................................................</span>';
	$hal = ($detail->hal != '') ? $detail->hal : '<span style="color:#dddddd;">.............................................................</span>';

	setlocale(LC_TIME, 'id');
	$tanggal = ($detail->tanggal != '') ? strftime("%#d %B %Y", strtotime($detail->tanggal)) : '<span style="color:#dddddd;">.............................................................</span>';

	$isi = ($detail->isi != '') ? $detail->isi : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';

	$nama_ttd = ($detail->nama_ttd != '') ? $detail->nama_ttd : '<span style="color:#dddddd;">Nama Lengkap</span>';

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
	<table border="0" cellspacing="1" cellpadding="1" align="center" class="cke_show_border" style="width: 100%;">
		<tbody>
			<tr>
				<th>
					<span style="font-size:14px;">
						<?php echo strtoupper($instansi); ?>
						<br><br>
					</span>
					
				</th>
			</tr>
		</tbody>
	</table>
	<table border="0" align="center" cellspacing="0" cellpadding="0" style="height: 10px; width: 100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="text-align: center;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<span style="font-size:18px;">
							<strong>
								NOTA DINAS
							</strong>
						</span>
					</span>
				</td>
			</tr>
			<tr>
				<td style="text-align: center;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<span style="font-size:14px;">
							<strong>
								NOMOR : <?php echo $nomor; ?>
							</strong>
						</span>
					</span>
				</td>
			</tr>
		</tbody>
	</table>
	<p><br></p>
	<table border="0" cellspacing="1" cellpadding="1" style="width:100%;" class="cke_show_border">
		<tbody>
			<tr style="height: 30px;">
				<td style="width: 6%;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<br>
					</span>
				</td>
				<td style="width: 16%;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						Yth.
					</span>
				</td>
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						: <?php echo $yth; ?>
					</span>
				</td>
			</tr>
			<tr style="height: 30px;">
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<br>
					</span>
				</td>
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						Dari
					</span>
				</td>
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						: <?php echo $dari; ?>
					</span>
				</td>
			</tr>
			<tr style="height: 30px;">
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<br>
					</span>
				</td>
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						Hal
					</span>
				</td>
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						: <?php echo $hal; ?>
					</span>
				</td>
			</tr>
			<tr style="height: 30px;">
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<br>
					</span>
				</td>
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						Tanggal
					</span>
				</td>
				<td>
					<span style="font-family:Arial,Helvetica,sans-serif;">
						: <?php echo $tanggal; ?>
					</span>
				</td>
			</tr>
		</tbody>
	</table>
	<hr>
	<table border="0" align="center" cellspacing="0" cellpadding="0" style="width:100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="text-align: justify;">
					<p>
						<?php echo $isi; ?>
						<br>
					</p>
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
				<td style="width:60%">
				</td>
				<td style="text-align: center;">
					Tanda Tangan
				</td>
			</tr>
			<tr style="height: 50px;">
				<td >
				</td>
			</tr>
			<tr>
				<td>
					<br>
				</td>
				<td style="text-align: center;">
					<?php echo $nama_ttd; ?>
				</td>
			</tr>
		</tbody>
	</table>
	<p>
		<br>
	</p>
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
