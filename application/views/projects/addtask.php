<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
var tasknumber = 1;
  $("#btn").click(function(){
  	tasknumber++;
    $("#mytasks").append('<div id="'+tasknumber+'"><input type="hidden" name="theid" value="<?=$projectid; ?>"><input type="text" class="form-control form-control-sm" id="addt" name="addt[]" placeholder="Task '+tasknumber+'"/><button type="button" class="btn btn-danger" id="rm">x</button><br></div>');
  });
$('.element').on('click','#rm',function(e){
	e.preventDefault(); $(this).parent('div').remove(); tasknumber--;
 
});
$("#btnup").click(function(){
    alert( $("#addt").val());
  });
});

</script>
</head>
<div class="container">
	<?php foreach($projects as $project){?>
		<h4>Name: <?php echo $project->projectname;?></h4>
		<h4>Start: <?php echo $project->start;?></h4>
		<h4>End: <?php echo $project->end;?></h4>
<?php
	}
	?>
	<?=form_open('project/savetask'); ?>
	<div class="container">
			<div class="form-group row">
				<label for="addt" class="col-sm-2 col-form-label col-form-label-sm ">Task</label>
				<div class="col-sm-5">
					<input type="hidden" name="theid" value="<?=$projectid; ?>">
					<div id="mytasks" class="element">
					<input type="text" class="form-control form-control-sm" id="addt" name="addt[]" placeholder="Task "><br>
				</div>
					<button class="btn btn-primary" id="btnup">+</button>
					<button type="button" class="btn btn-info" id="btn">More task</button>
				</div>
			</div>
		</div>
	</div>