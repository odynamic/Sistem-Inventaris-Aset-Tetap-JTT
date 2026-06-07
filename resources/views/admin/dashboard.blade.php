<x-layouts.main title="Dashboard">

{{-- ========================= --}}
{{-- GREETING ENTERPRISE --}}
{{-- ========================= --}}
<x-card class="mb-20 shadow-lg border-0 bg-gradient-to-br from-[#E3F2FD] via-[#BBDEFB] to-[#90CAF9] px-10 py-8 rounded-2xl relative overflow-hidden">
        <div class="flex items-start gap-8 w-full relative z-10">
        <div class="bg-white/50 backdrop-blur-sm text-[#0F3B89] p-3 rounded-xl shadow-md">
            <i class="ph ph-hand-waving text-3xl"></i>
        </div>
        <div class="w-full">
            <h2 class="text-2xl font-bold leading-tight w-full">
    Selamat datang kembali, {{ auth()->user()->name }}!
</h2>

            <p class="text-gray-500 text-[16px] max-w-full mt-2 leading-relaxed">
                Anda memiliki kendali penuh untuk mengelola aset, menyetujui pengajuan, memvalidasi survei, dan memonitor setiap aktivitas pengguna. Gunakan dashboard ini untuk memastikan seluruh proses berjalan tertib, transparan, dan tepat waktu.
            </p>
        </div>
    </div>
</x-card>
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6 mb-6">

    {{-- Total Aset --}}
    <x-card>
        <div class="flex items-center gap-4">

            <div class="bg-white/50 backdrop-blur-sm text-[#0F3B89] p-3 rounded-xl shadow-md">
                <i class="ph ph-package text-2xl"></i>
            </div>

            <div>
                <div class="text-2xl font-bold">{{ number_format($totalAssets ?? 0) }}</div>
                <div class="text-xs text-gray-500">Total Aset</div>
            </div>
        </div>
    </x-card>

    {{-- Total Pengajuan (30 hari) --}}
    <x-card>
        <div class="flex items-center gap-4">

            <div class="bg-white/50 backdrop-blur-sm text-[#0F3B89] p-3 rounded-xl shadow-md">
                <i class="ph ph-clipboard-text text-2xl"></i>
            </div>

            <div>
                <div class="text-2xl font-bold">{{ number_format($totalSubmissions ?? 0) }}</div>
                <div class="text-xs text-gray-500">Pengajuan (30 hari)</div>
                <div class="text-xs text-gray-400 mt-1">Pending: {{ number_format($pengajuanPending ?? 0) }}</div>
            </div>
        </div>
    </x-card>

    {{-- Total Survei --}}
    <x-card>
        <div class="flex items-center gap-4">

            <div class="bg-white/50 backdrop-blur-sm text-[#0F3B89] p-3 rounded-xl shadow-md">
                <i class="ph ph-chart-pie-slice text-2xl"></i>
            </div>

            <div>
                <div class="text-2xl font-bold">{{ number_format($totalSurveys ?? 0) }}</div>
                <div class="text-xs text-gray-500">Survei (30 hari)</div>
                <div class="text-xs text-gray-400 mt-1">Dijadwalkan: {{ number_format($surveyScheduled ?? 0) }}</div>
            </div>
        </div>
    </x-card>

    {{-- Total Ruangan --}}
    <x-card>
        <div class="flex items-center gap-4">

            <div class="bg-white/50 backdrop-blur-sm text-[#0F3B89] p-3 rounded-xl shadow-md">
                <i class="ph ph-buildings text-2xl"></i>
            </div>

            <div>
                <div class="text-2xl font-bold">{{ number_format($totalRooms ?? 0) }}</div>
                <div class="text-xs text-gray-500">Total Ruangan</div>
            </div>
        </div>
    </x-card>

</div>


{{-- ========================= --}}
{{-- 4 CHART CARDS --}}
{{-- ========================= --}}
<div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-6 mb-6">

    <x-card class="min-h-[420px] flex flex-col border border-[#0f3b89] shadow-sm rounded-xl">
        <div class="text-sm font-semibold text-gray-600 mb-3">Status Aset</div>
        <div class="flex-1 flex items-center justify-center">
            <div id="chart-status" class="w-full h-[320px]"></div>
        </div>
    </x-card>

    <x-card class="min-h-[420px] flex flex-col border border-[#0f3b89] shadow-sm rounded-xl">
        <div class="text-sm font-semibold text-gray-600 mb-3">Aset per Unit Kerja</div>
        <div id="chart-unit" class="w-full h-[320px]"></div>
    </x-card>

    <x-card class="min-h-[420px] flex flex-col border border-[#0f3b89] shadow-sm rounded-xl">
        <div class="text-sm font-semibold text-gray-600 mb-3">Pengajuan (12 bulan terakhir)</div>
        <div id="chart-submissions" class="w-full h-[320px]"></div>
    </x-card>

    <x-card class="min-h-[420px] flex flex-col border border-[#0f3b89] shadow-sm rounded-xl">
        <div class="text-sm font-semibold text-gray-600 mb-3">Survei (30 hari terakhir)</div>
        <div class="flex-1 flex items-center justify-center">
            <div id="chart-survey-status" class="w-full h-[320px]"></div>
        </div>
    </x-card>

</div>



{{-- ========================= --}}
{{-- ACTIVITY LOG --}}
{{-- ========================= --}}
<div class="mt-3 mb-4">
    <x-card class="rounded-xl shadow-md p-3 border border-[#0f3b89]">
        <div class="text-[14px] font-semibold text-gray-800 mb-3">
            Aktivitas Terbaru
        </div>

        @php
            $latestLogs = collect($recentActivities ?? [])->sortByDesc('created_at')->take(1);
        @endphp

        <div class="space-y-1.5">
            @forelse ($latestLogs as $log)
                @if(is_object($log))
                    <div class="flex items-start gap-0.5 border-l-4 border-[#0F3B89] pl-2.5 py-1.5 rounded-sm hover:bg-gray-50 transition">
                        <i class="ph ph-caret-right text-sm text-[#0F3B89] mt-0.5"></i>

                        <div class="flex-1 leading-tight">
                            <div class="text-[12px] text-gray-800 font-medium">
                                {{ $log->description ?? '-' }}
                            </div>
                            <div class="text-[9px] text-gray-500">
                                {{ optional($log->created_at)->diffForHumans() ?? '' }}
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="text-xs text-gray-400">Belum ada aktivitas.</div>
            @endforelse
        </div>
    </x-card>
</div>



{{-- ========================= --}}
{{-- CHART SCRIPTS --}}
{{-- ========================= --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // Donut - Status Aset
    new ApexCharts(document.querySelector("#chart-status"), {
        chart: { type: 'donut', height: 350 },
        labels: ["Baik","Rusak","Hilang"],
        series: [ {{ $assetsBaik ?? 0 }}, {{ $assetsRusak ?? 0 }}, {{ $assetsHilang ?? 0 }} ],
        colors: ["#154DA6", "#FFC20E", "#D93030"],
        legend: { position: 'bottom', fontSize: '12px' },
        dataLabels: { enabled: true }
    }).render();

    // Bar - Aset per Unit
    new ApexCharts(document.querySelector("#chart-unit"), {
        chart: { type: 'bar', height: 320, toolbar: { show: false }},
        series: [{ name: 'Jumlah Aset', data: @json($asetPerUnit->pluck('total') ?? []) }],
        xaxis: { categories: @json($asetPerUnit->pluck('name') ?? []) },
        colors: ['#154DA6'],
        dataLabels: { enabled: false },
        plotOptions: { bar: { borderRadius: 4, columnWidth: '60%' }}
    }).render();

    // Area - Pengajuan 12 bulan terakhir
    new ApexCharts(document.querySelector("#chart-submissions"), {
        chart: { type: 'area', height: 320, toolbar: { show: false }},
        series: [{ name: 'Pengajuan', data: @json($submissionsSeries ?? []) }],
        xaxis: { categories: @json($months ?? []) },
        stroke: { curve: 'smooth', width: 2 },
        fill: { type: 'gradient', gradient: { opacityFrom: 0.5, opacityTo: 0.1 }},
        colors: ['#154DA6'],
        dataLabels: { enabled: false }
    }).render();

    // Donut - Survey Status
    new ApexCharts(document.querySelector("#chart-survey-status"), {
        chart: { type: 'donut', height: 350 },
        labels: @json(array_keys($chartSurveyStatus ?? [])),
        series: @json(array_values($chartSurveyStatus ?? [])),
        colors: ["#154DA6", "#00A651", "#FFC20E", "#D93030"],
        legend: { position: 'bottom', fontSize: '12px' },
        dataLabels: { enabled: true },
    }).render();

});
</script>

</x-layouts.main>
