<?=form_open('user/changepass'); ?>
	<div class="container">
		<div class="form-group row">
			<label for="oldpass" class="col-sm-2 col-form-label col-form-label-sm ">Old password</label>
			<div class="col-sm-5">
				<input type="Password" class="form-control form-control-sm" id="oldpass" name="oldpass" placeholder="old password">
			</div>
		</div>
		<div class="form-group row">
			<label for="newpass"  class="col-sm-2 col-form-label col-form-label-sm">New password</label>
			<div class="col-sm-5">
				<input type="password" class="form-control form-control-sm" id="newpass" name="newpass" placeholder="new password">
			</div>
		</div>
		<div class="form-group row">
			<label for="confirmpass"  class="col-sm-2 col-form-label col-form-label-sm">Confirm password</label>
			<div class="col-sm-5">
				<input type="password" class="form-control form-control-sm" id="confirmpass" name="confirmpass" placeholder="confirm password">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-5">
				<input type="submit" class="btn btn-primary" value="submit">
			</div>
		</div>
	</div>
</form>