@extends('layouts.backend.app')

@section('title', 'Edit Headline')

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
                            <h3 class="float-left">Edit Headline</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.headline') }}"><i class="fa fa-list-alt"></i>  Headline List</a></p>
                        </div>
                        <div class="card-body">
                            <form id="quickForm" action="{{ route('update.headline', $headline->id) }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-row">

                                    <div class="form-group col-md-12">
                                        <label for="headline">Headline</label>
                                        <textarea type="text" rows="4" name="headline" id="headline" class="form-control">{{ $headline->headline }}</textarea>
                                        <span style="color:red">{{ $errors->has('headline') ? $errors->first('headline') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-6">
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
                    headlinxe: {
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

