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
                    <select onchange="ganti(this.value)" <?php if($act != 'act_add' ){echo "disabled";} ?> name="jenis_surat" class="form-control" style="width: 200px"><!--ubah surat masuk mei-->
                        <option value="" style="display: none;">- Pilih Jenis -</option>
                        <?php foreach ($jenis_surat as $key => $js) { ?>

                           <option  <?php if(isset($datpil->id_jenis_surat_masuk)){
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
           
            <tr>
                <td>Klasifikasi</td>
                <td><b>
                        <select name="klasifikasi" tabindex="3" required class="form-control" id="klasifikasi"
                                style="width: 200px" <?php echo ($idp != "") ? "disabled" : ""; ?> >
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
                                style="width: 200px" <?php echo ($idp != "") ? "disabled" : ""; ?> >
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
                        ?> -->
                    </select>
                    <div class="ui-widget col-md-8" style="padding:0px !important; font-size: 14px;">
                            <select id="tknya" name="tknya" class="form-control" style="width: 400px">
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
                            <select id="tknya" name="tknya" class="form-control" style="width: 400px" disabled>
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
                            <select id="tknya" name="tknya" class="form-control" style="width: 400px" disabled>
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
            // alert(rkrj);
            // alert(nmtg);
            $.ajax({
                method: 'get',
                url: "<?php echo base_URL()?>admin/surat_masuk/tambah_tugas?q=" + nmtg + "&r=" + rkrj,
                data: {}, success: function (result) {
                    $("#tknya").html(result);
                    // console.log(result);
                    $(".custom-combobox-input").val($("#nama_tambah_tugas").val());
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
                <td><b><textarea name="perihal" tabindex="8" required class="form-control" placeholder="Perihal" style="width: 400px"
                               <?php echo ($idp != "") ? "disabled" : ""; ?>><?php echo $perihal; ?></textarea></b></td>
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
					<a href="<?= (isset($file_attachment)) ? base_URL() . 'upload/surat_masuk/' . $file_attachment : "#"; ?>" target="_blank"><?= (isset($file_attachment)) ? $file_attachment : ""; ?></a>
				</td>
			</tr>
        </table>
    </div>

</div>


 






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

                            $keysp = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = '.$idp.' AND penerima_disposisi ='.$c->id)->result();

                            $penerima = array();
                            $aks = array();
                            foreach ($keysp as $key => $vs) {
                                $penerima = $vs->penerima_disposisi;
                                $aks = $vs->jenis; 

                                 if($penerima == $c->id){
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
									<?php if($c->id!=28){ ?>
										<input <?= $checked ?>  type="checkbox" jabatan="<?= $c->id ?>" value="AKSI" disabled id="tsf<?= $no ?>" name="tsf<?= $no ?>"><!-- ubah mei surmas11 -->
									<?php } else {?>
										<input <?= $checked ?>  type="checkbox" jabatan="<?= $c->id ?>" value="AKSI" disabled name="tsf<?= $no ?>"><!-- ubah mei surmas11 -->
									<?php } ?>
                                  </label>
                              </div>
                          </div>
                          <div class="col-md-10">
                             <div class="row">
                               <div class="checkbox" style="width: 70%;"><!-- ubah mei surmas11 -->
                                <label>
                                <input <?= $checkeds ?>  type="checkbox" jabatan="<?= $c->id ?>" value="INFORMASI" disabled name="tsf<?= $no ?>"><!-- ubah mei surmas11 -->
                                <?= $c->nama_jabatan ?></label>
                                </div>
                              </div>
                          </div>
                          </div>
                       
                         
                        
                       </div>
                     <?php $no++; }} ?>


                     <br>
                     
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
                        $param = array();
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
                          <label><input <?= $checkedzx ?> acs="<?= $c->nama_aksi ?>" name="aks<?= $n ?>"disabled type="checkbox" value="<?= $c->id ?>"  ><?= $c->nama_aksi ?></label>
                        </div>
                        <!-- <?= $param ?> -->
                    </div>
                    <?php $n++; } ?>
                    </div>
                </div>
               
            </div>
        </div>
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
                <b><textarea disabled name="disket" id="disket" tabindex="10" style="width: 100%;height: 150px"
                             class="form-control"><?= $ket ?></textarea></b>
            </div>
        </div>
                 <div class="row">
                    <br>
                    <div class="col-md-12 text-right">
					<td colspan="4"><a href="<?php echo base_URL(); ?>admin/surat_masuk" class="btn btn-success" tabindex="13"><i
                                    class="icon icon-arrow-left icon-white"></i> Kembali</a></td>
                    </div>
                </div>
        </div>
    </div>
      <!-- end -->
<script type="text/javascript">
    $('#tgl_surat').datepicker({dateFormat: 'dd-mm-yy'}).val();
    $('#tgl_setum').datepicker({dateFormat: 'dd-mm-yy'}).val();
</script>