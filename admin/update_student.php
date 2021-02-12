<?php
require_once('../db_config.php');
$tableName = 'students';
$tableName2 = 'users';
 $errors ='';
if(isset($_POST['fullnameu']) && isset($_POST['emailu']) 
&& isset($_POST['reg_nou']) && isset($_POST['yearu']) 
&& isset($_POST['semesteru']) && isset($_POST['courseu'])
&&  isset($_POST['phone_nou']))
{
    
    $full_name = $user->testinput($_POST['fullnameu']);
    $email = $user->testinput($_POST['emailu']);
    $phone_no = $user->testinput($_POST['phone_nou']);
    $reg_no = $user->testinput($_POST['reg_nou']);
    $year = $user->testinput($_POST['yearu']);
    $semester = $user->testinput($_POST['semesteru']);
    $course = $user->testinput($_POST['courseu']);
    $department = $user->testinput($_POST['departmentu']);
    $student_id = $_POST['hidden_student_id'];
    $userData = array(
        'student_name' => $full_name,
        'student_email' => $email,
        'student_phone' => $phone_no,
        'reg_no' => $reg_no,
        'year' => $year,
        'semester' => $semester,
        'course' => $course,
        'dept' => $department
    );
    $conditions = array(
        'student_id' => $student_id
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
        else
        {
            if($user->update($tableName,$userData,$conditions))
            {
              echo "ok";
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