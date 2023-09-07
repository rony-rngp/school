<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Attendance</title>
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
                        <h4><strong>Amader School</strong></h4>
                        <h4><strong>Chilahati, Nilphamari</strong></h4>
                        <h4><strong>www.amaderschool.com</strong></h4>
                    </td>
                    <td class="text-center">
                        <img style="width: 100px; height: 100px" src="{{ $all_data[0]->user->image ? URL($all_data[0]->user->image) : asset('public/backend/upload/no_image.png') }}">
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-12 text-center">
            <h5 style="font-weight: bold; padding-top: -25px">Employee Attendance Report</h5>
        </div>
        <div class="col-md-12">
            <strong>Employee Name : </strong>{{ $all_data[0]->user->name }}, <strong>ID NO : </strong>{{ $all_data[0]->user->id_no }}, <strong>Month : </strong>{{ $month }}
            <table border="1" width="100%">
                <tbody>
                <tr>
                    <th>Date</th>
                    <th>Attendance</th>
                </tr>
                @foreach($all_data as $row)
                    <tr>
                        <td style="text-align: center">{{ date('d-m-Y', strtotime($row->date)) }}</td>
                        <td style="text-align: center">{{ $row->attend_status }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td style="text-align: center" colspan="2">
                        <strong>Total Absent : </strong>{{ $absents }}, <strong>Total Leave : </strong>{{ $leaves }}
                    </td>
                </tr>
                </tbody>
            </table>
            <i style="font-size: 12px; float: right;">Print Date : {{ date("d M Y") }}</i>
        </div>
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
