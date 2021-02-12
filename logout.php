<?php
require_once 'db_config.php';

if($_SESSION['user_session']!="")
{
	$user->redirect('admin/index.php');
}
if(isset($_GET['logout']) && $_GET['logout']=="true")
{
	$user->logout();
	$user->redirect('index.php');
}
if(!isset($_SESSION['user_session']))
{
	$user->redirect('index.php');
}
?>
