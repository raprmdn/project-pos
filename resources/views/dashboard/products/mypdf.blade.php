<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
<table>
    <thead>
        <tr>
            <th>Barcode</th>
            <th>Nama</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Satuan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
            <tr>
                <td>{{$d->barcode}}</td>
                <td>{{$d->name}}</td>
                <td>{{$d->stock}}</td>
                <td>Rp. {{Helper::rupiahFormat($d->price)}}</td>
                <td>{{$d->category->name}}</td>
                <td>{{$d->unit->name}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
