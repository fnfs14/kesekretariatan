<!DOCTYPE html>
<html>
<head>
</head>
<style>
    img {
        height: 120px;
        width: 120px;
    }
    .ttdSuratBiasa {
        margin-left: 600px;
    }
    .ttdSuratNotadinas {
        margin-left: 500px;
    }
    .ttdSuratPengantar {
        margin-left: 590px;
    }
    .ttdSuratPerintah {
        margin-left: 500px;
    }
    .ttdSuratKeterangan {
        margin-left: 100px;
    }
    .ttdSuratLuarnegeri {
        margin-left: 10px;
    }
    .ttdSuratRahasia {
        margin-left: 590px;
    }
    .ttdSuratTugas {
        margin-left: 590px;
    }
    .ttdSuratEdaran {
        margin-left: 300px;
    }
    .ttdSuratKeputusan {
        margin-left: 100px;
    }
    .ttdSuratIzin {
        margin-left: 330px;
    }
    .ttdSuratSertifikat {
        margin-left: 590px;
    }
    .ttdSuratBeritaacara {
        margin-left: 300px;
    }
    .ttdSuratPerjanjian {
        margin-left: 50px;
    }

</style>
<body onload="window.print()">

<?= $isi ?>

		<?php if ($jenis_surat == 4): ?>
            <!-- TTD SURAT BIASA -->
            <script type="text/javascript">
                var ttd = "<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>";
                var elem = document.createElement("img");
                elem.setAttribute("src", ttd);
                elem.setAttribute("class", "ttdSuratBiasa");
                document.getElementById("ttd1").appendChild(elem);
            </script>
        <?php elseif ($jenis_surat == 2): ?>
			<!-- TTD SURAT NOTA DINAS -->
<!--			<img style="position: absolute;right: 80px;top: 650px;width:120px;height:120px;z-index:-1;" src="--><?php //echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?><!--" alt="">-->
            <script type="text/javascript">
                var ttd = "<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>";
                var elem = document.createElement("img");
                elem.setAttribute("src", ttd);
                elem.setAttribute("class", "ttdSuratNotadinas");
                document.getElementById("ttd1").appendChild(elem);
            </script>
        <?php elseif ($jenis_surat == 13): ?>
			<!-- TTD SURAT PENGANTAR -->
<!--			<img style="position: absolute;right: 130px;top: 560px;width:120px;height:120px;z-index:-1;" src="--><?php //echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?><!--" alt="">-->
            <script type="text/javascript">
                var ttd = "<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>";
                var elem = document.createElement("img");
                elem.setAttribute("src", ttd);
                elem.setAttribute("class", "ttdSuratPengantar");
                document.getElementById("ttd1").appendChild(elem);
            </script>
        <?php elseif ($jenis_surat == 6): ?>
			<!-- TTD SURAT PERINTAH -->
<!--			<img style="position: absolute;right: 90px;top: 780px;width:90px;height:90px;z-index:-1;" src="--><?php //echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?><!--" alt="">-->
            <script type="text/javascript">
                var ttd = "<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>";
                var elem = document.createElement("img");
                elem.setAttribute("src", ttd);
                elem.setAttribute("class", "ttdSuratPerintah");
                document.getElementById("ttd1").appendChild(elem);
            </script>
        <?php elseif ($jenis_surat == 10): ?>
			<!-- TTD SURAT KETERANGAN -->
<!--			<img style="position: absolute;right: 130px;top: 700px;width:120px;height:120px;z-index:-1;" src="--><?php //echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?><!--" alt="">-->
            <script type="text/javascript">
                var ttd = "<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>";
                var elem = document.createElement("img");
                elem.setAttribute("src", ttd);
                elem.setAttribute("class", "ttdSuratKeterangan");
                document.getElementById("ttd1").appendChild(elem);
            </script>
        <?php elseif ($jenis_surat == 12): ?>
			<!-- TTD SURAT LUAR NEGERI -->
<!--			<img style="position: absolute;left: 0px;top: 740px;width:120px;height:120px;z-index:-1;" src="--><?php //echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?><!--" alt="">-->
            <script type="text/javascript">
                var ttd = "<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>";
                var elem = document.createElement("img");
                elem.setAttribute("src", ttd);
                elem.setAttribute("class", "ttdSuratLuarNegeri");
                document.getElementById("ttd1").appendChild(elem);
            </script>
        <?php elseif ($jenis_surat == 3): ?>
			<!-- TTD SURAT RAHASIA -->
<!--			<img style="position: absolute;right:30px;top: 650px;width:120px;height:120px;z-index:-1;" src="--><?php //echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?><!--" alt="">-->
            <script type="text/javascript">
                var ttd = "<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>";
                var elem = document.createElement("img");
                elem.setAttribute("src", ttd);
                elem.setAttribute("class", "ttdSuratRahasia");
                document.getElementById("ttd1").appendChild(elem);
            </script>
        <?php elseif ($jenis_surat == 14): ?>
			<!-- TTD SURAT TUGAS -->
<!--			<img style="position: absolute;right:150px;top: 910px;width:120px;height:120px;z-index:-1;" src="--><?php //echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?><!--" alt="">-->
            <script type="text/javascript">
                var ttd = "<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>";
                var elem = document.createElement("img");
                elem.setAttribute("src", ttd);
                elem.setAttribute("class", "ttdSuratTugas");
                document.getElementById("ttd1").appendChild(elem);
            </script>
        <?php elseif ($jenis_surat == 9): ?>
			<!-- TTD SURAT EDARAN -->
<!--			<img style="position: absolute;right:140px;top: 960px;width:120px;height:120px;z-index:-1;" src="--><?php //echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?><!--" alt="">-->
            <script type="text/javascript">
                var ttd = "<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>";
                var elem = document.createElement("img");
                elem.setAttribute("src", ttd);
                elem.setAttribute("class", "ttdSuratEdaran");
                document.getElementById("ttd1").appendChild(elem);
            </script>
        <?php elseif ($jenis_surat == 11): ?>
			<!-- TTD SURAT KEPUTUSAN -->
<!--			<img style="position: absolute;right:130px;top: 1350px;width:100px;height:100px;z-index:-1;" src="--><?php //echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?><!--" alt="">-->
            <script type="text/javascript">
                var ttd = "<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>";
                var elem = document.createElement("img");
                elem.setAttribute("src", ttd);
                elem.setAttribute("class", "ttdSuratKeputusan");
                document.getElementById("ttd1").appendChild(elem);
            </script>
        <?php elseif ($jenis_surat == 5): ?>
			<!-- TTD SURAT IZIN -->
<!--			<img style="position: absolute;right:150px;top: 1250px;width:150px;height:150px;z-index:-1;" src="--><?php //echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?><!--" alt="">-->
            <script type="text/javascript">
                var ttd = "<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>";
                var elem = document.createElement("img");
                elem.setAttribute("src", ttd);
                elem.setAttribute("class", "ttdSuratIzin");
                document.getElementById("ttd1").appendChild(elem);
            </script>
        <?php elseif ($jenis_surat == 17): ?>
			<!-- TTD SURAT SERTIFIKAT -->
<!--			<img style="position: absolute;right:130px;top: 430px;width:120px;height:120px;z-index:-1;" src="--><?php //echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?><!--" alt="">-->
            <script type="text/javascript">
                var ttd = "<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>";
                var elem = document.createElement("img");
                elem.setAttribute("src", ttd);
                elem.setAttribute("class", "ttdSuratSertifikat");
                document.getElementById("ttd1").appendChild(elem);
            </script>
        <?php elseif ($jenis_surat == 8): ?>
            <!-- TTD SURAT SERTIFIKAT -->
            <!--			<img style="position: absolute;right:130px;top: 430px;width:120px;height:120px;z-index:-1;" src="--><?php //echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?><!--" alt="">-->
            <script type="text/javascript">
                var ttd = "<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>";
                var elem = document.createElement("img");
                elem.setAttribute("src", ttd);
                elem.setAttribute("class", "ttdSuratPerjanjian");
                document.getElementById("ttd1").appendChild(elem);
            </script>
        <?php elseif ($jenis_surat == 1): ?>
            <!-- TTD SURAT BERITA ACARA -->
            <!--			<img style="position: absolute;right:130px;top: 430px;width:120px;height:120px;z-index:-1;" src="--><?php //echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?><!--" alt="">-->
        <script type="text/javascript">
            var ttd = "<?php echo base_url('upload/ttd/suratkeluar_'.$id.'.png'); ?>";
            var elem1 = document.createElement("img");
            elem1.setAttribute("src", ttd);
            elem1.setAttribute("class", "ttdSuratBeritaacara");
            document.getElementById("ttd1").appendChild(elem1);
            var elem2 = document.createElement("img");
            elem2.setAttribute("src", ttd);
            elem2.setAttribute("class", "ttdSuratBeritaacara");
            document.getElementById("ttd2").appendChild(elem2);
        </script>
        <?php endif; ?>


<script type="text/javascript">
		document.getElementById('nosurat').innerHTML = "<?php echo $no_surat ?>";
		document.getElementById('tglsurat').innerHTML = "<?php echo $tgl_surat ?>";
	</script>
</body>
</html>
