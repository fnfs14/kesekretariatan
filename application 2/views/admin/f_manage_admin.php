<?php
$mode		= $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
	$act		= "act_edt";
	$idp		= $datpil->id;
	$username	= $datpil->username;
	$password	= "-";
	$nama_lengkap		= $datpil->nama_lengkap;
	$email		= $datpil->email;
	$level		= $datpil->level;
	$jabatan		= $datpil->jabatan;
	$no_telp		= $datpil->no_telp;
	
} else {
	$act				= "act_add";
	$idp				= "";
	$username			= "";
	$password			= "";
	$nama_lengkap		= "";
	$email				= "";
	$level				= "";
	$jabatan			= "";
	$no_telp		="";
}
?>
<div class="navbar navbar-inverse">
	<div class="container" style="z-index: 0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Manage User</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->
	
	<form action="<?php echo base_URL(); ?>admin/manage_admin/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	<div class="row-fluid well" style="overflow: hidden">
	
	<div class="col-lg-6">
		<table width="100%" class="table-form">
		<tr><td width="20%">Username</td><td><b><input type="text" id="username" name="username" required value="<?php echo $username; ?>" style="width: 300px" class="form-control" tabindex="1" autofocus></b></td><td><a class="btn btn-success" onclick="cek_useroffice(document.getElementById('username').value)" style="margin-left: -100px !important;">Cek</a></td></tr>
		<tr><td width="20%">Password</td><td><b><input type="password" name="password" required value="<?php echo $password; ?>" id="dari" style="width: 300px" class="form-control" tabindex="2" ></b></td></tr>		
		<tr><td width="20%">Ulangi Password</td><td><b><input type="password" name="password2" required value="<?php echo $password; ?>" id="dari" style="width: 300px" class="form-control" tabindex="3	" ></b></td></tr>
		<tr><td colspan="2">
		<br><button type="submit" id="btn_sbm_ad" class="btn btn-primary" tabindex="7" disabled="true"><i class="icon icon-ok icon-white"></i> Simpan</button>
		<a href="<?php echo base_URL(); ?>admin/manage_admin" class="btn btn-success" tabindex="8" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
		</td></tr>
		</table>
	</div>
	
	<div class="col-lg-6">	
		<table width="100%" class="table-form">
		<tr><td width="20%">Nama Lengkap</td><td><b><input type="text" name="nama_lengkap" required value="<?php echo $nama_lengkap; ?>" style="width: 300px" class="form-control" tabindex="4" ></b></td></tr>
		<tr><td width="20%">Email</td><td><b><input type="email" name="email" required value="<?php echo $email; ?>" style="width: 300px" class="form-control" tabindex="5" ></b></td></tr>
		<tr><td width="20%">Contact</td><td><b><input type="number" name="no_telp" required value="<?php echo $no_telp; ?>" style="width: 300px" class="form-control" tabindex="5" ></b></td></tr>
		<tr><td width="20%">Level</td><td><b>
			<select name="level" class="form-control" style="width: 300px" required tabindex="6"><option value="" style="display: none;"> - Level - </option>
			<?php
				$l_sifat	= array('Super Admin','Admin');
				
				for ($i = 0; $i < sizeof($l_sifat); $i++) {
					if ($l_sifat[$i] == $level) {
						echo "<option selected value='".$l_sifat[$i]."'>".$l_sifat[$i]."</option>";
					} else {
						echo "<option value='".$l_sifat[$i]."'>".$l_sifat[$i]."</option>";
					}				
				}			
			?>			
			</select>
			</b></td></tr>
			<!-- <tr><td width="20%">Tingkatan</td><td><b>
			<select name="tingkatan" class="form-control" style="width: 200px" required tabindex="6" >
			<option value="" style="display: none;">Pilih Tingkatan</option>
			<option value="1">1</option>
			<option value="2">2</option>
			</select></b></td></tr> -->
			<tr><td width="20%">Jabatan</td><td><b>
			<select name="jabatan" class="form-control" style="width: 300px" required tabindex="6" ><option value="" style="display: none;"> - Jabatan - </option>
			<?php 
			if(empty($jabatan)){//ubah mei admin
	            foreach($groups1 as $d)
	            { 
	              echo '<option value="'.$d->id.'">'.$d->nama_jabatan.'</option>';
	            }
	            foreach($groups2 as $e)
	            { 
	              echo '<option value="'.$e->id.'">'.$e->nama_jabatan.' - '.$e->nam_jab.'</option>';
	            }
	        }else{//ubah mei admin
	        	foreach($groups1 as $d)
	            { 
	              if($jabatan == $d->id){
	             		echo '<option value="'.$d->id.'" selected>'.$d->nama_jabatan.'</option>';
	              }else{
	              	echo '<option value="'.$d->id.'">'.$d->nama_jabatan.'</option>';
	              }
	            }
	            foreach($groups2 as $e)
	            { 
	              if($jabatan == $e->id){
	             		echo '<option value="'.$e->id.'" selected>'.$e->nama_jabatan.' - '.$e->nam_jab.'</option>';
	              }else{
	              	echo '<option value="'.$e->id.'">'.$e->nama_jabatan.' - '.$e->nam_jab.'</option>';
	              }
	            }
	        }
            ?>
			</select></b></td></tr>
			<!-- <tr><td width="20%">Sub-Jabatan</td><td><b>
			<select name="jabatan" class="form-control" style="width: 200px" required tabindex="6" >
			<?php 

            foreach($groups2 as $d)
            { 
              echo '<option value="'.$d->id.'">'.$d->nama_jabatan.'</option>';
            }
            ?>
			</select></b></td></tr> -->


		</table>
	</div>
	
	</div>
	
	</form>
	<script type="text/javascript">
		function cek_useroffice(val){
			// console.log(val);
			var ini = $("#btn_sbm_ad");
			$.ajax({ 
				url: "<?php echo site_url('admin/cek_usernameoffice'); ?>",
				data: {user: val},
				dataType: "json",
				type: "POST",
				success: function(data){
					// response(data);
					// console.log(data);
					if(data=="0"){
						alert("Username tidak terdaftar. Harap sesuaikan Username ini dengan Username Anda Di E-Office.");
					}else if(data=="1"){

					}else{
						alert("Username Anda Terdaftar dengan nama Akun "+data);
						$("#btn_sbm_ad").prop('disabled', false);
					}
				}    
			});
		}
	</script>
