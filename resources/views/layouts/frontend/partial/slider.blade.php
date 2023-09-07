
<div id="headerCarousel" class="carousel slide mb-5" data-ride="carousel">
    <div class="carousel-inner">

        @foreach($sliders as $key => $slider)

                <img width="100%" height="auto" class="carousel-item {{ $key == 0 ? 'active' : '' }} " src="{{ url($slider->image) }}">

        @endforeach
    </div>
    <a class="carousel-control-prev" href="#headerCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#headerCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- End of carousel -->
