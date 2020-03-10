<div class="container"style="background-color: #e6ffe6;">
	<h1>Available Projects</h1>
	<a href="<?php echo base_url('project/create'); ?>">Add project</a>
      
	<div class="row justify-content-start">
		<div class="col-4">
		
		<?php
		foreach ($projects as $project) {
			?>
			<div class="card" style="width:500px;background-color: lightgray; text-align: center;border-radius: 5%; display: inline-block;margin:10px; ">
				<div class="card-img-overlay">
					<h4 class="card-title"style=" text-decoration: underline;" ><?php echo  $project->projectname; ?></h4>
					<p class="card-text">Project Name: <?php echo  $project->projectname; ?></p>
					<button class="btn btn-default" ><a href="<?php echo base_url('project/specificproject/'.$project->projectid); ?>">view</a></button>
				</div>
			</div>
			<?php
		}
		?>
	</div>

</div>