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
                <div class="col-sm-3 info">
                    <h5>Get started</h5>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Client</a></li>
                        <li><a href="#">Vendor</a></li>
                        <li><a href="#">Project</a></li>
                    </ul>
                </div>
                <div class="col-sm-3 info">
                    <h5>The Special Days</h5>
                    <ul>
                        @foreach($projects as $project)
                        <li>{{ $project->pengantin_pria }} & {{ $project->pengantin_wanita }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-3 info">
                    <h5>Support</h5>
                    <ul>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                        
                    </ul>
                </div>
                <div class="col-sm-3 info">
                    <h5>Latest Events</h5>
                    <p> Lorem ipsum dolor amet, consectetur adipiscing elit. Etiam consectetur aliquet aliquet. Interdum et malesuada fames ac ante ipsum primis in faucibus. </p>
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
