<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, 'Times New Roman', Times, serif;
            font-size: 12px;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header img {
            margin-bottom: 5px;
        }

        h2 {
            margin: 5px 0 0 0;
            font-size: 18px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 5px;
        }

        th {
            background: #f0f0f0;
            font-weight: bold;
            font-size: 12px;
        }

        td {
            font-size: 11px;
        }
    </style>
</head>

<body>

<div class="header">
    <img src="{{ public_path('assets/images/logo_jasamarga.png') }}" height="55">
    <h2>LAPORAN ASET</h2>

    @if(!empty($filters))
        <div style="margin-top:8px; font-size:11px;">
            @if(!empty($filters['unit_id']))
                Unit: {{ \App\Domains\Units\Unit::find($filters['unit_id'])->full_name ?? '-' }} <br>
            @endif

            @if(!empty($filters['room_id']))
                Ruangan: {{ \App\Domains\Rooms\Room::find($filters['room_id'])->name ?? '-' }} <br>
            @endif

            @if(!empty($filters['condition']))
                Kondisi: {{ ucfirst($filters['condition']) }} <br>
            @endif

            @if(!empty($filters['year_from']) || !empty($filters['year_to']))
                Tahun:
                {{ $filters['year_from'] ?? '-' }} - {{ $filters['year_to'] ?? '-' }}
            @endif
        </div>
    @endif

</div>

<table>
<thead>
<tr>
    <th style="width:13%;">Kode</th>
    <th style="width:22%;">Nama</th>
    <th style="width:20%;">Unit</th>
    <th style="width:18%;">Ruangan</th>
    <th style="width:7%;">Qty</th>
    <th style="width:10%;">Kondisi</th>
    <th style="width:10%;">Tahun</th>
</tr>
</thead>

<tbody>
@forelse($data as $a)
<tr>
    <td>{{ $a->code }}</td>
    <td>{{ $a->name }}</td>
    <td>{{ $a->unit->full_name ?? '-' }}</td>
    <td>{{ $a->room->name ?? '-' }}</td>
    <td>{{ $a->quantity }} {{ $a->unit }}</td>
    <td>{{ ucfirst($a->condition) }}</td>
    <td>{{ $a->acquired_year }}</td>
</tr>
@empty
<tr>
    <td colspan="7" style="text-align:center; padding:10px;">Tidak ada data</td>
</tr>
@endforelse
</tbody>
</table>

</body>
</html>
