<script src="../../doc/template/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
{{-- <script src="../../doc/template/vendors/chart.js/Chart.min.js"></script>
<script src="../../doc/template/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="../../doc/template/vendors/progressbar.js/progressbar.min.js"></script> --}}
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../../doc/template/js/off-canvas.js"></script>
<script src="../../doc/template/js/hoverable-collapse.js"></script>
<script src="../../doc/template/js/template.js"></script>
<script src="../../doc/template/js/settings.js"></script>
<script src="../../doc/template/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="../../doc/template/js/jquery.cookie.js" type="text/javascript"></script>
<script src="../doc/template/js/dashboard.js"></script>
<script src="../doc/template/js/Chart.roundedBarCharts.js"></script>
{{-- toastr and jquery --}}
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
{{-- datatable --}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
{{-- sweatalert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>


    var loader = document.getElementById('preloader');
    window.addEventListener("load", function(){
        loader.style.display = "none";
    })
    $(document).ready( function () {
    toastr.options.timeOut = 10000;
        @if (Session::has('error'))
        toastr.error('{{ Session::get('error') }}');
        @elseif(Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif
$('#hapus').click(function() {
        Swal.fire(
        'Oke',
        'Data Berhasil Di hapus',
        'info'
        );
    })
    $('#id_table').DataTable();
} );
</script>


