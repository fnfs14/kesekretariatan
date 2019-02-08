<?php	
	$logo = ($detail->logo != '') ? $detail->logo : 'NO IMAGE';
	$nama_instansi = ($detail->nama_instansi != '') ? $detail->nama_instansi : '<span style="color:#dddddd;">NAMA INSTANSI</span>';
	$alamat_instansi = ($detail->alamat_instansi != '') ? $detail->alamat_instansi : '<span style="color:#dddddd;">JALAN.............................</span>';
	$telepon_instansi = ($detail->telepon_instansi != '') ? $detail->telepon_instansi : '<span style="color:#dddddd;">..........................</span>';
	$faksimile_instansi = ($detail->faksimile_instansi != '') ? $detail->faksimile_instansi : '<span style="color:#dddddd;">..........................</span>';
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
						<?php echo $alamat_instansi ?><br>
						TELEPON <?php echo $telepon_instansi ?>  
						FAXIMILE <?php echo $faksimile_instansi ?>
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