<x-layouts.main title="Tambah Ruangan">

{{-- HEADER --}}
<div class="flex items-center justify-between mb-4">
    <div class="flex items-center gap-3">
        <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-8">
        <h1 class="text-lg font-semibold text-gray-800">Tambah Ruangan</h1>
    </div>

    <a href="{{ route('admin.rooms.index') }}"
        class="px-3 py-1.5 bg-white border border-gray-300 text-gray-700 text-xs rounded-lg">
        <i class="ph ph-arrow-left text-xs"></i> Kembali
    </a>
</div>

<div class="bg-white p-6 rounded-xl shadow-md border max-w-md mx-auto">

    <form method="POST" action="{{ route('admin.rooms.store') }}">
        @csrf

        {{-- UNIT --}}
        <div class="mb-3">
            <label class="text-[12px] text-gray-700 font-medium">Unit Kerja</label>
            <select name="unit_id"
                class="w-full mt-1 px-3 py-2 border rounded-lg text-sm focus:ring-[#0F3B89]">
                @foreach($units as $u)
                    <option value="{{ $u->id }}">{{ $u->full_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- NAMA --}}
        <div>
            <label class="text-[12px] text-gray-700 font-medium">Nama Ruangan</label>
            <input type="text" name="name"
                class="w-full mt-1 px-3 py-2 border rounded-lg text-sm focus:ring-[#0F3B89]" required>
        </div>

        <button class="mt-5 px-4 py-2 bg-[#0F3B89] text-white text-xs rounded-lg shadow">
            Simpan
        </button>

    </form>

</div>

</x-layouts.main>
