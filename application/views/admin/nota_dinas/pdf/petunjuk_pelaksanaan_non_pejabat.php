<?php
	$logo = ($detail->logo != '') ? $detail->logo : 'NO IMAGE';
	$nama_instansi = ($detail->nama_instansi != '') ? $detail->nama_instansi : '<span style="color:#dddddd;">NAMA INSTANSI</span>';
	$alamat_instansi = ($detail->alamat_instansi != '') ? $detail->alamat_instansi : '<span style="color:#dddddd;">JALAN.............................</span>';
	$telepon_instansi = ($detail->telepon_instansi != '') ? $detail->telepon_instansi : '<span style="color:#dddddd;">..........................</span>';
	$faksimile_instansi = ($detail->faksimile_instansi != '') ? $detail->faksimile_instansi : '<span style="color:#dddddd;">..........................</span>';
	$jabatan = ($detail->jabatan != '') ? $detail->jabatan : '<span style="color:#dddddd;">.....(JABATAN).....</span>';
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
				<th style="width: 10%;">
				</th>
			</tr>

		</tbody>
	</table>
	<hr>
	<table border="0" cellspacing="0" cellpadding="0" align="right" class="cke_show_border">
		<tbody>
			<tr>
				<td style="text-align: left;">
					<span style="font-size:14px;">
						<p>
							LAMPIRAN<br>
							<?php echo strtoupper($lampiran) ?>
						</p>
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