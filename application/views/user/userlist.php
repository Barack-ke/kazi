<div class="container"style="background-color: #e6ffe6;">
	<h1>Users</h1>
      
	<div class="row justify-content-start">
		<div class="col-4">
		
		<?php
		foreach ($users as $userz) {
			?>
			<div class="card" style="width:500px;background-color: lightgray; text-align: center;border-radius: 5%; display: inline-block;margin:10px; ">
				<div class="card-img-overlay">
					<h4 class="card-title"style=" text-decoration: underline;" ><?php echo  $userz->name; ?></h4>
					<p class="card-text">user name: <?php echo  $userz->name; ?></p>
					<p class="card-text">user email: <?php echo  $userz->email; ?></p>
					<p class="card-text">user phone: <?php echo  $userz->phone; ?></p>
					<p class="card-text">user privilege: <?php echo  $userz->privileg; ?></p>
					
					<button class="btn btn-info" ><a href="<?php echo base_url('user/specificuser/'.$userz->userid); ?>">edit</a></button>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</div>