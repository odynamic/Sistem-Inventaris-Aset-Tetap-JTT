<x-layouts.main title="Ajukan Pengajuan Aset">

<div class="max-w-3xl mx-auto space-y-6">
{{-- HEADER PREMIUM TANPA BACKGROUND --}}
<div class="flex items-center gap-4 py-4">
    {{-- Back Button --}}
    <a href="{{ route('user.submissions.index') }}" 
       class="text-gray-600 hover:text-[#0F3B89] transition-colors duration-200">
        <i class="ph ph-arrow-left text-2xl"></i>
    </a>

    {{-- Logo Jasa Marga --}}
    <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-10 w-10 object-contain">

    {{-- Judul dan Tanggal --}}
    <div class="flex flex-col">
        <h1 class="text-2xl font-bold text-gray-800">Lakukan Pengajuan</h1>
        <div class="flex items-center gap-2 text-sm text-gray-500 mt-1">
            <i class="ph ph-clock text-gray-400"></i>
            {{ now()->format('d M Y H:i') }}
        </div>
    </div>
</div>


    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="p-3 rounded bg-red-50 text-red-800 border border-red-200">
            {{ session('error') }}
        </div>
    @endif
@if ($errors->any())
    <div class="p-3 mb-4 bg-red-50 text-red-800 border border-red-300 rounded">
        <strong>Pengajuan gagal dikirim:</strong>
        <ul class="mt-2 list-disc ms-6 text-sm">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

    {{-- FORM UTAMA --}}
    <div class="bg-white p-6 rounded-xl shadow border border-gray-200">
        <form action="{{ route('user.submissions.store') }}" 
              method="POST" enctype="multipart/form-data" id="submitForm">
            @csrf

            {{-- TIPE PENGAJUAN --}}
            <div class="mb-4">
                <label class="text-sm font-medium text-gray-700">Tipe Pengajuan</label>
                <select name="type" id="typeSelect"
                    class="w-full mt-1 px-3 py-2 border rounded-lg"
                    required>
                    <option value="">Pilih</option>
                    <option value="penambahan">Penambahan</option>
                    <option value="perubahan">Perubahan</option>
                    <option value="penghapusan">Penghapusan</option>
                </select>
            </div>


            {{-- FORM PENAMBAHAN --}}
            <div id="formAdd" class="hidden border-t pt-4 mt-4">

                <h2 class="text-sm font-semibold text-gray-700 mb-3">Detail Penambahan</h2>

                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm text-gray-700">Ruangan</label>
                        <select name="add_room_id" class="w-full mt-1 px-3 py-2 border rounded-lg">
                            <option value="">Pilih</option>
                            @foreach($rooms as $r)
                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm text-gray-700">Nama Aset</label>
                        <input type="text" name="add_name" 
                               class="w-full mt-1 px-3 py-2 border rounded-lg">
                    </div>

                    <div>
                        <label class="text-sm text-gray-700">Jumlah</label>
                        <input type="number" name="add_quantity" value="1"
                               class="w-full mt-1 px-3 py-2 border rounded-lg">
                    </div>

                    <div>
                        <label class="text-sm text-gray-700">Satuan</label>
                        <input type="text" name="add_unit" 
                               class="w-full mt-1 px-3 py-2 border rounded-lg">
                    </div>

                    <div>
                        <label class="text-sm text-gray-700">Kondisi</label>
                        <select name="add_condition" class="w-full mt-1 px-3 py-2 border rounded-lg">
                            <option value="Baik">Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm text-gray-700">Tahun Perolehan</label>
                        <input type="number" name="add_acquired_year" placeholder="2023"
                               class="w-full mt-1 px-3 py-2 border rounded-lg">
                    </div>

                </div>

            </div>


            {{-- FORM PERUBAHAN / PENGHAPUSAN --}}
            <div id="formModify" class="hidden border-t pt-4 mt-4">

                <h2 class="text-sm font-semibold text-gray-700 mb-3">Pilih Aset</h2>

                <div class="grid grid-cols-2 gap-4">

                    {{-- RUANG --}}
                    <div>
                        <label class="text-sm text-gray-700">Ruangan</label>
                        <select name="room_id" id="roomSelect"
                                 class="w-full mt-1 px-3 py-2 border rounded-lg">
                            <option value="">Pilih</option>
                            @foreach($rooms as $r)
                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- ASET --}}
                    <div>
                        <label class="text-sm text-gray-700">Aset</label>
                        <select name="asset_id" id="assetSelect"
                                 class="w-full mt-1 px-3 py-2 border rounded-lg">
                            <option value="">Pilih aset…</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm text-gray-700">Jumlah Lama</label>
                        <input id="oldQty" readonly 
                               class="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-100">
                    </div>

                    <div>
                        <label class="text-sm text-gray-700">Kondisi Lama</label>
                        <input id="oldCond" readonly 
                               class="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-100">
                    </div>

                </div>


                {{-- KHUSUS PERUBAHAN --}}
                <div id="formChange" class="hidden mt-4">
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">Perubahan</h3>

                    <div class="grid grid-cols-2 gap-4">

                        <div>
                            <label class="text-sm text-gray-700">Jumlah Baru</label>
                            <input type="number" name="new_quantity"
                                   class="w-full mt-1 px-3 py-2 border rounded-lg">
                        </div>

                        <div>
                            <label class="text-sm text-gray-700">Kondisi Baru</label>
                            <select name="new_condition" 
                                     class="w-full mt-1 px-3 py-2 border rounded-lg">
                                <option value="">Pilih</option>
                                <option>Baik</option>
                                <option>Rusak Ringan</option>
                                <option>Rusak Berat</option>
                            </select>
                        </div>

                        

                    </div>
                </div>

                {{-- KHUSUS PENGHAPUSAN --}}
                <div id="formDelete" class="hidden">
                    </div>

                {{-- 🔥 PERBAIKAN: Input DESKRIPSI/ALASAN (Ditempatkan sekali di sini) --}}
                <div class="mt-4">
                    <label class="text-sm text-gray-700">Alasan Pengajuan</label>
                    <textarea name="description"
                              class="w-full mt-1 px-3 py-2 border rounded-lg"></textarea>
                </div>

                

            {{-- FOTO --}}
            <div class="mt-4">
                <label class="text-sm text-gray-700">Bukti Dokumentasi (Opsional)</label>
                <input type="file" name="photo" 
                        accept="image/*" class="w-full mt-1">
            </div>

            </div>

            {{-- BUTTON --}}
            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('user.submissions.index') }}"
                    class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                    Batal
                </a>

                <button type="submit"
                         class="px-5 py-2.5 rounded-lg text-white"
                         style="background-color:#0F3B89;">
                    Kirim Pengajuan
                </button>
            </div>

        </form>
    </div>

</div>


{{-- JS --}}
<script>
document.getElementById('typeSelect').addEventListener('change', function(){
    let t = this.value;

    const add   = document.getElementById('formAdd');
    const mod   = document.getElementById('formModify');
    const chg   = document.getElementById('formChange');
    const del   = document.getElementById('formDelete');

    // Sembunyikan semua dulu
    add.classList.add('hidden');
    mod.classList.add('hidden');
    chg.classList.add('hidden');
    del.classList.add('hidden');

    if(t === 'penambahan'){
        add.classList.remove('hidden');
    } 
    else if(t === 'perubahan' || t === 'penghapusan') {
        mod.classList.remove('hidden');

        if(t === 'perubahan') chg.classList.remove('hidden');
        if(t === 'penghapusan') del.classList.remove('hidden');
    }
});

// AJAX untuk memuat Aset berdasarkan Ruangan yang dipilih
document.getElementById('roomSelect').addEventListener('change', async function(){
    let rid = this.value;
    if(!rid) return;

    // Asumsi route /user/assets/by-room/{rid} sudah ada
    let res = await fetch(`/user/assets/by-room/${rid}`);
    let data = await res.json();

    let sel = document.getElementById('assetSelect');
    sel.innerHTML = `<option value="">Pilih aset…</option>` +
        data.map(a => `<option value="${a.id}">${a.code} — ${a.name} (${a.quantity})</option>`).join('');
});

// AJAX untuk menampilkan detail Aset yang dipilih
document.getElementById('assetSelect').addEventListener('change', async function(){
    if(!this.value) return;

    // Asumsi route /user/assets/detail/{id} sudah ada
    let res = await fetch(`/user/assets/detail/${this.value}`);
    let a = await res.json();

    document.getElementById('oldQty').value  = a.quantity ?? '-';
    document.getElementById('oldCond').value = a.condition ?? '-';
});
</script>

</x-layouts.main>