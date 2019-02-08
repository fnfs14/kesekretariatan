
	
<?php
if ($action == "edit_nota") {
	$id						= $request->ID;
	$alamat_instansi		= $detail->alamat_instansi;
	$telepon_instansi 		= $detail->telepon_instansi;
	$faksimile_instansi 	= $detail->faksimile_instansi;
	$n_a_registrasi 		= $detail->n_a_registrasi;
	$tingkat_keamanan 		= $detail->tingkat_keamanan;
	$tanggal_penerimaan 	= $detail->tanggal_penerimaan;
	$tanggal_penyelesaian 	= $detail->tanggal_penyelesaian;
	$tanggal_surat 			= $detail->tanggal_surat;
	$nomor_surat 			= $detail->nomor_surat;
	$dari 					= $detail->dari;
	$ringkasan_isi 			= $detail->ringkasan_isi;
	$lampiran 				= $detail->lampiran;
	$catatan 				= $detail->catatan;
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
	$disposisi_sesjen		= $detail->disposisi_sesjen;
	$tempat_disposisi 		= $detail->tempat_disposisi;
	$tanggal_disposisi 		= $detail->tanggal_disposisi;
	
} else {
	$id				= $request->ID;
	$alamat_instansi = '';
	$telepon_instansi = '';
	$faksimile_instansi = '';
	$n_a_registrasi = '';
	$tingkat_keamanan = '';
	$tanggal_penerimaan = '';
	$tanggal_penyelesaian = '';
	$tanggal_surat = '';
	$nomor_surat = '';
	$dari = '';
	$ringkasan_isi = '';
	$lampiran = '';
	$catatan = '';
	$desisnas = false;
	$dejiandra = false;
	$depolstra = false;
	$debang = false;
	$sahli_hankam = false;
	$sahli_ekonomi = false;
	$sahli_hukum = false;
	$sahli_sosbud = false;
	$sahli_iptek = false;
	$kabag_minu = false;
	$kabag_kepeg = false;
	$kabag_rumga = false;
	$kabag_rengar = false;
	$kabag_adminku = false;
	$kabag_persidangan = false;
	$kabag_humas = false;
	$kpa = false;
	$ppk = false;
	$tpi = false;
	$tim_rb = false;
	$dp_korpri = false;
	$ulp = false;
	$lpse = false;
	$ppbj = false;
	$sespri_sesjen = false;
	$disposisi_sesjen = '';
	$tempat_disposisi = '';
	$tanggal_disposisi = '';

	
}
?>
			<div class="form-group">
				<center><h3>Data Dewan Ketahanan Nasional</h3><br></center>
				<div class="col-lg-4">
					<div class="form-group">
				        <label class="col-xs-2">Alamat</label>
				        <div class="col-xs-10">
				            <input type="text" name="alamat_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $alamat_instansi; ?>'>
				        </div>
				    </div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
				        <label class="col-xs-2">Telepon</label>
				        <div class="col-xs-10">
				            <input type="text" name="telepon_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $telepon_instansi; ?>'>
				        </div>
				    </div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
				        <label class="col-xs-2">Faksimile</label>
				        <div class="col-xs-10">
				            <input type="text" name="faksimile_instansi" autofocus tabindex="1" class="form-control" value='<?php echo $faksimile_instansi; ?>'>
				        </div>
				    </div>
				</div>
			</div>

			<hr style="border-color:#cccccc">
			<div class="form-group">
				<center><h3>Data Naskah Disposisi</h3><br></center>
				<div class="col-lg-6">
					<div class="form-group">
				        <label class="col-xs-2">N.A. / Registrasi</label>
				        <div class="col-xs-10">
				            <input type="text" name="n_a_registrasi" autofocus tabindex="1" class="form-control" value='<?php echo $n_a_registrasi; ?>'>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-2">Tanggal Penerimaan</label>
				        <div class="col-xs-10">
				            <input type="text" name="tanggal_penerimaan" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal_penerimaan; ?>'>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
				        <label class="col-xs-2">Tingkat Keamanan</label>
				        <div class="col-xs-10">
				        	<div class='col-lg-4'>
				        		<center>
				            		<input type="radio" name="tingkat_keamanan" autofocus tabindex="1" value='SR' <?php echo $tingkat_keamanan == 'SR' ? 'checked' : ''?> > SR
				            	</center>
				            </div>
				            <div class='col-lg-4'>
				            	<center>
				            		<input type="radio" name="tingkat_keamanan" autofocus tabindex="1" value='R' <?php echo $tingkat_keamanan == 'R' ? 'checked' : ''?> > R
				            	</center>
				            </div>
				            <div class='col-lg-4'>
				            	<center>
				            		<input type="radio" name="tingkat_keamanan" autofocus tabindex="1" value='B' <?php echo $tingkat_keamanan == 'B' ? 'checked' : ''?> > B
				            	</center>
				            </div>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="col-xs-2">Tanggal Penyelesaian</label>
				        <div class="col-xs-10">
				            <input type="text" name="tanggal_penyelesaian" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal_penyelesaian; ?>'>
				        </div>
				    </div>
				</div>
			</div>

			<hr style="border-color:#cccccc">
			<div class="form-group">
				<center><h3>Data Surat</h3><br></center>
				<div class="col-lg-6">
				    <div class="form-group">
				        <label class="col-xs-2">Tanggal Surat</label>
				        <div class="col-xs-10">
				            <input type="text" name="tanggal_surat" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal_surat; ?>'>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
				        <label class="col-xs-2">Nomor Surat</label>
				        <div class="col-xs-10">
				            <input type="text" name="nomor_surat" autofocus tabindex="1" class="form-control" value='<?php echo $nomor_surat; ?>'>
				        </div>
				    </div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-lg-12">
					<div class="form-group">
				        <label class="col-xs-1">Dari</label>
				        <div class="col-xs-11">
				            <input type="text" name="dari" autofocus tabindex="1" class="form-control" value='<?php echo $dari; ?>'>
				        </div>
				    </div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-lg-12">
					<div class="form-group">
						<label class="col-xs-1">Ringkasan Isi</label>
						<div class="col-xs-11">
				        	<textarea name="ringkasan_isi" class="form-control editor-field" id="ringkasan_isi" tabindex="1" autofocus><?php echo $ringkasan_isi ?></textarea>
				        </div>
		        	</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-lg-12">
					<div class="form-group">
				        <label class="col-xs-1">Lampiran</label>
				        <div class="col-xs-11">
				            <input type="text" name="lampiran" autofocus tabindex="1" class="form-control" value='<?php echo $lampiran; ?>'>
				        </div>
				    </div>
				</div>
			</div>

			<hr style="border-color:#cccccc">
			<div class="form-group">
				<center><h3>KAROUM/CATATAN:</h3><br></center>
				<div class="col-lg-12">
					<div class="form-group">
						<div class="col-xs-12">
				        	<textarea name="catatan" class="form-control editor-field" id="catatan" tabindex="1" autofocus><?php echo $catatan ?></textarea>
				        </div>
		        	</div>
				</div>
			</div>

			<hr style="border-color:#cccccc">
			<div class="form-group">
				<center><h3>Diteruskan kepada Yth.</h3><br></center>
				<div class="col-lg-2"></div>
				<div class="col-lg-3">
					<div class="form-group">
				        <input align='right' type="checkbox" name="desisnas" autofocus tabindex="1" <?php echo $desisnas ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Desisnas</span><br>
				        <input align='right' type="checkbox" name="dejiandra" autofocus tabindex="1" <?php echo $dejiandra ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Dejiandra</span><br>
				        <input align='right' type="checkbox" name="depolstra" autofocus tabindex="1" <?php echo $depolstra ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Depolstra</span><br>
				        <input align='right' type="checkbox" name="debang" autofocus tabindex="1" <?php echo $debang ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Debang</span><br>
				        <span style="font-size: 18px">&emsp;&ensp;Sahli Bidang :</span><br>
				       	&emsp;&emsp;&emsp;<input align='right' type="checkbox" name="sahli_hankam" autofocus tabindex="1" <?php echo $sahli_hankam ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Hankam</span><br>
				        &emsp;&emsp;&emsp;<input align='right' type="checkbox" name="sahli_ekonomi" autofocus tabindex="1" <?php echo $sahli_ekonomi ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Ekonomi</span><br>
				        &emsp;&emsp;&emsp;<input align='right' type="checkbox" name="sahli_hukum" autofocus tabindex="1" <?php echo $sahli_hukum ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Hukum</span><br>
				       	&emsp;&emsp;&emsp;<input align='right' type="checkbox" name="sahli_sosbud" autofocus tabindex="1" <?php echo $sahli_sosbud ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Sosbud</span><br>
				       	&emsp;&emsp;&emsp;<input align='right' type="checkbox" name="sahli_iptek" autofocus tabindex="1" <?php echo $sahli_iptek ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Iptek</span><br>

		        	</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
				        <span style="font-size: 18px">&ensp;Kepala Biro</span><br>
				        <span style="font-size: 18px">&emsp;&ensp;Karo Umum :</span><br>
				       	&emsp;&emsp;&emsp;<input align='right' type="checkbox" name="kabag_minu" autofocus tabindex="1" <?php echo $kabag_minu ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Kabag Minu</span><br>
				        &emsp;&emsp;&emsp;<input align='right' type="checkbox" name="kabag_kepeg" autofocus tabindex="1" <?php echo $kabag_kepeg ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Kabag Kepeg</span><br>
				        &emsp;&emsp;&emsp;<input align='right' type="checkbox" name="kabag_rumga" autofocus tabindex="1" <?php echo $kabag_rumga ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Kabag Rumga</span><br>
				        <span style="font-size: 18px">&emsp;&ensp;Karo Keuangan :</span><br>
				       	&emsp;&emsp;&emsp;<input align='right' type="checkbox" name="kabag_rengar" autofocus tabindex="1" <?php echo $kabag_rengar ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Kabag Rengar</span><br>
				       	&emsp;&emsp;&emsp;<input align='right' type="checkbox" name="kabag_adminku" autofocus tabindex="1" <?php echo $kabag_adminku ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Kabag Adminku</span><br>
				       	<span style="font-size: 18px">&emsp;&ensp;Karodangmas :</span><br>
				       	&emsp;&emsp;&emsp;<input align='right' type="checkbox" name="kabag_persidangan" autofocus tabindex="1" <?php echo $kabag_persidangan ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Kabag Persidangan</span><br>
				       	&emsp;&emsp;&emsp;<input align='right' type="checkbox" name="kabag_humas" autofocus tabindex="1" <?php echo $kabag_humas ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Kabag Humas</span><br>

		        	</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
				        <input align='right' type="checkbox" name="kpa" autofocus tabindex="1" <?php echo $kpa ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;KPA</span><br>
				        <input align='right' type="checkbox" name="ppk" autofocus tabindex="1" <?php echo $ppk ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;PPK</span><br>
				        <input align='right' type="checkbox" name="tpi" autofocus tabindex="1" <?php echo $tpi ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;TPI</span><br>
				        <input align='right' type="checkbox" name="tim_rb" autofocus tabindex="1" <?php echo $tim_rb ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Tim RB</span><br>
				        <input align='right' type="checkbox" name="dp_korpri" autofocus tabindex="1" <?php echo $dp_korpri ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;DP KORPRI</span><br>
				        <input align='right' type="checkbox" name="ulp" autofocus tabindex="1" <?php echo $ulp ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;ULP</span><br>
				        <input align='right' type="checkbox" name="lpse" autofocus tabindex="1" <?php echo $lpse ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;LPSE</span><br>
				        <input align='right' type="checkbox" name="ppbj" autofocus tabindex="1" <?php echo $ppbj ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;PPBJ</span><br>
				        <input align='right' type="checkbox" name="sespri_sesjen" autofocus tabindex="1" <?php echo $sespri_sesjen ? 'checked' : ''?> > <span style="font-size: 18px">&ensp;Sespri Sesjen</span><br>

		        	</div>
				</div>
			</div>

			<hr style="border-color:#cccccc">
			<div class="form-group">
				<center><h3>DISPOSISI SESJEN:</h3><br></center>
				<div class="col-lg-12">
					<div class="form-group">
						<div class="col-xs-12">
				        	<textarea name="disposisi_sesjen" class="form-control editor-field" id="disposisi_sesjen" tabindex="1" autofocus><?php echo $disposisi_sesjen ?></textarea>
				        </div>
		        	</div>
				</div>
			</div>

			<hr style="border-color:#cccccc">
			<div class="form-group">
				<center><h3>Kaki Naskah Disposisi</h3><br></center>
				<div class="col-lg-6">
					<div class="form-group">
				        <label class="col-xs-2">Tempat</label>
				        <div class="col-xs-10">
				            <input type="text" name="tempat_disposisi" autofocus tabindex="1" class="form-control" value='<?php echo $tempat_disposisi; ?>'>
				        </div>
				    </div>
				</div>
				<div class="col-lg-6">
				    <div class="form-group">
				        <label class="col-xs-2">Tanggal</label>
				        <div class="col-xs-10">
				            <input type="text" name="tanggal_disposisi" autofocus tabindex="1" class="form-control tgl" value='<?php echo $tanggal_disposisi; ?>'>
				        </div>
				    </div>
				</div>
			</div>