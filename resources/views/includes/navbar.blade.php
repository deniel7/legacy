<nav class="navbar navbar-default container-fluid">
  <div class="container">
    <div class="navbar-header">
      <div class="pull-left " style="margin-top:60px">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#left">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      </div>

      <div class="navbar-inner visible-xs">
        <div class="nav-center">
         <a href="/" ><span class="App_logo_plus"></span><span class="App_logo"><img src="{{asset('front/agency/img/logo_mbl.png')}}"/></span></a>
        </div>
      </div>

    </div>


    <div class="collapse navbar-collapse" id="yo">

          <div class="pull-left ">
            <button type="button" class="navbar-toggle-always collapsed" data-toggle="collapse" data-target="#left" aria-expanded="false" aria-controls="navbar">
              <span class="icon-bar-always"></span>
              <span class="icon-bar-always"></span>
              <span class="icon-bar-always"></span>
            </button>
          </div>

      <div class="navbar-inner hidden-xs">
        <div class="nav-center"><br/>
         <a href="/" ><span class="App_logo_plus"></span><span class="App_logo"><img src="{{asset('front/agency/img/logo.png')}}"/></span></a>
        </div>
      </div>

    </div>

    <div class="collapse" id="left" style="position:absolute;z-index:100;margin-top:-98px">
      <ul class="nav">
          
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    @if (Auth::user()->get())
                    

                    @else
                    <li>
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <!-- <li>
                        <a href="#portfolio">Special Day</a>
                    </li> -->
                    <li>
                        <a href="{{ url('/project') }}">Project</a>
                    </li>
                    
                    <li>
                        <a href="{{ url('/client') }}">Client</a>
                    </li>
                    <li>
                        <a href="{{ url('/about') }}">About</a>
                    </li>
                    <li>
                        <a href="{{ url('/contact') }}">Contact</a>
                    </li>
                    @endif
               
      </ul>
    </div>

  </div>
</nav>