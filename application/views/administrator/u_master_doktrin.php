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
<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        return !(charCode > 31 && (charCode < 48 || charCode > 57));
    }
</script>
<div class="navbar navbar-inverse">
    <div class="container z0">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Master Doktrin</span>
        </div>
    </div><!-- /.container -->
</div>

<form action="<?php echo base_URL() ?>admin/master_doktrin/update" method="post" id="formnya"
      enctype="multipart/form-data">
    <div class="row-fluid well" style="overflow: hidden">
        <div class="col-lg-12">
            <!-- <center> -->
                <table width="100%" class="table-form">
                    <?php foreach ($data as $data2): ?>
                        <tr>
                            <td rowspan="4">
                                1. Upload File Doktrin: <input type="file" name="file" id="file"><br>
                                <?php if (isset($data2->file)): ?>
                                    <a href="<?php echo site_url("upload/master_doktrin/" . $data2->file . "") ?>"><?php echo $data2->file ?></a>
                                <input type="hidden" value="<?php echo $data2->file ?>" name="file_hidden">

                                <?php endif; ?><br><br>
                                        2. Upload Cover File Doktrin (File yang diperbolehkan: <b>*.jpg,  *.jpeg, *.png, *.bmp</b>): <input type="file" name="file_cover" id="file_cover">
                                        <?php if (isset($data2->file_cover)): ?>
                                        <a href="<?php echo site_url("upload/master_doktrin/cover/" . $data2->file_cover . "") ?>"><?php echo $data2->file_cover ?></a><input type="hidden" value="<?php echo $data2->file_cover ?>" name="file_cover_hidden">
                                            <?php endif; ?>

                            </td>
                            <td style="text-align: left;padding-left: 10px;">ID Buku</td>
                            <td>
                                <input type="text" name="id_buku" id="id_buku" class="form-control" value='<?php echo $data2->id_buku?>'>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;padding-left: 10px;">Tanggal</td>
                            <td>
                                <input type="text" name="tanggal" id="tanggal" class="form-control"
                                       value="<?php if (isset($data2->tanggal)) {
                                           echo date('m-d-Y', strtotime($data2->tanggal));
                                       } ?>">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;padding-left: 10px;">Kategori</td>
                            <td>
                                <select class="form-control" name="id_kategori" id="id_kategori">
                                    <?php foreach ($kategori as $value): ?>
                                        <?php if($data2->id_kategori == $value->id_kategori){?>
                                        <option value="<?php echo $value->id_kategori; ?>" selected="selected"><?php echo $value->nama_kategori; ?></option>
                                    <?php }else{?>
                                            <option value="<?php echo $value->id_kategori; ?>"><?php echo $value->nama_kategori; ?></option>
                                    <?php } ?>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr style="text-align: left;padding-left: 10px;">
                            <td>Judul Peraturan</td>
                            <td>
                                <input type="text" class="form-control" name="judul_peraturan" id="judul_peraturan"
                                       value='<?php echo $data2->judul_peraturan; ?>'>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center>Deskripsi Peraturan</center>
                            </td>
                            <td style="text-align: left;padding-left: 10px;">Nama Buku</td>
                            <td>
                                <input type="text" class="form-control" name="nama_buku" id="nama_buku"
                                       value='<?php echo $data2->nama_buku; ?>'>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="5">
                                <textarea name="deskripsi_peraturan" id="deskripsi_peraturan" class="form-control"
                                          style="resize: vertical"
                                          rows="5"><?php echo $data2->deskripsi_peraturan; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;padding-left: 10px;">Pengarang</td>
                            <td>
                                <input type="text" class="form-control" name="pengarang" id="pengarang"
                                       value='<?php echo $data2->pengarang; ?>'>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;padding-left: 10px;">Judul Halaman</td>
                            <td>
                                <input type="text" class="form-control" name="judul_halaman" id="judul_halaman"
                                       value='<?php echo $data2->judul_halaman; ?>'>
                                <input type="hidden" value="<?php echo $data2->id_doktrin?>" name="id_doktrin">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;padding-left: 10px;">Terbit</td>
                            <td>
                                <input type="number" min="0" class="form-control" name="terbit" id="terbit"
                                       onkeypress="return isNumberKey(event)" value="<?php echo $data2->terbit; ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <br/>
                <!-- <a tabindex="11" style="float:right;" class="btn btn-success" id="proses">
                    Update
                </a>
            </center> -->
        </div>
        <div style="text-align: right; margin-top: 2%;">
            <button id="proses" class="btn btn-primary" tabindex="7" ><i class="icon icon-ok icon-white"></i> Update</button>
            <a href="<?php echo base_URL(); ?>admin/master_doktrin/m_doktrin" class="btn btn-success" tabindex="8" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
        </div>
    </div>
</form>
<script>
    $('#proses').click(function () {
		var id_buku = validate($("input[name='id_buku']").val());
		var tanggal = validate($("input[name='tanggal']").val());
		var id_kategori = validate($("select[name='id_kategori']").val());
		var judul_peraturan = validate($("input[name='judul_peraturan']").val());
		var deskripsi_peraturan = validate($("textarea[name='deskripsi_peraturan']").val());
		var nama_buku = validate($("input[name='nama_buku']").val());
		var pengarang = validate($("input[name='pengarang']").val());
		var judul_halaman = validate($("input[name='judul_halaman']").val());
		var terbit = validate($("input[name='terbit']").val());
		if($("input[name='id_buku']").val()==""){
			alert("Harap isi id buku");
		}else if(id_buku=="failed" || tanggal=="failed" || id_kategori=="failed" || judul_peraturan=="failed" || deskripsi_peraturan=="failed" || nama_buku=="failed" || pengarang=="failed" || judul_halaman=="failed" || terbit=="failed"){
			alert("Harap tidak menggunakan kutip (') dan backslash (\\)");
		}else{
			$('#formnya').submit();
		}
    });

    $(document).ready(function () {
        $("#tanggal").datepicker({
            dateFormat: 'dd-mm-yy'
        });
    })

</script>
