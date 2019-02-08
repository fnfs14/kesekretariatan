<?php
$mode		= $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
	$ti		= $this->uri->segment(4);
	if($ti==1){
		$act		= "act_edt/1";
		$idp		= $datpil->id;
		$nama_jabatan	= $datpil->nama_jabatan;
		$urutan_view	= $datpil->urutan_view;
		$satuan		= "";
		$tingkatan		= $datpil->tingkatan;
		// $subdis		= $datpil->subdis;
	}else{
		$act		= "act_edt/2";
		$idp		= $datpil->id;
		$nama_jabatan	= $datpil->nama_jabatan;
		$urutan_view	= $datpil->urutan_view;
		$satuan		= $datpil->satuan;
		$tingkatan		= $datpil->tingkatan;
		$subdis		= $datpil->subdis;
	}
	
} else {
	$act				= "act_add";
	$idp				= "";
	$nama_jabatan			= "";
	$urutan_view = "";
	$satuan			= "";
	$tingkatan		= "";
	$subdis				= "";
	$ti = "";
}
?>
<div class="navbar navbar-inverse">
	<div class="container" style="z-index: 0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Pengaturan Jabatan</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->
	
	<form action="<?php echo base_URL(); ?>admin/manage_jabatan/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	<?php // echo $act; ?>
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	<div class="row-fluid well" style="overflow: hidden">
	
	<div class="col-lg-6">
		<table width="100%" class="table-form">
		<tr><td width="20%" id="ub_nam">Nama Jabatan</td><td><b><input type="text" name="nama_jabatan" required value="<?php echo $nama_jabatan; ?>" style="width: 300px" class="form-control" tabindex="1" autofocus></b></td></tr>
		</td></tr>
		<tr><td width="20%" id="ur">Urutan View</td><td><b><input type="text" name="urutan_view" required value="<?php echo $urutan_view; ?>" style="width: 300px" class="form-control" tabindex="1" autofocus></b></td></tr>
		</td></tr>
			<tr><td width="20%">Tingkatan</td><td><b>
			<select onchange="subna(this.value)" name="tingkatan" class="form-control" style="width: 200px" required tabindex="6" id="tingkatan">
			<option value="" style="display: none;"> - Pilih Tingkatan - </option>
		<?php 
			if(empty($tingkatan)){
		?>
			<option value="1">1</option>
			<option value="2">2</option>
		<?php }else{ 
				if($tingkatan==1){
					echo "<option value='1' selected>1</option>
							<option value='2'>2</option>";
				}else{
					echo "<option value='1'>1</option>
							<option value='2' selected>2</option>";
				}
			}
			?>

			</select></b></td></tr>
			<!-- <?php if(empty($datpil)){ ?>
			<tr><td width="20%"><div id="statsub">Status Sub Jabatan</div></td><td><b>
			<select onchange="subna2(this.value)" name="statusada" class="form-control" style="width: 200px" required tabindex="6" id="statsub2">
			<option value="" style="display: none;"> - Pilih Status - </option>
			<option value="1">Baru</option>
			<option value="2">Sudah Ada</option>
			</select></b></td></tr>
			<?php } ?> -->
			<tr><td width="20%"><div id="labker">Satuan Kerja</div></td><td><b>
			<select name="satuan" class="form-control" style="width: 200px" required tabindex="6" id="conker"><option value="0" style="display: none;"> - Pilih Satuan Kerja - </option>
			<?php 

            foreach($groups1 as $d)
            { 
              if(empty($satuan)){
              	echo '<option value="'.$d->id.'">'.$d->nama_satuan.'</option>';
              }else{
              	if($satuan==$d->id){
              		echo '<option value="'.$d->id.'" selected>'.$d->nama_satuan.'</option>';
              	}else{
              		echo '<option value="'.$d->id.'">'.$d->nama_satuan.'</option>';

              	}
              }
            }
            ?>
			</select></b></td></tr>
			<!-- <tr><td width="20%"><div id="labsub">Sub Jabatan</div></td><td><b>
			<select name="subjab" class="form-control" style="width: 200px" required tabindex="6" id="consub"><option value="0" style="display: none;"> - Pilih Sub Jabatan - </option>
			<?php 

            foreach($groups3 as $e)
            { 
              // if(empty($subdis)){
              	$cb = $this->db->query("SELECT * FROM notadinas.master_jabatan WHERE subdis = '".$e->id_subjabatan."'")->num_rows();
              	if($cb==0){
              		echo '<option value="'.$e->id_subjabatan.'">'.$e->nama_subjabatan.' - '.$e->nama_jab.'</option>';
              	}
              // }else{
              // 	if($subdis==$e->id_subjabatan){
              // 		echo '<option value="'.$e->id_subjabatan.'" selected>'.$e->nama_subjabatan.' - '.$e->nama_jab.'</option>';
              // 	}else{
              // 		echo '<option value="'.$e->id_subjabatan.'">'.$e->nama_subjabatan.' - '.$e->nama_jab.'</option>';

              // 	}
              // }
            }
            ?>
			</select>
			</b></td></tr> -->

			<!-- <tr>
				<td><div id="subsubs">Jabatan</div></td>
				<td><b>
					<select name="subdis" class="form-control" style="width: 200px" required tabindex="6" id="subhide">
						<option value="0" style="display: none;"> - Pilih Jabatan - </option>
					<?php 

		            foreach($groups2 as $d)
		            { 
		            	if(empty($subdis)){
			              	echo '<option value="'.$d->id.'">'.$d->nama_jabatan.'</option>';
						}else{
							if($subdis==$d->id){
								echo '<option value="'.$d->id.'" selected>'.$d->nama_jabatan.'</option>';
							}else{
								echo '<option value="'.$d->id.'">'.$d->nama_jabatan.'</option>';

							}
						}
		            }
		            ?>
					</select></b>
				</td>
			</tr> -->
		</table>
		<br>
	</div>
		<div style="text-align: right; margin-top: 18%;">
			<button type="submit" class="btn btn-primary" tabindex="7" ><i class="icon icon-ok icon-white"></i> Simpan</button>
			<a href="<?php echo base_URL(); ?>admin/manage_jabatan" class="btn btn-success" tabindex="8" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
		</div>
	<script type="text/javascript">
		function subna(isi){
			if(isi == 1){
				// document.getElementById("subhide").style.display="none";
				// document.getElementById("subsubs").style.display="none";
				document.getElementById("labker").style.display="none";
				document.getElementById("conker").style.display="none";
				// document.getElementById("statsub").style.display="none";
				// document.getElementById("statsub2").style.display="none";
				// document.getElementById("labsub").style.display="none";
				// document.getElementById("consub").style.display="none";
				// document.getElementById("ub_nam").innerHTML = "Nama Jabatan";


			}else{
				// document.getElementById("subhide").style.display="block";
				// document.getElementById("subsubs").style.display="block";
				document.getElementById("labker").style.display="block";
				document.getElementById("conker").style.display="block";
				// document.getElementById("statsub").style.display="block";
				// document.getElementById("statsub2").style.display="block";
				// document.getElementById("labsub").style.display="block";
				// document.getElementById("consub").style.display="block";
				// document.getElementById("ub_nam").innerHTML = "Nama Sub Jabatan";

			}
		}
		function subna2(status){
			if(status == 1){
				document.getElementById("labker").style.display="block";
				document.getElementById("conker").style.display="block";
				document.getElementById("labsub").style.display="none";
				document.getElementById("consub").style.display="none";
			}else{
				document.getElementById("labker").style.display="none";
				document.getElementById("conker").style.display="none";
				document.getElementById("labsub").style.display="block";
				document.getElementById("consub").style.display="block";
			}
		}
	</script>
	</div>
	
	</form>
