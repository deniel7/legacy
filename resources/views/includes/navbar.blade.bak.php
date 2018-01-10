<div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" style="margin-top:-10px" href="#page-top"><img src="{{asset('front/agency/img/legacy.jpg')}}"/></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    @if (Auth::user()->get())
                    

                    @else
                    <li>
                        <a class="page-scroll" href="{{ url('/') }}">Home</a>
                    </li>
                    <!-- <li>
                        <a class="page-scroll" href="#portfolio">Special Day</a>
                    </li> -->
                    <li>
                        <a class="page-scroll" href="{{ url('/project') }}">Project</a>
                    </li>
                    
                    <li>
                        <a class="page-scroll" href="{{ url('/client') }}">Client</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="{{ url('/about') }}">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="{{ url('/contact') }}">Contact</a>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->



