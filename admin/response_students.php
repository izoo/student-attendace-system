<?php
require('../db_config.php');
$user_id = $_SESSION['user_session'];
$stmt=$DB_con->prepare("SELECT * FROM users WHERE email=:ema");
$stmt->bindParam(":ema",$user_id);
$stmt->execute();
$diff="jrem";

$results=$stmt->fetch(PDO::FETCH_ASSOC);
if($results['role'] == "admin")
{
$sql = $DB_con->prepare("SELECT * FROM students ORDER BY student_id DESC");
}
else if($results['role'] == "student")
{
    $sql = $DB_con->prepare("SELECT * FROM students WHERE student_email=:em");
    $sql->bindParam(":em",$user_id);
}
else if($results['role'] == "lecturer")
{
    $stmt1=$DB_con->prepare("SELECT lecturers.*, lecturers_subjects.* FROM lecturers
    JOIN lecturers_subjects ON lecturers.lecturer_id = lecturers_subjects.lecturer_id
     WHERE lecturers.lecturer_email=:em");
     $stmt1->bindParam(":em",$user_id);
     $stmt1->execute();
     $rw=$stmt1->fetch(PDO::FETCH_ASSOC);
     $stmt2= $DB_con->prepare("SELECT * FROM subjects WHERE subject_id=:id");
     $stmt2->bindParam(":id",$rw['subject_id']);
     $stmt2->execute();
     $rwt =$stmt2->fetch(PDO::FETCH_ASSOC);
    //  echo $stmt2->rowCount() . "<br>" . $rwt['course'];
    $sql = $DB_con->prepare("SELECT * FROM students WHERE course=:course 
    AND year=:yr AND semester=:sem");
    $sql->bindParam(":course",$rwt['subject_course']);
    $sql->bindParam(":yr",$rwt['subject_year']);
    $sql->bindParam(":sem",$rwt['subject_semester']);
}

$sql->execute();
$total_rows = $sql->rowCount();
$result = $sql->fetchAll();
$output = array();
$data = array();
$number = 1;
foreach($result as $row)
{
   
    $sub_array = array();
    $sub_array[] = $number;
    $sub_array[] = $row['reg_no'];
    $sub_array[] = $row['student_name'];
    $sub_array[] = $row['student_email'];
    $sub_array[] = $row['student_phone'];
    $sub_array[] = $row['year'];
    $sub_array[] = $row['semester'];
    $sub_array[] = $row['course'];
    $sub_array[] = $row['dept'];
    if($results['role'] == "admin")
{
    $sub_array[] = '<a href="#" onclick="GetStudent('. $row['student_id'] .')"  name="update"   class="update">
    <i class="app-menu__icon fa fa-pencil"></i></a>
    <a href="#" onclick="RemoveStudent('. $row['student_id'] .')">
    <i class="app-menu__icon fa fa-trash"></i></a>';
}
else  if($results['role'] == "student")
{
    $sub_array[] = '<a href="#" onclick="GetStudent('. $row['student_id'] .')"  name="update"   class="update">
    <i class="app-menu__icon fa fa-pencil"></i></a>';
}

  
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