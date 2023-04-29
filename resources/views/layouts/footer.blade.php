<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('toastr.min.js')}}"></script>
<!-- App js -->
<script src="assets/js/app.js"></script>

@if (session('error'))
<p style="color: red" id="error" data-title="{{ session('error')['message_title'] }}" data-message="{{ session('error')['message'] }}"></p>
@endif
@if (session('success'))
<p style="color: green" id="success" data-title="{{ session('success')['message_title'] }}" data-message="{{ session('success')['message'] }}"></p>
@endif

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
