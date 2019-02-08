<div class="clearfix">
<div class="row">
  <div class="col-lg-12">
	
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Nota Dinas</a>
			</div>
		<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_URL(); ?>admin/nota_dinas/entry/new_request" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>admin/nota_dinas/view/<?php echo $this->uri->segment(4);?>/search">
					<input type="text" class="form-control" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required>
					<button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button>
				</form>
			</ul>
		</div><!-- /.nav-collapse -->
		</div><!-- /.container -->
	</div><!-- /.navbar -->

  </div>
</div>

<?php echo $this->session->flashdata("k");?>
	
<!--	
<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Well done!</strong> You successfully read <a href="http://bootswatch.com/amelia/#" class="alert-link">this important alert message</a>.
</div>
	
<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Oh snap!</strong> <a href="http://bootswatch.com/amelia/#" class="alert-link">Change a few things up</a> and try submitting again.
</div>	
-->

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th width="3%">No.</th>
			<th width="10%">Jenis Surat</th>
			<th width="10%">Pemohon</th>
			<th width="7%">Status</th>
			<th width="30%">Aksi</th>
		</tr>
	</thead>
	
	<tbody>
		<?php 
		if (empty($data)) {
			echo "<tr><td colspan='10'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
		} else {
			$no 	= $this->uri->segment(6);

			foreach ($data as $b) {
		?>
			<tr>
				<td><?php $no+=1; echo $no;?></td>
				<td><?php echo $b->jenis;?></td>
				<td><?php echo $b->j_pemohon;?></td>
				<td><?php echo $b->flag ." by ".$b->j_log." on ".$b->created_at;?></td>
				<td class="ctr aksi">
					<?php if ($b->flag == 'CREATED') { ?>
						<div class="btn-group">
							<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
							<a href="<?php echo base_URL(); ?>admin/nota_dinas/entry/edit_request/<?php echo $b->ID; ?>" class="btn btn-warning btn-sm"><i class="icon-edit icon-white"></i>Edit</a>
						<?php if ($this->session->userdata('admin_tingkatan') == TINGKATAN_TU_BIRO) { ?>
							<a data-toggle="modal" href="#addComment" class="btn btn-success btn-sm addComment send" data-id="<?php echo $b->ID?>"><i class="icon-envelope icon-white"> </i>Send</a>
						<?php } else { ?>
							<a data-toggle="modal" href="#addComment" class="btn btn-success btn-sm addComment completed" data-id="<?php echo $b->ID?>"><i class="icon-envelope icon-white"> </i>Send</a>
						<?php } ?>
						</div>
					<?php } else if ($b->flag == 'EDITED') {?>
						<div class="btn-group">
							<?php if ($b->penerima == $this->session->userdata('admin_id')) { ?>
							
								<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
								<a href="<?php echo base_URL(); ?>admin/nota_dinas/entry/edit_request/<?php echo $b->ID; ?>" class="btn btn-warning btn-sm"><i class="icon-edit icon-white"> </i>Edit</a>
								<a data-toggle="modal" href="#addComment" class="btn btn-success btn-sm addComment send" data-id="<?php echo $b->ID?>"><i class="icon-envelope icon-white"> </i>Send</a>
							<?php } else { ?>
								<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
							<?php } ?>
						</div>
					<?php } else if ($b->flag == 'SENT') {?>
						<div class="btn-group">
							<?php if ($b->penerima == $this->session->userdata('admin_id')) { ?>
								<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
								<a data-toggle="modal" href="#addComment" class="btn btn-success btn-sm addComment approve" data-id="<?php echo $b->ID?>"><i class="icon-ok icon-white"> </i>Approve</a>
								<a data-toggle="modal" href="#addComment" class="btn btn-danger btn-sm addComment reject" data-id="<?php echo $b->ID?>"><i class="icon-remove icon-white"> </i> Reject</a>
							<?php } else { ?>
								<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
							<?php } ?>
						</div>
					<?php } else if ($b->flag == 'APPROVED') {?>
						<div class="btn-group">
							<?php if ($b->penerima == $this->session->userdata('admin_id')) { ?>
								<?php if ($b->status == STATUS_DISETUJUI_SESJEN) { ?>
									<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
									<a data-toggle="modal" href="#addComment" class="btn btn-success btn-sm addComment assign" data-id="<?php echo $b->ID?>"><i class="icon-ok icon-white"> </i>Assign</a>
								<?php } else if ($b->status == STATUS_BIRO_UMUM)  { ?>
									<a href="<?php echo base_URL(); ?>admin/nota_dinas/entry/edit_request/<?php echo $b->ID; ?>" class="btn btn-warning btn-sm"><i class="icon-edit icon-white"> </i>Edit</a>
									<a data-toggle="modal" href="#approve" class="btn btn-success btn-sm optionBiro" data-id="<?php echo $b->ID?>"><i class="icon-ok icon-white"> </i> Approve</a>
									<a data-toggle="modal" href="#addComment" class="btn btn-danger btn-sm addComment reject" data-id="<?php echo $b->ID?>"><i class="icon-remove icon-white"> </i> Reject</a>
									
								<?php } else { ?>
								<?php if ($this->session->userdata('admin_tingkatan') == TINGKATAN_TU_BIRO) { ?>
									<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
								<?php } else { ?>
								<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
									<a data-toggle="modal" href="#addComment" class="btn btn-success btn-sm addComment approve" data-id="<?php echo $b->ID?>"><i class="icon-ok icon-white"> </i>Approve</a>
									<a data-toggle="modal" href="#addComment" class="btn btn-danger btn-sm addComment reject" data-id="<?php echo $b->ID?>"><i class="icon-remove icon-white"> </i> Reject</a>
								<?php } ?>
								<?php } ?>
							<?php } else { ?>
								<?php if ($this->session->userdata('admin_tingkatan') == TINGKATAN_SESJEN) { ?>
								<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
								<a href="<?php echo base_URL(); ?>admin/nota_dinas/entry/edit_request_setum/<?php echo $b->ID; ?>" class="btn btn-warning btn-sm"><i class="icon-edit icon-white"> </i>Edit</a>
								<?php } else { ?>
								<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
								<?php } ?>
							<?php } ?>
						</div>
					<?php } else if ($b->flag == 'REJECTED') {?>
						<div class="btn-group">
							<?php if ($b->penerima == $this->session->userdata('admin_id')) { ?>
								<?php if ($b->pemohon == $this->session->userdata('admin_id')) { ?>
									<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
									<a href="<?php echo base_URL(); ?>admin/nota_dinas/entry/edit_request/<?php echo $b->ID; ?>" class="btn btn-warning btn-sm"><i class="icon-edit icon-white"> </i>Edit</a>
								<?php } else { ?>
									<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
									<a href="<?php echo base_URL(); ?>admin/nota_dinas/entry/edit_request/<?php echo $b->ID; ?>" class="btn btn-warning btn-sm"><i class="icon-edit icon-white"> </i>Edit</a>
									<a data-toggle="modal" href="#addComment" class="btn btn-danger btn-sm addComment pass" data-id="<?php echo $b->ID?>"><i class="icon-circle-arrow-left icon-white"> </i> Pass</a>
								<?php } ?>
							<?php } else { ?>
								<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
							<?php } ?>
						</div>
					<?php } else if ($b->flag == 'PASSED') {?>
						<div class="btn-group">
							<?php if ($b->penerima == $this->session->userdata('admin_id')) { ?>
								<?php if ($b->pemohon == $this->session->userdata('admin_id')) { ?>
									<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
									<a href="<?php echo base_URL(); ?>admin/nota_dinas/entry/edit_request/<?php echo $b->ID; ?>" class="btn btn-warning btn-sm"><i class="icon-edit icon-white"> </i>Edit</a>
								<?php } else { ?>
									<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
									<a href="<?php echo base_URL(); ?>admin/nota_dinas/entry/edit_request/<?php echo $b->ID; ?>" class="btn btn-warning btn-sm"><i class="icon-zoom-in icon-white"> </i>Edit</a>
									<a data-toggle="modal" href="#addComment" class="btn btn-danger btn-sm addComment pass" data-id="<?php echo $b->ID?>"><i class="icon-circle-arrow-left icon-white"> </i> Pass</a>
								<?php } ?>
							<?php } else { ?>
								<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
							<?php } ?>
						</div>
					<?php } else if ($b->flag == 'ASSIGNED') {?>
						<div class="btn-group">
							<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
						</div>
					<?php } else if ($b->flag == 'WORKED ON') {?>
						<div class="btn-group">
							<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
						</div>
					<?php } else if ($b->flag == 'PULLED BACK') {?>
						<div class="btn-group">
							<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
						</div>
					<?php } else if ($b->flag == 'COMPLETED') {?>
						<div class="btn-group">
							<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
						</div>
					<?php } ?>
				</td>
			</tr>
		<?php 
			}
		}
		?>
	</tbody>
</table>


  <!-- Modal Komentar Biro dan Sesjen-->
  <div class="modal fade" id="addComment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Komentar/Instruksi</h4>
        </div>
        <form id="form_komentar" action="" method="post" accept-charset="utf-8" enctype="multipart/form-data" class="form-horizontal" novalidate>
	        <div class="modal-body">
	        	<input type="hidden" id="id_nota" name="id" value="">
			    <div class="form-group">
			        <textarea name="komentar" id="komentar" tabindex="1" class="editor-field" autofocus required></textarea>
			    </div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
	          <button type="submit" class="btn btn-sm btn-default" id="submit_komentar"></button>
	        </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <!-- Modal Option Biro-->
  <div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Pilihan</h4>
        </div>
        <div class='modal-body'>
          <a data-dismiss="modal" data-toggle="modal" href="#addComment" class="btn btn-success btn-sm addComment to_sesjen">Teruskan ke Sesjen</a>
          <a data-dismiss="modal" data-toggle="modal" href="#addComment" class="btn btn-success btn-sm addComment to_tata_usaha">Tugaskan ke Tata Usaha</a>
          <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <!-- Modal -->
  <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: auto; max-width: 738px;">
      <div class="modal-content" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Detail</h4>
        </div>
        <div class="modal-body">
		    <div class="form-group" id="notaContent">
		    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


<center><ul class="pagination"><?php echo $pagi; ?></ul></center>
</div>
