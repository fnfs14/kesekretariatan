<?php if($checkSubdis==""){ ?>
<div class='page-break'></div>
<?php } ?>
<br/>
<br/>
<br/>
<table id="first">
	<tr>
		<td>Disposisi Kasubdis</td>
	</tr>
</table>
<table id="fourth" style="font-size: 11px;">
	<tr>
		<td>
			<table style="border-collapse: collapse; border-top: 0.5px solid black; border-bottom: 0.5px solid black; width: 100%;">
				<tr>
					<td style="width: 8%">
						<b style="text-align:left">A</b>
						<b style="float:right">I</b>
					</td>
					<td style="text-align: center; width: 80%">
					   <center><b>ALAMAT AKSI</b></center>
					</td>
				</tr>
				<!-- <tr>
					<td style="padding:0px;padding-right:15px;padding-left:15px;">                               
					</td>
				</tr> -->
			</table>
			<table>
			<?php
				$count_alamat_aksi = 1;
				foreach($alamat_aksi_sub as $key => $c){
					if($count_alamat_aksi==1){
						echo "<tr>";
					}
					$checkedAksi = "";
					$checkedInfo = "";
					$kadsipAction = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk WHERE id_surat_masuk = '.$idbut.' AND penerima_disposisi_satuan = '.$c->id)->row();
					if($kadsipAction!=null){
						if($kadsipAction->jenis == 'AKSI'){
							$checkedAksi = "checked";
						}else{
							$checkedInfo = "checked";
						}
					}
					echo '
					<td class="first">
						<input disabled type="checkbox" name="" id="" class=""'. $checkedAksi .'> 
						<input disabled type="checkbox" name="" id="" class=""'. $checkedInfo .'> 
					</td>
					<td class="second">
						<label style="font-size:11px !important;">'. $c->nama_subjabatan . '</label>
					</td>';
					if($count_alamat_aksi==3){
						echo "</tr>";
						$count_alamat_aksi = 0;
					}
					$count_alamat_aksi = $count_alamat_aksi + 1;
				}
			?>
			</table>
			<br>
			<table style="width: 100%; border-collapse: collapse; border-top: 0.5px solid black; border-bottom: 0.5px solid black;">                        
				<tr>
					<td style="width: 8%">&nbsp;</td>
					<td colspan="6" style="text-align: center; width: 80%">
					   <b>AKSI</b>
					</td>
				</tr>
			</table>
				 <table style="font-size: 11px;">
				<?php
					$count_aksinya = 1;
					$selectednya = "";
					foreach($aksinya as $abc){
						if($count_aksinya==1){
							echo "<tr>";
						} 
					   
						 $selected = "";
							$param = array();
							$table_aksi = $this->db->query('SELECT * FROM notadinas.aksi_disposisi_surat_masuk_satuan WHERE notadinas.aksi_disposisi_surat_masuk_satuan.id_surat_masuk = '.$idbut)->result();//ubah mei surmas5

							foreach ($table_aksi as $key => $svs) {
								$param = $svs->id_aksi;

								if($param == $abc->id){
									$selected = "checked";
									// echo $param;
								}

						}

						echo '<td class="first"><input disabled type="checkbox" name="" id="" class=""'. $selected .'></td><td class="second"><label style="font-size:11px !important;"> '. $abc->nama_aksi .'</label></td>';
						if($count_aksinya==3){
							echo "</tr>";
							$count_aksinya = 0;
						}
						$count_aksinya = $count_aksinya + 1;
					}
				?>  
			</table>
		   
		</td>
	</tr>
</table>


  <table class="fourth">
	 <br>
	 <br>
	 <br>
	 <br>
	 <br>
	 <br>
			<table id="first">
				<tr>
					<td><center>Disposisi/Catatan</center></td>
				</tr>
			</table>
			<br>
		   <?php

			$id = $idbut;//ubah mei surmas5

			$get = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk WHERE notadinas.disposisi_surat_masuk.penerima_disposisi IS NULL AND  notadinas.disposisi_surat_masuk.id_surat_masuk = '.$id)->result_array();

		 
			?>


			<table class="fourth">
				<tr>
					<td>
						<?php if(isset($get[0]['keterangan'])){   
						echo $get[0]['keterangan']; 
						} ?>
					</td>
				</tr>
			</table>

</table>

<table class="fourth">
			<table id="first">
				<tr>
					<td><center>Feedback</center></td>
				</tr>
			</table>
			
			

					<?php $chat = $this->db->query('SELECT  a.pengirim, a.penerima, a.pesan_feedback, a.created_at, a.waktu, b.id, b.nama_jabatan from notadinas.feedback_surat_masuk_satuan a, notadinas.master_jabatan b where a.pengirim = b.id AND id_surat_masuk ='.$id.' ORDER BY a.id_feedback')->result(); 

						foreach ($chat as $key => $res) {
						 
					?>
					<table id="fourthx">
				<tr>
					<td>
					  

					<?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
				  
						<?php if($res->penerima == $this->session->userdata('admin_jabatan')){ ?>
						<?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
						<p> <?= $res->nama_jabatan ?> <span class="pull-right"><?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></span> </p> 
						<?php } ?>
						
						<p style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background: #FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?> <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){ ?> <sub style="color: #555";>&nbsp; <?= date('H:i',strtotime($res->waktu)) ?></sub> <?php } ?></p>
					<?php } ?>
				   

					<?php }else{ ?>

				   
						<?php if($res->penerima == $this->session->userdata('admin_jabatan')){ ?>
						<?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>

						<p><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span class="pull-right"><?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></span></p> 
						b
						<?php } ?>
						<p  style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background:#FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?>  <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){ ?> <sub style="color: #555";>&nbsp; <?= date('H:i',strtotime($res->waktu)) ?></sub> <?php } ?></p>
					<?php } ?>
				   

					<?php } ?>

					
					</td>
				</tr>
			</table>

				 
				  <div class="media2-body">

					

				  </div>
				  
					 
				   
				   

					<?php } ?>
			   

		
			<br>
		   <?php

			$id = $idbut;//ubah mei surmas5

			$get = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk WHERE notadinas.disposisi_surat_masuk.id_surat_masuk = '.$id  )->result_array();

			 $chat = $this->db->query('SELECT  a.pengirim, a.pesan_feedback, a.created_at, a.waktu, b.id, b.nama_jabatan from notadinas.feedback_surat_masuk a, notadinas.master_jabatan b, notadinas.surat_masuk c  where a.pengirim = b.id AND a.id_surat_masuk = c.id AND id_surat_masuk ='.$id.' ORDER BY a.id_feedback')->result(); 

		 
			?>

</table>