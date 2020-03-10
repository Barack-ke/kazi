<div class="container-fluid">
	<h1>Available developers</h1>
	<a href="<?php echo base_url('developer/createdeveloper'); ?>">Create developer</a>

	<div class="row justify-content start">
		<div class="col-4">
		
		<?php
		foreach ($developers as $developer) {
			?>
			
			<div class="card-deck" style="width:500px; background-color: lightgray; display:inline-block; text-align: center; border-radius: 5%; margin:10px; ">
				<div class="card-img-overlay">
					<h4 class="card-title"style=" text-decoration: underline;"></h4>
					<p class="card-text">First Name: <?php echo  $developer->fname; ?></p>
					<p class="card-text">Second Name <?php echo  $developer->sname; ?></p>
					<p class="card-text">Email: <?php echo  $developer->email; ?></p>
					<p class="card-text">Phone: <?php echo  $developer->phone; ?></p>
					<p class="card-text">Rank: <?php echo  $developer->rank; ?></p>
					
					<br>
					<button class="btn btn-info"><a href="<?php echo base_url('developer/update/'.$developer->devid); ?>">Update</a></button>
					<button class="btn btn-danger"><a href="<?php echo base_url('developer/deletedeveloper/'.$developer->id); ?>">Delete</a></button>
				</div>
			</div>
			<?php
		}
		?>
		</div>
		
	</div>


</div>