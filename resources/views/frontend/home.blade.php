@extends('layouts.frontend.app')

@section('title', 'Home')

@push('css')
<style>
    @media (min-width: 1200px) {
        .imggg{
            width: 400px !important;
        }
        #headerCarousel img{
            height: 780px;
            object-fit: cover;
        }
    }

    @media (max-width: 576px) {
        .imggg{
            width: 250px !important;
            height: 230px !important;
        }
        .b_area{text-align: center}
    }

</style>
@endpush

@section('content')

    @include('layouts.frontend.partial.slider')

    <!-- Recent Notice -->
    <section class="container border border-primary">
        <div class="row">
            <div class="col-lg-2 text-light my-auto" style="background-image: linear-gradient(150deg, #4b3695 0%, #19a0ff 100%);">
                <h3 class="h4">Recent Notice</h3>
            </div>
            <div class="col-lg-10 p-0 my-auto">
                <div id="recentNotice">
                    <div class="MS-content">
                        <h4 class="item h5"><a href="javascript:void(0)">{{ $headline->headline }}</a></h4>
                        <h4 class="item h5">------</h4>
                        <h4 class="item h5"><a href="javascript:void(0)">{{ $headline->headline }}</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of recent notice -->

    <!-- welcome section -->
    <section class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h2 class="text-primary wow slideInLeft">{{ $main_description->title }}</h2>
                    <p class="wow slideInRight">{!! $main_description->body !!}</p>
                </div>
                <div class="col-lg-5 wow bounceInUp b_area">
                    <img style="height: 100%" src="{{ url($main_description->image) }}" class="imggg img-fluid rounded" alt="Welcome Image">
                </div>
            </div>
        </div>
    </section>
    <!-- end of welcome section -->

    <!-- end of photo gallery section -->
@endsection

@push('js')

@endpush
