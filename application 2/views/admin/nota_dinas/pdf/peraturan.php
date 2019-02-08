<?php
	
	$instansi = ($detail->instansi != '') ? $detail->instansi : '<span style="color:#dddddd;">INSTANSI</span>';
	$nomor = ($detail->nomor != '') ? $detail->nomor : '<span style="color:#dddddd;">.......</span>';
	$tahun = ($detail->tahun != '') ? $detail->tahun : '<span style="color:#dddddd;">.......</span>';
	$judul = ($detail->judul != '') ? $detail->judul : '<span style="color:#dddddd;">............................................................. </span>';

	$nama_peraturan = ($detail->nama_peraturan != '') ? $detail->nama_peraturan : '<span style="color:#dddddd;">............................................................. </span>';
	$tentang = ($detail->tentang != '') ? $detail->tentang : '<span style="color:#dddddd;">............................................................. </span>';
	
	$tempat = ($detail->tempat != '') ? $detail->tempat : '<span style="color:#dddddd;">...(Tempat)</span>';
	setlocale(LC_TIME, 'id');
	$tanggal = ($detail->tanggal != '') ? strftime("%#d %B %Y", strtotime($detail->tanggal)) : '<span style="color:#dddddd;">...(Tgl.,Bln.,Thn.)</span>';


	$jabatan = ($detail->jabatan != '') ? $detail->jabatan : '<span style="color:#dddddd;">Nama Jabatan</span>';
	$nama = ($detail->nama != '') ? $detail->nama : '<span style="color:#dddddd;">Nama Lengkap</span>';
	
	$val_konsiderans = [];
	foreach ($konsiderans as $key => $value) {
		$val_konsiderans[$key] = ($value->isi != '') ? $value->isi : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .  </span>';
	}

	$val_dasar_hukum = [];
	foreach ($dasar_hukum as $key => $value) {
		$val_dasar_hukum[$key] = ($value->isi != '') ? $value->isi : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .  </span>';
	}

	$val_pasal = [];
	foreach ($pasal as $key => $value) {
		$val_pasal[$key]['nomor'] = ($value->nomor != '') ? $value->nomor : '<span style="color:#dddddd;">....</span>';
		$val_pasal[$key]['isi'] = ($value->isi != '') ? $value->isi : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .  </span>';
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
						PERATURAN <?php echo strtoupper($jabatan) ?> <?php echo strtoupper($instansi) ?>
					</span>
				</th>
			</tr>
			<tr>
				<td>
					<br>
				</td>
			</tr>
			<tr>
				<td style="text-align: center;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<span style="font-size:14px;">
							<strong>
								NOMOR <?php echo $nomor ?> TAHUN <?php echo $tahun ?>
							</strong>
						</span> 
					</span>
				</td>
			</tr>
			<tr style="height: 10px">
			</tr>
			<tr>
				<td style="text-align: center;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<span style="font-size:14px;">
							<strong>
								TENTANG<br>
								<?php echo $judul ?>
							</strong>
						</span> 
					</span>
				</td>
			</tr>
			<tr>
				<td>
					<br>
				</td>
			</tr>
			<tr>
				<td style="text-align: center;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<span style="font-size:14px;">
							<strong>
								<?php echo strtoupper($jabatan) ?> <?php echo strtoupper($instansi) ?>
							</strong>
						</span> 
					</span>
				</td>
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
				<td style="vertical-align: top; width:10%;">Menimbang
				</td>
				<td style="vertical-align: top; width:2%;">:
				</td>
			<?php foreach ($val_konsiderans as $key => $value) {?>
				<td style="vertical-align: top; width:3%;"><?php echo chr($key+97) ?>.
				</td>
				<td style="vertical-align: top; width:85%;">bahwa <?php echo $value ?>;
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
				<td style="vertical-align: top;">Mengingat
				</td>
				<td style="vertical-align: top;">:
				</td>
			<?php foreach ($val_dasar_hukum as $key => $value) {?>
				<td style="vertical-align: top; width:3%;"><?php echo $key+1 ?>.
				</td>
				<td style="vertical-align: top; width:85%;"><?php echo $value; ?>;
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
				<td colspan="4" style="text-align: center; vertical-align: top;">MEMUTUSKAN:
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
				<td style="vertical-align: top;">Menetapkan
				</td>
				<td style="vertical-align: top;">:
				</td>
				<td rowspan="1" colspan="2" style="vertical-align: top;">PERATURAN <?php echo $nama_peraturan ?> TENTANG <?php echo $tentang ?>
				</td>
			</tr>
		</tbody>
	</table>

	<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
		<tbody>
			<?php foreach ($val_pasal as $key => $value) { ?>
				<tr>
					<td style="text-align: center;">
						<p>
							Pasal <?php echo $value['nomor']; ?>
						</p>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;">
						<?php echo $value['isi']; ?>. 
					</td>
				</tr>
				<tr style="height: 10px">
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<br>
	<table border="0" align="center" cellspacing="1" cellpadding="1" style="width:100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="width:70%">
				</td>
				<td>
					Ditetapkankan di <?php echo $tempat ?><br>
					pada tanggal <?php echo $tanggal ?>
				</td>
			</tr>
			<tr>
				<td style="height: 10px;"><br></td>
				<td style="height: 10px;">
					<br>
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
</body>