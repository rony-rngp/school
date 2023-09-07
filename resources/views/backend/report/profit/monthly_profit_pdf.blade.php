<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monthly/Yearly Profit</title>
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

                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-12 text-center">
            <h5 style="font-weight: bold; padding-top: -25px">Monthly/Yearly Profit</h5>
        </div>
        <div class="col-md-12">

            @php
                $student_fee = \App\Model\AccountStudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');
                $other_cost = \App\Model\AccountOtherCost::whereBetween('s_date', [$start_date, $start_date])->sum('amount');
                $employee_salary = \App\Model\AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');
                $total_cost = $other_cost+$employee_salary;
                $profit = $student_fee-$total_cost;
            @endphp

            <table border="1" width="100%">
                <tbody>
                <tr>
                    <td colspan="2" style="text-align: center"><h4>Reporting Date : {{ date(' M Y', strtotime($start_date)) }} - {{ date(' M Y', strtotime($end_date)) }} </h4></td>
                </tr>
                <tr>
                    <td style="width: 50%">Student Fee</td>
                    <td>{{ $student_fee }} TK</td>
                </tr>
                <tr>
                    <td style="width: 50%">Employee Salary</td>
                    <td>{{ $employee_salary }} TK</td>
                </tr>
                <tr>
                    <td style="width: 50%">Other Cost</td>
                    <td>{{ $other_cost  }} TK</td>
                </tr>
                <tr>
                    <td style="width: 50%"><strong>Total Cost</strong></td>
                    <td><strong>{{ $total_cost }} TK</strong></td>
                </tr>
                <tr>
                    <td style="width: 50%"><strong>Profit</strong></td>
                    <td><strong>{{ $profit }} TK</strong></td>
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
