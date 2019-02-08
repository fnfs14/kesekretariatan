
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Nota Dinas Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?=base_url()?>aset/img/favicon.ico" type="image/gif">
    <meta charset="utf-8">
<style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
@import url(https://fonts.googleapis.com/css?family=Exo:100,200,400);
@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);

body{
	margin: 0;
	padding: 0;
	background: #fff;

	color: #fff;
	font-family: Arial;
	font-size: 12px;
}

.body{
	position: absolute;
	top: 0px;
	left: 0px;
	right: 0px;
	bottom: 0px;
	width: auto;
	height: auto;
	background-image: url('../aset/img/bg_login.jpg');
	background-size: cover;
	z-index: 0;
}

.grad{
	position: absolute;

	left: -20px;
	right: -40px;
	width: auto;
	height: auto;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
	z-index: 1;
	opacity: 0.7;
}

.header{
	margin-top: 200px;
	text-align: center;
	z-index: 2;
}

.header div{
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 35px;
	font-weight: 200;
}

.header div span{
	color: #5379fa !important;
}

.login{
	text-align:center;
	padding: 10px;
	z-index: 2;
}

.login input[type=text]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
}

.login input[type=password]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
	margin-top: 10px;
}

.login input[type=submit]{
	width: 260px;
	height: 35px;
	background: #fff;
	border: 1px solid #fff;
	cursor: pointer;
	border-radius: 2px;
	color: #a18d6c;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 6px;
	margin-top: 10px;
}

.login select[name=ta]{
	width: 260px;
	height: 35px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	cursor: pointer;
	border-radius: 2px;
	color: #5379fa;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 6px;
	margin-top: 10px;
}

.login input[type=submit]:hover{
	opacity: 0.8;
}

.login input[type=submit]:active{
	opacity: 0.6;
}

.login input[type=text]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=password]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=button]:focus{
	outline: none;
}

::-webkit-input-placeholder{
   color: rgba(255,255,255,0.6);
}

::-moz-input-placeholder{
   color: rgba(255,255,255,0.6);
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="../bower_components/bootstrap/assets/js/html5shiv.js"></script>
	<script src="../bower_components/bootstrap/assets/js/respond.min.js"></script>
<![endif]-->
 
<script src="<?php echo base_url(); ?>aset/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>aset/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>aset/js/jquery.chained.js"></script>

<body style="">
<div class="body">
<div class="header">
		<div>Nota Dinas</div>
	</div>
	<br>
	<div class="login">
		<form action="<?php echo base_URL(); ?>admin/do_login" method="post">
		<div style="color: red"><?php echo $this->session->flashdata("k"); ?></div>
		<table align="center" style="margin-bottom: 0" class="table-form" width="90%">
			<tr><td><input type="text" autofocus name="u" required autofocus class="form-control" placeholder="username"></td></tr>
			<tr><td><input type="password" name="p" required class="form-control" placeholder="password"></td></tr>
 			<tr style="display:none;"><td><select name="ta" class="form-control" required><option value="">--</option>
			<?php 
			for ($i = 2012; $i <= (date('Y')); $i++) {
				if (date('Y') == $i) {
					echo "<option value='$i' selected>$i</option>";
				} else {
					echo "<option value='$i'>$i</option>";
				}
			}
			?>
			</select>
			</td></tr>
			<tr><td><input type="submit" value="Login"></td></tr>
		</table>
		</form>
	</div>

</div>

	
	
<script type="text/javascript">
	$(document).ready(function(){
		$(" #alert" ).fadeOut(6000);
	});
</script>
	  
</div>  
</body>
</html>