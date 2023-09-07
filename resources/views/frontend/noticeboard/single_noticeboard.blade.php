@extends('layouts.frontend.app')

@section('title')
    {{ $single_notice->title }}
@endsection

@push('css')

@endpush

@section('content')
    <header class="header">
        <!-- page header -->
        <div class="p-5">
            <h1 class="h1 text-center text-light p-3 font-weight-bold wow slideInRight">Noticeboard</h1>
        </div>
        <!-- end of page header -->
    </header>

    <!-- noticeboard section -->
    <section class="mt-5 mb-5">
        <div class="container">

            <!-- single notice -->
            <div class="p-3 mb-3">
                <p class="mb-2  wow slideInLeft">{{ $single_notice->created_at->diffForhumans() }}</p>
                <h2 class="h3 mb-3 wow slideInRight">{{ $single_notice->title }}</h2>
                <p class=" wow slideInLeft">{!!$single_notice->body!!}</p>
                @if(!empty($single_notice->image))
                    <img src="{{ url($single_notice->image) }}" class="img-fluid rounded mt-4 wow slideInLeft" alt="Image">
                @endif
            </div>
            <!-- end of single notice -->

        </div>
    </section>
    <!-- end of noticeboard section -->
@endsection

@push('js')

@endpush
