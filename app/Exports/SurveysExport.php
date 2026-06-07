<?php

namespace App\Exports;

use App\Domains\Surveys\Survey;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SurveysExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $q = Survey::with(['unit','room','performer','items']);

        if (!empty($this->filters['unit_id'])) {
            $q->where('unit_id', $this->filters['unit_id']);
        }
        if (!empty($this->filters['room_id'])) {
            $q->where('room_id', $this->filters['room_id']);
        }
        if (!empty($this->filters['date_from'])) {
            $q->whereDate('scheduled_date', '>=', $this->filters['date_from']);
        }
        if (!empty($this->filters['date_to'])) {
            $q->whereDate('scheduled_date', '<=', $this->filters['date_to']);
        }
        if (!empty($this->filters['performed_by'])) {
            $q->where('performed_by', $this->filters['performed_by']);
        }

        $items = $q->get();

        return $items->map(function($s){
            return [
                'ID' => $s->id,
                'Unit' => $s->unit->full_name ?? '-',
                'Ruangan' => $s->room->name ?? '-',
                'Tanggal' => $s->scheduled_date,
                'Metode' => $s->survey_method ?? '-',
                'Status' => $s->status,
                'Performed By' => $s->performer->name ?? '-',
                'Jumlah Item' => $s->items->count(),
            ];
        });
    }

    public function headings(): array
    {
        return ['ID','Unit','Ruangan','Tanggal','Metode','Status','Performed By','Jumlah Item'];
    }
}
