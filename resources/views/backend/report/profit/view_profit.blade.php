@extends('layouts.backend.app')

@section('title', 'Monthly Profit')

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
                            <h3 class="float-left">Monthly Profit</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="start_date">Start Date <font style="color: red">*</font></label>
                                    <input type="text" name="start_date" id="start_date" class="form-control" placeholder="Start Date" autocomplete="off">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="end_date">End Date <font style="color: red">*</font></label>
                                    <input type="text" name="end_date" id="end_date" class="form-control" placeholder="End Date" autocomplete="off">
                                </div>
                                <div class="form-group col-md-3" style="margin-top: 31px">
                                    <a id="search" class="btn btn-outline-info" name="search">Search</a>
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

                                    <tr>
                                        @{{{tdsource}}}
                                    </tr>

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
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();

            if(start_date == ""){
                toastr.error("Start Date is Required");
                return false;
            }

            if(end_date == ""){
                toastr.error("End Date is Required");
                return false;
            }

            $.ajax({
                url : "{{ route('report.profit.datewise.get') }}",
                type : "GET",
                data : {'start_date' : start_date, 'end_date': end_date},
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
        var dp=$("#start_date").datepicker( {
            format: "yyyy-mm",
            startView: "months",
            minViewMode: "months"
        });

        var dp=$("#end_date").datepicker( {
            format: "yyyy-mm",
            startView: "months",
            minViewMode: "months"
        });
    </script>
@endpush

