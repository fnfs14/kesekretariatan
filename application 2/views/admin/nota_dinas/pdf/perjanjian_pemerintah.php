<?php	
	$program = ($detail->program != '') ? $detail->program : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';

	$nomor1 = ($detail->nomor1 != '') ? $detail->nomor1 : '<span style="color:#dddddd;">.......................................................</span>';
	$nomor2 = ($detail->nomor2 != '') ? $detail->nomor2 : '<span style="color:#dddddd;">.......................................................</span>';

	$instansi1 = ($detail->instansi1 != '') ? $detail->instansi1 : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';
	$instansi2 = ($detail->instansi2 != '') ? $detail->instansi2 : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';
	$jabatan1 = ($detail->jabatan1 != '') ? $detail->jabatan1 : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';
	$jabatan2 = ($detail->jabatan2 != '') ? $detail->jabatan2 : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';
	$nama1 = ($detail->nama1 != '') ? $detail->nama1 : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';
	$nama2 = ($detail->nama2 != '') ? $detail->nama2 : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';

	$val_pasal = [];
	foreach ($pasal as $key => $value) {
		$val_pasal[$key]['judul'] = $value->judul;
		$val_pasal[$key]['isi'] = $value->isi;
	}

?>



<body contenteditable="true" class="cke_editable cke_editable_themed cke_contents_ltr" spellcheck="false">
	

	<table border="0" cellspacing="0" cellpadding="0" align="center" class="cke_show_border" style="width:100%;">
		<tbody>
			<tr>
				<th>
					<span style="font-size:12px;">
						PERJANJIAN KERJA SAMA<br>
						ANTARA<br>
						<?php echo strtoupper($instansi1) ?><br>
						DAN<br>
						<?php echo strtoupper($instansi2) ?><br>
					</span>
				</th>
			</tr>
			<tr style="height: 5px">
				<th>
				</th>
			</tr>
			<tr>
				<th>
					<span style="font-size:12px;">
						TENTANG<br>
						<?php echo strtoupper($program) ?><br>
					</span>
				</th>
			</tr>
			<tr style="height: 5px">
				<th>
				</th>
			</tr>
			<tr>
				<th>
					<span style="font-size:12px;">
						NOMOR <?php echo strtoupper($nomor1) ?><br>
						NOMOR <?php echo strtoupper($nomor2) ?><br>
					</span>
				</th>
			</tr>
			<tr style="height: 10px">
				<th>
				</th>
			</tr>
		</tbody>
	</table>
	<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
		<tbody>
			<tr style="text-align: justify;">
				<td style="vertical-align: middle;"><?php echo $instansi1 ?> dan <?php echo $instansi2 ?></td>
			</tr>
			<tr style="height: 10px">
				<td></td>
			</tr>
			<tr style="text-align: justify;">
				<td style="vertical-align: middle;">Kedua belah pihak sepakat untuk mengadakan kerja sama dalam rangka <?php echo $program ?> dengan ketentuan sebagai berikut.</td>
			</tr>
			<tr style="height: 10px">
				<td></td>
			</tr>
			<?php foreach ($val_pasal as $key => $value) { ?>
				<tr style="text-align: justify;">
					<td>
						<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
							<tbody>
								<tr>
									<td><center><strong>PASAL <?php echo $key+1?></strong></center></td>
								</tr>
								<tr>
									<td><center><strong><?php echo strtoupper($value['judul'])?></strong></center></td>
								</tr>
								<tr style="height: 20px">
									<td></td>
								</tr>
								<tr>
									<td><?php echo $value['isi']?></td>
								</tr>
								<tr style="height: 40px">
									<td></td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>	
			<?php } ?>
			
			<tr style="height: 30px">
				<td></td>
			</tr>
		</tbody>
	</table>
	<table border="0" align="center" cellspacing="1" cellpadding="1" style="width:100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="width:40%">
					<?php echo $instansi1 ?>
				</td>
				<td style="width:20%">
				</td>
				<td style="width:40%">
					<?php echo $instansi2 ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $jabatan1 ?>,
				</td>
				<td>
				</td>
				<td>
					<?php echo $jabatan2 ?>,
				</td>
			</tr>
			<tr style="height: 50px">
				<td>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $nama1 ?>
				</td>
				<td>
				</td>
				<td>
					<?php echo $nama2 ?>
				</td>
			</tr>
		</tbody>
	</table>
</body>