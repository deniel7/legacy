

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
      
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
    @foreach($banners as $item)
    <div class="item active">
        <img src="{{asset('images/upload/banner/'.$item->image1) }}">
        
      </div>
      <div class="item">
        <img src="{{asset('images/upload/banner/'.$item->image2) }}">
        <div class="carousel-caption">
          <!-- <h3>Chania</h3>
          <p>The atmosphere in Chania has a touch of Florence and Venice.</p> -->
        </div>
      </div>

      <div class="item">
        <img src="{{asset('images/upload/banner/'.$item->image3) }}">
        
      </div>
    
      <div class="item">
        <img src="{{asset('images/upload/banner/'.$item->image4) }}">
        
      </div>

      <div class="item">
        <img src="{{asset('images/upload/banner/'.$item->image5) }}">
        
      </div>
      
      @endforeach

      
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>