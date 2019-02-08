

<div class="navbar navbar-inverse">
	<div class="container">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Nota Dinas</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->

<div id="form-container">
	<div class="row-fluid well" style="overflow: hidden">
		<form id="notadinas" action="<?php echo base_URL(); ?>admin/nota_dinas/submit/<?php echo $this->uri->segment(4)?>" method="post" 
		accept-charset="utf-8" enctype="multipart/form-data" class="form-horizontal">

			<input type='hidden' name='id' value='<?php echo $id;?>'>

			<?php echo $html;?>
			
			<hr style="border-color: #cccccc">
			<h2>Disposisi</h2><br>
			<div class='form-group col-xs-12'>
			    <div class="dynamic_field">
				    <div class="form-group row">
				        <label class="col-xs-2">Disposisi ke :</label>
				        <div class="col-xs-7"> 
				            <button type="button" class="btn btn-default addButton col-xs-12" tabindex="1" autofocus><b>+</b></button>
				        </div>
				    </div>

				    <?php foreach ($disposisi as $value) { ?>
					    <div class="form-group person_field clone">
					        <label class="col-xs-2"></label>
					        <div class="col-xs-1">
					            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1"><b>-</b></button>
					        </div>
					        <div class="col-xs-6">
			            		<select name='disposisi[]' class='form-control' tabindex="1" autofocus>
									<option value=''>--Pilih Jabatan--</option>
									<?php foreach ($listAdmin as $value2) { ?>
										<option value='<?php echo $value2->id; ?>' <?php if($value->id_penerima == $value2->id) { echo 'selected';}?> ><?php echo $value2->jabatan; ?></option>
									<?php } ?>
				            	</select>
						    </div>
						</div>
				    <?php } ?>

				    <div class="form-group person_field template hide">
				        <label class="col-xs-2"></label>
				        <div class="col-xs-1">
				            <button type="button" class="btn btn-default removeButton col-xs-12" tabindex="1" ><b>-</b></button>
				        </div>
				        <div class="col-xs-6">
				        	<select name='disposisi[]' class='form-control' tabindex="1" autofocus>
									<option value=''>--Pilih Jabatan--</option>
									<?php foreach ($listAdmin as $value2) { ?>
										<option value='<?php echo $value2->id; ?>'><?php echo $value2->jabatan; ?></option>
									<?php } ?>
				            	</select>
				        </div>
				        <div class="col-xs-3 person_field_2"></div>
				    </div>
				</div>
			</div>

			<tr><td colspan="2">
			<br><button type="submit" class="btn btn-success" tabindex="1" ><i class="icon icon-ok icon-white"></i> Simpan</button>
			<a href="<?php echo base_URL(); ?>admin/nota_dinas/view/nota" class="btn btn-primary" tabindex="1" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
			</td></tr>

		</form>	
	</div>
</div>

	