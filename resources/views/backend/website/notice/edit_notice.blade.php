@extends('layouts.backend.app')

@section('title', 'Edit Notice')

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
                            <h3 class="float-left">Edit Notice</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.notice') }}"><i class="fa fa-list-alt"></i> Notice List</a></p>
                        </div>
                        <div class="card-body">
                            <form id="quickForm" action="{{ route('update.notice', $notice->id) }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ $notice->title }}" placeholder="title">
                                        <span style="color:red">{{ $errors->has('title') ? $errors->first('title') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="body">Body</label>
                                        <textarea type="text" rows="4" name="body" id="body" class="form-control">{{ $notice->body }}</textarea>
                                        <span style="color:red">{{ $errors->has('body') ? $errors->first('body') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                        <span style="color:red">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <img id="showImage" src="{{ $notice->image ? url($notice->image) : asset('public/backend/upload/no_image.png') }}" height="100" width="110">
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
                    title: {
                        required: true,
                    },
                    body: {
                        required: true,
                        minlength: 15
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
@endpush

