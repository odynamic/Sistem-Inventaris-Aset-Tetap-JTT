<?php

namespace App\Domains\Submissions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domains\Assets\Asset;
use App\Domains\Rooms\Room;
use App\Models\User;

class Submission extends Model
{
    protected $table = 'submissions';
    
    // 🔥 SOLUSI WORKAROUND: Memaksa relasi 'asset' dimuat secara default.
    // Ini membantu mengatasi masalah caching relasi dan menghilangkan kebutuhan memanggil with('asset') di Controller.
    protected $with = ['asset']; 
    
    protected $fillable = [
        'user_id', 'type', 'status', 'description', 'photo', 'admin_note',

        // untuk UPDATE & DELETE
        'room_id', 'asset_id',

        // ADD
        'add_room_id', 'add_name', 'add_quantity', 'add_unit_id', 
        'add_condition', 'add_acquired_year',

        // UPDATE
        'new_condition', 'new_quantity', 'new_name',

        // DELETE
        'old_condition', 'old_quantity',
    ];

    protected $casts = [
        'add_quantity' => 'integer',
        'new_quantity' => 'integer',
        'old_quantity' => 'integer',
        'add_acquired_year' => 'integer',
    ];

    // ----------------------------
    // RELATIONS
    // ----------------------------
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Ruang lama (update/delete) */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /** Ruang baru (add) */
    public function addRoom(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'add_room_id');
    }

    /** 🔥 RELASI KRITIS: Aset untuk update/delete */
    public function asset(): BelongsTo
    {
        // Menggunakan withTrashed() agar aset yang sudah dihapus (soft delete) tetap bisa diakses.
        return $this->belongsTo(Asset::class, 'asset_id')->withTrashed();
    }

    public function addUnit()
{
    return $this->belongsTo(\App\Domains\Units\Unit::class, 'add_unit_id');
}

    // ----------------------------
    // ACCESSORS
    // ----------------------------
    
    /**
     * Menghitung detail aset yang akan ditampilkan di kolom 'DETAIL' pada tabel.
     */
    public function getDetailTextAttribute(): string
    {
        // 1. Jika tipe Penambahan, gunakan nama yang diusulkan
        if ($this->type === 'penambahan') {
            return $this->add_name ?? 'N/A';
        }

        // 2. Untuk Perubahan dan Penghapusan, gunakan relasi Asset
        if ($this->asset) {
            $code = $this->asset->code ? "[{$this->asset->code}] " : '';
            return $code . $this->asset->name;
        }
        
        // 3. Fallback jika asset_id ada tapi data asetnya hilang
        if ($this->asset_id) {
            return 'Aset ID ' . $this->asset_id . ' (Tidak Ditemukan)';
        }

        return '-'; // Fallback umum
    }
    
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'    => 'yellow',
            'approved'   => 'green',
            'rejected'   => 'red',
            'dibatalkan' => 'gray',
            default      => 'gray',
        };
    }
}