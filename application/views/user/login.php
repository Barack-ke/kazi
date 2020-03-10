<div class="container">
	
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
	<?=form_open('/user/checklogin'); ?>
	<div class="container">
		<div class="form-group row">
			<label for="uname" class="col-sm-2 col-form-label col-form-label-sm ">Email</label>
			<div class="col-sm-5">
				<input type="text" class="form-control form-control-sm" id="uname" name="uname" placeholder="username">
			</div>
		</div>
		<div class="form-group row">
			<label for="password"  class="col-sm-2 col-form-label col-form-label-sm">Password</label>
			<div class="col-sm-5">
				<input type="text" class="form-control form-control-sm" id="pass" name="pass" placeholder="Password">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-5">
				<input type="submit" class="btn btn-primary" value="login">
			</div>
		</div>
	</div>
</form>
<div>
<a href="<?=base_url('user/change');?>">change password</a>
</div>
</div>