 <select name="nama_rknya" id="nama_rknya" class="form-control" width="80%">
 <option value="0" selected>- Pilih Tugas -</option>
<?php foreach ($listtugasnya as $x) { ?>
                                          
                                                <option value="<?php echo $x->id_ruang_kerja; ?>"><?php echo $x->nama_krj; ?></option>
                                     <?php   } ?>
					</select>
					
					
					