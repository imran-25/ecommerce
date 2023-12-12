

<!DOCTYPE html>
<html>
<head>
<style>
table, td, th {
  border: 1px solid;
}

table {
  width: 100%;
  border-collapse: collapse;
}
</style>
</head>
<body>

<h2 style="text-align: center">Category Report</h2>

<table>
  <tr>
    <th>Ser No</th>
    <th>Title</th>
    <th>Description</th>
  </tr>

  @php
      $ser = 1;
  @endphp

@foreach ($categories as $category)
    <tr>
        <td>{{ $ser++}}</td>
        <td>{{ $category->name }}</td>
        <td>{!! $category->description !!}</td>
    </tr>
@endforeach
 
  
</table>

</body>
</html>




