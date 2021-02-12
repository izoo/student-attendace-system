<?php

require_once('../db_config.php');
$tableName = 'lecturers';
$tableName2 = 'users';
 $errors ='';
if(isset($_POST['fullnameu']) && isset($_POST['emailu']) 
&& isset($_POST['staff_idu']) &&  isset($_POST['phone_nou']))
{
    
    $full_name = $user->testinput($_POST['fullnameu']);
    $email = $user->testinput($_POST['emailu']);
    $phone_no = $user->testinput($_POST['phone_nou']);
    $staff_id = $user->testinput($_POST['staff_idu']);
    $lecturer_id = $_POST['hidden_lecturer_id'];
    $userData = array(
        'lecturer_name' => $full_name,
        'lecturer_email' => $email,
        'lecturer_phone' => $phone_no,
        'lecturer_staff_id' => $staff_id
    );
    $conditions = array(
        'lecturer_id' => $lecturer_id,
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