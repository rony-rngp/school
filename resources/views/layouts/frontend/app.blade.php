<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - AL HERA SHISHU ACADEMY</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/bootstrap.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/animate.css">
    <!-- fontawesome icon CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/fontawesome/css/all.min.css">
    <!-- Multislider CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/multislider.css">
     <link rel="icon" href="{{ url('public/backend/upload/logo.png') }}" sizes="16x16" type="image/png"> 
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/style.css">
    <!-- toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

    @stack('css')

</head>
<body>
<!-- Header menu -->
@include('layouts.frontend.partial.header')
<!-- End of header menu -->

@yield('content')

<!-- footer area -->
@include('layouts.frontend.partial.footer')
<!-- footer area -->


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('public/frontend') }}/assets/js/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="{{ asset('public/frontend') }}/assets/js/bootstrap.min.js"></script>
<!-- jquery-validation -->
<script src="{{ asset('public/backend') }}/plugins/jquery-validation/jquery.validate.js"></script>
<script src="{{ asset('public/backend') }}/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- animated JS -->
<script src="{{ asset('public/frontend') }}/assets/js/wow.min.js"></script>
<!-- Multislider JS -->
<script src="{{ asset('public/frontend') }}/assets/js/multislider.min.js"></script>
<!-- fontawesome icon JS -->
<script src="{{ asset('public/frontend') }}/assets/fontawesome/js/all.min.js"></script>
<!-- Custom JS -->
<script>
    // Bootstrap carousel (Header slider)
    $('#headerCarousel').carousel({
        pause: false,
    });

    // animated JS
    new WOW().init();

    // Multislider
    $('#recentNotice').multislider({
        interval: 4000,

        duration: 17000,
        continuous: true
    });
</script>

<!--Toastr-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
        @if(Session::has('messege'))
    var type="{{ Session::get('alert-type', 'info') }}"
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('messege') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('messege') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('messege') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('messege') }}");
            break;
    }
    @endif
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#image').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showImage').attr('src', e.target.result)
            };
            reader.readAsDataURL(e.target.files[0]);
        })
    })
</script>
@stack('js')
</body>
</html>
