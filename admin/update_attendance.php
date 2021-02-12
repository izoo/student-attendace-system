<?php
require('../db_config.php');
$user_id = $_SESSION['user_session'];
if(isset($_POST['updateId']) && isset($_POST['sub'])
 && isset($_POST['date']) )
{
    $update_id = $_POST['updateId'];
    $sub = $_POST['sub'];
    $date = $_POST['date'];
    $tableName = "tbl_attendance";
   
    foreach($update_id as $id)
    {
        $conditions = array(
            'student_id' => $id,
            'attendance_date' =>  $date,
            'subject_id' => $sub
        );
        $updateData = array(  
            'attendance_status' => 'Present'  
        );
        $update_conditions = array(
            'student_id' => $id
        );
       $userData = array(
           'student_id' => $id,
           'attendance_status' => 'Present',
           'subject_id' => $sub,
           'attendance_date' => $date,
           'checked_by'  => $user_id
       );

       //echo $user->checkRow($tableName,$conditions);

       if($user->checkRow($tableName,$conditions))
       {
          if($user->update($tableName,$updateData,$update_conditions))
          {
              echo "ok";
          }
          else
          {
              echo "Error Updating Data";
          }
       }
       else
       {
           if($user->insert($tableName,$userData))
           {
             echo "ok";
           }
           else
           {
               echo "Error Inserting Data";
           }
       }
    }
  
    
}
else if(isset($_POST['sub'])
&& isset($_POST['date']) &&  isset($_POST['unchecked']))
{
    $sub = $_POST['sub'];
    $date = $_POST['date'];
    $unchecked = $_POST['unchecked'];
    $tableName = "tbl_attendance";
    foreach($unchecked as $check)
    {
        $conditions = array(
            'student_id' => $check,
            'attendance_date' =>  $date,
            'subject_id' => $sub
        );
        $updateData = array(  
            'attendance_status' => 'Absent'  
        );
        $update_conditions = array(
            'student_id' => $check
        );
       $userData = array(
           'student_id' => $check,
           'attendance_status' => 'Absent',
           'subject_id' => $sub,
           'attendance_date' => $date,
           'checked_by'  => $user_id
       );

       //echo $user->checkRow($tableName,$conditions);

       if($user->checkRow($tableName,$conditions))
       {
          if($user->update($tableName,$updateData,$update_conditions))
          {
              echo "ok";
          }
          else
          {
              echo "Error Updating Data";
          }
       }
       else
       {
           if($user->insert($tableName,$userData))
           {
             echo "ok";
           }
           else
           {
               echo "Error Inserting Data";
           }
       }
    }
}
?>