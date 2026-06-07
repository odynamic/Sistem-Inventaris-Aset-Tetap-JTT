<x-layouts.main title="Laporan">

    {{-- HEADER --}}
    <div class="flex items-center gap-3 mb-6">
        <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-9" alt="">
        <h1 class="text-xl font-semibold text-gray-800 tracking-wide">Laporan Sistem</h1>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">

        <p class="text-sm text-gray-600 mb-6">
            Pilih jenis laporan yang ingin Anda lihat atau unduh.
        </p>

        {{-- GRID PILIHAN LAPORAN --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- LAPORAN ASET --}}
            <a href="{{ route('admin.reports.assets') }}"
               class="group p-5 rounded-xl border border-gray-200 shadow-sm bg-white
                      hover:bg-[#0F3B89] hover:text-white transition cursor-pointer">

                <div class="flex items-center gap-4">
                    
                    {{-- ICON --}}
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center
                                bg-[#0F3B89]/10 group-hover:bg-white/20 transition">
                        <i class="ph ph-archive text-2xl text-[#0F3B89] group-hover:text-white transition"></i>
                    </div>

                    <div class="leading-tight">
                        <h3 class="font-semibold text-gray-800 group-hover:text-white transition">
                            Laporan Aset
                        </h3>
                        <p class="text-xs text-gray-500 group-hover:text-white/80 transition">
                            Inventaris aset berdasarkan unit dan penempatan ruangan.
                        </p>
                    </div>
                </div>
            </a>

            {{-- LAPORAN SURVEI --}}
            <a href="{{ route('admin.reports.surveys') }}"
               class="group p-5 rounded-xl border border-gray-200 shadow-sm bg-white
                      hover:bg-[#0F3B89] hover:text-white transition cursor-pointer">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-xl flex items-center justify-center
                                bg-[#0F3B89]/10 group-hover:bg-white/20 transition">
                        <i class="ph ph-clipboard-text text-2xl text-[#0F3B89] group-hover:text-white transition"></i>
                    </div>

                    <div class="leading-tight">
                        <h3 class="font-semibold text-gray-800 group-hover:text-white transition">
                            Laporan Survei
                        </h3>
                        <p class="text-xs text-gray-500 group-hover:text-white/80 transition">
                            Ringkasan dan data hasil pelaksanaan survei.
                        </p>
                    </div>
                </div>
            </a>

            {{-- LAPORAN PENGAJUAN --}}
            <a href="{{ route('admin.reports.submissions') }}"
               class="group p-5 rounded-xl border border-gray-200 shadow-sm bg-white
                      hover:bg-[#0F3B89] hover:text-white transition cursor-pointer">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-xl flex items-center justify-center
                                bg-[#0F3B89]/10 group-hover:bg-white/20 transition">
                        <i class="ph ph-files text-2xl text-[#0F3B89] group-hover:text-white transition"></i>
                    </div>

                    <div class="leading-tight">
                        <h3 class="font-semibold text-gray-800 group-hover:text-white transition">
                            Laporan Pengajuan
                        </h3>
                        <p class="text-xs text-gray-500 group-hover:text-white/80 transition">
                            Rekapitulasi pengajuan aset beserta tindak lanjut dan hasilnya.
                        </p>
                    </div>
                </div>
            </a>

        </div>

    </div>

</x-layouts.main>
