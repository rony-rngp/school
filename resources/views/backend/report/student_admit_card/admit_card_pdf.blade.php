<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Admit Card</title>
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
</head>
<style>

</style>
<body>
<div class="container">
    @foreach($all_data as $row)
        <div class="row" style="margin-top:200px; margin-bottom:100px">
            <div style="border: 1px solid #000; margin: 30px 30px 30px 30px">
               
                <table border="0" width="100%" style="padding:8px">
                    <tbody>
                    <tr>
                        <td width="15%" style="padding: 20px;text-align: left">
                            <img height="63px" width="63px" src="{{ asset('public/backend/upload/logo.png') }}">
                        </td>
                        <td width="70%" style="text-align: center">
                            <br>
                            <br>
                            <p style="color: red; font-size: 28px; margin-bottom: 5px !important;"><strong>AL HERA SHISHU ACADEMY</strong></p><br>
                            <p style="padding: 5px;font-size: 24px;">Student Admit Card</p><br>
                            <p style="padding: 5px;font-size: 24px;"><b>{{ $exam_type }}</b></p>
                        </td>
                        <td width="15%" style="padding: 20px; text-align: right;">
                            <img height="63px" width="63px" src="{{ file_exists($row->user->image) ? url($row->user->image) : asset('public/backend/upload/no_image.png') }}">
                        </td>
                    </tr>
                    <br><br>
                    <tr >
                        <td width="45%" style="padding: 10px 3px 10px 5px; font-size: 20px">
                            <strong>Name : </strong> {{ $row->user->name }}
                        </td>
                        <td width="10%" style="padding: 10px 3px 10px 5px; font-size: 20px">
                        </td>
                        <td width="45%" style="padding: 10px 3px 10px 5px; font-size: 20px;">
                            <strong>Id No : </strong> {{ $row->user->id_no }}
                        </td>
                    </tr>
                    <br><br>
                    <tr>
                        <td width="40%" style="padding: 10px 3px 10px 5px; font-size: 20px">
                            <strong>Session : </strong> {{ $row->year->name }}
                        </td>
                        <td width="20%" style="padding: 10px 3px 10px 5px; font-size: 20px; text-align: center">
                            <strong>Class : </strong> {{ $row->class->name }}
                        </td>
                        <td width="40%" style="padding: 10px 3px 10px 5px; font-size: 20px;">
                            <strong>Roll : </strong> {{ $row->roll }}
                        </td>
                    </tr>
                    <br><br>
                    <tr>
                        <td width="33%" style="padding: 10px 3px 10px 5px; font-size: 20px"></td>
                        <td width="33%" style="padding: 10px 3px 10px 5px; font-size: 20px"></td>
                        <td width="33%" style="padding: 10px 3px 10px 5px; font-size: 20px"></td>
                    </tr>
                    <tr>
                        <td width="50%" style="padding: 10px 3px 10px 5px; font-size: 20px">
                            <strong>Mobile No : </strong>{{ $row->user->mobile }}
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>

                        <td style="text-align: center">
                            <br>
                            <hr style="border: solid 1px; width: 50%; color: #000; margin-bottom: 0; margin-left: 290px">
                            <p style="text-align: center">Principal</p>
                        </td>
                    </tr>
                    <br>
                    <br>
                    </tbody>
                </table>
                
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
