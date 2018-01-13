<!-- <div class="container">
    <div class="row">
        <div class="col-md-4">
        <h4>Latest News</h4>
        <ul>
        <li>Privacy Policy</li>
        <li>Privacy Policy</li>
        <li>Privacy Policy</li>
        </ul>

        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <span class="copyright">Copyright &copy; Your Website 2016</span>
        </div>
        <div class="col-md-4">
            <ul class="list-inline social-buttons">
                <li><a href="#"><i class="fa fa-twitter"></i></a>
                </li>
                <li><a href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a>
                </li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul class="list-inline quicklinks">
                <li><a href="#">Privacy Policy</a>
                </li>
                <li><a href="#">Terms of Use</a>
                </li>
            </ul>
        </div>
    </div>
</div> -->


        <div class="container">
            <div class="row">
                <div class="col-sm-4 info">
                    <h5><u>GET IN TOUCH</u></h5>
                    <ul>
                        <li>Phone +62 878 2330 3095</li>
                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; +62 856 240 10 229 (Hotline)</li>
                        <li>Email</li>
                        <li>support@legacyweddingorganizer.com</li>
                    </ul>
                </div>
                <div class="col-sm-4 info">
                    <h5><u>PROJECT</u></h5>
                    <ul>
                        @foreach($projects as $project)
                        <li>{{ $project->pengantin_pria }} & {{ $project->pengantin_wanita }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ url('/project') }}">more...</a>
                </div>
                <div class="col-sm-4 info">
                    <h5><u>ABOUT US</u></h5>
                    <p> <b>Hello, thank you for reaching out for us ! <br/> We are Wedding Planner and Organizer </b><br/> We are timekeeper, counselor, personal shopper and designer rolled into one. <br/> <b>Your unforgetable moment</b></p>
                    <a href="{{ url('/about') }}">more...</a>
                </div>
            </div>
        </div>
        <div class="second-bar">
           <div class="container">
                <!-- <h2 class="logo"><a href="#"> LOGO </a></h2> -->
                <div class="social-icons">
                    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="google"><i class="fa fa-google-plus"></i></a>
                </div>
            </div>
        </div>
