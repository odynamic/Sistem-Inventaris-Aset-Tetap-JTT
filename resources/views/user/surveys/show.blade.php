<x-layouts.main title="Detail Survey">

<div x-data="{ photo:false, url:null }" class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center gap-3 mb-6">
        <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-10">
        <h1 class="text-2xl font-bold text-gray-800">Detail Survey</h1>
    </div>

    {{-- INFO CARD --}}
    <div class="bg-white p-6 rounded-2xl shadow-md border grid grid-cols-1 md:grid-cols-2 gap-6 text-base">
        <div>
            <div class="text-gray-600 font-medium">Unit</div>
            <div class="font-semibold text-lg">{{ $survey->unit->full_name }}</div>
        </div>
        <div>
            <div class="text-gray-600 font-medium">Ruangan</div>
            <div class="font-semibold text-lg">{{ $survey->room->name }}</div>
        </div>
        <div>
            <div class="text-gray-600 font-medium">Metode</div>
            <div class="font-semibold text-lg capitalize">{{ $survey->survey_method }}</div>
        </div>
        <div>
            <div class="text-gray-500">Status</div>
            @php
                $statusColors = [
                    'dijadwalkan'       => 'bg-green-100 text-green-800',
                    'menunggu_validasi' => 'bg-yellow-100 text-yellow-800',
                    'selesai'           => 'bg-blue-100 text-blue-800',
                    'ditolak'           => 'bg-red-100 text-red-800',
                    'expired'           => 'bg-gray-200 text-gray-700',
                ];
                $colorClass = $statusColors[$survey->status] ?? 'bg-gray-100 text-gray-700';
            @endphp
            <div class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $colorClass }}">
                {{ strtoupper(str_replace('_',' ',$survey->status)) }}
            </div>
        </div>
        <div>
            <div class="text-gray-600 font-medium">Batas Survey</div>
            <div class="font-semibold text-lg">{{ $survey->scheduled_date }}</div>
        </div>
        <div>
            <div class="text-gray-600 font-medium">Dilakukan oleh</div>
            <div class="font-semibold text-lg">{{ $survey->performer->name ?? '-' }}</div>
        </div>
    </div>

    {{-- TABEL HASIL SURVEY --}}
    <div class="bg-white p-6 rounded-2xl shadow-md border">
        <h2 class="text-lg font-semibold text-gray-800 mb-4 text-left">Hasil Survey</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-base table-auto border-collapse">
                <thead>
                    <tr class="bg-[#F4F6FA] text-gray-700 uppercase text-center">
                        <th class="p-3">Aset</th>
                        <th class="p-3">Kondisi</th>
                        <th class="p-3">Ada/Tidak</th>
                        <th class="p-3">Foto</th>
                        <th class="p-3">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($survey->items as $item)
                    <tr class="border-b hover:bg-gray-50 text-center">
                        <td class="p-3 font-medium text-gray-800">{{ $item->asset->name }}</td>

                        {{-- CONDITION --}}
                        <td class="p-3">
                            {{ $item->condition ? str_replace('_',' ',$item->condition) : '-' }}
                        </td>

                        {{-- EXISTENCE --}}
                        <td class="p-3">
                            {{ $item->existence ? str_replace('_',' ',$item->existence) : '-' }}
                        </td>

                        {{-- PHOTO --}}
                        <td class="p-3 flex justify-center">
                            @if($item->photo)
                                <img src="{{ asset('storage/'.$item->photo) }}"
                                     class="h-20 w-28 object-cover rounded cursor-pointer border"
                                     @click="photo=true; url='{{ asset('storage/'.$item->photo) }}'">
                            @else
                                -
                            @endif
                        </td>

                        {{-- NOTES --}}
                        <td class="p-3">{{ $item->notes ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- PHOTO MODAL --}}
    <div x-show="photo" x-cloak
         class="fixed inset-0 bg-black/60 flex items-center justify-center p-4 z-50">
        <div class="absolute inset-0" @click="photo=false"></div>
        <div class="relative max-w-3xl w-full flex justify-center">
            <img :src="url" class="w-full rounded shadow-lg max-h-[80vh] object-contain">
            <button @click="photo=false"
                    class="absolute top-2 right-2 bg-white rounded-full p-2 shadow font-bold">
                ✕
            </button>
        </div>
    </div>

</div>

</x-layouts.main>
