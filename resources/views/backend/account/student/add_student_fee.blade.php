@extends('layouts.backend.app')

@section('title', 'Add Student Fee')

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
                            <h3 class="float-left">Add/Edit Student Fee</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.student.fee') }}"><i class="fa fa-list-alt"></i> Student Fee List</a></p>
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
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="class_id">Class <font style="color: red">*</font></label>
                                    <select name="class_id" id="class_id" class="form-control select2bs4">
                                        <option value="">Select Class</option>
                                        @foreach($class as $cls)
                                            <option value="{{ $cls->id }}">{{ $cls->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="fee_category_id">Fee Category <font style="color: red">*</font></label>
                                    <select name="fee_category_id" id="fee_category_id" class="form-control select2bs4">
                                        <option value="">Select Fee Category</option>
                                        @foreach($fee_categories as $fee_category)
                                            <option value="{{ $fee_category->id }}">{{ $fee_category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="date">Date <font style="color: red">*</font></label>
                                    <input type="text" name="date" id="date" class="form-control" autocomplete="off" placeholder="Date">
                                </div>
                                <div class="form-group col-md-12">
                                    <a id="search" class="btn btn-outline-info" name="search">Search</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div id="DocumentResults"></div>
                            <script id="document-template" type="text/x-handlebars-template">
                                <form action="{{ route('store.student.fee') }}" method="POST">
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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection

@push('js')

    <script>
        $(document).on('click', '#search', function () {
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            var fee_category_id = $('#fee_category_id').val();
            var date = $('#date').val();

            if(year_id == ""){
                toastr.error("Year is Required");
                return false;
            }
            if(class_id == ""){
                toastr.error("Class is Required");
                return false;
            }
            if(fee_category_id == ""){
                toastr.error("Fee Category is Required");
                return false;
            }
            if(date == ""){
                toastr.error("Date is Required");
                return false;
            }

            $.ajax({
                url : "{{ route('get.student.fee') }}",
                type : "GET",
                data : {'year_id' : year_id, 'class_id' : class_id, 'fee_category_id' : fee_category_id, 'date' : date},
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        var dp=$("#date").datepicker( {
            format: "yyyy-mm",
            startView: "months",
            minViewMode: "months"
        });
    </script>
@endpush

