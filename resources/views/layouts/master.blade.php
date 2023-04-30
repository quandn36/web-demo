<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body>
    @yield('content')

    <!-- JAVASCRIPT -->
    @include('layouts.footer')

    <script>
        $(document).ready(function(){
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "10000",
                "extendedTimeOut": "10000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "slideDown",
                "hideMethod": "fadeOut",
            };
            if($("#error").length){
                toastr.error($("#error").data('message'));
            }
            if($("#warning").length){
                toastr.warning($("#warning").data('message'));
            }
            if($("#success").length){
                toastr.success($("#success").data('message'));
            }
            if($("#success2").length){
                toastr.success($("#success2").data('message'));
            }
        });
    </script>
    @yield('scripts')
</body>

</html>
