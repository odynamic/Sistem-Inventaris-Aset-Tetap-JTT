<x-layouts.main title="Edit Ruangan">

{{-- HEADER --}}
<div class="flex items-center justify-between mb-4">
    <div class="flex items-center gap-3">
        <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-8">
        <h1 class="text-lg font-semibold text-gray-800">Edit Ruangan</h1>
    </div>

    <a href="{{ route('admin.rooms.index') }}"
        class="px-3 py-1.5 bg-white border border-gray-300 text-gray-700 text-xs rounded-lg">
        <i class="ph ph-arrow-left text-xs"></i> Kembali
    </a>
</div>

<div class="bg-white p-6 rounded-xl shadow-md border max-w-md mx-auto">

    <form method="POST" action="{{ route('admin.rooms.update', $room->id) }}">
        @csrf
        @method('PUT')

        {{-- UNIT (LOCKED) --}}
        <div class="mb-3">
            <label class="text-[12px] text-gray-700 font-medium">Unit Kerja</label>
            <input type="text" class="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-100 text-gray-600"
                   value="{{ $room->unit->full_name }}" disabled>
            <input type="hidden" name="unit_id" value="{{ $room->unit_id }}">
        </div>

        {{-- NAMA --}}
        <div>
            <label class="text-[12px] font-medium text-gray-700">Nama Ruangan</label>
            <input type="text" name="name" value="{{ $room->name }}"
                class="w-full mt-1 px-3 py-2 border rounded-lg text-sm focus:ring-[#0F3B89]">
        </div>

        <button class="mt-5 px-4 py-2 bg-[#0F3B89] text-white text-xs rounded-lg shadow">
            Update Ruangan
        </button>

    </form>

</div>

</x-layouts.main>
