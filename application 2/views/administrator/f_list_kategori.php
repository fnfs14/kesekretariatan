<div class="navbar navbar-inverse">
    <div class="container z0">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">List Kategori</span>
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
                if ($ctr % 2 == 0) $res .= '<td align="center" style="padding-bottom: 30px;"><a href="'.site_url('administrator/list_peraturan/'.$db_data->id_kategori.'').'" style="cursor: pointer; text-decoration:none; color: black !important"><img width="80px" height="83px" src="'.site_url('aset/img/folder.jpg').'" /><br><br>' . $db_data->nama_kategori. '</a></td></tr>';
                else {
                    if ($ctr < $max_data) $res .= '<tr><td align="center"><a href="'.site_url('administrator/list_peraturan/'.$db_data->id_kategori.'').'" style="cursor: pointer; text-decoration:none; color: black !important"><img width="80px" height="83px" src="'.site_url('aset/img/folder.jpg').'" /><br><br>' . $db_data->nama_kategori. '</td>';
                    else $res .= '<tr><td colspan="2" align="center"><a href="'.site_url('administrator/list_peraturan/'.$db_data->id_kategori.'').'" style="cursor: pointer; text-decoration:none; color: black !important"><img width="80px" height="83px" src="'.site_url('aset/img/folder.jpg').'" /><br><br>' . $db_data->nama_kategori. '</td></tr>';
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
