<?php
	$action = $this->uri->segment(4);
	if($action == 'edit_request') {
		$id = $request->ID;
		$id_jenis_surat = $jenis_surat->ID;
		$jenis_request = $jenis_surat->jenis_request;

	} else {
		$id = '';
		$id_jenis_surat = '';
		$jenis_request = '';
	}
?>


<div class="navbar navbar-inverse">
	<div class="container">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Nota Dinas</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->

<div id="form-container">
	<div class="row-fluid well" style="overflow: hidden">
		
		<form id="notadinas" action="<?php echo base_URL(); ?>admin/nota_dinas/submit/<?php echo $this->uri->segment(4)?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" class="form-horizontal">

			<?php if (isset($id)){echo "<input type='hidden' name='id' value='".$id."'>";} ?>

			<div class="form-group">
			    <label class="col-xs-2">Jenis Surat</label>
			    <div class="col-xs-3">
			        <select class="form-control" id="jenis_surat" name="jenis_surat" tabindex="1" autofocus required>
						<option value=""></option>
						<?php foreach ($listSurat as $value) {
							if ($value->ID == $id_jenis_surat) {
								echo "<option class='form-control' value='".$value->ID."'' selected>".$value->jenis_surat."</option>";
							} else {
								echo "<option class='form-control' value='".$value->ID."''>".$value->jenis_surat."</option>";
							}
						} ?>
					</select>
			    </div>
			</div>

			<div id='ajax-form-container' class='<?php echo $jenis_request?>'>
				<?php if (isset($html)) {echo $html;} ?>
			</div>

		</form>	
	</div>
</div>

