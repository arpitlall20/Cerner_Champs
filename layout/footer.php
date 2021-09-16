 <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
              All rights reserved.
            </div>
            <!-- Default to the left -->
            <strong>Developed By <a href="https://www.cerner.com/">Cerner Corporation</a></strong> 
        </footer>
	
    </div><!-- ./wrapper -->
	<div id="spinner"></div>
    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="../../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../assets/js/app.js"></script>
    <!-- Slimscroll -->
    <script src="../../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- iCheck -->
    <script src="../../assets/plugins/iCheck/icheck.min.js"></script>
    <!-- DataTables -->
    <script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Multiselect -->
    <script src="../../assets/plugins/chosen-multiselect/chosen.jquery.js"></script>
    <script src="../../assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Date Time Picker -->
    <script src="../../assets/plugins/daterangepicker/moment.min.js"></script>
    <script src="../../assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Spinner -->
    <script type="text/javascript">
    var spinnerVisible = false;
    function showProgress() { 
        if (!spinnerVisible) {
            $("div#spinner").fadeIn("fast");
            spinnerVisible = true;
        }
    };
    function hideProgress() {
        if (spinnerVisible) {
            var spinner = $("div#spinner");
            spinner.stop();
            spinner.fadeOut("fast");
            spinnerVisible = false;
        }
    };
	showProgress();
	</script>
    <script>
      $(function () {
        $('input[type=checkbox]').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue',
        });
		$(".multi-select").chosen();
		$(".multi-select-max4").chosen({max_selected_options: 4});
		$('.date').datetimepicker({
			maxDate: new Date(),
			format: 'DD-MM-YYYY'
		});
		$('.dateranage').datetimepicker({
			format: 'DD-MM-YYYY'
		});
        $('.datetime').datetimepicker({
			format: 'DD-MM-YYYY H:mm:ss'
		});
        $('.datetimehour').datetimepicker({
			format: 'hh:mm:00 A' 
		});
		$('#startdate').datetimepicker();
		$('#enddate').datetimepicker({
			useCurrent: false ,//Important! See issue #1075
			
		});
		$("#startdate").on("dp.change", function (e) {
			$('#enddate').data("DateTimePicker").minDate(e.date);
			$("#enddate").val("");
		});
		$('#from_date').datetimepicker({
			format: 'DD-MM-YYYY'
		});
		$('#to_date').datetimepicker({ 
			useCurrent: false, //Important! See issue #1075
			format: 'DD-MM-YYYY',
			maxDate: new Date(),
		});
		$('#from_month').datetimepicker({
			format: 'MMM YY'
		});
		$('#to_month').datetimepicker({
			useCurrent: false, //Important! See issue #1075
			format: 'MMM YY',
			maxDate: new Date(),
		});
		$("#from_date").on("dp.change", function (e) {
			$('#to_date').data("DateTimePicker").minDate(e.date);
			$("#to_date").val("");
		});
		$('.monthPicker').datetimepicker({
			format: 'MMM YY'
		});
		$('#checkin_date').datetimepicker({
			format: 'DD-MM-YYYY hh:mm A'
		});
		$('#checkout_date').datetimepicker({
			useCurrent: false, //Important! See issue #1075
			format: 'DD-MM-YYYY hh:mm A',
			minDate: new Date(),
		});
		
		hideProgress();
      });
	  
    </script>
	 
