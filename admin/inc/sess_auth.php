<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
    $link = "https"; 
else
    $link = "http"; 
$link .= "://"; 
$link .= $_SERVER['HTTP_HOST']; 
$link .= $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['userdata']) && !strpos($link, 'login.php')){
	redirect('admin/login.php');
}
if(isset($_SESSION['userdata']) && strpos($link, 'login.php') && $_SESSION['userdata']['login_type'] == 1){
	redirect('admin/index.php');
}
$module = array('','admin','faculty','student');
if(isset($_SESSION['userdata']) && (strpos($link, 'index.php') || strpos($link, 'admin/')) && $_SESSION['userdata']['login_type'] !=  1){
	unset($_SESSION['userdata']);
	echo "<script>alert('Access Denied! Please sign in with an administrator account.');location.replace('".base_url."admin/login.php');</script>";
    exit;
}
