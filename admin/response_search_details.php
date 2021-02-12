<?php
require('../db_config.php');
$user_id = $_SESSION['user_session'];
    $stmt=$DB_con->prepare("SELECT * FROM users WHERE email=:ema");
    $stmt->bindParam(":ema",$user_id);
    $stmt->execute();
    $results=$stmt->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['subject']))
{
  $subject= $_POST['subject'];
  if(!empty($subject))
  {
    
    $stmt2= $DB_con->prepare("SELECT * FROM subjects WHERE subject_id=:id");
     $stmt2->bindParam(":id",$subject);
     $stmt2->execute();
     $rwt =$stmt2->fetch(PDO::FETCH_ASSOC);
    //  echo $stmt2->rowCount() . "<br>" . $rwt['course'];
    if($results['role'] == 'admin' || $results['role'] == 'lecturer')
    {
        $sql = $DB_con->prepare("SELECT * FROM students WHERE course=:course 
    AND year=:yr AND semester=:sem");
    $sql->bindParam(":course",$rwt['subject_course']);
    $sql->bindParam(":yr",$rwt['subject_year']);
    $sql->bindParam(":sem",$rwt['subject_semester']);
    }
    else if($results['role'] == 'student')
    {
        $sql = $DB_con->prepare("SELECT * FROM students WHERE course=:course AND 
        student_email =:ema
        AND year=:yr AND semester=:sem");
        $sql->bindParam(":course",$rwt['subject_course']);
        $sql->bindParam(":ema",$user_id);
        $sql->bindParam(":yr",$rwt['subject_year']);
        $sql->bindParam(":sem",$rwt['subject_semester']);
    }

   $sql->execute();
   $total_rows = $sql->rowCount();
   $results = $sql->fetchAll();
   $output = array();
   $data = array();
   $number = 1;
   foreach($results as $row)
   {
      
       $sub_array = array();
       $sub_array[] = $number;
       $sub_array[] = $row['reg_no'];
       $sub_array[] = $row['student_name'];
    
       $sub_array[] = '<div class="form-check">
       <input type="checkbox" class="check_attendance  form-check-input" id="' . $row['student_id'] . '" name="status" value="' . $row['student_id'] . '"></div>';
      
     
       $data[] = $sub_array;
       $number++;
   }
   $output = array(
       "draw" => 1,
       "recordsTotal" => intval($total_rows),
       "recordsFiltered" => intval($total_rows),
       "data" => $data
   );
   echo json_encode($output);
  }
  else
  {
      echo "Subject is empty";
  }
}
else
{
    echo "subject Not Set";
}
?>
