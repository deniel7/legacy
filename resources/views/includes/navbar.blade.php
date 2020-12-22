<div class="container">
    <nav class="navbar navbar-default" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <img id="logo-main" src="{{asset('front/agency/img/logo.png')}}" alt="Legacy Wedding Organizer"><br/><br/>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
          <li>
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <!-- <li>
                        <a href="#portfolio">Special Day</a>
                    </li> -->
                    <li>
                      <a href="{{ url('/newsletter') }}">Newsletter</a>
                    </li>
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
          
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav>




</div>