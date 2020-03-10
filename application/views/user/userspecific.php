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
<?=form_open('/user/savespecificuser');?>
	<div class="container">
		<div class="form-group row">
			<input type="hidden" class="form-control form-control-sm" id="theid" name="theid" placeholder="Name" value="<?=$id?>">
			<label for="name"class="col-sm-2 col-form-label col-form-label-sm">Name</label>
			<div class="col-sm-5">
				<input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Name" value="<?=$name?>">
			</div>
		</div>
		<div class="form-group row">
			<label for="email" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
			<div class="col-sm-5">
				<input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Email" value="<?=$email?>">
			</div>
		</div>
		<div class="form-group row">
			<label for="phone" class="col-sm-2 col-form-label col-form-label-sm">Phone</label>
			<div class="col-sm-5">
				<input type="text" class="form-control form-control-sm" id="phone" name="phone" placeholder="Phone" value="<?=$phone?>">
			</div>
		</div>
		
		<div class="form-group row">
				<label for="privileg" class="col-sm-2 col-form-label form-control-sm">Privilege</label>
				<div class="col-sm-5">
					<select name="privileg" class="form-control form-control-sm">
						<?php
						foreach ($users as $privilegs){
							echo'<option value="'.$privilegs['id'].'">'.$privilegs['privileg'].'</option>';
						}
						?>
					</select>
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