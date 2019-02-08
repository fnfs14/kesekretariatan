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
    if ($mode == "verifikasi_surat_keluar") {
        if ($this->session->userdata('admin_jabatan') == 1) {
            $act = 'verifikasi_submit_kapushidrosal/' . $idp;
        } elseif ($this->session->userdata('admin_satuan') == 6) {
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
}
if ($this->session->userdata('admin_satuan') == 6) {
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
<script src="<?= base_url() ?>aset/js/jquery.signature.min.js"></script>
<script src="<?= base_url() ?>aset/js/jquery/jquery.ui.touch-punch.min.js"></script>
<link type="text/css" href="<?= base_url() ?>aset/css/jquery.signature.css" rel="stylesheet">

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
                $(".custom-combobox-input").val($("#nama_tambah_tujuan").val());
            }, error: function () {
                alert("Gagal menambahkan tujuan");
            }
        });
        $("#myModal123").modal("hide");
    });
</script>
<form action="<?php echo base_URL() ?>admin/surat_keluar/update_new_message" method="post" accept-charset="utf-8"
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
                    <td></td>
                    <td width="15%">Tanggal Surat</td>
                    <td width="30%"><b><input type="text" tabindex="2" name="tgl_surat" required
                                              value="<?php echo $tgl_surat; ?>" id="tgl_surat" style=""
                                              class="form-control" required></b></td>
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
                    <td><b><input readonly type="text" tabindex="3" name="no_surat" required
                                  value="<?= (isset($generated_no_surat)) ? $generated_no_surat : $no_surat; ?>"
                                  style="" class="form-control"></b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
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
					<script>
            $("#generate_no").click(function(){
                // alert(document.getElementById("filenya").files[0].name);
                $.ajax({
                    method: 'post',
                    url:"<?php echo base_url(); ?>admin/generate_filename?q=1",
                    success: function(result) {
                        var a = new Date();
                        $("#no_lampiran").attr("value","SK-" + result + "-" + a.getFullYear());
                        $("#cetak_no_lampiran").attr("href","<?php echo base_URL(); ?>admin/cetak_no_lampiran/ND-" + result + "-" + a.getFullYear());
                    },
                    error: function(){
                        alert("Terjadi Kesalahan");
                    }

                });
            });
         </script>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Keterangan</td>
                    <td colspan="4"><b><textarea tabindex="7" name="ket" required style="" rows="5"
                                                 class="form-control"><?php echo $ket; ?></textarea></b></td>
                </tr>
				
				<?php if ($mode!="add" and $this->session->userdata('admin_satuan') == 6){ ?>
                <?php if ($datpil->status_surat_keluar == 4) { ?>
                        <tr>
							<td style="vertical-align: top;">Komentar Kapushidrosal</td>
							<td colspan="4"><b><textarea tabindex="7" name="komen" readonly style="" rows="5"
														 class="form-control"><?php echo $komen; ?></textarea></b></td>
						</tr>
                <?php } ?>
				<?php } ?>
				


                <?php //if ($this->session->userdata('admin_satuan') != 6) { ?>


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
								<tr id='remove$count' style='vertical-align:top;'>
									<td>" . $count . "</td>
									<td>" . $aa->nama_jabatan . "</td>
									<td>";
                                    echo "</td>";
                                    if ($this->session->userdata('admin_id') == $datpil->create_by) {
                                        $tembusan_hidden_show = "";
										if($this->session->userdata('admin_satuan')==6){
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
                                    echo "
									<td style='text-align:left;'>$aa->keterangan</td>";
                                    echo "	<td><a class='btn btn-danger' onclick='removeD(". $count .",". $aa->idnya_tembusan .")'>HAPUS</a></td>
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
                if ($datpil->status_surat_keluar == 3) {
                    echo "
		<tr>
			<td style='vertical-align:top;'>Komentar</td>
			<td colspan='4'><textarea name='komentar_kapushidrosal' class='form-control' disabled>$lognya->komentar</textarea></td>
		</tr>
			"; ?>
                    <tr>
                        <td style="vertical-align:top;">File Koreksi</td>
                        <td colspan="4"><a
                                    href="<?php echo base_URL(); ?>upload/surat_keluar/<?php echo $lognya->file_revisi; ?>"
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
                    <td></td>
                </tr>
				<tr>
					<td colspan="5">
						<input type="submit" value="Simpan" class="btn btn-primary" style="float:right;" />
					</td>
				</tr>
            </table>
            <script>
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


                function removeD(e,z) {
                    $('#remove' + e).remove();
					$(".idstatustembusan" + z).remove();
					$(".idjabatantembusan" + z).remove();
                    // $('#tembusan_input').remove();
                }
            </script>
        </div>

    </div>
</form>


<?php if ($this->session->userdata('admin_jabatan') == 1) { ?>
    <form action="<?php echo base_URL() ?>admin/surat_keluar/verifikasi_submit_kapushidrosal_setuju/<?= $idp ?>"
          method="post" accept-charset="utf-8" enctype="multipart/form-data" id="formnya">
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
                        <td colspan='4'><textarea name='komentar_kapushidrosal' class='form-control'></textarea></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Tanda Tangan</td>
                        <td colspan="4">


                            <div id="captureSignature" class="kbw-signature">
                                <canvas width="200" height="170" placeholder="au">Your browser doesn't support signing
                                </canvas>
                            </div>
                            <input id="signatureJSON" rows="5" cols="50" type="hidden" class="ui-state-active"
                                   name="signature">

                            <p>
                                <button type="button" id="clear2Button">Clear</button>

                                <label><input id="png" type="radio" name="syncFormat" value="PNG"> Menampilkan Tanda
                                    Tangan Digital</label>

                            </p>
                        </td>
                        <!--
		
			<img src="data:image/png;base64,<?= $signature ?>"/> -->

                    </tr>
                    <tr>
                        <td colspan='5'>

                            <button type="submit" tabindex="11" style="float:right;margin-left:10px;"
                                    class="btn btn-success"
                                    onclick="document.getElementById('signatureJSON').value = document.getElementById('signatureJSON').value.replace('data:image/png;base64,','');">
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
                            echo "<tr>
						<td>$azx</td>
						<td>$m->nama_lengkap</td>
						<td>$m->tanggal_proses</td>
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
          accept-charset="utf-8" enctype="multipart/form-data" id="formnya">
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
                        <td colspan='4'><textarea id="komentar_kapushidrosal" name='komentar_kapushidrosal'
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
                            <a href="<?php echo base_URL() ?>admin/surat_keluar/verifikasi_submit_setum_setuju/<?= $idp ?>"
                               tabindex="11" style="float:right;margin-left:10px;" class="btn btn-success">Setuju</a>
                            <button type="submit" class="btn btn-primary" tabindex="10" style="float:right">Koreksi
                            </button>
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
                            echo "<tr>
						<td>$azx</td>
						<td>$m->nama_lengkap</td>
						<td>$m->tanggal_proses</td>
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
                            echo "<tr>
						<td>$azx</td>
						<td>$m->nama_lengkap</td>
						<td>$m->tanggal_proses</td>
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
        var komen = document.getElementById("komentar_kapushidrosal").value;
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

<script src="<?php echo base_url(); ?>aset/tinymce/jquery.tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>aset/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
    $(function () {
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
    })
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

<?php
// if($status_surat==0 or $status_surat==3 or $status_surat==8){
$log = $this->db->query("SELECT * FROM notadinas.log_proses_surat_keluar INNER JOIN notadinas.master_proses_surat_keluar ON notadinas.log_proses_surat_keluar.id_proses = notadinas.master_proses_surat_keluar.id INNER JOIN notadinas.master_user ON notadinas.master_user.id = notadinas.log_proses_surat_keluar.pengirim WHERE log_proses_surat_keluar.id_suratkeluar = $idp ORDER BY notadinas.log_proses_surat_keluar.id ASC")->result();
$keteranganZ = "";
?>
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
								data-target="#myModalZ" style="float:right;">Log Surat
						</button>
					</td>
				</tr>
				<tr>
					<td style="vertical-align:top;">Komentar</td>
					<td colspan='4'><textarea id='komentar_kapushidrosalZ' class='form-control'></textarea></td>
				</tr>
			</table>
		</div>
	</div>
    <div class="modal fade" id="myModalZ" role="dialog">
        <div class="modal-dialog" style="width:70% !important;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background:#194896;color:white;font-weight:bold;text-align:center;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Log Surat</h4>
                </div>
                <div class="modal-body">
                    <table id="exampleZ" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                        foreach ($log as $m) {
                            echo "<tr>
						<td>$azx</td>
						<td>$m->nama_lengkap</td>
						<td>$m->tanggal_proses</td>
						<td>$m->Keterangan</td>
						<td>$m->komentar</td>
						<td>$m->nama_proses</td>
					</tr>";
                            $azx += 1;
							if($m->komentar!='' and $m->komentar!=null and $m->komentar!="''"){
								 $keteranganZ .= $m->komentar;
							}
                        } ?>
                        </tbody>
                    </table>
                    <script>
                        $(document).ready(function () {
                            $('#exampleZ').DataTable();
                        });
                    </script>
                </div>
            </div>

        </div>
    </div>
	<script>
	$("#komentar_kapushidrosalZ").html("<?= $keteranganZ; ?>");
	</script>
<?php 
// } 
?>