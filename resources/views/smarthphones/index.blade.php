<!DOCTYPE html>
<html>
<head>
    <title>Data Smartphone</title>
</head>
<body>

<h1>Data Smartphone</h1>

<a href="{{ route('smartphones.create') }}">Tambah Smartphone</a>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>Brand</th>
        <th>Model</th>
        <th>RAM</th>
        <th>Camera</th>
        <th>Battery</th>
        <th>Price</th>
    </tr>

    @foreach($smartphones as $s)
    <tr>
        <td>{{ $s->brand }}</td>
        <td>{{ $s->model }}</td>
        <td>{{ $s->ram }} GB</td>
        <td>{{ $s->camera }} MP</td>
        <td>{{ $s->battery }} mAh</td>
        <td>{{ $s->price }}</td>
    </tr>
    @endforeach
</table>

</body>
</html>
