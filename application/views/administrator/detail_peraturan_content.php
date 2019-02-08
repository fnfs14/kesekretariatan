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
            <?php foreach ($peraturan as $item) { ?>
                <table width="100%" class="table-form">
                    <tr>
                        <td style="float: left !important;">
                            <a tabindex="11" style="float:right;" class="btn btn-success" id="proses" href="<?php echo site_url('administrator/list_peraturan/'.$item->id_kategori.'')?>">
                                Kembali
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="4" width="400px">
                            <center>
                                <?php if ($item->file_cover !== '') { ?>

                                    <img width="300px"; height="300px;" src="<?php echo site_url('upload/master_doktrin/cover/'.$item->file_cover.'')?>">
                                    <br>
                                    <label><?php echo $item->nama_buku?></label>
                                <?php } else { ?>
                                    <img src="<?php echo site_url('upload/no-image.jpg')?>"><br>
                                    <label><?php echo $item->nama_buku?></label>

                                <?php } ?>
                            </center>
                            <br>
                        </td>
                        <td>
                            <center>Deskripsi Peraturan </center> <br>
                            <textarea  style="resize: vertical" class="form-control" rows="10" name="deskripsi_peraturan"><?php echo $item->deskripsi_peraturan; ?></textarea>

                        </td>
                    </tr>
                </table>
            <?php } ?>
            <br/><a tabindex="11" style="float:right;" class="btn btn-success" id="proses" href="<?php echo site_url('admin/view_peraturan/'.$item->id_doktrin.'')?>">
                View
            </a>
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
