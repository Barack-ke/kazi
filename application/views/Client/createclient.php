<div class="container">
<?=form_open('/client/saveclient'); ?>
<div class="container">
	<div class="form-group row">
		<label for="name" class="col-sm-2 col-form-label col-form-label-sm ">Client Name</label>
		<div class="col-sm-5">
			<input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Client name">
		</div>
	</div>
	<div class="form-group row">
		<label for="phone" class="col-sm-2 col-form-label col-form-label-sm ">Phone</label>
		<div class="col-sm-5">
			<input type="text" class="form-control form-control-sm" id="phone" name="phone" placeholder="Phone">
		</div>
	</div>
	<div class="form-group row">
		<label for="email" class="col-sm-2 col-form-label col-form-label-sm ">Email</label>
		<div class="col-sm-5">
			<input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Email">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-5">
			<input type="submit" class="btn btn-primary" value="create">
		</div>
	</div>
</div>
</form>
</div>