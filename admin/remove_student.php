<?php
require_once('../db_config.php');
if(isset($_POST['id']))
{
    $id=$_POST['id'];
    $stmt=$DB_con->prepare("DELETE FROM students WHERE student_id=:id");
    $stmt->bindParam(":id",$id);
    if($stmt->execute())
    {
        echo "YES";
    }
    else
    {
        echo "Error Removing student Please Try Again";
    }
}
?>