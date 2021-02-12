<?php
require_once('../db_config.php');
if(isset($_POST['id']))
{
    $id=$_POST['id'];
    $stmt=$DB_con->prepare("DELETE FROM subjects WHERE subject_id=:id");
    $stmt->bindParam(":id",$id);
    if($stmt->execute())
    {
        echo "YES";
    }
    else
    {
        echo "Error Removing subject Please Try Again";
    }
}
?>