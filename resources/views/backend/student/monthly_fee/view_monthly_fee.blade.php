@extends('layouts.backend.app')

@section('title', 'Monthly Fee')

@push('css')

@endpush

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Monthly Fee</h3>
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
                                    <label for="month_id">Month <font style="color: red">*</font></label>
                                    <select name="month_id" id="month_id" class="form-control select2bs4">
                                        <option value="">Select Month</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="Augest">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <a id="search" class="btn btn-outline-info" name="search" style="margin-top: 30px">Search</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div id="DocumentResults"></div>
                            <script id="document-template" type="text/x-handlebars-template">
                                <table class="table-sm table-bordered table-striped table-hover" style="width: 100%">
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
            var month_id = $('#month_id').val();

            if(year_id == ""){
                toastr.error("Year is Required");
                return false;
            }
            if(class_id == ""){
                toastr.error("Class is Required");
                return false;
            }
            if(month_id == ""){
                toastr.error("Month is Required");
                return false;
            }

            $.ajax({
                url : "{{ route('get.student.monthly.fee') }}",
                type : "GET",
                data : {'year_id' : year_id, 'class_id' : class_id, 'month_id' : month_id},
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
@endpush
