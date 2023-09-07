@extends('layouts.backend.app')

@section('title', 'Profile')

@push('css')

@endpush

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-6 offset-3">
                    <div class="card">
                        <div class="card-header ">
                            <h3 class="text-center ">My Profile</h3>
                        </div>

                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ $user->image ? URL($user->image) : asset('public/backend/upload/avatar.png') }}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $user->name }} ({{ $user->role }})</h3>

                            <p class="text-muted text-center">{{ $user->address }}</p>

                            <table class="table  table-bordered" >
                                <tr>
                                    <td>E-Mail</td>

                                    <td>{{ $user->email }}</td>
                                </tr>

                                <tr>
                                    <td>Mobile No.</td>

                                    <td>{{ $user->mobile }}</td>
                                </tr>

                                <tr>
                                    <td>Gender</td>

                                    <td>{{ $user->gender }}</td>
                                </tr>

                                <tr>
                                    <td>Address</td>

                                    <td>{{ $user->address }}</td>
                                </tr>

                            </table><br>

                            <a href="{{ route('edit.profile', $user->id) }}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection

@push('js')

@endpush

