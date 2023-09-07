@extends('layouts.backend.app')

@section('title', 'Details Admission')

@push('css')

@endpush

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Details Admission</h3>
                        </div>
                        <div class="card-body">
                            <table class="table  table-bordered table-stript table-hover">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid" src="{{ $admission->image ? url($admission->image) : asset('public/backend/upload/avatar.png') }}" alt="User profile picture">
                                </div>
                                <br>
                                <tbody>
                                <tr>
                                    <td style="width: 50%">ID NO</td>
                                    <td>{{ $admission->id }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Name</td>
                                    <td>{{ $admission->name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Father's Name</td>
                                    <td>{{ $admission->fname }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Mother's Name</td>
                                    <td>{{ $admission->mname }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Mobile Number</td>
                                    <td>{{ $admission->mobile }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Year</td>
                                    <td>{{ $admission->year->name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Class</td>
                                    <td>{{ $admission->class->name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Address</td>
                                    <td>{{ $admission->address }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Gender</td>
                                    <td>{{ $admission->gender }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Religion</td>
                                    <td>{{ $admission->religion }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Date of Birth</td>
                                    <td>{{ $admission->dob }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Transaction </td>
                                    <td>{{ $admission->transaction  }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Reference </td>
                                    <td>{{ $admission->reference  }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">Amount </td>
                                    <td>{{ $admission->amount  }} TK</td>
                                </tr>

                                </tbody>
                            </table>
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

