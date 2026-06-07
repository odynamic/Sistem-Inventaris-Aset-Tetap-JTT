<x-layouts.main title="Jadwal Survey">

<div x-data="surveyPage()" class="space-y-4">

    {{-- ========================= --}}
    {{-- HEADER --}}
    {{-- ========================= --}}
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-9">
            <h1 class="text-xl font-semibold text-gray-800">Jadwal Survey</h1>
        </div>

        <button @click="openCreate()"
                class="px-4 py-2 rounded-lg bg-[#0F3B89] text-white text-sm shadow hover:opacity-90 flex items-center gap-2">
            <i class="ph ph-plus text-lg"></i>
            Tambah Jadwal
        </button>
    </div>


    {{-- ========================= --}}
    {{-- FILTER --}}
    {{-- ========================= --}}
    <div class="bg-white p-4 rounded-xl border shadow-sm">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            {{-- Unit --}}
            <div>
                <label class="text-xs text-gray-600">Unit Kerja</label>
                <select name="unit_id" class="w-full mt-1 px-3 py-2 border rounded-lg text-sm" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    @foreach($units as $u)
                        <option value="{{ $u->id }}" {{ request('unit_id')==$u->id?'selected':'' }}>
                            {{ $u->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Status --}}
            <div>
                <label class="text-xs text-gray-600">Status</label>
                <select name="status" class="w-full mt-1 px-3 py-2 border rounded-lg text-sm" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    <option value="dijadwalkan" {{ request('status')=='dijadwalkan'?'selected':'' }}>Dijadwalkan</option>
                    <option value="menunggu_validasi" {{ request('status')=='menunggu_validasi'?'selected':'' }}>Menunggu Validasi</option>
                    <option value="selesai" {{ request('status')=='selesai'?'selected':'' }}>Selesai</option>
                    <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
                    <option value="expired" {{ request('status')=='expired'?'selected':'' }}>Expired</option>
                </select>
            </div>

            {{-- Metode --}}
            <div>
                <label class="text-xs text-gray-600">Metode Survey</label>
                <select name="survey_method" class="w-full mt-1 px-3 py-2 border rounded-lg text-sm" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    <option value="admin" {{ request('survey_method')=='admin'?'selected':'' }}>Admin</option>
                    <option value="user" {{ request('survey_method')=='user'?'selected':'' }}>User</option>
                </select>
            </div>

            {{-- PENCARIAN --}}
            <div>
                <label class="text-[11px] text-gray-600 font-semibold">Pencarian</label>
                <div class="flex gap-2 mt-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari ruangan..."
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
{{-- TABEL --}}
{{-- ========================= --}}
<div class="bg-white p-4 rounded-xl border shadow-sm">
    <table class="w-full text-sm">
        <thead>
        <tr class="bg-[#F4F6FA] text-xs text-gray-600 uppercase text-center">
            <th class="p-2">#</th>
            <th class="p-2">Unit</th>
            <th class="p-2">Ruangan</th>
            <th class="p-2">Metode</th>
            <th class="p-2">Batas</th>
            <th class="p-2">Status</th>
            <th class="p-2">Aksi</th>
        </tr>
        </thead>

        <tbody>
        @forelse($surveys as $s)
            <tr class="border-b hover:bg-gray-50 text-center">

                <td class="p-2">{{ $s->id }}</td>
                <td class="p-2">{{ $s->unit->full_name ?? '-' }}</td>
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


                <td class="p-2">
            <div class="flex justify-center gap-2">

        {{-- VIEW --}}
        <a href="{{ route('admin.surveys.show',$s->id) }}"
           class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 hover:bg-gray-100 text-gray-700">
            <i class="ph ph-eye text-base"></i>
        </a>

        {{-- EDIT --}}
        @if($s->status == 'dijadwalkan')
            <button @click="openEdit({
    id: {{ $s->id }},
    unit_id: {{ $s->unit->id }},
    room_id: {{ $s->room->id }},
    unit_name: '{{ $s->unit->full_name }}',
    room_name: '{{ $s->room->name }}',
    scheduled_date: '{{ $s->scheduled_date }}',
    survey_method: '{{ $s->survey_method }}'
})" class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700"> 
    <i class="ph ph-pencil"></i>
</button>

        @endif

        {{-- FILL FORM --}}
        @if($s->status=='dijadwalkan' && $s->survey_method=='admin')
            <a href="{{ route('admin.surveys.fillForm',$s->id) }}"
               class="w-8 h-8 flex items-center justify-center rounded-lg bg-green-50 hover:bg-gray-100 text-gray-700">
                <i class="ph ph-clipboard-text text-base"></i>
            </a>
        @endif

        {{-- DELETE --}}
        @if($s->status=='dijadwalkan')
            <button @click="openDelete('{{ route('admin.surveys.destroy',$s->id) }}')"
                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 hover:bg-red-100 text-red-600">
                <i class="ph ph-trash text-base"></i>
            </button>
        @endif

    </div>
</td>



            </tr>
        @empty
            <tr>
                <td colspan="7" class="p-4 text-center text-gray-500">Tidak ada jadwal.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-3">{{ $surveys->links() }}</div>
</div>



    {{-- ========================================================= --}}
{{-- MODAL CREATE --}}
{{-- ========================================================= --}}
<div x-data="{
        rooms: @js($rooms),
        filteredRooms: [],
        selectedUnit: '',
        filterRooms() {
            this.filteredRooms = this.rooms.filter(r => r.unit_id == this.selectedUnit);
        }
    }"
    x-show="modalCreate"
    class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50"
     x-transition>
    <div class="bg-white rounded-2xl shadow-2xl p-7 w-[390px]">

        {{-- ICON HEADER --}}
        <div class="flex justify-center mb-4">
            <div class="w-14 h-14 bg-blue-50 rounded-full flex items-center justify-center shadow-sm">
                <i class="ph ph-calendar text-blue-700 text-3xl"></i>
            </div>
        </div>

        <h2 class="text-lg font-semibold text-gray-800 text-center mb-4">
            Tambah Jadwal Survey
        </h2>

        <form method="POST" action="{{ route('admin.surveys.store') }}" class="space-y-4">
            @csrf

            {{-- UNIT --}}
            <div>
                <label class="text-xs font-semibold text-gray-600">Unit Kerja</label>
                <select name="unit_id"
                        x-model="selectedUnit"
                        @change="filterRooms()"
                        class="w-full mt-1 rounded-lg border-gray-300 text-sm px-3 py-2 focus:ring-[#0F3B89] focus:border-[#0F3B89]"
                        required>

                    <option value="" disabled selected>Pilih Unit</option>

                    @foreach($units as $u)
                        <option value="{{ $u->id }}">{{ $u->full_name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- RUANGAN (TERFILTER) --}}
            <div>
                <label class="text-xs font-semibold text-gray-600">Ruangan</label>
                <select name="room_id"
                        class="w-full mt-1 rounded-lg border-gray-300 text-sm px-3 py-2 focus:ring-[#0F3B89] focus:border-[#0F3B89]"
                        required>
<option value="">Pilih Ruangan</option>
                    <template x-for="r in filteredRooms" :key="r.id">
                        <option :value="r.id" x-text="r.name"></option>
                    </template>

                </select>
            </div>

            {{-- TANGGAL --}}
            <div>
                <label class="text-xs font-semibold text-gray-600">Batas Survey</label>
                <input type="date" name="scheduled_date"
                       class="w-full mt-1 rounded-lg border-gray-300 text-sm px-3 py-2 focus:ring-[#0F3B89] focus:border-[#0F3B89]"
                       required>
            </div>

            {{-- METODE --}}
            <div>
                <label class="text-xs font-semibold text-gray-600">Metode</label>
                <select name="survey_method"
                        class="w-full mt-1 rounded-lg border-gray-300 text-sm px-3 py-2 focus:ring-[#0F3B89] focus:border-[#0F3B89]"
                        required>
                        <option value="">Metode</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <div class="flex justify-center gap-3 mt-4">
                <button type="button"
                    @click="modalCreate=false"
                    class="px-4 py-1.5 bg-gray-100 rounded-lg text-sm hover:bg-gray-200">
                    Batal
                </button>

                <button type="submit"
                    class="px-4 py-1.5 bg-[#0F3B89] text-white rounded-lg text-sm hover:bg-[#0d3373] shadow">
                    Simpan
                </button>
            </div>
        </form>

    </div>
</div>

<div x-show="modalEdit"
     x-cloak
     class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50"
     x-transition>

<div class="bg-white w-[420px] max-w-full rounded-2xl p-6 shadow-2xl">

    {{-- ICON --}}
    <div class="flex justify-center mb-2">
        <div class="w-12 h-12 bg-[#0F3B89]/10 text-[#0F3B89] rounded-xl flex items-center justify-center">
            <i class="ph ph-pencil-simple-line text-3xl"></i>
        </div>
    </div>

    {{-- TITLE --}}
    <h2 class="text-center text-xl font-semibold text-gray-700 mb-4">
        Edit Jadwal Survey
    </h2>

        <form method="POST" :action="editAction" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="text-xs font-semibold text-gray-600">Unit</label>
                <input type="hidden" name="unit_id" :value="edit.unit_id">
                <input type="text"
                       class="w-full mt-1 px-3 py-2 bg-gray-100 border rounded-xl text-sm"
                       :value="edit.unit_name" disabled>
            </div>

            <div>
                <label class="text-xs font-semibold text-gray-600">Ruangan</label>
                <input type="hidden" name="room_id" :value="edit.room_id">
                <input type="text"
                       class="w-full mt-1 px-3 py-2 bg-gray-100 border rounded-xl text-sm"
                       :value="edit.room_name" disabled>
            </div>

            <div>
                <label class="text-xs font-semibold text-gray-600">Batas Survey</label>
                <input type="date" name="scheduled_date"
                       class="w-full mt-1 px-3 py-2 border rounded-xl text-sm"
                       :value="edit.scheduled_date">
            </div>

            <div>
                <label class="text-xs font-semibold text-gray-600">Metode</label>
                <select name="survey_method"
                        class="w-full mt-1 px-3 py-2 border rounded-xl text-sm">
                    <option value="admin" :selected="edit.survey_method === 'admin'">Admin</option>
                    <option value="user" :selected="edit.survey_method === 'user'">User</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" @click="modalEdit=false"
                        class="px-4 py-2 bg-gray-200 rounded-xl">
                    Batal
                </button>

                <button type="submit"
                        class="px-4 py-2 bg-[#0F3B89] text-white rounded-xl">
                    Simpan
                </button>
            </div>

        </form>

    </div>
</div>
<div x-show="modalDelete"
     x-cloak
     class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50"
     x-transition>

    <div class="bg-white w-[420px] max-w-full rounded-2xl p-7 shadow-2xl text-center">

        {{-- ICON TRASH --}}
        <div class="flex justify-center mb-3">
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                <i class="ph ph-trash text-red-600 text-3xl"></i>
            </div>
        </div>

        {{-- TITLE --}}
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Hapus Jadwal?</h2>

        {{-- DESCRIPTION --}}
        <p class="text-sm text-gray-600 mb-6">
            Jadwal survey akan dihapus permanen dan tindakan ini tidak dapat dibatalkan.
        </p>

        {{-- ACTION BUTTONS --}}
        <form method="POST" :action="deleteAction">
            @csrf
            @method("DELETE")

            <div class="flex justify-center gap-3">
                <button type="button"
                        @click="modalDelete=false"
                        class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                    Batal
                </button>

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                    Hapus
                </button>
            </div>
        </form>

    </div>
</div>



</div>


{{-- ============================================================= --}}
{{-- SCRIPT ALPINE --}}
{{-- ============================================================= --}}
<script>
function surveyPage() {
    return {
        modalCreate: false,
        modalEdit: false,
        modalDelete: false,

        edit: {},
        editAction: "",
        deleteAction: "",

        openCreate() {
            this.modalCreate = true;
        },

openEdit(data) {
    this.edit = {
        ...data,
        scheduled_date: data.scheduled_date?.substring(0, 10)
    };

    this.editAction = `/admin/surveys/${data.id}`;
    this.modalEdit = true;
},  // ← HARUS ADA KOMA DI SINI

openDelete(url) {
    this.deleteAction = url;
    this.modalDelete = true;
}

    }
}
</script>

</x-layouts.main>
