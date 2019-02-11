 <select id="tknya" name="tknya" class="form-control ajaxTugas" style="width: 400px">
 <option value="0" selected>- Pilih Tugas -</option>
<?php foreach ($listtugasnya as $x) {
	$z = "";
	if($selected==$x->id_task){
		$z = "selected";
	}
	?>
	<option value="<?php echo $x->id_task; ?>"<?= $z; ?>><?php echo $x->nama_task; ?></option>
<?php   } ?>
</select>