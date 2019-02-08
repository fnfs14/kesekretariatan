<script>
function validate(str) {
    // var n = str.includes("/");
    // if(n===false){
        var n = str.includes("\\");
        if(n===false){
            var n = str.includes("'");
            if(n===false){
                // var n = str.includes('"');
                // if(n===false){
                    return "success";
                // }else{
                    // return "failed";
                // }
            }else{
                return "failed";
            }
        }else{
            return "failed";
        }
    // }else{
        // return "failed";
    // }
}
</script>
<?php 
    $mode = $this->uri->segment(3); 

    $act = "act_edited"; 
    $idp = $datpil->id; 
    $no_setum = $datpil->no_setum; 
    $tgl_setum = $datpil->tgl_setum;
    $file_attachment = $datpil->file_attachment;
    $instansi = $datpil->instansi;
    $no_surat = $datpil->no_surat;
    $tgl_surat = $datpil->tgl_surat;
    $perihal = $datpil->perihal; 
    $ket = $datpil->keterangan; 
    $kepada = $datpil->kepada;
    $ruangs = $datpil->id_ruang; 
    $raks = $datpil->id_rak; 
    $boxs = $datpil->id_box;  
    $bariss= $datpil->baris; 
?>
<style>
    .custom-combobox {
        position: relative;
        display: inline-block;
    }

    .custom-combobox-toggle {
        position: absolute;
        top: 0;
        bottom: 0;
        margin-left: -1px;
        padding: 0;
    }

    .custom-combobox-input {
        margin: 0;
        padding: 5px 10px;
    }

    input.ui-state-default {
        background: white;
    }
	table.table-form tr td {
		text-transform: lowercase;
	}
	table.table-form tr td:first-letter {
		text-transform: uppercase;
	}
</style>
<script src="<?= base_url() ?>aset/js/autocomplete.js"></script>
<!-- breadcrumb -->
<ol class="breadcrumb breadcrumb-arrow">
    <li><a href="#"><i class="fa fa-home"></i></a></li>
    <li><a href="#"><i class="fa fa-envelope"></i> Surat Masuk</a></li>
    <li class="active"><span>Edit Surat</span></li>
</ol>
<!-- End Breadcrumb -->
<div class="navbar navbar-inverse">
    <div class="container z0">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Surat Masuk</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->


<form action="<?php echo base_URL(); ?>admin/surat_masuk/<?php echo $act; ?>" method="post" accept-charset="utf-8"
      enctype="multipart/form-data" id="formnya">

<input type="hidden" name="idp" value="<?php echo $idp; ?>">


<div class="row-fluid well" style="overflow: hidden">

    <div class="col-lg-6">
        <table class="table-table">
		<tr>
                <td>Jenis Surat</td>
                <td>
                    <select onchange="ganti(this.value)" name="jenis_surat" class="form-control" style="width: 200px">
                        <option value="" style="display: none;">- Pilih Jenis -</option>
                        <?php foreach ($jenis_surat as $key => $js) { 
                                if($js->id_master_surat_masuk == $datpil->id_jenis_surat_masuk){
                                    echo "<option value='$js->id_master_surat_masuk' selected>$js->jenis_surat_masuk</option>";
                                } else {
                                    echo "<option value='$js->id_master_surat_masuk'>$js->jenis_surat_masuk</option>";
                                }
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="20%">No. Agenda</td>
                <td><b><input type="text" id="no_setum" name="no_setum" tabindex="1" required
                              value="<?php if (isset($generated_no_surat) AND $mode == 'add') {
                                  echo $generated_no_surat;
                              } else {
                                  echo $no_setum;
                              } ?>" style="width: 200px"
                              class="form-control"></b></td>
            </tr>
            <tr>
                <td width="20%">Tanggal Agenda</td>
				<?php
					if($mode=='add'){
						$exptgl = $tgl_setum;
					}else{
						$exptgl = explode("-",$tgl_setum);
						$exptgl = $exptgl[2] ."-". $exptgl[1] ."-". $exptgl[0];
					}
				?>
                <td><b><input type="text" name="tgl_setum" tabindex="2" required value="<?php echo $exptgl ?>"
                              id="tgl_setum" style="width: 200px" class="form-control"></b></td>
            </tr>
            
            <tr>
                <td>Klasifikasi</td>
                <td><b>
                        <select name="klasifikasi" tabindex="3" required class="form-control" id="klasifikasi"
                                style="width: 200px">
                            <option value="" style="display: none;">- Pilih Klasifikasi -</option>
                        <?php 
						$klasifikasi_option = $this->db->query("SELECT * FROM notadinas.master_klasifikasi_surat_masuk")->result();
						foreach ($klasifikasi_option as $key => $js) { 
						if((isset($datpil->klasifikasi) and $datpil->klasifikasi == $js->klasifikasi_surat_masuk)){
							$selected_klasifikasi = "selected";
						}else{
							$selected_klasifikasi = "";
						}?>
						<option value="<?= $js->klasifikasi_surat_masuk; ?>" <?= $selected_klasifikasi; ?>><?= $js->klasifikasi_surat_masuk; ?></option>
						<?php } ?>
                        </select></b>
                </td>
            </tr>
            <tr>
                <td>Derajat</td>
                <td><b>
                        <select name="derajat" tabindex="4" required class="form-control" id="derajat"
                                style="width: 200px">
                                <option value="" style="display: none;">- Pilih Derajat -</option>
                            <?php 
						$klasifikasi_option = $this->db->query("SELECT * FROM notadinas.master_derajat")->result();
						foreach ($klasifikasi_option as $key => $js) { 
						if((isset($datpil->drajat) and $datpil->drajat == $js->derajat)){
							$selected_derajat = "selected";
						}else{
							$selected_derajat = "";
						}?>
						<option value="<?= $js->derajat; ?>" <?= $selected_derajat; ?>><?= $js->derajat; ?></option>
						<?php } ?>
                        </select></b>
                </td>
            </tr>


            <tr>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="modal fade" id="myModal123" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Tujuan</h4>
                    <br/>
                    <input type="text" name="nama_tambah_tujuan" class="form-control" id="nama_tambah_tujuan"/>
                    <br/>
                    <a href="#" class="btn btn-default btn-sm" id="button_tambah_tujuan">Simpan</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#button_tambah_tujuan").click(function () {
            $.ajax({
                method: 'get',
                url: "<?php echo base_URL()?>admin/surat_keluar/tambah_tujuan?q=" + $("#nama_tambah_tujuan").val(),
                data: {}, success: function (result) {
                    $("#combobox").html(result);
                    $(".custom-combobox-input").val($("#nama_tambah_tujuan").val());
                }, error: function () {
                    alert("Nama tujuan sudah tersedia");
                }
            });
            $("#myModal123").modal("hide");
        });
    </script>
    <div class="col-lg-6">
        <table class="table-table">
            <tr>
                <td width="20%">Asal Surat</td>
                <td>
                    <div class="ui-widget col-md-8" style="padding:0px !important; font-size: 14px;">
                        <select id="combobox" name="instansi" class="form-control" style="width: 200px">
                            <!-- <option value="" style="display: none;">- Pilih Asal Surat -</option> -->
                            <?php foreach ($tujuan as $a) {
                                if ($instansi == $a->id) {
                                echo "<option value='$a->id' selected>$a->nama</option>";
                                } else {
                                    echo "<option value='$a->id'>$a->nama</option>";
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-2" style="padding:0px !important;">
                        <a data-toggle="modal" data-target="#myModal123" class="btn btn-default btn-sm"
                           title="Tambah Tujuan"><span class="icon icon-plus icon-white"></span></a>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="20%">Nomor Surat</td>
                <td><b><input type="text" id="no_surat" name="no_surat" tabindex="6" required
                              value="<?php if (isset($generated_no_surat) AND $mode == 'add') {
                                  echo $generated_no_surat;
                              } else {
                                  echo $no_surat;
                              } ?>" style="width: 200px"
                              class="form-control"></td>
            </tr>
            <tr>
          
                <td width="20%">Tanggal Surat</td>
				<?php 
					if($mode=='add'){
						$exptgl = $tgl_surat;
					}else{
						$exptgl = explode("-",$tgl_surat);
						$exptgl = $exptgl[2] ."-". $exptgl[1] ."-". $exptgl[0];
					}
				?>
                <td><b><input type="text" name="tgl_surat" tabindex="7" required placeholder="Tanggal Surat"
                              id="tgl_surat" style="width: 200px" value="<?php echo $exptgl; ?>"
                              class="form-control"></b></td>
            </tr>
            <tr>
                <td width="20%">Perihal</td>
                <td><b><textarea name="perihal" tabindex="8" required class="form-control" placeholder="Perihal" style="width: 400px"
                              ><?php echo $perihal; ?></textarea></b></td>
            </tr>

            <tr>
                <td width="20%">
                <?php if($act == "kadisp"){ echo "Diterima Dari";}else{echo " Diteruskan Kepada";} ?>
               

                </td>
                <td><b>
                        <select name="kepada" tabindex="9" required class="form-control" id="derajat"
                                style="width: 200px">
                                <option value="" style="display: none;">- Pilih -</option>
                            <?php if($mode == 'add'){ ?>
                            <option value="1">KAPUSHIDROSAL</option>
                            <option value="28">WAKAPUSHIDROSAL</option>
                            <?php } else { ?>
                            <option value="1" <?php if($kepada == 1) echo "selected='selected'";?>>KAPUSHIDROSAL</option>
                            <option value="28" <?php if($kepada == 28) echo "selected='selected'";?>>WAKAPUSHIDROSAL</option>
                            <?php } ?>
                        </select></b>
                </td>
            </tr>
         <!--    <tr>
                <td width="20%">Keterangan</td>
                <td><b><textarea name="ket" tabindex="10" style="width: 400px"
                                 class="form-control" <?php echo ($idp != "") ? "disabled" : ""; ?> ><?php echo $ket; ?></textarea></b>
                </td>
            </tr> -->
            <tr>
                <td width="20%">File Surat</td>
                <td>
                    <b><input id="file_attachment_id" type="file" name="file_attachment" tabindex="11" class="form-control"
                              style="width: 200px"></b>File lama:<a
                            href="<?= (isset($file_attachment)) ? base_URL() . 'upload/surat_masuk/' . $file_attachment : "#"; ?>"
                            target='_blank'><?= (isset($file_attachment)) ? $file_attachment : ""; ?></a>
                <tr>
                <td></td>

                <td><a class="btn btn-default btn-sm" id="generate_no">Tampilkan Nomor Lampiran</a> <a href="" target="_blank" id="cetak_no_lampiran" class="btn btn-default btn-sm">Cetak Nomor</a></td>
            </tr>
            <tr>
                <td></td>
                <td><input readonly type='text' tabindex='2' name='no_lampiran' id='no_lampiran' style='' class='form-control'>
                </td>
            </tr>
            <script>
                $("#generate_no").click(function () {
                    // alert(document.getElementById("filenya").files[0].name);
                    // $.ajax({
                        // method: 'post',
                        // url: "<?php echo base_url(); ?>admin/generate_filename?q=2",
                        // success: function (result) {
                            // var a = new Date();
                            // $("#no_lampiran").attr("value", "SM-" + result + "-" + a.getFullYear());
                            // $("#cetak_no_lampiran").attr("href", "<?php echo base_URL(); ?>admin/cetak_no_lampiran/SM-" + result + "-" + a.getFullYear());
                        // },
                        // error: function () {
                            // alert("Terjadi Kesalahan");
                        // }

                    // }); 
                    var dat = "<?php echo $file_attachment ?>";//ubah mei surmas8
                    var dat1 = dat.split("_");
                    var dat2 = dat1[1].split(".");
                    var idbt = Number(dat2[0]) + 1;
                    if(idbt<10){
                        idbt = "00" + idbt;
                    }else if(idbt>10){
                        idbt = "0" + idbt;
                    }        
                    var replace = $("input[name='no_setum']").val().replace(".", "") + "_" + idbt;//ubah mei surmas8
                    $("#no_lampiran").attr("value", replace);
                    $("#cetak_no_lampiran").attr("href", "<?php echo base_URL(); ?>admin/cetak_no_lampiran_sm/" + $("input[name='no_lampiran']").val());//ubah mei surmas8
                });
            </script>
            </tr>
             <?php if(empty($file_attachment)){ ?>
            <tr>
                <td></td>
                <td><input readonly type='text' tabindex='2' name='no_lampiran' id='no_lampiran' style='' class='form-control'>
                </td>
            </tr>
        <?php } ?>
            <tr>
                    <td colspan="2">
                        <br>
                        <!--<button type="submit" class="btn btn-primary" tabindex="12"><i
                                    class="icon icon-ok icon-white"></i> Simpan 
                        </button>-->
                        <a href="#" class="btn btn-primary" tabindex="13" id="simpat"><i
                                    class="icon icon-ok icon-white"></i> Simpan</a>
                        <script>
                            $('#simpat').click(function(){
                                var perihal = validate($("input[name='perihal']").val());
                                if($("input[name='perihal']").val()==""){
                                    alert("Harap isi perihal");
                                }else if(perihal=="failed"){
                                    alert("Harap tidak menggunakan kutip (') dan backslash (\\)");
                                }else if(document.getElementById("file_attachment_id").files.length==0){
                                    $('#formnya').submit();
                                }else if(document.getElementById("file_attachment_id").files.length==1){
                                    if($("input[name='no_lampiran']").val()==""){
                                        alert("Harap tampilkan nomor lampiran");
                                    }else{                                      
                                        $('#formnya').submit();
                                    }
                                }else{
                                    $('#formnya').submit();
                                }
                            });
                        </script>

                        <a href="<?php echo base_URL(); ?>admin/surat_masuk" class="btn btn-success" tabindex="13"><i
                                    class="icon icon-arrow-left icon-white"></i> Kembali</a>
                    </td>
                </tr>
        </td>
    </tr>
</tr>
</b>
</td>
</tr>
</table>
</div>
</div>
</form>
<script type="text/javascript">
$('#tgl_setum').datepicker({dateFormat: 'dd-mm-yy'}).val();
$('#tgl_surat').datepicker({dateFormat: 'dd-mm-yy'}).val();

    function ganti(isi){
        // alert(isi);
        if(isi == 4){
            var isi_awal = "<?php echo $generated_no_surat ?>";
            var tambah = "Tgmr/";
            var jadi = tambah+isi_awal;
        console.log(jadi);
        document.getElementById("no_setum").value = jadi;
        document.getElementById("no_surat").value = jadi;
        }
        if(isi == 3){
            var isi_awal = "<?php echo $generated_no_surat ?>";
            var tambah = "Tgmb/";
            var jadi = tambah+isi_awal;
        console.log(jadi);
        document.getElementById("no_setum").value = jadi;
        document.getElementById("no_surat").value = jadi;
        }
        if(isi == 6){
            var isi_awal = "<?php echo $generated_no_surat ?>";
            var tambah = "B/Und.";
            var jadi = tambah+isi_awal;
        console.log(jadi);
        document.getElementById("no_setum").value = jadi;
        document.getElementById("no_surat").value = jadi;
        }
        if(isi == 2){
            var isi_awal = "<?php echo $generated_no_surat ?>";
            var tambah = "R/";
            var jadi = tambah+isi_awal;
        console.log(jadi);
        document.getElementById("no_setum").value = jadi;
        document.getElementById("no_surat").value = jadi;
        }
        if(isi == 1){
            var isi_awal = "<?php echo $generated_no_surat ?>";
            var tambah = "B/";
            var jadi = tambah+isi_awal;
        console.log(jadi);
        document.getElementById("no_setum").value = jadi;
        document.getElementById("no_surat").value = jadi;
        }
        if(isi == 5){
            var isi_awal = "<?php echo $generated_no_surat ?>";
            var tambah = "B/Lua.";
            var jadi = tambah+isi_awal;
        console.log(jadi);
        document.getElementById("no_setum").value = jadi;
        document.getElementById("no_surat").value = jadi;
        }
        
     }
</script>
