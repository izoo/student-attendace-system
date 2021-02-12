<?php
require('../db_config.php');
$stmt = $DB_con->prepare("SELECT * FROM subjects");
$stmt->execute();
$dat=array();
$data = $stmt->fetchAll();


echo json_encode($data);
?>