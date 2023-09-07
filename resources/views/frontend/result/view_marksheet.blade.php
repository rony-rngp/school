<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Result | AL HERA SHISHU ACADEMY</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/bootstrap.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/animate.css">
    <!-- fontawesome icon CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/fontawesome/css/all.min.css">
    <!-- Multislider CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/multislider.css">
    <link rel="icon" href="{{ url('public/backend/upload/logo.png') }}" sizes="16x16" type="image/png">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/style.css">
    <!-- toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <style type="text/css">
        .container {
    width: 960px !important;
}

@media (min-width: 1px) {
  .container {
    max-width: 940px;
  }
  .col-lg-1,
  .col-lg-2,
  .col-lg-3,
  .col-lg-4,
  .col-lg-5,
  .col-lg-6,
  .col-lg-7,
  .col-lg-8,
  .col-lg-9,
  .col-lg-10,
  .col-lg-11,
  .col-lg-12 {
    float: left;
  }
  .col-lg-1 {
    width: 8.333333333333332%;
  }
  .col-lg-2 {
    width: 16.666666666666664%;
  }
  .col-lg-3 {
    width: 25%;
  }
  .col-lg-4 {
    width: 33.33333333333333%;
  }
  .col-lg-5 {
    width: 41.66666666666667%;
  }
  .col-lg-6 {
    width: 50%;
  }
  .col-lg-7 {
    width: 58.333333333333336%;
  }
  .col-lg-8 {
    width: 66.66666666666666%;
  }
  .col-lg-9 {
    width: 75%;
  }
  .col-lg-10 {
    width: 83.33333333333334%;
  }
  .col-lg-11 {
    width: 91.66666666666666%;
  }
  .col-lg-12 {
    width: 100%;
  }
  .col-lg-push-1 {
    left: 8.333333333333332%;
  }
  .col-lg-push-2 {
    left: 16.666666666666664%;
  }
  .col-lg-push-3 {
    left: 25%;
  }
  .col-lg-push-4 {
    left: 33.33333333333333%;
  }
  .col-lg-push-5 {
    left: 41.66666666666667%;
  }
  .col-lg-push-6 {
    left: 50%;
  }
  .col-lg-push-7 {
    left: 58.333333333333336%;
  }
  .col-lg-push-8 {
    left: 66.66666666666666%;
  }
  .col-lg-push-9 {
    left: 75%;
  }
  .col-lg-push-10 {
    left: 83.33333333333334%;
  }
  .col-lg-push-11 {
    left: 91.66666666666666%;
  }
  .col-lg-pull-1 {
    right: 8.333333333333332%;
  }
  .col-lg-pull-2 {
    right: 16.666666666666664%;
  }
  .col-lg-pull-3 {
    right: 25%;
  }
  .col-lg-pull-4 {
    right: 33.33333333333333%;
  }
  .col-lg-pull-5 {
    right: 41.66666666666667%;
  }
  .col-lg-pull-6 {
    right: 50%;
  }
  .col-lg-pull-7 {
    right: 58.333333333333336%;
  }
  .col-lg-pull-8 {
    right: 66.66666666666666%;
  }
  .col-lg-pull-9 {
    right: 75%;
  }
  .col-lg-pull-10 {
    right: 83.33333333333334%;
  }
  .col-lg-pull-11 {
    right: 91.66666666666666%;
  }
  .col-lg-offset-1 {
    margin-left: 8.333333333333332%;
  }
  .col-lg-offset-2 {
    margin-left: 16.666666666666664%;
  }
  .col-lg-offset-3 {
    margin-left: 25%;
  }
  .col-lg-offset-4 {
    margin-left: 33.33333333333333%;
  }
  .col-lg-offset-5 {
    margin-left: 41.66666666666667%;
  }
  .col-lg-offset-6 {
    margin-left: 50%;
  }
  .col-lg-offset-7 {
    margin-left: 58.333333333333336%;
  }
  .col-lg-offset-8 {
    margin-left: 66.66666666666666%;
  }
  .col-lg-offset-9 {
    margin-left: 75%;
  }
  .col-lg-offset-10 {
    margin-left: 83.33333333333334%;
  }
  .col-lg-offset-11 {
    margin-left: 91.66666666666666%;
  }
}
    </style>

    @stack('css')

</head>
<body>

    <!-- noticeboard section -->
    <section class="mt-5 mb-5">
        <div class="container">
            <div class="notice p-3 mb-3 rounded wow slideInLeft">
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div style="float:right;" class="col-md-2 text-center">
                                <img style="width: 120px; height: 120px; float: left" src="{{ url('public/backend/upload/logo.png') }}">
                            </div>

                            <div class="col-md-6 offset-1 text-center" style="float: left">
                                <h4><strong>AL HERA SHISHU ACADEMY</strong></h4>
                                <h6><strong>Ambari, Domar, Nilphamari</strong></h6>
                                <h6><strong><i><u>www.ahsabd.net</u></i></strong></h6>
                                <h6><strong>{{ @$all_marks[0]->exam_type->name }}</strong></h6>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr style="border: solid 1px; width: 100%; color: #DDD; margin-bottom: 0px">
                            <p style="text-align: right"><u><i>Print Date : </i>{{ date('d-m-Y') }}</u></p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <table border="1" width="100%" cellpadding="9" cellspacing="2">
                                    @php
                                        $assign_student = \App\Model\AssignStudent::where('year_id', $all_marks[0]->year_id)->where('class_id', $all_marks[0]->class_id)->where('student_id',  $all_marks[0]->student_id)->first();
                                    @endphp
                                    <tr>
                                        <td width="50%">Student ID</td>
                                        <td width="50%">{{ $all_marks[0]->id_no }}</td>
                                    </tr>
                                    <tr>
                                        <td width="50%">Roll No</td>
                                        <td width="50%">{{ $assign_student->roll }}</td>
                                    </tr>
                                    <tr>
                                        <td width="50%">Name</td>
                                        <td width="50%">{{  $all_marks[0]->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td width="50%">Class</td>
                                        <td width="50%">{{  $all_marks[0]->student_class->name }}</td>
                                    </tr>
                                    <tr>
                                        <td width="50%">Session</td>
                                        <td width="50%">{{  $all_marks[0]->year->name }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <table border="1" width="100%" cellspacing="1" class="text-center">
                                    <thead>
                                    <tr>
                                        <th>Letter Grade</th>
                                        <th>Marks Interval</th>
                                        <th>Grade Point</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($all_greades as $mark)
                                        <tr>
                                            <td>{{ $mark->grade_name }}</td>
                                            <td>{{ $mark->start_marks }} - {{ $mark->end_marks}}</td>
                                            <td>{{ number_format((float)$mark->start_point, 2) }} - {{ number_format((float)$mark->end_point, 2) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-12">
                                <table border="1" width="100%" cellpadding="1" cellspacing="1">
                                    <thead>
                                    <tr>
                                        <th class="text-center">SL</th>
                                        <th class="text-center">Subject</th>
                                        <th class="text-center">Full Marks</th>
                                        <th class="text-center">Get Marks</th>
                                        <th class="text-center">Other Marks</th>
                                        <th class="text-center">Total Marks</th>
                                        <th class="text-center">Letter Grade</th>
                                        <th class="text-center">Grade Point</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total_marks = 0;
                                        $total_point = 0;
                                    @endphp
                                    @foreach($all_marks as $key=>$row)
                                        @php
                                            $get_mark = $row->total_marks;
                                            $total_marks = (float)$get_mark+(float)$total_marks;
                                            $total_subject = \App\Model\StudentMarks::where('year_id', $row->year_id)->where('class_id', $row->class_id)->where('exam_type_id', $row->exam_type_id)->where('student_id', $row->student_id)->count();
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ $key+1 }}</td>
                                            <td class="text-left">{{ @$row->assign_subject->subject->name }}</td>
                                            <td class="text-center">{{ @$row->assign_subject->full_mark }}</td>
                                            <td class="text-center">{{ $row->marks }}</td>
                                            <td class="text-center">{{ $row->other_marks }}</td>
                                            <td class="text-center">{{ $row->total_marks }}</td>
                                            @php

                                                if($row->assign_subject->full_mark == 100){
                                                    $grade_marks = \App\Model\MarksGrade::where([['start_marks', '<=', (int)$get_mark], ['end_marks', '>=', (int)$get_mark]])->first();
                                                }elseif($row->assign_subject->full_mark == 50){
                                                    $grade_marks = \App\Model\MarksGrade::where([['start_marks', '<=', (int)$get_mark*2], ['end_marks', '>=', (int)$get_mark*2]])->first();
                                                }elseif($row->assign_subject->full_mark == 25){
                                                    $grade_marks = \App\Model\MarksGrade::where([['start_marks', '<=', (int)$get_mark*4], ['end_marks', '>=', (int)$get_mark*4]])->first();
                                                }

                                                $grade_name = $grade_marks->grade_name;
                                                $grade_point = number_format((float)$grade_marks->grade_point, 2);
                                                $total_point = (float)$total_point + $grade_point;

                                            @endphp
                                            <td class="text-center">{{ $grade_name }}</td>
                                            <td class="text-center">{{ $grade_point }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-12">
                                <table border="1" width="100%" cellpadding="1" cellspacing="1">
                                    <tbody>
                                    @php
                                        $grade_point_average = $total_point/$total_subject;
                                        $total_grade_point = \App\Model\MarksGrade::where([['start_point', '<=', $grade_point_average], ['end_point', '>=', $grade_point_average]])->first();
                                    @endphp
                                    <tr>
                                        <td width="50%"><strong>Grade Point Average</strong></td>
                                        <td width="50%">
                                            @if($count_fail > 0)
                                                <b>0.00</b>
                                            @elseif($assign_subject != $total_subject)
                                                <b>0.00</b>
                                            @else
                                                <b>{{ number_format((float)$grade_point_average, '2') }}</b>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%"><strong>Latter Grade</strong></td>
                                        <td width="50%">
                                            @if($count_fail > 0)
                                                <b> F</b>
                                            @elseif($assign_subject != $total_subject)
                                                <b>Fail</b>
                                            @else
                                                <b>{{ $total_grade_point->grade_name }}</b>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="50%"><strong>Total Marks with Fraction</strong></td>
                                        <td width="50%"><b>{{ $total_marks }}</b></td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-12">
                                <table border="1" width="100%" cellpadding="10" cellspacing="2">
                                    <tbody>
                                    <tr>
                                        <td style="text-align: center">
                                            @if($count_fail > 0)
                                                <b>Fail</b>
                                            @elseif($assign_subject != $total_subject)
                                                <b>Failed..You could not attend every exam.</b>
                                            @else
                                                <b> Remarks : {{ $total_grade_point->remarks }}</b>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
