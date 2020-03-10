<div class="container">
	<h1> Project</h1>
	<a href="<?php echo base_url('project/index'); ?>">Back</a>
      
	<div class="row justify-content-start">
		<div class="col-4">
		
		<?php
		foreach ($projects as $project) {
			?>
			<div class="card" style="width:500px;background-color: lightgray; text-align: center;border-radius: 5%; display: inline-block;margin:10px; ">
				<div class="card-img-overlay">
					<h4 class="card-title"style=" text-decoration: underline;" ><?php echo  $project->projectname; ?></h4>
					<p class="card-text">Project Name: <?php echo  $project->projectname; ?></p>
					<p class="card-text">Start Date: <?php echo  $project->start; ?></p>
					<p class="card-text">End Date: <?php echo  $project->end; ?></p>
					<p class="card-text">Developer: <?php echo  $project->fname; ?></p>
					<p class="card-text">Project Manager: <?php echo  $project->projectmanagername;?></p>
					<p class="card-text">Client: <?php echo  $project->clientname; ?></p>
					<p>Tasks</p>
					<?php 
					$condition = array('projectId' => $project->projectid);
						$tasks = $this->task->gettasklist($condition);
						foreach ($tasks as $task) {
			?>
			<p class="card-text"> <?php echo  $task->task; ?></p>
			<?php
		}
					?>
					<div>
					<button class="btn btn-info" ><a href="<?php echo base_url('project/update/'.$project->projectid); ?>">Edit</a></button>
					<button class="btn btn-danger" ><a href="<?php echo base_url('project/delete/'.$project->projectid); ?>">Delete</a></button>
					<button class="btn btn-secondary" ><a href="<?php echo base_url('project/addtask/'.$project->projectid); ?>">Add task</a></button>
				</div>
			</div>
		</div>
			<?php
		}
		?>
	</div>

</div>