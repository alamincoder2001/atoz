<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('backend')}}/assets/libs/jquery/dist/jquery.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('backend')}}/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="{{asset('backend')}}/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="{{asset('backend')}}/dist/js/sidebarmenu.js"></script>
<script src="{{asset('backend')}}/assets/extra-libs/DataTables/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@stack("js")
<script src="{{asset('backend')}}/dist/js/notify.js"></script>
<script src="{{asset('backend')}}/dist/js/custom.min.js"></script>
<script>
    $("#datatable").DataTable();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>