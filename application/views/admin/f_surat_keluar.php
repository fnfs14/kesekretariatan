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

if ($mode == "edt" || $mode == "act_edt" || $mode == "verifikasi_surat_keluar" || $mode == "show" || $mode=="edit_new_message") {
    $act = "act_edt";
	$komen = (isset($datpil100->komentar)) ? $datpil100->komentar : "";
    $idp = $datpil->id;
    $perihal = $datpil->perihal;
    // $no_agenda	= $datpil->no_agenda;
    // $kode		= $datpil->kode;
    $file_attachment = $datpil->file_attachment;
    $signature = $datpil->signature;
    $dari = $datpil->kepada;
    $no_surat = $datpil->no_surat;
    $tgl_surat = date("d-m-Y", strtotime($datpil->tgl_surat));
    $uraian = $datpil->isi;
    $ket = $datpil->keterangan;
    $isi_surat = $datpil->isi;
    $status_surat = $datpil->status_surat_keluar;
    $jenis_surat = $datpil->jenis_surat;
    $kirim_ke = $datpil->kirim_ke;
    if ($mode == "verifikasi_surat_keluar") {
        if ($this->session->userdata('admin_jabatan') == 1 || $this->session->userdata('admin_jabatan') == 28) {
            $act = 'verifikasi_submit_kapushidrosal/' . $idp;
        } elseif ($this->session->userdata('admin_jabatan') == 2) {
            $act = 'kirim_ke_kapushidrosal/' . $idp;
        } else {
            $act = 'verifikasi_submit/' . $idp;
        }
    }

} else {
    $datpil_tembusan = [];
    $act = "act_add";
    $idp = "";
    $no_agenda = "";
    $kode = "";
    $dari = "";
    $no_surat = "";
    $tgl_surat = date('d-m-Y');
    $uraian = "";
    $ket = "";
    $perihal = "";
    $isi_surat = "";
    $file_attachment = "";
    $signature = "";
    $jenis_surat = "";
    $kirim_ke = "";
}
if ($this->session->userdata('admin_jabatan') == 2) {
    $disabled = "";
} else {
    $disabled = "disabled";
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
</style>
<script src="<?= base_url() ?>aset/js/autocomplete.js"></script>
<!-- <script src="<?= base_url() ?>aset/js/jquery.signature.min.js"></script>
<script src="<?= base_url() ?>aset/js/jquery/jquery.ui.touch-punch.min.js"></script>
<link type="text/css" href="<?= base_url() ?>aset/css/jquery.signature.css" rel="stylesheet"> -->


<div class="navbar navbar-inverse">
    <div class="container z0">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Surat Keluar</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->


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
                <input type="submit" class="btn btn-default btn-sm" id="button_tambah_tujuan"/>
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
</script>
<form action="<?php echo base_URL() ?>admin/surat_keluar/<?php echo $act; ?>" method="post" accept-charset="utf-8"
      enctype="multipart/form-data" id="formnya">

    <input type="hidden" name="idp" value="<?php echo $idp; ?>">

    <div class="row-fluid well" style="overflow: hidden">

        <div class="col-lg-12">
            <table width="100%" class="table-form">
                <tr>
					<td>Jenis Surat</td>
                    <td>
                        <b>
                            <select name="jenis_surat" class="form-control" id="jenis_surat"
                                    onchange="get_template_surat()">
                                <option value="" selected disabled>--PILIH JENIS SURAT--</option>
                                <?php
                                foreach ($jenis as $jen) { ?>
									<?php 
										if(isset($datpil->jenis_surat) and $datpil->jenis_surat == $jen->id_master_surat_keluar){
											$selected_jenis_surat = "selected";
										}else{
											$selected_jenis_surat = "";
										}
									?>
                                    <option value="<?php echo $jen->id_master_surat_keluar; ?>" <?= $selected_jenis_surat; ?> ><?php echo $jen->jenis_surat_keluar; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </b>
                    </td>
					<td width="10%"></td>
                    <td width="15%">Tanggal Surat</td>
                    <td width="30%"><b><input type="text" tabindex="2" name="tgl_surat" required
                                              value="<?php echo $tgl_surat; ?>" id="tgl_surat" style=""
                                              class="form-control" required></b></td>
                </tr>
                <tr>
                    <td>Klasifikasi</td>
                    <td><b><select name="klasifikasi" required class="form-control" id="klasifikasi">
                                <option value="SANGAT RAHASIA" <?= (isset($datpil->klasifikasi) and $datpil->klasifikasi == "SANGAT RAHASIA") ? 'selected' : ''; ?>>
                                    SANGAT RAHASIA
                                </option>
                                <option value="RAHASIA" <?= (isset($datpil->klasifikasi) and $datpil->klasifikasi == "RAHASIA") ? 'selected' : ''; ?>>
                                    RAHASIA
                                </option>
                                <option value="BIASA" <?= (isset($datpil->klasifikasi) and $datpil->klasifikasi == "BIASA") ? 'selected' : ''; ?>>
                                    BIASA
                                </option>
                            </select></b>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <!--	<tr>
			<td>Type Surat</td>
			<td><b><select name="klasifikasi" required class="form-control" id="klasifikasi" >
					<?php foreach ($tujuan as $a) {
                    echo "<option value='$a->id'>$a->nama</option>";
                } ?>
				</select></b>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr> -->
                <tr>
					<td>Derajat</td>
                    <td><b><select name="derajat" required class="form-control" id="derajat">
                                <option value="KILAT" <?= (isset($datpil->derajat) and $datpil->derajat == "KILAT") ? 'selected' : ''; ?>>
                                    KILAT
                                </option>
                                <option value="SEGERA" <?= (isset($datpil->derajat) and $datpil->derajat == "SEGERA") ? 'selected' : ''; ?>>
                                    SEGERA
                                </option>
                                <option value="BIASA" <?= (isset($datpil->derajat) and $datpil->derajat == "BIASA") ? 'selected' : ''; ?>>
                                    BIASA
                                </option>
                            </select></b>
                    </td>
					<td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
					<td width="15%">Tujuan Surat</td>
                    <td width="30%">
                        <?php if ($dari == "") { ?>
                            <div class="ui-widget">
                                <select id="combobox" name="dari">
                                    <?php foreach ($tujuan as $a) {
                                        echo "<option value='$a->id'>$a->nama</option>";
                                    } ?>
                                </select>
                            </div>
                        <?php } else {
                            ?>
                            <div class="ui-widget">
                                <select id="combobox" name="dari">
                                    <?php foreach ($tujuan as $a) {
                                        // $datpil->create_by==$this->session->userdata('admin_id')
                                        if ($dari == $a->id) {
                                            echo "<option value='$a->id' selected>$a->nama</option>";
                                        } else {
                                            echo "<option value='$a->id'>$a->nama</option>";
                                        }
                                    } ?>
                                </select>
                            </div>
                        <?php } ?>
                    </td>
                    <td width="10%"><?php if ($dari == "") { ?><a data-toggle="modal" data-target="#myModal123"
                                                                  class="btn btn-default btn-sm"
                                                                  title="Tambah Tujuan"><span
                                    class="icon icon-plus icon-white"></span></a><?php } ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
					<td>Nomor Surat</td>
                    <td>
						<?php
							if($mode=='verifikasi_surat_keluar' and $this->session->userdata('admin_jabatan') == 2){
								$nomor_surat_editable = "";
							}else{
								$nomor_surat_editable = "readonly";
							}
						?>
						<b><input <?= $nomor_surat_editable; ?> type="text" tabindex="3" name="no_surat" id="no_surat" required
                                  value="<?php 
									if(isset($generated_no_surat) and $no_surat==""){
										echo $generated_no_surat;
									}else{
										echo $no_surat;
									} ?>"
                                  style="" class="form-control"></b><span class="label label-danger" id="warning_nosu" style="display: none">* No surat sudah ada!</span></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
                            if($mode=='verifikasi_surat_keluar' and $this->session->userdata('admin_jabatan') == 2 and $status_surat==5){
                        ?>
                <tr>
                    <td>Dikirimkan Kepada<span style="color: red;">*</span></td>
                    <td><b>
                        <select name="kirim_kpd" tabindex="9" required class="form-control" id="kirim_kpd"  <?php echo ($kirim_ke != "") ? "disabled" : ""; ?> >
                                <option value="" style="display: none;">- Pilih -</option>
                                <?php if(empty($kirim_ke)){?>
                                <option value="1">KAPUSHIDROSAL</option>
                                <option value="28">WAKAPUSHIDROSAL</option>
                            <?php } else { ?>
                                <option value="1" <?php if($kirim_ke == 1) echo "selected='selected'";?>>KAPUSHIDROSAL</option>
                                <option value="28" <?php if($kirim_ke == 28) echo "selected='selected'";?>>WAKAPUSHIDROSAL</option>
                            <?php } ?>
                        </select></b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php } ?>
                <tr>
                    <td style="vertical-align: top;">Perihal</td>
                    <td><b><textarea tabindex="4" name="perihal" required style=""
                                     class="form-control"><?php echo $perihal; ?></textarea></b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Pengantar Surat</td>
                    <td colspan="4"><b><textarea tabindex="5" name="isi_surat" id="isi_surat" required style="" rows="5"
                                                 class="form-control"><?php echo $isi_surat; ?></textarea></b></td>
                </tr>
                <tr>
                    <td width="20%">File</td>
                    <td>
                        <?php if ($file_attachment == "") { ?>
                            <b><input type="file" name="file_attachment" id="file_attachment_id" tabindex="11" class="form-control"
                                      style="width: 200px"></b>*Upload file data type document
                        <?php } else { ?>
                            <b><input type="file" name="file_attachment" id="file_attachment_id" tabindex="11" class="form-control"
                                      style="width: 200px"></b>
                            File lama:
                            <a href="<?php echo base_URL(); ?>upload/surat_keluar/<?php echo $file_attachment; ?>"
                               target='_blank'><?php echo $file_attachment; ?></a>
                        <?php } ?>
                    </td>
                    <?php if ($mode != "show" and $mode != "verifikasi_surat_keluar") { ?>
                        <td><a class="btn btn-default btn-sm" id="generate_no">Generate Nomor Lampiran</a></td>
                        <td><input readonly type='text' tabindex='2' name='no_lampiran' id='no_lampiran' style=''
                                   class='form-control'></td>
                        <td><a href="" target="_blank" id="cetak_no_lampiran" class="btn btn-default btn-sm">Cetak
                                Nomor</a></td>
                    <?php } else { ?>
                        <td></td>
                        <td></td>
                        <td></td>
                    <?php } ?>
                </tr>

                <script>
                    /***********************************************
                     ** Feature Cetak nomer surat keluar
                     ** By: Muhamad Farhan Badrussalam
                     ***********************************************/
                    $("#generate_no").click(function () {
                        // alert(document.getElementById("filenya").files[0].name);
                        $.ajax({
                            method: 'post',
                            url: "<?php echo base_url(); ?>admin/generate_filename?q=1",
                            success: function (result) {
                                var a = new Date();
                                $("#no_lampiran").attr("value", "SK-" + result + "-" + a.getFullYear());
                                $("#cetak_no_lampiran").attr("href", "<?php echo base_URL(); ?>admin/cetak_no_lampiran/SK/" + result + "/" + a.getFullYear() + "/null");
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
                        data: {id:id,id_surat:idp,table:'surat_keluar'},
                        url:"<?php echo base_url(); ?>admin/validasi_id",
                        success: function(data) {

                            if(data>0){
                                $('#warning_nosu').css('display','block');
                                // alert("ada");
                            }else{
                                $('#warning_nosu').css('display','none');
                                // alert("gada");

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
                    if ($('#no_surat').value() != "") {
                        $('#no_surat').keyup();
                    }
                 }); 

                //END
                </script>
                <tr>
                    <td style="vertical-align: top;">Keterangan</td>
                    <td colspan="4"><b><textarea tabindex="7" name="ket" required style="" rows="5"
                                                 class="form-control"><?php echo $ket; ?></textarea></b></td>
                </tr>

				<?php if ($mode!="add" and $this->session->userdata('admin_jabatan') == 2){ ?>
                <?php if ($datpil->status_surat_keluar == 4) { ?>
                        <tr>
							<td style="vertical-align: top;">
                                <?php if($datpil->kirim_ke == 1){ ?>
                                Komentar Kapushidrosal
                            <?php }else{ ?>
                                Komentar Wakapushidrosal
                            <?php } ?>
                            </td>
							<td colspan="4"><b><textarea tabindex="7" name="komen" readonly style="" rows="5"
														 class="form-control"><?php echo $komen; ?></textarea></b></td>
						</tr>
                <?php } ?>
				<?php } ?>



                <?php //if ($this->session->userdata('admin_jabatan') != 2) { ?>


                    <tr>
                        <td width="20%"><?php if ((isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')) or $mode == 'add') { ?>Tembusan<?php } ?></td>
                        <td><?php if ((isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')) or $mode == 'add') { ?>
                                <select name="tembusan" class="form-control" id="tembusan" tabindex="8">
                                    <option value="none" hidden>Pilih</option>
                                    <?php
                                    $arr = [];
                                    foreach ($datpil_tembusan as $b) {
                                        $arr[] = $b->id_jabatan;
                                    }
                                    foreach ($data as $b) {
                                        if (!in_array($b->id, $arr)) {
                                            echo "<option value='$b->id'>$b->nama_jabatan</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </td>
                        <td><?php if ((isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')) or $mode == 'add') { ?>
                                <a class="btn btn-default btn-sm" tabindex="9" id="tambah_tebusan"
                                   style="float:right; margin-left:10px;"><i class="icon icon-ok icon-white"></i> Tambah</a><?php } ?>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>


                    <tr>
                        <td width="20%"
                            style="vertical-align:top;"><?php if (isset($datpil->create_by) and $datpil->create_by != $this->session->userdata('admin_id')) { ?>Tembusan<?php } ?></td>
                        <td colspan="4">
                            <table class="table table-bordered" id="tembusan_table" style="text-align:center;">
                                <tr>
                                    <td>No</td>
                                    <td>Jabatan</td>
                                    <td>Status</td>
                                    <td>Keterangan</td>
                                    <td>Aksi</td>
                                </tr>
                                <?php
                                $count = 1;

                                foreach ($datpil_tembusan as $aa) {
                                    if ($aa->status == 0) {
                                        $asd = "background:#9b9389";
                                        $qwe = "background:#9b9389";
                                    } else if ($aa->status == 1) {
                                        $asd = "background:#9b9389";
                                        $qwe = "background:#97310e";
                                    } else if ($aa->status == 2) {
                                        $asd = "background:#97310e";
                                        $qwe = "background:#9b9389";
                                    }
                                    echo "
							<tbody>
								<tr style='vertical-align:top;'>
									<td>" . $count . "</td>
									<td>" . $aa->nama_jabatan . "</td>
									<td>";
                                    if ($this->session->userdata('admin_jabatan') == 1 or ($datpil->status_surat_keluar==5 and $this->session->userdata('admin_jabatan') == 2) or ($datpil->status_surat_keluar==7) ) {
                                        echo "<div class='col-md-12'><a class='btn-default btn btn-xs status_tembusan_setuju status_tembusan_setuju" . $aa->idnya_tembusan . "' style='; $asd' status_tembusan='" . $aa->idnya_tembusan . "'>Setuju</a></div>";
                                    } else if (isset($datpil->create_by) and $datpil->create_by != $this->session->userdata('admin_id') or $mode == "edt") {
                                        if ($aa->idnya_jabatan != $this->session->userdata('admin_jabatan')) {
                                            $tembusan_hidden_show = "hidden";
                                        } else {
                                            $tembusan_hidden_show = "";
                                        }
                                        echo "<div class='col-md-6' $tembusan_hidden_show><a class='btn-default btn btn-xs status_tembusan_setuju status_tembusan_setuju" . $aa->idnya_tembusan . "' style='float:right; $asd' status_tembusan='" . $aa->idnya_tembusan . "'>Setuju</a></div>
									<div class='col-md-6' $tembusan_hidden_show><a class='btn-default btn btn-xs status_tembusan_koreksi status_tembusan_koreksi" . $aa->idnya_tembusan . "' style='float:left; $qwe' status_tembusan='" . $aa->idnya_tembusan . "'>Koreksi</a></div>";
                                    }
                                    echo "</td>";
                                    if ($this->session->userdata('admin_id') == $datpil->create_by) {
                                        $tembusan_hidden_show = "";
										if($this->session->userdata('admin_jabatan')==2){
											$tembusan_hidden_show = "style='display:none;'";
										}
                                    } else if ($aa->idnya_jabatan != $this->session->userdata('admin_jabatan')) {
                                        $tembusan_hidden_show = "style='display:none;'";
                                    } else {
                                        $tembusan_hidden_show = "";
                                    }
									if($datpil->status_surat_keluar==7){
                                        $tembusan_hidden_show = "style='display:none;'";
									}
									if(isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id') and $mode=='show'){
										echo "<td style='text-align:left;'>$aa->keterangan</td>";
									}else{
										echo "<td><textarea name='keterangan_tembusan[]' class='form-control' $tembusan_hidden_show>" . $aa->keterangan . "</textarea></td>";
									}
                                    echo "	<td></td>
										</tr>
							</tbody>";
                                    $count += 1;
                                }
                                ?>
                            </table>
                        </td>
                    </tr>

                    <tr class="jenis_ijin">
                        <td><!--Tanggal Ijin Nikah--></td>
                        <td><input id="tanggal_ijin" type="hidden" class="form-control"
                                   value="<?php echo date('d-m-Y') ?>"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php //}
                if (isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id') and $mode == "edt" and $datpil->status_surat_keluar == 3) {
                    echo "
		<tr>
			<td style='vertical-align:top;'>Komentar</td>
			<td colspan='4'><textarea name='komentar_kapushidrosal' class='form-control' disabled>$lognya->komentar</textarea></td>
		</tr>
			"; ?>
                    <tr>
                        <td style="vertical-align:top;">File Koreksi</td>
                        <td colspan="4"><a
                                    href="<?php echo base_URL(); ?>upload/surat_keluar/<?php echo $file_attachment; ?>"
                                    target='_blank'><?php echo $lognya->file_revisi; ?></a></td>
                    </tr>
                <?php }
                ?>
                <tr>
                    <td id="tembusan_input">
                        <?php
                        foreach ($datpil_tembusan as $aa) {
                            echo "<input type='text' name='jabatan[]' status_tembusan='" . $aa->idnya_tembusan . "' value='" . $aa->id . "' class='idjabatantembusan" . $aa->idnya_tembusan . "' readonly hidden/>
						<input type='text' name='status[]' value='" . $aa->status . "'class='idstatustembusan" . $aa->idnya_tembusan . "' status_tembusan='" . $aa->idnya_tembusan . "' readonly hidden/>";
                        }
                        ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php if ($mode == "show") { ?>
                            <a href="<?php echo base_URL() ?>admin/surat_keluar" tabindex="11" style="float:right;"
                               class="btn btn-success">
                                <i class="icon icon-arrow-left icon-white"></i> Kembali
                            </a>
                        <?php } else if (isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id') || $this->session->userdata('admin_jabatan') == 0){ ?>
                        <?php if ($this->session->userdata('admin_jabatan') == 2 and isset($datpil->create_by) and $datpil->create_by == $this->session->userdata('admin_id')){ ?>
						<?php if ($datpil->status_surat_keluar == 4) { ?>
                        <br/>
                            <button type="submit" class="btn btn-default" tabindex="10"
                                    style="float:right; margin-left:10px;">Simpan
                            </button>
                        <?php } ?>
                        <?php }elseif ($this->session->userdata('admin_jabatan') != 0){ ?>
                        <br/>
                            <button type="submit" class="btn btn-primary" tabindex="10"
                                    style="float:right; margin-left:10px;"><i class="icon icon-ok icon-white"></i>
                                Simpan
                            </button>
                            <a href="<?php echo base_URL() ?>admin/surat_keluar" tabindex="11" style="float:right;"
                               class="btn btn-success">
                                <i class="icon icon-arrow-left icon-white"></i> Kembali
                            </a>
                        <?php } else { ?>
                        <br/>
                            <button type="submit" class="btn btn-primary" tabindex="10"
                                    style="float:right; margin-left:10px;"><i class="icon icon-ok icon-white"></i>
                                Simpan
                            </button>
                            <a href="<?php echo base_URL() ?>admin/agenda_surat_keluar" tabindex="11"
                               style="float:right;" class="btn btn-success">
                                <i class="icon icon-arrow-left icon-white"></i> Kembali
                            </a>
                        <?php } ?>
                        <?php } //elseif ($this->session->userdata('admin_jabatan') == 1 || $this->session->userdata('admin_jabatan') == 28) {//ubah mei error<!-- ubah ini -->

                        //}
                        elseif ($mode!="add" and $this->session->userdata('admin_jabatan') == 2){ ?>
                        <?php if ($datpil->status_surat_keluar == 4) { ?>
                        <br/>
                            <button type="submit" class="btn btn-default" tabindex="10"
                                    style="float:right; margin-left:10px;">Simpan
                            </button>
                        <?php } ?>

                        <?php } else if($this->session->userdata('admin_jabatan') == 1 || $this->session->userdata('admin_jabatan') == 28){
                            if($mode!="add" && $datpil->kirim_ke!=""){
                            ?>
                                <a href="<?php echo base_URL() ?>admin/surat_keluar" tabindex="11" style="float:right;"
                               class="btn btn-success">
                                <i class="icon icon-arrow-left icon-white"></i> Kembali
                            </a>
                        <?php } ?>

                        <?php } else{ ?>
                        <br/><a tabindex="11" style="float:right;" class="btn btn-success" id="proses"
                                onclick="document.getElementById('signatureJSON').value = document.getElementById('signatureJSON').value.replace('data:image/png;base64,','');">
                                Proses
                            </a>
                            <script>
                                $('.status_tembusan_koreksi').click(function () {
                                    $(this).css('background', '#97310e');
                                    var a = $(this).attr('status_tembusan');
                                    $('.status_tembusan_setuju' + a).css('background', '#9b9389');
                                    $('.idstatustembusan' + a).attr('value', '1');
                                });
                                $('.status_tembusan_setuju').click(function () {
                                    $(this).css('background', '#97310e');
                                    var a = $(this).attr('status_tembusan');
                                    $('.status_tembusan_koreksi' + a).css('background', '#9b9389');
                                    $('.idstatustembusan' + a).attr('value', '2');
                                });
                                $('#proses').click(function () {
									var act = "<?= $mode; ?>";
                                    var perihal = validate($("textarea[name='perihal']").val());
                                    var ket = validate($("textarea[name='ket']").val());
									if(act=="act_add" && $("#jabatan_array_tembusan").val()==undefined){
										alert("Harap pilih tembusan");
									}else if($("textarea[name='perihal']").val()==""){
										alert("Harap isi perihal");
									}else if(perihal=="failed" || ket=="failed"){
										alert("Harap tidak menggunakan kutip (') dan backslash (\\)");
									}else if(document.getElementById("file_attachment_id").files.length==0){
										$('#formnya').submit();
									}else if(document.getElementById("file_attachment_id").files.length==1){
										if($("input[name='no_lampiran']").val()==""){
											alert("Harap generate nomor lampiran");
										}else{
											$('#formnya').submit();
										}
									}else{
										$('#formnya').submit();
									}
                                });
                            </script>
                        <?php } ?>
                    </td>
                </tr>
            </table>
            <script>
                <?php if(!isset($datpil_tembusan)){ ?>
                var count = 1;
                $('#tambah_tebusan').click(function () {
                    var a = $('#tembusan').val();
                    if (a != "none") {
                        $.ajax({
                            url: "<?php echo base_URL()?>admin/surat_keluar/tambah_tembusan/",
                            type: 'POST',
                            data: {data: a, count: count},
                            success: function (msg) {
                                $("#tembusan_table").append(msg);
                                count = count + 1;
                                // $('#tembusan').find(":selected").css('display','none');
                                $("#tembusan").val('none');
                                // $.ajax({
                                // url: "<?php echo base_URL()?>admin/surat_keluar/cetak_input_tembusan/",
                                // type: 'POST',
                                // data: {data:a,count:count},
                                // success: function(msg)
                                // {
                                // 	$("#tembusan_input").append(msg);
                                // 	count = count + 1;
                                // 	$('#tembusan').find(":selected").css('display','none');
                                // 	$("#tembusan").val('none');
                                // }
                                // });
                            }
                        });
                    } else {
                        alert('Pilih dengan benar');
                    }
                });
                <?php }else{ ?>
                var count = <?= (isset($count)) ? $count : 0; ?>;
                $('#tambah_tebusan').click(function () {
                    var a = $('#tembusan').val();
                    if (a != "none") {
                        $.ajax({
                            url: "<?php echo base_URL()?>admin/surat_keluar/tambah_tembusan/",
                            type: 'POST',
                            data: {data: a, count: count},
                            success: function (msg) {
                                $("#tembusan_table").append(msg);
                                $.ajax({
                                    url: "<?php echo base_URL()?>admin/surat_keluar/cetak_input_tembusan/",
                                    type: 'POST',
                                    data: {data: a, count: count},
                                    success: function (msg) {
                                        $("#tembusan_input").append(msg);
                                        count = count + 1;
                                        $('#tembusan').find(":selected").css('display', 'none');
                                        $("#tembusan").val('none');
                                    }
                                });
                            }
                        });
                    } else {
                        alert('Pilih dengan benar');
                    }
                });
                <?php } ?>


                function removeD(e,z) {
                    $('#tembusan').find('option[value='+z+']').css('display','block');
                    $('#remove' + e).remove();
                    // $('#tembusan_input').remove();
                }

                function removeDB(e,a,z,y) {
                    
                    
                    $.ajax({
                    url: "<?php echo base_URL()?>admin/surat_keluar/hapus_tembusan",
                    type: 'POST',
                    data: {id:z},
                    success: function(msg)
                    {

                        //namvanka start
                        var selection = "<option value='"+a+"'>"+y+"</option>";
                        $('#tembusan').append(selection);
                        //end
                        $('#remdeb' + e).remove();                      
                    }
                    });
                }
            </script>
        </div>

    </div>
</form>


<?php if ($this->session->userdata('admin_jabatan') == $kirim_ke || $mode != "add" && $this->session->userdata("admin_jabatan") == 1) { ?>
    <form action="<?php echo base_URL() ?>admin/surat_keluar/verifikasi_submit_kapushidrosal_setuju/<?= $idp ?>"
          method="post" accept-charset="utf-8" enctype="multipart/form-data" id="formnya">
        <script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
        <script src='https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js'></script>
        <script>
            $('head').append('<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"">');
        </script>

        <input name="hidden_data" id='hidden_data' type="hidden"/>

        <div class="navbar navbar-inverse">
            <div class="container z0">
                <div class="navbar-header">
                    <span class="navbar-brand" href="#">Verifikasi Konsep</span>
                </div>
            </div><!-- /.container -->
        </div>
        <div class="row-fluid well" style="overflow: hidden">
            <div class="col-lg-12">
                <table width="100%" class="table-form">
                    <tr>
                        <td width="15%"></td>
                        <td width="30%"></td>
                        <td width="10%"></td>
                        <td width="15%"></td>
                        <td width="30%">
                            <button class='btn-default btn btn-sm' type='button' data-toggle="modal"
                                    data-target="#myModal" style="float:right;">Log Surat
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top;">Komentar</td>
                        <td colspan='4'><textarea name='komentar_kapushidrosal' class='form-control'></textarea></td>
                    </tr>
                    <tr>
                        <!-- ZAME -->
                        <td style="vertical-align: top;">Tanda Tangan</td>
                        <!-- /***********************************************
                             ** Feature Signature
                             ** By: Muhamad Farhan Badrussalam
                             ***********************************************/ 
                             -->
                        <td colspan="1">
                            <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#buat_baru" onclick="document.getElementById('status_ttd').value = '0';">Buat Baru</a></li>
                              <li><a data-toggle="tab" href="#ambil_ttd" onclick="document.getElementById('status_ttd').value = '1';">Ambil Data</a></li>
                            </ul>
                            <input type="text" name="status_ttd" id="status_ttd" value="0" hidden="hidden">
                        <div class="tab-content">
                            <div id="buat_baru" class="tab-pane fade in active">
                              <div id="signature-pad" class="signature-pad">
                                <div class="signature-pad--body">
                                  <canvas></canvas>
                                </div>
                                <div class="signature-pad--footer">

                                  <div class="signature-pad--actions">
                                    <div>
                                      <button type="button" class="button clear" data-action="clear">Clear</button>
                                      <button style="display:none;" type="button" class="button" data-action="change-color">Change color</button>
                                      <button type="button" class="button" data-action="undo">Undo</button>
                                    </div>
                                    <div>
                                      <button type="button" class="button save" data-action="save-png">Tanda Tangan Sudah Benar</button>
                                      <button style="display:none;" type="button" class="button save" data-action="save-jpg">Save as JPG</button>
                                      <button style="display:none;" type="button" class="button save" data-action="save-svg">Save as SVG</button>
                                    </div>
                                  </div>
                                </div>
                                <div id="status_download" style="display: none;">
                                    <a id="download_image" href="" download> Download Tanda Tangan </a>
                                </div>
                              </div>
                            </div>
                          
                            <div class="form-control tab-pane fade" id="ambil_ttd" style="width: 100%;height: 300px;">
                                <div>
                                    <img src="" id="img_ambil_ttd" style="height: 240px; width: 100%;">
                                </div>
                                <div>
                                    <center><input type="file" name="file_ambil" id="file_ambil" tabindex="11" class="form-control" style="width: 270px;"></center>
                                </div>
                            </div>
                        </div>
                        </td>
                        <!--

			<img src="data:image/png;base64,<?= $signature ?>"/> -->

                    </tr>
                    <tr>
                        <td colspan='5'>

                            <!-- <button type="submit" tabindex="11" style="float:right;margin-left:10px;"
                                    class="btn btn-success"
                                    onclick="document.getElementById('signatureJSON').value = document.getElementById('signatureJSON').value.replace('data:image/png;base64,','');">
                                Setuju
                            </button> -->
                            <button type="submit" tabindex="11" style="float:right;margin-left:10px;"
                                    class="btn btn-success" >
                                Setuju
                            </button>
    </form>
    <form action="<?php echo base_URL() ?>admin/surat_keluar/<?php echo $act; ?>" method="post" accept-charset="utf-8"
          enctype="multipart/form-data" id="formnya">
        <button type="submit" class="btn btn-primary" tabindex="10" style="float:right">Koreksi</button>
    </form>
    </td>
    </tr>
    </table>
    </div>
    </div>
    
    <script type="text/javascript">
        /***********************************************
         ** Feature Signature
         ** By: Muhamad Farhan Badrussalam
         ***********************************************/ 
         function handleFileSelect(evt){
            var files = evt.target.files; // FileList object

            // console.log(files);
            // FileReader support
            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = function () {
                    document.getElementById("img_ambil_ttd").src = fr.result;
                }
                fr.readAsDataURL(files[0]);
            }
         }
         document.getElementById("file_ambil").addEventListener('change',handleFileSelect,false);
        // $('#file_ambil').change(function () {
        //     document.getElementById("img_ambil_ttd").src = "<?php echo base_URL() ?>upload/ttd/"+this.files[0].name;
        // });
    </script>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" style="width:70% !important;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background:#194896;color:white;font-weight:bold;text-align:center;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Log Surat</h4>
                </div>
                <div class="modal-body">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Satker</th>
                            <th>Tanggal Proses</th>
                            <th>Keterangan</th>
                            <th>Komentar</th>
                            <th>Proses</th>
                        </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>
                        <?php $azx = 1;
                        foreach ($log_surat_keluarnya as $m) {
                            $dt3 = date_create($m->tanggal_proses);
                            $dt4 = date_format($dt3, "d-m-Y H:i");
                            echo "<tr>
						<td>$azx</td>
						<td>$m->nama_lengkap</td>
						<td>$dt4</td>
						<td>$m->Keterangan</td>
						<td>$m->komentar</td>
						<td>$m->nama_proses</td>
					</tr>";
                            $azx += 1;
                        } ?>
                        </tbody>
                    </table>
                    <script>
                        $(document).ready(function () {
                            $('#example').DataTable();
                        });
                    </script>
                </div>
            </div>

        </div>
    </div>
    </form>


<?php } else if ($mode!="add" and $this->session->userdata('admin_jabatan') == 2 and $status_surat == 5) { ?>
    <form action="<?php echo base_URL() ?>admin/surat_keluar/verifikasi_submit_setum/" method="post"
          accept-charset="utf-8" enctype="multipart/form-data" id="formnya" class="form-5">
        <script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
        <script src='https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js'></script>
        <script>
            $('head').append('<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"">');
        </script>
        <div class="navbar navbar-inverse">
            <div class="container z0">
                <div class="navbar-header">
                    <span class="navbar-brand" href="#">Verifikasi Konsep</span>
                </div>
            </div><!-- /.container -->
        </div>
        <div class="row-fluid well" style="overflow: hidden">
            <div class="col-lg-12">
                <table width="100%" class="table-form">
                    <tr>
                        <td width="15%"></td>
                        <td width="30%"></td>
                        <td width="10%"></td>
                        <td width="15%"></td>
                        <td width="30%">
                            <button class='btn-default btn btn-sm' type='button' data-toggle="modal"
                                    data-target="#myModal" style="float:right;">Log Surat
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top;">Komentar</td>
                        <td colspan='4'><textarea id="komentar_setum" name='komentar_setum'
                                                  class='form-control'></textarea></td>
                        <input type="hidden" id="ids" name="ids" value="<?= $idp ?>" tabindex="11" class="form-control"
                               style="width: 200px">
                    </tr>
                    <tr>
                        <td style="vertical-align:top;">File Revisi</td>
                        <td colspan='4'><input type="file" id="revisi" name="file_revisi" tabindex="11"
                                               class="form-control" style="width: 200px">*Upload file data type document
                        </td>
                    </tr>
                    <tr>

                        <?php if ($mode != "show" and $mode != "edt" and $mode != "verifikasi_surat_keluar") { ?>
                            <td><a class="btn btn-default btn-sm" id="generate_no">Generate Nomor Lampiran</a></td>
                            <td><input type='text' tabindex='2' name='no_lampiran' id='no_lampiran' style=''
                                       class='form-control'></td>
                            <td><a href="" target="_blank" id="cetak_no_lampiran" class="btn btn-default btn-sm">Cetak
                                    Nomor</a></td>
                        <?php } else { ?>
                            <td></td>
                            <td></td>
                            <td></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td colspan='5'>
                            <a href="#" tabindex="11" style="float:right;margin-left:10px;" class="btn btn-success" id="ver_setuju_setum">Setuju</a>
                            <input type="hidden" name="no_surat_form5" class="form-5-no-surat" />
                            <a class="koreksi-form-5 btn btn-primary" tabindex="10" style="float:right">Koreksi
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
    <script>
    $("#ver_setuju_setum").click(function () {
        var kapwak = $("#kirim_kpd").val();
        var komen = document.getElementById("komentar_setum").value;
        
        if ($('#warning_nosu').is(':visible')) {
            alert("No surat sudah ada.");
        }else{
            if(kapwak==""){
                alert("Dikirimkan Kepada Harus Diisi.");
            }else{
                $.ajax({
                    method: 'post',
                    url: "<?php echo base_URL()?>admin/surat_keluar/verifikasi_submit_setum_setuju/<?= $idp ?>",
                    data: {isi: kapwak, keterangan:komen}, success: function (result) {
                        // $("#combobox").html(result);
                        console.log(result);
                        window.location.assign("<?php echo base_url();?>admin/surat_keluar/");
                        // $(".custom-combobox-input").val($("#nama_tambah_tujuan").val());
                    }, error: function () {
                        // alert("Gagal menambahkan tujuan");
                        console.log("Gagal");
                    }
                });
            }
        }
    });
		$(".koreksi-form-5").on('click', function(){
			$(".form-5-no-surat").val($("input[name='no_surat']").val());
			$(".form-5").submit();
		});
	</script>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" style="width:70% !important;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background:#194896;color:white;font-weight:bold;text-align:center;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Log Surat</h4>
                </div>
                <div class="modal-body">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Satker</th>
                            <th>Tanggal Proses</th>
                            <th>Keterangan</th>
                            <th>Komentar</th>
                            <th>Proses</th>
                        </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>
                        <?php $azx = 1;
                        foreach ($log_surat_keluarnya as $m) {
                            $dt5 = date_create($m->tanggal_proses);
                            $dt6 = date_format($dt5, "d-m-Y H:i");
                            echo "<tr>
						<td>$azx</td>
						<td>$m->nama_lengkap</td>
						<td>$dt6</td>
						<td>$m->Keterangan</td>
						<td>$m->komentar</td>
						<td>$m->nama_proses</td>
					</tr>";
                            $azx += 1;
                        } ?>
                        </tbody>
                    </table>
                    <script>
                        $(document).ready(function () {
                            $('#example').DataTable();
                        });
                    </script>
                </div>
            </div>

        </div>
    </div>


<?php } else if ($mode!="add" and $this->session->userdata('admin_jabatan') == 2 and $status_surat == 7) { ?>
    <form action="<?php echo base_URL() ?>admin/surat_keluar/verifikasi_submit_setum/" method="post"
          accept-charset="utf-8" enctype="multipart/form-data" id="formnya">
        <script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
        <script src='https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js'></script>
        <script>
            $('head').append('<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"">');
        </script>

    <!--    <div class="navbar navbar-inverse">
            <div class="container z0">
                <div class="navbar-header">
                    <span class="navbar-brand" href="#">Verifikasi Konsep</span>
                </div>
            </div><!-- /.container
        </div> -->

        <div class="row-fluid well" style="overflow: hidden">
            <div class="col-lg-12">
                <table width="100%" class="table-form">
                    <tr>
                        <td width="15%"></td>
                        <td width="30%"></td>
                        <td width="10%"></td>
                        <td width="15%"></td>
                        <td width="30%">
							<a style="float:right;" target="_blank" href="<?= base_URL(); ?>admin/cetak_log_surat_keluar/<?php echo $idp; ?>"
							class="btn btn-info btn-sm"><i class="icon-print icon-white"> </i> Cetak Detil Tembusan</a>

                            <button class='btn-default btn btn-sm' type='button' data-toggle="modal"
                                    data-target="#myModal" style="float:right;">Log Surat
                            </button>&nbsp

                        </td>
                    </tr>

                     <tr>
                        <td width="20%"
                            style="vertical-align:top;"><?php if (isset($datpil->create_by) and $datpil->create_by != $this->session->userdata('admin_id')) { ?>Tembusan<?php } ?></td>

                        <td colspan="4">
                            <table class="table table-bordered" id="tembusan_table" style="text-align:center;">
                                <tr>
                                    <td>No</td>
                                    <td>Jabatan</td>
                                    <td>Status</td>
                                    <td>Keterangan</td>
                                    <td>Aksi</td>
                                </tr>
                                <?php
                                $count = 1;

                                foreach ($datpil_tembusan as $aa) {
                                    if ($aa->status == 0) {
                                        $asd = "background:#9b9389";
                                        $qwe = "background:#9b9389";
                                    } else if ($aa->status == 1) {
                                        $asd = "background:#9b9389";
                                        $qwe = "background:#97310e";
                                    } else if ($aa->status == 2) {
                                        $asd = "background:#97310e";
                                        $qwe = "background:#9b9389";
                                    }
                                    echo "
                            <tbody>
                                <tr  id='remdeb".$count."' style='vertical-align:top;'>
                                    <td>" . $count . "</td>
                                    <td>" . $aa->nama_jabatan . "</td>
                                    <td>";

                                        echo "<div class='col-md-12'><a class='btn-default btn btn-xs status_tembusan_setuju status_tembusan_setuju" . $aa->idnya_tembusan . "' style='; $asd' status_tembusan='" . $aa->idnya_tembusan . "'>Setuju</a></div>";

                                    echo "</td>";
                                    if ($this->session->userdata('admin_id') == $datpil->create_by) {
                                        $tembusan_hidden_show = "";
                                    } else if ($aa->idnya_jabatan != $this->session->userdata('admin_jabatan')) {
                                        $tembusan_hidden_show = "style='display:none;'";
                                    } else {
                                        $tembusan_hidden_show = "";
                                    }
                                    echo "
                                    <td><textarea name='keterangan_tembusan[]' class='form-control' $tembusan_hidden_show>" . $aa->keterangan . "</textarea></td>";
                                     "
                                      <td> <a class='btn btn-danger' onclick='removeDB(". $count .",". $aa->id .",". $aa->idnya_tembusan .",&#39;". $aa->nama_jabatan ."&#39;)'>HAPUS</a></td>
                                        </tr>
                            </tbody>";
                                    $count += 1;
                                }
                                ?>
                            </table>
                        </td>
                    </tr>

                </table>
            </div>
        </div>
    </form>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" style="width:70% !important;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background:#194896;color:white;font-weight:bold;text-align:center;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Log Surat</h4>
                </div>
                <div class="modal-body">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Satker</th>
                            <th>Tanggal Proses</th>
                            <th>Keterangan</th>
                            <th>Komentar</th>
                            <th>Proses</th>
                        </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>
                        <?php $azx = 1;
                        foreach ($log_surat_keluarnya as $m) {
                            $dt7 = date_create($m->tanggal_proses);
                            $dt8 = date_format($dt7, "d-m-Y H:i");
                            if($m->id_proses==1){
                                // if($kirim_ke==1){
                                    $pr = "Verifikasi ".$m->nama_lengkap;
                                // }else{
                                //     $pr = "Verifikasi WAKAPUSHIDROSAL";
                                // }
                            }else{
                                $pr = $m->nama_proses;
                            }
                            echo "<tr>
						<td>$azx</td>
						<td>$m->nama_lengkap</td>
						<td>$dt8</td>
						<td>$m->Keterangan</td>
						<td>$m->komentar</td>
						<td>$pr</td>
					</tr>";
                            $azx += 1;
                        } ?>
                        </tbody>
                    </table>
                    <script>
                        $(document).ready(function () {
                            $('#example').DataTable();
                        });
                    </script>
                </div>
            </div>

        </div>
    </div>
<?php } ?>
<?php if($mode != "add"){ ?>
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

                            <?php $chat = $this->db->query('SELECT  a.pengirim, a.pesan_feedback, a.created_at, a.waktu, b.id, b.nama_jabatan from notadinas.feedback_surat_keluar a, notadinas.master_jabatan b where a.pengirim = b.id AND id_surat_keluar ='.$idp.' ORDER BY a.id_feedkel')->result(); 

                                foreach ($chat as $key => $res) {
                                 
                            ?>

                         
                          <div class="media-body">

                            <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
                            <div class="col-md-12">
                            <div class="row">
                            <div class="col-md-6">

                                <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
                                <p class="media-heading"><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span class="pull-right"><?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></span> </p> 
                                <?php } ?>

                                <p class="pull-left" style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background: #FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?> <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){ ?> <sub style="color: #555";>&nbsp; <?= date('H:i',strtotime($res->waktu)) ?></sub> <?php } ?></p>
                            </div>
                            </div>

                            </div>

                            <?php }else{ ?>

                            <div class="col-md-12">
                            <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-5">
                                <?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>

                                <p><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span class="pull-right"><?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></span> </p> 

                                <?php } ?>

                                <p class="pull-right" style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background:#FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?>  <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){ ?> <sub style="color: #555";>&nbsp; <?= date('H:i',strtotime($res->waktu)) ?></sub> <?php } ?></p>
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
                        <textarea class="form-control" id="pesan_feedback" name="pesan_feedback"></textarea>
                        <br>
                       <center> <button type="button" id="feedback" class="btn btn-info">KIRIM</button></center>
                    </form>
                    </div>
                </div>     
             </div>
        </div>
     </div>
     <?php } ?>
<!--
<form id="formRevisi" method="post" enctype="multipart/form-data">
	<div class="row-fluid well" style="overflow: hidden">
	<div class="col-lg-12">
	<table width="100%" class="table-form">
		<tr>
			<td width="15%"></td>
			<td width="30%"></td>
			<td width="10%"></td>
			<td width="15%"></td>
			<td width="30%">
				<button class='btn-default btn btn-sm' type='button' data-toggle="modal" data-target="#myModal" style="float:right;">Log Surat</button>
			</td>
		</tr>
		</tr>
		<tr>
				<td style="vertical-align:top;">Komentar</td>
				<td colspan='4'><textarea id="komen1" name='komentars' class='form-control'></textarea></td>
		</tr>
		<tr>
				<td style="vertical-align:top;">Revisi File</td>
				<td>
					<input type="file"  name="file_attachment" tabindex="11" class="form-control" style="width: 200px">
				</td>
				<td></td>
				<td></td>
		</tr>
		<tr>
			<td colspan='5'>
				<a href="<?php echo base_URL() ?>admin/surat_keluar/verifikasi_submit_setum_setuju/<?= $idp ?>" tabindex="11" style="float:right;margin-left:10px;" class="btn btn-success">Setuju</a>
				<button type="" class="btn btn-primary" tabindex="10" style="float:right">Koreksi</button>
			</td>
		</tr>
	</table>
	</div>
    </div>
</form>
 -->

<script type="text/javascript">
    $('#feedback').on('click',function () {
                        var msg = $('#pesan_feedback').val();
                        var ids = <?php echo ($idp != "") ? $idp : "0"; ?>;

                        $.post('<?= base_url().'administrator/feedbacksuratkel' ?>',{pesan:msg,id:ids},function (data) {

                            $('#pesan_feedback').val('');
                            $('.media').load('<?= base_URL()."admin/surat_keluar/show/"  ?>'+ids+' .media');
                        });
                    });
    $('#tgl_surat').datepicker({dateFormat: 'dd-mm-yy'}).val();
    $('#tanggal_ijin').datepicker({dateFormat: 'dd-mm-yy'}).val();

    $(document).ready(function () {
        $('input[type=file]').change(function () {
            var val = $(this).val().toLowerCase();
            var regex = new RegExp("(.*?)\.(gif|jpg|png|pdf|doc|docx)$");
            // if (!(regex.test(val))) {
                // $(this).val('');
                // alert('Tipe file salah!  Pilih: gif / jpg / png / pdf / doc / docx');
            // }
        });
    });


</script>

<script type="text/javascript">
    $('#defaultSignature').signature();

    $('#removeSignature').click(function () {
        var destroy = $(this).text() === 'Remove';
        $(this).text(destroy ? 'Re-attach' : 'Remove');
        $('#defaultSignature').signature(destroy ? 'destroy' : {});
    });

    $('#disableSignature').click(function () {
        var enable = $(this).text() === 'Enable';
        $(this).text(enable ? 'Disable' : 'Enable');
        $('#defaultSignature').signature(enable ? 'enable' : 'disable');
    });


    $('#captureSignature').signature({syncField: '#signatureJSON'});

    $('#png').click(function () {
        document.getElementById("captureSignature").style.display = "";
    });

    $('#clear2Button').click(function () {
        $('#captureSignature').signature('clear');
    });

    $('input[name="syncFormat"]').change(function () {
        var syncFormat = $('input[name="syncFormat"]:checked').val();
        $('#captureSignature').signature('option', 'syncFormat', syncFormat);
    });

    $('#svgStyles').change(function () {
        $('#captureSignature').signature('option', 'svgStyles', $(this).is(':checked'));
    });


    $("#koreksi_setum").click(function () {
        var komen = document.getElementById("komentar_setum").value;
        var revisi = document.getElementById("revisi").value;
        var id = document.getElementById("ids").value;

        $.ajax({
            type: "POST",
            url: "<?= base_url() . "admin/surat_keluar/verifikasi_submit_setum/" ?>",
            data: {komentar: komen, file_revisi: revisi, id: id},
            dataType: "text",
            enctype: "multipart/form-data",
            cache: false,
            success:
                function (data) {
                    window.location.href = "<?= base_url() . "admin/surat_keluar/" ?>";
                    //alert(data);
                }
        });// you have missed this bracket
        return false;
    });

    $('#formRevisi').submit(function (e) {
        e.preventDefault();

        // var komens = document.getElementById("komen1").value;
        //    var revisi = document.getElementById("revisi").value;
        //    var id = document.getElementById("ids").value;


        $.ajax({
            url: '<?= base_URL() . "administrator/cek_data" ?>',
            type: "post",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function (data) {
                console.log(data);
            }
        });


    });

</script>

<!-- <script src="https://cloud.tinymce.com/stable/jquery.tinymce.min.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>aset/tinymce/jquery.tinymce.min.js"></script> -->
<script src="<?php echo base_url(); ?>aset/tinymce/tinymce.min.js"></script>
<!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script> -->

<script type="text/javascript">
        tinymce.init({
            selector: '#isi_surat',
            theme: "modern",
            width: 800,
            height: 400,
            relative_urls: false,
            remove_script_host: false,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager code"
            ],
            toolbar: "insertfile undo redo pastetext | styleselect | sizeselect | bold italic | fontselect | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | responsivefilemanager | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ],
            fontsize_formats: "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 24pt 36pt",
            external_filemanager_path:"<?php echo base_url()?>/filemanager/",
            filemanager_title:"Responsive Filemanager" ,
            external_plugins: { "filemanager" : "<?php echo base_url()?>/filemanager/plugin.min.js"},
            branding: false
        });
</script>

<script>
    function get_template_surat() {
        var jenis_surat = $('#jenis_surat').val();
        $.ajax({
            method: "POST",
            url: "<?php echo site_url('admin/get_surat_template')?>",
            data: { jenis_surat: jenis_surat }
        })
            .done(function( msg ) {
                console.log(msg)
                tinyMCE.get('isi_surat').setContent(JSON.parse(msg));
            });
    }
</script>

<script src="<?php echo base_url(); ?>aset/js/signature_pad.umd.js"></script>
<script src="<?php echo base_url(); ?>aset/js/app_sig.js"></script>
