<?php

//echo md5($password);
require_once('../db_config.php');
if($user->is_loggedin()!="")
{
	 $user_id = $_SESSION['user_session'];
    $stmt=$DB_con->prepare("SELECT * FROM users WHERE email=:ema");
    $stmt->bindParam(":ema",$user_id);
    $stmt->execute();
    $results=$stmt->fetch(PDO::FETCH_ASSOC);
	
  
//0797168491    
    
}
else
{
  $user->redirect('../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta
      name="description"
      content="STUDENT ATTENDANCE INFORMATION SYSTEM."
    />
   
 
    <meta property="og:image" content="../blog/vali-admin/hero-social.png" />
    <meta
      property="og:description"
      content="STUDENT ATTENDANCE INFORMATION SYSTEM."
    />
    <title>STUDENT |MANAGEMENT</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <!-- Font-icon css-->
    <link
      rel="stylesheet"
      type="text/css"
      href="css/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    
    <style>
   
.dataTables_wrapper .dataTables_filter {
  float:right;

}
#healthTable .dataTables_wrapper .dataTables_filter
{
  float:right;
}
.dataTables_wrapper .dataTables_info
{
  float:left;
} 
    </style>
  </head>



  <body class="app sidebar-mini rtl">
    
    <!-- Navbar-->
    <header class="app-header">
      <a class="app-header__logo" href="#">ATTENDANCE SYSTEM</a>
      <!-- Sidebar toggle button--><a
        class="app-sidebar__toggle"
        href="#"
        data-toggle="sidebar"
        aria-label="Hide Sidebar"
      ></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
       
       
        <!-- User Menu-->
        <li class="dropdown">
          <a
            class="app-nav__item"
            href="#"
            data-toggle="dropdown"
            aria-label="Open Profile Menu"
            ><i class="fa fa-user fa-lg"></i
          ></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
           
            <!-- <li>
              <a class="dropdown-item" href="#"
                ><i class="fa fa-user fa-lg"></i> Profile</a
              >
            </li> -->
            <li>
              <a class="dropdown-item" href="../logout.php?logout=true"
                ><i class="fa fa-sign-out fa-lg"></i> Logout</a
              >
            </li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">
        <div>
        <?php
          
          if($results['role'] == "admin")
          {
            ?>
          <p class="app-sidebar__user-name">Admin</p>
          <?php
          }
          else if($results['role'] == "student")
          {
            ?>
            <p class="app-sidebar__user-name">Student</p>
            <?php 
          }
          
           else 
          {
            ?>
            <p class="app-sidebar__user-name">Lecturer</p>
            <?php 
          }
          ?>
          <p class="app-sidebar__user-designation">STUDENT ATTENDANCE</p>
        </div>
      </div>
      <ul class="app-menu">
       
        <?php 
          if($results['role'] == "admin" || $results['role'] == "lecturer")
          {
            ?>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview"
            ><i class="app-menu__icon fa fa-users"></i
            ><span class="app-menu__label">Students</span
            ><i class="treeview-indicator fa fa-angle-right"></i
          ></a>
          <ul class="treeview-menu">
          <?php
          
          if($results['role'] == "admin")
          {
            ?>
            <li>
              <a class="treeview-item" href="#" data-id="new-student"
                ><i class="icon fa fa-circle-o"></i>New Student</a
              >
            </li>
            <?php
          }
          ?>
            <li>
              <a
                class="treeview-item"
                href="#"
                data-id="students-list"
                ><i class="icon fa fa-circle-o"></i> Students List</a
              >
            </li>
          
           
          </ul>
        </li>
        <?php
          }
           if($results['role'] == "student")
          {
            ?>
            <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview"
            ><i class="app-menu__icon fa fa-users"></i
            ><span class="app-menu__label">Profile</span
            ><i class="treeview-indicator fa fa-angle-right"></i
          ></a>
          <ul class="treeview-menu">
            
            <li>
              <a
                class="treeview-item"
                href="#"
                data-id="students-list"
                ><i class="icon fa fa-circle-o"></i> View Profile</a
              >
            </li>
          
           
          </ul>
        </li>
            <?php
          }
          ?>
         <?php 
          if($results['role'] == "admin")
          {
            ?>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview"
            ><i class="app-menu__icon fa fa-medkit"></i
            ><span class="app-menu__label">Lecturers</span
            ><i class="treeview-indicator fa fa-angle-right"></i
          ></a>
          <ul class="treeview-menu">
        
            <li>
              <a class="treeview-item" href="#" data-id="new-lecturer"
                ><i class="icon fa fa-circle-o"></i>New Lecturer </a
              >
            </li>

            <li>
              <a class="treeview-item" href="#" data-id="list-lecturer"
                ><i class="icon fa fa-circle-o"></i>Lecturers List</a>
            </li>
          
          </ul>
        </li>
        <?php
          }
          else if($results['role'] == "lecturer" )
          {

            ?>
             <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview"
            ><i class="app-menu__icon fa fa-medkit"></i
            ><span class="app-menu__label">Profile</span
            ><i class="treeview-indicator fa fa-angle-right"></i
          ></a>
          <ul class="treeview-menu">

            <li>
              <a class="treeview-item" href="#" data-id="list-lecturer"
                ><i class="icon fa fa-circle-o"></i>View Profile</a>
            </li>
          
          </ul>
        </li>
       
            <?php
          }
            ?>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview"
            ><i class="app-menu__icon fa fa-legal"></i
            ><span class="app-menu__label">Subjects</span
            ><i class="treeview-indicator fa fa-angle-right"></i
          ></a>
          <ul class="treeview-menu">
          <?php 
          if($results['role'] == "admin")
          {
            ?>
            <li>
              <a class="treeview-item" href="#" data-id="new-subject"
                ><i class="icon fa fa-circle-o"></i> New Subject</a
              >
            </li>
            <li>
              <a class="treeview-item" href="#" data-id="list-subject"
                ><i class="icon fa fa-circle-o"></i>Subject List</a
              >
            </li>
            <?php
          }
          else if($results['role'] == "admin" || $results['role'] == "lecturer")
          {
            ?>
             <li>
              <a class="treeview-item" href="#" data-id="list-assignments"
                ><i class="icon fa fa-circle-o"></i>Assignments List</a
              >
            </li>
            <?php
          }
          ?>
            <?php 
          if($results['role'] == "student")
          {
            ?>
             <li>
              <a class="treeview-item" href="#" data-id="list-assignments"
                ><i class="icon fa fa-circle-o"></i>View Subjects</a
              >
            </li>
            <?php
          }
          ?>
           
          </ul>
        </li>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview"
            ><i class="app-menu__icon fa fa-medkit"></i
            ><span class="app-menu__label">Attendance</span
            ><i class="treeview-indicator fa fa-angle-right"></i
          ></a>
          <ul class="treeview-menu">

            <li>
              <a class="treeview-item" href="#" data-id="add-attendance"
                ><i class="icon fa fa-circle-o"></i>Add Attendance</a>
            </li>
          
            <li>
              <a class="treeview-item" href="#" data-id="view-attendance"
                ><i class="icon fa fa-circle-o"></i>View  Attendance</a>
            </li>
          </ul>
        </li>
        </li>
        <li class="">
          <a class="app-menu__item" href="../logout.php?logout=true" 
            ><i class="app-menu__icon fa fa-power-off"></i
            ><span class="app-menu__label">Logout</span
            ></a>
        
        </li>
      </ul>
    </aside>
    <main class="app-content">
    <?php
    if($results['role'] == "admin")
    {
      ?>
            <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p>STUDENT ATTENDANCE System</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-4">
          <div class="widget-small primary coloured-icon">
            <i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Students</h4>
              <p><b id="inmate_count"></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="widget-small info coloured-icon">
            <i class="icon fa fa-legal fa-3x"></i>
            <div class="info">
              <h4>Lectures</h4>
              <p><b id="case_count"></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="widget-small warning coloured-icon">
            <i class="icon fa fa-balance-scale fa-3x"></i>
            <div class="info">
              <h4>Subjects</h4>
              <p><b id="conviction_count"></b></p>
            </div>
          </div>
        </div>
      
      </div>
      <?php
    }
    else
    {
      ?>
      <div style="padding:2%;">
      </div>
      <?php
    }

    ?>
      <!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
<div id="tabs-content">
<?php
 if($results['role'] == "admin")
 {
   ?>

  <div class="profile" id="new-student" style="display: block;"> 
    <div class="app-title">
      <div>
        <h1><i class="fa fa-th-list"></i> Students</h1>
        <p>Register New Student Here</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
       
        <li class="breadcrumb-item active"><a href="#">Students List</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="tile">
          <h3 class="tile-title">Register New Student Here</h3>
          <div class="tile-body">
          <form method="POST" id="registerUser">
                                       <div style="display: none;" id="errorUser" class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Error!</strong> <span id="errors"></span>
                                       </div>
                                      <div class="row">
                                        <div class="form-group col-md-4 col-lg-4 col-sm-4">
                                            <label for="fullname">Full Name</label>
                                            <input class="form-control" type="text" id="fullname" name="fullname" placeholder="Enter your name" required>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4 col-sm-4">
                                            <label for="emailaddress"> Email address</label>
                                            <input class="form-control" type="email" id="email" name="email" required placeholder="Enter your email">
                                        </div>
                                     <div class="clearfix">

                                     </div>
                                     <div class="form-group col-md-4 col-lg-4 col-sm-4">
                                        <label for="emailaddress">Reg Number</label>
                                        <input class="form-control" type="number" id="reg_no" name="reg_no" required placeholder="Enter Reg No">
                                    </div>
                                      </div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-sm-6 p-2">
                                                <div class="row px-2">
                                                    <label for="gender">Year</label>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <div class="form-group col-md-6 col-lg-6 col-sm-6">
                                                    <div class="row">
                                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                                    <label class="radio-inline" style="color:#000;">
                                                     <input type="radio" name="year" value="1st" checked>  1st
                                                     </label>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                                    <label class="radio-inline" style="color:#000;">
                                                     <input type="radio" value="2nd" name="year">  2nd
                                                     </label>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                                        <label class="radio-inline" style="color:#000;">
                                                         <input type="radio" value="3rd" name="year">  3rd
                                                         </label>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-sm-3">
                                                            <label class="radio-inline" style="color:#000;">
                                                             <input type="radio" value="4th" name="year">  4th
                                                             </label>
                                                            </div>
                                                    </div>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-sm-6 p-2">
                                                <div class="row">
                                                    <label for="gender">Semester</label>

                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <div class="form-group col-md-6 col-lg-6 col-sm-6">
                                                    <div class="row">
                                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                                    <label class="radio-inline" style="color:#000;">
                                                     <input type="radio" name="semester" value="1st" checked>  1st
                                                     </label>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                                    <label class="radio-inline" style="color:#000;">
                                                     <input type="radio" value="2nd" name="semester">  2nd
                                                     </label>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                                        <label class="radio-inline" style="color:#000;">
                                                         <input type="radio" value="3rd" name="semester">  3nd
                                                         </label>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-sm-3">
                                                            <label class="radio-inline" style="color:#000;">
                                                             <input type="radio" value="4th" name="semester">  4th
                                                             </label>
                                                            </div>
                                                    </div>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row p-2 ">
                                            <div class="form-group col-sm-4 col-md-4 col-lg-4" style="padding-left:1%">
                                                <label for="course">Phone Number</label>
                                               <input type="number" name="phone_no" class="form-control" required placeholder="Enter Phone No">
                                            </div>
                                            <div class="form-group col-sm-4 col-md-4 col-lg-4" style="padding-left:1%">
                                                <label for="course">Course</label>
                                                <select name="course" class="form-control" id="course">
                                                <option value="course1">Course 1</option>
                                                <option value="course2">Course 2</option>
                                                <option value="course3">Course 3</option>
                                                <option value="course4">Course 4</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                                <label for="department">Department</label>
                                                <select name="department" class="form-control" id="department">
                                                <option value="dept1">Department 1</option>
                                                <option value="dept2">Department 2</option>
                                                <option value="dept3">Department 3</option>
                                                <option value="dept4">Department 4</option>
                                                </select>
                                            </div>

                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox checkbox-success">
                                                <input type="checkbox" class="custom-control-input" id="checkbox-signup">
                                                <label class="custom-control-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                            </div>
                                        </div> -->
                                        <div class="form-group mb-0 text-center">
                                            <button class="btn btn-primary btn-block" type="submit" id="userButton"> REGISTER </button>
                                        </div>
    
                                    </form>
          </div>
         
        </div>
      </div>
      </div>
</div> 
<?php
 }
 ?>
 <?php
  if($results['role'] == "admin")
          {
            ?>
<div class="profile" id="students-list"> 
<?php
}
else if($results['role'] == "student" || $results['role'] == "lecturer" )
{
  ?>
  <div class="profile" id="students-list" style="display:block"> 
  <?php
}
?>
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Students</h1>
      <p>List of Students</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
     
     
    </ul>
  </div>
  <table class="table table-hover table-bordered" id="studentsTable">
    <thead>
      <tr>
        <th>#</th>
        <th>Reg No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Year</th>
        <th>Semester</th>
        <th>Course</th>
        <th>Department</th>
        <?php
        if($results['role'] == "student" || $results['role'] == "admin")
        {
          ?>
            <th>Action</th>
        <?php
        }
        ?>
      
       

        
      </tr>
    </thead>
    <tbody>
      <tr>
       </tr>
       </tbody>
       </table>
</div>
<div class="profile" id="new-subject"> 
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Subjects</h1>
      <p>Register New Subject Here</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
     
      <li class="breadcrumb-item active"><a href="#">Subject List</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
      <div class="tile">
        <h3 class="tile-title">Enter Subject Details Below Here</h3>
        <div class="tile-body">
          <div id="subjectErrors">
         </div>
          <form method="POST" id="formSubject">
           
          
          <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6">
              <div class="form-group">
                <label class="control-label">Subject Name</label>
             <input type="text" class="form-control input-lg" name="subject_name">
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6">
              <div class="form-group">
               
                <label class="control-label">Subject Code</label>
             <input type="text" class="form-control input-lg" name="subject_code">
              </div>
            </div>
          </div>
          <div class="row">
          <div class="col-md-6 col-lg-6 col-sm-6 p-2">
                <div class="row px-2">
                <label for="gender">Year</label>
                <br>
                <br>
                <br>
                <br>
                <div class="form-group col-md-6 col-lg-6 col-sm-6">
                <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-3">
                <label class="radio-inline" style="color:#000;">
                <input type="radio" name="year" value="1st" checked>  1st
                </label>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3">
                <label class="radio-inline" style="color:#000;">
                <input type="radio" value="2nd" name="year">  2nd
                </label>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3">
                <label class="radio-inline" style="color:#000;">
                <input type="radio" value="3rd" name="year">  3rd
                </label>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3">
                <label class="radio-inline" style="color:#000;">
                <input type="radio" value="4th" name="year">  4th
                </label>
                </div>
                </div>
                </div>
                </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6 p-2">
                <div class="row">
                <label for="gender">Semester</label>

                <br>
                <br>
                <br>
                <br>
                <div class="form-group col-md-6 col-lg-6 col-sm-6">
                <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-3">
                <label class="radio-inline" style="color:#000;">
                <input type="radio" name="subject_semester" value="1st" checked>  1st
                </label>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3">
                <label class="radio-inline" style="color:#000;">
                <input type="radio" value="2nd" name="subject_semester">  2nd
                </label>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3">
                <label class="radio-inline" style="color:#000;">
                <input type="radio" value="3rd" name="subject_semester">  3nd
                </label>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3">
                <label class="radio-inline" style="color:#000;">
                <input type="radio" value="4th" name="subject_semester">  4th
                </label>
                </div>
                </div>
                </div>
                </div>
                </div>
       
          </div>
         <div class="row">
         <div class="form-group col-sm-12 col-md-12 col-lg-12" name="course" style="padding-left:1%">
                                                <label for="course">Course</label>
                                                <select name="course" class="form-control" name="subject_course" id="subject_course">
                                                <option value="course1">Course 1</option>
                                                <option value="course2">Course 2</option>
                                                <option value="course3">Course 3</option>
                                                <option value="course4">Course 4</option>
                                                </select>
                                            </div>
                                            
         </div>
        
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
              <div class="tile-footer" >
                <button class="btn btn-primary" id="btnSubject" type="submit" style="margin-left:20%;margin-right:50%;">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>REGISTER SUBJECT</button
                >&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"
                  ><i class="fa fa-fw fa-lg fa-times-circle"></i>RESET</a
                >
              </div>
            </div>
          </div>
           
          </form>
        </div>
       
      </div>
    </div>
    </div>
</div>
<div class="profile" id="list-subject"> 
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Subjects</h1>
      <p>List of Subjects</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
     
      <li class="breadcrumb-item active"><a href="#">New Subject</a></li>
    </ul>
   
  </div>
  <table class="table table-hover table-bordered" id="subjectsTable">
    <thead>
      <tr>
        <th style="width:10px;">#</th>
        <th>Name</th>
        <th>Code</th>
        <th>Course</th>
        <th>Year</th>
        <th>Semester</th>
        <th>Status</th>
        <th style="width:100px;">Action</th>
        
      </tr>
    </thead>
    <tbody>
      
       </tbody>
       </table>
</div>
<div class="profile" id="add-attendance"> 
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i>Attendance</h1>
      <p>Add Attendance </p>
   
    </div>
   
    </div>
   
  
  <div class="card" style="padding:2%;">
  <!-- <form id="formSearch" method="POST"> -->
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="form-group">
          <label for="">Subject</label>
          <?php
          if($results['role'] == "admin")
          {
            $sql = $DB_con->prepare("SELECT subjects.*, lecturers.*,lecturers_subjects.* FROM subjects JOIN lecturers_subjects ON
           lecturers_subjects.subject_id = subjects.subject_id 
           JOIN lecturers ON lecturers.lecturer_id = lecturers_subjects.lecturer_id
            ORDER BY lecturers_subjects.subject_id DESC");
          }
          else if($results['role'] == "lecturer")
          {
            $sql = $DB_con->prepare("SELECT subjects.*, lecturers.*,lecturers_subjects.* FROM subjects JOIN lecturers_subjects ON
            lecturers_subjects.subject_id = subjects.subject_id 
            JOIN lecturers ON lecturers.lecturer_id = lecturers_subjects.lecturer_id
            WHERE lecturers.lecturer_email=:em
             ORDER BY lecturers_subjects.subject_id DESC");
            $sql->bindParam(":em",$user_id);
          }
          else if($results['role'] == "student")
          {
            $stmt=$DB_con->prepare("SELECT * FROM students WHERE student_email=:ema");
            $stmt->bindParam(":ema",$user_id);
            $stmt->execute();
            //echo $stmt->rowCount() . "<br>";
            $rw=$stmt->fetch(PDO::FETCH_ASSOC);
            $sql = $DB_con->prepare("SELECT * FROM subjects WHERE subject_course=:course 
            AND subject_year=:yr AND subject_semester=:sem");
            $sql->bindParam(":course",$rw['course']);
            $sql->bindParam(":yr",$rw['year']);
            $sql->bindParam(":sem",$rw['semester']);
          }
            $sql->execute();
            if($sql->rowCount()>0)
            {
              ?>
              <select name="attendance_subject" id="attendance_subject" class="form-control">

             
              <?php
              $rw = $sql->fetchAll();
              foreach($rw as $r)
              {
                ?>
                <option value="<?php echo $r['subject_id'] ?>"><?php echo $r['subject_name'] ?></option>

                <?php
              }
              ?>
               </select>
              <?php
            }
            else
            {
              ?>
              <label for=""> No Subject Assigned To You Yet,Check Later</label>
              <?php
            }

          ?>
        </div>
        </div>
        
      </div>
      <div class="row" style="padding:1%;">
      <button type="button" class="btn btn-success btn-lg" id="btnSearch">Search</button>
      </div>
          <!-- </form> -->
    </div>
    <div class="col-md-4 col-lg-4 col-sm-4 pull-right" style="padding-top:10px;">
        <div class="form-group">
          <label for="">Attendance Date</label>
         <input type="date" class="form-control input-lg" id="attend_date" name="attend_date">
        </div>
        </div>
  <table class="table table-hover table-bordered" id="attendTable" style="display:none;">
    <thead>
      <tr>
        <th style="width:10px;">#</th>
        <th>Student</th>
        <th>Regno</th>
        <th>Check Attendance</th>
      </tr>
    </thead>
    <tbody>
      
       </tbody>
       <tr>
       <th></th>
       <th></th>
       <th></th>
       <th><button class="btn btn-success btn-flat" id="mark-attendance">Update Attendance</button></th>
       </tr>
       <tfoot>
       </tfoot>
       </table>
</div>
<div class="profile" id="view-attendance"> 
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i>Attendance</h1>
      <p>View Attendance </p>
   
    </div>
   
    </div>
    
  
  <div class="card" style="padding:2%;">
  <!-- <form id="formSearch" method="POST"> -->
      <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6">
        <div class="form-group">
        <label for="">Subject</label>
          <?php
          if($results['role'] == "admin")
          {
            $sql = $DB_con->prepare("SELECT subjects.*, lecturers.*,lecturers_subjects.* FROM subjects JOIN lecturers_subjects ON
           lecturers_subjects.subject_id = subjects.subject_id 
           JOIN lecturers ON lecturers.lecturer_id = lecturers_subjects.lecturer_id
            ORDER BY lecturers_subjects.subject_id DESC");
          }
          else if($results['role'] == "lecturer")
          {
            $sql = $DB_con->prepare("SELECT subjects.*, lecturers.*,lecturers_subjects.* FROM subjects JOIN lecturers_subjects ON
            lecturers_subjects.subject_id = subjects.subject_id 
            JOIN lecturers ON lecturers.lecturer_id = lecturers_subjects.lecturer_id
            WHERE lecturers.lecturer_email=:em
             ORDER BY lecturers_subjects.subject_id DESC");
            $sql->bindParam(":em",$user_id);
          }
          else if($results['role'] == "student")
          {
            $stmt=$DB_con->prepare("SELECT * FROM students WHERE student_email=:ema");
            $stmt->bindParam(":ema",$user_id);
            $stmt->execute();
            //echo $stmt->rowCount() . "<br>";
            $rw=$stmt->fetch(PDO::FETCH_ASSOC);
            $sql = $DB_con->prepare("SELECT * FROM subjects WHERE subject_course=:course 
            AND subject_year=:yr AND subject_semester=:sem");
            $sql->bindParam(":course",$rw['course']);
            $sql->bindParam(":yr",$rw['year']);
            $sql->bindParam(":sem",$rw['semester']);
          }
            $sql->execute();
            if($sql->rowCount()>0)
            {
              ?>
              <select name="attendance_view_subject" id="attendance_view_subject" class="form-control">

             
              <?php
              $rw = $sql->fetchAll();
              foreach($rw as $r)
              {
                ?>
                <option value="<?php echo $r['subject_id'] ?>"><?php echo $r['subject_name'] ?></option>

                <?php
              }
              ?>
               </select>
              <?php
            }
            else
            {
              ?>
              <label for=""> No Subject Assigned To You Yet,Check Later</label>
              <?php
            }

          ?>
        </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 pull-right" style="padding-top:10px;">
        <div class="form-group">
          <label for="">Attendance Date</label>
         <input type="date" class="form-control input-lg" id="attend_view_date" name="attend_view_date">
        </div>
        </div>
      </div>
      <div class="row" style="padding:1%;">
      <button type="button" class="btn btn-success btn-lg" id="btnviewSearch">Search</button>
      </div>
          <!-- </form> -->
    </div>
    
  <table class="table table-hover table-bordered" id="attendviewTable" style="display:none;">
    <thead>
      <tr>
        <th style="width:10px;">#</th>
        <th>Subject</th>
        <th>Student</th>
        <th>Regno</th>
        <th>Date</th>
        <th>Attendance Status</th>
      </tr>
    </thead>
    <tbody>
      
       </tbody>
       <tr>
       <th></th>
       <th></th>
       <th></th>
       <th></th>
       <th></th>
       <th>Attendance % : <b id="percentage"></b></th>
       </tr>
       <tfoot>
       </tfoot>
       </table>
</div>
<div class="profile" id="list-assignments"> 
  <div class="app-title">
    <div>
    <?php
   if($results['role'] == "student")
   {
  ?>
      <h1><i class="fa fa-th-list"></i> Subjects</h1>
      <p>List of Subjects</p>
      <?php
   }
   else
   {
     ?>
     <h1><i class="fa fa-th-list"></i> Assignments</h1>
      <p>List of Subject Assignments</p>
     <?php
   }
      ?>

    </div>
    <ul class="app-breadcrumb breadcrumb side">
     
     
    </ul>
   
  </div>
  <?php
   if($results['role'] == "student")
   {
  ?>
    <table class="table table-hover table-bordered" id="studentsassignmentsTable">
    <thead>
      <tr>
        <th style="width:10px;">#</th>
        <th>Subject Name</th>
        <th>Subject Code</th>
        <th>Lecturer</th>
        <th>Year</th>
        <th>Semester</th>
        <th>Course</th>
        
        
      </tr>
    </thead>
    <tbody>
      
       </tbody>
       </table>
  <?php
   }
  ?>
 <?php
   if($results['role'] == "admin" || $results['role'] == "lecturer"  )
   {
  ?>
  <table class="table table-hover table-bordered" id="assignmentsTable">
    <thead>
      <tr>
        <th style="width:10px;">#</th>
        <th>Subject Name</th>
        <th>Subject Code</th>
        <?php 
        if($results['role'] == "admin")
        {
          ?>
        <th>Lecturer</th>
        <?php
   }
   ?>
        <th>Year</th>
        <th>Semester</th>
        <th>Course</th>
        <?php 
        if($results['role'] == "admin")
        {
          ?>
          
        <th style="width:100px;">Action</th>
        <?php
        }
        ?>
        
      </tr>
    </thead>
    <tbody>
      
       </tbody>
       </table>
       <?php
   }
   ?>
</div>


<div class="profile" id="new-lecturer"> 
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Lecturers List</h1>
     
    </div>
    <ul class="app-breadcrumb breadcrumb side">
     
      <li class="breadcrumb-item active"><a href="#">List of Lecturers</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
      <div class="tile">
        <h3 class="tile-title">Enter Lecturer Details Below Here</h3>
        <div class="tile-body">
          <div id="lecturersErrors"></div>
          <form method="POST" id="registerLecturer">
                                       <div style="display: none;" id="errorLecturer" class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Error!</strong> <span id="errors"></span>
                                       </div>
                                      <div class="row">
                                        <div class="form-group col-md-6 col-lg-6 col-sm-6">
                                            <label for="fullname">Full Name</label>
                                            <input class="form-control" type="text" id="fullname" name="fullname" placeholder="Enter your name" required>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6 col-sm-6">
                                            <label for="emailaddress"> Email address</label>
                                            <input class="form-control" type="email" id="email" name="email" required placeholder="Enter your email">
                                        </div>
                                     <div class="clearfix">

                                     </div>
                                    
                                      </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-lg-12 col-sm-12">
                                                <label for="emailaddress">Staff ID</label>
                                                <input class="form-control" type="number" id="staff_id" name="staff_id" required placeholder="Enter Staff ID">
                                            </div>
                                            <div class="form-group col-md-12 col-lg-12 col-sm-12">
                                                <label for="emailaddress">Phone No</label>
                                                <input class="form-control" type="number" id="phone_no" name="phone_no" required placeholder="Enter Staff ID">
                                            </div>
                                        </div>
                                      
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox checkbox-success">
                                                <input type="checkbox" class="custom-control-input" id="checkbox-signup">
                                                <label class="custom-control-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                            </div>
                                        </div> -->
                                        <div class="form-group mb-0 text-center">
                                            <button class="btn btn-gradient btn-block" type="submit" id="lecturerButton"> REGISTER </button>
                                        </div>
    
                                    </form>
        </div>
       
      </div>
    </div>
    </div>
</div>

<div class="profile" id="list-lecturer"> 
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Lecturers</h1>
      <p>List of Lecturers</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
     
      
    </ul>
  </div>
  
<div class="row">
<table class="table table-hover table-bordered" id="lecturersTable">

    <thead>
    
      <tr>
    
        <th style="width:10px;">#</th>
        <th >Name</th>
        <th >Email</th>
        <th >Staff ID</th>
        <th >Staff Phone</th>
        <th >Action</th>
        
      </tr>
    </thead>
    <tbody>

       </tbody>
       </table>
</div>
</div>


    </main>
    <!-- Essential javascripts for application to work-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.62/vfs_fonts.js" integrity="sha256-UsYCHdwExTu9cZB+QgcOkNzUCTweXr5cNfRlAAtIlPY=" crossorigin="anonymous"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
 
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Date Picker Plugin -->
    <script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="js/plugins/select2.min.js"></script>
   <!-- Page specific javascripts-->
   <script type="text/javascript" src="js/plugins/bootstrap-notify.min.js"></script>
   <script type="text/javascript" src="js/plugins/sweetalert.min.js"></script>
 





 
    <script>
   function studentCount()
      {
        $.ajax({
          type:"GET",
          url:"count_students.php",
          success:function(data)
          {
            $('#inmate_count').html(data);
          }
        })
      }
      function lecturerCount()
      {
        $.ajax({
          type:"GET",
          url:"count_lecturers.php",
          success:function(data)
          {
            $('#health_count').html(data);
          }
        })
      }
      function subjectsCount()
      {
        $.ajax({
          type:"GET",
          url:"count_subjects.php",
          success:function(data)
          {
            $('#conviction_count').html(data);
          }
        })
      }
      function caseCount()
      {
        $.ajax({
          type:"GET",
          url:"count_lecturers.php",
          success:function(data)
          {
            $('#case_count').html(data);
          }
        })
      }
      function fetchLecturersNames()
      {
        $.ajax({
          url:"fetch_lecturer_names.php",
          method:"GET",
          dataType:"json",
          success:function(data)
          {
            //alert(data);
          
            $.each(data,function(index,val){
             
              $('#lecturer_assign_name').append('<option value=' + val.lecturer_id +'>' + val.lecturer_name +  '</option>');
            });
            // $('#demoSelect,#demoSelect2,#demoSelect3,#demoSelect4,#demoSelect5').select2();
          }
        })
      }
      function fetchSubjectsNames()
      {
        $.ajax({
          url:"fetch_subject_names.php",
          method:"GET",
          dataType:"json",
          success:function(data)
          {
            //alert(data);
          
            $.each(data,function(index,val){
             
              $('#subject_assign_name').append('<option value=' + val.subject_id +'>' + val.subject_name +  '</option>');
            });
            // $('#demoSelect,#demoSelect2,#demoSelect3,#demoSelect4,#demoSelect5').select2();
          }
        })
      }
      $(document).ready(function(){
       fetchLecturersNames();
       fetchSubjectsNames();
       studentCount();
       caseCount();
       subjectsCount();
       lecturerCount();
        $('.treeview-menu li a').click(function(e){
        e.preventDefault();
        $('.treeview-menu li a').removeClass("active");
        //add the acive state to the clicked link
        $(this).addClass("active");
        //fade out the current container
        $('.profile').fadeOut(600,function(){
        $('#' + profileID).fadeIn(600);
        });
        var profileID=$(this).attr("data-id");
     });
$('#mark-attendance').click(function(e){
  e.preventDefault();
  var id= [];
  var date = $('#attend_date').val();
  var sub = $('#attendance_subject').val();

  $('.check_attendance:checked').each(function(){
        id.push($(this).val());
        element = this
  });
  var unchecked = [];
  $('.check_attendance:not(:checked)').each(function(){
    unchecked.push($(this).val());
    //alert(unchecked.toString());
  })

  if(date !=='')
  {
   if(confirm("Are you sure want to update this attendance"))
  {
    $.ajax({
      url:"update_attendance.php",
      type:"POST",
      cache:false,
      data:{updateId:id,sub:sub,date:date,unchecked:unchecked},
      success:function(response)
      {
        
          swal({
                      title:"Success",
                      text:"Attendance Successfully Updated",
                      icon:"success",
                      button:"OK"
                  });
        

      }
    })
  }
  }
  else
  {
    alert("Date Required");
  }
});
		$('#demoDate').datepicker({
			format: "dd/mm/yyyy",
			autoclose: true,
			todayHighlight: true
		});
    $('#demoDate2').datepicker({
			format: "dd/mm/yyyy",
			autoclose: true,
			todayHighlight: true
		});

		// $('#demoSelect,#demoSelect2,#demoSelect3,#demoSelect4,#demoSelect5').select2();
// Fetch Inmates Details
var dataTable = $('#studentsTable').DataTable({
  "processing": true,
"sAjaxSource":"response_students.php",
"pageLength": 10,
"type":"POST",
"dom": 'lBfrtip',
"buttons": [
 
'excel',
'csv',
'pdf',
'print'
]
        })
// End

//  Insert Lecturer Details
$("#registerLecturer").on('submit',(function(e)
					{
					//alert("You Are Good To Go");
					e.preventDefault();
					$.ajax({
						url:"../lecturer/register_lecturer.php",
						type:"POST",
						data:new FormData(this),
						contentType:false,
						cache:false,
						processData:false,
						beforeSend: function(){	
						$("#errorLecturer").fadeOut();
						$("#lecturerButton").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Registering Lecturer ...');
	              		},
						success : function(response){						
							if(response=="ok"){									
							swal({
								title:"Success",
								text:"Account Successfully Created",
								icon:"success",
								button:"OK"
							});
								$("#userButton").html('REGISTER');
								document.getElementById("registerLecturer").reset();
                $('#lecturersTable').DataTable().ajax.reload();
							}				
							else {									
								$("#errorLecturer").fadeIn(1000, function(){						
									$("#errorLecturer").html('&nbsp; '+response+' ');
									$("#lecturerButton").html('REGISTER');
								});
							}
						}
					});
					}));
// End Insert Lecturer Details
//Update Lecturer
$("#registerLectureru").on('submit',(function(e)
					{
					//alert("You Are Good To Go");
					e.preventDefault();
					$.ajax({
						url:"update_lecturer.php",
						type:"POST",
						data:new FormData(this),
						contentType:false,
						cache:false,
						processData:false,
						beforeSend: function(){	
						$("#errorLectureru").fadeOut();
						$("#lecturerButtonu").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Updating Lecturer ...');
	              		},
						success : function(response){						
							if(response=="ok"){									
							swal({
								title:"Success",
								text:"Account Successfully Updated",
								icon:"success",
								button:"OK"
							});
              $("#lecturerButtonu").html('UPDATE');
								document.getElementById("registerLectureru").reset();
								$('#lecturerUpdate').modal('hide');
                $('#lecturersTable').DataTable().ajax.reload();
							}				
							else {									
								$("#errorLectureru").fadeIn(1000, function(){						
									$("#errorslecu").html('&nbsp; '+response+' ');
									$("#lecturerButtonu").html('UPDATE');
								});
							}
						}
					});
					}));
//End

//  Insert Student Details
$("#registerUser").on('submit',(function(e)
					{
					//alert("You Are Good To Go");
					e.preventDefault();
					$.ajax({
						url:"../student/add_student.php",
						type:"POST",
						data:new FormData(this),
						contentType:false,
						cache:false,
						processData:false,
						beforeSend: function(){	
						$("#errorUser").fadeOut();
						$("#userButton").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Registering User ...');
	              		},
						success : function(response){						
							if(response=="ok"){									
							swal({
								title:"Success",
								text:"Account Successfully Created",
								icon:"success",
								button:"OK"
							});
								$("#userButton").html('REGISTER');
								document.getElementById("registerUser").reset();
                $('#studentsTable').DataTable().ajax.reload();
								
							}				
							else {									
								$("#errorUser").fadeIn(1000, function(){						
									$("#errors").html('&nbsp; '+response+' ');
									$("#userButton").html('REGISTER');
								});
							}
						}
					});
					}));
// End Insert Student Details
// Update Student Details
$("#registerUseru").on('submit',(function(e)
					{
					//alert("You Are Good To Go");
					e.preventDefault();
					$.ajax({
						url:"update_student.php",
						type:"POST",
						data:new FormData(this),
						contentType:false,
						cache:false,
						processData:false,
						beforeSend: function(){	
						$("#errorUseru").fadeOut();
						$("#userButtonu").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Updating...');
	              		},
						success : function(response){						
							if(response=="ok"){									
							swal({
								title:"Success",
								text:"Account Successfully Updated",
								icon:"success",
								button:"OK"
							});
								$("#userButtonu").html('UPDATE');
								document.getElementById("registerUseru").reset();
								$('#studentsTable').DataTable().ajax.reload();
                $('#studentUpdate').modal('hide');
							}				
							else {									
								$("#errorUseru").fadeIn(1000, function(){						
									$("#errorsu").html('&nbsp; '+response+' ');
									$("#userButtonu").html('UPDATE');
								});
							}
						}
					});
          }));
// End Update Students Details

// Fetch Lecturers Details
var dataTable2 = $('#lecturersTable').DataTable({
  "processing": true,
"sAjaxSource":"response_lecturers.php",
"pageLength": 10,
"type":"POST",
"dom": 'lBfrtip',
"buttons": [
'excel',
'csv',
'pdf',
'print'
]
          
});
// End
$('#formAssign').on('submit',function(e){
        e.preventDefault();
      $.ajax({
          url:"assign_subject.php",
          type:"POST",
          data:new FormData(this),
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function()
          {
              $('#btnAssign').html('Assigning....');
          },
          success : function(response)
          {
              if(response=="ok")
              {
                  $("#assignErrors").fadeOut('slow');
                  swal({
                      title:"Success",
                      text:"Subject Successfully Assigned",
                      icon:"success",
                      button:"OK"
                  });
                  $("#btnAssign").html("UPDATE");
                  $('#formAssign').trigger("reset");
                  $('#subjectsTable').DataTable().ajax.reload();
                  $('#assignmentsTable').DataTable().ajax.reload();
                  $("#assignModal").modal("hide");
                  
              }
              else
              {
                $("#assignErrors").fadeIn(1000,function(){
                $("#assignErrors").html(response);
                $("#btnAssign").html("UPDATE");
           });
              }
          }
      });
    });
// End Assign Details
// End


// Fetch Subject Details
var dataTable3 = $('#subjectsTable').DataTable({
  "processing": true,
"sAjaxSource":"response_subjects.php",
"pageLength": 10,
"type":"POST",
"dom": 'lBfrtip',
"buttons": [
'excel',
'csv',
'pdf',
'print'
]
          
        });
// End
//Lecturer Admin Assignments
<?php
if($results['role'] == "admin" || $results['role'] ="lecturer")
{
  ?>
  // Fetch Assignments Details
var dataTable3 = $('#assignmentsTable').DataTable({
  "processing": true,
"sAjaxSource":"response_assignments.php",
"pageLength": 10,
"type":"POST",
"dom": 'lBfrtip',
"buttons": [
'excel',
'csv',
'pdf',
'print'
]
          
        });
// End
  <?php
}
?>
//End
//Students Assignments
<?php
 $user_id = $_SESSION['user_session'];
 $stmt=$DB_con->prepare("SELECT * FROM users WHERE email=:ema");
 $stmt->bindParam(":ema",$user_id);
 $stmt->execute();
 $results=$stmt->fetch(PDO::FETCH_ASSOC);
if($results['role'] == "student")
{
  ?>
  // Fetch Assignments Details
var dataTable8 = $('#studentsassignmentsTable').DataTable({
  "processing": true,
"sAjaxSource":"response_students_subjects.php",
"pageLength": 10,
"type":"POST",
"dom": 'lBfrtip',
"buttons": [
'excel',
'csv',
'pdf',
'print'
]
          
        });
// End
  <?php
}
?>
//End
//  Insert Subject Details
$('#formSubject').on('submit',function(e){
        e.preventDefault();
      $.ajax({
          url:"add_subject.php",
          type:"POST",
          data:new FormData(this),
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function()
          {
              $('#btnCase').html('Registering New Subject......');
          },
          success : function(response)
          {
              if(response=="ok")
              {
                  $("#subjectErrors").fadeOut('slow');
                  swal({
                      title:"Success",
                      text:"New Subject Successfully Registered",
                      icon:"success",
                      button:"OK"
                  });
                  $("#btnSubject").html("ADD");
                  $('#formSubject').trigger("reset");
                  $('#subjectsTable').DataTable().ajax.reload();
              }
              else
              {
                $("#subjectErrors").fadeIn(1000,function(){
                $("#subjectErrors").html(response);
                $("#btnSubject").html("ADD");
    });
              }
          }
      });
    });
// End Insert Subject  Details
//  Update Subject Details
$('#formSubjectu').on('submit',function(e){
        e.preventDefault();
      $.ajax({
          url:"update_subject.php",
          type:"POST",
          data:new FormData(this),
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function()
          {
              $('#btnSubjectu').html('Update Subject......');
          },
          success : function(response)
          {
              if(response=="ok")
              {
                  $("#subjectErrorsu").fadeOut('slow');
                  swal({
                      title:"Success",
                      text:"Subject Successfully Updated",
                      icon:"success",
                      button:"OK"
                  });
                  $("#btnSubjectu").html("UPDATE");
                  $('#formSubjectu').trigger("reset");
                  ('#subjectUpdate').modal('hide');
                  $('#subjectsTable').DataTable().ajax.reload();
              }
              else
              {
                $("#subjectErrorsu").fadeIn(1000,function(){
                $("#subjectErrorsu").html(response);
                $("#btnSubjectu").html("UPDATE");
    });
              }
          }
      });
    });
// End Insert Subject  Details
    $('#btnSearch').click(function(e){
      e.preventDefault();
    // Fetch Student Details
    $('#attendTable').fadeIn('slow');
var subject = $('#attendance_subject').val();
var dataTable9 = $('#attendTable').DataTable({
  "processing": true,
"ajax":{
  'type':'POST',
  'url':'response_search_details.php',
   'data' : {
     subject:subject
   }
},
"pageLength": 10,
"dom": 'lBfrtip',
"buttons": [
'excel',
'csv',
'pdf',
'print'
]
          
        });
    })
// End
//Search Attendance
$('#btnviewSearch').click(function(e){
      e.preventDefault();
    // Fetch Student Details
    $('#attendviewTable').fadeIn('slow');
var subject = $('#attendance_view_subject').val();
var date = $('#attend_view_date').val();
$('#attendviewTable').DataTable().destroy();
var dataTable10 = $('#attendviewTable').DataTable({
  "processing": true,
"ajax":{
  'type':'POST',
  'url':'response_view_attendance.php',
   'data' : {
     subject:subject,date:date
   }
},
'footerCallback':function(row, data, start, end, display)
{
  var response = this.api().ajax.json();
  if(response)
  {
    $('#percentage').html(response['percentage'] + "%");
  }
  
},
"pageLength": 10,
"dom": 'lBfrtip',
"buttons": [
'excel',
'csv',
'pdf',
'print'
]
          
        });
    })
//End

  });
      //Get Inmate Details
      function GetLecturer(id) {
    // Add User ID to the hidden field
    //alert(id);
   
    $.post("fetch_lecturer.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            
          //  alert(gender_value);
            $("#fullnameu").val(user.lecturer_name);
            $("#emailu").val(user.lecturer_email);
            $("#phone_nou").val(user.lecturer_phone);
            $("#staff_idu").val(user.lecturer_staff_id);
            $("#hidden_lecturer_id").val(user.lecturer_id);
         
            
             //alert("YOU ARE GOOD TO GO");
              // Open modal popup
        $("#lecturerUpdate").modal("show");
        } 
    );
   
}
function GetHealth(id) {
    // Add User ID to the hidden field
    //alert(id);
   
    $.post("fetch_health.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assign existing values to the modal popup fields
            var gender_value=user.inmate_gender;
          //  alert(gender_value);
            $("#lecturer_assign_name").val(user.Inmate_name);
            $("#health_issueu").val(user.health_issue);
            $("#health_descriptionu").val(user.health_status);
            $("#hidden_health_id").val(user.health_id);
            $("#hidden_health_inmate_id").val(user.inmate_health_id);
            
           
            
             //alert("YOU ARE GOOD TO GO");
              // Open modal popup
        $("#healthUpdate").modal("show");
        } 
    );
   
}
function GetCase(id) {
    // Add User ID to the hidden field
    //alert(id);
   
    $.post("fetch_case.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assign existing values to the modal popup fields
           // var gender_value=user.inmate_gender;
          //  alert(gender_value);
            $("#inmate_caseu").val(user.Inmate_name);
            $("#case_typeu").val(user.case_type);
            $("#case_descriptionu").val(user.case_desc);
            $("#hidden_case_id").val(user.case_id);
            $("#hidden_case_inmate_id").val(user.inmate_case_id);
            
           
            
             //alert("YOU ARE GOOD TO GO");
              // Open modal popup
        $("#caseUpdate").modal("show");
        } 
    );
   
}
function GetSubject(id) {
    // Add User ID to the hidden field
    //alert(id);
   
    $.post("fetch_subject.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assign existing values to the modal popup fields
           // var gender_value=user.inmate_gender;
          //  alert(gender_value);
            $("#subject_nameu").val(user.subject_name);
            $("#subject_codeu").val(user.subject_code);
            $("#yearu").val(user.subject_year);
            $("#subject_semesteru").val(user.subject_semester);
            $("#courseu").val(user.subject_course);
            $("#hidden_subject_id").val(user.subject_id);
           
            
           
            
             //alert("YOU ARE GOOD TO GO");
              // Open modal popup
        $("#subjectUpdate").modal("show");
        } 
    );
   
}
function GetStudent(id) {
    // Add User ID to the hidden field
    //alert(id);
   
    $.post("fetch_student.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assign existing values to the modal popup fields
           // var gender_value=user.inmate_gender;
          //  alert(gender_value);
            $("#studentUpdate #fullnameu").val(user.student_name);
            $("#studentUpdate #emailu").val(user.student_email);
            $("#reg_nou").val(user.reg_no);
            $("#studentUpdate #phone_nou").val(user.student_phone);
            $("#studentUpdate #yearu").val(user.year);
            $("#studentUpdate #semesteru").val(user.semester);
            $("#studentUpdate #courseu").val(user.course);
            $("#departmentu").val(user.dept);
            $("#hidden_student_id").val(user.student_id);
           
            
           
            
             //alert("YOU ARE GOOD TO GO");
              // Open modal popup
        $("#studentUpdate").modal("show");
        } 
    );
   
}
//Remove Student Details
function RemoveStudent(id)
     {
      //alert(id);
      
      var conf = confirm("Are you sure,do you really want to remove this student");
      if(conf == true)
      {
       $.ajax({
        type:'POST',
        url:'remove_student.php',
        data:{id:id},
        success:function(data){
         if(data=="YES")
         {
          swal({
                    title:"Success",
                    text: "Student Successfully Removed",
                    icon:"success",
                    button:"OK",
                 });
				$('#studentsTable').DataTable().ajax.reload();
        studentCount();
         }
         else
         {
          alert("Error Removing Student Try Again");
         }
        }
       });
       }
      }
      //Remove Subject Details
function RemoveSubject(id)
     {
      //alert(id);
      
      var conf = confirm("Are you sure,do you really want to remove this subject details");
      if(conf == true)
      {
       $.ajax({
        type:'POST',
        url:'remove_subject.php',
        data:{id:id},
        success:function(data){
         if(data=="YES")
         {
          swal({
                    title:"Success",
                    text: "Subject  Successfully Removed",
                    icon:"success",
                    button:"OK",
                 });
				$('#subjectsTable').DataTable().ajax.reload();
        subjectsCount();
         }
         else
         {
          alert("Error Removing Subject  Details Try Again");
         }
        }
       });
       }
      }
      //Remove Lecturer Details
function RemoveLecturer(id)
     {
      //alert(id);
      
      var conf = confirm("Are you sure,do you really want to remove this inmate conviction details");
      if(conf == true)
      {
       $.ajax({
        type:'POST',
        url:'remove_lecturer.php',
        data:{id:id},
        success:function(data){
         if(data=="YES")
         {
          swal({
                    title:"Success",
                    text: "Lecturer Details Successfully Removed",
                    icon:"success",
                    button:"OK",
                 });
				$('#lecturersTable').DataTable().ajax.reload();
        lecturerCount();
         }
         else
         {
          alert("Error Removing Lecturer Try Again");
         }
        }
       });
       }
      }

      
    </script>
    <!-- Modal -->
<div id="lecturerUpdate" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="">
        <div class="row" style="padding:0.5em;border-bottom: 1px solid #e9ecef; border-top-left-radius: 0.3rem;
  border-top-right-radius: 0.3rem;">
          <div class="col-sm-8 col-md-8 col-lg-8">
          <h4 class="modal-title" style="text-align:center;">Update Lecturer Details</h4>
          </div>
          
          <div class="col-sm-2 col-md-2 col-lg-2">

          </div>
          <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>

        </div>
      
      </div>
      <div class="modal-body">
      <form method="POST" id="registerLectureru">
        <input type="hidden" name="hidden_lecturer_id" id="hidden_lecturer_id">
                                       <div style="display: none;" id="errorLectureru" class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Error!</strong> <span id="errorslecu"></span>
                                       </div>
                                      <div class="row">
                                        <div class="form-group col-md-6 col-lg-6 col-sm-6">
                                            <label for="fullname">Full Name</label>
                                            <input class="form-control" type="text" id="fullnameu" name="fullnameu" placeholder="Enter your name" required>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6 col-sm-6">
                                            <label for="emailaddress"> Email address</label>
                                            <input class="form-control" type="email" id="emailu" name="emailu" required placeholder="Enter your email">
                                        </div>
                                     <div class="clearfix">

                                     </div>
                                    
                                      </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-lg-12 col-sm-12">
                                                <label for="emailaddress">Staff ID</label>
                                                <input class="form-control" type="number" id="staff_idu" name="staff_idu" required placeholder="Enter Staff ID">
                                            </div>
                                            <div class="form-group col-md-12 col-lg-12 col-sm-12">
                                                <label for="emailaddress">Phone No</label>
                                                <input class="form-control" type="number" id="phone_nou" name="phone_nou" required placeholder="Enter Staff ID">
                                            </div>
                                        </div>
                                      
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox checkbox-success">
                                                <input type="checkbox" class="custom-control-input" id="checkbox-signup">
                                                <label class="custom-control-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                            </div>
                                        </div> -->
                                        <div class="form-group mb-0 text-center">
                                            <button class="btn btn-gradient btn-block" type="submit" id="lecturerButtonu"> UPDATE </button>
                                        </div>
    
                                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- End Modal -->
    <!--Assign Modal -->
    <div id="assignModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="">
        <div class="row" style="padding:0.5em;border-bottom: 1px solid #e9ecef; border-top-left-radius: 0.3rem;
  border-top-right-radius: 0.3rem;">
          <div class="col-sm-8 col-md-8 col-lg-8">
          <h4 class="modal-title" style="text-align:center;">Assign Subject</h4>
          </div>
          
          <div class="col-sm-2 col-md-2 col-lg-2">

          </div>
          <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>

        </div>
      
      </div>
      <div class="modal-body">
      <form method="POST" id="formAssign">
      <input type="hidden" name="hidden_health_id" id="hidden_health_id">
      <input type="hidden" name="hidden_health_inmate_id" id="hidden_health_inmate_id">
              <div id="assignErrors">

              </div>
          
          <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6">
              <div class="form-group">
                <label class="control-label">Select Lecturer</label>
                <select class="form-control input-lg" id="lecturer_assign_name" name="lecturer_assign_name">
                
                </select>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6">
              <div class="form-group">
                <label class="control-label">Select Subject</label>
                <select class="form-control input-lg" id="subject_assign_name" name="subject_assign_name">
                
                </select>
              </div>
            </div>
            
          </div>
         
         
        
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
              <div class="tile-footer" >
                <button class="btn btn-primary" id="btnAssign" type="submit" style="margin-left:20%;margin-right:50%;">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>ASSIGN</button
                >&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"
                  ><i class="fa fa-fw fa-lg fa-times-circle"></i>RESET</a
                >
              </div>
            </div>
          </div>
           
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- End Modal -->
<!--Update Subject Modal -->
<div id="subjectUpdate" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="">
        <div class="row" style="padding:0.5em;border-bottom: 1px solid #e9ecef; border-top-left-radius: 0.3rem;
  border-top-right-radius: 0.3rem;">
          <div class="col-sm-8 col-md-8 col-lg-8">
          <h4 class="modal-title" style="text-align:center;">Update Subject Details</h4>
          </div>
          
          <div class="col-sm-2 col-md-2 col-lg-2">

          </div>
          <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>

        </div>
      
      </div>
      <div class="modal-body">
      <form method="POST" id="formSubjectu">
      <div id="subjectErrorsu">
         </div>
           <input type="hidden" id="hidden_subject_id" name="hidden_subject_id">
          
          <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6">
              <div class="form-group">
                <label class="control-label">Subject Name</label>
             <input type="text" class="form-control input-lg"  id="subject_nameu" name="subject_nameu">
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6">
              <div class="form-group">
               
                <label class="control-label">Subject Code</label>
             <input type="text" class="form-control input-lg" id="subject_codeu" name="subject_codeu">
              </div>
            </div>
          </div>
          <div class="row">
          <div class="col-md-6 col-lg-6 col-sm-6 p-2">
                <div class="row px-2">
                <label for="gender">Year</label>
                <br>
                <br>
                <br>
                <br>
                <div class="form-group col-md-6 col-lg-6 col-sm-6">
                <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-3">
                <label class="radio-inline" style="color:#000;">
                <input type="radio" id="yearu" name="yearu" value="1st" checked>  1st
                </label>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3">
                <label class="radio-inline" style="color:#000;">
                <input type="radio" id="yearu" value="2nd" name="yearu">  2nd
                </label>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3">
                <label class="radio-inline" style="color:#000;">
                <input type="radio" id="yearu" value="3rd" name="yearu">  3rd
                </label>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3">
                <label class="radio-inline" style="color:#000;">
                <input type="radio" id="yearu" value="4th" name="yearu">  4th
                </label>
                </div>
                </div>
                </div>
                </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6 p-2">
                <div class="row">
                <label for="gender">Semester</label>

                <br>
                <br>
                <br>
                <br>
                <div class="form-group col-md-6 col-lg-6 col-sm-6">
                <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-3">
                <label class="radio-inline" style="color:#000;">
                <input type="radio" id="subject_semesteru" name="subject_semesteru" value="1st" checked>  1st
                </label>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3">
                <label class="radio-inline" style="color:#000;">
                <input type="radio" value="2nd" id="subject_semesteru" name="subject_semesteru">  2nd
                </label>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3">
                <label class="radio-inline" style="color:#000;">
                <input type="radio" value="3rd" id="subject_semesteru" name="subject_semesteru">  3nd
                </label>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3">
                <label class="radio-inline" style="color:#000;">
                <input type="radio" value="4th" id="subject_semesteru" name="subject_semesteru">  4th
                </label>
                </div>
                </div>
                </div>
                </div>
                </div>
       
          </div>
         <div class="row">
         <div class="form-group col-sm-12 col-md-12 col-lg-12"  style="padding-left:1%">
                                                <label for="course">Course</label>
                                                <select class="form-control" name="subject_courseu" id="subject_courseu">
                                                <option value="course1">Course 1</option>
                                                <option value="course2">Course 2</option>
                                                <option value="course3">Course 3</option>
                                                <option value="course4">Course 4</option>
                                                </select>
                                            </div>
                                            
         </div>
        
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
              <div class="tile-footer" >
                <button class="btn btn-primary" id="btnSubjectu" type="submit" style="margin-left:20%;margin-right:50%;">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>UPDATE SUBJECT</button
                >&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"
                  ><i class="fa fa-fw fa-lg fa-times-circle"></i>RESET</a
                >
              </div>
            </div>
          </div>
           
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- End Modal -->
<!--Update Inmate Case Modal -->
<div id="caseUpdate" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="">
        <div class="row" style="padding:0.5em;border-bottom: 1px solid #e9ecef; border-top-left-radius: 0.3rem;
  border-top-right-radius: 0.3rem;">
          <div class="col-sm-8 col-md-8 col-lg-8">
          <h4 class="modal-title" style="text-align:center;">Update Inmate Case Details</h4>
          </div>
          
          <div class="col-sm-2 col-md-2 col-lg-2">

          </div>
          <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>

        </div>
      
      </div>
      <div class="modal-body">
      <form method="POST" id="formCaseu">
      <input type="hidden" name="hidden_case_id" id="hidden_case_id">
      <input type="hidden" name="hidden_case_inmate_id" id="hidden_case_inmate_id">
              <div id="caseErrorsu">

              </div>
          
              <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6">
              <div class="form-group">
                <label class="control-label">Select Inmate</label>
                <select class="form-control input-lg" id="inmate_case" name="inmate_caseu">
                <option disabled>--------</option>
                    
                  
                </select>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6">
              <div class="form-group">
                <label class="control-label">Case Type</label>
                <select class="form-control input-lg" id="case_typeu" name="case_typeu">
                
                    <option value="ONE">ONE</option>
                    <option value="TWO">TWO</option>
                  
                  
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-sm-12 col-lg-12">
              <div class="form-group">
                <label class="control-label">Case Description</label>
                <textarea
                  class="form-control"
                  rows="4" name="case_descriptionu"
                  id="case_descriptionu"
                  placeholder="Enter Case Description"
                ></textarea>
              </div>
            </div>
       
          </div>
         
        
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
              <div class="tile-footer" >
                <button class="btn btn-primary" id="btnCaseu" type="submit" style="margin-left:20%;margin-right:50%;">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>UPDATE</button
                >&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"
                  ><i class="fa fa-fw fa-lg fa-times-circle"></i>RESET</a
                >
              </div>
            </div>
          </div>
           
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- End Modal -->
<!--Update Student Modal -->
<div id="studentUpdate" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="">
        <div class="row" style="padding:0.5em;border-bottom: 1px solid #e9ecef; border-top-left-radius: 0.3rem;
  border-top-right-radius: 0.3rem;">
          <div class="col-sm-8 col-md-8 col-lg-8">
          <h4 class="modal-title" style="text-align:center;">Update Student Details</h4>
          </div>
          
          <div class="col-sm-2 col-md-2 col-lg-2">

          </div>
          <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>

        </div>
      
      </div>
      <div class="modal-body">
      <form method="POST" id="registerUseru">
      <input type="hidden" id="hidden_student_id" name="hidden_student_id"> 
                                       <div style="display: none;" id="errorUseru" class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Error!</strong> <span id="errorsu"></span>
                                       </div>
                                      <div class="row">
                                        <div class="form-group col-md-4 col-lg-4 col-sm-4">
                                            <label for="fullname">Full Name</label>
                                            <input class="form-control" type="text" id="fullnameu" name="fullnameu" placeholder="Enter your name" required>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4 col-sm-4">
                                            <label for="emailaddress"> Email address</label>
                                            <input class="form-control" type="email" id="emailu" name="emailu" required placeholder="Enter your email">
                                        </div>
                                     <div class="clearfix">

                                     </div>
                                     <div class="form-group col-md-4 col-lg-4 col-sm-4">
                                        <label for="emailaddress">Reg Number</label>
                                        <input class="form-control" type="number" id="reg_nou" name="reg_nou" required placeholder="Enter Reg No">
                                    </div>
                                      </div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-sm-6 p-2">
                                                <div class="row px-2">
                                                    <label for="gender">Year</label>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <div class="form-group col-md-6 col-lg-6 col-sm-6">
                                                    <div class="row">
                                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                                    <label class="radio-inline" style="color:#000;">
                                                     <input type="radio" name="yearu" value="1st" checked>  1st
                                                     </label>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                                    <label class="radio-inline" style="color:#000;">
                                                     <input type="radio" value="2nd" name="yearu">  2nd
                                                     </label>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                                        <label class="radio-inline" style="color:#000;">
                                                         <input type="radio" value="3rd" name="yearu">  3rd
                                                         </label>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-sm-3">
                                                            <label class="radio-inline" style="color:#000;">
                                                             <input type="radio" value="4th" name="yearu">  4th
                                                             </label>
                                                            </div>
                                                    </div>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-sm-6 p-2">
                                                <div class="row">
                                                    <label for="gender">Semester</label>

                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <div class="form-group col-md-6 col-lg-6 col-sm-6">
                                                    <div class="row">
                                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                                    <label class="radio-inline" style="color:#000;">
                                                     <input type="radio" name="semesteru" id="semesteru" value="1st" checked>  1st
                                                     </label>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                                    <label class="radio-inline" style="color:#000;">
                                                     <input type="radio" value="2nd" id="semesteru" name="semesteru">  2nd
                                                     </label>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                                        <label class="radio-inline" style="color:#000;">
                                                         <input type="radio" value="3rd" id="semesteru" name="semesteru">  3nd
                                                         </label>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-sm-3">
                                                            <label class="radio-inline" style="color:#000;">
                                                             <input type="radio" value="4th" id="semesteru"  name="semesteru">  4th
                                                             </label>
                                                            </div>
                                                    </div>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row p-2 ">
                                            <div class="form-group col-sm-4 col-md-4 col-lg-4" style="padding-left:1%">
                                                <label for="course">Phone Number</label>
                                               <input type="number" name="phone_nou" id="phone_nou" class="form-control" required placeholder="Enter Phone No">
                                            </div>
                                            <div class="form-group col-sm-4 col-md-4 col-lg-4" style="padding-left:1%">
                                                <label for="course">Course</label>
                                                <select name="courseu" id="courseu" class="form-control" id="courseu">
                                                <option value="course1">Course 1</option>
                                                <option value="course2">Course 2</option>
                                                <option value="course3">Course 3</option>
                                                <option value="course4">Course 4</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                                <label for="department">Department</label>
                                                <select name="departmentu" class="form-control" id="departmentu">
                                                <option value="dept1">Department 1</option>
                                                <option value="dept2">Department 2</option>
                                                <option value="dept3">Department 3</option>
                                                <option value="dept4">Department 4</option>
                                                </select>
                                            </div>

                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox checkbox-success">
                                                <input type="checkbox" class="custom-control-input" id="checkbox-signup">
                                                <label class="custom-control-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                            </div>
                                        </div> -->
                                        <div class="form-group mb-0 text-center">
                                            <button class="btn btn-primary btn-block" type="submit" id="userButtonu"> UPDATE </button>
                                        </div>
    
                                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- End Modal -->

  </body>
</html>
