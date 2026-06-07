<x-layouts.main title="Dashboard User">

{{-- ========================= --}}
{{-- GREETING CARD --}}
{{-- ========================= --}}
<x-card class="mb-20 shadow-lg border-0 bg-gradient-to-br from-[#E3F2FD] via-[#BBDEFB] to-[#90CAF9] px-10 py-8 rounded-2xl relative overflow-hidden">
        <div class="flex items-start gap-6 w-full relative z-10">
        <div class="bg-white/50 backdrop-blur-sm text-[#0F3B89] p-3 rounded-xl shadow-md">
            <i class="ph ph-hand-waving text-2xl"></i>
        </div>
        <div class="w-full">
            <h2 class="text-2xl font-bold leading-tight w-full">
                Selamat datang kembali, {{ auth()->user()->name }}!
            </h2>
            <p class="text-gray-500 text-[16px] max-w-full mt-2 leading-relaxed">
                Anda dapat memantau aset milik unit kerja, mengajukan penambahan, perubahan, dan penghapusan aset, serta melakukan survei. Gunakan dashboard ini untuk memastikan seluruh proses berjalan tertib, transparan, dan tepat waktu.
            </p>
        </div>
    </div>
</x-card>

{{-- ========================= --}}
{{-- 4 COUNTER CARD --}}
{{-- ========================= --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6 mb-6">

    {{-- Total Aset --}}
    <x-card class="p-4">
        <div class="flex items-center gap-4">
            <div class="bg-white/60 backdrop-blur-sm text-[#0F3B89] p-3 rounded-xl shadow-md border border-[#0F3B89]/25">
                <i class="ph ph-package text-2xl"></i>
            </div>
            <div>
                <div class="text-2xl font-bold">{{ number_format($totalAssets ?? 0) }}</div>
                <div class="text-xs text-gray-500">Total Aset</div>
            </div>
        </div>
    </x-card>

    {{-- Pengajuan 30 hari --}}
    <x-card class="p-4">
        <div class="flex items-center gap-4">
            <div class="bg-white/60 backdrop-blur-sm text-[#0F3B89] p-3 rounded-xl shadow-md border border-[#0F3B89]/25">
                <i class="ph ph-clipboard-text text-2xl"></i>
            </div>
            <div>
                <div class="text-2xl font-bold">{{ number_format($totalSubmissions ?? 0) }}</div>
                <div class="text-xs text-gray-500">Pengajuan (30 hari)</div>
            </div>
        </div>
    </x-card>

    {{-- Survei Aktif --}}
    <x-card class="p-4">
        <div class="flex items-center gap-4">
            <div class="bg-white/60 backdrop-blur-sm text-[#0F3B89] p-3 rounded-xl shadow-md border border-[#0F3B89]/25">
                <i class="ph ph-calendar-check text-2xl"></i>
            </div>
            <div>
                <div class="text-2xl font-bold">{{ number_format($surveyAktif ?? 0) }}</div>
                <div class="text-xs text-gray-500">Survei Aktif</div>
            </div>
        </div>
    </x-card>

    {{-- Total Ruangan --}}
    <x-card>
        <div class="flex items-center gap-4">
            <div class="bg-white/60 backdrop-blur-sm text-[#0F3B89] p-3 rounded-xl shadow-md border border-[#0F3B89]/25">
                <i class="ph ph-building-office text-2xl"></i>
            </div>
            <div>
                <div class="text-2xl font-bold">{{ number_format($totalRooms) }}</div>
                <div class="text-xs text-gray-600">Total Ruangan</div>
            </div>
        </div>
    </x-card>


</div>

{{-- ========================= --}}
{{-- 3 CHART --}}
{{-- ========================= --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    {{-- Status Aset --}}
    <x-card class="min-h-[380px] p-4 border border-[#0F3B89] rounded-xl shadow-sm">
        <div class="text-sm font-semibold text-gray-700 mb-3">Status Aset</div>
        <div id="chart-status-aset" class="w-full h-[300px]"></div>
    </x-card>

    {{-- Status Pengajuan --}}
    <x-card class="min-h-[380px] p-4 border border-[#0F3B89] rounded-xl shadow-sm">
        <div class="text-sm font-semibold text-gray-700 mb-3">Status Pengajuan</div>
        <div id="chart-status-pengajuan" class="w-full h-[300px]"></div>
    </x-card>

    {{-- Status Survei --}}
    <x-card class="min-h-[380px] p-4 border border-[#0F3B89] rounded-xl shadow-sm">
        <div class="text-sm font-semibold text-gray-700 mb-3">Status Survei</div>
        <div id="chart-status-survei" class="w-full h-[300px]"></div>
    </x-card>

</div>


{{-- ========================= --}}
{{-- ACTIVITY LOG --}}
{{-- ========================= --}}
<div class="mt-3 mb-10">
    <x-card class="rounded-xl shadow-md p-4 border border-[#0F3B89]">
        <div class="text-[14px] font-semibold text-gray-800 mb-3">
            Aktivitas Terbaru
        </div>

        @php
            $latest = collect($chartSubmissionStatus ?? [])->take(1);
        @endphp

        @if(isset($recentActivities) && count($recentActivities))
            @foreach($recentActivities as $log)
                <div class="flex items-start gap-1 border-l-4 border-[#0F3B89] pl-3 py-2 mb-1 rounded-sm hover:bg-gray-50 transition">
                    <i class="ph ph-caret-right text-md text-[#0F3B89] mt-0.5"></i>
                    <div class="leading-tight">
                        <div class="text-[13px] text-gray-800 font-medium">
                            {{ $log->description ?? '-' }}
                        </div>
                        <div class="text-[10px] text-gray-500">
                            {{ optional($log->created_at)->diffForHumans() ?? '' }}
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-xs text-gray-400">Belum ada aktivitas.</div>
        @endif
    </x-card>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {

    // =====================================================
    // 1) Status Aset → DONUT
    // =====================================================
    new ApexCharts(document.querySelector("#chart-status-aset"), {
        chart: { type: "donut", height: 300 },
        labels: ["Baik", "Rusak", "Hilang"],
        series: [{{ $assetsBaikUser }}, {{ $assetsRusakUser }}, {{ $assetsHilangUser }}],
        colors: ["#154DA6", "#FFC20E", "#D93030"],
        legend: { position: "bottom", fontSize: "12px" }
    }).render();



    // =====================================================
    // 2) Status Pengajuan → LINE CHART (BERVARIASI)
    // =====================================================
    new ApexCharts(document.querySelector("#chart-status-pengajuan"), {
        chart: {
            type: "line",
            height: 300,
            zoom: { enabled: false },
            toolbar: { show: false },
        },
        stroke: { curve: "smooth", width: 3 },
        xaxis: {
            categories: @json(array_keys($chartSubmissionStatus)),
            labels: { style: { fontSize: "11px" } }
        },
        series: [
            {
                name: "Pengajuan",
                data: @json(array_values($chartSubmissionStatus)),
            }
        ],
        markers: { size: 5 },
        colors: ["#154DA6"],
        yaxis: { labels: { style: { fontSize: "11px" } } }
    }).render();



    // =====================================================
    // 3) Status Survei → BAR CHART
    // =====================================================
    new ApexCharts(document.querySelector("#chart-status-survei"), {
        chart: { type: "bar", height: 300 },
        plotOptions: { bar: { borderRadius: 6, columnWidth: "45%" } },
        series: [{
            name: "Survei",
            data: [
                {{ $chartSurveyStatus['dijadwalkan'] }},
                {{ $chartSurveyStatus['menunggu_validasi'] }},
                {{ $chartSurveyStatus['selesai'] }},
            ]
        }],
        xaxis: {
            categories: ["Dijadwalkan", "Menunggu Validasi", "Selesai"],
            labels: { style: { fontSize: "11px" } }
        },
        colors: ["#0F3B89"],
        dataLabels: { enabled: false },
        yaxis: { labels: { style: { fontSize: "11px" } } }
    }).render();

});
</script>


</x-layouts.main>
