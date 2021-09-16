<?php
	
	$link = mysqli_connect("localhost","root","");
	if(!$link){
		$_SESSION['error']= "Connectivity Error :".mysqli_error($link);
		echo $_SESSION['error'];
	}
	
	mysqli_select_db($link,"align") or die(mysqli_error($link));
    
    mysqli_set_charset($link, 'utf8');
    
	date_default_timezone_set('Asia/Kolkata');
    
	mysqli_query($link,"SET time_zone='+5:30';");
    
    setlocale(LC_MONETARY,"en_IN");
    
    mysqli_query($link,"SET SESSION sql_mode='ALLOW_INVALID_DATES' ");
	
	$session_username       	='align_username';
    $session_userid         	='align_userid';   
	$session_usergroup      	='align_usergroup';
    $session_usergroupname  	='align_usergroupname';
    $session_table          	='align_table';
    $session_message        	='align_message';
	$session_update				='align_update';
	$session_delete				='align_delete';
	$session_access_log_id  	='align_access_log_id';	

?>
