@extends('layouts.backend.app')

@section('title', 'Add Attendance')

@push('css')

@endpush

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Add Student Attendance</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="year_id">Year <font style="color: red">*</font></label>
                                    <select name="year_id" id="year_id" class="form-control select2bs4">
                                        <option value="">Select Year</option>
                                        @foreach($year as $yr)
                                            <option value="{{ $yr->id }}">{{ $yr->name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->has('year_id') ? $errors->first('year_id') : '' }}</span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="class_id">Class <font style="color: red">*</font></label>
                                    <select name="class_id" id="class_id" class="form-control select2bs4">
                                        <option value="">Select Class</option>
                                        @foreach($class as $cls)
                                            <option value="{{ $cls->id }}">{{ $cls->name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red">{{ $errors->has('class_id') ? $errors->first('class_id') : '' }}</span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="date">Date <font style="color: red">*</font></label>
                                    <input type="text" id="date" name="date" readonly {{--id="date"--}} class="form-control" value="{{ date('Y-m-d', strtotime(\Carbon\Carbon::today())) }}" placeholder="Date" autocomplete="off">
                                    <span style="color:red">{{ $errors->has('date') ? $errors->first('date') : '' }}</span>
                                </div>
                                <div class="form-group col-md-3">
                                    <a id="search" class="btn btn-outline-info" name="search" style="margin-top: 30px">Search</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div id="DocumentResults"></div>
                            <script id="document-template" type="text/x-handlebars-template">
                                <form action="{{ route('store.student.attendance') }}" method="POST">
                                    @csrf
                                    <table class="table table-sm table-bordered table-striped table-hover" style="width: 100%">
                                        <thead>
                                        <tr>
                                            @{{{thsource}}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @{{#each this}}
                                        <tr>
                                            @{{{tdsource}}}
                                        </tr>
                                        @{{/each}}
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('css')
    <script>
        $(document).on('click', '#search', function () {
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            var date = $('#date').val();


            if(year_id == ""){
                toastr.error("Year is Required");
                return false;
            }
            if(class_id == ""){
                toastr.error("Class is Required");
                return false;
            }

            $.ajax({
                url : "{{ route('get.attend.student') }}",
                type : "GET",
                data : {'year_id' : year_id, 'class_id' : class_id, 'date' : date},
                beforeSend: function(){
                },
                success: function(data){
                    var source = $("#document-template").html();
                    var template = Handlebars.compile(source);
                    var html = template(data);
                    $('#DocumentResults').html(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }

            });
        });
    </script>

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script>
        $('#date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
    </script>
@endpush
