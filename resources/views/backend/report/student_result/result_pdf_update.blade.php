<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students Result</title>
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
</head>
<style>
    table{border-collapse: collapse}
    h2 h3{margin: 0; border: 0}
    .table{width: 100%;margin-bottom: 1rem;background-color: transparent}
    .table th, .table td{padding: 0.7rem;vertical-align: top;border-top: 1px solid #dee2e6}
    .table thead th{vertical-align: bottom;border-bottom: 2px solid #dee2e6}
    .table tbody + tbody{border-top: 2px solid #dee2e6}
    .table .table{background-color: #fff}
    .table-bordered{border: 1px solid #dee2e6}
    .table-bordered th, .table-bordered td{border: 1px solid #dee2e6}
    .table-bordered thead th, .table-bordered thead td{border-bottom-width: 2px}
    .text-center{text-align: center}
    .text-right{text-align: right}
    .table tr td{padding: 5px}
    .table-bordered thead th, .table-bordered td, .table-bordered th{border: 1px solid black !important;}
    .table-bordered thead th{background-color: #cacaca}
    td{padding: 5px}
</style>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table width="80%">
                <tr>
                    <td width="33%" class="text-center">
                        <img style="width: 100px; height: 100px" src="{{ asset('public/backend/upload/logo.png') }}">
                    </td>
                    <td class="text-center" width="63%">
                        <h4><strong>AL HERA SHISHU ACADEMY</strong></h4>
                        <h4><strong>Ambari, Domar, Nilphamari</strong></h4>
                        <h4><strong>www.ahsabd.net</strong></h4>
                    </td>
                    <td class="text-center">

                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-12 text-center">
            <h5 style="font-weight: bold; padding-top: -25px">Result of {{ $exam }}</h5>
        </div>
        <div class="col-md-12">
            <table border="0" width="100%" cellpadding="1" cellspacing="2" style="text-align: center">
                <tbody>
                <tr>
                    <td><strong>Session : </strong>{{ $session }}</td>
                    <td></td>
                    <td></td>
                    <td><strong>Class : </strong>{{ $class }}</td>
                </tr>
                </tbody>
            </table><hr>

            <div class="col-md-12">
                <table border="1" width="100%">
                    <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>ID No</th>
                        <th width="">Letter Grade</th>
                        <th width="">Grade Point</th>
                        <th width="">Total Marks</th>
                        <th width="">Position</th>
                        <th width="">Remarks</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($final_data as $key => $data)
                    <tr>
                        <td style="text-align: left">{{ $data['student_name'] }}</td>
                        <td style="text-align: center">{{ $data['id_no'] }}</td>
                        <td style="text-align: center">{{ $data['grade_name'] }}</td>
                        <td style="text-align: center">{{ number_format($data['grade_point'], 2) }}</td>
                        <td style="text-align: center">{{ number_format($data['total_marks'], 2) }}</td>
                        <td style="text-align: center"></td>
                        <td style="text-align: center">{{ $data['remarks'] }}</td>
                    </tr>
                    @endforeach

{{--                    @foreach($all_data as $key => $data)--}}
{{--                        @php--}}
{{--                            $student_marks = \App\Model\StudentMarks::where('year_id', $data->year_id)->where('class_id', $data->class_id)->where('exam_type_id', $data->exam_type_id)->where('student_id', $data->student_id)->get();--}}
{{--                            $total_marks = 0;--}}
{{--                            $total_point = 0;--}}
{{--                            $total_fail = 0;--}}
{{--                            foreach ($student_marks as $value){--}}





{{--                                if($value->assign_subject->full_mark == '100'){--}}
{{--                                    $count_fails = \App\Model\StudentMarks::where('year_id', $value->year_id)->where('class_id', $value->class_id)->where('exam_type_id', $value->exam_type_id)->where('student_id', $value->student_id)->where('assign_subject_id', $value->assign_subject->id)->where('marks', '<', '40')->count();--}}
{{--                                }elseif ($value->assign_subject->full_mark == '50'){--}}
{{--                                    $count_fails = \App\Model\StudentMarks::where('year_id', $value->year_id)->where('class_id', $value->class_id)->where('exam_type_id', $value->exam_type_id)->where('student_id', $value->student_id)->where('assign_subject_id', $value->assign_subject->id)->where('marks', '<', '20')->count();--}}
{{--                                }elseif ($value->assign_subject->full_mark == '25'){--}}
{{--                                    $count_fails = \App\Model\StudentMarks::where('year_id', $value->year_id)->where('class_id', $value->class_id)->where('exam_type_id', $value->exam_type_id)->where('student_id', $value->student_id)->where('assign_subject_id', $value->assign_subject->id)->where('marks', '<', '10')->count();--}}
{{--                                }--}}
{{--                                $count_fail =  $total_fail += $count_fails;--}}





{{--                                $get_mark = $value->marks;--}}
{{--                                if($value->assign_subject->full_mark == 100){--}}
{{--                                    $grade_marks = \App\Model\MarksGrade::where([['start_marks', '<=', (int)$get_mark], ['end_marks', '>=', (int)$get_mark]])->first();--}}
{{--                                }elseif($value->assign_subject->full_mark == 50){--}}
{{--                                    $grade_marks = \App\Model\MarksGrade::where([['start_marks', '<=', (int)$get_mark*2], ['end_marks', '>=', (int)$get_mark*2]])->first();--}}
{{--                                }elseif($value->assign_subject->full_mark == 25){--}}
{{--                                    $grade_marks = \App\Model\MarksGrade::where([['start_marks', '<=', (int)$get_mark*4], ['end_marks', '>=', (int)$get_mark*4]])->first();--}}
{{--                                }--}}

{{--                                $grade_name = $grade_marks->grade_name;--}}
{{--                                $grade_point = number_format((float)$grade_marks->grade_point, 2);--}}
{{--                                $total_point = (float)$total_point + $grade_point;--}}

{{--                                $total_marks = $total_marks+$get_mark;--}}
{{--                            }--}}
{{--                        @endphp--}}
{{--                        <tr>--}}
{{--                            <td style="text-align: center">{{ $key+1 }}</td>--}}
{{--                            <td style="text-align: left">{{ $data->user->name }}</td>--}}
{{--                            <td style="text-align: center">{{ $data->user->id_no }} </td>--}}
{{--                            @php--}}
{{--                                $total_subject = $student_marks->count();--}}
{{--                                $grade_point_average = (float)$total_point/(float)$total_subject;--}}
{{--                                $total_grade_points = \App\Model\MarksGrade::where([['start_point', '<=', $grade_point_average], ['end_point', '>=', $grade_point_average]])->first();--}}
{{--                            @endphp--}}
{{--                            <td style="text-align: center">--}}
{{--                                @if($count_fail > 0)--}}
{{--                                    <b> F</b>--}}
{{--                                @elseif($assign_subject != $total_subject)--}}
{{--                                    <b>F</b>--}}
{{--                                @else--}}
{{--                                    <b>{{ $total_grade_points->grade_name }}</b>--}}
{{--                            @endif--}}
{{--                            <td style="text-align: center">--}}
{{--                                @if($count_fail > 0)--}}
{{--                                    0.00--}}
{{--                                @elseif($assign_subject != $total_subject)--}}
{{--                                    0.00--}}
{{--                                @else--}}
{{--                                    {{ number_format((float)$grade_point_average, '2') }}--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                            <td style="text-align: center">--}}
{{--                                @if($count_fail > 0)--}}
{{--                                    Fail--}}
{{--                                @elseif($assign_subject != $total_subject)--}}
{{--                                    0.00--}}
{{--                                @else--}}
{{--                                    {{ $total_grade_points->remarks }}--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                            <td>--}}

{{--                                {{ $total_marks }}--}}

{{--                        </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
                    </tbody>
                </table>
            </div>

            <i style="font-size: 12px; float: right;">Print Date : {{ date("d M Y") }}</i>
        </div><br><br><br>
        <div class="col-md-12">
            <table border="0" width="100%">
                <tbody>
                <tr>
                    <td style="width: 30%"></td>
                    <td style="width: 30%"></td>
                    <td style="width: 40%; text-align: center">
                        <hr style="border: 1px solid;width: 60%;collapse: #000;margin-bottom: 0px;">
                        <p style="text-align: right;">Principal/Headmaster</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>
</body>
</html>
