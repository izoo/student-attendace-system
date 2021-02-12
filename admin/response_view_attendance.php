<?php
require('../db_config.php');
if(isset($_POST['subject']) && isset($_POST['date'])) 
{
  $user_id = $_SESSION['user_session'];
    $stmt=$DB_con->prepare("SELECT * FROM users WHERE email=:ema");
    $stmt->bindParam(":ema",$user_id);
    $stmt->execute();
    $results=$stmt->fetch(PDO::FETCH_ASSOC);
    $stmt4=$DB_con->prepare("SELECT * FROM students WHERE student_email=:ema");
    $stmt4->bindParam(":ema",$user_id);
    $stmt4->execute();
    $rt=$stmt4->fetch(PDO::FETCH_ASSOC);
  $subject= $_POST['subject'];
  $date= $_POST['date'];
  if($results['role'] == "student")
  {
    if(!empty($subject) && empty($date))
  {
   
    
    $sql = $DB_con->prepare("SELECT tbl_attendance.*,subjects.*,students.* FROM tbl_attendance JOIN students ON
    students.student_id = tbl_attendance.student_id JOIN subjects ON subjects.subject_id = tbl_attendance.subject_id
    WHERE tbl_attendance.subject_id=:sub AND 
        students.student_email =:ema");
    $sql->bindParam(":sub",$subject);
    $sql->bindParam(":ema",$user_id);
    $query = $DB_con->prepare("
	SELECT 
		ROUND((SELECT COUNT(*) FROM tbl_attendance 
		WHERE attendance_status = 'Present' AND student_id=:id 
		AND subject_id = :sub) 
	* 100 / COUNT(*)) AS percentage FROM tbl_attendance 
    WHERE subject_id = :sub2 AND student_id=:id ");
    $query->bindParam(":sub",$subject);
    $query->bindParam(":sub2",$subject);
    $query->bindParam(":id",$rt['student_id']);
    $query->execute();
    $rt = $query->fetch(PDO::FETCH_ASSOC);
    $percentage = $rt['percentage'];
  }
 else if(!empty($date) && empty($subject))
  {
    $sql = $DB_con->prepare("SELECT tbl_attendance.*,subjects.*,students.* FROM tbl_attendance JOIN students ON
    students.student_id = tbl_attendance.student_id JOIN subjects ON subjects.subject_id = tbl_attendance.subject_id
    WHERE tbl_attendance.attendance_date=:dt
    AND students.student_email =:ema " );
    $sql->bindParam(":dt",$date);
    $sql->bindParam(":ema",$user_id);
    $query = $DB_con->prepare("
	SELECT 
		ROUND((SELECT COUNT(*) FROM tbl_attendance 
		WHERE attendance_status = 'Present' 
		AND attendance_date = :dt) 
	* 100 / COUNT(*)) AS percentage FROM tbl_attendance 
    WHERE attendance_date = :dt2 AND student_id=:id ");
    $query->bindParam(":dt",$date);
    $query->bindParam(":dt2",$date);
    $query->bindParam(":id",$rt['student_id']);
    $query->execute();
    $rt = $query->fetch(PDO::FETCH_ASSOC);
    $percentage = $rt['percentage'];
  }
  else if(!empty($date) && !empty($subject))
  {
    $sql = $DB_con->prepare("SELECT tbl_attendance.*,subjects.*,students.* FROM tbl_attendance JOIN students ON
    students.student_id = tbl_attendance.student_id JOIN subjects ON subjects.subject_id = tbl_attendance.subject_id
    WHERE tbl_attendance.subject_id=:sub AND tbl_attendance.attendance_date=:dt AND students.student_email =:ema");
    $sql->bindParam(":sub",$subject);
    $sql->bindParam(":dt",$date);
    $sql->bindParam(":ema",$user_id);

    $query = $DB_con->prepare("
	SELECT 
		ROUND((SELECT COUNT(*) FROM tbl_attendance 
		WHERE attendance_status = 'Present' 
		AND attendance_date = :dt AND subject_id = :sub) 
	* 100 / COUNT(*)) AS percentage FROM tbl_attendance 
    WHERE attendance_date = :dt2 AND subject_id = :sub2 AND student_id=:id ");
    $query->bindParam(":dt",$date);
    $query->bindParam(":dt2",$date);
    $query->bindParam(":sub",$subject);
    $query->bindParam(":sub2",$subject);
    $query->bindParam(":id",$rt['student_id']);
    $query->execute();
    $rt = $query->fetch(PDO::FETCH_ASSOC);
    $percentage = $rt['percentage'];
  }
  }
  else
  {
    if(!empty($subject) && empty($date))
  {
   
    
    $sql = $DB_con->prepare("SELECT tbl_attendance.*,subjects.*,students.* FROM tbl_attendance JOIN students ON
    students.student_id = tbl_attendance.student_id JOIN subjects ON subjects.subject_id = tbl_attendance.subject_id
    WHERE tbl_attendance.subject_id=:sub");
    $sql->bindParam(":sub",$subject);
    $query = $DB_con->prepare("
	SELECT 
		ROUND((SELECT COUNT(*) FROM tbl_attendance 
		WHERE attendance_status = 'Present' 
		AND subject_id = :sub) 
	* 100 / COUNT(*)) AS percentage FROM tbl_attendance 
    WHERE subject_id = :sub2");
    $query->bindParam(":sub",$subject);
    $query->bindParam(":sub2",$subject);
    $query->execute();
    $rt = $query->fetch(PDO::FETCH_ASSOC);
    $percentage = $rt['percentage'];
  }
 else if(!empty($date) && empty($subject))
  {
    $sql = $DB_con->prepare("SELECT tbl_attendance.*,subjects.*,students.* FROM tbl_attendance JOIN students ON
    students.student_id = tbl_attendance.student_id JOIN subjects ON subjects.subject_id = tbl_attendance.subject_id
    WHERE tbl_attendance.attendance_date=:dt");
    $sql->bindParam(":dt",$date);
    $query = $DB_con->prepare("
	SELECT 
		ROUND((SELECT COUNT(*) FROM tbl_attendance 
		WHERE attendance_status = 'Present' 
		AND attendance_date = :dt) 
	* 100 / COUNT(*)) AS percentage FROM tbl_attendance 
    WHERE attendance_date = :dt2");
    $query->bindParam(":dt",$date);
    $query->bindParam(":dt2",$date);
    $query->execute();
    $rt = $query->fetch(PDO::FETCH_ASSOC);
    $percentage = $rt['percentage'];
  }
  else if(!empty($date) && !empty($subject))
  {
    $sql = $DB_con->prepare("SELECT tbl_attendance.*,subjects.*,students.* FROM tbl_attendance JOIN students ON
    students.student_id = tbl_attendance.student_id JOIN subjects ON subjects.subject_id = tbl_attendance.subject_id
    WHERE tbl_attendance.subject_id=:sub AND tbl_attendance.attendance_date=:dt");
    $sql->bindParam(":sub",$subject);
    $sql->bindParam(":dt",$date);

    $query = $DB_con->prepare("
	SELECT 
		ROUND((SELECT COUNT(*) FROM tbl_attendance 
		WHERE attendance_status = 'Present' 
		AND attendance_date = :dt AND subject_id = :sub) 
	* 100 / COUNT(*)) AS percentage FROM tbl_attendance 
    WHERE attendance_date = :dt2 AND subject_id = :sub2");
    $query->bindParam(":dt",$date);
    $query->bindParam(":dt2",$date);
    $query->bindParam(":sub",$subject);
    $query->bindParam(":sub2",$subject);
    $query->execute();
    $rt = $query->fetch(PDO::FETCH_ASSOC);
    $percentage = $rt['percentage'];
  }
  }
   $sql->execute();
   $total_rows = $sql->rowCount();
   $result = $sql->fetchAll();
   $output = array();
   $data = array();
   $number = 1;
   foreach($result as $row)
   {
      
   
       $sub_array = array();
       $sub_array[] = $number;
       $sub_array[] = $row['subject_name'];
       $sub_array[] = $row['reg_no'];
       $sub_array[] = $row['student_name'];
       $sub_array[] = $row['attendance_date'];
       $sub_array[] = $row['attendance_status'];
      
     
       $data[] = $sub_array;
       $number++;
   }
  


   $output = array(
       "draw" => 1,
       "recordsTotal" => intval($total_rows),
       "recordsFiltered" => intval($total_rows),
       "data" => $data,
       "percentage" => $percentage
   );
   echo json_encode($output);
  }
  else
  {
      echo "Subject is empty";
  }

?>
