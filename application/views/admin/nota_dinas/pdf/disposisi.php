<?php
	setlocale(LC_TIME, 'id');
	$alamat_instansi = ($detail->alamat_instansi != '') ? $detail->alamat_instansi : '<span style="color:#dddddd;">.................. </span>';
	$telepon_instansi = ($detail->telepon_instansi != '') ? $detail->telepon_instansi : '<span style="color:#dddddd;">.................. </span>';
	$faksimile_instansi = ($detail->faksimile_instansi != '') ? $detail->faksimile_instansi : '<span style="color:#dddddd;">.................. </span>';
	$n_a_registrasi = ($detail->n_a_registrasi != '') ? $detail->n_a_registrasi : '<span style="color:#dddddd;">.................. </span>';
	$tingkat_keamanan = $detail->tingkat_keamanan;

	$tanggal_penerimaan = ($detail->tanggal_penerimaan != '') ? strftime("%#d %B %Y", strtotime($detail->tanggal_penerimaan)) : '<span style="color:#dddddd;">.................. </span>';

	$tanggal_penyelesaian = ($detail->tanggal_penyelesaian != '') ? strftime("%#d %B %Y", strtotime($detail->tanggal_penyelesaian)) : '<span style="color:#dddddd;">.................. </span>';

	$tanggal_surat = ($detail->tanggal_surat != '') ? strftime("%#d %B %Y", strtotime($detail->tanggal_surat)) : '<span style="color:#dddddd;">.................. </span>';

	$nomor_surat = ($detail->nomor_surat != '') ? $detail->nomor_surat : '<span style="color:#dddddd;">.................. </span>';
	$dari = ($detail->dari != '') ? $detail->dari : '<span style="color:#dddddd;">.................. </span>';
	$ringkasan_isi = ($detail->ringkasan_isi != '') ? $detail->ringkasan_isi : '<span style="color:#dddddd;">.................. </span>';
	$lampiran = ($detail->lampiran != '') ? $detail->lampiran : '<span style="color:#dddddd;">.................. </span>';
	$catatan = ($detail->catatan != '') ? $detail->catatan : '<span style="color:#dddddd;">.................. </span>';
	$desisnas 				= $detail->desisnas;
	$dejiandra 				= $detail->dejiandra;
	$depolstra 				= $detail->depolstra;
	$debang 				= $detail->debang;
	$sahli_hankam 			= $detail->sahli_hankam;
	$sahli_ekonomi 			= $detail->sahli_ekonomi;
	$sahli_hukum 			= $detail->sahli_hukum;
	$sahli_sosbud 			= $detail->sahli_sosbud;
	$sahli_iptek 			= $detail->sahli_iptek;
	$kabag_minu 			= $detail->kabag_minu;
	$kabag_kepeg 			= $detail->kabag_kepeg;
	$kabag_rumga 			= $detail->kabag_rumga;
	$kabag_rengar 			= $detail->kabag_rengar;
	$kabag_adminku 			= $detail->kabag_adminku;
	$kabag_persidangan 		= $detail->kabag_persidangan;
	$kabag_humas 			= $detail->kabag_humas;
	$kpa 					= $detail->kpa;
	$ppk 					= $detail->ppk;
	$tpi 					= $detail->tpi;
	$tim_rb 				= $detail->tim_rb;
	$dp_korpri 				= $detail->dp_korpri;
	$ulp 					= $detail->ulp;
	$lpse 					= $detail->lpse;
	$ppbj 					= $detail->ppbj;
	$sespri_sesjen 			= $detail->sespri_sesjen;
	$disposisi_sesjen = ($detail->disposisi_sesjen != '') ? $detail->disposisi_sesjen : '<span style="color:#dddddd;">.................. </span>';
	$tempat_disposisi = ($detail->tempat_disposisi != '') ? $detail->tempat_disposisi : '<span style="color:#dddddd;">.................. </span>';
	$tanggal_disposisi = ($detail->tanggal_disposisi != '') ? strftime("%#d %B %Y", strtotime($detail->tanggal_disposisi)) : '<span style="color:#dddddd;">.................. </span>';

?>

<body contenteditable="true" class="cke_editable cke_editable_themed cke_contents_ltr" spellcheck="false">
	<table border="0" cellspacing="0" cellpadding="0" align="center" class="cke_show_border" style="width:100%;">
		<tbody>
			<tr>
				<th>
					<span style="font-size: 14px">
						DEWAN KETAHANAN NASIONAL
					</span>
				</th>
			</tr>
			<tr>
				<th>
					<span style="font-size: 14px">
						<?php echo strtoupper($alamat_instansi) ?> TELEPON <?php echo strtoupper($telepon_instansi) ?> FAKSIMILE <?php echo strtoupper($faksimile_instansi) ?>
					</span>
				</th>
			</tr>
			<tr style="height: 40px">
				<th>
				</th>
			</tr>
			<tr>
				<th>
					<span style="font-size: 14px">
						LEMBAR DISPOSISI
					</span>
				</th>
			</tr>
			<tr style="height: 10px">
				<th>
				</th>
			</tr>
		</tbody>
	</table>
	<table style="width:100%;" cellspacing="0" cellpadding="0">
		<tbody>
			<tr >
				<td style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000; width: 50%">
					<p>
						N.A./Registrasi : <?php echo $n_a_registrasi ?>
					</p>	
				</td>
				<td style="border-top: 1px solid #000000;border-bottom: 1px solid #000000; width: 50%">
					<p>
						Tkt. Keamanan : 
						<?php echo ($tingkat_keamanan == 'SR') ? '<b><u>SR</u></b>' : 'SR' ?>
						/
						<?php echo ($tingkat_keamanan == 'R') ? '<b><u>R</u></b>' : 'R' ?>
						/
						<?php echo ($tingkat_keamanan == 'B') ? '<b><u>B</u></b>' : 'B' ?>
					</p>	
				</td>
			</tr>
			<tr>
				<td style="border-bottom: 1px solid #000000;border-right: 1px solid #000000; width: 50%">
					<p>
						Tanggal Penerimaan : <?php echo $tanggal_penerimaan ?>
					</p>	
				</td>
				<td style="border-bottom: 1px solid #000000; width: 50%">
					<p>
						Tgl. Penyelesaian : <?php echo $tanggal_penyelesaian ?>
					</p>	
				</td>
			</tr>
			<tr>
				<td colspan="2" style="border-bottom: 1px solid #000000;">
					<table style="width:100%;" cellspacing="0" cellpadding="0">
						<tbody>
							<tr >
								<td style="width: 23%; vertical-align: top">
									Tanggal dan Nomor Surat
								</td>
								<td style=" width: 2%; vertical-align: top">
									:
								</td>
								<td >
									<?php echo $tanggal_surat ?> / <?php echo $nomor_surat?>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top">
									Dari
								</td>
								<td style="vertical-align: top">
									:
								</td>
								<td>
									<?php echo $dari ?>
								</td>
							</tr>

						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="border-bottom: 1px solid #000000;">
					<table style="width:100%;" cellspacing="0" cellpadding="0">
						<tbody>
							<tr >
								<td style="width: 23%; vertical-align: top">
									Ringkasan Isi
								</td>
								<td style=" width: 2%; vertical-align: top">
									:
								</td>
								<td >
									<?php echo $ringkasan_isi ?>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top">
									Lampiran
								</td>
								<td style="vertical-align: top">
									:
								</td>
								<td>
									<?php echo $lampiran ?>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="border-bottom: 1px solid #000000;">
					<center>
						<p>
							KAROUM/CATATAN:
						</p>
					</center>
				</td>
			</tr>
			<tr>
				<td colspan="2">
						<p>
							<?php echo $catatan ?>
						</p>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<table style="width:100%;" cellspacing="0" cellpadding="0">
						<tbody>
							<tr >
								<td colspan='3' style="vertical-align: top; border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-right: 1px solid #000000;">
									<center><p>Diteruskan kepada Yth.</p></center>
								</td>
								<td style="width: 15%; vertical-align: top; border-bottom: 1px solid #000000; border-top: 1px solid #000000;">
									<center><p>Paraf</p></center>
								</td>
							</tr>
							<tr>
								<td style="width: 28%; vertical-align: top; border-bottom: 1px solid #000000; border-right: 1px solid #000000;">
									<?php echo ($desisnas)?'<b><u>':''?> 1. Desisnas<br> <?php echo ($desisnas)?'</u></b>':''?>
									<?php echo ($dejiandra)?'<b><u>':''?> 2. Dejiandra<br> <?php echo ($dejiandra)?'</u></b>':''?>
									<?php echo ($depolstra)?'<b><u>':''?> 3. Depolstra<br> <?php echo ($depolstra)?'</u></b>':''?>
									<?php echo ($debang)?'<b><u>':''?> 4. Debang<br> <?php echo ($debang)?'</u></b>':''?>
									5. Sahli Bidang :<br>
									&emsp;<?php echo ($sahli_hankam)?'<b><u>':''?>a. Hankam<br> <?php echo ($sahli_hankam)?'</u></b>':''?>
									&emsp;<?php echo ($sahli_ekonomi)?'<b><u>':''?>b. Ekonomi<br> <?php echo ($sahli_ekonomi)?'</u></b>':''?>
									&emsp;<?php echo ($sahli_hukum)?'<b><u>':''?>c. Hukum<br> <?php echo ($sahli_hukum)?'</u></b>':''?>
									&emsp;<?php echo ($sahli_sosbud)?'<b><u>':''?>d. Sosbud<br>  <?php echo ($sahli_sosbud)?'</u></b>':''?>
									&emsp;<?php echo ($sahli_iptek)?'<b><u>':''?>e. Iptek<br> <?php echo ($sahli_iptek)?'</u></b>':''?>
								</td>
								<td style="width: 28%; vertical-align: top; border-bottom: 1px solid #000000; border-right: 1px solid #000000;">
									6. Kepala Biro<br>
									&emsp;a. Karo Umum<br>
									&emsp;&emsp;<?php echo ($kabag_minu)?'<b><u>':''?>- Kabag Minu<br> <?php echo ($kabag_minu)?'</u></b>':''?>
									&emsp;&emsp;<?php echo ($kabag_kepeg)?'<b><u>':''?>- Kabag Kepeg<br> <?php echo ($kabag_kepeg)?'</u></b>':''?>
									&emsp;&emsp;<?php echo ($kabag_rumga)?'<b><u>':''?>- Kabag Rumga<br> <?php echo ($kabag_rumga)?'</u></b>':''?>
									&emsp;b. Karo Keuangan<br>
									&emsp;&emsp;<?php echo ($kabag_rengar)?'<b><u>':''?>- Kabag Rengar<br> <?php echo ($kabag_rengar)?'</u></b>':''?>
									&emsp;&emsp;<?php echo ($kabag_adminku)?'<b><u>':''?>- Kabag Adminku<br> <?php echo ($kabag_adminku)?'</u></b>':''?>
									&emsp;c. Karodangmas<br>
									&emsp;&emsp;<?php echo ($kabag_persidangan)?'<b><u>':''?>- Kabag Persidangan<br> <?php echo ($kabag_persidangan)?'</u></b>':''?>
									&emsp;&emsp;<?php echo ($kabag_humas)?'<b><u>':''?>- Kabag Humas<br> <?php echo ($kabag_humas)?'</u></b>':''?>
								</td>
								<td style="width: 28%; vertical-align: top; border-bottom: 1px solid #000000; border-right: 1px solid #000000;">
									<br>
									<?php echo ($kpa)?'<b><u>':''?> 7. KPA<br> <?php echo ($kpa)?'</u></b>':''?>
									<?php echo ($ppk)?'<b><u>':''?> 8. PPK<br> <?php echo ($ppk)?'</u></b>':''?>
									<?php echo ($tpi)?'<b><u>':''?> 9. TPI<br>  <?php echo ($tpi)?'</u></b>':''?>
									<?php echo ($tim_rb)?'<b><u>':''?> 10. Tim RB<br> <?php echo ($tim_rb)?'</u></b>':''?>
									<?php echo ($dp_korpri)?'<b><u>':''?> 11. DP KORPRI<br> <?php echo ($dp_korpri)?'</u></b>':''?>
									<?php echo ($ulp)?'<b><u>':''?> 12. ULP<br> <?php echo ($ulp)?'</u></b>':''?>
									<?php echo ($lpse)?'<b><u>':''?> 13. LPSE<br> <?php echo ($lpse)?'</u></b>':''?>
									<?php echo ($ppbj)?'<b><u>':''?> 14. PPBJ<br> <?php echo ($ppbj)?'</u></b>':''?>
									<?php echo ($sespri_sesjen)?'<b><u>':''?> 15. Sespri Sesjen<br> <?php echo ($sespri_sesjen)?'</u></b>':''?>
								</td>
								<td style="width: 16%; vertical-align: top; border-bottom: 1px solid #000000;">
									
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="border-bottom: 1px solid #000000;">
					<center>
						<p>
							DISPOSISI SESJEN:
						</p>
					</center>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="border-bottom: 1px solid #000000;">
					<p>
						 <?php echo $disposisi_sesjen ?>
					</p>
				</td>
			</tr>
			<tr>
				<td colspan="2" >
					<table style="width:100%;" cellspacing="0" cellpadding="0">
						<tbody>
							<tr >
								<td style="vertical-align: top;">
									
								</td>
								<td style="width: 30%; vertical-align: top">
									<p>
										 <?php echo $tempat_disposisi ?>, <?php echo $tanggal_disposisi ?>
									</p>
								</td>
							</tr>
							<tr style="height: 40px">
								<td">
									
								</td>
							</tr>
							<tr >
								<td style="vertical-align: top;">
									
								</td>
								<td style="width: 30%; vertical-align: top">
									<p>
										Kepala Bagian Administrasi Umum
									</p>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</body>

