<?php
require('../db_config.php');
$stmt = $DB_con->prepare("SELECT * FROM lecturers");
$stmt->execute();
$dat=array();
$data = $stmt->fetchAll();


echo json_encode($data);
?>