@extends('layouts.backend.app')

@section('title', 'Edit Amount List')

@push('css')

@endpush

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Edit Fee Amount</h3>
                        </div>
                        <div class="card-body">
                            <form id="quickForms" action="{{ route('update.fee.amount',$edit_data[0]->fee_category_id) }}" method="POST" >
                                @csrf
                                <div class="add_item">
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="fee_category_id">Fee Category </label>
                                            <select name="fee_category_id" id="fee_category_id" class="form-control select2bs4">
                                                <option value="">Select Fee Category</option>
                                                @foreach($fee_categories as $fee_category)
                                                    <option {{ $edit_data[0]->fee_category_id == $fee_category->id ? 'selected' : '' }} value="{{ $fee_category->id }}">{{ $fee_category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @foreach($edit_data as $edit)
                                        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                            <div class="form-row">
                                                <div class="form-group col-md-5">
                                                    <label for="class_id">Class</label>
                                                    <select name="class_id[]" id="class_id" class="form-control select2bs4">
                                                        <option value="">Select Class</option>
                                                        @foreach($classes as $class)
                                                            <option {{ $edit->class_id == $class->id ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="amount">Amount</label>
                                                    <input type="text" name="amount[]" id="amount" value="{{ $edit->amount }}" class="form-control">
                                                </div>
                                                <div class="form-group col-md-1" style="margin-top: 30px">
                                                    <div class="form-row">
                                                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                                                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="visibility: hidden">
            <div class="whole_extra_item_add" id="whole_extra_item_add">
                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="class_id">Class</label>
                            <select name="class_id[]" id="class_id" class="form-control">
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="amount">Amount</label>
                            <input type="text" name="amount[]" id="amount" class="form-control">
                        </div>
                        <div class="form-group col-md-1" style="padding-top: 30px">
                            <div class="form-row">
                                <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                                <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <script type="text/javascript">
        $(document).ready(function () {
            var counter = 0;
            $(document).on("click", ".addeventmore", function () {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });

            $(document).on("click", ".removeeventmore", function (event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter-=1;
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#quickForms").validate({
                rules: {
                    "fee_category_id": {
                        required: true,
                    },
                    "class_id[]": {
                        required: true,
                    },
                    "amount[]": {
                        required: true,
                        number: true
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
@endsection

