<?php
session_start();
require_once "config/connection.php"; 
$logid =$_SESSION['access_log_id'];
$_SESSION[$session_message]=$logid;

$updateQry="UPDATE `t_access_log`
			SET 
			`logout_timestamp` = CURRENT_TIMESTAMP,
			`session_duration` = CONCAT(
			MOD(HOUR(TIMEDIFF(login_timestamp, CURRENT_TIMESTAMP)), 24), ':',
			MINUTE(TIMEDIFF(login_timestamp, CURRENT_TIMESTAMP)), ':',
			SECOND(TIMEDIFF(login_timestamp, CURRENT_TIMESTAMP)))
			 WHERE access_log_id='$logid'";
$result=mysqli_query($link,$updateQry);

unset($_SESSION[$session_username]);     
unset($_SESSION[$session_userid]);      
unset($_SESSION[$session_usergroup]);    
unset($_SESSION[$session_usergroupname]);
unset($_SESSION[$session_table]);        
unset($_SESSION[$session_message]);      
unset($_SESSION[$session_update]);			
unset($_SESSION[$session_delete]);			
unset($_SESSION[$session_access_log_id]);
session_destroy();
header("location:index.php");
echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php\" />";
?>
