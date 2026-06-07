<x-layouts.main title="Isi Survey (Admin)">

    {{-- ========================= --}}
    {{-- HEADER --}}
    {{-- ========================= --}}
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-9">
            <h1 class="text-xl font-semibold text-gray-800">Formulir Survey Aset Tetap</h1>
        </div>
    </div>


    {{-- ========================= --}}
    {{-- EXPIRED MESSAGE --}}
    {{-- ========================= --}}
    @if($survey->status=='expired')
        <div class="flex items-center gap-2 bg-yellow-50 text-yellow-800 border border-yellow-200 p-4 rounded-xl mb-4">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 9v2m0 4h.01M12 3C6.48 3 2 7.48 2 13s4.48 10 10 10 10-4.48 10-10S17.52 3 12 3z" />
            </svg>
            <span>Survey ini sudah <strong>expired</strong>. Tidak dapat dilakukan.</span>
        </div>
    @endif

    {{-- ========================= --}}
    {{-- FORM CONTENT --}}
    {{-- ========================= --}}
    @if($survey->status!='expired')
    <div class="bg-white p-6 rounded-2xl shadow-sm space-y-6">

        {{-- SUBTITLE --}}
        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2">
            Detail Aset di {{ $survey->room->name ?? 'Belum ditentukan' }}
        </h2>

        <form method="POST" action="{{ route('admin.surveys.fillStore',$survey) }}" enctype="multipart/form-data">
            @csrf

            {{-- TABLE --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-collapse rounded-2xl overflow-hidden shadow-sm">
                    <thead class="bg-[#F4F6FA] text-xs text-gray-600 uppercase">
    <tr>
        <th class="p-3 text-center">Aset</th>
        <th class="p-3 text-center">Kondisi</th>
        <th class="p-3 text-center">Ketersediaan</th>
        <th class="p-3 text-center">Foto</th>
        <th class="p-3 text-center">Catatan</th>
    </tr>
</thead>

                    <tbody>
                        @foreach($survey->items as $i)
                        <tr class="border-b last:border-0 hover:bg-gray-50 transition">
                            {{-- ASEET NAME --}}
                            <td class="p-3 font-medium text-gray-800">
                                {{ $i->asset->name }}
                            </td>

                            {{-- CONDITION --}}
                            <td class="p-3">
                                <select name="items[{{ $i->id }}][condition]"
                                        class="w-full px-3 py-2 border rounded-xl text-sm focus:ring focus:ring-blue-200">
                                    <option value="">Pilih kondisi</option>
                                    <option value="baik" {{ $i->condition=='baik'?'selected':'' }}>Baik</option>
                                    <option value="rusak_ringan" {{ $i->condition=='rusak_ringan'?'selected':'' }}>Rusak Ringan</option>
                                    <option value="rusak_berat" {{ $i->condition=='rusak_berat'?'selected':'' }}>Rusak Berat</option>
                                    <option value="hilang" {{ $i->condition=='hilang'?'selected':'' }}>Hilang</option>
                                </select>
                            </td>

                            {{-- EXISTENCE --}}
                            <td class="p-3">
                                <select name="items[{{ $i->id }}][existence]"
                                        class="w-full px-3 py-2 border rounded-xl text-sm focus:ring focus:ring-blue-200">
                                    <option value="">Pilih</option>
                                    <option value="ada" {{ $i->existence=='ada'?'selected':'' }}>Ada</option>
                                    <option value="tidak_ada" {{ $i->existence=='tidak_ada'?'selected':'' }}>Tidak Ada</option>
                                </select>
                            </td>

                            {{-- PHOTO --}}
                            <td class="p-3">
                                <input type="file" name="photos[{{ $i->id }}]"
                                       class="block w-full text-sm bg-gray-50 rounded-xl border px-2 py-1 mb-1">
                                
                                @if($i->photo)
                                    <a href="{{ asset('storage/'.$i->photo) }}" target="_blank" class="inline-block mt-1">
                                        <img src="{{ asset('storage/'.$i->photo) }}" class="h-12 rounded-lg border">
                                    </a>
                                @endif
                            </td>

                            {{-- NOTES --}}
                            <td class="p-3">
                                <textarea name="items[{{ $i->id }}][notes]"
                                          rows="2"
                                          placeholder="Masukkan catatan..."
                                          class="w-full px-3 py-2 border rounded-xl text-sm focus:ring focus:ring-blue-200">{{ $i->notes }}</textarea>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

{{-- BUTTON --}}
<div class="pt-6 flex gap-3">
    <button type="submit" 
            class="px-6 py-3 bg-[#0F3B89] text-white rounded-2xl shadow hover:bg-[#0d3273] transition duration-200 ease-in-out">
        Simpan Survey
    </button>

    <a href="{{ route('admin.surveys.index') }}" 
       class="px-6 py-3 bg-gray-200 text-gray-800 rounded-2xl shadow hover:bg-gray-300 transition duration-200 ease-in-out">
        Cancel
    </a>
</div>

        </form>
    </div>
    @endif

</x-layouts.main>
