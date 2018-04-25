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
                    <h5>GET IN TOUCH</h5>
                    <ul>
                        <li><img id="logo-main" src="{{asset('front/agency/img/call.png')}}" height="35px"> +62 878 2330 3095</li>
                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; +62 856 240 10 229 (Hotline)</li>
                        <li class="email"><img id="logo-main" src="{{asset('front/agency/img/email.png')}}" height="35px">&nbsp;&nbsp;<a href="{{ url('/contact') }}">support@legacyweddingorganizer.com</a></li>
                        <li><br/>
                        <a href="https://www.facebook.com/legacyweddingorganizer/" target="_blank"><img id="logo-main" src="{{asset('front/agency/img/fb.png')}}" height="35px"></a>&nbsp;&nbsp
                        <a href="https://www.instagram.com/legacy_organizer/" target="_blank"><img id="logo-main" src="{{asset('front/agency/img/ig.png')}}" height="35px"></a>&nbsp;&nbsp
                        <a href="https://web.whatsapp.com/" target="_blank"><img id="logo-main" src="{{asset('front/agency/img/wa.png')}}" height="35px"></a>&nbsp;&nbsp
                        <a href="https://www.youtube.com/channel/UCFr3oEiBKeeNdZ3fSdNZSzw?view_as=subscriber" target="_blank"><img id="logo-main" src="{{asset('front/agency/img/youtube.png')}}" height="35px"></a>
                        </li>
                        <li><br/>
                            <a href="https://www.bridestory.com/legacy-organizer" title="Legacy Organizer" target="_blank" rel="dofollow"><img alt="Legacy Organizer" width="205" height="36" src="https://business.bridestory.com/assets/images/badges/rectangle/big-blackpink.png" /></a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-4 info">
                    <h5>PROJECT</h5>
                    <ul style="text-transform:uppercase">
                        @foreach($projects as $project)
                        <li><a href="{{ url('/detail/'.$project->id) }}">{{ $project->pengantin_pria }} & {{ $project->pengantin_wanita }}</a></li>
                        @endforeach
                    </ul>
                    <a href="{{ url('/project') }}"><i>READ MORE</i></a>
                </div>
                <div class="col-sm-4 info">
                    <h5>ABOUT US</h5>
                    <ul>
                    <li> We are specialized to create elegant also sophisticated unforgetable moment. Professional friendly staff will be delighted to discuss requirements and planning in great details & personalized.</li>
                    </ul>
                    <a href="{{ url('/about') }}"><i>READ MORE</i></a>
                    
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
