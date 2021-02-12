<?php
require('../db_config.php');

$user_id = $_SESSION['user_session'];
$stmt=$DB_con->prepare("SELECT * FROM users WHERE email=:ema");
$stmt->bindParam(":ema",$user_id);
$stmt->execute();
$results=$stmt->fetch(PDO::FETCH_ASSOC);
$diff="jrem";
if($results['role'] == "admin")
{
$sql = $DB_con->prepare("SELECT * FROM lecturers
 ORDER BY lecturer_id DESC");
}
else if($results['role'] == "lecturer")
{
    $sql = $DB_con->prepare("SELECT * FROM lecturers
    WHERE lecturer_email=:em
 ORDER BY lecturer_id DESC");
 $sql->bindParam(":em",$user_id);
}
else
{
    $sql = $DB_con->prepare("SELECT * FROM lecturers
    WHERE lecturer_email=:em
 ORDER BY lecturer_id DESC");
 $sql->bindParam(":em",$diff);
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
    $sub_array[] = $row['lecturer_name'];
    $sub_array[] = $row['lecturer_email'];
    $sub_array[] = $row['lecturer_staff_id'];
    $sub_array[] = $row['lecturer_phone'];
    if($results['role'] == "admin")
{
    $sub_array[] = '<a href="#" onclick="GeLecturer('. $row['lecturer_id'] .')"  name="update" id="'.$row["lecturer_id"].'"  class="update">
    <i class="app-menu__icon fa fa-pencil"></i></a>

    <a href="#" onclick="RemoveLecturer('. $row['lecturer_id'] .')"  class="remove">
    <i class="app-menu__icon fa fa-trash"></i></a>';
}
else if($results['role'] == "lecturer")
{
    $sub_array[] = '<a href="#" onclick="GetLecturer('. $row['lecturer_id'] .')"  name="update" id="'.$row["lecturer_id"].'"  class="update">
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
