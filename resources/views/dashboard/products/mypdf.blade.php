<!DOCTYPE html>
<html>
<head>
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

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
  <body>
    @foreach($data as $d)
    <table data-toggle="table">
      <thead>
        <tr>
          <th>barcode</th>
          <th>nama</th>
          <th>stok</th>
          <th>price</th>
          <th>kategori</th>
          <th>unit</th>
        </tr>
    <tr>
      <td>{{$d->barcode}}</td>
      <td>{{$d->name}}</td>
      <td>{{$d->stock}}</td>
      <td>Rp{{Helper::rupiahFormat($d->price)}},.</td>
      <td>{{$d->category->name}}</td>
      <td>{{$d->unit->name}}</td>
    </tr>
    @endforeach
    </tbody>
  </table>
  </div>
</body>
</html>
