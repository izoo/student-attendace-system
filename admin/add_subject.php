<?php
require_once('../db_config.php');
 $error = array();
if(isset($_POST['subject_name']) && isset($_POST['subject_code']) &&
   isset($_POST['year']) && isset($_POST['subject_semester']) && isset($_POST['course']))
{
  $subject_name = $user->testinput($_POST['subject_name']);
  $subject_code = $user->testinput($_POST['subject_code']);
  $subject_year = $user->testinput($_POST['year']);
  $subject_semester = $user->testinput($_POST['subject_semester']);
  $subject_course = $user->testinput($_POST['course']);
  $status="NotAssigned";
  $tableName = "subjects";

  $userData = array(
    "subject_name" => $subject_name,
    "subject_code" => $subject_code,
    "subject_course" => $subject_course,
    "subject_year" => $subject_year,
    "subject_semester" => $subject_semester,
    "status" => "NotAssigned"
  );
  $conditions = array(
    'subject_name' => $subject_name,
    'subject_code' => $subject_code,
);
  if(!empty($subject_name) && !empty($subject_code) && !empty($subject_year))
  {
   
    
    if(!ctype_alpha(str_replace(' ','',$subject_name)))
    {
        $error[]="Invalid Subject Name,can only contain alphabetic characters";
    }
    else if($user->checkRow($tableName,$conditions))
    {
        $error[] = "Subject Name Or Code Already Exists";
    }
    
    
    
    else if($user->insert($tableName,$userData))
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