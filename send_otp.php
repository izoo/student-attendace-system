<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('db_config.php');
require_once('vendor/autoload.php');
$tableName = 'users';
$errors ='';
if(isset($_POST['login_email']))
{
    $email = $user->testinput($_POST['login_email']);
    if(!empty($email))
    {
        $conditions = array('email' => $email);
      
        if($user->checkRow($tableName,$conditions)>0)
        {
            $rand_no = rand(10000,99999);
            $rand_no_db = md5($rand_no);
            $userData = array('verification_code' => $rand_no_db);
            $update=$user->update($tableName,$userData,$conditions);
            $output='<p>Hello ' . $email . '</p>';
            $output .='<p>Enter The Below OTP Code in the login form</p>';
            $output .='<p>In order to proceed</p>';
            $output .='<p>The Code will expire in 15mins</p>';
            $output .= '<b>' . $rand_no . '</b>';
            $output .='<p>Thanks,</p>';
            $output .='<p>STUDENT ATTENDANCE</p>';
             //$body = $output;
             $subject = "OTP CODE";
             //$email_to = $email;
             $mail = new PHPMailer(true);
             $mail->SMTPDebug = 0;
             $mail->isSMTP();
             $mail->Host = 'ssl://smtp.gmail.com:465';
             $mail->SMTPAuth = true;
             $mail->Username = 'aisacsmooth@gmail.com';
             $mail->Password = 'RASTAMAN@777';
            $mail->SMTPSecure = 'ssl';
             //$mail->Host = 'smtp.gmail.com';
             $mail->Port = 465;
             //or more succinctly:
    
             
             $mail->setFrom('aisacsmooth@gmail.com','STUDENT ATTENDACE');
             $mail->addReplyTo($email,'STUDENT ATTENDACE');
             $mail->addAddress($email);
             $mail->isHTML(true); //Set email format to HTML
             $mail->Subject = $subject;
             $mail->Body = $output;
           
             if($mail->send() && $update)
             {
                $data = array(
                    'status' => "okay",
                    'message' => "OTP Succesfully Sent To Your Email"
                );
                echo json_encode($data);
             }
             else
             {
                 $errors= "Error Sending Email Please try again";
             }
        }
        else
        {
            $errors = "Email Not Registered,Create Account first to get otp ";
        }
    }
    else
    {
        $errors = "Enter Your Email Address To Proceed";
    }
}
else
{
    $errors = "Email Not Set";
}
if(!empty($errors))
{
    $user_errors = array(
        'status' => "error",
        'errors' => $errors,
    );
    echo json_encode($user_errors);
}
?>