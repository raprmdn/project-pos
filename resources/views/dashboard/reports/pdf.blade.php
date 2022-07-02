<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report {{ $startDate }} - {{ $startDate }}</title>
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 12px;
        }
        .text-center {
            text-align: center;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 8px;
            line-height: 20px;
            text-align: left;
            border-top: 1px solid #dddddd;
        }
        .table th {
            font-weight: bold;
        }
        .table thead th {
            vertical-align: bottom;
        }
        .table caption + thead tr:first-child th, .table caption + thead tr:first-child td, .table colgroup + thead tr:first-child th, .table colgroup + thead tr:first-child td, .table thead:first-child tr:first-child th, .table thead:first-child tr:first-child td {
            border-top: 0
        }
        .table tbody + tbody {
            border-top: 2px solid #dddddd;
        }
        .table .table {
            background-color: #fff;
        }
        .table-condensed th, .table-condensed td {
            padding: 4px 5px;
        }
        .table-bordered {
            border: 1px solid #dddddd;
            border-collapse: separate;
            border-left: 0;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
        }
        .table-bordered th, .table-bordered td {
            border-left: 1px solid #dddddd;
        }
        .table-bordered caption + thead tr:first-child th, .table-bordered caption + tbody tr:first-child th, .table-bordered caption + tbody tr:first-child td, .table-bordered colgroup + thead tr:first
    </style>
</head>
<body>
    <h3 class="text-center">Report</h3>
    <h4 class="text-center">
        Tanggal {{ $startDate }} s/d Tanggal {{ $endDate }}
    </h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Tanggal</th>
                <th>Pembelian</th>
                <th>Pengeluaran</th>
                <th>Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    @foreach($item as $val)
                        <td>{{ $val }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
