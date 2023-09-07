@extends('layouts.backend.app')

@section('title', 'Marksheet PDF')

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
                            <h3 class="float-left">Marksheet PDF</h3>
                        </div>
                        <div class="card-body">
                            <div style="border: solid 2px; padding: 7px;">
                                <div class="row">
                                    <div style="float:right;" class="col-md-2 text-center">
                                        <img style="width: 120px; height: 120px; float: right" src="{{ url('public/backend/upload/logo.png') }}">
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4 text-center" style="float: left">
                                        <h4><strong>AL HERA SHISHU ACADEMY</strong></h4>
                                        <h6><strong>Ambari, Domar, Nilphamari</strong></h6>
                                        <h5><strong><i><u>www.ahsabd.net</u></i></strong></h5>
                                        <h6><strong>{{ $all_marks[0]->exam_type->name }}</strong></h6>
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
                                                    <td class="text-center">{{ @$row->assign_subject->subject->name }}</td>
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
                                            @php
                                                $settings = DB::table('settings')->first();
                                            @endphp
                                            <tr>
                                                <td width="50%"><strong>Working days</strong></td>
                                                <td width="50%"><b>{{ $settings->working_days }}</b></td>
                                            </tr>

                                            <tr>
                                                <td width="50%"><strong>Student attendance</strong></td>
                                                <td width="50%"><b>{{ $all_marks[0]->user->student_attendance }}</b></td>
                                            </tr>


                                            <tr>
                                                <td width="50%"><strong>Position</strong></td>
                                                <td width="50%"><b></b></td>
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
                                                        <b>{{ $count_fail }}</b>
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
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>

                                <div class="row">
                                    <div class="col-md-4">
                                        <hr style="border: solid 1px; width: 60%; color: #000; margin-bottom: -3px">
                                        <div class="text-center">Teacher</div>
                                    </div>
                                    <div class="col-md-4">

                                    </div>
                                    <div class="col-md-4">
                                        <hr style="border: solid 1px; width: 60%; color: #000; margin-bottom: -3px">
                                        <div class="text-center">Principal</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection

@push('js')

@endpush

