<div class="container">
	<h1>Clients</h1>
	<a href="<?php echo base_url('client/create'); ?>">Create client</a>

	<div class="row justify-content-start">
		<div class="col-4">
		
		<?php
		$data = array(
			'clients' => $clients,
			
					);
		foreach ($clients as $client) {
			?>
			<div class="card" style="width:500px;background-color: lightgray; display: inline-block;text-align: center;border-radius: 5%; margin: 10px;">
				<div class="card-img-overlay">
					<h4 class="card-title"style=" text-decoration: underline;"></h4>
					<p class="card-text">Client Name: <?php echo  $client->name; ?></p>
					<p class="card-text">Phone Number <?php echo  $client->phone; ?></p>
					<p class="card-text">Email: <?php echo  $client->email; ?></p>	
					<button class="btn btn-info" ><a href="<?php echo base_url('client/update/'.$client->id); ?>">Update</a></button>
					<button class="btn btn-danger" ><a href="<?php echo base_url('client/delete/'.$client->id); ?>">Delete</a></button>
				</div>
			</div>
		
			<?php
		}
		?>
	</div>
</div>

</div>