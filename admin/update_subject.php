<?php
require_once('../db_config.php');
 $error = array();
if(isset($_POST['subject_nameu']) && isset($_POST['subject_codeu']) &&
   isset($_POST['yearu']) && isset($_POST['subject_semesteru'])
    && isset($_POST['subject_courseu']))
{
  $subject_name = $user->testinput($_POST['subject_nameu']);
  $subject_code = $user->testinput($_POST['subject_codeu']);
  $subject_year = $user->testinput($_POST['yearu']);
  $subject_semester = $user->testinput($_POST['subject_semesteru']);
  $subject_course = $user->testinput($_POST['subject_courseu']);
  $subject_id = $_POST['hidden_subject_id'];
  $tableName = "subjects";

  $userData = array(
    "subject_name" => $subject_name,
    "subject_code" => $subject_code,
    "subject_course" => $subject_course,
    "subject_year" => $subject_year,
    "subject_semester" => $subject_semester
  );
  $conditions = array(
    'subject_id' => $subject_id
    
);
  if(!empty($subject_name) && !empty($subject_code) && !empty($subject_year))
  {
   
    
    if(!ctype_alpha(str_replace(' ','',$subject_name)))
    {
        $error[]="Invalid Subject Name,can only contain alphabetic characters";
    }
    else if($user->update($tableName,$userData,$conditions))
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