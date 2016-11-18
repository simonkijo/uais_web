</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- UAIS App -->
<script src="dist/js/app.min.js"></script>
<!-- ckeditor -->
<script src="plugins/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!--front end validation-->
<script src="dist/js/profileValidation.js"></script>
<script src="dist/js/adminProfileValidation.js"></script>
<!--smartWizard-->
<script src="dist/js/jquery.smartWizard.js"></script>
<script src="dist/js/custom.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
	//dataTables  
	$('.tble').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
	//Add text editor
    $("#compose_textarea").wysihtml5();
	//Initialize Select2 Elements
    $(".select2").select2();
	// Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
	CKEDITOR.replace('editor1');
	CKEDITOR.replace('editor2');
	CKEDITOR.config.uiColor="#39CCCC"; //#39CCCC #CCEAEE
	//handle error removal
	$('.i_remove').keyup(function(){
		$('.a_remove').fadeOut();
	});
	
	//Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });
	//add attribute individually for grabbing value to delete
	$("input[type='checkbox']").each(function(i) {
		var thisCheckbox=$(this);
		thisCheckbox.iCheck({
			checkboxClass: 'icheckbox_flat-blue'
		});
		
		thisCheckbox.on('ifChecked', function(e){
			$(".addAttr_"+i).attr('name','sms[]');
		});
		thisCheckbox.on('ifUnchecked', function(e){
			$(".addAttr_"+i).removeAttr('name');
		});
	});
  });
</script>
<!-- jQuery Smart Wizard -->
<script>
  $(document).ready(function() {
	$('#wizard').smartWizard();
	$('.buttonNext').addClass('btn btn-success');
	$('.buttonPrevious').addClass('btn btn-primary');
	//$('.buttonFinish').addClass('btn btn-default');
  });
</script>
<!-- /jQuery Smart Wizard -->
<!--keep clicked tab active even if page refresh-->
<script type="text/javascript">
$(document).ready(function(){
	$('a[name="tab_l"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
	});
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab){
		$('#myTab a[href="' + activeTab + '"]').tab('show');
	}
	//for academic uploads tab within tabs
	$('a[name="tab_l_au"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab_l_au', $(e.target).attr('href'));
	});
	var activeTab_l_au = localStorage.getItem('activeTab_l_au');
	if(activeTab_l_au){
		$('#myTab_l_au a[href="' + activeTab_l_au + '"]').tab('show');
	}
	//for send assignment tab within tabs
	$('a[name="tab_l_sa"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab_l_sa', $(e.target).attr('href'));
	});
	var activeTab_l_sa = localStorage.getItem('activeTab_l_sa');
	if(activeTab_l_sa){
		$('#myTab_l_sa a[href="' + activeTab_l_sa + '"]').tab('show');
	}
});
</script>
<!--end of keep clicked tab active even if page refresh-->
<script>
	function countFileChosenInAcademicUploads(){
		var x = document.getElementById("file_ct");
		var suffix = "";
		var ct = "";
		if ('files' in x) {
			if(x.files.length == 1){
				suffix = "";
			}else{
				suffix = "s";
			}
			ct = x.files.length+" file"+suffix+" chosen";
		}
		document.getElementById("file_ct_txt").innerHTML = ct;
	}
	function countFileChosenInAssignment(){
		var y = document.getElementById("file_ct2");
		var suffix = "";
		var ct2 = "";
		if ('files' in y) {
			if(y.files.length == 1){
				suffix = "";
			}else{
				suffix = "s";
			}
			ct2 = y.files.length+" file"+suffix+" chosen";
		}
		document.getElementById("file_ct_txt2").innerHTML = ct2;
	}
</script>
</body>
</html>