
<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body id="page-top" class="index">
    <!-- Navigation -->
    
    @include('includes.navbar')
    
    <header>
        @include('includes.header')
    </header>

    

            @yield('content')

    

    <footer id="myFooter">
        @include('includes.footer')
    </footer>
<!-- jQuery -->
    <script src="{{asset('front/agency/js/vendor/jquery/jquery.min.js')}}"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('front/agency/js/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="{{asset('front/agency/js/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('front/agency/js/contact_me.js')}}"></script>
    

    <!-- Theme JavaScript -->
     <script src="{{asset('front/agency/js/agency.min.js')}}"></script>
    
    
</body>
</html>

