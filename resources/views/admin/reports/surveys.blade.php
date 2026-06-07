<x-layouts.main title="Laporan Survey">

<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-9">
        <h1 class="text-xl font-semibold text-gray-800">Laporan Survey</h1>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('admin.reports.surveys', array_merge(request()->all(), ['export' => 'excel'])) }}"
           class="px-4 py-2 text-sm rounded-lg bg-blue-700 text-white shadow hover:bg-blue-800 transition">
            <i class="ph ph-file-arrow-down"></i> Export Excel
        </a>

        <a href="{{ route('admin.reports.surveys', array_merge(request()->all(), ['export' => 'pdf'])) }}"
           class="px-4 py-2 text-sm rounded-lg bg-red-600 text-white shadow hover:bg-red-700 transition">
            <i class="ph ph-file-pdf"></i> Export PDF
        </a>
    </div>
</div>

<div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 mb-6">
    <form method="GET">

        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
            
            {{-- UNIT --}}
            <div>
                <label for="unitSelect" class="text-[11px] text-gray-600 font-semibold block mb-1">Unit Kerja</label>
                <select name="unit_id" id="unitSelect"
                    class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]">
                    <option value="">Semua</option>
                    @foreach($units as $u)
                        <option value="{{ $u->id }}" @selected(request('unit_id') == $u->id)>
                            {{ $u->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- RUANGAN --}}
            <div>
                <label for="roomSelect" class="text-[11px] text-gray-600 font-semibold block mb-1">Ruangan</label>
                <select name="room_id" id="roomSelect"
                    class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]">
                    <option value="">Semua</option>
                    @foreach($rooms as $r)
                        <option value="{{ $r->id }}" data-unit="{{ $r->unit_id }}"
                            @selected(request('room_id') == $r->id)>
                            {{ $r->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- TANGGAL MULAI --}}
            <div>
                <label for="startDateInput" class="text-[11px] text-gray-600 font-semibold block mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" id="startDateInput" value="{{ request('start_date') }}"
                    class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]">
            </div>

            {{-- TANGGAL AKHIR --}}
            <div>
                <label for="endDateInput" class="text-[11px] text-gray-600 font-semibold block mb-1">Tanggal Akhir</label>
                <input type="date" name="end_date" id="endDateInput" value="{{ request('end_date') }}"
                    class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]">
            </div>

            {{-- PERFORMED BY --}}
            <div>
                <label for="performedBySelect" class="text-[11px] text-gray-600 font-semibold block mb-1">Dilakukan oleh</label>
                <select name="performed_by" id="performedBySelect"
                    class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]">
                    <option value="">Semua</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}" @selected(request('performed_by')==$u->id)>
                            {{ $u->name }}
                        </option>
                    @endforeach
                </select>
            </div>

{{-- TOMBOL CARI & RESET (Kolom ke-6) --}}
            <div class="flex items-end gap-2 w-full">
                
                {{-- Logika Filter untuk Reset --}}
                @php
                    $activeFilters = ['unit_id', 'room_id', 'start_date', 'end_date', 'performed_by'];
                    $isFiltered = request()->anyFilled($activeFilters);
                @endphp

                {{-- Tombol Cari: Tambahkan logika w-full/flex-grow kondisional --}}
                <button type="submit" 
                    class="h-fit px-5 py-2 bg-[#0F3B89] text-white rounded-lg text-sm flex items-center justify-center gap-1 hover:bg-[#0d3373] font-semibold 
                    
                    {{-- JIKA TIDAK ADA FILTER, GUNAKAN W-FULL (Penuh) --}}
                    @if(!$isFiltered)
                        w-full
                    @else
                    {{-- JIKA ADA FILTER, GUNAKAN FLEX-GROW (Menciut) --}}
                        flex-grow
                    @endif
                    ">
                    <i class="ph ph-magnifying-glass text-lg"></i> Cari
                </button>

                @if($isFiltered)
                {{-- Tombol Reset: w-10 memastikan dia kecil dan flex-shrink-0 memastikan dia tidak menyusut --}}
                <a href="{{ route('admin.reports.surveys') }}"
                    class="w-10 h-fit py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200 shadow flex-shrink-0 flex items-center justify-center"
                    title="Reset Filter">
                    <i class="ph ph-x text-lg"></i>
                </a>
                @endif
            </div>        </div>

    </form>
</div>
<div class="bg-white p-5 rounded-xl shadow-sm border">

    <table class="w-full text-sm border-collapse">
        <thead>
        <tr class="bg-[#F4F6FA] text-gray-600 text-[11px] uppercase tracking-wide">
            <th class="p-3 border">Tanggal</th>
            <th class="p-3 border">Unit</th>
            <th class="p-3 border">Ruangan</th>
            <th class="p-3 border">Metode</th>
            <th class="p-3 border">Status</th>
            <th class="p-3 border">Jumlah Aset</th>
            <th class="p-3 border">Dilakukan Oleh</th>
        </tr>
        </thead>

        <tbody>
        @forelse($data as $s)
            <tr class="border-b text-center hover:bg-gray-50">
                <td class="p-3">{{ $s->scheduled_date }}</td>
                <td class="p-3">{{ $s->asset->unit->room->full_name }}</td>
                <td class="p-3">{{ $s->room->name }}</td>
                <td class="p-3 capitalize">{{ $s->survey_method }}</td>
                <td class="p-3 capitalize">{{ str_replace('_',' ',$s->status) }}</td>
                <td class="p-3">{{ $s->items->count() }}</td>
                <td class="p-3">{{ $s->performer->name ?? '-' }}</td>
            </tr>
        @empty
            <tr><td colspan="7" class="py-4 text-gray-500 text-center">Tidak ada data.</td></tr>
        @endforelse
        </tbody>

    </table>

</div>

</x-layouts.main>