<?php
	
	$instansi = ($detail->instansi != '') ? $detail->instansi : '<span style="color:#dddddd;">INSTANSI</span>';
	$nomor = ($detail->nomor != '') ? $detail->nomor : '<span style="color:#dddddd;">.......</span>';
	$tahun = ($detail->tahun != '') ? $detail->tahun : '<span style="color:#dddddd;">.......</span>';
	$judul = ($detail->judul != '') ? $detail->judul : '<span style="color:#dddddd;">............................................................. </span>';

	$alasan = ($detail->alasan != '') ? $detail->alasan : '<span style="color:#dddddd;">............................................................. </span>';
	
	$tempat = ($detail->tempat != '') ? $detail->tempat : '<span style="color:#dddddd;">...(Tempat)</span>';
	setlocale(LC_TIME, 'id');
	$tanggal = ($detail->tanggal != '') ? strftime("%#d %B %Y", strtotime($detail->tanggal)) : '<span style="color:#dddddd;">...(Tgl.,Bln.,Thn.)</span>';


	$jabatan = ($detail->jabatan != '') ? $detail->jabatan : '<span style="color:#dddddd;">Nama Jabatan</span>';
	$nama = ($detail->nama != '') ? $detail->nama : '<span style="color:#dddddd;">Nama Lengkap</span>';
	
	$val_kepada = [];
	foreach ($kepada as $key => $value) {
		$val_kepada[$key] = ($value->nama != '') ? $value->nama : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . </span>';
	}

	$val_instruksi = [];
	foreach ($instruksi as $key => $value) {
		$val_instruksi[$key] = ($value->isi != '') ? $value->isi : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';
	}

	$formatter = new NumberFormatter('id', NumberFormatter::SPELLOUT);
	$formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal"); 
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
						<br><br>
					</span>
				</th>
			</tr>
		</tbody>
	</table>
	
	<table border="0" cellspacing="0" cellpadding="0" align="center" class="cke_show_border" style="width:100%;">
		<tbody>
			<tr>
				<th>
					<span style="font-size:14px;">
						INSTRUKSI <?php echo strtoupper($jabatan) ?> <?php echo strtoupper($instansi) ?>
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
								<?php echo strtoupper($jabatan) ?> <?php echo strtoupper($instansi) ?>,
							</strong>
						</span> 
					</span>
				</td>
			</tr>
		</tbody>
	</table>
	
	
	<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
		<tbody>
			<tr>
				<td rowspan="1" colspan="4">
					<p>Dalam rangka <?php echo $alasan ?> dengan ini memberi instruksi</p> 
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top; width:10%;">Kepada
				</td>
				<td style="vertical-align: top; width:2%;">:
				</td>
			<?php foreach ($val_kepada as $key => $value) {?>
				<td style="vertical-align: top; width:3%;"><?php echo $key+1 ?>.
				</td>
				<td style="vertical-align: top; width:85%;"><?php echo $value ?>
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
				<td style="vertical-align: top;">Untuk
				</td>
				<td style="vertical-align: top;">:
				</td>
				<td style="vertical-align: top;">
				</td>
				<td style="vertical-align: top;">
				</td>
			</tr>
			<tr style="height: 10px">
			</tr>
		</tbody>
	</table>

	<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
		<tbody>
			<?php foreach ($val_instruksi as $key => $value) { ?>
				<tr>
					<td style="vertical-align: top; width:13%;"><?php echo strtoupper($formatter->format($key+1)); ?>
					</td>
					<td style="vertical-align: top; width:2%;">:
					</td>
					<td style="vertical-align: top;"><?php echo $value ?>;
					</td>
				</tr>
				<tr style="height: 10px">
				</tr>
			<?php } ?>
			<tr>
				<td colspan="3" style="vertical-align: top;">
					&emsp;&emsp;&emsp;Instruksi <?php echo $judul ?> ini mulai berlaku pada tanggal dikeluarkan.
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