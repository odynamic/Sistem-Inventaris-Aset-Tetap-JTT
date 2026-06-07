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
    <h2>Laporan Pengajuan Aset</h2>
</div>

<table>
<thead>
<tr>
    <th>Tanggal</th>
    <th>User</th>
    <th>Jenis</th>
    <th>Status</th>
    <th>Unit</th>
    <th>Ruangan</th>
    <th>Nama Aset</th>
</tr>
</thead>

<tbody>
@foreach($data as $s)
<tr>
    <td>{{ $s->created_at->format('Y-m-d') }}</td>
    <td>{{ $s->user->name }}</td>
    <td>{{ $s->type }}</td>
    <td>{{ $s->status }}</td>
    <td>{{ $s->addUnit->full_name ?? ($s->asset->unit->full_name ?? '-') }}</td>
    <td>{{ $s->addRoom->name ?? ($s->asset->room->name ?? '-') }}</td>
    <td>{{ $s->asset->name ?? ($s->add_name ?? '-') }}</td>
</tr>
@endforeach
</tbody>

</table>

</body>
</html>
