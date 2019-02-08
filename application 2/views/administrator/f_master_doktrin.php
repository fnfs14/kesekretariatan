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
    function isNumberKey(evt){
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

<form action="<?php echo base_URL()?>admin/master_doktrin/save" method="post" id="formnya" enctype="multipart/form-data">
	<div class="row-fluid well" style="overflow: hidden">
		<div class="col-lg-12">
			<!-- <center> -->
				<table width="100%" class="table-form">
                    <tr>
                        <td rowspan="4">
                            1. Upload File Doktrin: <input type="file" name="file" id="file"><br>
                            2. Upload Cover File Doktrin (File yang diperbolehkan: <b>*.jpg,  *.jpeg, *.png, *.bmp</b>): <input type="file" name="file_cover" id="file_cover">
                        </td>
                        <td style="text-align: left;padding-left: 10px;">ID Buku</td>
                        <td>
                            <input type="text" name="id_buku" id="id_buku" class="form-control">
                        </td>
                    </tr>
					<tr>
						<td style="text-align: left;padding-left: 10px;">Tanggal</td>
                        <td>
                            <input type="text" name="tanggal" id="tanggal" class="form-control">
                        </td>
					</tr>
                    <tr>
                        <td style="text-align: left;padding-left: 10px;">Kategori</td>
                        <td>
                            <select class="form-control" name="id_kategori" id="id_kategori">
                                <?php foreach ($kategori as $value):?>
                                    <option value="<?php echo $value->id_kategori;?>"><?php echo $value->nama_kategori;?></option>
                                <?php endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr style="text-align: left;padding-left: 10px;">
                        <td>Judul Peraturan</td>
                        <td>
                            <input type="text" class="form-control" name="judul_peraturan" id="judul_peraturan">
                        </td>
                    </tr>
                    <tr>
                        <td><center>Deskripsi Peraturan</center></td>
                        <td style="text-align: left;padding-left: 10px;">Nama Buku</td>
                        <td>
                            <input type="text" class="form-control" name="nama_buku" id="nama_buku">
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="5">
                            <textarea name="deskripsi_peraturan" id="deskripsi_peraturan" class="form-control" style="resize: vertical" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;padding-left: 10px;">Pengarang</td>
                        <td>
                            <input type="text" class="form-control" name="pengarang" id="pengarang">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;padding-left: 10px;">Judul Halaman</td>
                        <td>
                            <input type="text" class="form-control" name="judul_halaman" id="judul_halaman">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;padding-left: 10px;">Terbit</td>
                        <td>
                            <input type="number" min="0" class="form-control" name="terbit" id="terbit" onkeypress="return isNumberKey(event)">
                        </td>
                    </tr>
				</table>
				<br/>
                <!-- <a tabindex="11" style="float:right;" class="btn btn-success" id="proses">
					Simpan
				</a>
			</center> -->
		</div>
        <div style="text-align: right; margin-top: 2%;">
                    <button id="proses" class="btn btn-primary" tabindex="7" ><i class="icon icon-ok icon-white"></i> Simpan</button>
                    <a href="<?php echo base_URL(); ?>admin/master_doktrin/m_doktrin" class="btn btn-success" tabindex="8" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
                </div>
	</div>
</form>
<script>
	$('#proses').click(function(){
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
            dateFormat:'dd-mm-yy'
        });
    })

</script>
