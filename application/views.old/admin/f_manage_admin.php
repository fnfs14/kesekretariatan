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
			<span class="navbar-brand" href="#">Manage Admin</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->
	
	<form action="<?php echo base_URL(); ?>admin/manage_admin/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	<div class="row-fluid well" style="overflow: hidden">
	
	<div class="col-lg-6">
		<table width="100%" class="table-form">
		<tr><td width="20%">Username</td><td><b><input type="text" name="username" required value="<?php echo $username; ?>" style="width: 300px" class="form-control" tabindex="1" autofocus></b></td></tr>
		<tr><td width="20%">Password</td><td><b><input type="password" name="password" required value="<?php echo $password; ?>" id="dari" style="width: 300px" class="form-control" tabindex="2" ></b></td></tr>		
		<tr><td width="20%">Ulangi Password</td><td><b><input type="password" name="password2" required value="<?php echo $password; ?>" id="dari" style="width: 300px" class="form-control" tabindex="3	" ></b></td></tr>
		<tr><td colspan="2">
		<br><button type="submit" class="btn btn-primary" tabindex="7" ><i class="icon icon-ok icon-white"></i> Simpan</button>
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
			<select name="level" class="form-control" style="width: 200px" required tabindex="6" ><option value=""> - Level - </option>
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
			<tr><td width="20%">Jabatan</td><td><b>
			<select name="jabatan" class="form-control" style="width: 200px" required tabindex="6" >
			<?php 

            foreach($groups as $d)
            { 
              echo '<option value="'.$d->id.'">'.$d->nama_jabatan.'</option>';
            }
            ?>
			</select></b></td></tr>

		</table>
	</div>
	
	</div>
	
	</form>
