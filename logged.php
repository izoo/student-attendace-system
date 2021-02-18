<?php
require_once("db_config.php");
if(isset($_POST['user']) && isset($_POST['password'])  && isset($_POST['otp']))
{
    $error = array();
    $username = $_POST['user'];
    $password = $_POST['password'];
    $otp = $_POST['otp'];
    if(empty($username) && empty($password) && empty($otp))
    {
        $error[]="You must Provide both email and OTP Code";

    }
    else
    {
        if(strlen($username) < 3)
        {
            $error[] = "Email Too Short";
        }
        else if(is_numeric($username))
        {
            $error[] = "Invalid Email";
        }
        else if($user->login($username,$otp,$password))
        {
            echo "OK";
        }
        else
        {
            $error[] = "Wrong Username OR OTP Code";
        }
    }
}
else
{
    $error[]="Not All Fields Are Set Try Again Please";

}
foreach($error as $err)
{
    ?>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
 
        <?php echo $err ; ?>
    
    </div>
    </div>
    <?php
}
?>
