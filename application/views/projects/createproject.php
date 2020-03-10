<div class="container" style="background-color: #e6ffe6;">
	<h1>Create Project</h1>

	<div class="row">
		<?php
		$tempdata = $this->session->flashdata('tempdata');
		$alert = "info";
		if (strpos(strtoupper($tempdata), "SORRY") > -1) {
			$alert = "danger";
		}
		if (isset($tempdata) && !empty($tempdata)) {
			?>
			<br>
			<div class="alert alert-<?= $alert; ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h5 class="text-center"> <?= $tempdata; ?></h5>
			</div>
			<?php
		}    ?>

		<?= form_open('/project/saveproject'); ?>
		<div class="container">
			<div class="form-group row">
				<label for="pname" class="col-sm-2 col-form-label col-form-label-sm ">Project Name</label>
				<div class="col-sm-5">
					<input type="text" class="form-control form-control-sm" id="pname" name="pname" placeholder="Project Name">
				</div>
			</div>
			<div class="form-group row">
				<label for="startdate" class="col-sm-2 col-form-label col-form-label-sm">Start Date</label>
				<div class="col-sm-5">
					<input type="date" class="form-control form-control-sm" id="startdate" name="startdate" placeholder="Start Date">
				</div>
			</div>

			<div class="form-group row">
				<label for="enddate" class="col-sm-2 col-form-label col-form-label-sm">End Date</label>
				<div class="col-sm-5">
					<input type="date" class="form-control form-control-sm" id="enddate" name="enddate" placeholder="End Date">
				</div>
			</div>  

			
			<div class="form-group row">
				<label for="phone" class="col-sm-2 col-form-label form-control-sm">Developer</label>
				<div class="col-sm-5">
					<select name="developer" class="form-control form-control-sm">
						<?php
						foreach ($developers as $dev) {
							echo '<option value="'.$dev['id'].'">'.$dev['fname'].'</option>';
						}
						?>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="phone" class="col-sm-2 col-form-label form-control-sm">Client</label>
				<div class="col-sm-5">
					<select name="client" class="form-control form-control-sm">
						<?php
						foreach ($clients as $client) {
							echo '<option value="'.$client['id'].'">'.$client['name'].'</option>';
						}
						?>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="phone" class="col-sm-2 col-form-label form-control-sm">Project Manager</label>
				<div class="col-sm-5">
					<select name="manager" class="form-control form-control-sm">
						<?php
						foreach ($managers as $projectsmanager) {
							echo '<option value="'.$projectsmanager['id'].'">'.$projectsmanager['pname'].'</option>';
						}
						?>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-sm-5">
					<input type="submit" class="btn btn-primary" value="Save">
				</div>
			</div>
		</div>
	</form>
</div>

</div>