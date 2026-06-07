<x-layouts.main title="Edit Aset">

{{-- HEADER --}}
<div class="flex items-center justify-between mb-4">
    <div class="flex items-center gap-3">
        <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-8" alt="">
        <h1 class="text-lg font-semibold text-gray-800 tracking-wide">Edit Aset</h1>
    </div>

    <a href="{{ route('admin.assets.index') }}"
        class="px-3 py-1.5 bg-white border border-gray-300 text-gray-700 text-xs rounded-lg 
        hover:bg-gray-100 transition flex items-center gap-1.5">
        <i class="ph ph-arrow-left text-xs"></i>
        Kembali
    </a>
</div>

{{-- CARD FORM --}}
<div class="bg-white p-5 rounded-xl shadow-md border max-w-3xl mx-auto">
    <form action="{{ route('admin.assets.update', $asset->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">

            {{-- UNIT (LOCKED) --}}
            <div>
                <label class="text-[11px] font-medium text-gray-700">Unit Kerja</label>

                <input type="text"
                    value="{{ $units->firstWhere('id', $asset->unit_id)->name }}"
                    class="w-full mt-1 border rounded-lg px-2.5 py-1.5 text-xs 
                    bg-gray-100 text-gray-600" disabled>

                <input type="hidden" name="unit_id" value="{{ $asset->unit_id }}">
            </div>

            {{-- RUANGAN --}}
            <div>
                <label class="text-[11px] font-medium text-gray-700">Ruangan</label>
                <select name="room_id" id="roomSelect"
                    class="w-full mt-1 border rounded-lg px-2.5 py-1.5 text-xs 
                    focus:ring-[#0F3B89] focus:outline-none">
                    @foreach ($rooms as $r)
                        <option value="{{ $r->id }}" @selected($asset->room_id == $r->id)>
                            {{ $r->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- KODE (LOCKed) + JS PREVIEW --}}
            <div>
                <label class="text-[11px] font-medium text-gray-700">Kode Aset</label>
                <input type="text"
                    id="codePreview"
                    value="{{ $asset->code }}"
                    class="w-full border rounded-lg px-2.5 py-1.5 mt-1 text-xs 
                    bg-gray-100 text-gray-600" disabled>
            </div>

            {{-- NAMA --}}
            <div>
                <label class="text-[11px] font-medium">Nama Aset</label>
                <input type="text" name="name" value="{{ $asset->name }}"
                    class="w-full border rounded-lg px-2.5 py-1.5 mt-1 text-xs  
                    focus:ring-[#0F3B89]">
            </div>

            {{-- QTY --}}
            <div>
                <label class="text-[11px] font-medium">Quantity</label>
                <input type="number" name="quantity" value="{{ $asset->quantity }}"
                    class="w-full border rounded-lg px-2.5 py-1.5 mt-1 text-xs 
                    focus:ring-[#0F3B89]">
            </div>

            {{-- UNIT (satuan barang) --}}
            <div>
                <label class="text-[11px] font-medium">Unit</label>
                <input type="text" name="unit" value="{{ $asset->unit }}"
                    class="w-full border rounded-lg px-2.5 py-1.5 mt-1 text-xs 
                    focus:ring-[#0F3B89]">
            </div>

            {{-- KONDISI --}}
            <div>
                <label class="text-[11px] font-medium">Kondisi</label>
                <select name="condition"
                    class="w-full border rounded-lg px-2.5 py-1.5 mt-1 text-xs 
                    focus:ring-[#0F3B89]">
                    <option value="baik" @selected($asset->condition == 'baik')>Baik</option>
                    <option value="rusak" @selected($asset->condition == 'rusak')>Rusak</option>
                    <option value="hilang" @selected($asset->condition == 'hilang')>Hilang</option>
                </select>
            </div>

            {{-- TAHUN --}}
            <div>
                <label class="text-[11px] font-medium">Tahun Perolehan</label>
                <input type="number" name="acquired_year" value="{{ $asset->acquired_year }}"
                    class="w-full border rounded-lg px-2.5 py-1.5 mt-1 text-xs 
                    focus:ring-[#0F3B89]">
            </div>

        </div>

        <button
            style="background:#0F3B89; color:white;"
            class="mt-5 px-4 py-1.5 text-xs rounded-lg shadow hover:brightness-90 transition 
            flex items-center gap-1.5">
            <i class="ph ph-check text-xs"></i>
            Update Aset
        </button>

    </form>
</div>

{{-- JS — Preview kode barang --}}
<script>
document.addEventListener("DOMContentLoaded", () => {

    const unitName = "{{ $units->firstWhere('id', $asset->unit_id)->name }}";
    const roomSelect = document.getElementById("roomSelect");
    const preview = document.getElementById("codePreview");

    roomSelect.addEventListener("change", () => {
        let room = roomSelect.options[roomSelect.selectedIndex]?.text ?? "";

        if (!room) {
            preview.value = "{{ $asset->code }}";
            return;
        }

        let clean = room.replace(/^Ruang\s+/i, "");
        let short = clean.substring(0, 2).toUpperCase();

        preview.value = `${unitName}-${short}-...`;
    });

});
</script>

</x-layouts.main>
