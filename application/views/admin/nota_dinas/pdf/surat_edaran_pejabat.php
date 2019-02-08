<?php	
	$instansi = ($detail->instansi != '') ? $detail->instansi : '<span style="color:#dddddd;">.....(INSTANSI)..... </span>';
	$nomor = ($detail->nomor != '') ? $detail->nomor : '<span style="color:#dddddd;">......</span>';
	$tahun = ($detail->tahun != '') ? $detail->tahun : '<span style="color:#dddddd;">......</span>';

	$judul = ($detail->judul != '') ? $detail->judul : '<span style="color:#dddddd;">...............................</span>';
	$tempat = ($detail->tempat != '') ? $detail->tempat : '<span style="color:#dddddd;">...................</span>';
	setlocale(LC_TIME, 'id');
	$tanggal = ($detail->tanggal != '') ? strftime("%#d %B %Y", strtotime($detail->tanggal)) : '<span style="color:#dddddd;">...(Tgl.,Bln.,Thn.)</span>';
	$jabatan = ($detail->jabatan != '') ? $detail->jabatan : '<span style="color:#dddddd;">.....(JABATAN).....</span>';
	$nama = ($detail->nama != '') ? $detail->nama : '<span style="color:#dddddd;">Nama Lengkap</span>';

	$val_yth = [];
	foreach ($yth as $key => $value) {
		$val_yth[$key] = $value->nama;
	}

	$val_poin = [];
	
	foreach ($poin as $key => $value) {
		$val_poin[$key]['judul'] = $value->judul;
		$val_poin[$key]['isi'] = $value->isi;
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
						<?php echo $jabatan ?>
						<br>
						<?php echo $instansi ?>
					</span>
				</th>
			</tr>
			<tr style="height: 20px">
				<th>
				</th>
			</tr>
		</tbody>
	</table>
	<table border="0" cellspacing="0" cellpadding="0" align="left" class="cke_show_border">
		<tbody>
			<?php foreach ($val_yth as $key => $value) { ?>
				<tr>
					<td style="text-align: left;">
						<span style="font-size:14px;">
							<?php if ($key == 0) { echo "Yth." ; } ?>
						</span>
					</td>
					<td style="text-align: left;">
						<span style="font-size:14px;">
							<?php echo $key+1 ?>.
						</span>
					</td>
					<td style="text-align: left;">
						<span style="font-size:14px;">
							<?php echo $value ?>
						</span>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>


	<table border="0" cellspacing="0" cellpadding="0" align="center" class="cke_show_border" style="width:100%;">
		<tbody>
			<tr style="height: 20px">
				<th>
				</th>
			</tr>
			<tr>
				<th>
					<span style="font-size:14px;">
						SURAT EDARAN<br>
						NOMOR <?php echo $nomor ?> TAHUN <?php echo $tahun ?>
					</span>
				</th>
			</tr>
			<tr>
				<td>
					<br>
				</td>
			</tr>
			<tr>
				<th>
					<span style="font-size:14px;">
						TENTANG<br>
						<?php echo strtoupper($judul) ?>
					</span>
				</th>
			</tr>
			<tr style="height: 20px">
				<th>
				</th>
			</tr>
		</tbody>
	</table>
	<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
		<tbody>
			<?php foreach ($val_poin as $key => $value) { ?>
				<tr style="text-align: left;">
					<td style="width: 3%;">
						<strong>
							<?php echo chr($key + 65); ?>.
						</strong>
					</td>
					<td>
						<strong>
							<?php echo $value['judul'] ?>
						</strong>
					</td>
				</tr>
				<tr style="text-align: left;">
					<td>
						<br>
					</td>
					<td>
						<?php echo $value['isi'] ?>
					</td>
				</tr>
				<tr style="height: 10px>">
					<td></td>
				</tr>
			<?php }?>
		</tbody>
	</table>
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
			<tr style="height: 10px;">
				<td>
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