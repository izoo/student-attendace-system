
<?php
require_once('../db_config.php');
if(isset($_POST['id']))
{ 
    $student_id = $_POST['id'];
    //echo $student_id;
    $stmt=$DB_con->prepare("SELECT * FROM students WHERE student_id=:id");
    $stmt->bindParam(":id",$student_id);
    $stmt->execute();
    $student=$stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($student);
}
?>