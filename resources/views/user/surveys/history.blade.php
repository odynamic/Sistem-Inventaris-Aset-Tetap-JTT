<x-layouts.main title="Riwayat Survey">

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-9">
            <h1 class="text-xl font-semibold text-gray-800">Riwayat Survey</h1>
        </div>

        <a href="{{ route('user.surveys.index') }}"
           class="px-4 py-2 bg-gray-200 rounded-lg text-sm hover:bg-gray-300">
            Jadwal Survey
        </a>
    </div>

<div class="bg-white p-4 rounded-xl border shadow-sm mb-4">
    <form method="GET" class="flex flex-wrap gap-3 items-end">
        {{-- Ruangan --}}
        <div class="flex-1 min-w-[150px]">
            <label class="text-xs text-gray-600">Ruangan</label>
            <select name="room_id" class="w-full mt-1 px-3 py-2 border rounded-lg text-sm">
                <option value="">Semua</option>
                @foreach($rooms as $r)
                    <option value="{{ $r->id }}" {{ request('room_id')==$r->id?'selected':'' }}>
                        {{ $r->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Status --}}
        <div class="flex-1 min-w-[120px]">
            <label class="text-xs text-gray-600">Status</label>
            <select name="status" class="w-full mt-1 px-3 py-2 border rounded-lg text-sm">
                <option value="">Semua</option>
                <option value="selesai" {{ request('status')=='selesai'?'selected':'' }}>Selesai</option>
                <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
                <option value="expired" {{ request('status')=='expired'?'selected':'' }}>Expired</option>
            </select>
        </div>

        {{-- Buttons --}}
        <div class="flex gap-2">
            <button type="submit"
                    class="px-4 py-2 bg-[#0F3B89] text-white rounded-lg shadow hover:bg-[#0d3373] text-sm">
                Filter
            </button>
            <a href="{{ route('user.surveys.history') }}"
               class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg shadow hover:bg-gray-300 text-sm text-center">
                Reset
            </a>
        </div>
    </form>
</div>

    {{-- TABLE --}}
    <div class="bg-white p-5 rounded-xl border shadow-sm overflow-x-auto">

        <table class="w-full text-sm table-auto text-center">
            <thead>
                <tr class="bg-[#F4F6FA] text-xs uppercase text-gray-600">
                    <th class="p-2">#</th>
                    <th class="p-2">Ruangan</th>
                    <th class="p-2">Metode</th>
                    <th class="p-2">Batas Survey</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($surveys as $s)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">{{ $s->id }}</td>
                    <td class="p-2">{{ $s->room->name }}</td>
                    <td class="p-2 capitalize">{{ $s->survey_method }}</td>
                    <td class="p-2">{{ $s->scheduled_date }}</td>

                    {{-- STATUS --}}
                    @php
                        $statusColors = [
                            'selesai'    => 'bg-blue-100 text-blue-800',
                            'ditolak'    => 'bg-red-100 text-red-800',
                            'expired'    => 'bg-gray-200 text-gray-700',
                        ];
                        $colorClass = $statusColors[$s->status] ?? 'bg-gray-100 text-gray-700';
                    @endphp
                    <td class="p-2">
                        <span class="px-2 py-1 rounded-full text-sm font-semibold {{ $colorClass }}">
                            {{ strtoupper(str_replace('_',' ',$s->status)) }}
                        </span>
                    </td>

                    {{-- ACTION --}}
                    <td class="p-2">
                        <a href="{{ route('user.surveys.show',$s->id) }}"
                           class="text-blue-700 hover:text-blue-900">
                            <i class="ph ph-eye text-lg"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">
                        Tidak ada riwayat survey.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">{{ $surveys->links() }}</div>
    </div>

</div>

</x-layouts.main>
