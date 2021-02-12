<?php
require('../db_config.php');
$sql = $DB_con->prepare("SELECT * FROM subjects
 ORDER BY subject_id DESC");
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
    $sub_array[] = $row['subject_name'];
    $sub_array[] = $row['subject_code'];
    $sub_array[] = $row['subject_course'];
    $sub_array[] = $row['subject_year'];
    $sub_array[] = $row['subject_semester'];
    $sub_array[] = $row['status'];
    $sub_array[] = '
    <a href="#"  data-toggle="modal" data-target="#assignModal" name="update" id="'.$row["subject_id"].'"  class="assign btn btn-small btn-flat btn-primary">
    Assign</a> &nbsp &nbsp
    <a href="#"  onclick="GetSubject('. $row['subject_id'] .')" name="update" id="'.$row["subject_id"].'"  class="update">
    <i class="app-menu__icon fa fa-pencil"></i></a>
    <a href="#"  onclick="RemoveSubject('. $row['subject_id'] .')" name="remove" id="'.$row["subject_id"].'"  class="remove">
    <i class="app-menu__icon fa fa-trash"></i></a>';
  
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
