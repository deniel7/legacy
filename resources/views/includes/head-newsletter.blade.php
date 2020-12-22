<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <title>Legacy Wedding Organizer</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('front/agency/css/bootstrap.css')}}" rel="stylesheet">

    
    <!-- Theme CSS -->
    {{-- <link href="{{asset('front/future-imperfect/css/main.css')}}" rel="stylesheet"> --}}
    <link href="{{asset('front/agency/css/agency.css')}}" rel="stylesheet">

    
<!--     Membuat scrollable sidebar Client  -->
    <script type="text/javascript">
    var topNavBar = 50;
    var footer = 48;
    var height = $(window).height();
    $('.sidebar').css('height', (height - (topNavBar+footer)));

    $(window).resize(function(){
        var height = $(window).height();
        $('.sidebar').css('height', (height - (topNavBar+footer)));
    });


    var elements = document.getElementsById('a');
    for(var i = 1; i < elements.length; i++) {
        elements[i].onclick = function() {
            var hash = this.hash.substr(1),
                elementTop = document.getElementById(hash).offsetTop;
            window.scrollTo(0, elementTop + 125);
            window.location.hash = '';
            return false;
        }
    }
    </script>
    <style>

    .sidebar{
    overflow-y: scroll;
    position: fixed;
}


    .gambar {
    width: 350px;
    min-height: 350px;
    max-height: auto;
    float: left;
    margin: 3px;
    padding: 3px;
}

    .hl {
    border-bottom: 1px solid #d5c0b4;;
    width: 400px;
    margin:0 auto;
    margin-bottom: 40px;
    }

  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 100%;
      margin: auto;
  }



.navbar-inverse .navbar-toggle-always {
  border-color: #333333;
}
.navbar-inverse .navbar-toggle-always:hover,
.navbar-inverse .navbar-toggle-always:focus {
  background-color: #333333;
}
.navbar-inverse .navbar-toggle-always .icon-bar-always {
  background-color: #ffffff;
}
.navbar-toggle-always {
  position: relative;
  float: right;
  margin-right: 15px;
  padding: 9px 10px;
  margin-top: 8px;
  margin-bottom: 8px;
  background-color: transparent;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px;
  margin-left: 0;
  margin-right: 0;
}
.navbar-toggle-always:focus {
  outline: 0;
}
.navbar-toggle-always .icon-bar {
  display: block;
  width: 22px;
  height: 2px;
  border-radius: 1px;
}
.navbar-toggle-always .icon-bar + .icon-bar {
  margin-top: 4px;
}
@media (min-width: 768px) {
  .navbar-toggle-always {
    display: none;
  }
}
@media (min-width: 768px) {
  .navbar-toggle-always {
    display: block!important;
    background-color: transparent;
    border: 1px solid #333333;
  }
}
.navbar-toggle-always .icon-bar-always {
  width: 22px;
  height: 2px;
  border: 1px solid #fff;
  display: block;
  border-radius: 1px;
}
.navbar-toggle-always .icon-bar-always + .icon-bar-always {
  margin-top: 4px;
}
.App_logo {
  color: #6C71C4;
  font-size: 29px;
  font-family: "Times New Roman", Times, serif;
  z-index: 2000000;
}
.App_logo_plus {
  color: #f1f1f1;
  font-family: "Times New Roman", Times, serif;
  font-size: 23px;
  z-index: 2000000;
}
/* Globals */
.ellipsis {
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}
.white {
  background-color: #ffffff !important;
}
 .centered{
    margin: 0 auto;
}
.red {
  background-color: #db2027;
  color: #ffffff;
}
.green {
  background-color: #5cb85c;
  color: #ffffff;
}
.orange {
  background-color: #f0ad4e;
  color: #ffffff;
}
.text-red {
  color: #db2027;
}
.gold {
  color: #ffd700 !important;
}
.gray {
  color: #d5d5d5;
}
.clear {
  clear: both;
}
.caption {
  padding: 5px;
}
.padding-right-0 {
  padding-right: 0;
}
.padding-left-0 {
  padding-left: 0;
}
.margin-bottom-5 {
  margin-bottom: 5px !important;
}
.margin-bottom-7 {
  margin-bottom: 7px !important;
}
.margin-bottom-20 {
  margin-bottom: 20px !important;
}
.margin-bottom-10 {
  margin-bottom: 10px !important;
}
.margin-bottom-13 {
  margin-bottom: 13px !important;
}
.margin-bottom-15 {
  margin-bottom: 15px !important;
}
.zero-margins {
  margin-left: 0;
  margin-right: 0;
}
.margin-right-5 {
  margin-right: 5px;
}
.min-height-90 {
  min-height: 90px;
}
.min-height-240 {
  min-height: 240px;
}
.width-0 {
  width: 0%;
}
.cursor-pointer {
  cursor: pointer;
}
.full-width {
  width: 100% !important;
}
.center {
  text-align: center;
}
.default_background_color {
  background-color: #ffffff;
}
.nav-center {
  margin: 0;
  float: none;
}
.navbar-inner {
  text-align: center;
}


</style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->