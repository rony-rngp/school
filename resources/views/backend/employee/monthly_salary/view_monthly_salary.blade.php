@extends('layouts.backend.app')

@section('title', 'Monthly Salary')

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
                            <h3 class="float-left">Monthly Salary</h3>
                        </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="date">Date <font style="color: red">*</font></label>
                                        <input type="text" name="date" id="date" class="form-control" placeholder="Date" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <a id="search" class="btn btn-outline-info" name="search" style="margin-top: 31px">Search</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div id="DocumentResults"></div>
                                <script id="document-template" type="text/x-handlebars-template">
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
            var date = $('#date').val();

            if(date == ""){
                toastr.error("Date is Required");
                return false;
            }

            $.ajax({
                url : "{{ route('get.employee.monthly.salary') }}",
                type : "GET",
                data : {'date' : date},
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

