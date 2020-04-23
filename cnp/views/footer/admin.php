</div>
<!-- /.container -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="container">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2018 ICT - Politeknik LP3I Jakarta Kampus Pondok Gede.</strong> All rights
    reserved.
  </div>
  <!-- /.container -->
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url();?>assets/select2/dist/js/select2.full.min.js"></script>
<!-- Datatables -->
<script src="<?php echo base_url(); ?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/fastclick/lib/fastclick.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/js/demo.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url(); ?>assets/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>assets/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>assets/input-mask/jquery.inputmask.extensions.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url();?>assets/timepicker/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 3000);
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    $('#example1').DataTable();
    $('#example2').DataTable({
      'scrollX': true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      'responsive' : true
    });
    $('#example3').DataTable({
      'scrollX': true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      'responsive' : true
    });
    $('#basicDTables').DataTable({
      'scrollX': true,
      'paging'      : false,
      'lengthChange': true,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : true,
      'responsive' : true
    });
    $('#advanceDTables').DataTable({
      'scrollX': true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'responsive' : true,
      'columnDefs' : [
            { "orderable": false, "targets": 'no-sort' }
        ]
    });
    //Timepicker
    $('.timepicker').timepicker({
      showMeridian: false,
      showInputs: false
    });

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
    //Date picker
    $('#datepicker2').datepicker({
      autoclose: true
    });
    //Date picker
    $('.datepicker').datepicker({
      autoclose: true
    });
  });
</script>
</body>
</html>
