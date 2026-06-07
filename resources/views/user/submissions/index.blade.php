
@php
    use Illuminate\Support\Str;
@endphp

<x-layouts.main title="Pengajuan Aset">

<div class="space-y-6">

    {{-- ========================= --}}
    {{-- HEADER --}}
    {{-- ========================= --}}
    <div class="flex items-center justify-between mb-2">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-8">
            <h1 class="text-lg font-semibold text-gray-800 tracking-wide">Pengajuan Aset</h1>
        </div>

        <a href="{{ route('user.submissions.create') }}"
           class="px-4 py-2 rounded-lg flex items-center gap-2 text-sm shadow bg-[#0F3B89] text-white hover:bg-[#0d3373] transition">
            <i class="ph ph-plus text-lg"></i> Ajukan
        </a>
    </div>


    {{-- ========================= --}}
    {{-- ALERT --}}
    {{-- ========================= --}}
    @if(session('success'))
        <div class="p-3 rounded-lg bg-green-50 text-green-800 border border-green-200 shadow-sm">
            {{ session('success') }}
        </div>
    @endif


<div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
<form method="GET" class="grid grid-cols-1 md:grid-cols-6 gap-4">

    {{-- SEARCH --}}
    <div class="md:col-span-2">
        <label class="text-[11px] text-gray-600 font-semibold">Cari</label>
        <input type="text" name="q"
               value="{{ request('q') }}"
               placeholder="Cari detail..."
               class="w-full mt-1 rounded-lg border-gray-300 text-sm px-3 py-1.5 focus:ring-[#0F3B89] focus:border-[#0F3B89]">
    </div>

    {{-- STATUS --}}
    <div class="md:col-span-1">
        <label class="text-[11px] text-gray-600 font-semibold">Status</label>
        <select name="status" class="w-full mt-1 rounded-lg border-gray-300 text-sm px-3 py-1.5">
            <option value="">Semua</option>
            <option value="pending" @selected(request('status')=='pending')>Pending</option>
            <option value="approved" @selected(request('status')=='approved')>Approved</option>
            <option value="rejected" @selected(request('status')=='rejected')>Rejected</option>
            <option value="dibatalkan" @selected(request('status')=='dibatalkan')>Dibatalkan</option>
        </select>
    </div>

    {{-- TYPE --}}
    <div class="md:col-span-1">
        <label class="text-[11px] text-gray-600 font-semibold">Jenis</label>
        <select name="type" class="w-full mt-1 rounded-lg border-gray-300 text-sm px-3 py-1.5">
            <option value="">Semua</option>
            <option value="penambahan" @selected(request('type')=='penambahan')>Penambahan</option>
            <option value="perubahan" @selected(request('type')=='perubahan')>Perubahan</option>
            <option value="penghapusan" @selected(request('type')=='penghapusan')">Penghapusan</option>
        </select>
    </div>

    {{-- ROOM --}}
    <div class="md:col-span-1">
        <label class="text-[11px] text-gray-600 font-semibold">Ruangan</label>
        <select name="room_id" class="w-full mt-1 rounded-lg border-gray-300 text-sm px-3 py-1.5">
            <option value="">Semua</option>
            @foreach($rooms as $r)
                <option value="{{ $r->id }}" @selected(request('room_id')==$r->id)>{{ $r->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- FILTER BUTTON --}}
    <div class="flex items-end md:col-span-1">
        <button type="submit"
                class="px-4 py-1.5 bg-[#0F3B89] text-white rounded-lg text-sm shadow hover:bg-[#0c316f] w-full">
            Filter
        </button>
    </div>

    {{-- RESET --}}
    <div class="flex items-end md:col-span-1">
        @if(request()->anyFilled(['q','status','type','room_id']))
            <a href="{{ route('user.submissions.index') }}"
               class="px-4 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200 shadow w-full text-center">
                Reset
            </a>
        @endif
    </div>

</form>
</div>

<div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 overflow-x-auto">

    <table class="w-full text-sm text-center">
        <thead>
        <tr class="bg-[#F4F6FA] text-gray-600 uppercase text-[10px] tracking-wide border-b">
            <th class="py-2 px-3">No</th>
            <th class="py-2 px-3">Tipe</th>
            <th class="py-2 px-3">Ruangan</th>
            <th class="py-2 px-3">Detail</th>
            <th class="py-2 px-3">Status</th>
            <th class="py-2 px-3">Diajukan</th>
            <th class="py-2 px-3 w-[110px]">Aksi</th>
        </tr>
        </thead>

        <tbody>

        @forelse($submissions as $s)
        <tr class="border-b hover:bg-gray-50 transition">

            {{-- NO --}}
            <td class="py-2 px-3">
                {{ $loop->iteration + ($submissions->currentPage()-1)*$submissions->perPage() }}
            </td>

            {{-- TIPE --}}
            <td class="py-2 px-3 capitalize font-medium">{{ $s->type }}</td>

            {{-- RUANG --}}
            <td class="py-2 px-3">
                @if($s->type === 'penambahan')
                    {{ $s->addRoom?->name ?? '-' }}
                @else
                    {{ $s->asset?->room?->name ?? '-' }}
                @endif
            </td>

            {{-- DETAIL (SIMPLE, HANYA NAMA ASET / FORM INPUT) --}}
            <td class="py-2 px-3 font-semibold text-center">
                @if($s->type === 'penambahan')
                    {{ $s->add_name }}
                @elseif($s->type === 'perubahan' || $s->type === 'penghapusan')
                    {{ $s->asset?->name ?? '-' }}
                @else
                    -
                @endif
            </td>

            {{-- STATUS --}}
            <td class="py-2 px-3">
                @php
                    $colors = [
                        'pending'=>'bg-yellow-100 text-yellow-800',
                        'approved'=>'bg-green-100 text-green-800',
                        'rejected'=>'bg-red-100 text-red-800',
                        'dibatalkan'=>'bg-gray-100 text-gray-700'
                    ];
                @endphp

                <span class="px-2 py-0.5 rounded text-[11px] font-bold uppercase {{ $colors[$s->status] ?? '' }}">
                    {{ $s->status }}
                </span>
            </td>

            {{-- DATE --}}
            <td class="py-2 px-3 text-[12px]">
                {{ $s->created_at->format('d/m/Y H:i') }}
            </td>

            {{-- AKSI --}}
            <td class="py-2 px-3">
                <div class="flex justify-center gap-3">

                    {{-- LIHAT --}}
                    <a href="{{ route('user.submissions.show', $s->id) }}"
                       class="p-1.5 rounded-md bg-blue-50 text-blue-700 hover:bg-blue-100 transition">
                        <i class="ph ph-eye text-base"></i>
                    </a>

                    {{-- CANCEL --}}
                    @if($s->status === 'pending')
                        <form action="{{ route('user.submissions.cancel', $s->id) }}"
                              method="POST"
                              onsubmit="return confirm('Batalkan pengajuan ini?')">
                            @csrf
                            <button class="p-1.5 rounded-md bg-red-50 text-red-700 hover:bg-red-100 transition">
                                <i class="ph ph-x-circle text-base"></i>
                            </button>
                        </form>
                    @endif

                </div>
            </td>

        </tr>
        @empty

        <tr>
            <td colspan="7" class="py-4 text-gray-500">Belum ada pengajuan.</td>
        </tr>

        @endforelse

        </tbody>
    </table>

    {{-- PAGINATION --}}
    <div class="mt-3 flex justify-center">
        {{ $submissions->appends(request()->query())->links() }}
    </div>

</div>


</x-layouts.main>
