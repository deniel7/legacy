<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Legacy Wedding Organizer</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('front/agency/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- jQuery 2.1.4 -->
  <script src="{{ asset('bower_components/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    
    <!-- Theme CSS -->
    <link href="{{asset('front/agency/css/agencyclient.css')}}" rel="stylesheet">
    <!-- Datepicker -->
  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datepicker/datepicker3.css') }}">
    <style>

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
  font-family: 'Days One', sans-serif;
  z-index: 2000000;
}
.App_logo_plus {
  color: #f1f1f1;
  font-family: 'verdana', sans-serif;
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