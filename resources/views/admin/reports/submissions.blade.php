<x-layouts.main title="Laporan Pengajuan">

<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-9">
        <h1 class="text-xl font-semibold text-gray-800">Laporan Pengajuan</h1>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('admin.reports.submissions', array_merge(request()->all(), ['export' => 'excel'])) }}"
           class="px-4 py-2 text-sm rounded-lg bg-blue-700 text-white shadow">
            <i class="ph ph-file-arrow-down"></i> Export Excel
        </a>

        <a href="{{ route('admin.reports.submissions', array_merge(request()->all(), ['export' => 'pdf'])) }}"
           class="px-4 py-2 text-sm rounded-lg bg-red-600 text-white shadow">
            <i class="ph ph-file-pdf"></i> Export PDF
        </a>
    </div>
</div>

<form method="GET"
      class="bg-white p-5 rounded-xl shadow-sm border grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">

    {{-- USER --}}
    <div>
        <label class="text-[10px] text-gray-600 font-medium">User</label>
        <select name="user_id" class="w-full mt-1 border rounded-lg px-2 py-1.5 text-sm focus:ring-[#0F3B89] focus:border-[#0F3B89]">
            <option value="">Semua</option>
            @foreach($users as $u)
                <option value="{{ $u->id }}" @selected(request('user_id')==$u->id)>
                    {{ $u->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- TYPE --}}
    <div>
        <label class="text-[10px] text-gray-600 font-medium">Jenis Pengajuan</label>
        <select name="type" class="w-full mt-1 border rounded-lg px-2 py-1.5 text-sm focus:ring-[#0F3B89] focus:border-[#0F3B89]">
            <option value="">Semua</option>
            <option value="add" @selected(request('type')=='add')>Tambah</option>
            <option value="update" @selected(request('type')=='update')>Perubahan</option>
            <option value="delete" @selected(request('type')=='delete')>Hapus</option>
        </select>
    </div>

    {{-- STATUS --}}
    <div>
        <label class="text-[10px] text-gray-600 font-medium">Status</label>
        <select name="status" class="w-full mt-1 border rounded-lg px-2 py-1.5 text-sm focus:ring-[#0F3B89] focus:border-[#0F3B89]">
            <option value="">Semua</option>
            <option value="pending" @selected(request('status')=='pending')>Menunggu</option>
            <option value="approved" @selected(request('status')=='approved')>Selesai</option>
            <option value="rejected" @selected(request('status')=='rejected')>Ditolak</option>
        </select>
    </div>

    {{-- ROOM --}}
    <div>
        <label class="text-[10px] text-gray-600 font-medium">Ruangan</label>
        <select name="room_id" class="w-full mt-1 border rounded-lg px-2 py-1.5 text-sm focus:ring-[#0F3B89] focus:border-[#0F3B89]">
            <option value="">Semua</option>
            @foreach($rooms as $r)
                <option value="{{ $r->id }}" @selected(request('room_id')==$r->id)>
                    {{ $r->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- TOMBOL CARI & RESET --}}
    <div class="flex items-end gap-2 w-full">
        
        {{-- Logika Filter untuk Reset (TELAH DIPERBAIKI) --}}
        @php
            $activeFilters = ['user_id', 'type', 'status', 'unit_id', 'room_id']; // Daftar filter yang benar
            $isFiltered = request()->anyFilled($activeFilters);
        @endphp

        {{-- Tombol Cari: w-full saat sendirian, flex-grow saat ada Reset --}}
        <button type="submit" 
            class="h-fit px-5 py-2 bg-[#0F3B89] text-white rounded-lg text-sm flex items-center justify-center gap-1 hover:bg-[#0d3373] font-semibold 
            
            {{-- JIKA TIDAK ADA FILTER ($isFiltered=false), gunakan w-full --}}
            @if(!$isFiltered)
                w-full
            @else
            {{-- JIKA ADA FILTER ($isFiltered=true), gunakan flex-grow --}}
                flex-grow
            @endif
            ">
            <i class="ph ph-magnifying-glass text-lg"></i> Cari
        </button>

        @if($isFiltered)
        {{-- Tombol Reset: w-10 fixed width --}}
        <a href="{{ route('admin.reports.submissions') }}"
            class="w-10 h-fit py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200 shadow flex-shrink-0 flex items-center justify-center"
            title="Reset Filter">
            <i class="ph ph-x text-lg"></i>
        </a>
        @endif
    </div>
</form>

<div class="bg-white p-5 rounded-xl shadow-sm border">
    {{-- Tabel tetap sama --}}
    <table class="w-full text-sm border-collapse">
        <thead>
            <tr class="bg-[#F4F6FA] text-gray-600 text-[11px] uppercase tracking-wide">
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">User</th>
                <th class="p-2 border">Jenis</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Ruangan</th>
                <th class="p-2 border">Aset</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $s)
                <tr class="border-b text-center hover:bg-gray-50">
                    <td class="p-2">{{ $s->created_at->format('Y-m-d') }}</td>
                    <td class="p-2">{{ $s->user->name }}</td>
                    <td class="p-2 uppercase">{{ $s->type }}</td>
                    <td class="p-2 capitalize">{{ $s->status }}</td>
                    <td class="p-2">{{ $s->addRoom->name ?? ($s->asset->room->name ?? '-') }}</td>
                    <td class="p-2">{{ $s->asset->name ?? ($s->add_name ?? '-') }}</td>
                </tr>
            @empty
                <tr><td colspan="7" class="py-4 text-gray-500">Tidak ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

</x-layouts.main>