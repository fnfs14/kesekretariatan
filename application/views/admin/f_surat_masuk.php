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

if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt"; 
    $idp = $datpil->id; 
    $no_setum = $datpil->no_setum; 
    $tgl_setum = $datpil->tgl_setum;
    $file_attachment = $datpil->file_attachment;
    $instansi = $datpil->instansi;
    $no_surat = $datpil->no_surat;
    $tgl_surat = $datpil->tgl_surat;
    $perihal = $datpil->perihal; 
    $ket = $datpil->keterangan; 
    $kepada = $datpil->kepada;//ubah surat masuk mei
    // $workspace = $datpil->id_workspace;//ubah surat masuk mei
    $taksa = $datpil->id_taks;//ubah surat masuk mei
    $ruangs = $datpil->id_ruang; 
    $raks = $datpil->id_rak; 
    $boxs = $datpil->id_box;  
    $bariss= $datpil->baris;
    $kondisp = 0;//ubah mei surmas11

} else if ($mode == "disp") {
    // if ($this->session->userdata('admin_jabatan') == 1 and $datpil->kepada == 28) {
        // $act = "viewonly";
    // } else {
        $act = "view";
    // }
    $idp = $datpil->id;
    $no_setum = $datpil->no_setum;
    $tgl_setum = $datpil->tgl_setum;
    $file_attachment = $datpil->file_attachment;
    $instansi = $datpil->instansi;
    $no_surat = $datpil->no_surat;
    $tgl_surat = $datpil->tgl_surat;
    $perihal = $datpil->perihal;
    $klasifikasi = $datpil->klasifikasi;
    $derajat = $datpil->drajat;
    // $workspace = $datpil->id_workspace;//ubah surat masuk mei
    $taksa = $datpil->id_taks;//ubah surat masuk mei
    $ket = $datpil->keterangan;
    $kepada = $datpil->kepada;
    $aksi = $dataksi;
    $jabatan = $datajabat;
    $dataksi = [];
    $datajabat = [];
    $kondisp = $kondisp;//ubah mei surmas11
} else if ($mode == "kadisp") {
    $act = "kadisp";
    $idp = $datpil->id;
    $no_setum = $datpil->no_setum;
    $tgl_setum = $datpil->tgl_setum;
    $file_attachment = $datpil->file_attachment;
    $instansi = $datpil->instansi;
    $no_surat = $datpil->no_surat;
    $tgl_surat = $datpil->tgl_surat;
    $perihal = $datpil->perihal;
    $kepada = $datpil->kepada;//ubah surat masuk mei
    // $workspace = $datpil->id_workspace;//ubah surat masuk mei
    $taksa = $datpil->id_taks;//ubah surat masuk mei
    $ket = $datpil->keterangan;
    $dataksi = $dataksi;
    $aksi = $dataksi;
    $jabatan = $datajabat;
    $kondisp = 0;//ubah mei surmas11
} else if ($mode == "subdisp") {
    $act = "subdisp";
    $idp = $datpil->id;
    $no_setum = $datpil->no_setum;
    $tgl_setum = $datpil->tgl_setum;
    $file_attachment = $datpil->file_attachment;
    $instansi = $datpil->instansi;
    $no_surat = $datpil->no_surat;
    $tgl_surat = $datpil->tgl_surat;
    $perihal = $datpil->perihal;
    $kepada = $datpil->kepada;//ubah surat masuk mei
    // $workspace = $datpil->id_workspace;//ubah surat masuk mei
    $taksa = $datpil->id_taks;//ubah surat masuk mei
    $ket = $datpil->keterangan;
    $dataksi = $dataksi;
    $aksi = $dataksi;
    $jabatan = $datajabat;
    $kondisp = 0;//ubah mei surmas11
} else {
    $act = "act_add";
    $idp = "";
    $no_setum = ""; //gli("notadinas.surat_masuk", "no_setum", 4);
    $tgl_setum = date('d-m-Y');
    $file_attachment = "";
    $kode = "";
    $instansi = "";
    $no_surat = "";
    $tgl_surat = date('d-m-Y');
    $perihal = "";
    $ket = "";
    $kepada = "";//ubah surat masuk mei
    // $workspace = "";//ubah surat masuk mei
    $taksa = "";//ubah surat masuk mei
    $ruangs = "";
    $raks = "";
    $boxs ="";
    $bariss= "";
    $kondisp = 0;//ubah mei surmas11
}
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
    <li class="active"><span>Tambah Surat</span></li>
</ol>
<!-- End Breadcrumb -->
<div class="navbar navbar-inverse">
    <div class="container z0">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Surat Masuk</span>
        </div>
    </div><!-- /.container -->
<form action="<?php echo base_URL(); ?>admin/surat_masuk/<?php echo $act; ?>" method="post" accept-charset="utf-8"
      enctype="multipart/form-data" id="formnya">

<input type="hidden" name="idp" value="<?php echo $idp; ?>">


<div class="row-fluid well" style="overflow: hidden">

    <div class="col-lg-6">
        <table class="table-table">
			<tr>
                <td>Jenis Surat</td>
                <td>
                    <select onchange="ganti(this.value)" <?php if($act != 'act_add' ){echo "disabled";} ?> id="jenis_surat" name="jenis_surat" class="form-control" style="width: 200px"><!--ubah surat masuk mei-->
                        <option value="" style="display: none;">- Pilih Jenis -</option>
                        <?php foreach ($jenis_surat as $key => $js) { ?>

                           <option  <?php if(isset($datpil->id_jenis_surat_masuk) && $act != 'act_add'){
                            if($js->id_master_surat_masuk == $datpil->id_jenis_surat_masuk)echo "selected='selected'";
                           }  ?>   value="<?= $js->id_master_surat_masuk ?>" 
                            ><?= $js->jenis_surat_masuk ?></option>
                        <?php  } ?>
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
                              class="form-control" <?php echo ($idp != "") ? "disabled" : ""; ?> ></b></td>
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
                              id="tgl_setum" style="width: 200px" class="form-control" <?php echo ($mode != "add") ? "disabled" : ""; ?> ></b></td><!--ubah surat masuk mei -->
            </tr>
           <?php // echo $act; ?>
            <tr>
                <td>Klasifikasi</td>
                <td><b>
                        <select name="klasifikasi" tabindex="3" required class="form-control" id="klasifikasi"
                                style="width: 200px" <?php echo ($idp != "") ? "disabled" : ""; ?> >
                            <option value="" style="display: block;">- Pilih Klasifikasi -</option>
                        <?php 
						$klasifikasi_option = $this->db->query("SELECT * FROM notadinas.master_klasifikasi_surat_masuk")->result();
						foreach ($klasifikasi_option as $key => $js) { 
						if((isset($datpil->klasifikasi) and $datpil->klasifikasi == $js->klasifikasi_surat_masuk) && $act != "act_add"){
							$selected_klasifikasi = "selected";
						}else{
							$selected_klasifikasi = "";
						}?>
						<option value="<?= $js->klasifikasi_surat_masuk; ?>" <?= $selected_klasifikasi; ?>><?= $js->klasifikasi_surat_masuk; ?></option>
						<?php } ?>
                        </select></b>
                </td>
            </tr>
			<?php // echo $act; ?>
            <tr>
                <td>Derajat</td>
                <td><b>
                        <select name="derajat" tabindex="4" required class="form-control" id="derajat"
                                style="width: 200px" <?php echo ($idp != "") ? "disabled" : ""; ?> >
                                <option value="" style="display: block;">- Pilih Derajat -</option>
                            <?php 
						$klasifikasi_option = $this->db->query("SELECT * FROM notadinas.master_derajat")->result();
						foreach ($klasifikasi_option as $key => $js) { 
						if((isset($datpil->drajat) and $datpil->drajat == $js->derajat) && $act != "act_add"){
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
			
			
			<?php if($mode == "add"){ ?>
			 <tr>
                <td>Tugas</td><!--ubah mei bahasa-->
                <td>
                    <!-- <select name="tknya" style="width: 400px;" class="form-control" id="tknya">
                        <option value="0" style="display: none;">- Pilih Tugas -</option>
                        <?php 
                        if(isset($datpil->id_taks)){
                            foreach ($query4 as $a) {
                                $query6 = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id_taks = '".$a->id_task."'")->result();//ubah disposisi mei
                                if(empty($query6)){
                                    if($datpil->id_taks == $a->id_task){
                                        echo "<option value='".$a->id_task."' selected>".$a->nama_task."</option>";
                                    }else{
                                        echo "<option value='".$a->id_task."'>".$a->nama_task."</option>";
                                    }
                                }else{
                                }
                            }
                        }
                        ?> 
                    </select>-->
                    <div class="ui-widget col-md-8" style="padding:0px !important; font-size: 14px;">
							<div id="listtugas">
                            <select id="tknya" name="tknya" class="form-control ajaxTugas" style="width: 400px">
                                <option value="0" style="display: none;">- Pilih Tugas -</option><!--ubah mei bahasa-->
                                <?php 
                                    if(isset($datpil->id_taks)){
                                        foreach ($query4 as $a) {
                                            $query6 = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id_taks = '".$a->id_task."'")->result();//ubah disposisi mei
                                            if(empty($query6)){
                                                if($datpil->id_taks == $a->id_task){
                                                    echo "<option value='".$a->id_task."' selected>".$a->nama_task."</option>";
                                                }else{
                                                    echo "<option value='".$a->id_task."'>".$a->nama_task."</option>";
                                                }
                                            }else{
                                            }
                                        }
                                    }
                                    ?>
                            </select>
							</div>
                        </div>
                </td>
                <td>
                    <a data-toggle="modal" data-target="#ModalTugas"
                                                                  class="btn btn-default btn-sm"
                                                                  title="Tambah Tugas"><span
                                    class="icon icon-plus icon-white"></span></a>
                </td>
            </tr>
			<?php } ?>
           <?php if($mode != "add"){//ubah surat masuk mei
            if($this->session->userdata('admin_jabatan') == $datpil->kepada){ 
            ?>
            <!-- <tr>
                <td></td>
                <td><b>ARSIP SURAT FISIK</b></td>
            </tr>

             <tr>
                <td>Ruang</td>
                <td>
                    <select class="form-control ruang" name="ruang" style="width: 200px">
                        <option value="">PILIH RUANG</option>
                        <?php foreach ($ruang as $res) { ?>
                            <option <?php if($ruangs == $res->id_ruang)echo "selected"; ?> value="<?= $res->id_ruang?>"><?= $res->nama_ruang ?></option>    
                        <?php } ?>
                    </select>
                </td>
            </tr>

             <tr>
                <td>Rak</td>
                <td>
                    <select class="form-control rak" name="rak" style="width: 200px">
                       <option value="">PILIH RAK</option>
                        <?php foreach ($rak as $res) { ?>
                            <option <?php if($raks == $res->id_rak)echo "selected"; ?> value="<?= $res->id_rak?>"><?= $res->nama_rak ?></option>    
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Box</td>
                <td>
                    <select class="form-control box" name="box" style="width: 200px">
                        <option value="">PILIH BOX</option>
                         <?php foreach ($box as $res) { ?>
                            <option <?php if($boxs == $res->id_box)echo "selected"; ?> value="<?= $res->id_box?>"><?= $res->nama_box ?></option>    
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Baris</td>
                <td>
                   <input type="text" class="form-control" value="<?= $bariss ?>" style="width: 200px" name="baris">
                </td>
            </tr>
 -->            <!-- workspace dan taks -->
<!--ubah surat masuk mei-->
            <tr>
                <td></td>
                <td><b>Tugas Terkait Surat</b></td><!--ubah mei bahasa-->
            </tr>

            <?php if($datpil->id_taks == 0){ ?>

             <tr>
                <td>Tugas</td><!--ubah mei bahasa-->
                <td>
                    <!-- <select name="tknya" style="width: 400px;" class="form-control" id="tknya">
                        <option value="0" style="display: none;">- Pilih Tugas -</option>
                        <?php 
                        if(isset($datpil->id_taks)){
                            foreach ($query4 as $a) {
                                $query6 = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id_taks = '".$a->id_task."'")->result();//ubah disposisi mei
                                if(empty($query6)){
                                    if($datpil->id_taks == $a->id_task){
                                        echo "<option value='".$a->id_task."' selected>".$a->nama_task."</option>";
                                    }else{
                                        echo "<option value='".$a->id_task."'>".$a->nama_task."</option>";
                                    }
                                }else{
                                }
                            }
                        }
                        ?> 
                    </select>-->
                    <div class="ui-widget col-md-8" style="padding:0px !important; font-size: 14px;">
                            <select id="tknya" name="tknya" class="form-control ajaxTugas" style="width: 400px">
                                <option value="0" style="display: none;">- Pilih Tugas -</option><!--ubah mei bahasa-->
                                <?php 
                                    if(isset($datpil->id_taks)){
                                        foreach ($query4 as $a) {
                                            $query6 = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id_taks = '".$a->id_task."'")->result();//ubah disposisi mei
                                            if(empty($query6)){
                                                if($datpil->id_taks == $a->id_task){
                                                    echo "<option value='".$a->id_task."' selected>".$a->nama_task."</option>";
                                                }else{
                                                    echo "<option value='".$a->id_task."'>".$a->nama_task."</option>";
                                                }
                                            }else{
                                            }
                                        }
                                    }
                                    ?>
                            </select>
                        </div>
                </td>
                <td>
                    <a data-toggle="modal" data-target="#ModalTugas"
                                                                  class="btn btn-default btn-sm"
                                                                  title="Tambah Tugas"><span
                                    class="icon icon-plus icon-white"></span></a>
                </td>
            </tr>
            <?php }else{ ?>
            <tr>
                <td>Tugas</td><!--ubah mei bahasa-->
                <td>
                    <div class="ui-widget col-md-8" style="padding:0px !important; font-size: 14px;">
                            <select id="tknya" name="tknya" class="form-control ajaxTugas" style="width: 400px" disabled>
                                <!-- <option value="" style="display: none;">- Pilih Asal Surat -</option> -->
                                <?php 
                                if(isset($datpil->id_taks)){
                                    foreach ($query4 as $a) {
                                        // $query6 = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id_taks = '".$a->id_task."'")->result();//ubah disposisi mei
                                        // if(empty($query6)){
                                            if($datpil->id_taks == $a->id_task){
                                                echo "<option value='".$a->id_task."' selected>".$a->nama_task."</option>";
                                            }else{
                                                echo "<option value='".$a->id_task."'>".$a->nama_task."</option>";
                                            }
                                        // }else{
                                        // }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                </td>
            </tr>
            <?php } ?>
            <?php }else{ if($datpil->id_taks != 0){ ?><!--ubah surat masuk mei-->
            <tr>
                <td></td>
                <td><b>Tugas Terkait Surat</b></td><!--ubah mei bahasa-->
            </tr>

             <tr>
                <td>Tugas</td><!--ubah mei bahasa-->
                <td>
                    <div class="ui-widget col-md-8" style="padding:0px !important; font-size: 14px;">
                            <select id="tknya" name="tknya" class="form-control ajaxTugas" style="width: 400px" disabled>
                                <!-- <option value="" style="display: none;">- Pilih Asal Surat -</option> -->
                                <?php 
                                if(isset($datpil->id_taks)){
                                    foreach ($query4 as $a) {
                                        // $query6 = $this->db->query("SELECT * FROM notadinas.surat_masuk WHERE id_taks = '".$a->id_task."'")->result();//ubah disposisi mei
                                        // if(empty($query6)){
                                            if($datpil->id_taks == $a->id_task){
                                                echo "<option value='".$a->id_task."' selected>".$a->nama_task."</option>";
                                            }else{
                                                echo "<option value='".$a->id_task."'>".$a->nama_task."</option>";
                                            }
                                        // }else{
                                        // }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                </td>
            </tr>
        <?php }else{

        }}} ?><!--ubah surat masuk mei-->
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
    <div class="modal fade" id="ModalTugas" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Tugas</h4>
                    <br/>
					<div id="clnya">
					<center><font color="red">Pilih Terlebih Dahulu Field Jenis Surat !</font></center>
					</div>
					<?php 
					/*
                    <select name="nama_rknya" id="nama_rknya" class="form-control" width="80%">
                    <option value="0">-- Pilih Ruang Kerja --</option>  
                    <?php if(isset($query12)){ foreach ($query12 as $key){                         
                    ?>
                    <option value="<?php echo $key->id_ruang_kerja ?>"><?php echo $key->nama_krj ?></option>
                    <?php }} ?>
                    </select>
					*/
					?>
                    <br/>
                    <input type="text" name="nama_tambah_tugas" class="form-control" id="nama_tambah_tugas" width="80%"/>
                    <br/>
                    <a href="#" class="btn btn-default btn-sm" id="button_tambah_tugas">Simpan</a>
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
                    console.log(result);
                    $(".custom-combobox-input").val($("#nama_tambah_tujuan").val());
                }, error: function () {
                    alert("Nama tujuan sudah tersedia");
                }
            });
            $("#myModal123").modal("hide");
        });
        $("#button_tambah_tugas").click(function () {
            $("#loadingModal").modal("show");
            var rkrj = $("#nama_rknya").val();
            var nmtg = $("#nama_tambah_tugas").val();
			var w = $("#jenis_surat").val();
            // alert(rkrj);
            // alert(nmtg);
            $.ajax({
                method: 'get',
                url: "<?php echo base_URL()?>admin/surat_masuk/tambah_tugas?q=" + nmtg + "&r=" + rkrj + "&w=" + w,
                data: {}, success: function (result) {
                    $("#tknya").html(result);
                    // console.log(result);
                   // $(".custom-combobox-input").val($("#nama_tambah_tugas").val());
                    $("#loadingModal").modal("hide");
                }, error: function () {
                    $("#loadingModal").modal("hide");
                    alert("Nama tugas sudah tersedia");
                    document.getElementById("nama_rknya").value = "0";
                    document.getElementById("nama_tambah_tugas").value = "";
                    // $("#nama_rknya").value = "";
                    // $("#nama_tambah_tugas").value = "0";
                }
            });
            $("#ModalTugas").modal("hide");
        });
    </script>
    <div class="col-lg-6">
        <table class="table-table">
            <tr>
                <td width="20%">Asal Surat</td>
                <td>
                    <?php if ($mode == "add" or $mode == "edt") { ?>
                        <div class="ui-widget col-md-8" style="padding:0px !important; font-size: 14px;">
                            <select id="combobox" name="instansi" class="form-control" style="width: 200px" <?php echo ($idp != "") ? "disabled" : ""; ?>>
                                <option value="" style="display: none;">- Pilih Asal Surat -</option>
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
                    <?php } else { ?>
                        <select id="" name="instansi" id="instansi" class="form-control"
                                style="width: 200px" <?php echo ($idp != "") ? "disabled" : ""; ?>>
                                <option value="" style="display: none;">- Pilih Asal Surat -</option>
                            <?php foreach ($tujuan as $a) {
                                // $datpil->create_by==$this->session->userdata('admin_id')
                                if ($instansi == $a->id) {
                                    echo "<option value='$a->id' selected>$a->nama</option>";
                                } else {
                                    echo "<option value='$a->id'>$a->nama</option>";
                                }
                            } ?>
                        </select>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td width="20%">Nomor Surat</td>
                <td><b><input type="text" id="no_surat" name="no_surat" tabindex="6" required style="width: 200px"
                              class="form-control" value="<?php echo $no_surat; ?>" <?php echo ($idp != "") ? "disabled" : ""; ?>>
                              <span class="label label-danger" id="warning_nosu" style="display: none">* No surat sudah ada!</span></td><!--ubah surat masuk mei-->
            </tr>
            <tr>
                <td>Barcode</td>
                <td><img class="barsc-img" src="<?= base_url().'barcode/index/'.str_replace('/', '-', $no_surat) ?>" alt="" > </td>
               
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
                              class="form-control" <?php echo ($idp != "") ? "disabled" : ""; ?>></b></td>
            </tr>
            <tr>
                <td width="20%">Perihal</td>
                <td><b><input type="text" name="perihal" tabindex="8" required class="form-control" placeholder="Perihal" style="width: 400px"
                              value="<?php echo $perihal; ?>" <?php echo ($idp != "") ? "disabled" : ""; ?>></b></td>
            </tr>

            <tr>
                <td width="20%">
                <?php if($act == "kadisp"){ echo "Diterima Dari";}else{echo " Diteruskan Kepada";} ?>
               

                </td>
                <td><b>
                        <select name="kepada" tabindex="9" required class="form-control" id="derajat"
                                style="width: 200px" <?php echo ($idp != "") ? "disabled" : ""; ?> >
                                <option value="" style="display: none;">- Pilih -</option>
							<?php
								foreach($diteruskan_kepada as $dk){
									$dk_selected = "";
									if(isset($kepada) and $kepada!="" and $kepada==$dk->id){
										$dk_selected = "selected";
									}
									echo "<option value='$dk->id' $dk_selected>$dk->nama_jabatan</option>";
								}
							?>
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
                    <?php if ($act != "view" && $act != "kadisp" && $act != "subdisp"){ ?>
                    <b><input id="file_attachment_id" type="file" name="file_attachment" tabindex="11" class="form-control"
                              style="width: 200px"></b>File lama:<a
                            href="<?= (isset($file_attachment)) ? base_URL() . 'upload/surat_masuk/' . $file_attachment : "#"; ?>"
                            target='_blank'><?= (isset($file_attachment)) ? $file_attachment : ""; ?></a>
                <tr>
                <td></td>
                <td><a class="btn btn-default btn-sm" id="generate_no">Tampilkan Nomor Lampiran</a> 
                    <a href="" target="_blank" id="cetak_no_lampiran" class="btn btn-default btn-sm">Cetak Nomor</a></td>
            </tr>
            <tr>
                <td></td>
                <td><input readonly type='text' tabindex='2' name='no_lampiran' id='no_lampiran' style='' class='form-control'>
                </td>
            </tr>
            <?php }else{ ?>
             <i><a href="<?= (isset($file_attachment)) ? base_URL() . 'upload/surat_masuk/' . $file_attachment : "#"; ?>" target="_blank"><?= (isset($file_attachment)) ? $file_attachment : ""; ?></a></i>
            <?php } ?>
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
					var replace = $("input[name='no_setum']").val().replace(".", "") + "_001";//ubah mei surmas8
					$("#no_lampiran").attr("value", replace);
					$("#cetak_no_lampiran").attr("href", "<?php echo base_URL(); ?>admin/cetak_no_lampiran_sm/" + $("input[name='no_lampiran']").val());//ubah mei surmas8
                });

                /*
                ||  Ajax validasi ID berdasarkan database
                ||  Putri Dewi Punamasari
                */

                //START
                //Deklarasi fungsi delay agar callback ditunda selama sekian miliseconds
                var delay = (function(){
                  var timer = 0;
                  return function(callback, ms){
                    clearTimeout (timer);
                    timer = setTimeout(callback, ms);
                  };
                })();

                //Trigger keyup untuk id no_surat
                // $(document).on('keyup', '#no_surat', function() {
                   // delay(function(){
                    // var id = $('#no_surat').val();
                    // var idp = <?php echo ($idp != "") ? $idp : "0"; ?>;
                      // $.ajax({
                        // method: 'post',
                        // data: {id:id,id_surat:idp,table:'surat_masuk'},
                        // url:"<?php echo base_url(); ?>admin/validasi_id",
                        // success: function(data) {

                            // if(data>0){
                                // $('#warning_nosu').css('display','block');
                            // }else{
                                // $('#warning_nosu').css('display','none');
                            // }
                        // },
                        // error: function(error){
                            // console.log(error);
                        // }

                        // });
                    // }, 1000 );
                // });
                
                //Ketika webpage diload, langsung melakukan pengecekan
                  $(window).load(function(){
                    $('#no_surat').keyup();
                 }); 

                //END
            </script>
            <?php if ($act == "act_add" || $act == "act_edt") { ?>
                <tr>
                    <td colspan="2">
                        <br>

                        <?php if($act != "act_edt"){ ?>
                        <!--<button type="submit" class="btn btn-primary" tabindex="12"><i
                                    class="icon icon-ok icon-white"></i> Simpan 
                        </button>-->
						<a href="#" class="btn btn-primary" tabindex="13" id="simpat"><i
                                    class="icon icon-ok icon-white"></i> Simpan</a>
						<script>
							$('#simpat').click(function(){
								var perihal = validate($("input[name='perihal']").val());

                                if($("select[name='jenis_surat']").val()==""){
									alert("Pilih jenis surat dulu.");
								}else{
    								if($("input[name='perihal']").val()==""){
    									alert("Harap isi perihal");
    								}else if ($('select[name="kepada"]').val()=="" || $('select[name="kepada"]').val()=="- Pilih -") {
                                    alert("Pilih kepada siapa surat ini diteruskan.");
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
                                }
							});
						</script>
                        <?php } ?>

                        <a href="<?php echo base_URL(); ?>admin/surat_masuk" class="btn btn-success" tabindex="13"><i
                                    class="icon icon-arrow-left icon-white"></i> Kembali</a>
                    </td>
                </tr>
            <?php } else if ($act == "viewonly") { ?>
                <tr>
                    <td colspan="2">
                        <br>
                        <a href="<?php echo base_URL(); ?>admin/surat_masuk" class="btn btn-success" tabindex="13"><i
                                    class="icon icon-arrow-left icon-white"></i> Kembali</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

</div>

<?php 
$checkSelectedJabatan = [];
$checkJabatan = NULL;
if($mode!="add"){
	$checkJabatan = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = $kepada")->row();
}
                           
if ($this->session->userdata('admin_jabatan') == "28" && $act == "view" || $this->session->userdata('admin_jabatan') == "1" && $act == "view" || $this->session->userdata('admin_tingkatan') == "1" && $act != "act_add" && $act != "act_edt" || $act == "kadisp" || $act == "subdisp") { ?>

    <div class="row-fluid well" style="overflow: hidden">
        <div class="navbar navbar-inverse">
            <div class="container z0">
                <div class="navbar-header">
                    <span class="navbar-brand" href="#">Disposisi Pushidrosal</span>
                </div>
            </div><!-- /.container -->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-12">
                   <div class="row">
                    <div class="col-md-12" style="border: 1px solid #333;">
                        <center><h4>ALAMAT AKSI</h4></center>
                    </div>

                       <div class="col-md-12">
                          <br>
                          A &nbsp; I
                       </div>


                       <?php
                           $no = 2;
						   foreach ($jabatan as $key => $c) {
                            if($c->id != 0 && $c->id != 1){//ubah mei surmas2
                            
                            $checked = "";
                            $checkeds = "";
							
							$checkTingkatan = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = $c->id")->row()->tingkatan;
							
							$_zCol = "penerima_disposisi";
							if($checkTingkatan==2){
								$_zCol = "penerima_disposisi_satuan";								
							}

                            $keysp = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = '.$idp.' AND '.$_zCol.' ='.$c->id)->result();

                            // $penerima = array();
                            $aks = array();
                            foreach ($keysp as $key => $vs) {
                                $penerima = $vs->penerima_disposisi;
								if($checkTingkatan==2){
									$penerima = $vs->penerima_disposisi_satuan;									
								}
                                $aks = $vs->jenis; 

                                 if($penerima == $c->id){
                                        if($aks == 'AKSI'){
                                          $checked = "checked";
                                        }

                                        if($aks == 'INFORMASI'){
                                          $checkeds = "checked";
                                        }
										$checkSelectedJabatan[$penerima] = $checkTingkatan;
                                    }

                            }
						   $checkJabatanZ = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE id = $c->id")->row();
							if(($checkJabatanZ->tingkatan==2 and $checkJabatanZ->tingkatan != $checkJabatan->tingkatan) and $checkJabatan->id!=1 and $checkJabatan->id!=28){
								$checked = "";
								$checkeds = "";
							}

                              
                            ?>
                          <div class="col-md-3">
                          <div class="row">
                          <div class="col-md-1">
                               <div class="checkbox"><!-- ubah mei surmas11 -->
                                  <label>
									<?php if($c->id!=28){ ?>
										<input class="checkedCheckbox" <?= $checked ?>  type="checkbox" jabatan="<?= $c->id ?>" value="AKSI" <?php if($act == "kadisp" || $act == "subdisp") echo "disabled"; ?> id="tsf<?= $c->id ?>" name="tsf<?= $c->id ?>"><!-- ubah mei surmas11 -->
									<?php } else {?>
										<input class="checkedCheckbox" <?= $checked ?>  type="checkbox" jabatan="<?= $c->id ?>" value="AKSI" <?php if($act == "kadisp" || $act == "subdisp") echo "disabled"; ?> name="tsf<?= $c->id ?>"><!-- ubah mei surmas11 -->
									<?php } ?>
                                  </label>
                              </div>
                          </div>
                          <div class="col-md-10">
                             <div class="row">
                               <div class="checkbox" style="width: 70%;"><!-- ubah mei surmas11 -->
                                <label>
                                <input class="checkedCheckbox" <?= $checkeds ?>  type="checkbox" jabatan="<?= $c->id ?>" value="INFORMASI" <?php if($act == "kadisp" || $act == "subdisp") echo "disabled"; ?> name="tsf<?= $c->id ?>"><!-- ubah mei surmas11 -->
								<?= $c->nama_jabatan ?></label>
                                </div>
                              </div>
                          </div>
                          </div>
                       </div>
                     <?php $no++; }} ?>
                     
                   </div>
				<div class="col-md-12">
					<table>
						<tr>
							<td>A</td>
							<td>: AKSI</td>
						</tr>
						<tr>
							<td>I</td>
							<td>: INFORMASI</td>
						</tr>
					</table>
                </div>
                </div>
                <div class="col-md-12">
                    <br><br>
                    <div class="row">
                    <div class="col-md-12" style="border: 1px solid #333;">
                        <center><h4>AKSI</h4></center>
                    </div>

                    <?php
                    $n = 1;
                    foreach ($aksi as $c){

                        $checkedzx = "";
                        $param = "";
                        $table_aksi = $this->db->query('SELECT * FROM notadinas.aksi_disposisi_surat_masuk WHERE id_disposisi_surat_masuk = '.$idp)->result();

                        foreach ($table_aksi as $key => $svs) {
                            $param = $svs->id_aksi;

                            if($param == $c->id){
                                $checkedzx = "checked";
                            }

                        }


                       
                    ?>


                    <div class="col-md-3">
                        <div class="checkbox">
                          <label><input <?= $checkedzx ?> acs="<?= $c->nama_aksi ?>" name="aks<?= $n ?>" <?php if($act == "kadisp" || $act == "subdisp") echo "disabled"; ?> type="checkbox" value="<?= $c->id ?>"  ><?= $c->nama_aksi ?></label>
                        </div>
                        <!-- <?= $param ?> -->
                    </div>
                    <?php $n++; } ?>
                    </div>
                </div>
               
            </div>
        </div>
        <!-- <a class="btn btn-default" style="float: right" onclick="reset()" <?php if($act=="kadisp") echo "disabled"; ?> >Clear</a>
                     <script type="text/javascript">
                         function reset(){
                            window.location.reload();
                         }
                     </script> -->
        <div class="row">
            <div class="col-lg-12">
                <h3>DISPOSISI / KETERANGAN</h3>
                <?php 
                    $ket = "";
                    $kets = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = '".$idp."' AND penerima_disposisi_satuan IS NULL")->result_array();

                    if(isset($kets[0]['keterangan'])){
                        $ket = $kets[0]['keterangan'];
                    }

                 ?>
                <b><textarea <?php if($act == "kadisp" || $act == "subdisp") echo "disabled"; ?> name="disket" id="disket" tabindex="10" style="width: 100%;height: 150px"
                             class="form-control"><?= $ket ?></textarea></b>
            </div>
        </div>
        <br>

        <div class="row"><!-- ubah mei surmas11 -->
            <div class="col-md-12 text-right">
        <?php if($act != "kadisp" && $act != "subdisp"){
			if($datpil->status_surat_masuk==4 and ($this->session->userdata('admin_jabatan')==1 or $this->session->userdata('admin_jabatan')==28)){ ?>
                <td colspan="4"><a href="<?php echo base_URL(); ?>admin/surat_masuk" class="btn btn-success" tabindex="13"><i
                                    class="icon icon-arrow-left icon-white"></i> Kembali</a></td>
        <?php 				
			}elseif($kondisp==0){ ?><!-- ubah mei surmas11 -->
                <td class="text-center" colspan="2"><a href="<?= base_url(); ?>admin/surat_masuk" class="btn btn-primary btn-sm" tabindex="4" id="batal"><i
                                class="icon icon-remove icon-white"></i> BATAL</a></td>
                <td class="text-center" colspan="2"><a class="btn btn-info btn-sm" tabindex="4" id="disposisikan"><i
                                class="icon icon-ok icon-white"></i> DISPOSISI</a></td>
     
        <?php }else{ ?>
                <td colspan="4"><a href="<?php echo base_URL(); ?>admin/surat_masuk" class="btn btn-success" tabindex="13"><i
                                    class="icon icon-arrow-left icon-white"></i> Kembali</a></td>
        <?php }} ?>
            </div>
        </div><!-- ubah mei surmas11 -->

        <div class="modal fade" id="loadingModal" role="dialog"><!-- ubah mei surmas7 -->
        <div class="modal-dialog">
            <!-- Modal content-->
            <!-- <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Tujuan</h4>
                    <br/>
                    <input type="text" name="nama_tambah_tujuan" class="form-control" id="nama_tambah_tujuan"/>
                    <br/>
                    <a href="#" class="btn btn-default btn-sm" id="button_tambah_tujuan">Simpan</a>
                </div>
            </div> -->
            <center><img src="<?php echo base_url(); ?>aset/img/loading.gif" width="50px" style="margin-top: 45%;"></center>
        </div>
    </div>

    </div>

  
    <?php if($act != "subdisp" or $checkJabatan->tingkatan==2){ ?>
     <div class="row-fluid well" style="overflow: hidden">
        <div class="navbar navbar-inverse">
            <div class="container z0">
                <div class="navbar-header">
                    <span class="navbar-brand" href="#">FEEDBACK</span>
                </div>
            </div><!-- /.container -->
        </div>

        <div class="row">
             <div class="col-lg-12">
                <div class="col-md-12" style="border: 1px solid #ccc; background-color: #fff; max-height: 250px; overflow-y: scroll;">
                    <div class="col-md-12 pesan" style="margin: 15px;">
                        <div class="row">
                        <div class="media">

                            <?php $chat = $this->db->query('SELECT  a.pengirim, a.penerima, a.pesan_feedback, a.created_at, a.waktu, b.id, b.nama_jabatan from notadinas.feedback_surat_masuk a, notadinas.master_jabatan b where a.pengirim = b.id AND id_surat_masuk ='.$idp.' ORDER BY a.id_feedback')->result(); 

                                foreach ($chat as $key => $res) {
                                 
                            ?>

                         
                          <div class="media-body">

                            <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
                            <div class="col-md-12">
                            <div class="row">
                            <div class="col-md-6">
                                <?php if($res->penerima == $this->session->userdata('admin_jabatan')){ ?>
                                <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
                                <p class="media-heading"><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span class="pull-right"><?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></span> </p> 
                                <?php } ?>
                                <p class="pull-left" style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background: #FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?> <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){ ?> <sub style="color: #555";>&nbsp; <?= date('H:i',strtotime($res->waktu)) ?></sub> <?php } ?></p>
                            <?php } ?>
                            </div>
                            </div>

                            </div>

                            <?php }else{ ?>

                            <div class="col-md-12">
                            <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-5">
                                <?php if($res->penerima == $this->session->userdata('admin_jabatan')){ ?>
                                <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>

                                <p><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span class="pull-right"><?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></span></p> 

                                <?php } ?>
                                <p class="pull-right" style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background:#FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?>  <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){ ?> <sub style="color: #555";>&nbsp; <?= date('H:i',strtotime($res->waktu)) ?></sub> <?php } ?></p>
                            <?php } ?>
                            </div>
                            </div>

                            </div>

                            <?php } ?>

                          </div>
                          
                             
                           
                           

                            <?php } ?>
                        </div>
                    </div>
                    </div>

                </div>   

                <div class="col-md-12">
                    <br>
                    <div class="row">
                    <form>
                        <textarea class="form-control" id="pesan_feedback" style="background-color:rgba(70, 227, 242, 0.1);" name="pesan_feedback"></textarea>
                        <br>
                       <center> <button type="button" id="feedback" class="btn btn-info">KIRIM</button></center>
                    </form>
                    </div>
                </div>     
             </div>
        </div>
     </div>
 <?php }
 if($checkJabatan!=NULL){
	$dispCol = "penerima_disposisi";
	if($checkJabatan->tingkatan==2){
		$dispCol = "penerima_disposisi_satuan";								
	}
	$checkDisp = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = $idp AND $dispCol = " . $this->session->userdata('admin_jabatan'))->row();
 }
	if(
		($act != "kadisp" && $act != "subdisp")
		or ($checkJabatan!=NULL and $checkJabatan->tingkatan==2)
		or ($checkJabatan!=NULL and $checkDisp!=NULL and $checkDisp->jenis=='INFORMASI')
		or (
			$checkJabatan!=NULL
			and $checkJabatan->id!=1
			and $checkJabatan->id!=28
			and $checkJabatan->id!=$this->session->userdata('admin_jabatan')
			)
		or (
			$this->session->userdata('admin_tingkatan')==2
			and (
				$this->session->userdata('admin_jabatan')==174
				or $this->session->userdata('admin_jabatan')==84
				or $this->session->userdata('admin_jabatan')==162
				)
			and !isset($checkSelectedJabatan[$this->session->userdata('admin_tingkatan')])
			)
	){ ?>
        <?php // }else if(isset($InfoOrAksi) and $InfoOrAksi->jenis=="INFORMASI"){ ?>
      <!-- <a class="btn btn-success btn-sm" tabindex="4" id="disposisikan_satuan">Kembali</a> -->
        <?php }  else { ?><!--ubah surat masuk mei-->
      <div class="row-fluid well" style="overflow: hidden">
        <div class="navbar navbar-inverse">
            <div class="container z0">
                <div class="navbar-header">
                    <span class="navbar-brand" href="#">KASUBDIS</span>
                </div>
            </div><!-- /.container -->
        </div>
                <?php 
                $jbt = $this->db->query("SELECT subdis FROM notadinas.master_jabatan WHERE id = '".$this->session->userdata('admin_jabatan')."'")->row();
                    if($jbt->subdis==null){
                        $jatas = $this->db->query("SELECT * FROM notadinas.master_subjabatan WHERE id_jabatan = '".$this->session->userdata('admin_jabatan')."' ORDER BY urut_subjabatan ASC")->result();
                        if(!empty($jatas)){
                            foreach($jatas as $isi){
                                $jt = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE subdis = '".$isi->id_subjabatan."'")->row();
                                // var_dump($jt->id);
								if(isset($jt->id) and $jt->id!=null){
									$kets = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = ".$idp." AND penerima_disposisi_satuan = '".$jt->id."'")->result();
									if(!empty($kets)){
										foreach ($kets as $key) {
											if($key->keterangan){
												$dtada = $key->keterangan;
											}
										}
									}
								}
                            }
                        }
                    }else{
                        $kets = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = ".$idp." AND penerima_disposisi_satuan = '".$this->session->userdata('admin_jabatan')."'")->result_array();
                        // var_dump($kets);
                        if(isset($kets[0]['keterangan'])){
                            $dtada = $kets[0]['keterangan'];
                        }
                    }
                ?>
                 <div class="col-md-12" style="border: 1px solid #333;">
                        <center><h4>ALAMAT AKSI</h4></center>
                 </div>

                   <div class="col-md-12">
                          <br>
                          A &nbsp; I
                       </div>
                       
                 <div class="col-md-12">
                 <div class="row">
                <?php
                 $y = 1;
                 foreach ($datasatuan as $sat) { 

                            $checked = "";
                            $checkeds = "";
                             // $keyis = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = '.$idp)->result();
                            $keysp = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = '.$idp.' AND penerima_disposisi_satuan = '.$sat->id)->result();

                            $penerima = array();
                            $aks = array();
                            foreach ($keysp as $key => $vs) {
                                $penerima = $vs->penerima_disposisi_satuan;
                                $aks = $vs->jenis; 

                                 if($penerima == $sat->id){
                                        if($aks == 'AKSI'){
                                          $checked = "checked";
                                        }

                                        if($aks == 'INFORMASI'){
                                          $checkeds = "checked";
                                        }
                                    }

                            }



                ?>
                    
                    <div class="col-md-3">
                          <div class="row">
                          <div class="col-md-1">
                               <div class="checkbox"><!-- ubah mei surmas11 -->
                                  <label>
                                    <input class="checkedCheckbox" <?= $checked ?> <?php if($act == "subdisp" || !empty($dtada)) echo "disabled"; ?>  type="checkbox" satuan="<?= $sat->id ?>" value="AKSI"  id="" name="satuan<?= $y ?>"><!-- ubah mei surmas11 -->
                                  </label>
                              </div>
                        
                          </div>
                          <div class="col-md-10">
                             <div class="row">
                               <div class="checkbox" style="width: 70%;"><!-- ubah mei surmas11 -->
                                <label>
                                  <input class="checkedCheckbox" <?= $checkeds ?>  <?php if($act == "subdisp"  || !empty($dtada)) echo "disabled"; ?> type="checkbox" satuan="<?= $sat->id ?>" value="INFORMASI"  id="" name="satuan<?= $y ?>"><?= $sat->nama_jabatan ?></label><!-- ubah mei surmas11 -->
                                </div>
                              </div>
                          </div>
                          </div>
                    </div>
                <?php $y++; } ?>

                </div>
                </div>

				<div class="col-md-12">
					<table>
						<tr>
							<td>A</td>
							<td>: AKSI</td>
						</tr>
						<tr>
							<td>I</td>
							<td>: INFORMASI</td>
						</tr>
					</table>
                </div>
                <div class="col-md-12">
                     <br><br>
                    <div class="row">
                    <div class="col-md-12" style="border: 1px solid #333;">
                        <center><h4>AKSI</h4></center>
                    </div>

                    <?php
                    $n = 1;
                    // var_dump($tbl_aksi);
                    foreach ($aksi as $c){

                        $checkedzx = "";
                        $param = array();
                        $table_aksi = $this->db->query('SELECT * FROM notadinas.aksi_disposisi_surat_masuk_satuan WHERE id_surat_masuk = '.$idp)->result();
                        foreach ($table_aksi as $key => $svs) {
                            $param = $svs->id_aksi;
                            $tbl_aksi = $this->db->query('SELECT * FROM notadinas.aksi_disposisi_surat_masuk_satuan WHERE id_surat_masuk = '.$idp.' AND id_aksi = '.$param)->row();//ubah mei surmas9
                            // var_dump($tbl_aksi);
                            if($param == $c->id && $tbl_aksi!=null){//ubah mei surmas9
                                $checkedzx = "checked";
                            }

                        }


                       
                    ?>


                    <div class="col-md-3">
                        <div class="checkbox">
                          <label><input <?= $checkedzx ?> <?php if($act == "subdisp" || !empty($dtada)) echo "disabled"; ?>  acs2="<?= $c->nama_aksi ?>" name="aks2<?= $n ?>"  type="checkbox" value="<?= $c->id ?>"  ><?= $c->nama_aksi ?></label>
                        </div>
                        <!-- <?= $param ?> -->
                    </div>
                    <?php $n++; } ?>
                    </div>
                </div>
                
                <div class="row">
                <!-- <div class="col-lg-12">
                <h3>DISPOSISI / KETERANGAN</h3>
              
                <b><textarea name="disket" id="disket_satuan" tabindex="10" style="width: 100%;height: 150px"
                             class="form-control"></textarea></b>
                </div> -->
                <div class="col-lg-12">
                <h3>DISPOSISI / KETERANGAN</h3>
                <?php 
                    $ket = "";
                    $jbt = $this->db->query("SELECT subdis FROM notadinas.master_jabatan WHERE id = '".$this->session->userdata('admin_jabatan')."'")->row();
                    if($jbt->subdis==null){
                        $jatas = $this->db->query("SELECT * FROM notadinas.master_subjabatan WHERE id_jabatan = '".$this->session->userdata('admin_jabatan')."' ORDER BY urut_subjabatan ASC")->result();
                        if(!empty($jatas)){
                            foreach($jatas as $isi){
                                $jt = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE subdis = '".$isi->id_subjabatan."'")->row();
                                // var_dump($jt->id);
								if(isset($jt->id) and $jt->id!=null){
									$kets = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = ".$idp." AND penerima_disposisi_satuan = '".$jt->id."'")->result();
									if(!empty($kets)){
										foreach ($kets as $key) {
											if($key->keterangan){
												$ket = $key->keterangan;
											}
										}
									}
								}
                            }
                        }
                    }else{
                        $kets = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = ".$idp." AND penerima_disposisi_satuan = '".$this->session->userdata('admin_jabatan')."'")->result_array();
                        // var_dump($kets);
                        if(isset($kets[0]['keterangan'])){
                            $ket = $kets[0]['keterangan'];
                        }
                    }

                 ?>
                <b><textarea <?php if($act == "subdisp" || !empty($ket)) echo "disabled"; ?> name="disket" id="disket_satuan" tabindex="10" style="width: 100%;height: 150px"
                             class="form-control"><?= $ket ?></textarea></b>
            </div>
                </div>

                 <div class="row">
                    <br>
                    <div class="col-md-12 text-right">
					<?php if(isset($InfoOrAksi->jenis) and $InfoOrAksi->jenis=="AKSI" and $act != "subdisp" && empty($dtada)){ ?>
                        <td class="text-center" colspan="2"><a href="<?= base_url(); ?>admin/surat_masuk" class="btn btn-primary btn-sm" tabindex="4" id="batal"><i
                                        class="icon icon-remove icon-white"></i> BATAL</a></td>
                        <td class="text-center" colspan="2"><a class="btn btn-info btn-sm" tabindex="4" id="disposisikan_satuan"><i
                                        class="icon icon-ok icon-white"></i> DISPOSISI</a></td>
					<?php }else{ ?>
					<td colspan="4"><a href="<?php echo base_URL(); ?>admin/surat_masuk" class="btn btn-success" tabindex="13"><i
                                    class="icon icon-arrow-left icon-white"></i> Kembali</a></td>
					<?php } ?>
                    </div>
                </div>


      </div>
      <div class="row-fluid well" style="overflow: hidden">
        <div class="navbar navbar-inverse">
            <div class="container z0">
                <div class="navbar-header">
                    <span class="navbar-brand" href="#">FEEDBACK KASUBDIS</span>
                </div>
            </div><!-- /.container -->
        </div>

        <div class="row">
             <div class="col-lg-12">
                <div class="col-md-12" style="border: 1px solid #ccc; background-color: #fff; max-height: 250px; overflow-y: scroll;">
                    <div class="col-md-12 pesan" style="margin: 15px;">
                        <div class="row">
                        <div class="media2">

                            <?php $chat = $this->db->query('SELECT  a.pengirim, a.penerima, a.pesan_feedback, a.created_at, a.waktu, b.id, b.nama_jabatan from notadinas.feedback_surat_masuk_satuan a, notadinas.master_jabatan b where a.pengirim = b.id AND id_surat_masuk ='.$idp.' ORDER BY a.id_feedback')->result(); 

                                foreach ($chat as $key => $res) {
                                 
                            ?>

                         
                          <div class="media2-body">

                            <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
                            <div class="col-md-12">
                            <div class="row">
                            <div class="col-md-6">
                                <?php if($res->penerima == $this->session->userdata('admin_jabatan')){ ?>
                                <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
                                <p class="media2-heading"><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span class="pull-right"><?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></span> </p> 
                                <?php } ?>
                                <p class="pull-left" style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background: #FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?> <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){ ?> <sub style="color: #555";>&nbsp; <?= date('H:i',strtotime($res->waktu)) ?></sub> <?php } ?></p>
                            <?php } ?>
                            </div>
                            </div>

                            </div>

                            <?php }else{ ?>

                            <div class="col-md-12">
                            <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-5">
                                <?php if($res->penerima == $this->session->userdata('admin_jabatan')){ ?>
                                <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>

                                <p><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span class="pull-right"><?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></span></p> 

                                <?php } ?>
                                <p class="pull-right" style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background:#FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?>  <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){ ?> <sub style="color: #555";>&nbsp; <?= date('H:i',strtotime($res->waktu)) ?></sub> <?php } ?></p>
                            <?php } ?>
                            </div>
                            </div>

                            </div>

                            <?php } ?>

                          </div>
                          
                             
                           
                           

                            <?php } ?>
                        </div>
                    </div>
                    </div>

                </div>   

                <div class="col-md-12">
                    <br>
                    <div class="row">
                    <form>
                        <textarea class="form-control" id="pesan_feedback_kasubdis" style="background-color:rgba(70, 227, 242, 0.1);" name="pesan_feedback_kasubdis"></textarea>
                        <br>
                       <center> <button type="button" id="feedback_kasubdis" class="btn btn-info">KIRIM</button></center>
                    </form>
                    </div>
                </div>     
             </div>
        </div>
     </div>
      <?php } ?>
      <!-- end -->

<?php } ?>
<?php 
    $jbt = $this->db->query("SELECT subdis FROM notadinas.master_jabatan WHERE id = '".$this->session->userdata('admin_jabatan')."'")->row();
    if($jbt->subdis==null){
        $isact = "kadisp";
    }else{
        $isact = "subdisp";
    }
?>

</form>

<script type="text/javascript">
    $('#tgl_surat').datepicker({dateFormat: 'dd-mm-yy'}).val();
    $('#tgl_setum').datepicker({dateFormat: 'dd-mm-yy'}).val();
</script>

<script type="text/javascript">
      $('#disposisikan').click(function () {//ubah mei surmas10
        var taksnya = $('#tknya').val();//ubah mei surmas11
        if(taksnya==0){//ubah mei surmas11
            alert("Tugas Belum Terisi!");//ubah mei surmas11 // ubah mei error
        }else{//ubah mei surmas11
            $("#loadingModal").modal("show");//ubah mei surmas7
            var id = "<?php echo ($idp != '') ? $idp : '0'; ?>";

            var disket = $('#disket').val();

            <?php $n = 1; foreach ($aksi as $c) {?>
                var aks<?= $n ?> = $('input[name=aks<?= $n ?>]:checked').val();
                var nm_aks<?= $n ?> = $('input[name=aks<?= $n ?>]:checked').attr('acs');
            <?php $n++; } ?>
           
            <?php $i = 1; foreach ($jabatan as $key) {  ?>
            var act<?= $key->id ?> = $('input[name=tsf<?= $key->id ?>]:checked').val();
            var atr<?= $key->id ?> = $('input[name=tsf<?= $key->id ?>]:checked').attr('jabatan');
            <?php $i++; } ?>
            // var wrk = $('#rknya').val();//ubah surat masuk mei
            var tsk = $('#tknya').val();//ubah surat masuk mei
            
            var data = {no:id,tska:tsk,ket:disket,<?php $i = 1; foreach ($jabatan as $key) {  ?> action<?= $key->id ?>:act<?= $key->id ?>,jbtn<?= $key->id ?>:atr<?= $key->id ?>, <?php $i++;} ?> <?php $n = 1; foreach ($aksi as $c) {?> aksi<?= $n ?>:aks<?= $n ?>,nam_aksi<?= $n ?>:nm_aks<?= $n ?>,   <?php $n++; } ?>};//ubah surat masuk mei
            console.log(id);
            console.log(data);
            // /*
			$.ajax({ //ubah disposisi mei
                    url: "<?php echo base_URL()."admin/surat_masuk/disp_proses/" ?>",
                    data: {isi: data},
                    // dataType: "json",
                    type: "POST",
                    success: function(data){
                        // response(data);
                        console.log(data);
                        // alert("Disposisi Sukses!");//ubah mei surmas7
                        // if(data=="0"){
                        //     alert("Username tidak terdaftar. Harap sesuaikan Username ini dengan Username Anda Di E-Office.");
                        // window.location.href = baseUrl+'admin/surat_masuk/';
                    window.location.assign("<?php echo base_url();?>admin/surat_masuk/");
					// alert('success');
                        // window.location.href = baseUrl+'admin/surat_masuk/';
                        // }else if(data=="1"){

                        // }else{
                        //     alert("Username Anda Terdaftar dengan nama Akun "+data);
                        //     $("#btn_sbm_ad").prop('disabled', false);
                        // }
                    },
                    error: function(data){
                        // console.log(data);
                        alert('Disposisi Gagal!');
                        $("#loadingModal").modal("hide");//ubah mei surmas7
                        // window.location.assign("<?php //echo base_url();?>admin/surat_masuk/");
                        // window.location.href = baseUrl+'admin/surat_masuk/';
                    }
                });
			//*/
        }//ubah mei surmas11

      });


    $('#feedback').on('click',function () {
        var msg = $('#pesan_feedback').val();
        var ids = <?php echo ($idp != "") ? $idp : "0"; ?>;

        $.post('<?= base_url().'administrator/feedback' ?>',{pesan:msg,id:ids},function (data) {

            $('#pesan_feedback').val('');
            $('.media').load('<?= base_URL()."admin/surat_masuk/kadisp/"  ?>'+ids+' .media');
        });
    });

    $('#feedback_kasubdis').on('click',function () {
        var msg = $('#pesan_feedback_kasubdis').val();
        var ids = <?php echo ($idp != "") ? $idp : "0"; ?>;
        var actlan = "<?php echo $isact ?>";
        // alert(actlan);
        $.ajax({ //ubah disposisi mei
            url: "<?php echo base_URL()."administrator/feedback_satuan/" ?>",
            data: {pesan: msg, id:ids},
            // dataType: "json",
            type: "POST",
            success: function(data){
                // response(data);
                // console.log(data);
                $('#pesan_feedback_kasubdis').val('');
                // window.location.href = baseUrl+'admin/surat_masuk/';
                $('.media2').load('<?= base_URL()."admin/surat_masuk/$isact/"  ?>'+ids+' .media2');
            },
            error: function(data){
                alert('Disposisi Gagal!');
            }
        });
        // $.post('<?= base_url().'administrator/feedback_satuan' ?>',{mess:msg,idps:ids},function (data) {

        //     $('#pesan_feedback_kasubdis').val('');
        //     $('.media2').load('<?= base_URL()."admin/surat_masuk/kadisp/"  ?>'+ids+' .media2');
        // });
    });


    <?php if($act == "kadisp"){ ?>

     $('#disposisikan_satuan').on('click',function () {//ubah mei surmas10
        $("#loadingModal").modal("show");//ubah mei surmas7
         var id = <?php echo ($idp != "") ? $idp : "0"; ?>;

         var disket = $('#disket_satuan').val();


       <?php  $y = 1; foreach ($datasatuan as $sat) { ?>
        var sat<?= $y ?>= $('input[name=satuan<?= $y ?>]:checked').val();
        var atr<?= $y ?>= $('input[name=satuan<?= $y ?>]:checked').attr('satuan');
       <?php $y++; } ?>

        <?php $n = 1; foreach ($aksi as $c) {?>
            var aks<?= $n ?> = $('input[name=aks2<?= $n ?>]:checked').val();
            var nm_aks<?= $n ?> = $('input[name=aks2<?= $n ?>]:checked').attr('acs2');
        <?php $n++; } ?>


        var data = {no:id,ket:disket,<?php $n = 1; foreach ($aksi as $c) {?> aksi<?= $n ?>:aks<?= $n ?>,nam_aksi<?= $n ?>:nm_aks<?= $n ?>,<?php $n++; } ?><?php $i = 1; foreach($datasatuan as $sat) { ?> satuan<?= $i ?>:sat<?= $i ?>,id_satuan<?= $i ?>:atr<?= $i ?>, <?php $i++; } ?>}; 


        //  $.post('<?php //echo base_URL()."admin/surat_masuk/kadisp_proses/" ?>',data,function (msg) {
        //      console.log(msg);
        //      window.location.assign("<?php //echo base_url();?>admin/surat_masuk/");
        // });
        $.ajax({ //ubah disposisi mei
                url: "<?php echo base_URL()."admin/surat_masuk/kadisp_proses/" ?>",
                data: {isi: data},
                // dataType: "json",
                type: "POST",
                success: function(data){
                    // response(data);
                    console.log(data);
                    // alert("Disposisi Sukses!");//ubah mei surmas7
                    // if(data=="0"){
                    //     alert("Username tidak terdaftar. Harap sesuaikan Username ini dengan Username Anda Di E-Office.");
                    // window.location.href = baseUrl+'admin/surat_masuk/';
                    window.location.assign("<?php echo base_url();?>admin/surat_masuk/");
                    // window.location.href = baseUrl+'admin/surat_masuk/';
                    // }else if(data=="1"){

                    // }else{
                    //     alert("Username Anda Terdaftar dengan nama Akun "+data);
                    //     $("#btn_sbm_ad").prop('disabled', false);
                    // }
                },
                error: function(data){
                    // console.log(data);
                    alert('Disposisi Gagal!');
                    $("#loadingModal").modal("hide");//ubah mei surmas7
                    // window.location.assign("<?php //echo base_url();?>admin/surat_masuk/");
                    // window.location.href = baseUrl+'admin/surat_masuk/';
                }
            });

     });

    <?php } ?>

    //sjsd


   
    $('.ruang').change(function () {
       var id =  $('.ruang option:selected').val();

       $.get('<?=  base_url().'administrator/get_rak' ?>',{ids:id},function (data) {
           $('.rak').html(data);
       })
    });


     $('.rak').change(function () {
       var id =  $('.rak option:selected').val();


       $.get('<?=  base_url().'administrator/get_box' ?>',{ids:id},function (data) {
           $('.box').html(data);
       })
    });

     function ganti(isi){//ubah mei surmas5
        // alert(isi);
        if(isi == 4){
            $.post("<?php echo base_url().'admin/set_nosetum/' ?>",{id:isi},function (data) {
                // console.log(data);
                var isi_awal = data;
                var tambah = "Tgmr/";
                var jadi = tambah+isi_awal;
                // console.log(jadi);
                document.getElementById("no_setum").value = jadi;//ubah mei surmas0
            });
            // var isi_awal = "<?php echo $generated_no_surat ?>";
        // document.getElementById("no_surat").value = jadi;
        }
        if(isi == 3){
             $.post("<?php echo base_url().'admin/set_nosetum/' ?>",{id:isi},function (data) {
                // console.log(data);
                var isi_awal = data;
                var tambah = "Tgmb/";
                var jadi = tambah+isi_awal;
                // console.log(jadi);
                document.getElementById("no_setum").value = jadi;//ubah mei surmas0
            });
            // var isi_awal = "<?php echo $generated_no_surat ?>";
        // document.getElementById("no_surat").value = jadi;
        }
        if(isi == 6){
             $.post("<?php echo base_url().'admin/set_nosetum/' ?>",{id:isi},function (data) {
                // console.log(data);
                var isi_awal = data;
                var tambah = "B/Und.";
                var jadi = tambah+isi_awal;
                // console.log(jadi);
                document.getElementById("no_setum").value = jadi;//ubah mei surmas0
            });
            // var isi_awal = "<?php echo $generated_no_surat ?>";
        // document.getElementById("no_surat").value = jadi;
        }
        if(isi == 2){
             $.post("<?php echo base_url().'admin/set_nosetum/' ?>",{id:isi},function (data) {
                // console.log(data);
                var isi_awal = data;
                var tambah = "R/";
                var jadi = tambah+isi_awal;
                // console.log(jadi);
                document.getElementById("no_setum").value = jadi;//ubah mei surmas0
            });
            // var isi_awal = "<?php echo $generated_no_surat ?>";
        // document.getElementById("no_surat").value = jadi;
        }
        if(isi == 1){
             $.post("<?php echo base_url().'admin/set_nosetum/' ?>",{id:isi},function (data) {
                // console.log(data);
                var isi_awal = data;
                var tambah = "B/";
                var jadi = tambah+isi_awal;
                // console.log(jadi);
                document.getElementById("no_setum").value = jadi;//ubah mei surmas0
            });
            // var isi_awal = "<?php echo $generated_no_surat ?>";
        // document.getElementById("no_surat").value = jadi;
        }
        if(isi == 5){
             $.post("<?php echo base_url().'admin/set_nosetum/' ?>",{id:isi},function (data) {
                // console.log(data);
                var isi_awal = data;
                var tambah = "B/Lua.";
                var jadi = tambah+isi_awal;
                // console.log(jadi);
                document.getElementById("no_setum").value = jadi;//ubah mei surmas0
            });
            // var isi_awal = "<?php echo $generated_no_surat ?>";
        // document.getElementById("no_surat").value = jadi;
        }
		var abcd = $("#jenis_surat").val();
		// alert(abcd);
		<?php
			$selectedAmbilTugas = "";
			if(isset($datpil->id_taks)){
				$selectedAmbilTugas = ",selected:".$datpil->id_taks;
			}
		?>
		 $.get('<?php echo base_url().'admin/ambiltugas/' ?>',{ abcd:abcd<?= $selectedAmbilTugas; ?>},function(data){
              console.log(data);
              // alert(nofi);
             $('#listtugas').html(data);
             

              
          });
		  
		 $.get('<?php echo base_url().'admin/ambilaja/' ?>',{ abcd:abcd},function(data){
              console.log(data);
              // alert(nofi);
             $('#clnya').html(data);
             

              
          });
        
     }
	<?php if(($this->session->userdata('admin_tingkatan')==1 or $this->session->userdata('admin_tingkatan')==2) and isset($datpil) and $mode!='add'){ ?>
	$(".ajaxTugas").on('change',function(){
		$.ajax({
			method: 'get',
			url: '<?=  base_url().'admin/surat_masuk/save_task' ?>',
			data: {
				id : <?= $datpil->id; ?>,
				task : this.value
			},success: function (result) {
				alert("Task berhasil diperbaharui");
			}, error: function () {
				alert("Terjadi kesalahan.");
			}
		});
	});
	<?php } ?>
	$(".checkedCheckbox").change(function(){
		if(this.checked){
			$(this).css('outline','#194896 solid 1px');
		}else{
			$(this).css('outline','');
		}
	});
	$(".checkedCheckbox:checked").css('outline','#194896 solid 1px');
	<?php
	if(isset($datpil->id_jenis_surat_masuk)){
		echo "ganti($datpil->id_jenis_surat_masuk)";
	}
	?>
</script>