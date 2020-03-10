<div class="container">
	<?php
	$tempdata= $this->session->flashdata('tempdata');
	$alert= 'info';
	if(strpos(strtoupper($tempdata), 'SORRY')>-1){
		$alert="danger";
	}
	if(isset($tempdata) && !empty($tempdata)){

		?>
		<br>
		<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<button type="botton" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times</span></button>
					<div class="modal-body">
						<h5 class="text-center"><?=$tempdata;?></h5>
					</div>
				</div>
			</div>
		</div>
      <?php
  }?>
<?=form_open('/client/saveupdate'); ?>
<div class="container">
	<div class="form-group row">
		<label for="name" class="col-sm-2 col-form-label col-form-label-sm ">Client Name</label>
		<input type="hidden"  name="cid" value="<?=$id;?>">
		<div class="col-sm-5">
			<input type="text" class="form-control form-control-sm" id="clientname" name="name" value="<?=$name;?>">
		</div>
	</div>
	<div class="form-group row">
		<label for="phone" class="col-sm-2 col-form-label col-form-label-sm ">Phone</label>
		<div class="col-sm-5">
			<input type="text" class="form-control form-control-sm" id="phone" name="phone" value="<?=$phone;?>">
		</div>
	</div>
	<div class="form-group row">
		<label for="email" class="col-sm-2 col-form-label col-form-label-sm ">Email</label>
		<div class="col-sm-5">
			<input type="email" class="form-control form-control-sm" id="email" name="email" value="<?=$email;?>">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-5">
			<input type="submit" class="btn btn-primary" value="save">
			
		</div>
	</div>
</div>
</form>
</div>
