<x-layouts.main title="Detail Pengajuan Aset">


<style>
    /* =============================
       CUSTOM ALERT – kecil, rounded, elegan
       ============================= */
    .swal2-popup {
        border-radius: 12px !important;
        padding: 1.25rem !important;
        width: 340px !important;
    }
    .swal2-title {
        font-size: 1.1rem !important;
        font-weight: 700 !important;
    }
    .swal2-html-container {
        font-size: .85rem !important;
        margin-top: .25rem !important;
    }
    .swal2-actions button {
        border-radius: 8px !important;
        padding: .45rem .8rem !important;
        font-size: .8rem !important;
        font-weight: 600 !important;
        box-shadow: none !important;
    }

    /* =============================
       ICON SWEETALERT BIRU #0F3B89
       ============================= */
    .swal2-icon.swal2-info {
        border-color: #0F3B89 !important;
        color: #0F3B89 !important;
    }
    .swal2-icon.swal2-info::before,
    .swal2-icon.swal2-info::after {
        background-color: #0F3B89 !important;
    }

    /* Icon SweetAlert Penolakan / Error Merah */
.swal2-icon.swal2-error {
    border-color: #dc2626 !important;
    color: #dc2626 !important;
}

.swal2-icon.swal2-error::before,
.swal2-icon.swal2-error::after {
    background-color: #dc2626 !important;
}

/* Optional: Icon warning (tanda seru) */
.swal2-icon.swal2-warning {
    border-color: #dc2626 !important;
    color: #dc2626 !important;
}

.swal2-icon.swal2-warning::before,
.swal2-icon.swal2-warning::after {
    background-color: #dc2626 !important;
}


    /* =============================
       FULL PAGE BLUR SAAT SWEETALERT MUNCUL
       ============================= */
    body.swal2-shown > *:not(.swal2-container) {
        filter: blur(8px); /* tingkat blur */
        pointer-events: none; /* cegah klik di background */
        user-select: none;
        transition: filter 0.1s ease-in-out;
    }
</style>

<div class="w-full max-w-6xl mx-auto mt-6 space-y-6">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center gap-4">
        <div class="flex items-center gap-4">
            <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-10">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Pengajuan</h1>
                <div class="text-sm text-gray-500 mt-1 flex flex-wrap gap-2 md:gap-4">
                    <span class="flex items-center gap-1">
                        <i class="ph ph-user-circle"></i> {{ $sub->user?->name ?? 'User Tidak Dikenal' }}
                    </span>
                    <span class="flex items-center gap-1">
                        <i class="ph ph-clock"></i> {{ $sub->created_at->format('d M Y H:i') }}
                    </span>
                </div>
            </div>
        </div>
        <div class="mt-2 md:mt-0 ml-auto text-right">
            <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full capitalize
                @if($sub->status=='pending') bg-yellow-100 text-yellow-800
                @elseif($sub->status=='approved') bg-green-100 text-green-800
                @elseif($sub->status=='rejected') bg-red-100 text-red-800
                @else bg-gray-100 text-gray-700 @endif">
                {{ ucfirst($sub->status) }}
            </span>
        </div>
    </div>

    {{-- INFORMASI --}}
    <section class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 space-y-4">
        <h2 class="font-semibold text-lg md:text-xl text-[#0F3B89] flex items-center gap-2">
            <i class="ph ph-info text-xl md:text-2xl"></i>
            <span>Informasi Pengajuan <span class="capitalize">{{ $sub->type }}</span></span>
        </h2>

        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm md:text-base">
            <div>
                <dt class="text-gray-500">Aset Terkait</dt>
                <dd class="mt-1 font-semibold text-gray-900">{{ $sub->detail_text }}</dd>
            </div>

            <div>
                <dt class="text-gray-500">Ruangan</dt>
                <dd class="mt-1 font-semibold text-gray-900">
                    {{ $sub->room?->name ?? $sub->addRoom?->name ?? 'N/A' }}
                </dd>
            </div>

            <div class="md:col-span-2">
                <dt class="text-gray-500">Deskripsi</dt>
                <dd class="mt-1 p-3 bg-gray-50 rounded-lg border text-gray-800 leading-relaxed">
                    {{ $sub->description ?? 'Tidak ada deskripsi.' }}
                </dd>
            </div>
        </dl>
    </section>

    {{-- DETAIL TIPE --}}
    @if($sub->type === 'penambahan')
        <section class="bg-blue-50 border border-blue-200 rounded-lg p-4 space-y-2 text-base">
            <h3 class="font-semibold text-[#0F3B89] text-lg flex items-center gap-2">
                <i class="ph ph-plus-circle"></i> Detail Data Aset Baru
            </h3>

            <div class="grid grid-cols-2 gap-4 mt-2">
                <div>
                    <dt class="text-gray-600">Jumlah (Unit)</dt>
                    <dd class="font-bold text-blue-800">{{ $sub->add_quantity }} {{ $sub->add_unit }}</dd>
                </div>

                <div>
                    <dt class="text-gray-600">Tahun Perolehan</dt>
                    <dd class="font-bold text-blue-800">{{ $sub->add_acquired_year }}</dd>
                </div>

                <div class="col-span-2">
                    <dt class="text-gray-600">Kondisi Awal</dt>
                    <dd class="font-bold text-blue-800">{{ $sub->add_condition }}</dd>
                </div>
            </div>
        </section>

    @elseif($sub->type === 'perubahan')
        <section class="bg-blue-50 border border-blue-200 rounded-lg p-4 space-y-2 text-base">
            <h3 class="font-semibold text-[#0F3B89] text-lg flex items-center gap-2">
                <i class="ph ph-arrow-circle-right"></i> Perubahan yang Diajukan
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">

                @php
                    $cols = [
                        ['label'=>'Nama Aset', 'new'=>$sub->new_name, 'old'=>$sub->asset?->name],
                        ['label'=>'Jumlah', 'new'=>$sub->new_quantity, 'old'=>$sub->old_quantity ?? $sub->asset?->quantity],
                        ['label'=>'Kondisi', 'new'=>$sub->new_condition, 'old'=>$sub->old_condition ?? $sub->asset?->condition],
                    ];
                @endphp

                @foreach($cols as $col)
                    <div class="p-2 rounded @if($col['new'] && $col['new'] != $col['old']) bg-yellow-100 @endif">
                        <dt class="text-gray-600 text-sm">{{ $col['label'] }}</dt>
                        <dd class="mt-1 text-gray-900 flex items-center">
                            @if($col['new'] && $col['new'] != $col['old'])
                                <span class="line-through text-red-500 mr-2">{{ $col['old'] }}</span>
                                <i class="ph ph-arrow-right text-gray-500 text-sm mr-2"></i>
                                <span class="font-bold text-blue-600">{{ $col['new'] }}</span>
                            @else
                                <span class="font-bold">{{ $col['old'] }}</span>
                            @endif
                        </dd>
                    </div>
                @endforeach

            </div>
        </section>

    @elseif($sub->type === 'penghapusan')
        <section class="bg-blue-50 border border-blue-200 rounded-lg p-4 space-y-2 text-base">
            <h3 class="font-semibold text-[#0F3B89] text-lg flex items-center gap-2">
                <i class="ph ph-trash"></i> Detail Aset yang Dihapus
            </h3>

            <div class="mt-2">
                <dt class="text-gray-600">Jumlah Awal</dt>
                <dd class="font-bold text-red-800">{{ $sub->asset?->quantity }}</dd>
            </div>

            <div>
                <dt class="text-gray-600">Kondisi Awal</dt>
                <dd class="font-bold text-red-800">{{ $sub->asset?->condition }}</dd>
            </div>
        </section>
    @endif

    {{-- FOTO --}}
    @if($sub->photo)
        <section>
            <h4 class="text-gray-500 text-xs mb-2 flex items-center gap-1">
                <i class="ph ph-camera"></i> Foto Bukti Pengajuan
            </h4>
            <a href="{{ $sub->photo_url }}" target="_blank">
                <img src="{{ $sub->photo_url }}" class="rounded-lg w-full md:w-80 shadow-sm hover:shadow-lg transition">
            </a>
        </section>
    @endif

    {{-- FOOTER --}}
    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
        <a href="{{ route('admin.submissions.index') }}" 
           class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-[#0F3B89] transition">
            <i class="ph ph-arrow-left mr-2"></i> Kembali ke Daftar
        </a>

        @if($sub->status !== 'pending' && $sub->admin_note)
            <section class="flex-1">
                <h4 class="text-gray-500 text-xs mb-2 flex items-center gap-1">
                    <i class="ph ph-receipt-text"></i> Catatan PJ Aset ({{ ucfirst($sub->status) }})
                </h4>

                <div class="p-3 text-sm italic rounded border
                    @if($sub->status=='approved') bg-blue-50 border-blue-200 text-blue-800
                    @elseif($sub->status=='rejected') bg-red-50 border-red-200 text-red-800
                    @endif">
                    {{ $sub->admin_note }}
                </div>
            </section>
        @endif

        {{-- VERIFIKASI --}}
        @if($sub->status === 'pending')
            <form id="verifyForm" method="POST" action="{{ route('admin.submissions.verify', $sub->id) }}"
                  class="flex flex-col md:flex-row gap-3 md:justify-end md:items-center">
                @csrf
                <input type="hidden" id="actionInput" name="action">

                <div id="adminNoteContainer" class="hidden md:mr-4">
                    <label for="admin_note" class="text-xs font-medium text-gray-600 mb-1 block">
                        Catatan Penolakan (Wajib)
                    </label>
                    <textarea id="admin_note" name="admin_note" rows="3"
                              class="w-full p-2 border rounded-md focus:ring-red-500 focus:border-red-500"></textarea>
                </div>

                <div class="flex flex-col md:flex-row gap-3">
                    <button type="button" onclick="handleVerify('approve')"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 font-semibold shadow">
                        <i class="ph ph-check-circle mr-1"></i> Setujui
                    </button>

                    <button type="button" id="rejectButton"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 font-semibold shadow">
                        <i class="ph ph-x-circle mr-1"></i> Tolak
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('verifyForm');
    const actionInput = document.getElementById('actionInput');
    const noteContainer = document.getElementById('adminNoteContainer');
    const noteInput = document.getElementById('admin_note');
    const rejectButton = document.getElementById('rejectButton');

    // APPROVE
    window.handleVerify = function(action) {
        if(action === 'approve') {
            Swal.fire({
                title: 'Setujui Pengajuan?',
                text: "Anda yakin ingin menyetujui pengajuan ini?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#0F3B89',
                cancelButtonColor: '#d1d5db',
                confirmButtonText: '<i class="ph ph-check-circle"></i> Setujui',
                cancelButtonText: 'Batal',
                allowOutsideClick: false
            }).then((result) => {
                if(result.isConfirmed){
                    actionInput.value = 'approve';
                    noteContainer.classList.add('hidden');
                    noteInput.value = '';
                    form.submit();
                }
            });
        }
    }

    // REJECT
    rejectButton.addEventListener('click', () => {
        actionInput.value = 'reject';

        if(noteContainer.classList.contains('hidden')){
            noteContainer.classList.remove('hidden');
            noteInput.setAttribute('required','required');
            noteInput.focus();
            rejectButton.innerHTML = '<i class="ph ph-x-circle mr-1"></i> Kirim Penolakan';
            return;
        }

        if(!noteInput.value.trim()){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Catatan penolakan wajib diisi!',
                allowOutsideClick: false
            });
            return;
        }

        Swal.fire({
            title: 'Tolak Pengajuan?',
            text: "Anda yakin ingin menolak pengajuan ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#d1d5db',
            confirmButtonText: '<i class="ph ph-x-circle"></i> Tolak',
            cancelButtonText: 'Batal',
            allowOutsideClick: false
        }).then((result) => {
            if(result.isConfirmed){
                form.submit();
            }
        });

    });
});
</script>

</x-layouts.main>
