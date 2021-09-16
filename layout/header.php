<?php
	include_once "../../config/connection.php";
	session_start();
    
	if(!isset($_SESSION['align_userid'])){
		header("Location:../../logout.php");
		echo "<meta http-equiv='refresh' content='0; URL=../../logout.php' />";
	}
    else{
		@$menu=$_REQUEST['node'];
		@$submenu=$_REQUEST['currentitem'];
		@$submenu1=$_REQUEST['tm'];
		@$usergroup=$_SESSION['align_usergroup'];
		$menuid = $submenu>0? $submenu:$menu;
		$menuid = $submenu1>0? $submenu1:$menuid;
        
		$qry="SELECT accessid FROM `t_privileges` WHERE `usergroup`='".$usergroup."' and menuid = '".$menuid."' limit 0,1" ;
		$res=mysqli_query($link,$qry) or die(mysqli_error($link));
		$view=$create=$update=$delete=true;
		
        if(mysqli_num_rows($res)>0){
			$row=mysqli_fetch_array($res);
			$userrights=explode(',',$row['accessid']);
			$view=true;
			$create=in_array(5,$userrights)? true:false;
			$update=in_array(7,$userrights)? true:false;
			$delete=in_array(8,$userrights)? true:false;
			$_SESSION['align_update']=$update;
			$_SESSION['align_delete']=$delete;
		}
	}
    $qry = "SELECT TRIM(LEADING ',' FROM projects_assigned) as assigned_projects from t_users where userid = ".$_SESSION['align_userid']." ";
    $result=mysqli_query($link,$qry) or die(mysqli_error($link));
    $setvar = array();
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)) {
            $setvar = str_replace("10","",$row['assigned_projects']);
			$setvar = str_replace("11","",$setvar);
			$setvar = str_replace(",,",",",$setvar);
			$setvar = str_replace(",,",",",$setvar);
			$setvar = rtrim($setvar, ',');
        }
    }
   
	
?>
<!DOCTYPE html>
<html>		
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/favicon.png"> 
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../assets/bootstrap/fonts/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="../../assets/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="../../assets/plugins/datatables/dataTables.bootstrap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../assets/css/AdminLTE.min.css">
        <!-- AdminLTE Skins -->
        <link rel="stylesheet" href="../../assets/css/skins/skin-black.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="../../assets/plugins/iCheck/minimal/blue.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="../../assets/plugins/datepicker/datepicker3.css">
        <!-- DateTime Picker-->
        <link rel="stylesheet" href="../../assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
        <!-- Multiselect -->
        <link rel="stylesheet" href="../../assets/plugins/chosen-multiselect/chosen.css">
        <!-- Custom css -->
        <link rel="stylesheet" href="../../assets/css/custom.css">
        <link rel="stylesheet" href="../../assets/plugins/export-button/css/buttons.dataTables.min.css">
        <script type="text/javascript" src="../../assets/plugins/highcharts/highcharts.js"></script>
        <script type="text/javascript" src="../../assets/plugins/highcharts/exporting.js"></script>  
		<script type="text/javascript" src="../../assets/plugins/highcharts/drilldown.js"></script>   
       
    </head>
    <body class="hold-transition skin-black fixed sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="../../modules/dashboard/?node=1&currentitem=0" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><img src="../../assets/img/logo_small.png" height="40" /></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><img src="../../assets/img/logo_align.jpg" width="150"/></span>
                </a>
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                            <li class="dropdown messages-menu">
                               
                                
                            </li>
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="../../assets/img/avatar.png" class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs"><?php echo $_SESSION['align_username']; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="../../assets/img/avatar.png" class="img-circle" alt="User Image">
                                        <p>
                                            <?php echo $_SESSION['align_username']; ?>
                                            <small><?php echo $_SESSION['align_usergroupname']; ?> </small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="../../modules/password/?node=0&currentitem=0" class="btn btn-default btn-flat">Change Password</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="../../logout.php" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
