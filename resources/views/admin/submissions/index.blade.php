@php
use Illuminate\Support\Str;
@endphp

<x-layouts.main title="Validasi Pengajuan Aset">

<div x-data="{ openVerify:false, verifyData:{} }">

    {{-- ========================= --}}
    {{-- HEADER --}}
    {{-- ========================= --}}
    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-8">
            <h1 class="text-lg font-semibold text-gray-800 tracking-wide">Validasi Pengajuan Aset</h1>
        </div>
    </div>

    {{-- ========================= --}}
    {{-- FILTER --}}
    {{-- ========================= --}}
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-5">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-6 gap-4">

            {{-- STATUS --}}
            <div>
                <label class="text-[11px] text-gray-600 font-semibold">Status</label>
                <select name="status" onchange="this.form.submit()"
                        class="w-full mt-1 rounded-lg border-gray-300 text-sm px-3 py-1.5 focus:ring-[#0F3B89] focus:border-[#0F3B89]">
                    <option value="">Semua</option>
                    <option value="pending" @selected(request('status')=='pending')>Pending</option>
                    <option value="approved" @selected(request('status')=='approved')>Approved</option>
                    <option value="rejected" @selected(request('status')=='rejected')>Rejected</option>
                    <option value="dibatalkan" @selected(request('status')=='dibatalkan')>Dibatalkan</option>
                </select>
            </div>

            {{-- TIPE --}}
            <div>
                <label class="text-[11px] text-gray-600 font-semibold">Jenis</label>
                <select name="type" onchange="this.form.submit()"
                        class="w-full mt-1 rounded-lg border-gray-300 text-sm px-3 py-1.5 focus:ring-[#0F3B89] focus:border-[#0F3B89]">
                    <option value="">Semua</option>
                    <option value="penambahan" @selected(request('type')=='penambahan')>Penambahan</option>
                    <option value="perubahan" @selected(request('type')=='perubahan')>Perubahan</option>
                    <option value="penghapusan" @selected(request('type')=='penghapusan')>Penghapusan</option>
                </select>
            </div>

            {{-- UNIT --}}
            <div>
                <label class="text-[11px] text-gray-600 font-semibold">Unit</label>
                <select name="unit_id" onchange="this.form.submit()"
                        class="w-full mt-1 rounded-lg border-gray-300 text-sm px-3 py-1.5 focus:ring-[#0F3B89] focus:border-[#0F3B89]">
                    <option value="">Semua</option>
                    @foreach($units as $u)
                        <option value="{{ $u->id }}" @selected(request('unit_id')==$u->id)>{{ $u->full_name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- RUANGAN --}}
            <div>
                <label class="text-[11px] text-gray-600 font-semibold">Ruangan</label>
                <select name="room_id" onchange="this.form.submit()"
                        class="w-full mt-1 rounded-lg border-gray-300 text-sm px-3 py-1.5 focus:ring-[#0F3B89] focus:border-[#0F3B89]">
                    <option value="">Semua</option>
                    @foreach($rooms as $r)
                        <option value="{{ $r->id }}" @selected(request('room_id')==$r->id)>{{ $r->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- PENCARIAN --}}
            <div class="md:col-span-2">
                <label class="text-[11px] text-gray-600 font-semibold">Pencarian</label>
                <div class="flex gap-2 mt-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari nama aset..."
                           class="w-full px-3 py-1.5 border rounded-lg text-sm focus:ring-[#0F3B89] focus:border-[#0F3B89]">

                    <button type="submit" class="px-4 py-1.5 bg-[#0F3B89] text-white rounded-lg text-sm shadow hover:bg-[#0d3373]">Cari</button>

                    @if(request()->anyFilled(['status','type','unit_id','room_id','search']))
                    <a href="{{ route('admin.submissions.index') }}"
                       class="px-4 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200 shadow">Reset</a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    {{-- ========================= --}}
    {{-- TABEL DATA --}}
    {{-- ========================= --}}
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 overflow-x-auto">
        <table class="w-full text-sm text-center">
            <thead>
            <tr class="bg-[#F4F6FA] text-gray-600 uppercase text-[10px] tracking-wide border-b">
                <th class="py-2 px-3">ID</th>
                <th class="py-2 px-3">Tipe</th>
                <th class="py-2 px-3">Detail</th>
                <th class="py-2 px-3">User</th>
                <th class="py-2 px-3">Status</th>
                <th class="py-2 px-3">Diajukan</th>
                <th class="py-2 px-3 w-[110px]">Aksi</th>
            </tr>
            </thead>

            <tbody>
            @forelse($submissions as $s)
            <tr class="border-b hover:bg-gray-50 transition">
                <td class="py-2 px-3 text-center">{{ $s->id }}</td>
                <td class="py-2 px-3 text-center capitalize">{{ $s->type }}</td>
                <td class="py-2 px-3 text-center font-medium">{{ $s->detail_text ?? $s->add_name ?? 'N/A' }}</td>
                <td class="py-2 px-3 text-center">{{ $s->user?->name ?? '-' }}</td>
                <td class="py-2 px-3 text-center">
                    @php
                        $colors = [
                            'pending'=>'bg-yellow-100 text-yellow-800',
                            'approved'=>'bg-green-100 text-green-800',
                            'rejected'=>'bg-red-100 text-red-800',
                            'dibatalkan'=>'bg-gray-100 text-gray-700'
                        ];
                    @endphp
                    <span class="px-2 py-0.5 rounded text-[11px] font-bold uppercase {{ $colors[$s->status] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ $s->status }}
                    </span>
                </td>
                <td class="py-2 px-3 text-center">{{ $s->created_at->format('d/m/Y') }}</td>
                <td class="py-2 px-3 text-center">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('admin.submissions.show', $s->id) }}"
                           class="p-1.5 rounded-md bg-blue-50 text-blue-700 hover:bg-blue-100 transition">
                            <i class="ph ph-eye text-base"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="py-3 text-gray-500">Tidak ada data pengajuan.</td>
            </tr>
            @endforelse
            </tbody>
        </table>

        {{-- PAGINATION --}}
        <div class="mt-3">{{ $submissions->appends(request()->query())->links() }}</div>
    </div>

</div>

</x-layouts.main>
