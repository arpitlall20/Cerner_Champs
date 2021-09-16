<?php 
	$title = "CanCern"; 
	require "../../layout/header.php";
	require "../../layout/sidebar-left.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        CanCern
        <small><?php if(isset($_SESSION['align_message'])) { echo $_SESSION['align_message'];  unset($_SESSION['align_message']);} ?></small>
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
                <div class="box box-warning1">
                    <div class="box-header with-border">
                        <h5 class="box-title"></h5>
                        <div class="box-tools col-md-4 col-xs-4 col-lg-4 col-sm-4 text-right" id="createform">
                            <?php if($create) { ?>
                                <a class="btn btn-app1 btnSave" id="btnSave" onClick="save();">
                                    <i class="fa fa-save"></i> Save
                                </a>
                                <a class="btn btn-app1 btnDocuments" name="add" id="btnDocuments" onClick="file_uploads('add');">
                                    <i class="fa fa-save"></i> Save
                                </a>
                            <?php } ?>
                            <button class="btn btn-box-tool" onClick="hideForm();"><i class="fa fa-times"></i></button>
                        </div> 
                        <div class="box-tools col-md-4 col-xs-4 col-lg-4 col-sm-4 text-right" id="updateform" style="display:none;">
                            <?php if($update) { ?>
                                <a class="btn btn-app1 btnSave" id="btnSave" onClick="save();">
                                    <i class="fa fa-save"></i> Save
                                </a>
                                <a class="btn btn-app1 btnDocuments" name="add" id="btnDocuments" onClick="file_uploads('add');">
                                    <i class="fa fa-save"></i> Save
                                </a>
                            <?php } ?>
                            <button class="btn btn-box-tool" onClick="hideForm();"><i class="fa fa-times"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" class="form-horizontal col-md-12 col-xs-12 col-lg-12 col-sm-12" id="dataForm" name="dataForm">
                            <input type="hidden" value="" name="unitid" id="unitid" />
                            <input type="hidden" value="create" name="mode" id="mode" />
                            <div id="unit_form">
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix"></div>
                </div><!-- /.box -->
            </div>
        </div>
        <!--- FORM DISPLAY ENDS --->
        <!--- LIST STARTS --->                            
        <div class="row" id="dataHolder">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">  
                <div class="box box-warning1">
                    <div class="box-header">
                        <div class="box-title resp" id="responseMessage"></div>
                       
                        <form method="post" name="form">
                            <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
								Gender (Woman-1 /Man-0)
							</div>
                            <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">         
                                <select class="form-control multi-select" id="sex" name="sex" data-placeholder="Gender">
                                    <option value=""></option>
                                    <?php
                                       
                                        $selected1=true;
                                        if(isset($_REQUEST['sex'])){
                                            if(0==$_REQUEST['sex']){
                                            $selected1=true;
											
                                            }
                                        }
										$selected=false;
                                        if(isset($_REQUEST['sex'])){
                                            if(1==$_REQUEST['sex']){
                                            $selected=true;
											$selected1=false;
                                            }
                                        }
                                    ?>
                                    <option value="0" <?php if($selected1) { ?> selected <?php } ?>>0</option>
                                    
                                    <option value="1" <?php if($selected) { ?> selected <?php } ?>>1</option>
                                </select>
                            </div> 
							 <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
								Nerve Damage (Yes-1/No-0)
							</div>
                            <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">         
                                <select class="form-control multi-select" id="intubed" name="intubed" data-placeholder="Nerve Damage">
                                    <option value=""></option>
                                    <?php
                                       
                                        $selected1=true;
                                        if(isset($_REQUEST['intubed'])){
                                            if(0==$_REQUEST['intubed']){
                                            $selected1=true;
                                            }
                                        }
										 $selected=false;
                                        if(isset($_REQUEST['intubed'])){
                                            if(1==$_REQUEST['intubed']){
                                            $selected=true;
											$selected1=false;
                                            }
                                        }
                                    ?>
                                    <option value="0" <?php if($selected1) { ?> selected <?php } ?>>0</option>
                                     <?php
                                       
                                       
                                    ?>
                                    <option value="1" <?php if($selected) { ?> selected <?php } ?>>1</option>
                                </select>
                            </div> 
							
							<div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
								Pneumonia (Yes-1/No-0)
							</div>
                            <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">         
                                <select class="form-control multi-select" id="pneumonia" name="pneumonia" data-placeholder="Pneumonia">
                                    <option value=""></option>
                                    <?php
                                       
                                        $selected1=true;
                                        if(isset($_REQUEST['pneumonia'])){
                                            if(0==$_REQUEST['pneumonia']){
                                            $selected1=true;
                                            }
                                        }
										 $selected=false;
                                        if(isset($_REQUEST['pneumonia'])){
                                            if(1==$_REQUEST['pneumonia']){
                                            $selected=true;
											$selected1=false;
                                            }
                                        }
                                    ?>
                                    <option value="0" <?php if($selected1) { ?> selected <?php } ?>>0</option>
                                    
                                    <option value="1" <?php if($selected) { ?> selected <?php } ?>>1</option>
                                </select>
                            </div> 
							</br></br></br>
							 <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
								Age (above 40 Yes -1/ No -0)
							</div>
                            <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">         
                                <select class="form-control multi-select" id="age" name="age" data-placeholder="Age">
                                    <option value=""></option>
                                    <?php
                                       
                                        $selected1=true;
                                        if(isset($_REQUEST['age'])){
                                            if(0==$_REQUEST['age']){
                                            $selected1=true;
                                            }
                                        }
										 $selected=false;
                                        if(isset($_REQUEST['age'])){
                                            if(1==$_REQUEST['age']){
                                            $selected=true;
											$selected1=false;
                                            }
                                        }
                                    ?>
                                    <option value="0" <?php if($selected1) { ?> selected <?php } ?>>0</option>
                                    
                                    <option value="1" <?php if($selected) { ?> selected <?php } ?>>1</option>
                                </select>
                            </div>
							
							<div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
								Diabetes (Yes-1/No-0)
							</div>
                            <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">         
                                <select class="form-control multi-select" id="diabetes" name="diabetes" data-placeholder="Diabetes">
                                    <option value=""></option>
                                    <?php
                                       
                                        $selected1=true;
                                        if(isset($_REQUEST['diabetes'])){
                                            if(0==$_REQUEST['diabetes']){
                                            $selected1=true;
                                            }
                                        }
										  $selected=false;
                                        if(isset($_REQUEST['diabetes'])){
                                            if(1==$_REQUEST['diabetes']){
                                            $selected=true;
											$selected1=false;
                                            }
                                        }
                                    ?>
                                    <option value="0" <?php if($selected1) { ?> selected <?php } ?>>0</option>
                                    
                                    <option value="1" <?php if($selected) { ?> selected <?php } ?>>1</option>
                                </select>
                            </div> 
							 <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
								COPD (Yes-1/No-0)
							</div>
                            <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">         
                                <select class="form-control multi-select" id="copd" name="copd" data-placeholder="COPD">
                                    <option value=""></option>
                                    <?php
                                       
                                        $selected1=true;
                                        if(isset($_REQUEST['copd'])){
                                            if(0==$_REQUEST['copd']){
                                            $selected1=true;
                                            }
                                        }
										   $selected=false;
                                        if(isset($_REQUEST['copd'])){
                                            if(1==$_REQUEST['copd']){
                                            $selected=true;
											 $selected1=false;
                                            }
                                        }
                                    ?>
                                    <option value="0" <?php if($selected1) { ?> selected <?php } ?>>0</option>
                                   
                                    <option value="1" <?php if($selected) { ?> selected <?php } ?>>1</option>
                                </select>
                            </div> 
							</br></br></br>
							<div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
								Asthma (Yes-1/No-0)
							</div>
                            <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">         
                                <select class="form-control multi-select" id="asthma" name="asthma" data-placeholder="Asthma">
                                    <option value=""></option>
                                    <?php
                                       
                                        $selected1=true;
                                        if(isset($_REQUEST['asthma'])){
                                            if(0==$_REQUEST['asthma']){
                                            $selected1=true;
                                            }
                                        }
										 $selected=false;
                                        if(isset($_REQUEST['asthma'])){
                                            if(1==$_REQUEST['asthma']){
                                            $selected=true;
											$selected1=false;
                                            }
                                        }
                                    ?>
                                    <option value="0" <?php if($selected1) { ?> selected <?php } ?>>0</option>
                                   
                                    <option value="1" <?php if($selected) { ?> selected <?php } ?>>1</option>
                                </select>
                            </div> 
							 <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
								Osteoporosis (Yes-1/No-0)
							</div>
                            <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">         
                                <select class="form-control multi-select" id="inmspr" name="inmspr" data-placeholder="Osteoporosis">
                                    <option value=""></option>
                                    <?php
                                       
                                        $selected1=true;
                                        if(isset($_REQUEST['inmspr'])){
                                            if(0==$_REQUEST['inmspr']){
                                            $selected1=true;
                                            }
                                        }
										  $selected=false;
                                        if(isset($_REQUEST['inmspr'])){
                                            if(1==$_REQUEST['inmspr']){
                                            $selected=true;
											$selected1=false;
                                            }
                                        }
                                    ?>
                                    <option value="0" <?php if($selected1) { ?> selected <?php } ?>>0</option>
                                    <option value="1" <?php if($selected) { ?> selected <?php } ?>>1</option>
                                </select>
                            </div> 
							
							<div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
								Hypertension (Yes-1/No-0)
							</div>
                            <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">         
                                <select class="form-control multi-select" id="hypertension" name="hypertension" data-placeholder="Hypertension">
                                    <option value=""></option>
                                    <?php
                                       
                                        $selected1=true;
                                        if(isset($_REQUEST['hypertension'])){
                                            if(0==$_REQUEST['hypertension']){
                                            $selected1=true;
                                            }
                                        }
										$selected=false;
                                        if(isset($_REQUEST['hypertension'])){
                                            if(1==$_REQUEST['hypertension']){
                                            $selected=true;
											$selected1=false;
                                            }
                                        }
                                    ?>
                                    <option value="0" <?php if($selected1) { ?> selected <?php } ?>>0</option>
                                   
                                    <option value="1" <?php if($selected) { ?> selected <?php } ?>>1</option>
                                </select>
                            </div> 
							</br></br></br>
							 <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
								Other Disease (Yes-1/No-0)
							</div>
                            <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">         
                                <select class="form-control multi-select" id="other_disease" name="other_disease" data-placeholder="Other Disease">
                                    <option value=""></option>
                                    <?php
                                       
                                        $selected1=true;
                                        if(isset($_REQUEST['other_disease'])){
                                            if(0==$_REQUEST['other_disease']){
                                            $selected1=true;
                                            }
                                        }
										  $selected=false;
                                        if(isset($_REQUEST['other_disease'])){
                                            if(1==$_REQUEST['other_disease']){
                                            $selected=true;
											$selected1=false;
                                            }
                                        }
                                    ?>
                                    <option value="0" <?php if($selected1) { ?> selected <?php } ?>>0</option>
                                    
                                    <option value="1" <?php if($selected) { ?> selected <?php } ?>>1</option>
                                </select>
                            </div>
							
							<div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
								Obesity (Yes-1/No-0)
							</div>
                            <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">         
                                <select class="form-control multi-select" id="obesity" name="obesity" data-placeholder="Obesity">
                                    <option value=""></option>
                                    <?php
                                       
                                        $selected1=true;
                                        if(isset($_REQUEST['obesity'])){
                                            if(0==$_REQUEST['obesity']){
                                            $selected1=true;
                                            }
                                        }
										 $selected=false;
                                        if(isset($_REQUEST['obesity'])){
                                            if(1==$_REQUEST['obesity']){
                                            $selected=true;
											 $selected1=false;
                                            }
                                        }
                                    ?>
                                    <option value="0" <?php if($selected1) { ?> selected <?php } ?>>0</option>
                                    <option value="1" <?php if($selected) { ?> selected <?php } ?>>1</option>
                                </select>
                            </div> 
							 <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
								Cardio Vascular (Yes-1/No-0)
							</div>
                            <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">         
                                <select class="form-control multi-select" id="cardio" name="cardio" data-placeholder="Cardio">
                                    <option value=""></option>
                                    <?php
                                       
                                        $selected1=true;
                                        if(isset($_REQUEST['cardio'])){
                                            if(0==$_REQUEST['cardio']){
                                            $selected1=true;
                                            }
                                        }
										  $selected=false;
                                        if(isset($_REQUEST['cardio'])){
                                            if(1==$_REQUEST['cardio']){
                                            $selected=true;
											 $selected1=false;
                                            }
                                        }
                                    ?>
                                    <option value="0" <?php if($selected1) { ?> selected <?php } ?>>0</option>
                                    
                                    <option value="1" <?php if($selected) { ?> selected <?php } ?>>1</option>
                                </select>
                            </div>
							</br></br></br>
							<div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
								Renal Chronic (Yes-1/No-0)
							</div>
                            <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">         
                                <select class="form-control multi-select" id="renal_chronic" name="renal_chronic" data-placeholder="Renal Chronic">
                                    <option value=""></option>
                                    <?php
                                       
                                        $selected1=true;
                                        if(isset($_REQUEST['renal_chronic'])){
                                            if(0==$_REQUEST['renal_chronic']){
                                            $selected1=true;
                                            }
                                        }
										  
                                        $selected=false;
                                        if(isset($_REQUEST['renal_chronic'])){
                                            if(1==$_REQUEST['renal_chronic']){
                                            $selected=true;
											$selected1=true;
                                            }
                                        }
                                    ?>
                                    <option value="0" <?php if($selected1) { ?> selected <?php } ?>>0</option>
                                    <option value="1" <?php if($selected) { ?> selected <?php } ?>>1</option>
                                </select>
                            </div> 
							 <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
								Tobacco (Yes-1/No-0)
							</div>
                            <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">         
                                <select class="form-control multi-select" id="tobacco" name="tobacco" data-placeholder="Tobacco">
                                    <option value=""></option>
                                    <?php
                                       
                                        $selected1=true;
                                        if(isset($_REQUEST['tobacco'])){
                                            if(0==$_REQUEST['tobacco']){
                                            $selected1=true;
                                            }
                                        }
										    $selected=false;
                                        if(isset($_REQUEST['tobacco'])){
                                            if(1==$_REQUEST['tobacco']){
                                            $selected=true;
											$selected1=false;
                                            }
                                        }
                                    ?>
                                    <option value="0" <?php if($selected1) { ?> selected <?php } ?>>0</option>
                                  
                                    <option value="1" <?php if($selected) { ?> selected <?php } ?>>1</option>
                                </select>
                            </div>
							<div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
								ICU (Yes-1/No-0)
							</div>
							<div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">         
                                <select class="form-control multi-select" id="icu" name="icu" data-placeholder="icu">
                                    <option value=""></option>
                                    <?php
                                       
                                        $selected1=true;
                                        if(isset($_REQUEST['icu'])){
                                            if(0==$_REQUEST['icu']){
                                            $selected1=true;
                                            }
                                        }
										$selected=false;
                                        if(isset($_REQUEST['icu'])){
                                            if(1==$_REQUEST['icu']){
                                            $selected=true;
											$selected1=false;
                                            }
                                        }
                                    ?>
                                    <option value="0" <?php if($selected1) { ?> selected <?php } ?>>0</option>
                                    
                                    <option value="1" <?php if($selected) { ?> selected <?php } ?>>1</option>
                                </select>
                            </div>
							</br></br></br>
							 <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6">
								
							</div>
							<div class="col-md-6 col-xs-6 col-lg-6 col-sm-6">
								<button type="button" class="btn btn-primary" onClick="save();"> Search</button>
							</div>
							</br></br>
								
							  						
							
                        </form>
                    
                    </div></br></br>
                    <div class="box-body" style="overflow-x:scroll;">
                        <?php if(isset($_REQUEST['intubed']) && isset($_REQUEST['sex']) && isset($_REQUEST['pneumonia'])&& isset($_REQUEST['age'])
						&& isset($_REQUEST['diabetes']) && isset($_REQUEST['copd']) && isset($_REQUEST['asthma']) && isset($_REQUEST['inmspr'])
					&& isset($_REQUEST['hypertension'])&& isset($_REQUEST['other_disease'])&& isset($_REQUEST['obesity'])&& isset($_REQUEST['cardio'])
					&& isset($_REQUEST['renal_chronic']) && isset($_REQUEST['tobacco']) && isset($_REQUEST['icu']) && isset($_REQUEST['icu'])
							){
					
	
							?>
                         <section class="content">
      
        <div class="row">
            
        
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12"> 
                
				<?php $qry="select distinct no_of_cases,percentage from align.covid_data  where sex=".$_REQUEST['sex']." and intubed=".$_REQUEST['intubed']." and pneumonia=".$_REQUEST['pneumonia']."
				 and age=".$_REQUEST['age']." and diabetes=".$_REQUEST['diabetes']." and copd=".$_REQUEST['copd']." and asthma=".$_REQUEST['asthma']." and immsupr=".$_REQUEST['inmspr']." and hypertension=".$_REQUEST['hypertension']."
				  and other_disease=".$_REQUEST['other_disease']." and cardiovascular = ".$_REQUEST['cardio']." and obesity=".$_REQUEST['obesity']." and death = 0  and icu =".$_REQUEST['icu']." and renal_chronic=".$_REQUEST['renal_chronic']." and tobacco=".$_REQUEST['tobacco'];
			$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
			//echo $qry;
			if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_array($res)){ ?>
			 <div class="col-md-6 col-sm-12  col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><b>Chances of Survival</b></span>
                            
                        <span class="info-box-number"><?php echo $row['percentage']; ?></span>
                    </div>
                </div>
			</div>
			<?php }
				
			}else {?>
			<div class="col-md-6 col-sm-12  col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><b>Chances of Death</b></span>
                            
                        <span class="info-box-number"><?php echo "No Matching Cases Found"; ?></span>
                    </div> 
                </div>
			</div>
			<?php } ?>
			<?php $qry="select distinct no_of_cases,percentage from align.covid_data  where sex=".$_REQUEST['sex']." and intubed=".$_REQUEST['intubed']." and pneumonia=".$_REQUEST['pneumonia']."
				 and age=".$_REQUEST['age']." and diabetes=".$_REQUEST['diabetes']." and copd=".$_REQUEST['copd']." and asthma=".$_REQUEST['asthma']." and immsupr=".$_REQUEST['inmspr']." and hypertension=".$_REQUEST['hypertension']."
				  and other_disease=".$_REQUEST['other_disease']." and obesity=".$_REQUEST['obesity']." and cardiovascular = ".$_REQUEST['cardio']."  and death = 1 and icu =".$_REQUEST['icu']." and renal_chronic=".$_REQUEST['renal_chronic']." and tobacco=".$_REQUEST['tobacco'];
			$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
			//echo $qry;
			if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_array($res)){ ?>
			 <div class="col-md-6 col-sm-12  col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-coral"><i class="ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><b>Chances of Death</b></span>
                            
                        <span class="info-box-number"><?php echo $row['percentage']; ?></span>
                    </div>
                </div>
			</div>
			<?php }
			
			}?>
            </div>
        </div>
		<div >
                    <div id="chartcontainer" ></div>
                </div>
        <script>
		Highcharts.SVGRenderer.prototype.symbols.cross = function (x, y, w, h) {
    return ['M', x, y, 'L', x + w, y + h, 'M', x + w, y, 'L', x, y + h, 'z'];
};
if (Highcharts.VMLRenderer) {
    Highcharts.VMLRenderer.prototype.symbols.cross = Highcharts.SVGRenderer.prototype.symbols.cross;
}
		Highcharts.chart('chartcontainer', {

    title: {
        text: 'Workflow navigation by encounter'
    },
  credits: {
        enabled:false
    },
    subtitle: {
        text: ''
    },

    xAxis: {
        title: {
            text: 'Factors'
        },
		categories:['Nerve Damage', 'Pneumonia', 'Diabetes','COPD', 'Asthma','Osteoporosis', 'Hypertension', 'Other Disease','Cardiovascular','Obesity', 'Renal Chronic', 'Tobacco'],
		labels:{
			rotation:-40
		}
    },

    
	chart:{
		type:'column',
		inverted:false
	},
    legend: {
        layout: 'horizontal',
        align: 'right',
        verticalAlign: 'vertical'
    },
	tooltip :{
		enable:false
	},
    plotOptions: {
        series: {
            label: {
                connectorAllowed: true
            },
            pointStart: 0
        }
    },

    series: [{
        name: 'Chance of survival if changed',
        data: [<?php if($_REQUEST['intubed']==1) 
		{
			
			$qry="select distinct no_of_cases,percentage from align.covid_data  where sex=".$_REQUEST['sex']." and intubed=0 and pneumonia=".$_REQUEST['pneumonia']."
				 and age=".$_REQUEST['age']." and diabetes=".$_REQUEST['diabetes']." and copd=".$_REQUEST['copd']." and asthma=".$_REQUEST['asthma']." and immsupr=".$_REQUEST['inmspr']." and hypertension=".$_REQUEST['hypertension']."
				  and other_disease=".$_REQUEST['other_disease']." and cardiovascular = ".$_REQUEST['cardio']."  and obesity=".$_REQUEST['obesity']." and death = 0 and icu =".$_REQUEST['icu']." and renal_chronic=".$_REQUEST['renal_chronic']." and tobacco=".$_REQUEST['tobacco'];
			$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
			if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_array($res)){  
			echo $row['percentage'].",";
			}}else{
					echo "0,";
			}
		}else
		{	
		 echo "0,";
		}
		if($_REQUEST['pneumonia']==1) {
			
			$qry="select distinct no_of_cases,percentage from align.covid_data  where sex=".$_REQUEST['sex']." and intubed=".$_REQUEST['intubed']." and pneumonia=0
				 and age=".$_REQUEST['age']." and diabetes=".$_REQUEST['diabetes']." and copd=".$_REQUEST['copd']." and asthma=".$_REQUEST['asthma']." and immsupr=".$_REQUEST['inmspr']." and hypertension=".$_REQUEST['hypertension']."
				  and other_disease=".$_REQUEST['other_disease']."  and cardiovascular = ".$_REQUEST['cardio']."  and obesity=".$_REQUEST['obesity']." and death = 0 and icu =".$_REQUEST['icu']." and renal_chronic=".$_REQUEST['renal_chronic']." and tobacco=".$_REQUEST['tobacco'];
			$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
			if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_array($res)){  
				echo $row['percentage'].",";
			}}else{
					echo "0,";
			}
		}else
		{	
		 echo "0,";
		}
		 if($_REQUEST['diabetes']==1) {
			
			$qry="select distinct no_of_cases,percentage from align.covid_data  where sex=".$_REQUEST['sex']." and intubed=".$_REQUEST['intubed']." and pneumonia=".$_REQUEST['pneumonia']."
				 and age=".$_REQUEST['age']." and diabetes=0 and copd=".$_REQUEST['copd']." and asthma=".$_REQUEST['asthma']." and immsupr=".$_REQUEST['inmspr']." and hypertension=".$_REQUEST['hypertension']."
				  and other_disease=".$_REQUEST['other_disease']." and cardiovascular = ".$_REQUEST['cardio']."   and obesity=".$_REQUEST['obesity']." and death = 0 and icu =".$_REQUEST['icu']." and renal_chronic=".$_REQUEST['renal_chronic']." and tobacco=".$_REQUEST['tobacco'];
			$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
			if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_array($res)){  
			echo $row['percentage'].",";
			}}else{
					echo "0,";
			}
		}else
		{	
		 echo "0,";
		}
		if($_REQUEST['copd']==1) {
			
			$qry="select distinct no_of_cases,percentage from align.covid_data  where sex=".$_REQUEST['sex']." and intubed=".$_REQUEST['intubed']." and pneumonia=".$_REQUEST['pneumonia']."
				 and age=".$_REQUEST['age']." and diabetes=".$_REQUEST['diabetes']." and copd=0 and asthma=".$_REQUEST['asthma']." and immsupr=".$_REQUEST['inmspr']." and hypertension=".$_REQUEST['hypertension']."
				  and other_disease=".$_REQUEST['other_disease']." and cardiovascular = ".$_REQUEST['cardio']."   and obesity=".$_REQUEST['obesity']." and death = 0 and icu =".$_REQUEST['icu']." and renal_chronic=".$_REQUEST['renal_chronic']." and tobacco=".$_REQUEST['tobacco'];
			$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
			if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_array($res)){  
			echo $row['percentage'].",";
			}}else{
					echo "0,";
			}
		}else
		{	
		 echo "0,";
		}
		if($_REQUEST['asthma']==1) {
			
			$qry="select distinct no_of_cases,percentage from align.covid_data  where sex=".$_REQUEST['sex']." and intubed=".$_REQUEST['intubed']." and pneumonia=".$_REQUEST['pneumonia']."
				 and age=".$_REQUEST['age']." and diabetes=".$_REQUEST['diabetes']." and copd=".$_REQUEST['copd']." and asthma=0 and immsupr=".$_REQUEST['inmspr']." and hypertension=".$_REQUEST['hypertension']."
				  and other_disease=".$_REQUEST['other_disease']." and cardiovascular = ".$_REQUEST['cardio']."   and obesity=".$_REQUEST['obesity']." and death = 0 and icu =".$_REQUEST['icu']." and renal_chronic=".$_REQUEST['renal_chronic']." and tobacco=".$_REQUEST['tobacco'];
			$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
			if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_array($res)){  
			echo $row['percentage'].",";
			}}else{
					echo "0,";
			}
		}else
		{	
		 echo "0,";
		}
			?>
		<?php if($_REQUEST['inmspr']==1) {
			
			$qry="select distinct no_of_cases,percentage from align.covid_data  where sex=".$_REQUEST['sex']." and intubed=".$_REQUEST['intubed']." and pneumonia=".$_REQUEST['pneumonia']."
				 and age=".$_REQUEST['age']." and diabetes=".$_REQUEST['diabetes']." and copd=".$_REQUEST['copd']." and asthma=".$_REQUEST['asthma']." and immsupr=0 and hypertension=".$_REQUEST['hypertension']."
				  and other_disease=".$_REQUEST['other_disease']." and cardiovascular = ".$_REQUEST['cardio']."   and obesity=".$_REQUEST['obesity']." and death = 0 and icu =".$_REQUEST['icu']." and renal_chronic=".$_REQUEST['renal_chronic']." and tobacco=".$_REQUEST['tobacco'];
			$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
			if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_array($res)){  
			echo $row['percentage'].",";
			}}else{
					echo "0,";
			}
		}else
		{	
		 echo "0,";
		}
			?>
		<?php if($_REQUEST['hypertension']==1) {
			
			$qry="select distinct no_of_cases,percentage from align.covid_data  where sex=".$_REQUEST['sex']." and intubed=".$_REQUEST['intubed']." and pneumonia=".$_REQUEST['pneumonia']."
				 and age=".$_REQUEST['age']." and diabetes=".$_REQUEST['diabetes']." and copd=".$_REQUEST['copd']." and asthma=".$_REQUEST['asthma']." and immsupr=".$_REQUEST['inmspr']." and hypertension=0
				  and other_disease=".$_REQUEST['other_disease']."  and cardiovascular = ".$_REQUEST['cardio']."  and obesity=".$_REQUEST['obesity']." and death = 0 and icu =".$_REQUEST['icu']." and renal_chronic=".$_REQUEST['renal_chronic']." and tobacco=".$_REQUEST['tobacco'];
			$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
			if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_array($res)){  
			echo $row['percentage'].",";
			}}else{
					echo "0,";
			}
		}else
		{	
		 echo "0,";
		}
			?>
		<?php if($_REQUEST['other_disease']==1) {
			
			$qry="select distinct no_of_cases,percentage from align.covid_data  where sex=".$_REQUEST['sex']." and intubed=".$_REQUEST['intubed']." and pneumonia=".$_REQUEST['pneumonia']."
				 and age=".$_REQUEST['age']." and diabetes=".$_REQUEST['diabetes']." and copd=".$_REQUEST['copd']." and asthma=".$_REQUEST['asthma']." and immsupr=".$_REQUEST['inmspr']." and hypertension=".$_REQUEST['hypertension']."
				  and other_disease=0 and obesity=".$_REQUEST['obesity']." and cardiovascular = ".$_REQUEST['cardio']."   and death = 0 and icu =".$_REQUEST['icu']." and renal_chronic=".$_REQUEST['renal_chronic']." and tobacco=".$_REQUEST['tobacco'];
			$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
			if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_array($res)){  
			echo $row['percentage'].",";
			}}else{
					echo "0,";
			}
		}else
		{	
		 echo "0,";
		}if($_REQUEST['cardio']==1) {
			
			$qry="select distinct no_of_cases,percentage from align.covid_data  where sex=".$_REQUEST['sex']." and intubed=".$_REQUEST['intubed']." and pneumonia=".$_REQUEST['pneumonia']."
				 and age=".$_REQUEST['age']." and diabetes=".$_REQUEST['diabetes']." and copd=".$_REQUEST['copd']." and asthma=".$_REQUEST['asthma']." and immsupr=".$_REQUEST['inmspr']." and hypertension=".$_REQUEST['hypertension']."
				  and other_disease=".$_REQUEST['other_disease']." and and cardiovascular = 0   obesity=".$_REQUEST['obesity']." and death = 0 and icu =".$_REQUEST['icu']." and renal_chronic=".$_REQUEST['renal_chronic']." and tobacco=".$_REQUEST['tobacco'];
			$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
			if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_array($res)){  
			echo $row['percentage'].",";
			}}else{
					echo "0,";
			}
		}else
		{	
		 echo "0,";
		}
		if($_REQUEST['obesity']==1) {
			
			$qry="select distinct no_of_cases,percentage from align.covid_data  where sex=".$_REQUEST['sex']." and intubed=".$_REQUEST['intubed']." and pneumonia=".$_REQUEST['pneumonia']."
				 and age=".$_REQUEST['age']." and diabetes=".$_REQUEST['diabetes']." and copd=".$_REQUEST['copd']." and asthma=".$_REQUEST['asthma']." and immsupr=".$_REQUEST['inmspr']." and hypertension=".$_REQUEST['hypertension']."
				  and other_disease=".$_REQUEST['other_disease']." and  cardiovascular = ".$_REQUEST['cardio']."  and obesity=0 and death = 0 and icu =".$_REQUEST['icu']." and renal_chronic=".$_REQUEST['renal_chronic']." and tobacco=".$_REQUEST['tobacco'];
			$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
			if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_array($res)){  
			echo $row['percentage'].",";
			}}else{
					echo "0,";
			}
		}else
		{	
		 echo "0,";
		}
			 if($_REQUEST['renal_chronic']==1) {
			
			$qry="select distinct no_of_cases,percentage from align.covid_data  where sex=".$_REQUEST['sex']." and intubed=".$_REQUEST['intubed']." and pneumonia=".$_REQUEST['pneumonia']."
				 and age=".$_REQUEST['age']." and diabetes=".$_REQUEST['diabetes']." and copd=".$_REQUEST['copd']." and asthma=".$_REQUEST['asthma']." and immsupr=".$_REQUEST['inmspr']." and hypertension=".$_REQUEST['hypertension']."
				  and other_disease=".$_REQUEST['other_disease']." and  cardiovascular = ".$_REQUEST['cardio']." and  obesity=".$_REQUEST['obesity']." and death = 0 and icu =".$_REQUEST['icu']." and renal_chronic=0 and tobacco=".$_REQUEST['tobacco'];
			$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
			if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_array($res)){  
			echo $row['percentage'].",";
			}}else{
					echo "0,";
			}
		}else
		{	
		 echo "0,";
		}
		if($_REQUEST['tobacco']==1) {
			
			$qry="select distinct no_of_cases,percentage from align.covid_data  where sex=".$_REQUEST['sex']." and intubed=".$_REQUEST['intubed']." and pneumonia=".$_REQUEST['pneumonia']."
				 and age=".$_REQUEST['age']." and diabetes=".$_REQUEST['diabetes']." and copd=".$_REQUEST['copd']." and asthma=".$_REQUEST['asthma']." and immsupr=".$_REQUEST['inmspr']." and hypertension=".$_REQUEST['hypertension']."
				  and other_disease=".$_REQUEST['other_disease']." and cardiovascular = ".$_REQUEST['cardio']." and   obesity=".$_REQUEST['obesity']." and death = 0 and icu =".$_REQUEST['icu']." and renal_chronic=".$_REQUEST['renal_chronic']." and tobacco=0";
			$res=mysqli_query($link,$qry) or  die(mysqli_error($link));
			if(mysqli_num_rows($res)>0){
			while($row=mysqli_fetch_array($res)){  
			echo $row['percentage'].",";
			}}else{
					echo "0,";
			}
		}else
		{	
		 echo "0,";
		}
			?>
		
		],
		color: '#55ed23',
		lineWidth: 5
    }
       ],

    

});
    </script>

    
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
  
    <script src="action.js"></script>
  </body>
</html>