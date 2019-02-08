<div class="clearfix">
<div class="row">
  <div class="col-lg-12">
	<ol class="breadcrumb breadcrumb-arrow">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li class="active"><span>Master Aksi</span></li>
		</ol>
		<div class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Master Aksi</a>
				</div>
			<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
			<ul class="nav navbar-nav">
										<li><a href="<?php echo base_URL(); ?>admin/tambahaksi" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
									</ul>
				<ul class="nav navbar-nav navbar-right">
					<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>administrator/master_tujuan/cari">
						<input id="searchbox" type="text" class="form-control" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required>
						<!-- <button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button> -->
					</form>
				</ul>
			</div><!-- /.nav-collapse -->
			</div><!-- /.container -->
		</div><!-- /.navbar -->

	<table class="table table-bordered table-hover" id="exc">
		<thead>
			<tr>
				<th width="10%">No</th>
				<th>Aksi</th>
				<th>Urutan View</th>
				<th width="15%">Aksi</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
  </div>
</div>
</div>
<!-- Modal -->
<div id="infoUser" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <table class="table table-bordered">
			<tr>
				<th width="20%">Nama</th>
				<th class="_nama _fillable">Tidak ada data</th>
			</tr>
			<tr>
				<th>Username</th>
				<th class="_username _fillable">Tidak ada data</th>
			</tr>
			<tr>
				<th>Jabatan</th>
				<th class="_jabatan _fillable">Tidak ada data</th>
			</tr>
			<tr>
				<th>Satuan</th>
				<th class="_satuan _fillable">Tidak ada data</th>
			</tr>
			<tr>
				<th>Tingkatan</th>
				<th class="_tingkatan _fillable">Tidak ada data</th>
			</tr>
			<tr>
				<th>Waktu</th>
				<th class="_waktu _fillable">Tidak ada data</th>
			</tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var dt = $('#exc').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "<?= base_url(); ?>admin/aksi_data",
    	"searching": true,
    	"bLengthChange" : false,
    	"bInfo":false
    } );
    $("#searchbox").keyup(function() {
        // dt.fnFilter($("#searchbox").val());
		dt.search($("#searchbox").val()).draw();
    });
	$('.dataTables_filter').css('display','none');
} );
function f(a){
	$("#infoUser").modal('show');
	$('._nama').html($(a+" ._dataNama").html());
	$('._username').html($(a+" ._dataUsername").html());
	$('._jabatan').html($(a+" ._dataJabatan").html());
	$('._satuan').html($(a+" ._dataSatuan").html());
	$('._tingkatan').html($(a+" ._dataTingkatan").html());
	$('._waktu').html($(a+" ._dataDatetime").html());
}
$('#infoUser').on('hidden.bs.modal', function () {
	$("._fillable").val("Tidak ada data");
});
</script>