<?php
require_once('../db_config.php');
if(isset($_POST['id']))
{
    $id=$_POST['id'];
    $stmt=$DB_con->prepare("DELETE FROM lecturers WHERE lecturer_id=:id");
    $stmt->bindParam(":id",$id);
    if($stmt->execute())
    {
        echo "YES";
    }
    else
    {
        echo "Error Removing Lecturer Please Try Again";
    }
}
?>