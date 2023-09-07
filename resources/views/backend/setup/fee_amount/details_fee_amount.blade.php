@extends('layouts.backend.app')

@section('title', 'Details Fee Amount')

@push('css')

@endpush

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Details Fee Amount ( <i class="text-danger">{{ $details[0]->fee_category->name }} : </i> )</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.fee.amount') }}"><i class="fa fa-list-alt"></i>  Fee Amount List</a></p>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Class</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach($details as $row)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $row->class->name }} </td>
                                        <td>{{ $row->amount }} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

