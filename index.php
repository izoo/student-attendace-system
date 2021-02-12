<?php

//echo md5($password);
require_once('db_config.php');
$user->redirect('student/index.html');
if($user->is_loggedin()!="")
{
	 $user_id = $_SESSION['user_session'];
    $stmt=$DB_con->prepare("SELECT * FROM users WHERE emails=:ema");
    $stmt->bindParam(":ema",$user_id);
    $stmt->execute();
    $results=$stmt->fetch(PDO::FETCH_ASSOC);
	
    if($results['role'] =="admin")
    {
        $user->redirect('index.php');
    }
    
    
}

?>
<!DOCTYPE HTML>
<HTML>
    <head>
    <meta name="msapplication-tap-highlight" content="no">
<title>ATTENDANCE | MANAGEMENT</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/w3school.css" type="text/css">
<link rel="stylesheet" href="css/w3-colors-windows.css" type="text/css">

<link rel="stylesheet" href="css/w3-colors-metro.css" type="text/css">
<link rel="stylesheet" href="css/w3-colors-flat.css" type="text/css">

<link rel="stylesheet" type="text/css" href="fontawesome/css/font-awesome.min.css"/>
   

  <!-- Compiled and minified JavaScript -->
   <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
      
      <script type="text/javascript" src="js/validator.js"></script>
      <script src="js/modernizr.js"></script>
         <!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<![endif]-->
         <style type="text/css">
            body {
 
  color: fff;
  font-family: 'Open Sans';
}
ul li
{
    list-style: none;
}

.flat-design-form{
  background: #f58020;
 
 
  height: auto;
  position: relative;
  font-family: 'Open Sans';
  -webkit-box-shadow: 1px 1px 2px 0px rgba(50, 50, 50, 0.75);
-moz-box-shadow:    1px 1px 2px 0px rgba(50, 50, 50, 0.75);
box-shadow:         1px 1px 2px 0px rgba(50, 50, 50, 0.75);

}
#login {
    padding-bottom: 20px;
}

#register {
    background: #0DA1FF;
    padding-bottom: 20px;
}

#login-tab {
    background: #f58020;
}

#register-tab {
    background: #0DA1FF;
}

span#login_icon {
    width: 16px;
    height: 16px;
    left: 8px;
    position: absolute;
    background: url(img/sign-in.png)no-repeat;
    display: block;
}

span#signup_icon {
    width: 16px;
    height: 16px;
    left: 110px;
    position: absolute;
    background: url(img/boy.png)no-repeat;
    display: block;
}

.tabs {
  height: 40px;
  margin: 0;
  padding: 0;
  list-style-type: none;
  width: 100%;
  position: relative;
  display: block;
  margin-bottom: 6px;

}
.tabs li {
  display: block;
  float: left;
  margin: 0;
  padding: 0;
  list-style: none;
}
.tabs a {

  display: block;
  float: left;
  text-decoration: none;
  color: white;
  font-size: 16px;
  padding: 15px 30px 15px 30px;
   text-align: center;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);

}
.form-display {
  padding: 0 20px;
  position: relative;
}

.form-display h1 {
  font-size: 30px;
  padding: 10px 0 20px 0;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
}

form {
  padding-right: 20px !important;
}

form input[type=text],
form input[type=password],
form input[type=email],
form input[type=number]{
  width: 100%;
  outline: none;
  height: 40px;
  margin-bottom: 10px;
  padding-left: 15px;
  background: #fff;
  border: none;
  color: #545454;

   font-family: 'Open Sans';
  font-size: 13px;
}

.show {
  display: block;
}
.hide {
  display: none;
}
.button-login{
    display: block;
    background: #0DA1FF;
    padding: 10px 30px;
	
    text-align: center;
    border-radius: 5px;
	font-size:24px;
  font-family:cursive;
	color: white;
  text-align: center;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
  border: 0;
  width: 100%;  
  border-bottom: 2px solid #1B78B2;
  cursor: pointer;
  -webkit-box-shadow: inset 0 -2px #1B78B2;
  box-shadow: inset 0 -2px #1B78B2;

  	-webkit-transition: all 0.6s ease;
	  -moz-transition: all 0.6s ease;
	  transition: all 0.6s ease;
}

.button-login:hover {
  background: #1B78B2;

}

.button-register{
    display: block;
    background: #f58020;
    padding: 10px 30px;
	
    text-align: center;
    border-radius: 5px;
	font-size:24px;
  font-family:cursive;
	color: white;
  text-align: center;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
  border: 0;
  width: 100%;
  font-size:24px;
  font-family:cursive;
  border-bottom: 2px solid #c36518;
  cursor: pointer;
  -webkit-box-shadow: inset 0 -2px #c36518;
  box-shadow: inset 0 -2px #c36518;

  	-webkit-transition: all 0.6s ease;
	  -moz-transition: all 0.6s ease;
	  transition: all 0.6s ease;
}

.button-register:hover {
  background: #fb7100;

}

.button-register:active {
  background: #136899;
}
::-webkit-input-placeholder {
    font-size: 13px;
    font-family: 'Open Sans';
    color: #545454;
}

:-moz-placeholder {
/* Firefox 18- */
    font-size: 13px;
    font-family: 'Open Sans';
    color: #545454;
}

::-moz-placeholder {
/* Firefox 19+ */
    font-size: 13px;
    font-family: 'Open Sans';
    color: #545454;
}

:-ms-input-placeholder {
    font-size: 13px;
    font-family: 'Open Sans';
    color: #545454;
}
.item {
    position: relative;
}

.item .alert {
    float: left;
    margin: 0 0 0 20px;
    padding: 3px 10px;
    color: #FFF;
    border-radius: 3px 4px 4px 3px;
    background-color: #ef3030;
    max-width: 170px;
    white-space: pre;
    position: absolute;
    left: -15px;
    opacity: 0;
    z-index: 1;
    transition: .15s ease-out;
}

.item .alert::after {
    content: '';
    display: block;
    height: 0;
    width: 0;
    border-color: transparent #ef3030 transparent transparent;
    border-style: solid;
    border-width: 11px 7px;
    position: absolute;
    top: 5px;
    left: -10px;
}

.item.bad .alert {
    left: 0;
    opacity: 1;
    top: 5px;
    left: 343px;
    font-size: 12px;
    padding: 10px;
}

         </style>
         <script type="text/javascript">
            $(document).ready(function()
                              {
                                 var SHOW_CLASS = 'show',
        HIDE_CLASS = 'hide',
        ACTIVE_CLASS = 'active';
    $('.tabs').on('click', 'li a', function(e) {
        e.preventDefault();
        var $tab = $(this),
            href = $tab.attr('href');
        $('.active').removeClass(ACTIVE_CLASS);
        $tab.addClass(ACTIVE_CLASS);
        $('.show').removeClass(SHOW_CLASS).addClass(HIDE_CLASS).hide();
        $(href).removeClass(HIDE_CLASS).addClass(SHOW_CLASS).hide().fadeIn(620);
    });
     
     
                              $("#loginForm").on('submit',(function(e)
																{
																	e.preventDefault();
																	$.ajax({
																		url:"logged.php",
																		type:"POST",
																		data:new FormData(this),
																		contentType:false,
																		cache:false,
																		processData:false,
																		success:function(data)
																		{
																			//$("#return-data").html(data);
																			if (data=="OK") {
																				 $("#success").html('<img src="images/ajax-loader.gif" /> &nbsp; Cool!!! Credentials Right....System Logging You in.');
				                                 	setTimeout(' window.location.href = "choose_dashboard.php"; ',3000);
                                                }
                                                                                //code
																		
																			else
																			{
																				$("#error-data").html(data);
																			}
																		},
																		error:function()
																		{
																			
																		}
																	});
																	}));
                              });
   

         </script>
    </head>
    <body style=" background: url(img/contrast_linen_2X.png);">
        <section>
            <div class="row">
                <div class="col-sm-2 col-md-2 col-lg-2"></div>
                <div class="col-md-8 col-sm-8 col-lg-8 w3-padding-right w3-padding-left w3-padding-16">
                   <div class="w3-win-phone-magenta w3-padding-8 w3-padding-right w3-padding-left">
                    <p class="w3-text-white w3-xlarge" style="font-family:cursive;letter-spacing: 0.2em;text-align: center;">STUDENT ATTENDANCE MANAGEMENT SYSTEM</p>
                   </div>
                    <div class="container">
        <div class="flat-design-form">
            
             <div class="form-display show" id="login">
        <h1>Login Here</h1>
 <div id="error-data"></div>
        <form id="loginForm" method="post" novalidate="">
            <fieldset>
               
               
                <ul>
                    <li>
                        <div class="item">
													<label>Username</label>
                            <input data-validate-length-range="6" name="user"
                            placeholder="Email" class="w3-text-black" required="required" type=
                            "text">
														
                        </div>
                    </li>
<br>
<br>
                    <li>
                        <div class="item">
													<label>Password</label>
                            <input data-validate-length-range="6" name=
                            "password" class="w3-text-black" placeholder="Password" required=
                            'required' type="password">
														
                        </div>
                    </li>
<br>
 <div id="success" class="w3-padding-16 " style="width: 100%;padding-left:20%;"></div>
 <br>
                    <li><input class="button-login" type="submit" value=
                    "Login"></li>
                </ul>
            </fieldset>
        </form>
    </div>
             
    </div>
                </div>
              <div class="col-sm-2 col-md-2 col-lg-2"></div>
            </div>
								
									<div class="copy">
		        <p>© 2021 STUDENT ATTENDANCE MANAGEMENT SYSTEM . All Rights Reserved | Designed and
										Developed by  <a href="#/">
										Name </p>
		    </div>
        </section>
    </body>
</HTML>