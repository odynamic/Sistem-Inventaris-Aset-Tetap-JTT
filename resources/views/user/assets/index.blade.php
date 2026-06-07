<x-layouts.main title="Data Aset">

<div>

    {{-- ========================= --}}
    {{-- HEADER --}}
    {{-- ========================= --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-9" alt="">
            <h1 class="text-xl font-semibold text-gray-800 tracking-wide">Data Aset</h1>
        </div>

        {{-- BUTTON PENGAJUAN --}}
        <a href="{{ route('user.submissions.create') }}"
           class="px-4 py-2 bg-[#0F3B89] text-white rounded-lg shadow hover:bg-[#0d3373] flex items-center gap-2 text-sm">
            <i class="ph ph-plus-circle text-lg"></i>
            Lakukan Pengajuan
        </a>
    </div>


    {{-- ========================= --}}
    {{-- FILTER --}}
    {{-- ========================= --}}
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 mb-6">
        <form action="{{ route('user.assets.index') }}" method="GET"
              class="grid grid-cols-1 md:grid-cols-4 gap-4">

            {{-- Kondisi --}}
            <div>
                <label class="text-[11px] text-gray-600 font-semibold">Kondisi</label>
                <select name="condition"
                        class="w-full mt-1 rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Kondisi</option>
                    <option value="Baik" {{ request('condition')=='Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak" {{ request('condition')=='Rusak' ? 'selected' : '' }}>Rusak</option>
                    <option value="Hilang" {{ request('condition')=='Hilang' ? 'selected' : '' }}>Hilang</option>
                </select>
            </div>

            {{-- Ruangan --}}
            <div>
                <label class="text-[11px] text-gray-600 font-semibold">Ruangan</label>
                <select name="room_id"
                        class="w-full mt-1 px-3 py-2 border rounded-lg text-sm focus:ring-[#0F3B89] focus:border-[#0F3B89]">
                    <option value="">Semua</option>
                    @foreach ($rooms as $r)
                        <option value="{{ $r->id }}" {{ request('room_id')==$r->id ? 'selected' : '' }}>
                            {{ $r->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Search --}}
            <div class="md:col-span-2">
                <label class="text-[11px] text-gray-600 font-semibold">Pencarian</label>
                <div class="flex gap-2 mt-1">
                    <input type="text" name="search"
                           class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-[#0F3B89] focus:border-[#0F3B89]"
                           placeholder="Cari kode atau nama aset..."
                           value="{{ request('search') }}">

                    <button class="px-5 py-2 bg-[#0F3B89] text-white rounded-lg hover:bg-[#0d3373] text-sm shadow">
                        Cari
                    </button>
                </div>
            </div>
        </form>

        {{-- RESET FILTER --}}
        @if(request()->filled('condition') || request()->filled('room_id') || request()->filled('search'))
        <div class="mt-4 text-right">
            <a href="{{ route('user.assets.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm shadow hover:bg-gray-200">
                <i class="ph ph-arrow-counter-clockwise text-base"></i>
                Reset Filter
            </a>
        </div>
        @endif
    </div>


    {{-- ========================= --}}
    {{-- TABLE --}}
    {{-- ========================= --}}
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
        <table class="w-full text-sm text-center">
            <thead>
                <tr class="bg-[#F4F6FA] text-gray-600 uppercase text-[11px] tracking-wide border-b">
                    <th class="py-2 px-3">Ruangan</th>
                    <th class="py-2 px-3">Kode</th>
                    <th class="py-2 px-3">Nama Aset</th>
                    <th class="py-2 px-3">Qty</th>
                    <th class="py-2 px-3">Tahun</th>
                    <th class="py-2 px-3">Kondisi</th>
                </tr>
            </thead>

            <tbody>

                @php
                    // SAFE CASE-INSENSITIVE COLORS
                    $colors = [
                        'baik'   => 'bg-green-100 text-green-700',
                        'rusak'  => 'bg-yellow-100 text-yellow-700',
                        'hilang' => 'bg-red-100 text-red-700',
                    ];
                @endphp

                @forelse ($assets as $a)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="py-2 px-3">{{ $a->room->name ?? '-' }}</td>
                    <td class="py-2 px-3">{{ $a->code }}</td>
                    <td class="py-2 px-3 font-medium">{{ $a->name }}</td>
                    <td class="py-2 px-3">{{ $a->quantity }} {{ $a->unit_name }}</td>
                    <td class="py-2 px-3">{{ $a->acquired_year }}</td>

                    {{-- KONDISI --}}
                    <td class="py-2 px-3">
                        @php
                            $c = strtolower($a->condition);
                        @endphp

                        <span class="px-2 py-1 rounded-lg text-[11px] font-semibold {{ $colors[$c] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ strtoupper($a->condition) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">Tidak ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $assets->links() }}
        </div>
    </div>

</div>

</x-layouts.main>
