<div class="clearfix">
<div class="row">
  <div class="col-lg-12">
	
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Nota Dinas</a>
			</div>
		<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
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
					<?php if ($b->flag == 'ASSIGNED') { ?>
						<div class="btn-group">
							<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
							<a href="<?php echo base_URL(); ?>admin/nota_dinas/entry/create_nota/<?php echo $b->ID; ?>" class="btn btn-warning btn-sm"><i class="icon-pencil icon-white"> </i>Create</a>
						</div>
					<?php } else if ($b->flag == 'WORKED ON' || $b->flag == 'PULLED BACK') {?>
						<div class="btn-group">
							<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
							<a href="<?php echo base_URL(); ?>admin/nota_dinas/entry/edit_nota/<?php echo $b->ID; ?>" class="btn btn-warning btn-sm"><i class="icon-edit icon-white"> </i>Edit</a>
							<a data-toggle="modal" href="#preview" class="btn btn-primary btn-sm previewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Nota</a>
							<a href="<?php echo base_URL(); ?>admin/nota_dinas/act/finalize_nota/<?php echo $b->ID?>" class="btn btn-success btn-sm"><i class="icon-share-alt icon-white"> </i>Finalize</a>
						</div>
					<?php } else if ($b->flag == 'COMPLETED') {?>
						<div class="btn-group">
							<a data-toggle="modal" href="#view" class="btn btn-info btn-sm viewNota" data-id="<?php echo $b->ID?>"><i class="icon-zoom-in icon-white"> </i>View Request</a>
							<a href="<?php echo base_URL(); ?>admin/nota_dinas/act/pullback/<?php echo $b->ID?>" class="btn btn-warning btn-sm"><i class="icon-arrow-left icon-white"></i>Pull Back</a>
							<a data-toggle="modal" href="#download" class="btn btn-success btn-sm downloadNota" data-id="<?php echo $b->ID?>"><i class="icon-download-alt icon-white"> </i>Download</a>
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

  <!-- Modal -->
  <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width: auto; max-width: 738px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Detail</h4>
        </div>
        <div class="modal-body">
		    <div id="notaContent">
		    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

<!-- Modal -->
  <div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: auto; max-width: 738px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Preview Surat</h4>
        </div>
        <div class="modal-body">
        	<textarea disabled id='textarea-view' class='editor-view'></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

<!-- Modal -->
  <div class="modal fade" id="download" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: auto; max-width: 738px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Download</h4>
        </div>
        <div class="modal-body">
        	<textarea disabled id='textarea-download' class='editor-download'></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

<center><ul class="pagination"><?php echo $pagi; ?></ul></center>
</div>
