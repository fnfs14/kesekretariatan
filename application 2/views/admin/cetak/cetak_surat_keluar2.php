<!DOCTYPE html>
<html>
<head>
</head>

<body onload="window.print()">
		<?php if ($jenis_surat == 4): ?>
			<!-- TTD SURAT BIASA -->
			<img style="position: absolute;right: 5px;top: 630px;width:150px;height:150px;z-index:-1;" src="<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>" alt="">
		<?php elseif ($jenis_surat == 2): ?>
			<!-- TTD SURAT NOTA DINAS -->
			<img style="position: absolute;right: 80px;top: 650px;width:120px;height:120px;z-index:-1;" src="<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>" alt="">
		<?php elseif ($jenis_surat == 13): ?>
			<!-- TTD SURAT PENGANTAR -->
			<img style="position: absolute;right: 130px;top: 560px;width:120px;height:120px;z-index:-1;" src="<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>" alt="">
		<?php elseif ($jenis_surat == 6): ?>
			<!-- TTD SURAT PERINTAH -->
			<img style="position: absolute;right: 90px;top: 780px;width:90px;height:90px;z-index:-1;" src="<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>" alt="">
		<?php elseif ($jenis_surat == 10): ?>
			<!-- TTD SURAT KETERANGAN -->
			<img style="position: absolute;right: 130px;top: 700px;width:120px;height:120px;z-index:-1;" src="<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>" alt="">
		<?php elseif ($jenis_surat == 12): ?>
			<!-- TTD SURAT LUAR NEGERI -->
			<img style="position: absolute;left: 0px;top: 740px;width:120px;height:120px;z-index:-1;" src="<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>" alt="">
		<?php elseif ($jenis_surat == 3): ?>
			<!-- TTD SURAT RAHASIA -->
			<img style="position: absolute;right:30px;top: 650px;width:120px;height:120px;z-index:-1;" src="<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>" alt="">
		<?php elseif ($jenis_surat == 14): ?>
			<!-- TTD SURAT TUGAS -->
			<img style="position: absolute;right:150px;top: 910px;width:120px;height:120px;z-index:-1;" src="<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>" alt="">
		<?php elseif ($jenis_surat == 9): ?>
			<!-- TTD SURAT EDARAN -->
			<img style="position: absolute;right:140px;top: 960px;width:120px;height:120px;z-index:-1;" src="<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>" alt="">
		<?php elseif ($jenis_surat == 11): ?>
			<!-- TTD SURAT KEPUTUSAN -->
			<img style="position: absolute;right:130px;top: 1350px;width:100px;height:100px;z-index:-1;" src="<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>" alt="">
		<?php elseif ($jenis_surat == 5): ?>
			<!-- TTD SURAT IZIN -->
			<img style="position: absolute;right:150px;top: 1250px;width:150px;height:150px;z-index:-1;" src="<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>" alt="">
		<?php elseif ($jenis_surat == 17): ?>
			<!-- TTD SURAT SERTIFIKAT -->
			<img style="position: absolute;right:130px;top: 430px;width:120px;height:120px;z-index:-1;" src="<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>" alt="">

		<?php endif; ?>

	<?= $isi ?>
<script type="text/javascript">
		document.getElementById('nosurat').innerHTML = "<?php echo $no_surat ?>";
		document.getElementById('tglsurat').innerHTML = "<?php echo $tgl_surat ?>";
	</script>
</body>
</html>
