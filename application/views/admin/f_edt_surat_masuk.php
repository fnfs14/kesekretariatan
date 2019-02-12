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
    $kepada = $datpil->kepada;//ubah surat masuk mei
    // $workspace = $datpil->id_workspace;//ubah surat masuk mei
    $taksa = $datpil->id_taks;//ubah surat masuk mei
    $ruangs = $datpil->id_ruang; 
    $raks = $datpil->id_rak; 
    $boxs = $datpil->id_box;  
    $bariss= $datpil->baris;
    $kondisp = 0;//ubah mei surmas11

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
<form action="<?php echo base_URL(); ?>admin/surat_masuk/<?php echo $act; ?>" method="post" accept-charset="utf-8"
      enctype="multipart/form-data" id="formnya">

<input type="hidden" name="idp" value="<?php echo $idp; ?>">


<div class="row-fluid well" style="overflow: hidden">

    <div class="col-lg-6">
        <table class="table-table">
			<tr>
                <td>Jenis Surat</td>
                <td>
                    <select onchange="ganti(this.value)" <?php if($act != 'act_add' ){echo "";} ?> id="jenis_surat" name="jenis_surat" class="form-control" style="width: 200px"><!--ubah surat masuk mei-->
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
                              class="form-control" <?php echo ($idp != "") ? "" : ""; ?> ></b></td>
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
                              id="tgl_setum" style="width: 200px" class="form-control" <?php echo ($mode != "add") ? "" : ""; ?> ></b></td><!--ubah surat masuk mei -->
            </tr>
           <?php // echo $act; ?>
            <tr>
                <td>Klasifikasi</td>
                <td><b>
                        <select name="klasifikasi" tabindex="3" required class="form-control" id="klasifikasi"
                                style="width: 200px" <?php echo ($idp != "") ? "" : ""; ?> >
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
                                style="width: 200px" <?php echo ($idp != "") ? "" : ""; ?> >
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
			
			
			 <tr>
                <td>Tugas</td><!--ubah mei bahasa-->
                <td>
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
                            <select id="combobox" name="instansi" class="form-control" style="width: 200px" <?php echo ($idp != "") ? "" : ""; ?>>
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
                                style="width: 200px" <?php echo ($idp != "") ? "" : ""; ?>>
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
                              class="form-control" value="<?php echo $no_surat; ?>" <?php echo ($idp != "") ? "" : ""; ?>>
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
                              class="form-control" <?php echo ($idp != "") ? "" : ""; ?>></b></td>
            </tr>
            <tr>
                <td width="20%">Perihal</td>
                <td><b><input type="text" name="perihal" tabindex="8" required class="form-control" placeholder="Perihal" style="width: 400px"
                              value="<?php echo $perihal; ?>" <?php echo ($idp != "") ? "" : ""; ?>></b></td>
            </tr>

            <tr>
                <td width="20%">
                <?php if($act == "kadisp"){ echo "Diterima Dari";}else{echo " Diteruskan Kepada";} ?>
               

                </td>
                <td><b>
                        <select name="kepada" tabindex="9" required class="form-control" id="derajat"
                                style="width: 200px" <?php echo ($idp != "") ? "" : ""; ?> >
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
                                 class="form-control" <?php echo ($idp != "") ? "" : ""; ?> ><?php echo $ket; ?></textarea></b>
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
					var string = $("input[name='no_setum']").val();
					var prevFile = "<?= $file_attachment; ?>";
					var ext = "";
					if(prevFile!="Tidak ada Dokumen"){
						ext = prevFile.split('.')[1];
					}
                    $.ajax({
                        method: 'post',
                        url: "<?php echo base_url(); ?>admin/checkUploadedFile",
						data:{
							file : string,
							ext : ext,
							path : "<?= base_url(); ?>upload/surat_masuk/"
						},
                        success: function (result) {
							$("#no_lampiran").attr("value", result);
							$("#cetak_no_lampiran").attr("href", "<?php echo base_URL(); ?>admin/cetak_no_lampiran_sm/" + $("input[name='no_lampiran']").val());
                        },
                        error: function () {
                            alert("Terjadi Kesalahan");
                        }
                    });
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
                $(document).on('keyup', '#no_surat', function() {
                   delay(function(){
                    //Get variable
                    var id = $('#no_surat').val();
                    var idp = <?php echo ($idp != "") ? $idp : "0"; ?>;
                      $.ajax({
                        method: 'post',
                        data: {id:id,id_surat:idp,table:'surat_masuk'},
                        url:"<?php echo base_url(); ?>admin/validasi_id",
                        success: function(data) {

                            if(data>0){
                                $('#warning_nosu').css('display','block');
                            }else{
                                $('#warning_nosu').css('display','none');
                            }
                        },
                        error: function(error){
                            console.log(error);
                        }

                        });
                    }, 1000 );
                });
                
                //Ketika webpage diload, langsung melakukan pengecekan
                  $(window).load(function(){
                    $('#no_surat').keyup();
                 }); 

                //END
            </script>
            <?php if ($act == "act_add" || $act == "act_edt" || $act == "act_edited") { ?>
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
								}else if ($('#warning_nosu').is(':visible')) {
                                    alert("No surat sudah ada.");
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
<script>
function ganti(isi){
        if(isi == 4){
            $.post("<?php echo base_url().'admin/set_nosetum/' ?>",{id:isi,idsurat:<?= $idp; ?>},function (data) {
                var isi_awal = data;
                var tambah = "Tgmr/";
                var jadi = tambah+isi_awal;
				if(data=="nomorsetumalreadyexist"){
					jadi = "<?= $no_setum; ?>";
				}
                document.getElementById("no_setum").value = jadi;//ubah mei surmas0
            });
        }
        if(isi == 3){
             $.post("<?php echo base_url().'admin/set_nosetum/' ?>",{id:isi,idsurat:<?= $idp; ?>},function (data) {
                var isi_awal = data;
                var tambah = "Tgmb/";
                var jadi = tambah+isi_awal;
				if(data=="nomorsetumalreadyexist"){
					jadi = "<?= $no_setum; ?>";
				}
                document.getElementById("no_setum").value = jadi;//ubah mei surmas0
            });
        }
        if(isi == 6){
             $.post("<?php echo base_url().'admin/set_nosetum/' ?>",{id:isi,idsurat:<?= $idp; ?>},function (data) {
                var isi_awal = data;
                var tambah = "B/Und.";
                var jadi = tambah+isi_awal;
				if(data=="nomorsetumalreadyexist"){
					jadi = "<?= $no_setum; ?>";
				}
                document.getElementById("no_setum").value = jadi;//ubah mei surmas0
            });
        }
        if(isi == 2){
             $.post("<?php echo base_url().'admin/set_nosetum/' ?>",{id:isi,idsurat:<?= $idp; ?>},function (data) {
                var isi_awal = data;
                var tambah = "R/";
                var jadi = tambah+isi_awal;
				if(data=="nomorsetumalreadyexist"){
					jadi = "<?= $no_setum; ?>";
				}
                document.getElementById("no_setum").value = jadi;//ubah mei surmas0
            });
        }
        if(isi == 1){
             $.post("<?php echo base_url().'admin/set_nosetum/' ?>",{id:isi,idsurat:<?= $idp; ?>},function (data) {
                var isi_awal = data;
                var tambah = "B/";
                var jadi = tambah+isi_awal;
				if(data=="nomorsetumalreadyexist"){
					jadi = "<?= $no_setum; ?>";
				}
                document.getElementById("no_setum").value = jadi;//ubah mei surmas0
            });
        }
        if(isi == 5){
             $.post("<?php echo base_url().'admin/set_nosetum/' ?>",{id:isi,idsurat:<?= $idp; ?>},function (data) {
                var isi_awal = data;
                var tambah = "B/Lua.";
                var jadi = tambah+isi_awal;
				if(data=="nomorsetumalreadyexist"){
					jadi = "<?= $no_setum; ?>";
				}
                document.getElementById("no_setum").value = jadi;//ubah mei surmas0
            });
        }
		var abcd = $("#jenis_surat").val();
		
		 $.get('<?php echo base_url().'admin/ambiltugas/' ?>',{ abcd:abcd, selected:<?= $datpil->id_taks; ?>},function(data){
              console.log(data);
             $('#listtugas').html(data);
          });
		  
		 $.get('<?php echo base_url().'admin/ambilaja/' ?>',{ abcd:abcd},function(data){
              console.log(data);
             $('#clnya').html(data);
          });
        
     }
	ganti(<?= $datpil->id_jenis_surat_masuk; ?>);
</script>

 
