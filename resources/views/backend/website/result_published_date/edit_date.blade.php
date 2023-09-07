@extends('layouts.backend.app')

@section('title', 'Edit Date')

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
                            <h3 class="float-left">Edit Published Date</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.date') }}"><i class="fa fa-list-alt"></i>  Headline List</a></p>
                        </div>
                        <div class="card-body">
                            <form id="quickForm" action="{{ route('update.date', $published_date->id) }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-row">

                                    <div class="form-group col-md-4">
                                        <label for="published_date">Published Date</label>
                                        <input type="text" name="published_date" id="published_date" class="form-control" value="{{ $published_date->published_date }}" placeholder="Date" autocomplete="off">
                                        <span style="color:red">{{ $errors->has('published_date') ? $errors->first('published_date') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>

                                </div>
                            </form>
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
        $(function () {
            $('#quickForm').validate({
                rules: {
                    published_date: {
                        required: true,
                    },

                },
                messages: {

                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script>
        $('#published_date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd-'
        });
    </script>
@endpush

