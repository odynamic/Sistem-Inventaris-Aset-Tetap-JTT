<x-layouts.main title="Detail Pengajuan">

<div class="w-full max-w-4xl mx-auto mt-6 space-y-6">

    {{-- HEADER --}}
<div class="flex items-start justify-between w-full">

    {{-- KIRI: Back + Logo + Judul --}}
    <div class="flex items-start gap-3">
        <a href="{{ route('user.submissions.index') }}" 
           class="text-gray-600 hover:text-[#0F3B89] transition mt-1">
            <i class="ph ph-arrow-left text-2xl"></i>
        </a>

        <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-10">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Pengajuan</h1>
            <div class="flex items-center gap-3 text-xs text-gray-500 mt-0.5">
                <div class="flex items-center gap-1">
                    <i class="ph ph-clock text-gray-400"></i>
                    {{ $sub->created_at->format('d M Y H:i') }}
                </div>
            </div>
        </div>
    </div>

    {{-- KANAN: Badge --}}
    <div>
        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full capitalize
            @if($sub->status=='pending') bg-yellow-100 text-yellow-800
            @elseif($sub->status=='approved') bg-green-100 text-green-800
            @elseif($sub->status=='rejected') bg-red-100 text-red-800
            @else bg-gray-100 text-gray-700 @endif">
            {{ ucfirst($sub->status) }}
        </span>
    </div>

</div>



    {{-- INFORMASI UTAMA --}}
    <section class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 space-y-4">

        <h2 class="font-semibold text-lg md:text-xl text-[#0F3B89] flex items-center gap-2">
            <i class="ph ph-info text-xl"></i>
            Informasi Pengajuan
        </h2>

        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm md:text-base">
            <div>
                <dt class="text-gray-500">Tipe Pengajuan</dt>
                <dd class="mt-1 font-semibold text-gray-900 capitalize">{{ $sub->type }}</dd>
            </div>

            <div>
                <dt class="text-gray-500">Ruangan</dt>
                <dd class="mt-1 font-semibold text-gray-900">
                    @if($sub->type === 'penambahan')
                        {{ $sub->addRoom?->name ?? '-' }}
                    @else
                        {{ $sub->room?->name ?? '-' }}
                    @endif
                </dd>
            </div>

            <div class="md:col-span-2">
                <dt class="text-gray-500">Deskripsi</dt>
                <dd class="mt-1 p-3 bg-gray-50 rounded-lg border text-gray-800 leading-relaxed">
                    {{ $sub->description ?: 'Tidak ada deskripsi.' }}
                </dd>
            </div>
        </dl>

    </section>


    {{-- DETAIL KHUSUS BERDASARKAN TIPE --}}
    @if($sub->type === 'penambahan')

        <section class="bg-blue-50 border border-blue-200 rounded-lg p-5 space-y-3">
            <h3 class="font-semibold text-lg text-[#0F3B89] flex items-center gap-2">
                <i class="ph ph-plus-circle"></i> Detail Penambahan Aset
            </h3>

            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm md:text-base">
                <div>
                    <dt class="text-gray-600">Nama Aset</dt>
                    <dd class="font-bold text-blue-800">{{ $sub->add_name }}</dd>
                </div>

                <div>
                    <dt class="text-gray-600">Jumlah</dt>
                    <dd class="font-bold text-blue-800">{{ $sub->add_quantity }} {{ $sub->add_unit }}</dd>
                </div>

                <div>
                    <dt class="text-gray-600">Kondisi</dt>
                    <dd class="font-bold text-blue-800">{{ $sub->add_condition }}</dd>
                </div>

                @if($sub->add_acquired_year)
                <div>
                    <dt class="text-gray-600">Tahun Perolehan</dt>
                    <dd class="font-bold text-blue-800">{{ $sub->add_acquired_year }}</dd>
                </div>
                @endif
            </dl>
        </section>


    @elseif($sub->type === 'perubahan')

        <section class="bg-blue-50 border border-blue-200 rounded-lg p-5 space-y-3">
            <h3 class="font-semibold text-lg text-[#0F3B89] flex items-center gap-2">
                <i class="ph ph-arrow-circle-right"></i> Detail Perubahan Aset
            </h3>

            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm md:text-base">
                <div>
                    <dt class="text-gray-600">Nama Aset</dt>
                    <dd class="font-bold text-blue-800">{{ $sub->asset?->name }}</dd>
                </div>

                <div>
                    <dt class="text-gray-600">Jumlah Lama</dt>
                    <dd class="font-bold">{{ $sub->old_quantity }}</dd>
                </div>

                <div>
                    <dt class="text-gray-600">Jumlah Baru</dt>
                    <dd class="font-bold text-blue-800">{{ $sub->new_quantity ?? '-' }}</dd>
                </div>

                <div>
                    <dt class="text-gray-600">Kondisi Lama</dt>
                    <dd class="font-bold">{{ $sub->old_condition }}</dd>
                </div>

                <div>
                    <dt class="text-gray-600">Kondisi Baru</dt>
                    <dd class="font-bold text-blue-800">{{ $sub->new_condition ?? '-' }}</dd>
                </div>

                <div class="md:col-span-2">
                    <dt class="text-gray-600">Alasan Pengajuan</dt>
                    <dd class="mt-1 p-3 bg-gray-50 border rounded-lg text-gray-800">
                        {{ $sub->description }}
                    </dd>
                </div>
            </dl>
        </section>


    @else {{-- PENGHAPUSAN --}}

        <section class="bg-blue-50 border border-blue-200 rounded-lg p-5 space-y-3">
            <h3 class="font-semibold text-lg text-[#0F3B89] flex items-center gap-2">
                <i class="ph ph-trash"></i> Detail Penghapusan Aset
            </h3>

            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm md:text-base">
                <div>
                    <dt class="text-gray-600">Aset</dt>
                    <dd class="font-bold text-red-800">{{ $sub->asset?->name }}</dd>
                </div>

                <div>
                    <dt class="text-gray-600">Jumlah</dt>
                    <dd class="font-bold text-red-800">{{ $sub->old_quantity }}</dd>
                </div>

                <div>
                    <dt class="text-gray-600">Kondisi</dt>
                    <dd class="font-bold text-red-800">{{ $sub->old_condition }}</dd>
                </div>

                <div class="md:col-span-2">
                    <dt class="text-gray-600">Alasan Penghapusan</dt>
                    <dd class="mt-1 p-3 bg-gray-50 border rounded-lg text-gray-800">
                        {{ $sub->description }}
                    </dd>
                </div>
            </dl>
        </section>

    @endif



    {{-- FOTO --}}
    @if($sub->photo)
    <section class="space-y-2">
        <h4 class="text-gray-500 text-sm flex items-center gap-1">
            <i class="ph ph-camera"></i> Foto Bukti Pengajuan
        </h4>

        <a href="{{ asset('storage/'.$sub->photo) }}" target="_blank">
            <img src="{{ asset('storage/'.$sub->photo) }}" 
                 class="rounded-lg w-full md:w-80 shadow-sm hover:shadow-lg transition">
        </a>
    </section>
    @endif



{{-- CANCEL / BUTTON (MODAL) --}}
@if($sub->status === 'pending')
<div x-data="{ openCancel: false }" class="pt-4 border-t">

    <button 
        @click="openCancel = true"
        class="px-5 py-2.5 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 font-semibold">
        <i class="ph ph-x-circle mr-1"></i> Batalkan Pengajuan
    </button>

    {{-- MODAL --}}
    <div 
        x-show="openCancel"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">

        <div 
            class="bg-white w-full max-w-md rounded-2xl shadow-xl p-8 text-center relative">

            {{-- Icon merah --}}
            <div class="mx-auto mb-4 flex items-center justify-center w-16 h-16 rounded-full bg-red-100">
                <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v4m0 4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                </svg>
            </div>

            {{-- Judul --}}
            <h2 class="text-xl font-bold text-gray-800 mb-3">
                Batalkan Pengajuan?
            </h2>

            {{-- Deskripsi --}}
            <p class="text-gray-600 mb-6 leading-relaxed text-sm">
                Pengajuan ini akan dibatalkan dan tindakan ini tidak dapat dipulihkan.
                Apakah kamu yakin ingin melanjutkan?
            </p>

            {{-- Tombol --}}
            <div class="flex justify-center gap-3">
                <button 
                    @click="openCancel = false"
                    class="px-5 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                    Batal
                </button>

                <form action="{{ route('user.submissions.cancel', $sub->id) }}" method="POST">
                    @csrf
                    <button 
                        class="px-5 py-2 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 transition">
                        Ya, Batalkan
                    </button>
                </form>
            </div>

        </div>
    </div>

</div>
@endif


</div>

</x-layouts.main>
