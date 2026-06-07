<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12px; }
        table { width:100%; border-collapse: collapse; }
        th,td { border:1px solid #000; padding:6px; }
        th { background:#e7e7e7; }
        .header { text-align:center; margin-bottom:20px; }
    </style>
</head>

<body>

<div class="header">
    <img src="{{ public_path('assets/images/logo_jasamarga.png') }}" height="60">
    <h2>Laporan Survey</h2>
</div>

<table>
<thead>
<tr>
    <th>Tanggal</th>
    <th>Unit</th>
    <th>Ruangan</th>
    <th>Metode</th>
    <th>Status</th>
    <th>Jumlah Aset</th>
    <th>Petugas</th>
</tr>
</thead>

<tbody>
@foreach($data as $s)
<tr>
    <td>{{ $s->scheduled_date }}</td>
    <td>{{ $s->unit->full_name }}</td>
    <td>{{ $s->room->name }}</td>
    <td>{{ $s->survey_method }}</td>
    <td>{{ $s->status }}</td>
    <td>{{ $s->items->count() }}</td>
    <td>{{ $s->performer->name ?? '-' }}</td>
</tr>
@endforeach
</tbody>

</table>

</body>
</html>
