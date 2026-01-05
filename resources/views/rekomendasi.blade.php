<x-app-layout>
<div class="p-6 max-w-4xl mx-auto">
<h1 class="text-2xl font-bold mb-4">Sistem Rekomendasi Smartphone</h1>

<form method="POST" action="{{ route('rekomendasi.proses') }}" class="space-y-3">
@csrf

<input type="number" name="budget" placeholder="Budget maksimum" required>

<input type="text" name="brand" placeholder="Brand (opsional)">

<input type="number" name="camera" placeholder="Minimal Kamera (MP)">
<input type="number" name="ram" placeholder="Minimal RAM (GB)">
<input type="number" name="battery" placeholder="Minimal Baterai (mAh)">

<select name="processor[]" multiple>
<option value="Snapdragon">Snapdragon</option>
<option value="MediaTek">MediaTek</option>
<option value="Apple">Apple</option>
</select>

<hr>

<label>Bobot Kamera</label>
<select name="weight_camera">@for($i=1;$i<=5;$i++)<option>{{ $i }}</option>@endfor</select>

<label>Bobot RAM</label>
<select name="weight_ram">@for($i=1;$i<=5;$i++)<option>{{ $i }}</option>@endfor</select>

<label>Bobot Baterai</label>
<select name="weight_battery">@for($i=1;$i<=5;$i++)<option>{{ $i }}</option>@endfor</select>

<button type="submit">Proses Rekomendasi</button>
</form>
</div>
</x-app-layout>
