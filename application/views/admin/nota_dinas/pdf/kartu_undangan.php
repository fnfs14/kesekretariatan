<?php
	$instansi = ($detail->instansi != '') ? $detail->instansi : '<span style="color:#dddddd;">.....(INSTANSI)..... </span>';
	$jabatan = ($detail->jabatan != '') ? $detail->jabatan : '<span style="color:#dddddd;">.....(JABATAN).....</span>';
	setlocale(LC_TIME, 'id');
	$hari_acara = ($detail->tanggal_acara != '') ? strftime("%A", strtotime($detail->tanggal_acara)) : '<span style="color:#dddddd;">................</span>';
	$tanggal_acara = ($detail->tanggal_acara != '') ? strftime("%#d %B %Y", strtotime($detail->tanggal_acara)) : '<span style="color:#dddddd;">...(Tgl.,Bln.,Thn.)</span>';
	$waktu_acara = ($detail->waktu_acara != '') ? strftime("%H.%M", strtotime($detail->waktu_acara)) : '<span style="color:#dddddd;">...................</span>';
	$tempat_acara = ($detail->tempat_acara != '') ? $detail->tempat_acara : '<span style="color:#dddddd;">...................</span>';
	$nama_acara = ($detail->nama_acara != '') ? $detail->nama_acara : '<span style="color:#dddddd;">...................</span>';
	$konfirmasi = ($detail->konfirmasi != '') ? $detail->konfirmasi : '<span style="color:#dddddd;">...................</span>';
	$pakaian_laki_laki = ($detail->pakaian_laki_laki != '') ? $detail->pakaian_laki_laki : '<span style="color:#dddddd;">...................</span>';
	$pakaian_perempuan = ($detail->pakaian_perempuan != '') ? $detail->pakaian_perempuan : '<span style="color:#dddddd;">...................</span>';
	$pakaian_tni_polri = ($detail->pakaian_tni_polri != '') ? $detail->pakaian_tni_polri : '<span style="color:#dddddd;">...................</span>';
?>

<body contenteditable="true" class="cke_editable cke_editable_themed cke_contents_ltr" spellcheck="false">
	<table border="1" cellspacing="0" cellpadding="0" align="center" class="cke_show_border" style="width:100%;">
		<tbody>
			<tr>
				<td>
					<table border="0" cellspacing="0" cellpadding="0" align="center" class="cke_show_border" style="width:100%;">
						<tbody>
							<tr style="height: 5%">
								<td style="width: 5%">
								</td>
								<td>
								</td>
								<td style="width: 5%">
								</td>
							</tr>
							<tr>
								<td>
								</td>

								<td>
									<p style="text-align: center;">
										<img alt="" data-cke-saved-src="http://localhost/notadinas_umum/aset/img/lambang_negara_1.jpg" src="http://localhost/notadinas_umum/aset/img/lambang_negara_1.jpg" style="border-width: 0px; border-style: solid; width: 12%;">
									</p>
									<table border="0" cellspacing="0" cellpadding="0" align="center" class="cke_show_border" style="width:100%;">
										<tbody>
											<tr>
												<th>
													<span style="font-size:16px;">
														<?php echo strtoupper($jabatan); ?>
														<br>
														<?php echo strtoupper($instansi); ?>
													</span>
												</th>
											</tr>
											<tr style="height: 10px">
												<td>
												</td>
											</tr>
											<tr>
												<td>
													<span style="font-size:16px;">
														<center>
															mengharapkan dengan hormat kehadiran Bapak/Ibu/Saudara
														</center>
													</span>
												</td>
											</tr>
											<tr style="height: 10px">
												<td>
												</td>
											</tr>
											<tr>
												<td>
													<span style="font-size:16px;">
														<center >
															pada acara
														</center>
													</span>
												</td>
											</tr>
											<tr>
												<td>
													<span style="font-size:16px;">
														<center >
															<?php echo $nama_acara ?>
														</center>
													</span>
												</td>
											</tr>
											<tr style="height: 40px">
												<td>
												</td>
											</tr>
											<tr>
												<td>
													<span style="font-size:16px;">
														<center >
															hari <?php echo $hari_acara?> / <?php echo $tanggal_acara?>, pukul <?php echo $waktu_acara?> WIB
														</center>
													</span>
												</td>
											</tr>
											<tr>
												<td>
													<span style="font-size:16px;">
														<center >
															bertempat di <?php echo $tempat_acara?>
														</center>
													</span>
												</td>
											</tr>
											<tr style="height: 60px">
												<td>
												</td>
											</tr>
										</tbody>
									</table>
									<table border="0" cellspacing="0" cellpadding="0" align="center" class="cke_show_border" style="width:100%;">
										<tbody>
											<tr>
												<td style="width: 40%">
													<table border="0" cellspacing="0" cellpadding="0" align="center" class="cke_show_border" style="width:100%;">
														<tbody>
															<tr>
																<td style="width: 10%; vertical-align: top">
																	&#8226;
																</td>
																<td>
																	Harap hadir 30 menit sebelum acara dimulai dan undangan dibawa
																</td>
															</tr>
															<tr>
																<td style="width: 10%; vertical-align: top">
																	&#8226;
																</td>
																<td>
																	Konfirmasi:<br>
																	<?php echo $konfirmasi ?>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
												<td>
												</td>
												<td style="width: 40%">
													<table border="0" cellspacing="0" cellpadding="0" align="center" class="cke_show_border" style="width:100%;">
														<tbody>
															<tr>
																<td style="width: 25%">
																	Pakaian
																</td>
																<td>
																	:	
																</td>
															</tr>
															<tr>
																<td style="width: 25%">
																	Laki-laki
																</td>
																<td>
																	: <?php echo $pakaian_laki_laki ?>
																</td>
															</tr>
															<tr>
																<td style="width: 25%">
																	Perempuan
																</td>
																<td>
																	: <?php echo $pakaian_perempuan ?>
																</td>
															</tr>
															<tr>
																<td style="width: 25%">
																	TNI/Polri
																</td>
																<td>
																	: <?php echo $pakaian_tni_polri ?>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
								<td>
								</td>
							</tr>
							<tr style="height: 5%">
								<td style="width: 5%">
								</td>
								<td>
								</td>
								<td style="width: 5%">
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	
</body>