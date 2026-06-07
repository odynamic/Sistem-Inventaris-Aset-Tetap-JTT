<?php

namespace App\Exports;

use App\Domains\Assets\Asset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AssetsExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Asset::with(['unit','room']);

        if (!empty($this->filters['unit_id'])) {
            $query->where('unit_id', $this->filters['unit_id']);
        }
        if (!empty($this->filters['room_id'])) {
            $query->where('room_id', $this->filters['room_id']);
        }
        if (!empty($this->filters['condition'])) {
            $query->where('condition', $this->filters['condition']);
        }
        if (!empty($this->filters['start_year'])) {
            $query->where('acquired_year', '>=', $this->filters['start_year']);
        }
        if (!empty($this->filters['end_year'])) {
            $query->where('acquired_year', '<=', $this->filters['end_year']);
        }
        if (!empty($this->filters['acquired_year'])) {
            $query->where('acquired_year', $this->filters['acquired_year']);
        }

        $items = $query->get();

        // Normalize to a collection of arrays
        return $items->map(function($a) {
            return [
                'Kode' => $a->code,
                'Nama' => $a->name,
                'Unit' => $a->unit->full_name ?? '-',
                'Ruangan' => $a->room->name ?? '-',
                'Qty' => ($a->quantity ?? '-') . ' ' . ($a->unit ?? ''),
                'Kondisi' => strtoupper($a->condition ?? '-'),
                'Tahun' => $a->acquired_year ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return ['Kode','Nama','Unit','Ruangan','Qty','Kondisi','Tahun'];
    }
}
