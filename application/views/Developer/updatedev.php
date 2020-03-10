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
	<?= form_open('/developer/saveupdate'); ?>
	<div class="form-group row">
		<label for="fname" class="col-sm-2 col-form-label col-form-label-sm ">First name</label>
		<input type="hidden" name="theid" value="<?=$id?>">
		<div class="col-sm-5">
			<input type="text" class="form-control form-control-sm" id="fname" name="fname" value="<?=$fname;?>">
		</div>
	</div>
	<div class="form-group row">
		<label for="sname" class="col-sm-2 col-form-label col-form-label-sm">Second name</label>
		<div class="col-sm-5">
			<input type="text" class="form-control form-control-sm" id="sname" name="sname" value="<?=$sname;?>">
		</div>
	</div>
	<div class="form-group row">
		<label for="email" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
		<div class="col-sm-5">
			<input type="text" class="form-control form-control-sm" id="email" name="email" value="<?=$email;?>">
		</div>
	</div> 
	<div class="form-group row">
		<label for="phone" class="col-sm-2 col-form-label col-form-label-sm">Phone</label>
		<div class="col-sm-5">
			<input type="text" class="form-control form-control-sm" id="phone" name="phone" value="<?=$phone;?>">
		</div>
	</div>
	<div class="form-group row">
		<label for="rank" class="col-sm-2 col-form-label col-form-label-sm">Rank</label>
		<div class="col-sm-5">
			<select name="rank" class="form-control form-control-sm" value="<?=$rank;?>">
				<?php
				foreach($ranks as $rank){
					echo '<option value="'.$rank['id'].'">'.$rank['rank'].'</option>';
				}
				?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label for="phone" class="col-sm-2 col-form-label col-form-label-sm">upload image</label>
		<div class="col-sm-5">
			<input type="file" class="form-control form-control-sm" id="userfile" name="userfilee" size="35" value="<?=$userfilee;?>">
		</div>
	</div>

	<div class="form-group row">
		<div class="col-sm-5">
			<input type="submit" class="btn btn-primary" value="Save">
		</div>
	</div>
</div>
</form>