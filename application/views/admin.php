<?php $this->load->view('includes/navbar-admin'); ?>
<?php  date_default_timezone_set("Asia/Manila")?>
<!--===========================
=            Cards            =
============================-->

<div class="row">
	<div class="col s3">
		<div class="row">
			<div class="card">
				<div class="card-content bg-primary-yellow">
					<p class="a-oswald flow-text">Good Day, Admin!</p>
					<p class="a-oswald flow-text">TODAY IS</p>
					<h4 class="a-oswald color-white center"><?=date("M d, Y", time())?></h4>
				</div>
			</div>
		</div>
		<div class="row">
			<h4>Actions</h4>
			<ul class="collapsible" data-collapsible="accordion">
				<li>
					<div class="collapsible-header bg-primary-green color-white"><i class="material-icons ">chrome_reader_mode</i>Reports</div>
					<div class="collapsible-body">
						<div class="card" id="card-cosml">
							<div class="card-content bg-primary-green">
								<h6 class="a-oswald color-white  valign-wrapper">Course Offering Schedule Master List <i class="material-icons">keyboard_arrow_right</i></h6>
							</div>
						</div>
						<div class="card" id="card-ls">
							<div class="card-content bg-primary-green">
								<h6 class="a-oswald color-white  valign-wrapper">Lecturers' Schedule <i class="material-icons">keyboard_arrow_right</i></h6>
							</div>
						</div>
						<div class="card" id="card-lahr">
							<div class="card-content bg-primary-green">
								<h6 class="a-oswald color-white  valign-wrapper">Lecturers' Attendance and Hours Rendered <i class="material-icons">keyboard_arrow_right</i></h6>
							</div>
						</div>
						<div class="card" id="card-lcl">
							<div class="card-content bg-primary-green">
								<h6 class="a-oswald color-white  valign-wrapper">Lecturers' Class List <i class="material-icons">keyboard_arrow_right</i></h6>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="collapsible-header bg-primary-green color-white"><i class="material-icons">content_paste</i>Class Offering Management</div>
					<div class="collapsible-body valign-wrapper">
						<p><i>This section provides some function that manages the course offering, function includes updating and deleting the course offerings</i></p>
						<center>
							<button class="btn valign-wrapper" id="btn_show_clof">Show List</button>
						</center>
					</div>
				</li>
				<li>
					<div class="collapsible-header bg-primary-green color-white"><i class="material-icons">input</i>Data Insertion</div>
					<div class="collapsible-body">
						<p><i>This section provides insertion functions using excel file</<i></p>
							<center>
								<a class="btn valign-wrapper" href="<?=base_url()?>importdata ">Insert Data</a>
							</center>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="col s9">
			
			<div class="row" id="div-card-cosml" style="display: none;">
				<blockquote class="color-primary-green">
					<h2>Course Offering Schedule Master List</h2>
				</blockquote>
				<table id="tbl-card-cosml" >
					<thead >
						<tr>
							<th>ID</th>
							<th>Course Code</th>
							<th>Course Title</th>
							<th>Section</th>
							<th>Day</th>
							<th>Start Time</th>
							<th>End Time</th>
							<th>Venue</th>
							<th>Assigned Professor</th>
							<th>Term</th>
							<th>School Year</th>
						</tr>
					</thead>
					<tbody class="bg-color-white">

						<?php if ($div_cosml_data): ?>
							<?php foreach ($div_cosml_data as $key => $value): ?>
								<tr class="bg-color-white">
									<td><?= $value->schedule_id ?></td>
									<td><?= strtoupper($value->course_code) ?></td>
									<td><?= ucwords($value->course_title) ?></td>
									<td><?= strtoupper($value->course_section) ?></td>
									<td><?= date("l",$value->schedule_start_time) ?></td>
									<td><?= date("h:i A",$value->schedule_start_time) ?></td>
									<td><?= date("h:i A",$value->schedule_end_time) ?></td>
									<td><?= strtoupper($value->schedule_venue) ?></td>
									<td><?= ucwords($value->professor_name) ?></td>
									<td><?= $value->term ?></td>
									<td><?= $value->sy ?></td>
								</tr>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
			</div>
			<div class="row " id="div-card-ls" style="display: none;">
				<blockquote class="color-primary-green">
					<h2>Lecturers' Schedule</h2>
				</blockquote>
				<table id="tbl-card-ls" >
					<thead >
						<tr>
							<th>ID</th>
							<th>Last Name</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Course Code</th>
							<th>Day</th>
							<th>Start Time</th>
							<th>End Time</th>
							<th>Venue</th>
							<th>Expertise</th>
							<th>Status</th>
						</tr>
					</thead>

					<tbody class="bg-color-white">
						<?php if ($lecturer): ?>
							<?php foreach ($div_cosml_data as $key => $value): ?>
								<tr class="bg-color-white">
									<td><?= $value->lecturer_id ?></td>
									<td><?= ucwords($value->lecturer_firstname) ?></td>
									<td><?= ucwords($value->lecturer_middlename) ?></td>
									<td><?= ucwords($value->lecturer_lastname) ?></td>
									<td><?= strtoupper($value->course_code) ?></td>
									<td><?= date("l",$value->schedule_start_time) ?></td>
									<td><?= date("h:i A",$value->schedule_start_time) ?></td>
									<td><?= date("h:i A",$value->schedule_end_time) ?></td>
									<td><?= strtoupper($value->schedule_venue) ?></td>
									<td><?= ucwords($value->lecturer_expertise) ?></td>
									<td>
										<?php if ($value->lecturer_status == 1): ?>
											<p class="color-green">Active</p>
										<?php else: ?>
											<p class="color-red">Inactive</p>
										<?php endif ?>
									</td>
								</tr>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
			</div>
			<div class="row" id="div-card-lahr" style="display: none;">
				<blockquote class="color-primary-green">
					<h2>Lecturers' Attendance and Hours Rendered</h2>
				</blockquote>
				<table id="tbl-card-lahr" >
					<thead >
						<tr>
							<th>ID</th>
							<th>Last Name</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Expertise</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody class="bg-color-white">
						<?php if ($div_cosml_data): ?>
							<?php foreach ($div_cosml_data as $key => $value): ?>
								<tr class="bg-color-white">
									<td><?= $value->lecturer_id ?></td>
									<td><?= ucwords($value->lecturer_firstname) ?></td>
									<td><?= ucwords($value->lecturer_middlename) ?></td>
									<td><?= ucwords($value->lecturer_lastname) ?></td>
									<td><?= ucwords($value->lecturer_expertise) ?></td>
									<td>
										<?php if ($value->lecturer_status == 1): ?>
											<p class="color-green">Active</p>
										<?php else: ?>
											<p class="color-red">Inactive</p>
										<?php endif ?>
									</td>
									<td>
										<a href="<?=base_url()?>Admin/viewAttendance/<?=$value->lecturer_id?>" target="_blank" class="btn waves-effect waves-light ">View</a>
									</td>
									<td><button class="btn waves-effect waves-light">Download</button></td>
								</tr>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
				
			</div>

			<div class="row" id="div-card-lcl" style="display: none;">
				<blockquote class="color-primary-green">
					<h2>Lecturers' Class List</h2>
				</blockquote>
				<table id="tbl-card-lahr" >
					<thead >
						<tr>
							<th>ID</th>
							<th>Last Name</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Expertise</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody class="bg-color-white">
						<?php if ($div_cosml_data): ?>
							<?php foreach ($div_cosml_data as $key => $value): ?>
								<tr class="bg-color-white">
									<td><?= $value->lecturer_id ?></td>
									<td><?= ucwords($value->lecturer_firstname) ?></td>
									<td><?= ucwords($value->lecturer_middlename) ?></td>
									<td><?= ucwords($value->lecturer_lastname) ?></td>
									<td><?= ucwords($value->lecturer_expertise) ?></td>
									<td>
										<?php if ($value->lecturer_status == 1): ?>
											<p class="color-green">Active</p>
										<?php else: ?>
											<p class="color-red">Inactive</p>
										<?php endif ?>
									</td>
									<td>
										<a href="<?=base_url()?>Admin/viewClassList/<?=$value->lecturer_id?>" target="_blank" class="btn waves-effect waves-light ">View</a>
									</td>
									<td><button class="btn waves-effect waves-light">Download</button></td>
								</tr>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
			</div>

			<div class="row" id="div-card-clof" style="display: none;">
				<blockquote class="color-primary-green">
					<h2>Class Offering</h2>
				</blockquote>
				<table id="tbl-com">
					<thead>
						<tr>
							<td>ID</td>
							<td>Course Code</td>
							<td>Course Title</td>
							<td>Program</td>
							<td>Course Section</td>
							<td>Actions</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php if ($offering): ?>
							<?php foreach ($offering as $key => $value): ?>
								<tr class="bg-color-white">
									<script type="text/javascript">
										jQuery(document).ready(function($) {
											shorten_text("<?=$value->offering_course_title?>","<?=$value->offering_id?>");
										});
									</script>
									<td><?=$value->offering_id?></td>
									<td><?=strtoupper($value->offering_course_code)?></td>
									<td class="title_trunc<?=$value->offering_id?>" style="text-transform: capitalize;"></td>
									<td><?=strtoupper($value->offering_program)?></td>
									<td><?=strtoupper($value->offering_section)?></td>
									<td><i class="material-icons color-primary-green btn_modal_com modal-trigger" data-id="<?=$value->offering_id?>" href="#modal_com" style="cursor: pointer;">edit</i></td>
									<td><i class="material-icons color-red btn_delete_com" data-id="<?=$value->offering_id?>" style="cursor: pointer;">delete</i></td>
								</tr>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>	

	<!--====  End of Cards  ====-->

<!--===========================================
=            Modal Course Offering            =
============================================-->

<div id="modal_com" class="modal bg-color-white">
	<div class="modal-content">
		<blockquote class="color-primary-green">
			<h4>Edit Class Offering</h4>
		</blockquote>
		<div class="row">
			<div class="row">
				<div class="col s2"></div>
				<div class="col s8">
					<div class="row">
						<div class="input-field">
							<input placeholder="" style="text-transform:uppercase" id="" type="text" class="validate correl-code">
							<label for="correl-code">Course Code</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field">
							<input placeholder="" style="text-transform:uppercase" id="" type="text" class="validate correl-title">
							<label for="correl-title">Course Title</label>
						</div>
					</div>
				</div>
				<div class="col s2"></div>
			</div>
		</div>
	</div>
	<div class="modal-footer bg-color-white">
		<a href="#!" class="modal-action modal-close waves-effect waves-light btn red left">Cancel</a>
		<a href="#!" id="btn_modal_com_update"  class="waves-effect waves-light btn green right">Update</a>
	</div>
</div>

<!--====  End of Modal Course Offering  ====-->

<script type="text/javascript">

	jQuery(document).ready(function($) {
		$(".btn_modal_com").click(function(event) {
			$("#btn_modal_com_update").attr("data-id", $(this).attr("data-id"));
			$.ajax({
				url: '<?=base_url()?>Admin/fetchOffering ',
				type: 'post',
				dataType: 'json',
				data: {id: $(this).attr("data-id")},
				success: function(data){
					$(".correl-code").val(data[0].offering_course_code);
					$(".correl-title").val(data[0].offering_course_title);

				},
				error: function(data){

				}
			});
		});		

		$("#btn_modal_com_update").click(function(event) {
			$.ajax({
				url: '<?=base_url()?>Admin/updateOffering ',
				type: 'post',
				dataType: 'json',
				data: {
					id: $(this).attr("data-id"),
					title: $(".correl-title").val(),
					code: $(".correl-code").val(),
				},
				success:function(data){
					if (data) {
						swal("Done!", "Successfully edited", "success").then(function(){
							window.location.reload(true);
						});
					}
				},
				error: function(data){

				}
			});
		});

		$(".btn_delete_com").click(function(event) {

			swal({
				title: "Are you sure?",
				text: "This may cause inconsistency of data in the system!",
				icon: "error",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						url:"<?=base_url()?>Admin/deleteOffering ",
						type: "post",
						dataType: "json",
						data:{
							id:$(this).attr("data-id")
						},
						success: function(data){
							swal("Poof! Offering has been deleted!", {
								icon: "success",
							}).then(function(){
								window.location.reload(true);
							});
						},
						error: function(data){

						}

					});

				} 
			});

		});

	});


	function shorten_text(text,id) {
		var ret = text;
		if (ret.length > 20) {
			ret = ret.substr(0,20-3) + "...";
		}

		$(".title_trunc"+id).html(ret);
	}

</script>




