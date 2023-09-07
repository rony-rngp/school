@extends('layouts.frontend.app')

@section('title', 'Online Admission')

@push('css')
<style>
    .register{
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    margin-top: 3%;
    padding: 3%;
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: 4%;
}
.register-left input{
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    width: 60%;
    background: #f8f9fa;
    font-weight: bold;
    color: #383d41;
    margin-top: 30%;
    margin-bottom: 3%;
    cursor: pointer;
}
.register-right{
    background: #f8f9fa;
    border-top-left-radius: 10% 50%;
    border-bottom-left-radius: 10% 50%;
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    width: 25%;
    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding: 10%;
    margin-top: 10%;
}
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #0062cc;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register .nav-tabs{
    margin-top: 3%;
    border: none;
    background: #0062cc;
    border-radius: 1.5rem;
    width: 28%;
    float: right;
}
.register .nav-tabs .nav-link{
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
    border: none;
}
.register .nav-tabs .nav-link.active{
    width: 100px;
    color: #0062cc;
    border: 2px solid #0062cc;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: #495057;
}
.bkash {
  background: #A51E48;
}
.bkash .head {
  background: #D93568;
}
.bkash .head h4{
  font-weight: bold;
  text-shadow: 0 1px 1px #fff;
}

.bkash .contact {
  background: #82213F;
}
.bkash-steps h5 {
  font-weight: 600;
}
.bkash-steps p {
  font-size: 13px;
}
footer {
  background: #D93568;
}
footer p {
  font-weight: 600;
  text-shadow: 0 0 2px #fff;
}
</style>
@endpush

@section('content')
    <header class="header">
        <!-- page header -->
        <div class="p-5">
            <h1 class="h1 text-center text-light p-3 font-weight-bold wow slideInRight">Online Admission</h1>
        </div>
        <!-- end of page header -->
    </header>

    <!-- noticeboard section -->
    <section class="mt-5 mb-5">
        <div class="container register notice p-3 mb-3 rounded wow slideInLeft">
            <div class="row">
                <div class="col-md-3 register-left">
                    <img src="{{ asset('public/frontend') }}/download.png" alt=""/>
                    <h3>Welcome</h3>
                    <p class="text-white">Admission Prossese  is Running</p>
                </div>
                <div class="col-md-9 register-right">

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h3 class="register-heading">Admission Form</h3>
                            <div class="row register-form">
                                <form id="quickForm" action="{{ route('store.admission') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="name">Student Name <font style="color: red">*</font></label>
                                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                                            <span style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="fname">Father's Name <font style="color: red">*</font></label>
                                            <input type="text" name="fname" id="fname" value="{{ old('fname') }}" class="form-control">
                                            <span style="color:red">{{ $errors->has('fname') ? $errors->first('fname') : '' }}</span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mname">Mother's Name <font style="color: red">*</font></label>
                                            <input type="text" name="mname" id="mname" value="{{ old('mname') }}" class="form-control">
                                            <span style="color:red">{{ $errors->has('mname') ? $errors->first('mname') : '' }}</span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mobile">Mobile Number <font style="color: red">*</font></label>
                                            <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}" class="form-control">
                                            <span style="color:red">{{ $errors->has('mobile') ? $errors->first('mobile') : '' }}</span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="address">Address <font style="color: red">*</font></label>
                                            <input type="text" name="address" id="address" value="{{ old('address') }}" class="form-control">
                                            <span style="color:red">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="gender">Gender <font style="color: red">*</font></label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            <span style="color:red">{{ $errors->has('gender') ? $errors->first('gender') : '' }}</span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="religion">Religion <font style="color: red">*</font></label>
                                            <select name="religion" id="religion" class="form-control">
                                                <option value="">Select Religion</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <span style="color:red">{{ $errors->has('religion') ? $errors->first('religion') : '' }}</span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="dob">Date of Birth <font style="color: red">*</font></label>
                                            <input type="text" name="dob" id="dob" value="{{ old('dob') }}" class="form-control" placeholder="Date" autocomplete="off">
                                            <span style="color:red">{{ $errors->has('dob') ? $errors->first('dob') : '' }}</span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="year_id">Year <font style="color: red">*</font></label>
                                            <select name="year_id" id="year_id" class="form-control select2bs4">
                                                <option value="">Select Year</option>
                                                @foreach($years as $yr)
                                                    <option value="{{ $yr->id }}">{{ $yr->name }}</option>
                                                @endforeach
                                            </select>
                                            <span style="color:red">{{ $errors->has('year_id') ? $errors->first('year_id') : '' }}</span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="class_id">Class <font style="color: red">*</font></label>
                                            <select name="class_id" id="class_id" class="form-control select2bs4">
                                                <option value="">Select Class</option>
                                                @foreach($classes as $cls)
                                                    <option value="{{ $cls->id }}">{{ $cls->name }}</option>
                                                @endforeach
                                            </select>
                                            <span style="color:red">{{ $errors->has('class_id') ? $errors->first('class_id') : '' }}</span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="image">Image (Optional)</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                            <span style="color:red">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                        </div>

                                        <div class="form-group col-md-1"></div>

                                        <div class="form-group col-md-2" style="float: right">
                                            <img id="showImage" src="{{ asset('public/backend/upload/no_image.png') }}" height="100" width="110">
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="bkash container text-center rounded">
                                        <div class="row">
                                            <div class="col-md-12 my-3">
                                                <div class="head p-2">
                                                    <h4 class="text-light">Al Hera Shishu Academy</h4>
                                                    <p class="m-0 text-light">Follow these steps to pay with Bkash</p>
                                                </div>
                                                <div class="contact p-2 text-light">
                                                    <strong> Amount : BDT 50, Bkash Personal: 01983103058</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pb-3">
                                                <div class="card">
                                                    <div class="card-body bg-light p-0">
                                                        <h5 class="mt-0 text-danger">Step 1</h5>
                                                        <p class=" pt-1 text-dark">Dial *247# to Start </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pb-3">
                                                <div class="card">
                                                    <div class="card-body bg-light p-0">
                                                        <h5 class="m-0 text-danger">Step 2</h5>
                                                        <p class=" pt-1 text-dark">Press 1 to Sent Money</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pb-3">
                                                <div class="card">
                                                    <div class="card-body bg-light p-0">
                                                        <h5 class="m-0 text-danger">Step 3</h5>
                                                        <p class=" pt-1 text-dark">Enter Number : 01983103058</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pb-3">
                                                <div class="card">
                                                    <div class="card-body bg-light p-0">
                                                        <h5 class="m-0 text-danger">Step 4</h5>
                                                        <p class=" pt-1 text-dark">Enter : BDT 50 as Pay Amount</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pb-3">
                                                <div class="card">
                                                    <div class="card-body bg-light p-0">
                                                        <h5 class="m-0 text-danger">Step 5</h5>
                                                        <p class=" pt-1 text-dark">Enter : {{ $reference }} as Reference</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pb-3">
                                                <div class="card">
                                                    <div class="card-body bg-light p-0">
                                                        <h5 class="m-0 text-danger">Step 6</h5>
                                                        <p class=" pt-1 text-dark">Enter your "PIN" then Confirm</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 pb-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <p class="m-0 text-dark">বিকাশ লেনদেনের সবচেয়ে দ্রুত ও নিরাপদ মাধ্যম। বিকাশ আপনাকে দেয় সেন্ড মানি, অ্যাড মানি, পে বিল, মোবাইল রিচার্জ এবং পেমেন্টসহ লাইফ সিম্পল করার সব সার্ভিস। </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <footer>
                                                    <div class="form-group row pb-3 pt-2">
                                                        <label for="transaction" style="margin-right: -42px" class="col-sm-4 col-form-label text-light">Enter Transaction ID :</label>
                                                        <div class="col-sm-6">
                                                          <input type="text" name="transaction" class="form-control" id="transaction" placeholder="Enter Transaction ID" value="{{ old('transaction') }}">
                                                          <span style="color:white">{{ $errors->has('transaction') ? $errors->first('transaction') : '' }}</span>
                                                        </div>
                                                      </div>
                                                      <input type="hidden" name="reference" value="{{ $reference }}">
                                                      <input type="hidden" name="amount" value="50">
                                                </footer>
                                            </div>
                                        </div>
                                      </div>
                                      <br>

                                    <div class="form-group col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">Submit Admission</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- end of noticeboard section -->
@endsection

@push('js')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
        $( "#dob" ).datepicker({
        dateFormat: 'yy-mm-dd',
        });
    } );
</script>

<script>
    $(function () {
        $('#quickForm').validate({
            rules: {
                "name": {
                    required: true,
                },
                "fname": {
                    required: true,
                },
                "mname": {
                    required: true,

                },
                "mobile": {
                    required: true,
                    number: true,
                    minlength:11,
                    maxlength: 11,

                },
                "address": {
                    required: true,
                },
                "gender": {
                    required: true,
                },
                "religion": {
                    required: true,
                },
                "dob": {
                    required: true,
                },
                "year_id": {
                    required: true,
                },
                "class_id": {
                    required: true,
                },

                "transaction": {
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
@endpush
