<x-layouts.main title="Laporan Aset">

{{-- ========================= --}}
{{-- HEADER --}}
{{-- ========================= --}}
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-9">
        <h1 class="text-xl font-semibold text-gray-800">Laporan Aset</h1>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('admin.reports.assets', array_merge(request()->all(), ['export' => 'excel'])) }}"
            class="px-4 py-2 text-sm rounded-lg bg-blue-700 text-white shadow flex items-center gap-1">
            <i class="ph ph-file-arrow-down"></i> Export Excel
        </a>

        <a href="{{ route('admin.reports.assets', array_merge(request()->all(), ['export' => 'pdf'])) }}"
            class="px-4 py-2 text-sm rounded-lg bg-red-600 text-white shadow flex items-center gap-1">
            <i class="ph ph-file-pdf"></i> Export PDF
        </a>
    </div>
</div>

{{-- FILTER --}}
<div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 mb-6">
    <form method="GET">

        {{-- Grid utama: 6 kolom pada medium/desktop --}}
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

            {{-- KONDISI --}}
            <div>
                <label for="conditionSelect" class="text-[11px] text-gray-600 font-semibold block mb-1">Kondisi</label>
                <select name="condition" id="conditionSelect"
                    class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]">
                    <option value="">Semua</option>
                    <option value="baik" @selected(request('condition')=='baik')>Baik</option>
                    <option value="rusak" @selected(request('condition')=='rusak')>Rusak</option>
                    <option value="hilang" @selected(request('condition')=='hilang')>Hilang</option>
                </select>
            </div>

            {{-- TAHUN MULAI --}}
            <div>
                <label for="startYearInput" class="text-[11px] text-gray-600 font-semibold block mb-1">Tahun Mulai</label>
                <input type="number" name="start_year" id="startYearInput"
                    class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]"
                    placeholder="2025" value="{{ request('start_year') }}">
            </div>

            {{-- TAHUN AKHIR --}}
            <div>
                <label for="endYearInput" class="text-[11px] text-gray-600 font-semibold block mb-1">Tahun Akhir</label>
                <input type="number" name="end_year" id="endYearInput"
                    class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]"
                    placeholder="2005" value="{{ request('end_year') }}">
            </div>
            
            {{-- PENCARIAN & TOMBOL (Memakai kolom terakhir) --}}
            <div class="md:col-span-1">
                {{-- Label dipindahkan ke atas input --}}
                <label for="searchInput" class="text-[11px] text-gray-600 font-semibold block mb-1">Pencarian</label>
                <div class="flex gap-2">
                    <input type="text" name="search" id="searchInput"
                        class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]"
                        placeholder="Cari nama aset..." value="{{ request('search') }}">
                    <button type="submit" class="px-5 py-2 bg-[#0F3B89] text-white rounded-lg text-sm flex items-center gap-1 hover:bg-[#0d3373] font-semibold flex-shrink-0">
                        <i class="ph ph-magnifying-glass text-lg"></i>
                    </button>
                </div>
            </div>

        </div>

    </form>
</div>{{-- ========================= --}}
{{-- TABLE --}}
{{-- ========================= --}}
<div class="bg-white p-5 rounded-xl shadow-sm border">

    <table class="w-full text-sm border-collapse">
        <thead>
        <tr class="bg-[#F4F6FA] text-gray-600 text-[11px] uppercase tracking-wide text-center">
            <th class="py-2 px-3">No</th>
            <th class="p-2 border">Kode</th>
            <th class="p-2 border">Nama</th>
            <th class="p-2 border">Unit</th>
            <th class="p-2 border">Ruangan</th>
            <th class="p-2 border">Qty</th>
            <th class="p-2 border">Kondisi</th>
            <th class="p-2 border">Tahun</th>
        </tr>
        </thead>

        <tbody>
        @forelse($data as $a)
            <tr class="border-b text-center hover:bg-gray-50">
                    <td class="py-1.5 px-3">{{ $loop->iteration }}</td>
                <td class="p-2">{{ $a->code }}</td>
                <td class="p-2 text-left font-medium">{{ $a->name }}</td>
                <td class="p-2">{{ $a->room->unit->full_name ?? '-' }}</td>
                <td class="p-2">{{ $a->room->name ?? '-' }}</td>
                <td class="p-2">{{ $a->quantity }}</td>
                <td class="p-2 uppercase">{{ $a->condition }}</td>
                <td class="p-2">{{ $a->acquired_year }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="py-4 text-gray-500 text-center">
                    Tidak ada data.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>


{{-- ========================= --}}
{{-- JS: FILTER ROOM BY UNIT --}}
{{-- ========================= --}}
<script>
    const unitSelect = document.getElementById('unitSelect');
    const roomSelect = document.getElementById('roomSelect');

    function filterRooms() {
        const selectedUnit = unitSelect.value;

        [...roomSelect.options].forEach(opt => {
            if (!opt.value) return; // skip "Semua"

            opt.hidden = selectedUnit && opt.dataset.unit !== selectedUnit;
        });
    }

    filterRooms(); // initial load
    unitSelect.addEventListener('change', filterRooms);
</script>

</x-layouts.main>
