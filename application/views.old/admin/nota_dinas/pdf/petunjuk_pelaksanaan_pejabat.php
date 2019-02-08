<?php
	
	$jabatan = ($detail->jabatan != '') ? $detail->jabatan : '<span style="color:#dddddd;">.....(JABATAN).....</span>';
	$instansi = ($detail->instansi != '') ? $detail->instansi : '<span style="color:#dddddd;">.....(INSTANSI)..... </span>';
	$judul = ($detail->judul != '') ? $detail->judul : '<span style="color:#dddddd;">...............................</span>';
	$nama = ($detail->nama != '') ? $detail->nama : '<span style="color:#dddddd;">Nama Lengkap</span>';
	$lampiran = ($detail->lampiran != '') ? $detail->lampiran  : '<span style="color:#dddddd;">..............................<br>..............................<br>..............................<br>..............................<br></span>';

	$val_bab = [];
	
	foreach ($bab as $key => $value) {
		$val_bab[$key]['id'] = $value->ID;
		$val_bab[$key]['judul'] = $value->judul;
	}

	$val_sub_bab = [];
	foreach ($subbab as $key => $value) {
		$val_sub_bab[$value->id_bab][$key]['judul'] = ($value->judul != '') ? $value->judul : "..........................";
		$val_sub_bab[$value->id_bab][$key]['isi'] = ($value->isi != '') ? $value->isi : ". . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . ";
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
	<table border="0" cellspacing="0" cellpadding="0" align="right" class="cke_show_border">
		<tbody>
			<tr>
				<td style="text-align: left;">
					<span style="font-size:14px;">
						LAMPIRAN<br>
						<?php echo strtoupper($lampiran) ?>
					</span>
				</td>
			</tr>
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
						PETUNJUK PELAKSANAAN<br>
						<?php echo strtoupper($judul) ?>
					</span>
				</th>
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
			<?php foreach ($val_bab as $key => $value) { ?>
				<tr>
					<td style="text-align: center;">
						<p>
							<strong>
								BAB <?php echo integerToRoman($key+1) ?><br>
								<?php echo $value['judul'] ?>
							</strong>
						</p>
					</td>
				</tr>
				<tr>
					<td style="text-align: center;">
						<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
							<tbody>
								<?php $i =0; ?>
								<?php if (isset($val_sub_bab[$value['id']]) && is_array($val_sub_bab[$value['id']])) { ?>

									<?php foreach ($val_sub_bab[$value['id']] as $key2 => $value2) { ?>
										<tr style="text-align: left;">
											<td style="width: 3%;">
												<?php echo chr($i + 65); $i++; ?>.
											</td>
											<td>
												<?php echo $value2['judul'] ?>
											</td>
										</tr>
										<tr style="text-align: left;">
											<td>
												<br>
											</td>
											<td>
												<?php echo $value2['isi'] ?>
											</td>
										</tr>
										<tr style="height: 10px>">
											<td></td>
										</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						</table>
					</td>
				</tr>
			<?php }?>
			<tr style="height: 10px>">
				<td></td>
			</tr>
		</tbody>
	</table>
	<table border="0" align="center" cellspacing="1" cellpadding="1" style="width:100%;" class="cke_show_border">
		<tbody>
			<tr>
				<td style="width:70%">
				</td>
				<td>
					<?php echo $jabatan ;?>,
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