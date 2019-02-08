<table id="firstt">
	<tr>
		<td style="text-align: left; text-decoration: none"><b>DITERUSKAN KEPADA :</b></td>                
	</tr>
	<tr>
		<td style="text-align: left; text-decoration: none">YTH. <label><?php echo $jabatan->nama_jabatan; ?></label></td>
	</tr>
</table>
<table id="fourth" style="font-size: 11px; border-collapse: collapse;">
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

			<table style="border-collapse: collapse;">
			<?php
			$count_alamat_aksi = 1;
			foreach($alamat_aksi as $key => $c){
				if($c->id != 1){
					if($count_alamat_aksi==1){
						echo "<tr>";
					}				
					$dispCol = 'penerima_disposisi';
					if($c->tingkatan==2){
						$dispCol = 'penerima_disposisi_satuan';
					}
					$dispAction = $this->db->query("
						SELECT jenis
						FROM notadinas.disposisi_surat_masuk
						WHERE
							id_surat_masuk = $idbut
							AND
							$dispCol = $c->id
					")->row();
					$checkedAksi = "";
					$checkedInfo = "";
					if($dispAction!=null){
						if($dispAction->jenis == 'AKSI'){
							$checkedAksi = "checked";
						}else{
							$checkedInfo = "checked";
						}
					}
					if($c->tingkatan==2 and $c->tingkatan != $jabatan->tingkatan){
						$checkedAksi = "";
						$checkedInfo = "";
					}
					echo '
						<td class="first">
							<input disabled type="checkbox" name="" id="" class=""'. $checkedAksi .'> 
							<input disabled type="checkbox" name="" id="" class=""'. $checkedInfo .'> 
						</td>
						<td class="second">
							<label style="font-size:11px !important;">'.$c->nama_jabatan .'</label>
						</td>';
					if($count_alamat_aksi==4){
						echo "</tr>";
						$count_alamat_aksi = 0;
					}
					$count_alamat_aksi = $count_alamat_aksi + 1;
				}
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
			foreach($aksi as $abc){
				if($count_aksinya==1){
					echo "<tr>";
				}
				$dispAksi = $this->db->query("
					SELECT *
					FROM notadinas.aksi_disposisi_surat_masuk
					WHERE
						id_disposisi_surat_masuk = $idbut
						AND
						id_aksi = $abc->id
				")->result();
				$selected = "";
				if($dispAksi!=null){
					$selected = "checked";
				}
				echo '
					<td class="first">
						<input disabled type="checkbox" name="" id="" class=""'. $selected .'>
					</td>
					<td class="second">
						<label style="font-size:11px !important;"> '. $abc->nama_aksi .'</label>
					</td>';
				if($count_aksinya==4){
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
	<table id="first">
		<tr bgcolor="#FF0000" style="color: white; text-decoration: none">
			<td><center>Disposisi / Catatan</center></td>
		</tr>
	</table>
	<br>
   <?php
	$id = $idbut;//ubah mei surmas5
	$get = $this->db->query("SELECT * FROM notadinas.disposisi_surat_masuk WHERE notadinas.disposisi_surat_masuk.id_surat_masuk ='".$id."' order by id asc")->result_array();
	?>
	<table class="fourth">
		<tr>
			<td><?= (!empty($get)) ? $get[0]['keterangan'] : ''; ?></td>
		</tr>
	</table>
</table>

<?php 
if (strlen($get[0]['keterangan']) > 350) {
echo "<div class='page-break'></div>";
}

?>        
<table class="fourth">
<br> 
<br>  
<?php 
if(strlen($get[0]['keterangan']) > 350) {
	echo $data->no_setum;;
}                            
?>

<table id="first">
	<tr>
		<td><center>Feedback</center></td>
	</tr>
</table>
<?php
$id = $idbut;//ubah mei surmas5
$get = $this->db->query('SELECT * FROM notadinas.disposisi_surat_masuk WHERE notadinas.disposisi_surat_masuk.id_surat_masuk = '.$id  )->result_array();
 $chat = $this->db->query('SELECT  a.pengirim, a.penerima, a.pesan_feedback, a.created_at, a.waktu, b.id, b.nama_jabatan from notadinas.feedback_surat_masuk a, notadinas.master_jabatan b, notadinas.surat_masuk c  where a.pengirim = b.id AND a.id_surat_masuk = c.id AND id_surat_masuk ='.$id.' ORDER BY a.id_feedback')->result(); 
?>

<table id="fourth">
	<tr>
		<td>
		  

			 
		<?php  foreach ($chat as $key => $res) {
		if($res->penerima == $this->session->userdata('admin_jabatan')){
		if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
	  
		   
			<?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>
			<p class="media-heading"><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span></span> </p> 
			<?php }  else { ?>
			  <p class="media-heading"><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span></span> </p>     
			<?php } ?>
	  
		
			<p class="pull-left" style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background: #FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?> <br> <sub style="color: #555";>&nbsp; <?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></sub> </p>
	   

		<?php }else{ ?>

	  
			<?php if($res->pengirim != $this->session->userdata('admin_jabatan')){ ?>

			<p><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span class="pull-right"></span> </p> 

			  <?php }  else { ?>
			  <p class="media-heading"><i class="fa fa-comment"></i>  <?= $res->nama_jabatan ?> <span></span> </p>     
			<?php } ?>

			<p class="pull-right" style="margin-left: 20px; padding: 10px ; <?php if($res->pengirim == $this->session->userdata('admin_jabatan')){?> background:#FFD54F; <?php }else{?> background: #eee;  <?php } ?> border-radius: 3px;"><?= $res->pesan_feedback ?>  <sub style="color: #555";>&nbsp;  <?= date('d M',strtotime($res->created_at)) ?>, <?= date('H:i',strtotime($res->waktu)) ?></sub> </p>
	 

		<?php }  }} ?>

		</table>
		</td>
	</tr>
</table>