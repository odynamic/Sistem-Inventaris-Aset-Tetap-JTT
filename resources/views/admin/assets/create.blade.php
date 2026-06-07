<x-layouts.main title="Tambah Aset">

{{-- HEADER --}}
<div class="flex items-center justify-between mb-4">
    <div class="flex items-center gap-3">
        <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-8" alt="">
        <h1 class="text-lg font-semibold text-gray-800 tracking-wide">Tambah Aset Baru</h1>
    </div>

    <a href="{{ route('admin.assets.index') }}"
        class="px-3 py-1.5 bg-white border border-gray-300 text-gray-700 text-xs rounded-lg 
        hover:bg-gray-100 transition flex items-center gap-1.5">
        <i class="ph ph-arrow-left text-xs"></i>
        Kembali
    </a>
</div>


<div class="bg-white p-5 rounded-xl shadow-md border max-w-3xl">
    <form action="{{ route('admin.assets.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">

            {{-- UNIT --}}
            <div>
                <label class="text-[11px] font-medium text-gray-700">Unit Kerja</label>
                <select name="unit_id" id="unitSelect"
                    class="w-full mt-1 border rounded-lg px-2.5 py-1.5 text-xs focus:ring-[#0F3B89]">
                    @foreach ($units as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- RUANGAN --}}
            <div>
                <label class="text-[11px] font-medium text-gray-700">Ruangan</label>
                <select name="room_id" id="roomSelect"
                    class="w-full mt-1 border rounded-lg px-2.5 py-1.5 text-xs focus:ring-[#0F3B89]">
                    
                    @foreach ($rooms as $r)
                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                    @endforeach

                </select>
            </div>

            {{-- KODE (AUTO PREVIEW) --}}
            <div>
                <label class="text-[11px] font-medium text-gray-700">Kode Aset</label>
                <input type="text" id="previewCode"
                    class="w-full border rounded-lg px-2.5 py-1.5 mt-1 bg-gray-100 text-gray-600 text-xs"
                    placeholder="- otomatis -"
                    disabled>
            </div>

            {{-- NAME --}}
            <div>
                <label class="text-[11px] font-medium">Nama Aset</label>
                <input type="text" name="name"
                    class="w-full border rounded-lg px-2.5 py-1.5 mt-1 text-xs focus:ring-[#0F3B89]" required>
            </div>

            {{-- QTY --}}
            <div>
                <label class="text-[11px] font-medium">Quantity</label>
                <input type="number" name="quantity"
                    class="w-full border rounded-lg px-2.5 py-1.5 mt-1 text-xs focus:ring-[#0F3B89]" required>
            </div>

            {{-- UNIT --}}
            <div>
                <label class="text-[11px] font-medium">Unit</label>
                <input type="text" name="unit"
                    class="w-full border rounded-lg px-2.5 py-1.5 mt-1 text-xs focus:ring-[#0F3B89]" required>
            </div>

            {{-- CONDITION --}}
            <div>
                <label class="text-[11px] font-medium">Kondisi</label>
                <select name="condition"
                    class="w-full border rounded-lg px-2.5 py-1.5 mt-1 text-xs focus:ring-[#0F3B89]">
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                    <option value="hilang">Hilang</option>
                </select>
            </div>

            {{-- YEAR --}}
            <div>
                <label class="text-[11px] font-medium">Tahun Perolehan</label>
                <input type="number" name="acquired_year"
                    class="w-full border rounded-lg px-2.5 py-1.5 mt-1 text-xs focus:ring-[#0F3B89]" required>
            </div>

        </div>

        <button
            class="mt-5 px-4 py-1.5 text-xs rounded-lg shadow flex items-center gap-1.5 transition"
            style="background:#0F3B89; color:white;">
            <i class="ph ph-check text-xs"></i>
            Simpan
        </button>

    </form>
</div>



{{-- AJAX ROOM + AUTO CODE --}}
<script>
document.addEventListener("DOMContentLoaded", () => {

    const unitSelect = document.getElementById("unitSelect");
    const roomSelect = document.getElementById("roomSelect");
    const previewCode = document.getElementById("previewCode");

    function refreshPreview() {
        let unit = unitSelect.options[unitSelect.selectedIndex]?.text || "";
        let room = roomSelect.options[roomSelect.selectedIndex]?.text || "";

        if (!unit || !room) {
            previewCode.value = "";
            return;
        }

        const cleanRoom = room.replace(/^Ruang\s+/i, '');
        const short = cleanRoom.substring(0, 2).toUpperCase();

        previewCode.value = `${unit}-${short}-...`;
    }

    unitSelect.addEventListener("change", () => {
        let id = unitSelect.value;

        roomSelect.innerHTML = `<option value="">Loading...</option>`;
        previewCode.value = "";

        fetch(`/admin/ajax/rooms/${id}`)
    .then(res => res.json())
    .then(data => {
        roomSelect.innerHTML = "";
        data.forEach(r => {
            roomSelect.innerHTML += `<option value="${r.id}">${r.name}</option>`;
        });

        // AUTO SELECT ruangan pertama
        if (data.length > 0) {
            roomSelect.value = data[0].id;
        }

        refreshPreview();
    });

    });

    roomSelect.addEventListener("change", refreshPreview);

});
</script>

</x-layouts.main>
