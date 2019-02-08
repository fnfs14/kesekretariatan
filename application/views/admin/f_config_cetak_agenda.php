<div class="navbar navbar-inverse">
	<div class="container">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Cetak Agenda</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->


<?php echo $this->session->flashdata("k");?>
	

<table class="table table-bordered table-hover">
	<?php
	if($this->uri->segment(2) == "agenda_surat_keluar"){?>
	<thead>
		<tr>
			<th width="">No. Agd/Kode</th>
			<th width="">Isi Ringkas, File</th>
			<th width="">Tujuan Surat</th>
			<th width="">Nomor, Tgl. Surat</th>
			<th width="">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if (empty($data)) {
			echo "<tr><td colspan='5'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
		} else {
			$no 	= ($this->uri->segment(4) + 1);
			foreach ($data as $b) {
		?>
		<tr>
			<td><?php echo $b->id."/".$b->id;?></td>
			<td><?php echo $b->isi."<br><b>Dokumen : </b><i><a href='".base_URL()."upload/surat_keluar/".$b->file_attachment."' target='_blank'>".$b->file_attachment."</a>"?></td><!--ubah mei bahasa-->
			<td><?php echo $b->kepada?></td>
			<td><?php echo $b->no_surat."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"?></td>
			<td class="ctr">
			<div class="btn-group">
					<a href="<?php echo base_URL(); ?>admin/surat_keluar/verifikasi_surat_keluar/<?php echo $b->id; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Lihat</a>
					<a href="<?php echo base_URL(); ?>admin/surat_keluar/edt/<?php echo $b->id; ?>" class="btn btn-warning btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Edt</a>
					<a href="<?php echo base_URL(); ?>admin/surat_keluar/del/<?php echo $b->id?>" class="btn btn-primary btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Del</a>		
				</div>
			</td>
		</tr>
		<?php 
			$no++;
			}
		}
		?>
	</tbody>
	<?php 
	}else if($this->uri->segment(2) == "agenda_surat_masuk"){ ?>
	<thead>
		<tr>
			<th width="">No. Agd/Tgl.SETUM</th>
			<th width="">Isi Ringkas, File</th>
			<th width="">Asal Surat</th>
			<th width="">Nomor, Tgl. Surat</th>
			<th width="">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if (empty($data)) {
			echo "<tr><td colspan='5'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
		} else {
			$no 	= ($this->uri->segment(4) + 1);
			foreach ($data as $b) {
		?>
		<tr>
			<td><?php echo $b->no_setum."/".tgl_jam_sql($b->tgl_setum);?></td>
			<td><?php echo $b->perihal."<br><b>Dokumen : </b><i><a href='".base_URL()."upload/surat_masuk/".$b->file_attachment."' target='_blank'>".$b->file_attachment."</a>"?></td><!--ubah mei bahasa-->
			<td><?php echo $b->instansi ?></td>
			<td><?php echo $b->no_surat."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"?></td>
			<td class="ctr">
			<div class="btn-group">
					<a href="<?php echo base_URL(); ?>admin/surat_masuk/subdisp/<?php echo $b->id; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Lihat</a>
				</div>
			</td>
		</tr>
		<?php 
			$no++;
			}
		}
		?>
	</tbody>
	<?php 
	}else if($this->uri->segment(2) == "agenda_nota_dinas"){ ?>
	<thead>
		<tr>
			<th width="">No. Agd/Tgl.SETUM</th>
			<th width="">Isi Ringkas, File</th>
			<th width="">Asal Surat</th>
			<th width="">Nomor, Tgl. Surat</th>			
			<th width="">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if (empty($data)) {
			echo "<tr><td colspan='5'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
		} else {
			$no 	= ($this->uri->segment(4) + 1);
			foreach ($data as $b) {
		?>
		<tr>
			<td><?php echo $b->id."/".$b->tgl_surat;?></td>
			<td><?php echo $b->isi."<br><b>Dokumen : </b><i><a href='".base_URL()."upload/nota_dinas/".$b->file_attachment."' target='_blank'>".$b->file_attachment."</a>"?></td><!--ubah mei bahasa-->
			<td><?php echo $b->nama_lengkap;?></td>
			<td><?php echo $b->no_surat."<br><i>".tgl_jam_sql($b->tgl_surat)."</i>"?></td>
			<td class="ctr">
			<div class="btn-group">
					<a href="<?php echo base_URL(); ?>admin/nota_dinas/verifikasi_nota_dinas/<?php echo $b->id; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Lihat</a>
					<a href="<?php echo base_URL(); ?>admin/nota_dinas/edt/<?php echo $b->id; ?>" class="btn btn-warning btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Edt</a>
					<a href="<?php echo base_URL(); ?>admin/nota_dinas/del/<?php echo $b->id?>" class="btn btn-primary btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Del</a>		
				</div>
			</td>
		</tr>
		<?php 
			$no++;
			}
		}
		?>
	</tbody>
	<?php } ?>
</table>


<div class="well">
<form action="<?php echo base_URL(); ?>admin/cetak_agenda" target="blank" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
	<input type="hidden" name="tipe" value="<?php echo $this->uri->segment(2); ?>">

	<table class="table-form" width="100%">
	<tr><td width="20%">Dari Tanggal</td><td><b><input type="text" name="tgl_start" id="tgl_start" class="form-control" style="width: 150px" required></b></td></tr>		
	<tr><td width="20%">Sampai Tanggal</td><td><b><input type="text" name="tgl_end" id="tgl_end" class="form-control" style="width: 150px"  required></b></td></tr>	
	
	<tr><td colspan="2">
	<br>
	<button type="submit" class="btn btn-primary"><i class="icon icon-print icon-white"></i> Cetak</button>
	<a href="<?php echo base_URL(); ?>admin" class="btn btn-success"><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
	</td></tr>
	</table>
	</fieldset>
</form>
</div>

<script type="text/javascript">
$(function() {
	$( "#tgl_start" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd'
	});
	$( "#tgl_end" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd'
	});
});
</script>
