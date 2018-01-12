<div class="side-menu">
    
    <nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <div class="brand-wrapper">
            <!-- Hamburger -->
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Brand -->
            <div class="brand-name-wrapper">

                <a href="{{ url('user-logout') }}"><button type="button" class="navbar-brand btn btn-default btn-sm pull-left"><p>Logout</p></button></a>
                
            </div>

            <!-- Search -->
            <!-- <a data-toggle="collapse" href="#search" class="btn btn-default" id="search-trigger">

            </a> -->

            <!-- Search body -->
            <div id="search" class="panel-collapse collapse">
                <div class="panel-body">
                    <form class="navbar-form" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default "><span class="glyphicon glyphicon-ok"></span></button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- Main Menu -->
    <div class="side-menu-container">
        
        <ul class="nav navbar-nav">
        <center><h3 class="section-subheading">WEDDING PLAN</h3></center>
            <br/>
            <li class="active"><a href="{{ url('client-home') }}"><b>HOME</b></a></li>

            <!-- Dropdown-->
            @foreach ($packages as $package)
            <li class="active"><a href="{{ url('/packages/'.$package->id) }}"><b>{{ strtoupper($package->nama) }} </b><p style="color:#d5c0b4">Last Update : {{ $package->updated_at }}</p></a></li>
            @endforeach
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
    
    </div>