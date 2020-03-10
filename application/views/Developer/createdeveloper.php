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
	<?= form_open('/developer/savedeveloper'); ?>
		<div class="form-group row">
				<label for="fname" class="col-sm-2 col-form-label col-form-label-sm ">First name</label>
				<div class="col-sm-5">
					<input type="text" class="form-control form-control-sm" id="fname" name="fname" placeholder="First Name">
				</div>
			</div>
			<div class="form-group row">
				<label for="sname" class="col-sm-2 col-form-label col-form-label-sm">Second name</label>
				<div class="col-sm-5">
					<input type="text" class="form-control form-control-sm" id="sname" name="sname" placeholder="Second name">
				</div>
			</div>
			<div class="form-group row">
				<label for="email" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
				<div class="col-sm-5">
					<input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="Email">
				</div>
			</div> 
			<div class="form-group row">
				<label for="phone" class="col-sm-2 col-form-label col-form-label-sm">Phone</label>
				<div class="col-sm-5">
					<input type="text" class="form-control form-control-sm" id="phone" name="phone" placeholder="Phone">
				</div>
			</div>
			<div class="form-group row">
				<label for="rank" class="col-sm-2 col-form-label col-form-label-sm">Rank</label>
				<div class="col-sm-5">
					<select name="rank" class="form-control form-control-sm">
						<?php
						foreach($ranks as $rank){
							echo '<option value="'.$rank['id'].'">'.$rank['rank'].'</option>';
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
		</form>
	</div>