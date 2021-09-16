<?php
session_start();
require_once "../../config/connection.php";
require "../../config/encrypt_decrypt.php";

$update=$_SESSION['realpm_update'];
@$mode=$_REQUEST['mode'];
extract($_POST);
@$unitnote           =htmlentities($unitnote,ENT_QUOTES);
$createdby =$modifyby=$_SESSION['realpm_userid'];
$logid               =$_SESSION['access_log_id'];		
@$unitkeydate         =date_format(date_create($unitkeydate),"Y-m-d");
@$unitservicestartdate=date_format(date_create($unitservicestartdate),"Y-m-d");

if($mode=="create") {
    if($unitkeydate=='') $unitkeydate='0000-00-00';
    if($unitservicestartdate=='') $unitservicestartdate='0000-00-00';
    $insertQry="INSERT `t_units`
                SET 
                  `unit_number`           = '$unitnumber',
                  `unit_code`             = '$unitcode',
                  `unit_projectid`        = '$unitproject',
                  `unit_type`             = '$unittype',
                  `unit_block`            = '$unitblock',
                  `unit_size`             = '$unitsize',
                  `unit_billablearea`     = '$unitbillablearea',
                  `unit_direction`        = '$unitdirection',
                  `unit_keyhandoverdate`  = '$unitkeydate',
                  `unit_servicestartdate` = '$unitservicestartdate',
                  `unit_ebno`             = '$unitebno',
                  `unit_taxno`            = '$unittaxno',
                  `unit_floorno`          = '$unitfloorno',
                  `unit_totalnooffloors`  = '$unittotalfloors',
                  `unit_totalnooftoilets` = '$unittotaltoilets',
                  `unit_parking`          = '$unitparking',
                  `unit_noofparkings`     = '$unittotalparkings',
                  `unit_parkingtype`      = '$unitparkingtype',
                  `unit_note`             = '$unitnote',
                  `unit_configuration`    = '$unitconfiguration',
				  `unit_classification`    = '$unit_classification',				  
                  `createdby`             = '$createdby',
                  `status`                = '$status',
                  `access_log_id`         = '$logid'";
    $result=mysqli_query($link,$insertQry);	
    $unitid=mysqli_insert_id($link);
    
    $_SESSION['realpm_message']="Unit Detail Added Successfully";
    if(!$result){
          $_SESSION['realpm_message']="Couldn't Add Unit Detail. ".mysqli_error($link);
    }
   
}
elseif($mode=="update") {
    
    if($unitkeydate=='') $unitkeydate='0000-00-00';
    if($unitservicestartdate=='') $unitservicestartdate='0000-00-00';
    
    $updateQry="UPDATE `t_units`
                SET 
               `unit_number` = '$unitnumber',
               `unit_code` = '$unitcode',
               `unit_projectid` = '$unitproject',
               `unit_type` = '$unittype',
               `unit_block` = '$unitblock',
               `unit_size` = '$unitsize',
               `unit_billablearea` = '$unitbillablearea',
               `unit_direction` = '$unitdirection',
               `unit_keyhandoverdate` = '$unitkeydate',
               `unit_servicestartdate` = '$unitservicestartdate',
               `unit_ebno` = '$unitebno',
               `unit_taxno` = '$unittaxno',
               `unit_floorno` = '$unitfloorno',
               `unit_totalnooffloors` = '$unittotalfloors',
               `unit_totalnooftoilets` = '$unittotaltoilets',
               `unit_parking` = '$unitparking',
               `unit_noofparkings` = '$unittotalparkings',
               `unit_parkingtype` = '$unitparkingtype',
               `unit_note` = '$unitnote',
               `unit_configuration` = '$unitconfiguration',
			   `unit_classification`    = '$unit_classification',
               `mdate` = CURRENT_TIMESTAMP,
               `modifyby` = '$modifyby',
               `status` = '$status',
               `access_log_id` = '$logid'
                WHERE unit_id='$unitid'";
        $result=mysqli_query($link,$updateQry);

        $_SESSION['realpm_message']="Unit Detail Updated Successfully";
        if(!$result){
        $_SESSION['realpm_message']="Couldn't Update Unit Detail. ".mysqli_error($link);
        }
}	
elseif($mode=="delete") {
    $deleteQry="update t_units set `status`='Inactive' WHERE unit_id=$unitid";
    $result=mysqli_query($link,$deleteQry);
    $_SESSION['realpm_message']="Unit Detail Deleted Successfully";
    if(!$result){
        $_SESSION['realpm_message']="Couldn't Delete Unit Detail. ".mysqli_error($link);
    }
}
elseif($mode=='upload'){
    
    $filename='unit_document';
    $action=$_REQUEST['action'];
    $id=$_REQUEST['id'];
    @$filedesc=addslashes($_REQUEST['filedesc']);
    $path = "../../assets/uploads";
    $message="-";
    $error="";
    
    if($action=='add'){
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        if(isset($_FILES["file"])){ 
            $target_dir = $path."/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            $uploadOk = 1;
            $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
                    
            $i=0;
            $target_file=$target_dir . $filename.'.'.$fileType;
            // Rename if file already exists
            while (file_exists($target_file)) {
                $target_file=(string)$target_dir . $filename."_".$i.'.'.$fileType;
                $i++;
            }
            if($i>0){
                $filename.=(string)"_".--$i;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $error.="Sorry, file was not uploaded.";
            } 
            else {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    sleep(1);
                    $message="The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
                    mysqli_query($link,"INSERT `t_uploads`
                    SET 
                      `upload_module` = 'units',
                      `upload_fk` = '$id',
                      `upload_filename` = '".$filename.'.'.$fileType."',
                      `upload_filetype` = '$fileType',
                      `upload_description` = '$filedesc',
                      `createdby` = '$createdby',
                      `access_log_id` = '$logid';");
                } 
                else {
                    $error="Sorry, there was an error uploading your file.".mysqli_error($link);
                }
            } 
        }
    }
    elseif($action=='delete'){
        $filename=basename($_REQUEST['filename']);
        if(unlink($path."/".$filename)) {
            mysqli_query($link,"DELETE FROM t_uploads WHERE `upload_id` = '$id'");
        }
    }
    echo $error; ?>
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>Description</th>
                <th>Document</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>        
        <tbody>     
              <?php
              $qry="SELECT * FROM t_uploads WHERE upload_fk='$id' AND upload_module='units'";
              $result=mysqli_query($link,$qry) or die(mysqli_error($link));
              if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                    ?> 
                    <tr class="record">
                      <td><?php echo $row['upload_description']; ?></td>
                      <td><a class="btn btn-app1" href="../../assets/uploads/<?php echo $row['upload_filename']; ?>" target="_blank"><i class="fa fa-print"></i></a></td>
                      <td><?php echo $row['cdate']; ?></td>
                      <td align="left"><?php if($update) { ?>
                            <a href="javascript:delete_file('<?php echo $row['upload_id']; ?>','<?php echo basename($row['upload_filename']); ?>'); "><i class="fa fa-trash-o" style="font-size:120%"></i></a>
                            <?php } ?></td>
                    </tr>
                <?php } ?>
                <?php } else { ?>
                <tr><td colspan="4">No file(s) found</td></tr>
                <?php } ?>
        </tbody>
    </table>
<?php
    }
else {
    $_SESSION['realpm_message'] = 'Session Expired';
}	         
?> 