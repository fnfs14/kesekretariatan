<?php	
	$logo = ($detail->logo != '') ? $detail->logo : 'NO IMAGE';
	$nama_instansi = ($detail->nama_instansi != '') ? $detail->nama_instansi : '<span style="color:#dddddd;">NAMA INSTANSI</span>';
	$alamat_instansi = ($detail->alamat_instansi != '') ? $detail->alamat_instansi : '<span style="color:#dddddd;">JALAN.............................</span>';
	$telepon_instansi = ($detail->telepon_instansi != '') ? $detail->telepon_instansi : '<span style="color:#dddddd;">..........................</span>';
	$faksimile_instansi = ($detail->faksimile_instansi != '') ? $detail->faksimile_instansi : '<span style="color:#dddddd;">..........................</span>';
	$nomor = ($detail->nomor != '') ? $detail->nomor : '<span style="color:#dddddd;">.../.../.../.../...</span>';
	$tempat = ($detail->tempat != '') ? $detail->tempat : '<span style="color:#dddddd;">...................</span>';
	setlocale(LC_TIME, 'id');
	$tanggal = ($detail->tanggal != '') ? strftime("%#d", strtotime($detail->tanggal)) : '<span style="color:#dddddd;">...</span>';
	$bulan = ($detail->tanggal != '') ? strftime("%B", strtotime($detail->tanggal)) : '<span style="color:#dddddd;">...</span>';
	$tahun = ($detail->tanggal != '') ? strftime("%Y", strtotime($detail->tanggal)) : '<span style="color:#dddddd;">...</span>';
	$identitas_pihak_satu = ($detail->identitas_pihak_satu != '') ? $detail->identitas_pihak_satu : '<span style="color:#dddddd;">...................................</span>';
	$identitas_pihak_dua = ($detail->identitas_pihak_dua != '') ? $detail->identitas_pihak_dua : '<span style="color:#dddddd;">...................................</span>';
	$nama_ttd_pihak_satu = ($detail->nama_ttd_pihak_satu != '') ? $detail->nama_ttd_pihak_satu : '<span style="color:#dddddd;">...................................</span>';
	$nama_ttd_pihak_dua = ($detail->nama_ttd_pihak_dua != '') ? $detail->nama_ttd_pihak_dua : '<span style="color:#dddddd;">...................................</span>';
	$berdasarkan = ($detail->berdasarkan != '') ? $detail->berdasarkan : '<span style="color:#dddddd;">...................................</span>';
	$jabatan_saksi = ($detail->jabatan_saksi != '') ? $detail->jabatan_saksi : '<span style="color:#dddddd;">.....(JABATAN).....</span>';
	$nama_saksi = ($detail->nama_saksi != '') ? $detail->nama_saksi : '<span style="color:#dddddd;">Nama Lengkap</span>';
	
	$val_kegiatan = [];
	foreach ($kegiatan as $key => $value) {
		$val_kegiatan[$key] = $value->isi;
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


	<table border="0" cellspacing="0" cellpadding="0" align="center" class="cke_show_border" style="width:100%;">
		<tbody>
			<tr style="height: 20px">
				<th>
				</th>
			</tr>
			<tr>
				<th>
					<span style="font-size:14px;">
						BERITA ACARA<br>
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
			<tr style="text-align: justify;">
				<td colspan="2">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada hari ini, tanggal <?php echo $tanggal?>, bulan <?php echo $bulan?>, tahun <?php echo $tahun?>, kami masing-masing:
				</td>
			</tr>
			<tr style="height: 10px">
				<td></td>
			</tr>
			<tr style="text-align: justify;">
				<td style="width: 3%;">
					1.
				</td>
				<td>
					<?php echo $identitas_pihak_satu ?>, selanjutnya disebut Pihak Pertama,
				</td>
			</tr>
			<tr style="height: 40px">
				<td colspan="2" style="vertical-align: middle;"><center>dan</center></td>
			</tr>
			<tr style="text-align: justify;">
				<td style="width: 3%;">
					2.
				</td>
				<td>
					<?php echo $identitas_pihak_dua ?>, selanjutnya disebut Pihak Kedua, telah melaksanakan
				</td>
			</tr>
			<tr style="height: 40px">
				<td></td>
			</tr>
			<?php foreach ($val_kegiatan as $key => $value) { ?>
				<tr style="text-align: justify;">
					<td style="width: 3%;">
						<?php echo $key+1; ?>.
					</td>
					<td>
						<?php echo $value ?>
					</td>
				</tr>
				<tr style="height: 10px">
					<td></td>
				</tr>
			<?php }?>
			<tr style="text-align: justify;">
				<td colspan="2">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Berita acara ini dibuat dengan sesungguhnya berdasarkan <?php echo $berdasarkan ?>
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
					Dibuat di <?php echo $tempat ?><br>
				</td>
			</tr>
		</tbody>
	</table>
	<table border="0" align="center" cellspacing="1" cellpadding="1" style="width:100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="width:30%">
				</td>
				<td style="width:5%">
				</td>
				<td style="width:30%">
				</td>
				<td style="width:5%">
				</td>
				<td style="width:30%">
				</td>
			</tr>
			<tr>
				<td>Pihak Kedua,</td>
				<td></td>
				<td></td>
				<td></td>
				<td>Pihak Pertama,</td>
			</tr>
			<tr style="height: 50px">
				<td></td>
			</tr>
			<tr>
				<td><?php echo $nama_ttd_pihak_dua ?></td>
				<td></td>
				<td></td>
				<td></td>
				<td><?php echo $nama_ttd_pihak_satu ?></td>
			</tr>
			<tr style="height: 10px">
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>Mengetahui/Mengesahkan</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><?php echo $jabatan_saksi?>,</td>
				<td></td>
				<td></td>
			</tr>
			<tr style="height: 50px">
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><?php echo $nama_saksi?></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
</body>