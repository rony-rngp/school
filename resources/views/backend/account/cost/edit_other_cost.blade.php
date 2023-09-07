@extends('layouts.backend.app')

@section('title', 'Edit Cost')

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
                            <h3 class="float-left">Edit Costs</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.other.cost') }}"><i class="fa fa-list-alt"></i>  Cost List</a></p>
                        </div>
                        <div class="card-body">
                            <form id="quickForms" action="{{ route('update.other.cost',$edit_data->id) }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-row">

                                    <div class="form-group col-md-3">
                                        <label for="date">Date</label>
                                        <input type="text" name="date" id="date" value="{{ $edit_data->date }}" class="form-control" placeholder="Date" autocomplete="off">
                                        <span style="color:red">{{ $errors->has('date') ? $errors->first('date') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="amount">Amount</label>
                                        <input type="text" name="amount" id="amount" value="{{ $edit_data->amount }}" class="form-control" placeholder="Amount">
                                        <span style="color:red">{{ $errors->has('amount') ? $errors->first('amount') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                        <span style="color:red">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <img id="showImage" src="{{$edit_data->image ? url($edit_data->image) : asset('public/backend/upload/no_image.png') }}" height="100" width="110">
                                    </div>


                                    <div class="form-group col-md-12">
                                        <label for="description">Description</label>
                                        <textarea rows="4" name="description" id="description" class="form-control" placeholder="Description">{{ $edit_data->description }}</textarea>
                                        <span style="color:red">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $("#quickForms").validate({
                rules: {
                    date: {
                        required: true,
                    },
                    amount: {
                        required: true,
                        number: true
                    },
                    description: {
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
        $('#date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
    </script>
@endpush

