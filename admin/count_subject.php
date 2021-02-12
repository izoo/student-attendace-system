<?php
require('../db_config.php');
$sql = $DB_con->prepare("SELECT conviction.*,inmate_conviction.*,Inmate.* FROM conviction JOIN 
inmate_conviction ON conviction.conviction_id = inmate_conviction.inmate_conviction_conviction_id 
JOIN Inmate ON Inmate.inmate_id = inmate_conviction.inmate_conviction_inmate_id");
$sql->execute();
$total_rows = $sql->rowCount();
echo $total_rows;
?>