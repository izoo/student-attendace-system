<?php
require_once('db_config.php');
if(!$user->is_loggedin())
{
	$user->redirect('index.php');
}
else
{
    $user_id = $_SESSION['user_session'];
    $stmt=$DB_con->prepare("SELECT * FROM users WHERE email=:ema");
    $stmt->bindParam(":ema",$user_id);
    $stmt->execute();
    $results=$stmt->fetch(PDO::FETCH_ASSOC);
    // if($results['role'] =="admin")
    // {
        $user->redirect('admin/index.php');
    // }
  
  

}
?>
