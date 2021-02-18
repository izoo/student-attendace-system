<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('../db_config.php');
require '../vendor/autoload.php';
$tableName = 'lecturers';
$tableName2 = 'users';
 $errors ='';
if(isset($_POST['fullname']) && isset($_POST['email']) 
&& isset($_POST['staff_id']) &&  isset($_POST['phone_no']))
{
    
    $full_name = $user->testinput($_POST['fullname']);
    $email = $user->testinput($_POST['email']);
    $phone_no = $user->testinput($_POST['phone_no']);
    $staff_id = $user->testinput($_POST['staff_id']);
    if($user->is_loggedin()!="")
    {
        $user_id = $_SESSION['user_session'];
        $stmt=$DB_con->prepare("SELECT * FROM users WHERE email=:ema");
        $stmt->bindParam(":ema",$user_id);
        $stmt->execute();
        $results=$stmt->fetch(PDO::FETCH_ASSOC);
        if($results['role']=='admin')
        {
            $password = $staff_id;
            $confirm_password = $staff_id;
        }
        else
        {
            $password = $user->testinput($_POST['password']);
            $confirm_password = $user->testinput($_POST['confirm_password']);
        }
    
        
    }
    else
    {
        $password = $user->testinput($_POST['password']);
        $confirm_password = $user->testinput($_POST['confirm_password']);
    }
    $rand_no = rand(10000,99999);
    $db_rand_no = md5($rand_no);
 ;
    $userData = array(
        'lecturer_name' => $full_name,
        'lecturer_email' => $email,
        'lecturer_phone' => $phone_no,
        'lecturer_staff_id' => $staff_id,
        'verification_code' => $db_rand_no,
    );
    $conditions = array(
        'lecturer_email' => $email,
        'lecturer_staff_id' => $staff_id,
    );

   
    $conditions2 = array(
        'email' => $email,
        'mobile_number' => $phone_no,
    );
    
    if(!empty($full_name) && !empty($email) && !empty($phone_no) &&  !empty($staff_id))
    {
        if(!ctype_alpha(str_replace(' ','',$full_name)))
        {
            $errors = "Name must contain letters and space only";
        }
        else if(!is_numeric($phone_no))
        {
            $errors =  "Mobile Number Can Only Contain Numbers";
        }
        else if($user->checkRow($tableName,$conditions)>0)
        {
            $errors = "Account with similar Email or Mobile No Already Exists";
        }
        else if($password !== $confirm_password)
        {
            $errors =  "Password Mismatch";
        }
        else
        {
            $pass= md5($password);
            $userData2 = array(
                'email' => $email,
                'name' => $full_name,
                'mobile_number' => $phone_no,
                'verification_code' => $db_rand_no,
                'password' => $pass,
                'verified' => 0,
                'role' => "lecturer"
            );
            if($user->insert($tableName,$userData) && $user->insert($tableName2,$userData2))
            {
               
                $output='<p>Hello ' . $full_name . '</p>';
             
                $output .='<p>Enter The Below OTP Code in the login form</p>';
                $output .='<p>In order to proceed</p>';
                $output .='<p>The Code will expire in 15mins</p>';
                $output .= '<b>' . $rand_no . '</b>';
                 $output .='<p>Thanks,</p>';
                 $output .='<p>Attendance System</p>';
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
        
                 
                 $mail->setFrom('aisacsmooth@gmail.com','Attendance System');
                 $mail->addReplyTo($email,'Attendance System');
                 $mail->addAddress($email);
                 $mail->isHTML(true); //Set email format to HTML
                 $mail->Subject = $subject;
                 $mail->Body = $output;
               
                 if($mail->send())
                 {
                    echo "ok";
                 }
                 else
                 {
                     $errors= "Error Sending Email Please try again";
                 }
                
            }
            else
            {
                $errors = "Error Creating Account,Try Again";
            }
        }
        
    }
    else
    {
        $errors = "Fill All Fields First To Proceed";
    }
}
else
{
    $errors = "Not All Fields Are Set";
}
if(!empty($errors))
{
    $user_errors = array(
        'errors' => $errors
    );
    echo json_encode($user_errors);
}

?>