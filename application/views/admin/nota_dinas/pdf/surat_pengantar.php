<?php
	

	$nama_instansi = ($detail->nomor != '') ? $detail->nomor : '<span style="color:#dddddd;">NAMA INSTANSI</span>';
	$alamat_instansi = ($detail->alamat_instansi != '') ? $detail->alamat_instansi : '<span style="color:#dddddd;">JALAN.............................</span>';
	$telepon_instansi = ($detail->telepon_instansi != '') ? $detail->telepon_instansi : '<span style="color:#dddddd;">..........................</span>';
	$faksimile_instansi = ($detail->faksimile_instansi != '') ? $detail->faksimile_instansi : '<span style="color:#dddddd;">..........................</span>';


	setlocale(LC_TIME, 'id');
	$tanggal_surat = ($detail->tanggal_surat != '') ? strftime("%#d %B %Y", strtotime($detail->tanggal_surat)) : '<span style="color:#dddddd;">...(Tgl.,Bln.,Thn.)</span>';
	$yth = ($detail->yth != '') ? $detail->yth : '<span 	style="color:#dddddd;">............................................ </span>';
	$alamat_yth = ($detail->alamat_yth != '') ? $detail->alamat_yth : '<span 	style="color:#dddddd;">...................................................
		<br>...................................................
		<br>...................................................
		</span>';
	$nomor = ($detail->nomor != '') ? $detail->nomor : '<span style="color:#dddddd;">.../.../..../.../....</span>';


	$naskah_dinas = [];
	foreach ($naskah as $key => $value) {
		$naskah_dinas[$key]['nama_naskah'] = ($value->nama_naskah != '') ? $value->nama_naskah : '-';
		$naskah_dinas[$key]['banyaknya'] = ($value->banyaknya != '') ? $value->banyaknya : '-';
		$naskah_dinas[$key]['keterangan'] = ($value->keterangan != '') ? $value->keterangan : '-';
	}


	setlocale(LC_TIME, 'id');
	$tanggal_diterima = ($detail->tanggal_diterima != '') ? strftime("%#d %B %Y", strtotime($detail->tanggal_diterima)) : '<span style="color:#dddddd;">.........................</span>';
	$nama_penerima = ($detail->nama_penerima != '') ? $detail->nama_penerima : '<span style="color:#dddddd;">Nama LengkapI</span>';
	$jabatan_penerima = ($detail->jabatan_penerima != '') ? $detail->jabatan_penerima : '<span style="color:#dddddd;">Nama Jabatan</span>';
	$nip_penerima = ($detail->nip_penerima != '') ? $detail->nip_penerima : '<span style="color:#dddddd;">....................</span>';
	$telepon_penerima = ($detail->telepon_penerima != '') ? $detail->telepon_penerima : '<span style="color:#dddddd;">..................................</span>';


	$nama_pengirim = ($detail->nama_pengirim != '') ? $detail->nama_pengirim : '<span style="color:#dddddd;">Nama Lengkap</span>';
	$jabatan_pengirim = ($detail->jabatan_pengirim != '') ? $detail->jabatan_pengirim : '<span style="color:#dddddd;">Nama Jabatan</span>';
	$nip_pengirim = ($detail->nip_pengirim != '') ? $detail->nip_pengirim : '<span style="color:#dddddd;">....................</span>';
?>

<body contenteditable="true" class="cke_editable cke_editable_themed cke_contents_ltr" spellcheck="false">
	<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:100%;" class="cke_show_border cke_table-faked-selection-table">
		<tbody>
			<tr>
				<th>
					<span style="font-size:18px;"><?php echo $nama_instansi ?>
					</span>
					<br>
					<span style="font-size:14px;"><?php echo $alamat_instansi ?>, Telp. <?php echo $telepon_instansi ?>, Fax. <?php echo $faksimile_instansi ?> 
					</span>
				</th>
			</tr>
		</tbody>
	</table>
	<hr>
	<table border="0" cellspacing="0" cellpadding="0" align="right" class="cke_show_border">
		<tbody>
			<tr>
				<td>
					<p><?php echo $tanggal_surat ?>
					</p>
				</td>
				<td style="width: 6%;">
					<br>
				</td>
			</tr>
		</tbody>
	</table>
	<p>
		<br>
		<br>
	</p>
	<p>Yth. <?php echo $yth ?><br>
		<?php echo $alamat_yth ?><br>
	</p>
	<table border="0" align="center" cellspacing="0" cellpadding="0" style="height: 10px; width: 100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="text-align: center;">
					<strong>
						<span style="font-size:18px;">SURAT PENGANTAR 
						</span> 
					</strong>
				</td>
			</tr>
			<tr>
				<td style="text-align: center;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<span style="font-size:14px;">
							<strong>NOMOR <?php echo $nomor ?>
							</strong>
						</span>
					</span>
				</td>
			</tr>
		</tbody>
	</table>
	<p>
		<br>
	</p>
	<table border="1" cellspacing="1" cellpadding="1" style="width: 100%;">
		<tbody>
			<tr>
				<td style="width: 6%; text-align: center; vertical-align: middle;">
					<p>No.
					</p>
				</td>
				<td style="width: 50%; text-align: center; vertical-align: middle;">Naskah Dinas yang Dikirimkan
				</td>
				<td style="width: 20%; text-align: center; vertical-align: middle;">Banyaknya
				</td>
				<td style="text-align: center; vertical-align: middle;">Keterangan
				</td>
			</tr>
			<?php foreach ($naskah_dinas as $key => $value) { ?>
				<tr>
					<td>
						<?php echo ($key+1)."." ?>
					</td>
					<td>
						<p>
							<?php echo $naskah_dinas[$key]['nama_naskah'] ?>
						</p>
					</td>
					<td>
						<p>
							<?php echo $naskah_dinas[$key]['banyaknya'] ?>
						</p>
					</td>
					<td>
						<p>
							<?php echo $naskah_dinas[$key]['keterangan'] ?>
						</p>
					</td>
				</tr>
			<?php } ?>
			
		</tbody>
	</table>
	<p>
		<br>
	</p>
	<table border="0" align="center" cellspacing="0" cellpadding="0" style="width:700px;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="width: 6%; text-align: center;">
					<br>
				</td>
				<td style="width: 34%">
					Diterima tanggal <?php echo $tanggal_diterima ?>
				</td>
				<td style="width: 20%;">
					<br>
				</td>
				<td style="width: 34%">
					<br>
				</td>
				<td style="text-align: center; width: 6%;">
					<br>
				</td>
			</tr>
			<tr>
				<td>
					<br>
				</td>
				<td>
					<p>Penerima,
						<br><?php echo $jabatan_penerima ?>,
						<br>
					</p>
				</td>
				<td>
					<br>
				</td>
				<td>
					<br><?php echo $jabatan_pengirim ?>,
				</td>
				<td>
					<br>
				</td>
			</tr>
			<tr style="height: 40px;"">
				<td >
				</td>
			</tr>
			<tr>
				<td>
					<br>
				</td>
				<td><?php echo $nama_penerima ?>
				</td>
				<td>
					<br>
				</td>
				<td><?php echo $nama_pengirim ?>
				</td>
				<td>
					<br>
				</td>
			</tr>
			<tr>
				<td>
					<br>
				</td>
				<td>NIP <?php echo $nip_penerima ?>
				</td>
				<td>
					<br>
				</td>
				<td>NIP <?php echo $nip_pengirim ?>
				</td>
				<td>
					<br>
				</td>
			</tr>
			<tr style="height: 30px;""> 
				<td>
					<br>
				</td>
				<td>
					<br>
				</td>
				<td>
					<br>
				</td>
				<td>
					<br>
				</td>
				<td>
					<br>
				</td>
			</tr>
			<tr>
				<td>
					<br>
				</td>
				<td colspan="2">No. Telepon <?php echo $telepon_penerima ?>
					<br>
				</td>
				<td>
					<br>
				</td>
				<td >
					<br>
				</td>
			</tr>
		</tbody>
	</table>
</body>