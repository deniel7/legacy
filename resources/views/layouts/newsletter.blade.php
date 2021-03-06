<!doctype html>
<html>
<head>
    @include('includes.head-newsletter')
</head>
<body id="page-top" class="index">
    <!-- Navigation -->
    <header>
    @include('includes.navbar')
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
    

    <!-- Contact Form JavaScript -->
    <script src="{{asset('front/agency/js/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('front/agency/js/contact_me.js')}}"></script>
    

    <!-- Theme JavaScript -->
     <script src="{{asset('front/agency/js/agency.min.js')}}"></script>
    
    <script type="text/javascript">
        var $item = $('.carousel .item'); 
        var $wHeight = $(window).height();
        $item.eq(0).addClass('active');
        $item.height($wHeight); 
        $item.addClass('full-screen');

        $('.carousel img').each(function() {
          var $src = $(this).attr('src');
          var $color = $(this).attr('data-color');
          $(this).parent().css({
            'background-image' : 'url(' + $src + ')',
            'background-color' : $color
          });
          $(this).remove();
        });

        $(window).on('resize', function (){
          $wHeight = $(window).height();
          $item.height($wHeight);
        });

        $('.carousel').carousel({
          interval: 6000,
          pause: "false"
        });
    </script>
</body>
</html>

