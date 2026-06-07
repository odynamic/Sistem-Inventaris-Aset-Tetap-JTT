<x-layouts.main title="Jadwal Survey">

<div class="space-y-4">

    {{-- ========================= --}}
    {{-- HEADER --}}
    {{-- ========================= --}}
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-9">
            <h1 class="text-xl font-semibold text-gray-800">Jadwal Survey</h1>
        </div>

        <a href="{{ route('user.surveys.history') }}"
           class="px-4 py-2 rounded-lg bg-gray-200 text-sm hover:bg-gray-300 shadow">
            Riwayat Survey
        </a>
    </div>

    {{-- ========================= --}}
    {{-- ALERT --}}
    {{-- ========================= --}}
    @if(session('success'))
        <div class="p-3 bg-green-50 text-green-800 border border-green-200 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

<div class="bg-white p-4 rounded-xl border shadow-sm mb-4">
    <form method="GET" class="flex flex-wrap items-end gap-3">
        {{-- RUANGAN --}}
        <div class="flex-1 min-w-[120px]">
            <label class="text-xs text-gray-600">Ruangan</label>
            <select name="room_id" class="w-full mt-1 px-2 py-1 border rounded-lg text-sm">
                <option value="">Semua Ruangan</option>
                @foreach($rooms as $r)
                    <option value="{{ $r->id }}" {{ request('room_id')==$r->id?'selected':'' }}>
                        {{ $r->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- METODE --}}
        <div class="flex-1 min-w-[100px]">
            <label class="text-xs text-gray-600">Metode</label>
            <select name="survey_method" class="w-full mt-1 px-2 py-1 border rounded-lg text-sm">
                <option value="">Semua</option>
                <option value="user" {{ request('survey_method')=='user'?'selected':'' }}>User</option>
                <option value="admin" {{ request('survey_method')=='admin'?'selected':'' }}>Admin</option>
            </select>
        </div>

        {{-- DARI --}}
        <div class="min-w-[100px]">
            <label class="text-xs text-gray-600">Dari</label>
            <input type="date" name="date_start" value="{{ request('date_start') }}" 
                   class="w-full mt-1 px-2 py-1 border rounded-lg text-sm">
        </div>

        {{-- SAMPAI --}}
        <div class="min-w-[100px]">
            <label class="text-xs text-gray-600">Sampai</label>
            <input type="date" name="date_end" value="{{ request('date_end') }}" 
                   class="w-full mt-1 px-2 py-1 border rounded-lg text-sm">
        </div>

        {{-- BUTTON --}}
        <div class="flex gap-2 mt-1">
            <button type="submit" class="px-3 py-1.5 bg-[#0F3B89] text-white rounded-lg shadow hover:bg-[#0d3373] text-sm">
                Filter
            </button>
            <a href="{{ route('user.surveys.index') }}" 
               class="px-3 py-1.5 bg-gray-100 rounded-lg text-gray-700 hover:bg-gray-200 text-sm">
                Reset
            </a>
        </div>
    </form>
</div>


    {{-- ========================= --}}
    {{-- TABLE --}}
    {{-- ========================= --}}
    <div class="bg-white p-4 rounded-xl border shadow-sm overflow-x-auto">

        <table class="w-full text-sm">
            <thead class="bg-[#F4F6FA] text-xs uppercase text-gray-600 text-center">
                <tr>
                    <th class="p-2">#</th>
                    <th class="p-2">Ruangan</th>
                    <th class="p-2">Metode</th>
                    <th class="p-2">Batas</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-center">
            @forelse($surveys as $s)
                <tr class="border-b hover:bg-gray-50 transition">

                    <td class="p-2">{{ $s->id }}</td>
                    <td class="p-2">{{ $s->room->name ?? '-' }}</td>
                    <td class="p-2 capitalize">{{ $s->survey_method }}</td>
                    <td class="p-2">{{ $s->scheduled_date }}</td>

                    @php
                        $statusColors = [
                            'dijadwalkan'       => 'bg-green-100 text-green-700',
                            'menunggu_validasi' => 'bg-yellow-100 text-yellow-700',
                            'selesai'           => 'bg-blue-100 text-blue-700',
                            'ditolak'           => 'bg-red-100 text-red-700',
                            'expired'           => 'bg-gray-300 text-gray-700',
                        ];
                        $colorClass = $statusColors[$s->status] ?? 'bg-gray-100 text-gray-600';
                    @endphp
                    <td class="p-2">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $colorClass }}">
                            {{ strtoupper(str_replace('_',' ', $s->status)) }}
                        </span>
                    </td>

                    {{-- AKSI --}}
                    <td class="p-2">
                        <div class="flex justify-center gap-2">

                            {{-- LIHAT --}}
                            <a href="{{ route('user.surveys.show',$s->id) }}"
                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 hover:bg-gray-100 text-gray-700">
                                <i class="ph ph-eye text-base"></i>
                            </a>

                            {{-- ISI SURVEY --}}
                            @if($s->survey_method=='user' && $s->status=='dijadwalkan')
                                <a href="{{ route('user.surveys.fillForm',$s->id) }}"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-green-50 hover:bg-gray-100 text-green-700">
                                    <i class="ph ph-clipboard-text text-base"></i>
                                </a>
                            @endif

                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-500">
                        Tidak ada survey aktif.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-3">{{ $surveys->links() }}</div>
    </div>

</div>

</x-layouts.main>
