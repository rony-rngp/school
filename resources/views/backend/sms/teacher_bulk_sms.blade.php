@extends('layouts.backend.app')

@section('title', 'Bulk SMS')

@push('css')

@endpush

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Bulk SMS</h3>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('send.teacher.bulk.sms') }}" method="POST">
                                @csrf
                                <table class="table table-sm table-bordered table-striped table-hover" style="width: 100%">
                                    <thead>
                                    <tr>
                                       <th>SL</th>
                                       <th>ID</th>
                                       <th>Name</th>
                                       <th>Mobile</th>
                                        <th colspan="3" class="text-center" style="vertical-align: middle; width: 25%">Attendance Status</th>
                                    </tr>

                                    @foreach($employees as $key => $employee)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $employee->id_no }}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->mobile }}</td>
                                            <td>
                                                <input type="hidden" name="teacher_id[]" value="{{ $employee->id }}">
                                                <input type="radio" class="check" id="check{{$key}}" name="status{{$key}}" value="Check" checked="checked"> <label for="check{{ $key }}">Check</label>
                                                <input type="radio" class="uncheck" id="uncheck{{$key}}" name="status{{$key}}" value="Uncheck" > <label for="uncheck{{ $key }}">Uncheck</label>
                                            </td>
                                        </tr>

                                    @endforeach

                                    </thead>
                                </table>
                                <textarea class="form-control" name="body" required rows="3"></textarea><br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('css')


@endpush
