<?php
require('../db_config.php');
$sql = $DB_con->prepare("SELECT * FROM students ORDER BY student_id DESC");
$sql->execute();
$total_rows = $sql->rowCount();
echo $total_rows;
?>