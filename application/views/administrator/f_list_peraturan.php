<div class="navbar navbar-inverse">
    <div class="container z0">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">List Buku</span>
        </div>
    </div><!-- /.container -->
</div>

<form action="<?php echo base_URL() ?>administrator/master_kategori/save" method="post" id="formnya">
    <div class="row-fluid well" style="overflow: hidden">
        <?php
        function create_table($data) {
            $res = '<table width="1100" height="300">';
            $max_data = sizeof($data);
            $ctr = 1;
            foreach ($data as $db_data) {
                if ($ctr % 2 == 0) $res .= '<td align="center" style="padding-bottom: 30px;"><a href="'.site_url('admin/detail_peraturan/'.$db_data->id_doktrin.'').'" style="cursor: pointer; text-decoration:none; color: black !important"><img width="80px" height="83px" src="'.site_url('upload/master_doktrin/cover/'. $db_data->file_cover.'').'" /><br><br>' . $db_data->judul_peraturan. '</a></td></tr>';
                else {
                    if ($ctr < $max_data) $res .= '<tr><td align="center"><a href="'.site_url('admin/detail_peraturan/'.$db_data->id_doktrin.'').'" style="cursor: pointer; text-decoration:none; color: black !important"><img width="80px" height="83px" src="'.site_url('upload/master_doktrin/cover/'. $db_data->file_cover.'').'" /><br><br>' . $db_data->judul_peraturan. '</td>';
                    else $res .= '<tr><td colspan="2" align="center"><a href="'.site_url('admin/detail_peraturan/'.$db_data->id_doktrin.'').'" style="cursor: pointer; text-decoration:none; color: black !important"><img width="80px" height="83px" src="'.site_url('upload/master_doktrin/cover/'. $db_data->file_cover.'').'" /><br><br>' . $db_data->judul_peraturan. '</td></tr>';
                }
                $ctr++;
            }
            return $res . '</table>';
        }
        echo create_table($data);


        ?>
    </div>
</form>
<script>
    $('#proses').click(function () {
        $('#formnya').submit();
    });

</script>
