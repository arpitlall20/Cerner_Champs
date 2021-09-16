<?php
    session_start();              
    require_once "connection.php"; 
    require_once "encrypt_decrypt.php"; 
    $userip = getenv('HTTP_CLIENT_IP')?:
    getenv('HTTP_X_FORWARDED_FOR')?:
    getenv('HTTP_X_FORWARDED')?:
    getenv('HTTP_FORWARDED_FOR')?:
    getenv('HTTP_FORWARDED')?:
    getenv('REMOTE_ADDR');
       
    if(isset($_REQUEST['submit']))
    {  
        $uname  = $_POST['txtUserName'];
        $pwd    = $_POST['txtPassword'];
        
        if($uname!="" && $pwd!="") 
        {        
            //$pwd = encryptIt($pwd);
            $sql="select u.*,s.description from t_users u left join t_settings s on s.settingid=u.usertype 
                  where u.loginid='$uname' AND u.password='$pwd' and u.status='Active'";  
            $result=mysqli_query($link,$sql);
            
            if(mysqli_num_rows($result)>0) 
            {	
                $row=mysqli_fetch_array($result);
                
                $_SESSION['align_username']       =$row['name'];
                $_SESSION['align_userid']         =$row['userid'];
                $_SESSION['align_usergroup']      =$row['usertype'];
                $_SESSION['align_usergroupname']  =$row['description'];	
                $_SESSION['align_table']          ='t_users';
                
                    header("Location: ../modules/dashboard/?node=1&currentitem=0"); 
                    echo "<meta http-equiv='refresh' content='0; URL=../modules/dashboard/?node=1&currentitem=0' />"; 
                
                
                $insertQry = "INSERT `t_access_log`
                SET 
                    `login_id`        = '".$_SESSION['align_userid']."',
                    `user_name`       =	'".$_SESSION['align_username']."',
                    `login_timestamp` = CURRENT_TIMESTAMP,
                    `user_ip_address` = '".$userip."'";
                $result1=mysqli_query($link,$insertQry);	
                $unitid=mysqli_insert_id($link);
                $_SESSION['access_log_id']=	$unitid;			
                $_SESSION['align_message']="user details logged successfully";	
                
                if(!$result1)
                {
                      $_SESSION['align_message']="Couldn't Add user details. ".mysqli_error($link);
                }			
            } 
            else
            {
                header("Location: ../index.php"); 
                echo "<meta http-equiv='refresh' content='0; URL=index.php?node=1&currentitem=0' />"; 
                $_SESSION['error'] = 'Invalid username or password';
            }
        }
        else
        {
            header("Location: ../index.php"); 
            echo "<meta http-equiv='refresh' content='0; URL=index.php?node=1&currentitem=0' />"; 
            $_SESSION['error'] = 'Fields cannot be empty';
        }
    }
    else {
        $_SESSION['error'] = 'Session Expired';
        header("Location: ../index.php");
        echo "<meta http-equiv='refresh' content='0; URL=../index.php' />";
    }

?>