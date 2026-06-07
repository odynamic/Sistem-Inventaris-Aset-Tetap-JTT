<x-layouts.main title="Manajemen Aset">

<div class="">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-9" alt="">
            <h1 class="text-xl font-semibold text-gray-800 tracking-wide">Data Aset</h1>
        </div>

        <div class="flex items-center gap-3">
            <button type="button" onclick="openCreateModal()"
                class="px-4 py-2 rounded-lg bg-[#0F3B89] text-white hover:bg-[#0d3373] flex items-center gap-1 font-semibold">
                <i class="ph ph-plus text-lg"></i> Tambah Aset
            </button>
        </div>
    </div>

    {{-- FILTER --}}
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="text-[11px] text-gray-600 font-semibold">Unit Kerja</label>
                <select name="unit_id" class="w-full mt-1 px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]">
                    <option value="">Semua</option>
                    @foreach ($units as $u)
                        <option value="{{ $u->id }}" {{ request('unit_id') == $u->id ? 'selected' : '' }}>
                            {{ $u->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-[11px] text-gray-600 font-semibold">Ruangan</label>
                <select name="room_id" class="w-full mt-1 px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]">
                    <option value="">Semua</option>
                    @foreach ($rooms as $r)
                        <option value="{{ $r->id }}" {{ request('room_id') == $r->id ? 'selected' : '' }}>
                            {{ $r->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="text-[11px] text-gray-600 font-semibold">Pencarian</label>
                <div class="flex gap-2 mt-1">
                    <input type="text" name="search"
                            class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]"
                            placeholder="Cari kode atau nama aset..." value="{{ request('search') }}">
                    <button class="px-5 py-2 bg-[#0F3B89] text-white rounded-lg text-sm flex items-center gap-1 hover:bg-[#0d3373] font-semibold">
                        <i class="ph ph-magnifying-glass text-lg"></i> Cari
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- TABLE --}}
<div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-[#F4F6FA] text-gray-600 uppercase text-[11px] tracking-wide text-center border-b font-bold">
                {{-- Padding header tetap py-2 --}}
                <th class="py-2 px-3">Kode</th>
                <th class="py-2 px-3">Nama</th>
                <th class="py-2 px-3">Unit Kerja</th>
                <th class="py-2 px-3">Ruangan</th>
                <th class="py-2 px-3">Qty</th>
                <th class="py-2 px-3">Kondisi</th>
                <th class="py-2 px-3 w-[120px]">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($assets as $a)
            <tr class="border-b hover:bg-gray-50 transition">
                {{-- STANDARISASI: Semua TD menggunakan py-1 --}}
                <td class="py-1 px-3 text-center">{{ $a->code }}</td>
                <td class="py-1 px-3 text-center font-medium">{{ $a->name }}</td>

                <td class="py-1 px-3 text-center">
                    {{ optional($a->room->unit)->name ?? '-' }}
                </td>

                <td class="py-1 px-3 text-center">
                    {{ optional($a->room)->name ?? '-' }}
                </td>

                {{-- PERBAIKAN: Mengganti py-1.5 menjadi py-1 --}}
                <td class="py-1 px-3 text-center">{{ $a->quantity }} {{ $a->unit }}</td>

                @php
                    $colors = [
                        'baik'  => 'bg-green-100 text-green-700',
                        'rusak' => 'bg-yellow-100 text-yellow-700',
                        'hilang' => 'bg-red-100 text-red-700',
                    ];
                @endphp
                {{-- PERBAIKAN: Mengganti py-1.5 menjadi py-1 pada TD utama --}}
                <td class="py-1 px-3 text-center">
                    {{-- PERBAIKAN: Mengganti py-1 pada SPAN menjadi py-0.5 untuk badge yang lebih kecil --}}
                    <span class="px-2 py-0.5 rounded-lg text-[11px] font-semibold 
                        {{ $colors[strtolower($a->condition)] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ strtoupper($a->condition) }}
                    </span>
                </td>

                {{-- PERBAIKAN: Mengganti py-1.5 menjadi py-1 --}}
                <td class="py-1 px-3">
                    <div class="flex items-center justify-center gap-2">
                        <button
                            onclick='openEditModal(@json($a->load("room.unit")))' 
                            class="p-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 text-[#0F3B89]"
                            title="Edit">
                            <i class="ph ph-pencil-simple text-lg"></i>
                        </button>

                        <button type="button" onclick="openDeleteModal('{{ $a->id }}')" 
                            class="p-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600" title="Hapus">
                            <i class="ph ph-trash text-lg"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                {{-- PERBAIKAN: Mengganti py-1 pada baris kosong menjadi py-2 agar tidak terlalu kecil --}}
                <td colspan="7" class="text-center py-2 text-gray-500">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $assets->links() }}
    </div>
</div>
    {{-- CREATE MODAL --}}
    <div id="createModal" class="fixed inset-0 z-[999] hidden flex items-center justify-center overflow-y-auto p-4">
        {{-- OVERLAY DENGAN BLUR --}}
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
        
        <div class="relative bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md mx-auto my-auto text-center transform transition-all duration-300">
            
            <div class="mb-4">
                                <i class="ph ph-package text-5xl text-[#0F3B89] block mx-auto mb-2"></i>
                <h2 class="text-xl font-semibold text-gray-800">Tambah Aset</h2>
                <p class="text-xs text-gray-500 mt-1">Masukkan data aset sesuai kebutuhan.</p>
            </div>

            <form method="POST" action="{{ route('admin.assets.store') }}" id="formCreate">
                @csrf

                <div class="mb-3 text-left">
                    <label class="block text-sm font-medium text-gray-700">Unit Kerja</label>
                    <select id="create_unit" name="unit_id" class="w-full mt-1 px-3 py-2 border rounded-lg focus:border-[#0F3B89] focus:ring-[#0F3B89] text-sm" required>
                        <option value="">Pilih Unit</option>
                        @foreach ($units as $u)
                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 text-left">
                    <label class="block text-sm font-medium text-gray-700">Ruangan</label>
                    <select id="create_room" name="room_id" class="w-full mt-1 px-3 py-2 border rounded-lg focus:border-[#0F3B89] focus:ring-[#0F3B89] text-sm" required>
                        <option value="">Pilih Ruangan</option>
                    </select>
                </div>

                <div class="mb-3 text-left">
                    <label class="block text-sm font-medium text-gray-700">Kode</label>
                    <input id="create_code" type="text" class="w-full px-3 py-2 border rounded-lg bg-gray-100 text-sm" readonly>
                </div>

                <div class="mb-3 text-left">
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input name="name" type="text" class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]" required>
                </div>

                <div class="mb-3 grid grid-cols-2 gap-3 text-left">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input name="quantity" type="number" class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Satuan</label>
                        <input name="unit" type="text" class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]" placeholder="Unit" required>
                    </div>
                </div>

                <div class="mb-4 grid grid-cols-2 gap-3 text-left">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kondisi</label>
                        <select name="condition" class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]">
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                            <option value="hilang">Hilang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tahun Perolehan</label>
                        <input name="acquired_year" type="number" class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]" required>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeCreateModal()" class="px-5 py-2 rounded-lg bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-lg bg-[#0F3B89] text-white font-semibold hover:bg-[#0d3373]">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- EDIT MODAL --}}
    <div id="editModal" class="fixed inset-0 z-[999] hidden flex items-center justify-center overflow-y-auto p-4">
        {{-- OVERLAY DENGAN BLUR --}}
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
        
        <div class="relative bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md mx-auto my-auto text-center transform transition-all duration-300">

            <div class="mb-4">
                <i class="ph ph-pencil-line text-5xl text-[#0F3B89] block mx-auto mb-2"></i>
                <h2 class="text-xl font-semibold text-gray-800">Edit Aset</h2>
                <p class="text-xs text-gray-500 mt-1">Perbarui data aset sesuai kebutuhan.</p>
            </div>

            <form method="POST" id="formEdit">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" id="edit_id">

                <div class="mb-3 text-left">
                    <label class="block text-sm font-medium text-gray-700">Unit Kerja</label>
                    <input id="edit_unit_text" type="text" class="w-full px-3 py-2 border rounded-lg bg-gray-100 text-sm" readonly>
                    <input type="hidden" name="unit_id" id="edit_unit_id">
                </div>

                <div class="mb-3 text-left">
                    <label class="block text-sm font-medium text-gray-700">Ruangan</label>
                    <select id="edit_room" name="room_id" class="w-full mt-1 px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]" required>
                        <option value="">Pilih Ruangan</option>
                    </select>
                </div>

                <div class="mb-3 text-left">
                    <label class="block text-sm font-medium text-gray-700">Kode</label>
                    <input id="edit_code" type="text" class="w-full px-3 py-2 border rounded-lg bg-gray-100 text-sm" readonly>
                </div>

                <div class="mb-3 text-left">
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input id="edit_name" name="name" type="text" class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]" required>
                </div>

                <div class="mb-3 grid grid-cols-2 gap-3 text-left">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input id="edit_quantity" name="quantity" type="number" class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Satuan</label>
                        <input id="edit_unitname" name="unit" type="text" class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]" required>
                    </div>
                </div>

                <div class="mb-4 grid grid-cols-2 gap-3 text-left">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kondisi</label>
                        <select id="edit_condition" name="condition" class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]">
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                            <option value="hilang">Hilang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tahun Perolehan</label>
                        <input id="edit_year" name="acquired_year" type="number" class="w-full px-3 py-2 border rounded-lg text-sm focus:border-[#0F3B89] focus:ring-[#0F3B89]" required>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeEditModal()" class="px-5 py-2 rounded-lg bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-lg bg-[#0F3B89] text-white font-semibold hover:bg-[#0d3373]">Update</button>
                </div>
            </form>
        </div>
    </div>
    
    {{-- DELETE MODAL --}}
    <div id="deleteModal" class="fixed inset-0 z-[999] hidden flex items-center justify-center overflow-y-auto p-4">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
        
        <div class="relative bg-white shadow-2xl rounded-2xl p-8 w-full max-w-sm mx-auto my-auto text-center transform transition-all duration-300">

            <i class="ph ph-warning-circle text-5xl text-red-500 block mx-auto mb-4"></i>
            <h2 class="text-xl font-semibold text-gray-800">Hapus Aset?</h2>
            <p class="text-sm text-gray-500 mt-2 mb-6">
                Aset akan dihapus permanen dan tindakan ini tidak dapat dibatalkan.
            </p>

            <form method="POST" id="formDelete">
                @csrf
                @method('DELETE')
                
                <div class="flex justify-center gap-3">
                    <button type="button" onclick="closeDeleteModal()" class="px-5 py-2 rounded-lg bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700">Hapus</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
async function fetchJson(url) {
    const res = await fetch(url, { credentials: 'same-origin' });
    if (!res.ok) throw new Error('Network response was not ok: ' + res.status);
    return await res.json();
}

function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden'); 
    
    const cu = document.getElementById('create_unit');
    const cr = document.getElementById('create_room');
    if (cu) cu.value = '';
    if (cr) cr.innerHTML = `<option value="">Pilih Ruangan</option>`;
    const cc = document.getElementById('create_code');
    if (cc) cc.value = '';
}
function closeCreateModal() {
    document.getElementById('createModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

const createUnitEl = document.getElementById('create_unit');
if (createUnitEl) {
    createUnitEl.addEventListener('change', async function() {
        const unitId = this.value;
        const roomSelect = document.getElementById('create_room');
        const codeInput = document.getElementById('create_code');

        if (!unitId) {
            roomSelect.innerHTML = `<option value="">-- Pilih Unit Dulu --</option>`;
            if (codeInput) codeInput.value = '';
            return;
        }

        roomSelect.innerHTML = `<option value="">Memuat ruangan...</option>`;
        try {
            const rooms = await fetchJson(`/admin/ajax/assets/rooms/${unitId}`);

            if (!Array.isArray(rooms) || rooms.length === 0) {
                roomSelect.innerHTML = `<option value="">-- Tidak ada ruangan --</option>`;
                if (codeInput) codeInput.value = '';
                return;
            }
            roomSelect.innerHTML = `<option value="">Pilih Ruangan</option>`;
            rooms.forEach(r => {
                roomSelect.innerHTML += `<option value="${r.id}">${r.name}</option>`;
            });

            try {
                const next = await fetchJson(`/admin/assets/get-next-code/${encodeURIComponent(unitId)}/${encodeURIComponent(rooms[0].id)}`);
                if (codeInput) codeInput.value = next.next_code ?? '';
            } catch (_) {
                if (codeInput) codeInput.value = '';
            }
        } catch (err) {
            roomSelect.innerHTML = `<option value="">-- Gagal memuat ruangan --</option>`;
            if (codeInput) codeInput.value = '';
            console.error(err);
        }
    });
}

function openEditModal(asset) {
    document.getElementById('editModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');

    const form = document.getElementById('formEdit');
    form.action = `/admin/assets/${asset.id}`;

    document.getElementById('edit_id').value = asset.id ?? '';
    const unitName = (asset.room && asset.room.unit && asset.room.unit.name) ? asset.room.unit.name : (asset.unit_name ?? '');
    document.getElementById('edit_unit_text').value = unitName;
    document.getElementById('edit_unit_id').value = asset.unit_id ?? '';

    document.getElementById('edit_code').value = asset.code ?? '';
    document.getElementById('edit_name').value = asset.name ?? '';
    document.getElementById('edit_quantity').value = asset.quantity ?? '';
    document.getElementById('edit_unitname').value = asset.unit ?? '';
    document.getElementById('edit_condition').value = asset.condition ?? 'baik';
    document.getElementById('edit_year').value = asset.acquired_year ?? '';

    const unitIdForRooms = asset.unit_id ?? (asset.room && asset.room.unit_id) ?? (asset.room && asset.room.unit && asset.room.unit.id) ?? '';
    const selectedRoomId = asset.room_id ?? (asset.room && asset.room.id) ?? '';
    loadRoomsForEdit(unitIdForRooms, selectedRoomId);
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

async function loadRoomsForEdit(unitId, selectedRoomId) {
    const roomSelect = document.getElementById('edit_room');
    if (!unitId) {
        roomSelect.innerHTML = `<option value="">Pilih Ruangan</option>`;
        return;
    }
    roomSelect.innerHTML = `<option value="">Memuat ruangan...</option>`;
    try {
        const rooms = await fetchJson(`/admin/ajax/assets/rooms/${unitId}`);

        if (!Array.isArray(rooms) || rooms.length === 0) {
            roomSelect.innerHTML = `<option value="">Tidak ada ruangan</option>`;
            return;
        }
        roomSelect.innerHTML = `<option value="">Pilih Ruangan</option>`;
        rooms.forEach(r => {
            const sel = String(r.id) === String(selectedRoomId) ? 'selected' : '';
            roomSelect.innerHTML += `<option value="${r.id}" ${sel}>${r.name}</option>`;
        });
    } catch (err) {
        roomSelect.innerHTML = `<option value="">Gagal memuat ruangan</option>`;
        console.error(err);
    }
}

function openDeleteModal(assetId) {
    const form = document.getElementById('formDelete');
    // Atur action form DELETE sesuai ID aset yang dipilih
    form.action = `/admin/assets/${assetId}`; 
    
    document.getElementById('deleteModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}
</script>

</x-layouts.main>