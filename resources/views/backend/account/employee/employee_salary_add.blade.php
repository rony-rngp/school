@extends('layouts.backend.app')

@section('title', 'Add Employee Salary')

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
                            <h3 class="float-left">Add Employee Salary</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('account.view.employee.salary') }}"><i class="fa fa-list-alt"></i>  Employee Salary List</a></p>
                        </div>
                        <div class="card-body">
                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label for="date">Date <font style="color: red">*</font></label>
                                    <input type="text" name="date" id="date" class="form-control" autocomplete="off" placeholder="Date">
                                </div>
                                <div class="form-group col-md-3" style="margin-top: 30px">
                                    <a id="search" class="btn btn-outline-info" name="search">Search</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="DocumentResults"></div>
                        <script id="document-template" type="text/x-handlebars-template">
                            <form action="{{ route('account.store.employee.salary') }}" method="POST">
                                @csrf
                                <table class="table  table-bordered table-striped table-hover" style="width: 100%">
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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection

@push('js')

    <script>
        $(document).on('click', '#search', function () {
            var date = $('#date').val();

            if(date == ""){
                toastr.error("Date is Required");
                return false;
            }

            $.ajax({
                url : "{{ route('account.get.employee.salary') }}",
                type : "GET",
                data : {'date' : date},
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

