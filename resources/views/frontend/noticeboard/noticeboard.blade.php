@extends('layouts.frontend.app')

@section('title', 'Noticeboard')

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

            <!-- notice -->
            @forelse($notices as $notice)
            <div class="notice p-3 mb-3 rounded wow slideInLeft">
                <p class="mb-2">{{ $notice->created_at->diffForhumans() }}</p>
                <h2 class="h5 mb-3"><a href="{{ url('single/noticeboard/'. $notice->slug . '/' . $notice->id )}}">{{ $notice->title }}</a></h2>
                <a href="{{ url('single/noticeboard/'. $notice->slug . '/' . $notice->id )}}" class="btn btn-sm btn-outline-primary border-none text-sm read-more mb-3">Read more</a>
            </div>
            @empty
                <div class="notice p-3 mb-3 rounded wow slideInLeft">
                    <h2 class="h5 mb-3"><a href="javascript:void (0)"> Notice Not Found :(</a></h2>
                </div>
            @endforelse
            <!-- end of notice -->

            <!-- pagination -->
            <div class="container d-flex justify-content-end">
                <nav aria-label="Page navigation">
                    {{ $notices->links() }}
                </nav>
            </div>
            <!-- end of pagination -->

        </div>
    </section>
    <!-- end of noticeboard section -->
@endsection

@push('js')

@endpush
