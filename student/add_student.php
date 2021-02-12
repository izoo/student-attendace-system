<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('../db_config.php');
require '../vendor/autoload.php';
$tableName = 'students';
$tableName2 = 'users';
 $errors ='';
if(isset($_POST['fullname']) && isset($_POST['email']) 
&& isset($_POST['reg_no']) && isset($_POST['year']) 
&& isset($_POST['semester']) && isset($_POST['course'])
&&  isset($_POST['phone_no']))
{
    
    $full_name = $user->testinput($_POST['fullname']);
    $email = $user->testinput($_POST['email']);
    $phone_no = $user->testinput($_POST['phone_no']);
    $reg_no = $user->testinput($_POST['reg_no']);
    $year = $user->testinput($_POST['year']);
    $semester = $user->testinput($_POST['semester']);
    $course = $user->testinput($_POST['course']);
    $department = $user->testinput($_POST['department']);
    $rand_no = rand(10000,99999);
    $db_rand_no = md5($rand_no);
    $userData = array(
        'student_name' => $full_name,
        'student_email' => $email,
        'student_phone' => $phone_no,
        'reg_no' => $reg_no,
        'year' => $year,
        'semester' => $semester,
        'course' => $course,
        'dept' => $department,
        'verification_code' => $db_rand_no,
    );
    $conditions = array(
        'student_email' => $email,
        'reg_no' => $reg_no,
    );
    $userData2 = array(
        'email' => $email,
        'name' => $full_name,
        'mobile_number' => $phone_no,
        'verification_code' => $db_rand_no,
        'verified' => 0,
        'role' => "student"
    );
    $conditions2 = array(
        'email' => $email,
        'mobile_number' => $phone_no,
    );
    if(!empty($full_name) && !empty($email) && !empty($phone_no) &&  !empty($reg_no))
    {
        if(!ctype_alpha(str_replace(' ','',$full_name)))
        {
            $errors = "Name must contain letters and space only";
        }
        else if(!is_numeric($phone_no))
        {
            $errors =  "Mobile Number Can Only Contain Numbers";
        }
        else if($user->checkRow($tableName,$conditions)>0 || $user->checkRow($tableName2,$conditions2))
        {
            $errors = "Account with similar Email or Mobile No Already Exists";
        }
        else
        {
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