<div class="clearfix">
	<div class="row">
	  <div class="col-lg-12">
	  <!-- breadcrumb -->
		<ol class="breadcrumb breadcrumb-arrow">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li class="active"><span>Master Arsip Surat</span></li>
		</ol>
		<!-- End Breadcrumb -->

		<div class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Master Arsip Surat</a>
				</div>
			<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">

				<ul class="nav navbar-nav">
					<!-- <li><a href="<?php echo base_URL(); ?>administrator/master_arsip_surat/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li> -->
					<li>
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes" class="btn-info">Surat yang belum terarsip<span class="caret" style="border-top-color: white; border-bottom-color: white;"></span></a>
						  <ul class="dropdown-menu" aria-labelledby="themes">
							<li><a tabindex="-1" href="<?php echo base_url(); ?>administrator/master_arsip_surat/m_arsip_surat_keluar">Surat Keluar</a></li>
							<li><a tabindex="-1" href="<?php echo base_url(); ?>administrator/master_arsip_surat/m_arsip_surat_masuk">Surat Masuk</a></li>
						  </ul>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<?php if($q==0){ ?>
					<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>administrator/master_arsip_surat/cari">
					<?php }else if($q==1){ ?>
					<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>administrator/master_arsip_surat/cari2">
					<?php }else{ ?>
					<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>administrator/master_arsip_surat/cari3">
					<?php } ?>
						<input type="text" class="form-control" id="searchbox" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required><!-- ubah mei admin -->
						<!-- <button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button> -->
					</form>
				</ul>
			</div><!-- /.nav-collapse -->
			</div><!-- /.container -->
		</div><!-- /.navbar -->

	  </div>
	</div>
	<?php echo $this->session->flashdata("k"); ?>
	<?php if($this->uri->segment(3) == "m_arsip_surat"){?>
	<ul class="nav nav-tabs">
	  <li class="active"><a data-toggle="tab" href="#home">Arsip Surat Masuk</a></li>
	  <li><a data-toggle="tab" href="#menu1">Arsip Surat Keluar</a></li>
	</ul>
	<?php } else {} ?>
	<div class="tab-content">
	  <div id="home" class="tab-pane fade in active">
	    <center>
		<table class="table table-bordered table-hover" style="width: 100%;"  id="zame">
		<thead>
			<tr>
				<th width="">No</th>
				<th width="">No Agenda</th><?php if($q==0){ ?>
				<th width="">Jenis</th>
				<th width="">Perihal</th>
				<th width="">Asal Surat</th>
				<th width="">Nama Ruangan</th>
				<th width="">Nama Lemari</th>
				<th width="">Nama Rak</th>
				<th width="">Nama Box</th>
				<th width="">Aksi</th><?php }else{ ?>
				<th width="">Perihal</th>
				<th width="">Asal Surat</th>
                <th width="">Aksi</th> <?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php
			if(empty($data)){
				echo "<tr><td colspan='10'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
			}else{
				$no = 1;
				foreach ($data as $key) {
						if($this->uri->segment(3) == "m_arsip_surat" || $this->uri->segment(3) == "m_arsip_surat_masuk"){
							$dt1 = $this->db->query("SELECT * FROM notadinas.master_tujuan WHERE id = '$key->instansi'")->row();
						}
				?>
					<tr>
						<td style="text-align: center;"><?php echo $no ?></td><?php if($q==0){ ?>
						<td><?php echo $key->no_setum; ?></td>
						<td><?php
							$exp = explode('_',$key->tipe_surat);
							echo "<span style='text-transform:capitalize;'>$exp[0] $exp[1]</span>"
						?></td>
						<td><?php echo $key->perihal; ?></td>
						<td><?php echo $dt1->nama; ?></td>
						<td><?php echo $key->nama_ruang; ?></td>
						<td><?php echo $key->nama_lemari; ?></td>
						<td><?php echo $key->nama_rak; ?></td>
						<td><?php echo $key->nama_box; ?></td>
						<td style="text-align: center;">
							<!-- <a class="btn btn-success" href="<?php //echo site_url('administrator/master_arsip_surat/edit/'.$key->id_arsip_surat.''); ?>">Edit</a>
							<a class="btn btn-danger" href="<?php //echo site_url('administrator/master_arsip_surat/delete/'.$key->id_arsip_surat.''); ?>" onclick="return confirm('Apakah anda yakin?')">Hapus</a> -->
							<div class="btn-group">
								<center><a href="<?php echo base_URL(); ?>administrator/master_arsip_surat/edit/<?php echo $key->id_arsip_surat; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Edit</a></center>
								<center><a href="<?php echo base_URL(); ?>administrator/master_arsip_surat/delete/<?php echo $key->id_arsip_surat?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Hapus</a></center>
							</div>
						</td><?php }else{ ?>
						<?php if($this->uri->segment(3) == "m_arsip_surat_keluar"){
							$dt3 = $this->db->query("SELECT * FROM notadinas.master_user WHERE id = '$key->create_by'")->row();
						?>
						<td><?php echo $key->no_agenda; ?></td>
						<td><?php echo $key->perihal; ?></td>
						<td><?php echo $dt3->nama_lengkap; ?></td>
						<td><button class="btn btn-primary modal_tambah" data-toggle="modal" data-id= "<?php echo $key->no_agenda ?>" data-target="#modalTambah">
                                Arsip
                            </button></td>
						<?php } else if($this->uri->segment(3) == "m_arsip_surat_masuk"){ 
						?>
						<td><?php echo $key->no_setum; ?></td>
						<td><?php echo $key->perihal; ?></td>
                        <td><?php echo $dt1->nama; ?></td>
                        <td><button class="btn btn-primary modal_tambah" data-toggle="modal" data-id= "<?php echo $key->no_setum ?>" data-target="#modalTambah">
                                Arsip
                            </button></td>
                        <?php } ?>
<!--                    alhistolog-->
                        <!-- <td><button class="btn btn-primary modal_tambah" data-toggle="modal" data-id= "<?php echo $key->no_agenda ?>" data-target="#modalTambah">
                                Arsip
                            </button></td> -->
                        <?php } ?>
					</tr>
				<?php
				$no++;
				}
			}
			?>
		</tbody>
	</table>
<center><ul class="pagination"><?php ?></ul></center>
</center>
	  </div>
	  <div id="menu1" class="tab-pane fade">
	    <center>
		<table class="table table-bordered table-hover" style="width: 100%;"  id="zame2">
		<thead>
			<tr>
				<th width="">No</th>
				<th width="">No Agenda</th><?php if($q==0){ ?>
				<th width="">Jenis</th>
				<th width="">Perihal</th>
				<th width="">Asal Surat</th>
				<th width="">Nama Ruangan</th>
				<th width="">Nama Lemari</th>
				<th width="">Nama Rak</th>
				<th width="">Nama Box</th>
				<th width="">Aksi</th><?php }else{ ?>
				<th width="">Perihal</th>
				<th width="">Asal Surat</th>
				<th width="">Aksi</th><?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php
			if(empty($datas)){
				echo "<tr><td colspan='10'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
			}else{
				$no = 1;
				foreach ($datas as $key) {
					$dt2 = $this->db->query("SELECT * FROM notadinas.master_user WHERE id = '$key->create_by'")->row();
				?>
					<tr>
						<td style="text-align: center;"><?php echo $no ?></td>
						<td><?php echo $key->agenda; ?></td><?php if($q==0){ ?>
						<td><?php
							$exp = explode('_',$key->tipe_surat);
							echo "<span style='text-transform:capitalize;'>$exp[0] $exp[1]</span>"
						?></td>
						<td><?php echo $key->perihal; ?></td>
						<td><?php echo $dt2->nama_lengkap; ?></td>
						<td><?php echo $key->nama_ruang; ?></td>
						<td><?php echo $key->nama_lemari; ?></td>
						<td><?php echo $key->nama_rak; ?></td>
						<td><?php echo $key->nama_box; ?></td>
						<td style="text-align: center;">
							<!-- <a class="btn btn-success" href="<?php //echo site_url('administrator/master_arsip_surat/edit/'.$key->id_arsip_surat.''); ?>">Edit</a>
							<a class="btn btn-danger" href="<?php //echo site_url('administrator/master_arsip_surat/delete/'.$key->id_arsip_surat.''); ?>" onclick="return confirm('Apakah anda yakin?')">Hapus</a> -->
							<div class="btn-group">
								<center><a href="<?php echo base_URL(); ?>administrator/master_arsip_surat/edit/<?php echo $key->id_arsip_surat; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Edit</a></center>
								<center><a href="<?php echo base_URL(); ?>administrator/master_arsip_surat/delete/<?php echo $key->id_arsip_surat?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Hapus</a></center>
							</div>
						</td><?php }else{ ?>
						<td><?php echo $key->perihal; ?></td>
						<td><?php echo $dt2->nama_lengkap; ?></td>
						<td><button class="btn btn-primary modal_tambah" data-toggle="modal" data-id= "<?php echo $key->agenda ?>" data-target="#modalTambah"  onclick="$(document).ready(function() {document.getElementById('jenis_surat').value = 'surat_keluar'; });">
                                Arsip
                            </button></td>
					<?php } ?>
					</tr>
				<?php
				$no++;
				}
			}
			?>
		</tbody>
	</table>
<!-- <center><ul class="pagination"><?php //echo $pagik; ?></ul></center> -->
</center>
	  </div>
	</div>
</div>

<!--alhistolog-->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Arsip</h4>
            </div>

            <form action="<?php echo base_URL() ?>administrator/master_arsip_surat/save" method="post" id="formnya">


            <div class="modal-body">

                    <div class="row cs-modal">
                        <div class="col-md-12">
                            <input type="hidden" name="agenda" id="agenda" required>
                            <?php if($this->uri->segment(3) == "m_arsip_surat_keluar"){?>
                            <input type="hidden" name="jenis_surat" id="jenis_surat" value="surat_keluar" required>
                        <?php } else if($this->uri->segment(3) == "m_arsip_surat_masuk"){?>
                            <input type="hidden" name="jenis_surat" id="jenis_surat" value="surat_masuk" required>
                           <?php } ?>

                        </div>
                    </div>
                    <div class="row cs-modal form-group">
                        <div class="col-md-6">
                            Ruang
                        </div>
                        <div class="col-md-6">
                            <select class="form-control col-md-2" id="ruang"
                                    name="ruang" required>
                                <option value="" style="display:none;">Pilih</option>
                                <?php $ruang = $this->db->query("SELECT * FROM master_ruang")->result();
                                foreach ($ruang as $key) {
                                    echo "<option value='$key->id_ruang'>$key->nama_ruang</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row cs-modal form-group">
                        <div class="col-md-6">
                            lemari
                        </div>
                        <div class="col-md-6">
                            <select class="form-control col-md-2" id="lemari"
                                    name="lemari" required>
                                <option value="" style="display:none;">Pilih</option>
                            </select>
                        </div>
                    </div>
                    <div class="row cs-modal form-group">
                        <div class="col-md-6">
                            Rak
                        </div>
                        <div class="col-md-6">
                            <select class="form-control col-md-2" id="rak"
                                    name="rak" required>
                                <option value="" style="display:none;">Pilih</option>
                            </select>
                        </div>
                    </div>
                    <div class="row cs-modal form-group">
                        <div class="col-md-6">
                            Box
                        </div>
                        <div class="col-md-6">
                            <select class="form-control col-md-2" id="box"
                                    name="box" required>
                                <option value="" style="display:none;">Pilih</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>

            </form>
        </div>
    </div>
</div>
<!--alhistolog-->

<script>
$(window).load(function(){
    $('#zame').DataTable({
    	"searching": true,
    	 "bLengthChange" : false,
    	"bInfo":false
    });
});
$(window).load(function(){
    $('#zame2').DataTable({
    	"searching": true,
    	 "bLengthChange" : false,
    	"bInfo":false
    });
    document.getElementById('zame2_filter').style.display = "none";
});

$(window).load(function(){
    var dataTable = $('#zame').dataTable();
    var dataTable2 = $('#zame2').dataTable();
    $("#searchbox").keyup(function() {
        dataTable.fnFilter(this.value);
        dataTable2.fnFilter(this.value);
    });
});

//alhistolog
 $(".modal_tambah").click(function(){
     var agenda = $(this).data('id');
     $("#agenda").val(agenda)
         .prop('readonly', false);
 });

 function click_a(id,table,primary,where,result_,name){
     $.ajax({
         url: "<?php echo base_url(); ?>administrator/get_data_db_arsip",
         type: 'post',
         data: {
             id:id,
             table:table,
             primary:primary,
             where:where,
             name:name
         },
         success: function(result){
             $("#" + result_).html(result);
             if(table=="master_lemari"){
                 $("#rak").html("<option value='' style='display:none;'>Pilih</option>");
                 $("#box").html("<option value='' style='display:none;'>Pilih</option>");
             }else if(table=="master_rak"){
                 $("#box").html("<option value='' style='display:none;'>Pilih</option>");
             }
             // console.log(result);
         }
     });
 }

 $("#ruang").change(function(){
     click_a($('#ruang').val(),'master_lemari','id_lemari','id_ruang','lemari','nama_lemari');
 });
 $("#lemari").change(function(){
     click_a($('#lemari').val(),'master_rak','id_rak','id_lemari','rak','nama_rak');
 });
 $("#rak").change(function(){
     click_a($('#rak').val(),'master_box','id_box','id_rak','box','nama_box');
 });
// alhistolog
</script>
