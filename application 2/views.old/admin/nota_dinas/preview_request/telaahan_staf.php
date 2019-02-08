<?php
	$tentang = ($detail->tentang != '') ? $detail->tentang : '<span style="color:#dddddd;">............................................................. </span>';
	$jabatan = ($detail->jabatan != '') ? $detail->jabatan : '<span style="color:#dddddd;">Nama Jabatan</span>';
	$nama = ($detail->nama != '') ? $detail->nama : '<span style="color:#dddddd;">Nama Lengkap</span>';

	$persoalan = ($detail->persoalan != '') ? $detail->persoalan : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';
	$praanggapan = ($detail->praanggapan != '') ? $detail->praanggapan : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';
	$fakta = ($detail->fakta != '') ? $detail->fakta : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';
	$analisis = ($detail->analisis != '') ? $detail->analisis : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';
	$simpulan = ($detail->simpulan != '') ? $detail->simpulan : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';
	$saran = ($detail->saran != '') ? $detail->saran : '<span style="color:#dddddd;">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span>';

?>


<body contenteditable="true" class="cke_editable cke_editable_themed cke_contents_ltr" spellcheck="false">
	
	<table border="0" align="center" cellspacing="0" cellpadding="0" style="height: 10px; width: 100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="text-align: center;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<span style="font-size:14px;">
							<strong>
								TELAAHAN STAF
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
								TENTANG
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
								<?php echo $tentang ?>
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

	<table border="0" align="center" cellspacing="0" cellpadding="0" style="width:100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="text-align: justify; width: 5%; vertical-align: top;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<strong>
							A.
						</strong>
					</span>
				</td>
				<td style="text-align: justify; vertical-align: top;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<strong>
							Persoalan
						</strong>
					</span>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td style="text-align: justify;">
					<p>
						<span style="font-family:Arial,Helvetica,sans-serif;">
							<?php echo $persoalan ?>
						</span>
					</p>
				</td>
			</tr>
			<tr>
				<td style="text-align: justify; width: 5%; vertical-align: top;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<strong>
							B.
						</strong>
					</span>
				</td>
				<td style="text-align: justify; vertical-align: top;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<strong>
							Praanggapan
						</strong>
					</span>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td style="text-align: justify;">
					<p>
						<span style="font-family:Arial,Helvetica,sans-serif;">
							<?php echo $praanggapan ?>
						</span>
					</p>
				</td>
			</tr>
			<tr>
				<td style="text-align: justify; width: 5%; vertical-align: top;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<strong>
							C.
						</strong>
					</span>
				</td>
				<td style="text-align: justify; vertical-align: top;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<strong>
							Fakta yang Mempengaruhi
						</strong>
					</span>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td style="text-align: justify;">
					<p>
						<span style="font-family:Arial,Helvetica,sans-serif;">
							<?php echo $fakta ?>
						</span>
					</p>
				</td>
			</tr>
			<tr>
				<td style="text-align: justify; width: 5%; vertical-align: top;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<strong>
							D.
						</strong>
					</span>
				</td>
				<td style="text-align: justify; vertical-align: top;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<strong>
							Analisis
						</strong>
					</span>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td style="text-align: justify;">
					<p>
						<span style="font-family:Arial,Helvetica,sans-serif;">
							<?php echo $analisis ?>
						</span>
					</p>
				</td>
			</tr>
			<tr>
				<td style="text-align: justify; width: 5%; vertical-align: top;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<strong>
							E.
						</strong>
					</span>
				</td>
				<td style="text-align: justify; vertical-align: top;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<strong>
							Simpulan
						</strong>
					</span>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td style="text-align: justify;">
					<p>
						<span style="font-family:Arial,Helvetica,sans-serif;">
							<?php echo $simpulan ?>
						</span>
					</p>
				</td>
			</tr>
			<tr>
				<td style="text-align: justify; width: 5%; vertical-align: top;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<strong>
							F.
						</strong>
					</span>
				</td>
				<td style="text-align: justify; vertical-align: top;">
					<span style="font-family:Arial,Helvetica,sans-serif;">
						<strong>
							Saran
						</strong>
					</span>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td style="text-align: justify;">
					<p>
						<span style="font-family:Arial,Helvetica,sans-serif;">
							<?php echo $saran ?>
						</span>
					</p>
				</td>
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
					<?php echo $jabatan ?>
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
