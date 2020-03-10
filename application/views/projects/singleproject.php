<div class="container">
<?php foreach ($projects as $project){
    ?>
    <table class="table table-striped table-responsive-md">
      <thead>
        <tr>
          <th>Project name</th>
          <th>start date</th>
          <th>End date</th>
          <th>developer</th>
          <th>client</th>
          <th>project manager</th>
        </tr>
      </thead>

      <tbody>
        <tr>

          <td><?php echo  $project->projectname; ?></td>
          <td><?php echo  $project->start; ?></td>
          <td><?php echo  $project->end; ?></td>
          <td><?php echo  $project->fname; ?></td>
          <td><?php echo  $project->clientname; ?></td>
          <td><?php echo  $project->projectmanagername; ?></td>

            <td><button type="button" class="btn btn-info "><a href="<?php echo base_url('project/update/'.$project->projectid); ?>">edit</a></button></td>
            <td><button type="button" class="btn btn-danger "><a href="<?php echo base_url('project/delete/'.$project->projectid); ?>">delete</a></button>
            </td>


          </tr>

        </tbody>

      </table>
      <h3 style="text-decoration: underline;">Task </h3>
      <ul>
      <?php 
      $condition = array('projectId' => $project->projectid);
      $tasks = $this->task->gettasklist($condition);
      foreach ($tasks as $task) {
        ?>

        <li><?php echo  $task->task; ?></li>
        
      <?php } ?>
    </ul>
      <button type="button" class="btn btn-secondary "><a href="<?php echo base_url('project/addtask/'.$project->projectid); ?>">add task</a></button>
      <?php
    }?>

  </div>
