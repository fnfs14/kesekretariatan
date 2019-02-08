<?php	
	$logo = ($detail->logo != '') ? $detail->logo : 'NO IMAGE';
	$nama_instansi = ($detail->nama_instansi != '') ? $detail->nama_instansi : '<span style="color:#dddddd;">NAMA INSTANSI</span>';
	$alamat_instansi = ($detail->alamat_instansi != '') ? $detail->alamat_instansi : '<span style="color:#dddddd;">JALAN.............................</span>';
	$telepon_instansi = ($detail->telepon_instansi != '') ? $detail->telepon_instansi : '<span style="color:#dddddd;">..........................</span>';
	$faksimile_instansi = ($detail->faksimile_instansi != '') ? $detail->faksimile_instansi : '<span style="color:#dddddd;">..........................</span>';
	$nomor = ($detail->nomor != '') ? $detail->nomor : '<span style="color:#dddddd;">.../.../.../.../...</span>';
	$tempat = ($detail->tempat != '') ? $detail->tempat : '<span style="color:#dddddd;">...................</span>';
	setlocale(LC_TIME, 'id');
	$tanggal = ($detail->tanggal != '') ? strftime("%#d %B %Y", strtotime($detail->tanggal)) : '<span style="color:#dddddd;">...</span>';
	$nama_pemberi = ($detail->nama_pemberi != '') ? $detail->nama_pemberi : '<span style="color:#dddddd;">...................................</span>';
	$nip_pemberi = ($detail->nip_pemberi != '') ? $detail->nip_pemberi : '<span style="color:#dddddd;">...................................</span>';
	$jabatan_pemberi = ($detail->jabatan_pemberi != '') ? $detail->jabatan_pemberi : '<span style="color:#dddddd;">...................................</span>';
	$nama_subjek = ($detail->nama_subjek != '') ? $detail->nama_subjek : '<span style="color:#dddddd;">...................................</span>';
	$nip_subjek = ($detail->nip_subjek != '') ? $detail->nip_subjek : '<span style="color:#dddddd;">...................................</span>';
	$pangkat_subjek = ($detail->pangkat_subjek != '') ? $detail->pangkat_subjek : '<span style="color:#dddddd;">...................................</span>';
	$jabatan_subjek = ($detail->jabatan_subjek != '') ? $detail->jabatan_subjek : '<span style="color:#dddddd;">...................................</span>';
	$keterangan = ($detail->keterangan != '') ? $detail->keterangan : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';
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


	<table border="0" cellspacing="0" cellpadding="0" align="center" class="cke_show_border" style="width:100%;">
		<tbody>
			<tr style="height: 20px">
				<th>
				</th>
			</tr>
			<tr>
				<th>
					<span style="font-size:14px;">
						SURAT KETERANGAN<br>
					</span>
					<span style="font-size:12px;">
						NOMOR <?php echo $nomor?>
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
			<tr style="text-align: justify; height: 40px">
				<td style="width: 3%;">
				</td>
				<td style="vertical-align: middle;">Yang bertanda tangan dibawah ini,</td>
			</tr>
			<tr style="text-align: justify;">
				<td>
				</td>
				<td>
					<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
						<tbody>
							<tr>
								<td width="5%"></td>
								<td width="20%">
									nama
								</td>
								<td width="3%">
									:
								</td>
								<td width="72%">
									<?php echo $nama_pemberi?>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									NIP
								</td>
								<td>
									:
								</td>
								<td>
									<?php echo $nip_pemberi?>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									jabatan
								</td>
								<td>
									:
								</td>
								<td>
									<?php echo $jabatan_pemberi?>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr style="height: 40px">
				<td colspan="2" style="vertical-align: middle;">dengan ini menerangkan bahwa</td>
			</tr>
			<tr style="text-align: justify;">
				<td></td>
				<td>
					<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
						<tbody>
							<tr>
								<td width="5%"></td>
								<td width="20%">
									nama
								</td>
								<td width="3%">
									:
								</td>
								<td width="72%">
									<?php echo $nama_subjek?>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									NIP
								</td>
								<td>
									:
								</td>
								<td>
									<?php echo $nip_subjek?>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									pangkat/golongan
								</td>
								<td>
									:
								</td>
								<td>
									<?php echo $pangkat_subjek?>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									jabatan
								</td>
								<td>
									:
								</td>
								<td>
									<?php echo $jabatan_subjek?>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr style="height: 10px">
				<td></td>
			</tr>
			
			<tr style="text-align: justify;">
				<td colspan="2">
					<?php echo $keterangan ?>
				</td>
			</tr>
			<tr style="height: 30px">
				<td></td>
			</tr>
		</tbody>
	</table>
	<table border="0" align="center" cellspacing="1" cellpadding="1" style="width:100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="width:60%">
				</td>
				<td>
					<?php echo $tempat ?>, <?php echo $tanggal ?>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
					Pejabat Pembuat Keterangan,
				</td>
			</tr>
			<tr style="height: 50px">
				<td>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
					<?php echo $nama_pemberi ?>
				</td>
			</tr>
		</tbody>
	</table>
</body>