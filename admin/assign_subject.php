<?php
require_once('../db_config.php');
 $error = array();
if(isset($_POST['lecturer_assign_name']) && isset($_POST['subject_assign_name']))
{
  $lecturer = $user->testinput($_POST['lecturer_assign_name']);
  $subject_assign_name = $user->testinput($_POST['subject_assign_name']);
 
 
  $tableName = "lecturers_subjects";
 $tableName2 = "subjects";
  $userData = array(
    "lecturer_id" => $lecturer,
    "subject_id" => $subject_assign_name,
    
  );

  $conditions = array(
    'subject_id' => $subject_assign_name,
    'lecturer_id' => $lecturer,
);
$update_data= array(
    'status' => 'Assigned'
);
$update_conditions = array(
    'subject_id' => $subject_assign_name
);
  if(!empty($lecturer) && !empty($subject_assign_name))
  {
   
    
    if($user->checkRow($tableName,$conditions))
    {
        $error[] = "Subject Already Assigned";
    }
    
    
    
    else if($user->insert($tableName,$userData) && $user->update($tableName2,$update_data,$update_conditions))
    {
      echo "ok";
    }
    
    
    
    
  }
  else
  {
     $error[]="Fill in All The Fields First";
  }
}
else
{
    ?>
    <div class="alert alert-danger w3-padding-16 w3-win-phone-red alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong class="w3-text-red ">Not All Fields Are Set Set Them First!</strong> 
</div>
    <?php
}
    foreach($error as $err)
      {
        ?>
         <div class="alert alert-danger  w3-padding-16 w3-win-phone-red alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong><?php echo $err ;?></strong> 
</div>
        <?php
      
    }
?>