<?php
require('../db_config.php');

$user_id = $_SESSION['user_session'];
$stmt=$DB_con->prepare("SELECT * FROM users WHERE email=:ema");
$stmt->bindParam(":ema",$user_id);
$stmt->execute();
$results=$stmt->fetch(PDO::FETCH_ASSOC);
if($results['role'] == "admin")
{
    $sql = $DB_con->prepare("SELECT subjects.*, lecturers.*,lecturers_subjects.* FROM subjects JOIN lecturers_subjects ON
    lecturers_subjects.subject_id = subjects.subject_id 
    JOIN lecturers ON lecturers.lecturer_id = lecturers_subjects.lecturer_id ORDER BY lecturers_subjects.subject_id DESC");
}
else if($results['role'] == "lecturer")
{
    $sql = $DB_con->prepare("SELECT subjects.*, lecturers.*,lecturers_subjects.* FROM subjects JOIN lecturers_subjects ON
    lecturers_subjects.subject_id = subjects.subject_id 
    JOIN lecturers ON lecturers.lecturer_id = lecturers_subjects.lecturer_id
    WHERE lecturers.lecturer_email=:em
     ORDER BY lecturers_subjects.subject_id DESC");
     $sql->bindParam(":em",$user_id);
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
    $sub_array[] = $row['subject_name'];
    $sub_array[] = $row['subject_code'];
    if($results['role'] == "admin")
{
    $sub_array[] = $row['lecturer_name'];
}
    $sub_array[] = $row['subject_year'];
    $sub_array[] = $row['subject_semester'];
    $sub_array[] = $row['subject_course'];
    if($results['role'] == "admin")
{
    $sub_array[] = '
    <a href="#"  data-toggle="modal" data-target="#assignModal" name="update" id="'.$row["subject_id"].'"  class="assign btn btn-small btn-flat btn-primary">
    Unassign</a> &nbsp &nbsp
    <a href="#"  onclick="RemoveSubject('. $row['subject_id'] .')" name="remove" id="'.$row["subject_id"].'"  class="remove">
    <i class="app-menu__icon fa fa-trash"></i></a>';
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
