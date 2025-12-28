<!DOCTYPE html>
<html>
<head>
    <title>Tambah Smartphone</title>
</head>
<body>

<h1>Tambah Smartphone</h1>

<form action="{{ route('smartphones.store') }}" method="POST">
    @csrf

    <input type="text" name="brand" placeholder="Brand"><br><br>
    <input type="text" name="model" placeholder="Model"><br><br>
    <input type="number" name="ram" placeholder="RAM (GB)"><br><br>
    <input type="number" name="camera" placeholder="Camera (MP)"><br><br>
    <input type="number" name="battery" placeholder="Battery (mAh)"><br><br>
    <input type="number" name="price" placeholder="Price"><br><br>

    <button type="submit">Simpan</button>
</form>

</body>
</html>
