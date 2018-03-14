<style type="text/css" media="screen">
	.row.text-center > div {
		display: inline-block;
		float: none;

		#modal-dialog { position: absolute; left: 0; right: 0; top: 0; bottom: 0; margin: auto; width: 500px; height: 300px; }
	}
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Mata Pelajaran</h5> 
				
			</div>
			<div class="ibox-content">
				<div class="row text-center">
					<?php foreach ($matpel as $k => $v): ?>
						<div class="col-md-2 col-sm-12 col-xs-12">
							<a style="width: 100%" href="<?php echo base_url('personalia/kelolasoal/') . $v['id_pelajaran'] ?>" class="btn btn-primary"><?php echo $v['nama_pelajaran'] ?></a>
						</div>

					<?php endforeach ?>
				</div>
			</div>
			<div class="ibox-content">

				<div class="panel-body">
					<div class="col-md-6">
						<?php if ($this->uri->segment(3)): ?>
							<span class="font-bold"><?php echo $matpel_single['nama_pelajaran'] ?></span>

						<?php endif ?>
					</div>
					<div class="col-md-6">
						<?php if ($this->uri->segment(3)): ?>
							<button type="button" class="btn btn-info " onclick="showModals()" id="btn-tambah-data" style="float:right">Tambah Data</button>
						<?php endif ?>
					</div>


					<div class="clearfix"></div>
					<div class="panel-group" id="accordion" >

						<?php $no = 1; foreach ($soal as $k => $v): ?>
						<div class="panel panel-default animated slideInDown">
							<div class="panel-heading">
								<h5 class="panel-title">
								</h5>
								<a   class="btn btn-sm btn-outline btn-default"  data-toggle="collapse" data-parent="#accordion" href="#collapse-soal-<?=$v['id_soal']?>"><?= $no++. '. ' . substr($v['soal'], 0,50) . '...'?></a>
								<div class="btn-group pull-right ">
									<a class="btn btn-warning btn-xs" onclick="showModals('<?php echo $v['id_soal'] ?>')"><i class="glyphicon glyphicon-pencil" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Edit</a>
									<a class="btn btn-danger btn-xs" onclick="deleteSoal('<?php echo $v['id_soal'] ?>')"><i class="glyphicon glyphicon-remove" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Hapus</a>
								</div>
							</div>
							<div id="collapse-soal-<?=$v['id_soal']?>" class="panel-collapse collapse ">
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th colspan="2"><?php echo $v['soal']; ?></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($pilihan as $k_pilihan => $v_pilihan): ?>
												<?php if ($v['jawaban'] === $k_pilihan): ?>
													<tr class="bg-info">
														<td width="2%"><?php echo $k_pilihan . '.' ; ?></td>
														<td><?php echo $v[$v_pilihan] ?></td>
													</tr>
													<?php else: ?>
														<tr>
															<td width="2%"><?php echo $k_pilihan . '.' ; ?></td>
															<td><?php echo $v[$v_pilihan] ?></td>
														</tr>
													<?php endif ?>

												<?php endforeach ?>

											</tbody>
										</table>
									</div>
								</div>
							</div>
						<?php endforeach ?>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal inmodal fade" id="modal-soal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog ">
		<div class="modal-content animated rubberBand">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit</h4>
			</div>
			<div class="modal-body">
				<form method="get" class="form-horizontal" id="form-soal">
					<div class="modal-body">
						<input type="hidden" id="id_pelajaran" name="id_pelajaran" value="<?php echo $matpel_single['id_pelajaran']; ?>">
						<input type="hidden" id="id_soal" name="id_soal" value="">
						<input type="hidden" class="form-control" id="type" name="type">
						<div class="form-group">
							<label class="col-sm-2 control-label">Soal</label>
							<div class="col-sm-10">
								<textarea required name="soal" id="soal" class="form-control" ></textarea>
							</div>
						</div>
						<div class="hr-line-dashed">
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Opsi A</label>

							<div class="col-sm-10">
								<input type="text" required name="pilihan_A" id="pilihan_A" class="form-control">
							</div>
						</div>
						<div class="hr-line-dashed">
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Opsi B</label>

							<div class="col-sm-10">
								<input type="text" required name="pilihan_B" id="pilihan_B" class="form-control">
							</div>
						</div>
						<div class="hr-line-dashed">
						</div>


						<div class="form-group">
							<label class="col-sm-2 control-label">Opsi C</label>

							<div class="col-sm-10">
								<input type="text" required name="pilihan_C" id="pilihan_C" class="form-control">
							</div>
						</div>
						<div class="hr-line-dashed">
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Opsi D</label>

							<div class="col-sm-10">
								<input type="text" required name="pilihan_D" id="pilihan_D" class="form-control">
							</div>
						</div>
						<div class="hr-line-dashed"></div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Jawaban</label>

							<div class="col-sm-10"><select class="form-control m-b" id="jawaban" name="jawaban" required="">
								<?php foreach ($pilihan as $k => $v): ?>
									<option value="<?php echo $k; ?>"><?php echo $k; ?></option>}
								<?php endforeach ?>
							</select></div>
						</div>

						<div class="alert alert-danger" role="alert" id="removeWarning">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							<span class="sr-only">Error:</span>
							Anda yakin ingin menghapus Soal Ini ?
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" id="submit" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>




<script type="text/javascript">
	$(function() {

		$("#form-soal").submit(function(e){
			e.preventDefault();
			submitSoal();
		});



	});



	function showPleaseWait() {
		var modalLoading = '<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false role="dialog">\
  <div class="modal-dialog" id="modal-dialog">\
  <div class="modal-content">\
  <div class="modal-body">\
  <div class="sk-spinner sk-spinner-three-bounce">\
  <div class="sk-bounce1"></div>\
  <div class="sk-bounce2"></div>\
  <div class="sk-bounce3"></div>\
  </div>\
  </div>\
  </div>\
  </div>\
  </div>';
		$(document.body).append(modalLoading);
		$("#pleaseWaitDialog").modal("show");
	}

	function hidePleaseWait() {
		$("#pleaseWaitDialog").modal("hide");
	}


 //Tampilkan Modal 
 function showModals( id )
 {
 	showPleaseWait();
 	clearModals();

 	if( id )
 	{
 		$.ajax({
 			type: "POST",
 			url: "<?php echo base_url('personalia/kelola_soal_crud'); ?>",
 			dataType: 'json',
 			data: {id_soal:id,type:"get"},
 			success: function(res) {
 				hidePleaseWait();
 				setModalData(res);
 			}
 		});
 	}
 	else
 	{

 		var matpel = "<?php echo $matpel_single['nama_pelajaran'] ?>";
 		hidePleaseWait();
 		$("#modal-soal").modal("show");
 		$("#myModalLabel").html("Tambah Soal " + matpel);
 		$("#type").val("new"); 
 		
 	}
 }

 function setModalData( data )
 {

 	var matpel = "<?php echo $matpel_single['nama_pelajaran'] ?>";
 	$("#myModalLabel").html("Edit Soal " + matpel);
 	$("#id_soal").val(data.id_soal);
 	$("#type").val("edit");
 	$("#soal").val(data.soal);
 	$("#pilihan_A").val(data.pilihan_A);
 	$("#pilihan_B").val(data.pilihan_B);
 	$("#pilihan_C").val(data.pilihan_C);
 	$("#pilihan_D").val(data.pilihan_D);
 	$("#pilihan_D").val(data.pilihan_D);
 	$("#jawaban").val(data.jawaban);

 	$("#modal-soal").modal("show");
 }

 function submitSoal()
 {
 	var formData = $("#form-soal").serialize();
 	showPleaseWait();

 	$.ajax({
 		type: "POST",
 		url: "<?php echo base_url('personalia/kelola_soal_crud'); ?>",
 		dataType: 'json',
 		data: formData,
 	})
 	.done(function() {
 		console.log("success");
 		hidePleaseWait();	
 		window.location = "<?php echo base_url('personalia/kelolasoal/') . $this->uri->segment(3) ?>";
 	})
 	.fail(function() {
 		console.log("error");
 		hidePleaseWait();
 	})
 	.always(function() {
 		console.log("complete");
 	});

 }

 function deleteSoal( id )
 {
 	var matpel = "<?php echo $matpel_single['nama_pelajaran'] ?>";

 	clearModals();
 	$.ajax({
 		type: "POST",
 		url: "<?php echo base_url('personalia/kelola_soal_crud'); ?>",
 		dataType: 'json',
 		data: {id_soal:id,type:"get"},
 		success: function(data) {
 			$("#removeWarning").show();
 			$("#myModalLabel").html("Delete Soal 	" + matpel);
 			$("#id_soal").val(data.id_soal);
 			$("#type").val("delete");
 			$("#soal").val(data.soal).attr("disabled","true");
 			$("#pilihan_A").val(data.pilihan_A).attr("disabled","true");
 			$("#pilihan_B").val(data.pilihan_B).attr("disabled","true");
 			$("#pilihan_C").val(data.pilihan_C).attr("disabled","true");
 			$("#pilihan_D").val(data.pilihan_D).attr("disabled","true");
 			$("#pilihan_D").val(data.pilihan_D).attr("disabled","true");
 			$("#jawaban").val(data.jawaban).attr("disabled","true");
 			
 			$("#modal-soal").modal("show");
 			hidePleaseWait();			
 		}
 	});
 }

 function clearModals()
 {
 	$("#removeWarning").hide();
 	$("#id_soal").val("").removeAttr( "disabled" );
 	$("#soal").val("").removeAttr( "disabled" );
 	$("#pilihan_A").val("").removeAttr( "disabled" );
 	$("#pilihan_B").val("").removeAttr( "disabled" );
 	$("#pilihan_C").val("").removeAttr( "disabled" );
 	$("#pilihan_D").val("").removeAttr( "disabled" );
 	$("#pilihan_D").val("").removeAttr( "disabled" );
 	$("#jawaban").val("").removeAttr( "disabled" );
 }

</script>



