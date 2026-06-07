<x-layouts.main title="Data Ruangan">

<div x-data="{ 
        openCreate:false,
        openEdit:false, 
        openDelete:false,
        deleteId:null,
        editData:{}
    }">

    {{-- ========================= --}}
    {{-- HEADER --}}
    {{-- ========================= --}}
    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-8">
            <h1 class="text-lg font-semibold text-gray-800 tracking-wide">Data Ruangan</h1>
        </div>

        <button
            @click="openCreate=true"
            class="px-3 py-2 bg-[#0F3B89] text-white rounded-lg shadow hover:bg-[#0d3373] flex items-center gap-1.5 text-sm">
            <i class="ph ph-plus-circle text-base"></i>
            Tambah
        </button>
    </div>



    {{-- ========================= --}}
    {{-- FILTER --}}
    {{-- ========================= --}}
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-5">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">

            {{-- UNIT --}}
            <div>
                <label class="text-[11px] text-gray-600 font-semibold">Unit Kerja</label>
                <select name="unit_id"
                        onchange="this.form.submit()"
                        class="w-full mt-1 rounded-lg border-gray-300 text-sm px-3 py-1.5 focus:ring-[#0F3B89] focus:border-[#0F3B89]">
                    <option value="">Semua</option>
                    @foreach($units as $u)
                        <option value="{{ $u->id }}" @selected(request('unit_id')==$u->id)>{{ $u->full_name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- SEARCH --}}
            <div class="md:col-span-3">
                <label class="text-[11px] text-gray-600 font-semibold">Pencarian</label>

                <div class="flex gap-2 mt-1">

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama ruangan..."
                        class="w-full px-3 py-1.5 border rounded-lg text-sm focus:ring-[#0F3B89] focus:border-[#0F3B89]">

                    <button class="px-4 py-1.5 bg-[#0F3B89] text-white rounded-lg text-sm shadow hover:bg-[#0d3373]">Cari</button>

                    @if(request()->filled('search') || request()->filled('unit_id'))
                    <a href="{{ route('admin.rooms.index') }}"
                        class="px-4 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200 shadow">Reset</a>
                    @endif
                </div>
            </div>

        </form>
    </div>



    {{-- ========================= --}}
    {{-- TABLE --}}
    {{-- ========================= --}}
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">

        <table class="w-full text-sm text-center">
            <thead>
                <tr class="bg-[#F4F6FA] text-gray-600 uppercase text-[10px] tracking-wide border-b">
                    <th class="py-2 px-3">No</th>
                    <th class="py-2 px-3">Unit</th>
                    <th class="py-2 px-3">Nama Ruangan</th>
                    <th class="py-2 px-3 w-[70px]">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($rooms as $r)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="py-1.5 px-3">{{ $loop->iteration }}</td>
                    <td class="py-1.5 px-3">{{ $r->unit->full_name }}</td>
                    <td class="py-1.5 px-3 font-medium">{{ $r->name }}</td>

                    <td class="py-1.5 px-3">
                        <div class="flex justify-center gap-2">

                            {{-- EDIT --}}
                            <button
                                @click="
                                    openEdit=true;
                                    editData = {
                                        id: '{{ $r->id }}',
                                        name: '{{ $r->name }}',
                                        unit_name: '{{ $r->unit->full_name }}'
                                    };
                                "
                                class="p-1.5 rounded-md bg-blue-50 text-blue-700 hover:bg-blue-100 transition">
                                <i class="ph ph-pencil-simple text-base"></i>
                            </button>

                            {{-- DELETE --}}
                            <button
                                @click="openDelete=true; deleteId={{ $r->id }}"
                                class="p-1.5 rounded-md bg-red-50 text-red-600 hover:bg-red-100 transition">
                                <i class="ph ph-trash text-base"></i>
                            </button>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-3 text-gray-500">Tidak ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">{{ $rooms->links() }}</div>
    </div>



    {{-- ======================================================= --}}
    {{-- MODAL CREATE --}}
    {{-- ======================================================= --}}
    <div x-show="openCreate" x-cloak class="fixed inset-0 z-[999] flex items-center justify-center">

        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"
             x-show="openCreate" x-transition.opacity></div>

        <div x-show="openCreate"
             x-transition.scale.80
             class="relative bg-white rounded-2xl shadow-2xl p-7 w-[390px]">

            {{-- ICON --}}
            <div class="flex justify-center mb-4">
                <div class="w-14 h-14 bg-blue-50 rounded-full flex items-center justify-center shadow-sm">
                    <i class="ph ph-buildings text-blue-700 text-3xl"></i>
                </div>
            </div>

            <h2 class="text-lg font-semibold text-gray-800 text-center mb-2">Tambah Ruangan</h2>

            <form action="{{ route('admin.rooms.store') }}" method="POST">
                @csrf

                {{-- UNIT --}}
                <div class="mb-4">
                    <label class="text-xs font-semibold text-gray-600">Unit Kerja</label>
                    <select name="unit_id"
                        class="w-full mt-1 rounded-lg border-gray-300 text-sm px-3 py-2 focus:ring-[#0F3B89] focus:border-[#0F3B89]">
                        @foreach($units as $u)
                            <option value="{{ $u->id }}">{{ $u->full_name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- NAME --}}
                <div class="mb-6">
                    <label class="text-xs font-semibold text-gray-600">Nama Ruangan</label>
                    <input name="name" type="text"
                        class="w-full mt-1 rounded-lg border-gray-300 text-sm px-3 py-2 focus:ring-[#0F3B89] focus:border-[#0F3B89]">
                </div>

                <div class="flex justify-center gap-3">
                    <button type="button"
                        @click="openCreate=false"
                        class="px-4 py-1.5 bg-gray-100 rounded-lg text-sm hover:bg-gray-200">Batal</button>

                    <button type="submit"
                        class="px-4 py-1.5 bg-[#0F3B89] text-white rounded-lg text-sm hover:bg-[#0d3373] shadow">Simpan</button>
                </div>

            </form>

        </div>
    </div>



    {{-- ======================================================= --}}
    {{-- MODAL EDIT --}}
    {{-- ======================================================= --}}
    <div x-show="openEdit" x-cloak class="fixed inset-0 z-[999] flex items-center justify-center">

        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"
             x-show="openEdit" x-transition.opacity></div>

        <div x-show="openEdit"
             x-transition.scale.80
             class="relative bg-white rounded-2xl shadow-2xl p-7 w-[390px]">

            {{-- ICON --}}
            <div class="flex justify-center mb-4">
                <div class="w-14 h-14 bg-blue-50 rounded-full flex items-center justify-center shadow-sm">
                    <i class="ph ph-buildings text-blue-700 text-3xl"></i>
                </div>
            </div>

            <h2 class="text-lg font-semibold text-gray-800 text-center mb-2">Edit Ruangan</h2>
            <p class="text-xs text-gray-500 text-center mb-5">Perbarui nama ruangan sesuai kebutuhan.</p>

            <form :action="`/admin/rooms/${editData.id}`" method="POST">
                @csrf
                @method('PUT')

                {{-- UNIT (READ ONLY) --}}
                <div class="mb-4">
                    <label class="text-xs font-semibold text-gray-600">Unit Kerja</label>
                    <input type="text"
                           class="w-full mt-1 rounded-lg bg-gray-100 border-gray-300 text-sm px-3 py-2 cursor-not-allowed"
                           x-model="editData.unit_name" disabled>
                </div>

                {{-- HIDDEN UNIT ID --}}
                <input type="hidden" name="unit_id" value="{{ auth()->user()->unit_id }}">

                {{-- NAME --}}
                <div class="mb-6">
                    <label class="text-xs font-semibold text-gray-600">Nama Ruangan</label>
                    <input type="text" name="name"
                           class="w-full mt-1 rounded-lg border-gray-300 text-sm px-3 py-2 focus:ring-[#0F3B89]"
                           x-model="editData.name">
                </div>

                <div class="flex justify-center gap-3">
                    <button type="button"
                        @click="openEdit=false"
                        class="px-4 py-1.5 bg-gray-100 rounded-lg text-sm hover:bg-gray-200">Batal</button>

                    <button type="submit"
                        class="px-4 py-1.5 bg-[#0F3B89] text-white rounded-lg text-sm hover:bg-[#0d3373] shadow">Simpan</button>
                </div>

            </form>

        </div>
    </div>



    {{-- ======================================================= --}}
    {{-- MODAL DELETE --}}
    {{-- ======================================================= --}}
    <div x-show="openDelete" x-cloak class="fixed inset-0 z-[999] flex items-center justify-center">

        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"
             x-show="openDelete" x-transition.opacity></div>

        <div x-show="openDelete"
             x-transition.scale.80
             class="relative bg-white rounded-2xl shadow-2xl p-6 w-[340px]">

            <div class="flex justify-center mb-4">
                <div class="w-12 h-12 bg-red-50 rounded-full flex items-center justify-center">
                    <i class="ph ph-warning text-red-600 text-2xl"></i>
                </div>
            </div>

            <h2 class="text-lg font-semibold text-gray-800 text-center mb-1">Hapus Ruangan?</h2>

            <p class="text-sm text-gray-600 text-center mb-5">
                Ruangan akan dihapus permanen dan tindakan ini tidak dapat dibatalkan.
            </p>

            <div class="flex justify-center gap-3">

                <button @click="openDelete=false"
                    class="px-4 py-1.5 bg-gray-100 rounded-lg text-sm hover:bg-gray-200">Batal</button>

                <form :action="`/admin/rooms/${deleteId}`" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="px-4 py-1.5 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700 shadow">
                        Hapus
                    </button>
                </form>

            </div>
        </div>
    </div>


</div>

</x-layouts.main>
