<x-layouts.main title="{{ isset($survey) ? 'Edit Jadwal Survey' : 'Buat Jadwal Survey' }}">

{{-- HEADER --}}
<div class="flex items-center gap-3 mb-6">
    <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-9">
    <h1 class="text-xl font-semibold text-gray-800">
        {{ isset($survey) ? 'Edit Jadwal Survey' : 'Buat Jadwal Survey' }}
    </h1>
</div>

{{-- ERROR VALIDATION --}}
@if($errors->any())
    <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg mb-4">
        @foreach($errors->all() as $e)
            • {{ $e }} <br>
        @endforeach
    </div>
@endif

<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">

    <form method="POST"
          action="{{ isset($survey) ? route('admin.surveys.update', $survey->id) : route('admin.surveys.store') }}"
          class="space-y-6">

        @csrf
        @if(isset($survey)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            {{-- UNIT --}}
            <div>
                <label class="text-xs text-gray-600 font-medium">Unit Kerja</label>
                <select name="unit_id" id="unit_id" required
                        onchange="loadRooms(this.value)"
                        class="mt-1 w-full px-3 py-2 border rounded-lg text-sm">
                    <option value="">Pilih Unit</option>
                    @foreach($units as $u)
                        <option value="{{ $u->id }}"
                            {{ old('unit_id',$survey->unit_id ?? '')==$u->id?'selected':'' }}>
                            {{ $u->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- ROOM --}}
            <div>
                <label class="text-xs text-gray-600 font-medium">Ruangan</label>
                <select name="room_id" id="room_id" required
                        class="mt-1 w-full px-3 py-2 border rounded-lg text-sm">
                    <option value="">
                        {{ isset($survey) ? $survey->room->name : 'Pilih Unit dahulu' }}
                    </option>
                </select>
            </div>

            {{-- DATE --}}
            <div>
                <label class="text-xs text-gray-600 font-medium">Tanggal Batas Survey</label>
                <input type="date" name="scheduled_date" required
                       value="{{ old('scheduled_date', $survey->scheduled_date ?? '') }}"
                       class="mt-1 w-full px-3 py-2 border rounded-lg text-sm">
            </div>

            {{-- METHOD --}}
            <div class="md:col-span-3">
                <label class="text-xs text-gray-600 font-medium">Metode</label>
                <select name="survey_method" required
                        class="w-full mt-1 px-3 py-2 border rounded-lg text-sm">
                    <option value="admin"
                        {{ old('survey_method',$survey->survey_method ?? '')=='admin'?'selected':'' }}>
                        Admin
                    </option>
                    <option value="user"
                        {{ old('survey_method',$survey->survey_method ?? '')=='user'?'selected':'' }}>
                        User Unit
                    </option>
                </select>
            </div>

            {{-- STATUS (ONLY IN EDIT MODE) --}}
            @if(isset($survey))
            <div class="md:col-span-3">
                <label class="text-xs text-gray-600 font-medium">Status</label>
                <select name="status"
                        class="w-full mt-1 px-3 py-2 border rounded-lg text-sm">
                    @foreach(['dijadwalkan','menunggu_validasi','selesai','ditolak','expired'] as $st)
                        <option value="{{ $st }}"
                            {{ old('status',$survey->status)==$st?'selected':'' }}>
                            {{ ucfirst($st) }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endif

        </div>

        <div class="flex gap-2 pt-3">
            <button type="submit"
                class="px-5 py-2.5 bg-[#0F3B89] text-white text-sm rounded-lg shadow">
                Simpan
            </button>

            <a href="{{ route('admin.surveys.index') }}"
               class="px-5 py-2.5 bg-gray-200 text-sm rounded-lg">
                Batal
            </a>
        </div>

    </form>
</div>

<script>
async function loadRooms(unitId){
    const r = await fetch(`/admin/ajax/rooms/${unitId}`);
    const rooms = await r.json();

    const el = document.getElementById('room_id');
    el.innerHTML = '<option value="">Pilih Ruangan</option>';

    rooms.forEach(room => {
        el.innerHTML += `<option value="${room.id}">${room.name}</option>`;
    });

    @if(isset($survey))
        el.value = "{{ $survey->room_id }}";
    @endif
}
</script>

</x-layouts.main>
