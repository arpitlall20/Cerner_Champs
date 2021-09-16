// JavaScript Document
var oTable;
var isDelete = false;
$(function(){
	

	
oTable = $('.dataTable').DataTable({
  "paging": true,
  "lengthChange": false,
  "searching": true,
  "ordering": true,
  "info": true,
  "autoWidth": false,
  "dom" : 'tp',
  "order": [[ 0, "asc" ]]
});
$('#dataSearch').keyup(function(){
	 oTable.search($(this).val()).draw() ;
});
$(".dataTable").on('click', ".editUser", function() {
    var $row = jQuery(this).closest('tr');
    var $columns = oTable.row($row).data(); //console.log($columns);
	$('#updateform').show();
	$('#mode').val('update');
	$('#unitnumber').val($columns[0]);
	$('#unitcode').val($columns[1]); 
	$('#unitblock').val($columns[5]);
	$('#unitsize').val($columns[6]);
	$('#unitbillablearea').val($columns[7]);
	$('#unitdirection').val($columns[8]);
	$('#unitkeydate').val($columns[9]);
	$('#unitservicestartdate').val($columns[10]);
	$('#unitebno').val($columns[11]);
	$('#unittaxno').val($columns[12]);
	$('#unitfloorno').val($columns[13]);
	$('#unittotalfloors').val($columns[14]);
	$('#unittotaltoilets').val($columns[15]);
	$('#unitparking').val($columns[16]);
	$('#unittotalparkings').val($columns[17]); //console.log($columns[19]);
	$('#unitparkingtype').val($columns[18].replace("&amp;","&"));
	
	 
	//$('#unitnote').val($columns[20]);
	$('#status').val($columns[20]);
    $('#unitproject').val($columns[21]);
    $('#unittype').val($columns[22]);
    $('#unitid').val($columns[23]);
    $('#unitconfiguration').val($columns[24]);
	$('#unit_classification').val($columns[25]);
	$('select').trigger("chosen:updated"); 	
	
	$("#unit_form").show();
	$('#unit_files').hide();
	$('#unitfilelist').html('');
	$(".btnSave").show();
	$(".btnDocuments").hide();
	
	if($(this).attr('id')=='editDocuments'){
		$("#unit_form").hide();
		$('#unit_files').show();
		$('#unitfilelist').html('');
		$(".btnSave").hide();
		$(".btnDocuments").show();
		file_uploads('view');
        $('#updateform').show();
        $('#createform').hide();
	}
    $('#createform').hide();
	
});
$(".dataTable").on('click', ".deleteUser", function() {
    var $row = jQuery(this).closest('tr');
    var $columns = oTable.row($row).data();	
	$('#mode').val('delete');
	$('#unitid').val($columns[23]);
	if(confirm("Are you sure to delete?")){
		isDelete = true;
		save();
	}
});


$('#unitgroup').change(function() {
	 if(!$("#sex").val()){
	 alert('Please select project');
	 return;
	 }
	 
	 else {
		
        this.form.submit();
		console.log($(this).val());
	 }
	});
$('#encounter').change(function() {
	console.log($(this).val());
	 if(!$("#unitgroup").val()){
	 alert('Please select User');
	 return;
	 }
	 else {
		
        this.form.submit();
		console.log($(this).val());
	 }
	});
});


function showForm(){
	$('#dataHolder').hide();
    $('#createform').show(); 
    $('#updateform').hide();
	$('#dataForm').find("input[type=text], input[type=email], input[type=number], input[type=password], textarea").val("");
	$('#dataForm').find('select').val(''); $('#dataForm').find('select').trigger("chosen:updated");
	$('#unitid').val(0);
	$('#mode').val('create');
	$('#formHolder').show();
	$('#status').val('Active'); $('#status').trigger("chosen:updated");
	$("#unit_form").show();
	$('#unit_files').hide();
	$('#unitfilelist').html('');
	$(".btnSave").show();
	$(".btnDocuments").hide();
	isDelete = false;
}
function hideForm(){
	$('#dataHolder').show();
	$('#formHolder').hide();
}

function save(){
	//var unitnote = $("#cke_unitnote").find(".cke_wysiwyg_frame").contents().find(".cke_editable").html(); 
	//var unitnote = $("#unitnote").val();
	if(!validate() && !isDelete) {
		alert('Please fill all *required fields');
		return;
	}
	showProgress();
	this.form.submit();
	hideProgress();
}

function validate(){
	if(!$('#sex').prop('selectedIndex')){
		return false;
	}
	
	if(!$('#intubed').prop('selectedIndex')){
		return false;
	}
	if(!$('#pneumonia').prop('selectedIndex')){
		return false;
	}
	if(!$('#age').prop('selectedIndex')){
		return false;
	}
	if(!$('#diabetes').prop('selectedIndex')){
		return false;
	}
	if(!$('#copd').prop('selectedIndex')){
		return false;
	}
	if(!$('#asthma').prop('selectedIndex')){
		return false;
	}
	if(!$('#inmspr').prop('selectedIndex')){
		return false;
	}
	
	if(!$('#hypertension').prop('selectedIndex')){
		return false;
	}
	if(!$('#other_disease').prop('selectedIndex')){
		return false;
	}
	if(!$('#obesity').prop('selectedIndex')){
		return false;
	}
	if(!$('#cardio').prop('selectedIndex')){
		return false;
	}
	if(!$('#renal_chronic').prop('selectedIndex')){
		return false;
	}
	if(!$('#tobacco').prop('selectedIndex')){
		return false;
	}
	if(!$('#icu').prop('selectedIndex')){
		return false;
	}
	return true;
}

function file_uploads(action){
	var file_data = $('#file').prop('files')[0];   
	var form_data = new FormData();                  
	form_data.append('file', file_data);
	var id = $("#unitid").val();
	var filedesc = $("#filedesc").val();
	if(id!='')
	{
		showProgress();
		$.ajax({
					url: 'action.php?mode=upload&id='+id+'&filedesc='+filedesc+'&action='+action, // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                         
					type: 'post',
					success: function(result){
						$("#unitfilelist").html(result);
						$("#filedesc").val('');
						$("#file").val('');
						hideProgress();
					}
		 });
	}
}

function delete_file(id,filename)
{
	
	if(filename!='' && id!='')
	{
		showProgress();
		$.ajax({
				url: 'action.php', // point to server-side PHP script 
				dataType: 'text',  // what to expect back from the PHP script, if anything
				data: 'mode=upload&id='+id+'&filename='+filename+'&action=delete',                         
				type: 'post',
				success: function(result){
					$("#unitfilelist").html(result);
					$("#filedesc").val('');
					$("#file").val('');
					hideProgress();
				}
	 });
	}
}
