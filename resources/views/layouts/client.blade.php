<!doctype html>
<html>
  <head>
    @include('includes.headclient')
  </head>
  <body id="page-top" class="index">
    
    <div>
      <div class="row">
       
        <!-- Menu -->
        @include('includes.sidemenu')
        <!-- Main Content -->
        <div class="container-fluid">
          <div class="side-body">
            
            @yield('content')
            
          </div>
        </div>
      </div>
    </div>
    
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
    $(function () {
    $('.navbar-toggle').click(function () {
    $('.navbar-nav').toggleClass('slide-in');
    $('.side-body').toggleClass('body-slide-in');
    $('#search').removeClass('in').addClass('collapse').slideUp(200);
    /// uncomment code for absolute positioning tweek see top comment in css
    //$('.absolute-wrapper').toggleClass('slide-in');
    
    });
    
    // Remove menu for searching
    $('#search-trigger').click(function () {
    $('.navbar-nav').removeClass('slide-in');
    $('.side-body').removeClass('body-slide-in');
    /// uncomment code for absolute positioning tweek see top comment in css
    //$('.absolute-wrapper').removeClass('slide-in');
    });
    });
    </script>
  </body>
</html>