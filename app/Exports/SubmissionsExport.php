<?php

namespace App\Exports;

use App\Domains\Submissions\Submission;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubmissionsExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $q = Submission::with(['user','asset.unit','asset.room','addUnit','addRoom']);

        // USER
        if (!empty($this->filters['user_id'])) {
            $q->where('user_id', $this->filters['user_id']);
        }

        // TIPE
        if (!empty($this->filters['type'])) {
            $q->where('type', $this->filters['type']);
        }

        // STATUS
        if (!empty($this->filters['status'])) {
            $q->where('status', $this->filters['status']);
        }

        // UNIT
        if (!empty($this->filters['unit_id'])) {
            $unitId = $this->filters['unit_id'];

            $q->where(function($qq) use ($unitId) {
                $qq->whereHas('asset', fn($a) => $a->where('unit_id', $unitId))
                   ->orWhere('add_unit_id', $unitId);
            });
        }

        // ROOM
        if (!empty($this->filters['room_id'])) {
            $roomId = $this->filters['room_id'];

            $q->where(function($qq) use ($roomId) {
                $qq->whereHas('asset', fn($a) => $a->where('room_id', $roomId))
                   ->orWhere('add_room_id', $roomId);
            });
        }

        // DATE RANGE
        if (!empty($this->filters['date_from'])) {
            $q->whereDate('created_at', '>=', $this->filters['date_from']);
        }

        if (!empty($this->filters['date_to'])) {
            $q->whereDate('created_at', '<=', $this->filters['date_to']);
        }

        $items = $q->get();

        return $items->map(function($s) {
            $unit = $s->addUnit->full_name ?? ($s->asset->unit->full_name ?? '-');
            $room = $s->addRoom->name ?? ($s->asset->room->name ?? '-');

            return [
                'ID'        => $s->id,
                'User'      => $s->user->name ?? '-',
                'Jenis'     => $s->type,
                'Deskripsi' => Str::limit($s->description, 80),
                'Unit'      => $unit,
                'Ruangan'   => $room,
                'Status'    => $s->status,
                'Tanggal'   => $s->created_at->format('Y-m-d'),
            ];
        });
    }

    public function headings(): array
    {
        return ['ID','User','Jenis','Deskripsi','Unit','Ruangan','Status','Tanggal'];
    }
}
