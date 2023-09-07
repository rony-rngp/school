@extends('layouts.backend.app')

@section('title', 'Add Fee Amount')

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
                            <h3 class="float-left">Add Fee Amount</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.fee.amount') }}"><i class="fa fa-list-alt"></i>  Fee Amount List</a></p>
                        </div>
                        <div class="card-body">
                            <form id="quickForm" action="{{ route('store.fee.amount') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="add_item">
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="fee_category_id">Fee Category </label>
                                            <select name="fee_category_id" id="fee_category_id" class="form-control  select2bs4" style="width: 100%;">
                                                <option value="">Select Fee Category</option>
                                                @foreach($fee_categories as $fee_category)
                                                    <option value="{{ $fee_category->id }}">{{ $fee_category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="class_id">Class</label>
                                            <select name="class_id[]" id="class_id" class="form-control select2bs4" style="width: 100%;">
                                                <option value="">Select Class</option>
                                                @foreach($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-5">
                                            <label for="amount">Amount</label>
                                            <input type="text" name="amount[]" id="amount" value="{{ old('amount') }}" class="form-control" placeholder="Amount">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <span class="btn btn-success addeventmore" style="margin-top: 30px"><i class="fa fa-plus-circle"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->

        <div style="visibility: hidden">
            <div class="whole_extra_item_add" id="whole_extra_item_add">
                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="class_id">Class</label>
                            <select name="class_id[]" id="class_id" class="form-control" style="width: 100%;">
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-5">
                            <label for="amount">Amount</label>
                            <input type="text" name="amount[]" id="amount" value="{{ old('amount') }}" class="form-control" placeholder="Amount">
                        </div>
                        <div class="form-group col-md-1" style="margin-top: 30px">
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



@endsection

@push('js')

    <script>
        $(document).ready(function () {
            var counter = 0;
            $(document).on("click", ".addeventmore", function () {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });

            $(document).on("click", ".removeeventmore", function () {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter-=1;
            });
        });
    </script>

    <script>
        $(function () {
            $('#quickForm').validate({
                ignore: [],
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
@endpush

