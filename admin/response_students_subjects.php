<?php
require('../db_config.php');
$user_id = $_SESSION['user_session'];
$stmt=$DB_con->prepare("SELECT * FROM students WHERE student_email=:ema");
$stmt->bindParam(":ema",$user_id);
$stmt->execute();
//echo $stmt->rowCount() . "<br>";
$results=$stmt->fetch(PDO::FETCH_ASSOC);
$sql = $DB_con->prepare("SELECT * FROM subjects WHERE subject_course=:course 
AND subject_year=:yr AND subject_semester=:sem");
$sql->bindParam(":course",$results['course']);
$sql->bindParam(":yr",$results['year']);
$sql->bindParam(":sem",$results['semester']);
$sql->execute();
$total_rows = $sql->rowCount();
//echo  "The total rows is : " . $total_rows;
$result = $sql->fetchAll();
$output = array();
$data = array();
$number = 1;
foreach($result as $row)
{
   $stmt1=$DB_con->prepare("SELECT lecturers.*, lecturers_subjects.* FROM lecturers
   JOIN lecturers_subjects ON lecturers.lecturer_id = lecturers_subjects.lecturer_id
    WHERE lecturers_subjects.subject_id=:id");
   $stmt1->bindParam(":id",$row['subject_id']);
   $stmt1->execute();
   $rs=$stmt1->fetch(PDO::FETCH_ASSOC);
   if($stmt1->rowCount()>0)
   {
       $lecturer_name = $rs['lecturer_name'];
   }
   else
   {
       $lecturer_name = "Not Assigned";
   }
    $sub_array = array();
    $sub_array[] = $number;
    $sub_array[] = $row['subject_name'];
    $sub_array[] = $row['subject_code'];
    $sub_array[] = $lecturer_name;
    $sub_array[] = $row['subject_year'];
    $sub_array[] = $row['subject_semester'];
    $sub_array[] = $row['subject_course'];
  
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
?>