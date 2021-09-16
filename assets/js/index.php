<?php 
	$title = "Ledger"; 
	require "../../layout/header.php";
	require "../../layout/sidebar-left.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<?php 
		$qry1 = "SELECT TRIM(LEADING ',' FROM projects_assigned) as assigned_projects from t_users where userid = ".$_SESSION['realpm_userid']."";
		$result1=mysqli_query($link,$qry1) or die(mysqli_error($link));
		$setvar = array();
		if(mysqli_num_rows($result1)>0){
			while($row1=mysqli_fetch_array($result1)) {
				$setvar = $row1['assigned_projects'];
			}
		}
	?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ledger
    <small><?php if(isset($_SESSION['realpm_message'])) { echo $_SESSION['realpm_message'];  unset($_SESSION['realpm_message']);} ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><?php echo $title; ?></li>
  </ol>
</section>
<?php if($view) { ?>
<!-- Main content -->
<section class="content">
<!-- FORM DISPLAY STARTS -->
<div class="row" id="formHolder" style="display:none;"> 
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12"> 
		<div class="box box-warning1 ">
			<div class="box-header with-border">
				<h5 class="box-title"></h5>
				<div class="box-tools col-md-12 col-xs-12 col-lg-12 col-sm-12 text-right">
					<?php if($update) { ?>
					<a class="btn btn-app1" id="savecontact" onClick="savecontact();">
						<i class="fa fa-save"></i> Save
					</a>
					<a class="btn btn-app1" id="updatecontact" onClick="save();">
						<i class="fa fa-save"></i> Save
					</a>
					<a class="btn btn-app1" id="saveuser" onClick="saveuserdetail();">
						<i class="fa fa-save"></i> Save
					</a>
					<a class="btn btn-app1" id="saverelation" onClick="saverelation();">
						<i class="fa fa-save"></i> Save
					</a>
					<?php } ?>
                    <button class="btn btn-box-tool" onClick="hideForm();"><i class="fa fa-times"></i></button>
				</div>
			</div><!-- /.box-header -->
            <div class="box-body">	
				<div id="project-tab">
					<form role="form" class="form-horizontal col-md-12 col-xs-12 col-lg-12 col-sm-12" id="dataForm" name="dataForm" action="" method ="post">
						<input type="hidden" value="" name="projectid" id="projectid" />
						<input type="hidden" value="" name="uniqueprojectid" id="uniqueprojectid"  />
						<input type="hidden" value="" name="uniqueunitid" id="uniqueunitid" value="0" />
						<input type="hidden" name="or_id" id="or_id" value="0"/>
						<input type="hidden" name="unitdet" id="unitdet" value="0"/>
						<input type="hidden" value="create" name="mode" id="mode" />
						<div class="nav-tabs-custom" id= "tabs">
							 <!-- Tabs within a box -->
							<ul class="nav nav-tabs">
							   <li class="customer-tab active"><a href="#customer-tab" data-toggle="tab">User detail</a></li>
							   <li class="contact-tab hide-tab"><a href="#contact-tab" data-toggle="tab">Contact detail</a></li>
							</ul>
						    <div class="tab-content no-padding">
								
							<?php
								if(isset($_POST['formStream'])) 
								{
								  $usertypeid = $_POST['projectregion'];
								  
								}
								  ?>
	                        <div class="tab-pane" id="customer-tab" style="position: relative; padding:20px 0px;">
								
				                <div id= "tableforuser">
							    </div>
								
								<div class="form-group">
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="or_project" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Project Name </label>
										<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
											 <input type="text" class="form-control" id="or_project" placeholder="Name"  name="or_project" readonly>
										</div>
									</div>                   
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="or_unit" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Unit Number </label>
										<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
											 <input type="text" class="form-control" id="or_unit" placeholder="Name"  name="or_unit" readonly>
										</div>
									</div>  
								</div>
								<div class="form-group">
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="or_salutation" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Salutation <sup class="text-red">*</sup></label>
										<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
											<select class="multi-select" id="or_salutation" name="or_salutation" data-placeholder="Salutation" style="width:auto;">
												<option value=""></option>
												<?php
													$qry="SELECT settingid, description, `status` FROM t_settings WHERE module='All' AND relation='Salutation' ORDER BY priority";
													$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
													if(mysqli_num_rows($res)>0){
														while($row=mysqli_fetch_array($res)){
												?>
														<option value="<?php echo $row['settingid']; ?>" <?php if($row['status']!='Active') { echo 'disabled="disabled"'; } ?> ><?php echo $row['description']; ?></option>
												<?php } } ?>
										    </select>
										</div>
									</div>
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										 <label for="or_name" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Name<sup class="text-red">*</sup></label></label>
										 <div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
											 <input type="text" class="form-control" id="or_name" placeholder="Name"  name="or_name"/>
										 </div>
									</div> 
								</div>
								<div class="form-group">
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										 <label for="or_dob" class="col-sm-6 col-xs-12 col-md-4 col-lg-4 control-label">DOB </label>
										 <div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
											<div class="input-group dtpick">
												<input type="text" class="form-control date"  id="or_dob" name="or_dob" placeholder="DOB" />
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
											</div>
										 </div>
									</div>                  
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="or_gender" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label"> Gender<sup class="text-red">*</sup></label>
										<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8" >                  
											<select class="multi-select" id="or_gender" name="or_gender" data-placeholder="Gender" align = "left">
											<option value=""></option>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="or_user_type" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Owner Type<sup class="text-red">*</sup></label>
										<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8"> 
											<select class="multi-select" id="or_user_type" name="or_user_type" data-placeholder="Owner Type">
												<option value=""></option>
												<?php
													 $qry="SELECT settingid, description,status FROM t_settings WHERE module='Owner and Resident'
                    					                  AND STATUS = 'Active'
                                                          ORDER BY priority";
													      $res=mysqli_query($link,$qry) or  die(mysqli_error($link));
													     if(mysqli_num_rows($res)>0){
														while($row=mysqli_fetch_array($res)){
												?>
														<option value="<?php echo $row['settingid']; ?>" <?php if($row['status']!='Active') { echo 'disabled="disabled"'; } ?> ><?php echo $row['description']; ?></option>
												<?php } } ?>
											</select>
									   
										</div>  
									</div> 	
									<div id="checkboxselect">
										<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
											<label for="or_mode_commu" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Mode </sup></label>
											<div class="col-sm-6 col-xs-12 col-md-6 col-lg-8"> 
											<?php
													 $qry="SELECT settingid, description,status FROM t_settings WHERE module='All'
														  AND STATUS = 'Active' AND relation = 'Mode of communication'
														  ORDER BY priority";
														  $res=mysqli_query($link,$qry) or  die(mysqli_error($link));
														 if(mysqli_num_rows($res)>0){
														while($row=mysqli_fetch_array($res))
													{
												?>
												
													<div class="col-sm-6 col-xs-12 col-md-8 col-lg-4">
														<label ><input  class= "checkbox" name="or_mode_commu[]"  id ="<?php echo $row['settingid']; ?>" type="checkbox" value="<?php echo $row['settingid']; ?>"><?php echo ' '.$row['description']; ?></label>
													</div>
											<?php }  ?>
											
											 <?php } ?>    
											</div> 
										</div> 
									</div>
								</div>
								<div class="form-group">
								    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="or_contact1" class="col-sm-5 col-xs-12 col-md-4 col-lg-4 control-label text-left">Contact No. </label>
										<div class="col-sm-7 col-xs-12 col-md-8 col-lg-8">
											<input type="text" class="form-control" id="or_contact1" name="or_contact1" placeholder="Contact Number" />
										</div>
									</div>
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="or_contact2" class="col-sm-5 col-xs-12 col-md-4 col-lg-4 control-label text-left">Alternative Contact No. </label>
										<div class="col-sm-7 col-xs-12 col-md-8 col-lg-8">
											<input type="text" class="form-control" id="or_contact2" name="or_contact2" placeholder="Contact Number" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										 <label for="or_from_date" class="col-sm-6 col-xs-12 col-md-4 col-lg-4 control-label">User From <sup class="text-red">*</sup></label>
										 <div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
											<div class="input-group dtpick">
												<input type="text" class="form-control date"  id="or_from_date" name="or_from_date" placeholder="User From" />
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
											</div>
										 </div>
									</div> 
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										 <label for="or_to_date" class="col-sm-6 col-xs-12 col-md-4 col-lg-4 control-label">User Till </label>
										 <div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
											<div class="input-group dtpick">
												<input type="text" class="form-control date"  id="or_to_date" name="or_to_date" placeholder="User Till" />
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
											</div>
										 </div>
									</div>
								</div>
							<div class="form-group">
									
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="or_email" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Email id</label>
										<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
											 <input type="email" class="form-control" id="or_email" placeholder="Email id"  name="or_email">
										</div>
									</div>
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="or_designation" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Designation</label>
										<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
											 <input type="text" class="form-control" id="or_designation" placeholder="Current / Last Designation"  name="or_designation">
										</div>
									</div>
							</div>
                            <div class="form-group">
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="or_qualification" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Qualification</label>
										<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
											 <input type="text" class="form-control" id="or_qualification" placeholder="Qualification"  name="or_qualification">
										</div>
									</div>
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="or_specialization" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Specialization</label>
										<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
											 <input type="text" class="form-control" id="or_specialization" placeholder="Specialization"  name="or_specialization">
										</div>
									</div>
							</div>	
							<div class="form-group">
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="or_address" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Address  </label>
										<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
											 <input type="text" class="form-control" id="or_address" placeholder="Address "  name="or_address" >
										</div>
									</div> 
							<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="or_city" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">City</label>
										<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
											 <input type="text" class="form-control" id="or_city" placeholder="City"  name="or_city">
										</div>
									</div>									
							</div>
							<div class="form-group">
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="or_state" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">State </label>
										<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
											 <input type="text" class="form-control" id="or_state" placeholder="State"  name="or_state" >
										</div>
									</div>  
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="or_pincode" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Pincode</label>
										<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
											 <input type="text" class="form-control" id="or_pincode" placeholder="Pincode"  name="or_pincode">
										</div>
									</div>
							    </div>
								<div class="form-group">
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
									<label for="or_is_resident" class="col-sm-5 col-xs-12 col-md-4 col-lg-4 control-label text-left">Residing<sup class="text-red">*</sup> </label>
									<div class="col-sm-7 col-xs-12 col-md-8 col-lg-8">
										<select class="multi-select" id="or_is_resident" name="or_is_resident" data-placeholder="Is Resident?">
												<option value=""></option>
												<option value="No" selected="selected">No</option>
												<option value="Yes">Yes</option>
										</select>
									 </div>
								  </div>
							    </div>
							</div>
						</div>
					</div>
				
			<!-- /.box-body -->
			</form>
			</div>
			   <form role="form" class="form-horizontal col-md-12 col-xs-12 col-lg-12 col-sm-12" id="relationForm" name="relationForm">
                	<div id="owner_contact_list">
                    </div>
                    <div id="owner_contact_field">
                    	<input type="hidden" name="ownercontact_id" id="ownercontact_id" value="0"  />
						<input type="hidden" name="relationcontact_id" id="relationcontact_id" value="0"  />
                        <input type="hidden" name="action" id="action" value="add" />
						<input type="hidden" value="" name="relationprojectid" id="relationprojectid"  />
						<input type="hidden" value="" name="relationunitid" id="relationunitid" value="0" />
						<div class="form-group">
							<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
								<label for="contact_project" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Project Name </label>
								<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
									 <input type="text" class="form-control" id="contact_project" placeholder="Project Name"  name="contact_project" readonly>
								</div>
							</div>                   
							<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
								<label for="contact_unit" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Unit Number </label>
								<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
									 <input type="text" class="form-control" id="contact_unit" placeholder="Unit Name"  name="contact_unit" readonly>
								</div>
							</div>  
					    </div>
                    	<div class="form-group">
						    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
								<label for="contact_salutation" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Relation Salutation <sup class="text-red">*</sup></label>
								<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
									<select class="multi-select" id="contact_salutation" name="contact_salutation" data-placeholder="Salutation" style="width:auto;">
										<option value=""></option>
										<?php
											$qry="SELECT settingid, description, `status` FROM t_settings WHERE module='All' AND relation='Salutation' ORDER BY priority";
											$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
											if(mysqli_num_rows($res)>0){
												while($row=mysqli_fetch_array($res)){
										?>
												<option value="<?php echo $row['settingid']; ?>" <?php if($row['status']!='Active') { echo 'disabled="disabled"'; } ?> ><?php echo $row['description']; ?></option>
										<?php } } ?>
									</select>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
								<label for="contact_relationname" class="col-sm-6 col-xs-12 col-md-4 col-lg-4 control-label">Relation Name<sup class="text-red">*</sup></label>
								<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
									<input type="text" class="form-control" id="contact_relationname" name="contact_relationname" placeholder="Relation Name" />
								</div>
							</div>
							                   
                        </div>
						<div class="form-group">
						    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
								<label for="contact_relation" class="col-sm-5 col-xs-12 col-md-4 col-lg-4 control-label text-left" > Relation<sup class="text-red">*</sup> </label>
								<div class="col-sm-7 col-xs-12 col-md-8 col-lg-8">
									<select class="multi-select" id="contact_relation" name="contact_relation" data-placeholder="Choose the Relation">
										<option value=""></option>
										<?php
											$qry="SELECT settingid, description, `status` FROM t_settings WHERE module='Contact' AND relation='Relation Type' ORDER BY priority";
											$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
											if(mysqli_num_rows($res)>0)
											{
												while($row=mysqli_fetch_array($res))
												{
										?>
												<option value="<?php echo $row['settingid']; ?>" <?php if($row['status']!='Active') { echo 'disabled="disabled"'; } ?> ><?php echo $row['description']; ?></option>
										  <?php } 
											} ?>
									</select>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
								<label for="contact_coowner" class="col-sm-5 col-xs-12 col-md-4 col-lg-4 control-label text-left">Co-owner<sup class="text-red">*</sup> </label>
								<div class="col-sm-7 col-xs-12 col-md-8 col-lg-8">
									<select class="multi-select" id="contact_coowner" name="contact_coowner" data-placeholder="Is co-owner?">
											<option value=""></option>
											<option value="No" selected="selected">No</option>
											<option value="Yes">Yes</option>
									</select>
						         </div>
					        </div>
                        </div>   
							                     
						<div class="form-group">
						    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
								<label for="contact_gender" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Gender<sup class="text-red">*</sup></label>
								<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
									<select class="multi-select" id="contact_gender" name="contact_gender" data-placeholder="Gender">
										<option value=""></option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
							</div>    
						    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
								<label for="contact_dob" class="col-sm-6 col-xs-12 col-md-4 col-lg-4 control-label">DOB<sup class="text-red">*</sup> </label>
								<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
									<div class="input-group dtpick">
									  <input type="text" class="form-control date"  id="contact_dob" name="contact_dob" placeholder="DOB" />
									  <span class="input-group-addon">
											<i class="fa fa-calendar"></i>
									  </span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
						<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="contact_contact" class="col-sm-5 col-xs-12 col-md-4 col-lg-4 control-label text-left">Contact No<sup class="text-red">*</sup> </label>
										<div class="col-sm-7 col-xs-12 col-md-8 col-lg-8">
											<input type="text" class="form-control" id="contact_contact" name="contact_contact" placeholder="Contact No" />
										</div>
								  </div> 
						<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
										<label for="contact_altcontact" class="col-sm-6 col-xs-12 col-md-4 col-lg-4 control-label">Alternative Contact No </label>
										<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
												<input type="text" class="form-control" id="contact_altcontact" name="contact_altcontact" placeholder="Alternative Contact No" />
										</div>
								  </div>
							                  
							
						</div>
						<div class="form-group">
						    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
								<label for="contact_addressline1" class="col-sm-5 col-xs-12 col-md-4 col-lg-4 control-label text-left">Address </label>
								<div class="col-sm-7 col-xs-12 col-md-8 col-lg-8">
									<input type="text" class="form-control" id="contact_addressline1" name="contact_addressline1" placeholder="Address" />
								</div>
							</div> 
						    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
								<label for="contact_addressline2" class="col-sm-5 col-xs-12 col-md-4 col-lg-4 control-label text-left">Location </label>
								<div class="col-sm-7 col-xs-12 col-md-8 col-lg-8">
									<input type="text" class="form-control" id="contact_addressline2" name="contact_addressline2" placeholder="Location" />
								</div>
						    </div>
						    
						   
						</div>
						
					    <div class="form-group">
						<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
							  	<label for="contact_city" class="col-sm-6 col-xs-12 col-md-4 col-lg-4 control-label">City </label>
							  	<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
							  			<input type="text" class="form-control" id="contact_city" name="contact_city" placeholder="City" />
							  	</div>
						    </div>
						 <div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
							  	<label for="contact_state" class="col-sm-5 col-xs-12 col-md-4 col-lg-4 control-label text-left">State </label>
							  	<div class="col-sm-7 col-xs-12 col-md-8 col-lg-8">
							  		<input type="text" class="form-control" id="contact_state" name="contact_state" placeholder="State" />
							  	</div>
						    </div> 
						                    
						    
					    </div>
						<div class="form-group">
						         <div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
								<label for="contact_country" class="col-sm-5 col-xs-12 col-md-4 col-lg-4 control-label text-left">Country </label>
								<div class="col-sm-7 col-xs-12 col-md-8 col-lg-8">
									<input type="text" class="form-control" id="contact_country" name="contact_country" placeholder="Country" />
								</div>
						    </div>   
						          <div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
								<label for="contact_pincode" class="col-sm-6 col-xs-12 col-md-4 col-lg-4 control-label">Pincode </label>
								<div class="col-sm-7 col-xs-12 col-md-8 col-lg-8">                  
									  <input type="text" class="form-control" id="contact_pincode" name="contact_pincode" placeholder="Pincode" />
								</div>
						       </div>
								                    
								  
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
								<label for="contact_mail" class="col-sm-5 col-xs-12 col-md-4 col-lg-4 control-label text-left">Mail ID </label>
								<div class="col-sm-7 col-xs-12 col-md-8 col-lg-8">
									<input type="email" class="form-control" id="contact_mail" name="contact_mail" placeholder="Mail ID" />
								</div>
							</div> 
							<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
								<label for="contact_designation" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Designation</label>
								<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
									 <input type="text" class="form-control" id="contact_designation" placeholder="Current / Last Designation"  name="contact_designation">
								</div>
							</div>
                        </div>
						<div class="form-group">
							<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
								<label for="contact_qualification" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Qualification</label>
								<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
									 <input type="text" class="form-control" id="contact_qualification" placeholder="Qualification"  name="contact_qualification">
								</div>
							</div>
							<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
								<label for="contact_specialization" class="col-sm-6 col-xs-7 col-md-4 col-lg-4 control-label">Specialization</label>
								<div class="col-sm-6 col-xs-12 col-md-8 col-lg-8">                  
									 <input type="text" class="form-control" id="contact_specialization" placeholder="Specialization"  name="contact_specialization">
								</div>
							</div>
						</div>
						<div class="form-group">
									<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
									<label for="contact_is_resident" class="col-sm-5 col-xs-12 col-md-4 col-lg-4 control-label text-left">Residing<sup class="text-red">*</sup> </label>
									<div class="col-sm-7 col-xs-12 col-md-8 col-lg-8">
										<select class="multi-select" id="contact_is_resident" name="contact_is_resident" data-placeholder="Is Resident?">
												<option value=""></option>
												<option value="No" selected="selected">No</option>
												<option value="Yes">Yes</option>
										</select>
									 </div>
								  </div>
							    </div>
                    </div>
                </form>
          </div>  
		<div class="box-footer clearfix"></div>
		</div><!-- /.box -->
	</div>
</div>
<!--- FORM DISPLAY ENDS --->
<!--- LIST STARTS --->                            
<div class="row" id="dataHolder"> 
  <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 permission-tbl list-tbl custom-page-box-div">  
    <div class="box">
      <div class="box-body ">
            <form method="post" name="form">
            <div class="row clearfix"  style="margin-bottom:10px;">
                    <div class="col-md-3 col-xs-12 col-lg-3 col-sm-12 column">   
						<?php if (date('m') >3){
							$datepick= date('Y').'-'.date("y",strtotime("1 year")); }
							else{
								 $datepick= date("Y",strtotime("-1 year")).'-'.date('y');
							}?>					
						 <input type="text" class="form-control" name="datepicker1" id="datepicker1" <?php if(isset($_REQUEST['datepicker1'])) {?> value="<?php echo $_REQUEST['datepicker1'];?>"<?php }else { ?> value="<?php echo $datepick;?>" <?php }?>/> 
                    </div>  
					<div class="col-md-3 col-xs-12 col-lg-3 col-sm-12 column">         
						 <select class="form-control multi-select" id="usergroup" name="usergroup" data-placeholder="Select Project">
							<option value=""></option>
							<?php
								$qry="SELECT project_id, project_name, `status` FROM t_project WHERE FIND_IN_SET(project_id,'".$setvar."') ORDER BY project_name";
								$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
								if(mysqli_num_rows($res)>0){
									while($row=mysqli_fetch_array($res)){
										$selected=false;
										if(isset($_REQUEST['usergroup'])){
											if($row['project_id']==$_REQUEST['usergroup'])
											{
												$selected=true; 
											}
										}
							?>
									<option value="<?php echo $row['project_id']; ?>" <?php if($selected) { ?> selected <?php } ?>><?php echo $row['project_name']; ?></option>
							<?php } } ?>
						 </select>
                    </div> 
				<div class="col-md-3 col-xs-12 col-lg-3 col-sm-12 column"> 
				<?php if(isset($_REQUEST['usergroup'])) { ?>
				   
						   <div id="punit">					  
							 <select class="form-control multi-select" id="unitgroup" name="unitgroup" data-placeholder="Select Unit">
								<option value=""></option>
								<?php
									$qry="SELECT unit_id, unit_number, `status` FROM t_units where unit_projectid='".$_REQUEST['usergroup']."' ORDER BY unit_number";
									$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
									if(mysqli_num_rows($res)>0){
										while($row=mysqli_fetch_array($res)){
											$selected=false;
											if(isset($_REQUEST['unitgroup'])){
												if($row['unit_id']==$_REQUEST['unitgroup']){
													$selected=true;
												}
											}
								?>
										<option value="<?php echo $row['unit_id']; ?>" <?php if($selected) { ?> selected <?php } ?>><?php echo $row['unit_number']; ?></option>
								<?php } } ?>
							 </select>
						  </div> 
				
				</div>
			<?php if(isset($_REQUEST['unitgroup'])) {
			 if($create) { ?>
            <div class="buttons col-md-3 col-xs-12 col-lg-3 col-sm-12 right">
            	<a class="btn btn-app1 adduser" id="adduser" onClick="showdetail();">
                  <i class="fa fa-plus"></i> Add
               </a>
            </div>
			<?php } ?>
			<?php } ?> 
			<?php } ?>
		  </div>
		  
      <!-- /.box-header -->
      
	  <?php if(isset($_REQUEST['usergroup']) && isset($_REQUEST['unitgroup']) ){ ?>
        <table class="table table-hover table-bordered-bottom table-responsive dataTable" id = "userdetail"> 
          <thead>
            <tr>
              <th>Project Name</th>
			  <th>Unit Number</th>
              <th>Name</th>
              <th>Gender</th>
			  <th>User Type</th>
			  <th>User From</th>
			  <th>User To</th>
			  <th>Contact number</th>
			  <th>Mail ID</th>
			  <th>Status</th>
			  <th class="text-center">Action</th>
				<th>Address line1</th>
				<th>Address Line2</th>
				<th>Country</th>
				<th>City</th>
			  <th>Pincode</th>
				<th>State</th>
				<th>Fb Page</th>
				<th>Total No. of toilets</th>
				<th>Parking Availability</th>
				<th>No. of Parking</th>
				<th>Parking Type</th>
				<th>Note</th>
				<th>Status Value</th>
				<th>Project ID</th>
				<th>Unit Configuration</th>
			  <th>Designation</th>
			  <th>Qualification</th>
			  <th>Specialization</th>
			  <th>Communication</th>
			  <th>Contact2</th>
			  <th>Is Resident</th>
            </tr>
          </thead>        
          <tbody>      
          <?php 
		        $qry1 = "SELECT TRIM(LEADING ',' FROM projects_assigned) as assigned_projects from t_users where userid = ".$_SESSION['realpm_userid']."";
				$result1=mysqli_query($link,$qry1) or die(mysqli_error($link));
				$setvar = array();
				if(mysqli_num_rows($result1)>0){
					while($row1=mysqli_fetch_array($result1)) {
						$setvar = $row1['assigned_projects'];
					}
				}
		  		$qry="SELECT tor.*,s.description ,n.`description` AS user_type ,tp.project_name,tu.`unit_number` FROM t_owner_resident tor LEFT JOIN t_settings s ON s.settingid=tor.or_salutation
				      LEFT JOIN t_project tp ON tp.`project_id` =tor.`or_project`
					  LEFT JOIN t_units tu ON tu.`unit_id` =tor.`or_unit`
                      LEFT JOIN t_settings n ON n.`settingid` = tor.`or_user_type` 
					  WHERE FIND_IN_SET(tor.or_project,'".$setvar."')
					  AND tor.`or_unit` = '".$_REQUEST['unitgroup']."'
					  AND tor.`or_project`= '".$_REQUEST['usergroup']."'
					  AND tor.status = 'Active'
					  order by n.settingid"; 
				$result=mysqli_query($link,$qry) or die(mysqli_error($link));
				if(mysqli_num_rows($result)>0){
					while($row=mysqli_fetch_array($result)) {
		   ?>
		        <td><?php echo $row['project_name']?></td>
				<td><?php echo $row['unit_number']?></td>
                <td><?php echo $row['description'].' '.$row['or_name']; ?> </td>
               <td><?php echo stripslashes($row['or_gender']); ?></td>
			    <td><?php echo stripslashes($row['user_type']); ?></td>
			    <td><?php echo stripslashes($row['or_from_date']); ?></td>
			    <td><?php if(($row['or_to_date'])=='0000-00-00'){
					echo ' ';
				}
				else {
					echo stripslashes($row['or_to_date']);
				}					?></td>
			    <td><?php echo $row['or_contact']; ?></td>
			    <td><?php echo $row['or_mail']; ?></td>
				<td><?php if($row['status']=='Active'){ 
			  				echo '<div class="label label-primary">Active</div>';
			  			}	else {
				  			echo '<div class="label label-danger">Inactive</div>'; 
				 }?></td>
				<td align="justify" class="actions-field"> 
                <?php if($update) 
				{ ?>	
         			
			        <a align="justify" class="btn btn-actions editUser" title ="Update User" onClick= "editUserdetail(<?php echo $row['or_id']; ?>);"><i align="justify" class="fa fa-edit"></i></a>
                    <a class="btn btn-actions editrelation" id="editrelation" title="Add Relation" onClick="showForm();"><i class="fa fa-group"></i></a>
					<?php } ?>
			  <!--  <a class="btn btn-actions deleteUser" title ="Delete User" id="deleteUser"  ><i class="fa fa-trash-o"></i></a> -->
			    </td>
                <td><?php echo $row['or_address_line1']; ?></td>
                <td><?php echo stripslashes($row['or_address_line2']); ?></td>
              <td><?php echo stripslashes($row['or_country']); ?></td>   
              <td><?php echo stripslashes($row['or_city']); ?></td>
              <td><?php echo stripslashes($row['or_pincode']); ?></td>
              <td><?php echo stripslashes($row['or_state']); ?></td>
              <td><?php echo $row['or_fbpage']; ?></td>
			  <td><?php echo $row['or_salutation']; ?></td>
			  <td><?php echo $row['or_name'];?></td>
			  <td><?php echo $row['or_dob']?></td>
			  <td><?php echo $row['or_unit']?></td>
			  <td><?php echo $row['or_project']?></td>
			  <td><?php echo $row['or_user_type']?></td>
			  <td><?php echo $row['or_gender']?></td>
			  <td><?php echo $row['or_id']?></td>
			  <td><?php echo $row['or_designation']?></td>
			  <td><?php echo $row['or_qualification']?></td>
			  <td><?php echo $row['or_specialization']?></td>
			  <td><?php echo $row['or_mode_communication']; ?></td>
			  <td><?php echo $row['or_contact_sec']; ?></td>
			  <td><?php echo $row['or_is_resident']; ?></td>
            </tr>
            <?php } } ?>
          </tbody>
        </table> 
	  <?php } ?>		
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>
</div>
<!--- LIST STARTS ---> 
</section><!-- /.content -->
<?php } ?>
</div><!-- /.content-wrapper -->
<?php require "../../layout/footer.php"; ?>
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
 <link rel="stylesheet" href="../../assets/css/dateledger.css" />   
 <script src="../../assets/js/dateledger.js"></script>  
 <script type="text/javascript">  
        $(function()  
        {  
            var year;  
            $("#datepicker1").datepicker(  
            {  
                onSelect: function(dateText, inst)  
                {  
                    var date = $(this).datepicker('getDate'),  
                        day = date.getDate(),  
                        month = date.getMonth(),  
                        year = date.getFullYear();  
                    year1 = date.getFullYear();  
                    if (month < 3)  
                    {  
                        year = year - 1;  
                        year1 = year1.toString().substring(2);  
                    }  
                    else  
                    {  
                        yearyear = year;  
                        year1 = (year1 + 1).toString().substring(2);;  
                    }  
                    $("#datepicker1").val(year + '-' + year1);  
                },  
            });  
        });  
    </script> 
<script src="action.js"></script>
  </body>
</html>