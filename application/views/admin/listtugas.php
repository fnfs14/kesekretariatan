 <select id="tknya" name="tknya" class="form-control ajaxTugas" style="width: 400px">
 <option value="0" selected>- Pilih Tugas -</option>
<?php foreach ($listtugasnya as $x) { ?>
                                          
                                                <option value="<?php echo $x->id_task; ?>"><?php echo $x->nama_task; ?></option>
                                     <?php   } ?>
					</select>