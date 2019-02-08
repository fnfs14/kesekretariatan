<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        return !(charCode > 31 && (charCode < 48 || charCode > 57));
    }
</script>
<div class="navbar navbar-inverse">
    <div class="container z0">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Detail Peraturan</span>
        </div>
    </div><!-- /.container -->
</div>

<div class="row-fluid well" style="overflow: hidden">
    <div class="col-lg-12">
        <center>
            <?php foreach ($peraturan as $item) {
//                var_dump($item);die();
                ?>
                <table width="100%" class="table-form">
                    <tr>
                        <td style="float: left !important;">
                            <a tabindex="11" style="float:right;" class="btn btn-success" id="proses" href="<?php echo site_url('admin/detail_peraturan/'.$item->id_doktrin.'')?>">
                                Kembali
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <center>
                                <?php if(!empty($item->file)){ ?>
                                <iframe src="<?php echo site_url('upload/master_doktrin/'.$item->file.'')?>" width="100%" height="650px;">
                                    Browser ini tidak mendukung PDF. Tolong Unduh PDF untuk melihat ini: <a href="<?php echo site_url('upload/master_doktrin/'.$item->file.'')?>">Unduh Dokumen</a><!--ubah mei bahasa-->
                                </iframe>
                                <?php } else { ?>
                                    Tidak ada file
                                <?php }?>
                            </center>
                            <br>
                        </td>

                    </tr>
                </table>
            <?php } ?>
        </center>
    </div>
</div>

<script>
    $('#proses').click(function () {
        $('#formnya').submit();
    });

    $(document).ready(function () {
        $("#tanggal").datepicker({
            dateFormat: 'dd/mm/yy'
        });
    })

</script>
