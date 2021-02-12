
<?php
require_once('../db_config.php');
if(isset($_POST['id']))
{ 
    $subject_id = $_POST['id'];
    //echo $subject_id;
    $stmt=$DB_con->prepare("SELECT * FROM subjects WHERE subject_id=:id");
    $stmt->bindParam(":id",$subject_id);
    $stmt->execute();
    $subject=$stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($subject);
}
?>