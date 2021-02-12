
<?php
require_once('../db_config.php');
if(isset($_POST['id']))
{ 
    $lecturer_id = $_POST['id'];
    //echo $lecturer_id;
    $stmt=$DB_con->prepare("SELECT * FROM lecturers WHERE lecturer_id=:id");
    $stmt->bindParam(":id",$lecturer_id);
    $stmt->execute();
    $lecturer=$stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($lecturer);
}
?>