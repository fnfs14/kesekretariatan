<?php
	
	$logo = ($detail->logo != '') ? $detail->logo : 'NO IMAGE';
	$nama_instansi = ($detail->nama_instansi != '') ? $detail->nama_instansi : '<span style="color:#dddddd;">NAMA INSTANSI</span>';
	$alamat_instansi = ($detail->alamat_instansi != '') ? $detail->alamat_instansi : '<span style="color:#dddddd;">JALAN.............................</span>';
	$telepon_instansi = ($detail->telepon_instansi != '') ? $detail->telepon_instansi : '<span style="color:#dddddd;">..........................</span>';
	$faksimile_instansi = ($detail->faksimile_instansi != '') ? $detail->faksimile_instansi : '<span style="color:#dddddd;">..........................</span>';

	$nomor = ($detail->nomor != '') ? $detail->nomor : '<span style="color:#dddddd;">............................................................. </span>';

	$nama_pemberi = ($detail->nama_pemberi != '') ? $detail->nama_pemberi : '<span style="color:#dddddd;">.......................................................</span>';
	$alamat_pemberi = ($detail->alamat_pemberi != '') ? $detail->alamat_pemberi : '<span style="color:#dddddd;">.......................................................</span>';
	$jabatan_pemberi = ($detail->jabatan_pemberi != '') ? $detail->jabatan_pemberi : '<span style="color:#dddddd;">.......................................................</span>';
	$nip_pemberi = ($detail->nip_pemberi != '') ? $detail->nip_pemberi : '<span style="color:#dddddd;">...........</span>';

	$nama_penerima = ($detail->nama_penerima != '') ? $detail->nama_penerima : '<span style="color:#dddddd;">.......................................................</span>';
	$alamat_penerima = ($detail->alamat_penerima != '') ? $detail->alamat_penerima : '<span style="color:#dddddd;">.......................................................</span>';
	$jabatan_penerima = ($detail->jabatan_penerima != '') ? $detail->jabatan_penerima : '<span style="color:#dddddd;">.......................................................</span>';
	$nip_penerima = ($detail->nip_penerima != '') ? $detail->nip_penerima : '<span style="color:#dddddd;">...........</span>';



	$untuk = ($detail->untuk != '') ? $detail->untuk : '<span style="color:#dddddd;">........................................................................................................................................................................... ......................................................................................................................................................................................</span>';

	$tempat = ($detail->tempat != '') ? $detail->tempat : '<span style="color:#dddddd;">(Tempat)</span>';
	setlocale(LC_TIME, 'id');
	$tanggal = ($detail->tanggal != '') ? strftime("%#d %B %Y", strtotime($detail->tanggal)) : '<span style="color:#dddddd;">(Tgl.,Bln.,Thn.)</span>';

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
	<table border="0" align="center" cellspacing="0" cellpadding="0" style="height: 10px; width: 100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="text-align: center;">
					<strong>
						<span style="font-size:18px;">
							SURAT KUASA
						</span>
					</strong>
					<br>
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

	<table border="0" cellspacing="0" cellpadding="0" style="width:100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="text-align: justify; width: 6%;">
					<br>
				</td>
				<td style="text-align: justify;">
					<p>
						&nbsp; &nbsp; &nbsp;Yang bertanda tangan di bawah ini,
					</p>
				</td>
			</tr>
			<tr>
				<td style="text-align: justify;">
					<br>
				</td>
				<td style="text-align: justify;">
					<table border="0" cellspacing="0" cellpadding="0" style="width:100%;" class="cke_show_border">
						<tbody>
							<tr>
								<td style="width: 10%;">
									<br>
								</td>
								<td style="width: 10%;">
									nama<br><br>
								</td>
								<td>
									: <?php echo $nama_pemberi ?><br><br>
								</td>
							</tr>
							<tr>
								<td>
									<br>
								</td>
								<td>
									jabatan<br><br>
								</td>
								<td>
									: <?php echo $jabatan_pemberi ?><br><br>
								</td>
							</tr>
							<tr>
								<td>
									<br>
								</td>
								<td>
									alamat<br><br>
								</td>
								<td>
									: <?php echo $alamat_pemberi ?><br><br>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td style="text-align: justify;">
					<br>
				</td>
				<td style="text-align: justify;">
					<p>
						memberi kuasa kepada
					</p>
				</td>
			</tr>
			<tr>
				<td style="text-align: justify;">
					<br>
				</td>
				<td style="text-align: justify;">
					<table border="0" cellspacing="0" cellpadding="0" style="width:100%;" class="cke_show_border">
						<tbody>
							<tr>
								<td style="width: 10%;">
									<br>
								</td>
								<td style="width: 10%;">
									nama<br><br>
								</td>
								<td>
									: <?php echo $nama_penerima ?><br><br>
								</td>
							</tr>
							<tr>
								<td>
									<br>
								</td>
								<td>
									jabatan<br><br>
								</td>
								<td>
									: <?php echo $jabatan_penerima ?><br><br>
								</td>
							</tr>
							<tr>
								<td>
									<br>
								</td>
								<td>
									alamat<br><br>
								</td>
								<td>
									: <?php echo $alamat_penerima ?><br><br>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td style="text-align: justify;">
					<br>
				</td>
				<td style="text-align: justify;">
					<p>
						untuk <?php echo $untuk ?>
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	<p style="text-align: center;">Surat kuasa ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
	<p style="text-align: center;"><br></p>

	<table border="0" align="center" cellspacing="0" cellpadding="0" style="width:100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="width: 6%; text-align: center;">
					<br>
				</td>
				<td style="width: 34%;">
					<br>
				</td>
				<td style="width: 20%;">
					<br>
				</td>
				<td style="width: 34%;">
					<?php echo $tempat ?>, <?php echo $tanggal ?>
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
					Penerima Kuasa,
				</td>
				<td>
					<p style="text-align: center;">
						<br>
					</p>
				</td>
				<td>
					Pemberi Kuasa,
				</td>
				<td>
					<br>
				</td>
			</tr>
			<tr style="height: 40px;">
				<td>
				</td>
			</tr>
			<tr>
				<td>
					<br>
				</td>
				<td>
					<?php echo $nama_pemberi ?>
				</td>
				<td>
					<br>
				</td>
				<td>
					<?php echo $nama_penerima ?>
				</td>
				<td>
					<br>
				</td>
			</tr>
			<tr>
				<td>
					<br>
				</td>
				<td>
					<?php echo $nip_pemberi ?>
				</td>
				<td>
					<br>
				</td>
				<td>
					<?php echo $nip_penerima ?>
				</td>
				<td>
					<br>
				</td>
			</tr>
		</tbody>
	</table>
</body>