<x-layouts.main title="Activity Log">

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-9">
            <h1 class="text-xl font-semibold text-gray-800">Activity Log</h1>
        </div>
    </div>

{{-- FILTER PREMIUM 1 LINE --}}
<div class="bg-white p-5 rounded-xl border shadow-sm">
    <form method="GET" class="flex items-end gap-4">

        {{-- MODULE FULL WIDTH --}}
        <div class="flex-1">
            <label class="text-[11px] font-semibold text-gray-600 tracking-wide uppercase">
                Module
            </label>
            <select name="module"
                    class="w-full px-4 py-2.5 border rounded-lg bg-gray-50 text-sm text-gray-700 
                           focus:ring-2 focus:ring-[#0F3B89] focus:bg-white transition">
                <option value="">Semua Module</option>
                <option value="Aset" @selected(request('module')=='Aset')>Aset</option>
                <option value="Pengajuan" @selected(request('module')=='Pengajuan')>Pengajuan</option>
                <option value="Survei" @selected(request('module')=='Survei')>Survei</option>
                <option value="User" @selected(request('module')=='User')>User</option>
            </select>
        </div>

        {{-- BUTTONS SEBELAH KANAN --}}
        <div class="flex items-center gap-2">

            {{-- TAMPILKAN --}}
            <button
                class="px-5 py-2.5 bg-[#0F3B89] text-white rounded-lg text-sm shadow-sm hover:bg-[#0c2f6b] transition">
                Tampilkan
            </button>

            {{-- RESET hanya muncul jika ada filter --}}
            @if(request('module'))
                <a href="{{ route('admin.activity.index') }}"
                   class="px-5 py-2.5 bg-gray-100 border rounded-lg text-gray-700 text-sm hover:bg-gray-200 transition">
                    Reset
                </a>
            @endif
        </div>

    </form>
</div>


    {{-- TABLE --}}
    <div class="bg-white p-5 rounded-xl border shadow-sm">

        <table class="w-full text-sm">
            <thead>
            <tr class="bg-[#F4F6FA] text-[12px] text-gray-600 uppercase text-center">
                <th class="p-3">Waktu</th>
                <th class="p-3">User</th>
                <th class="p-3">Aksi</th>
                <th class="p-3">Module</th>
                <th class="p-3">Deskripsi</th>
                <th class="p-3">IP</th>
            </tr>
            </thead>

            <tbody>
            @forelse($logs as $log)
                <tr class="border-b hover:bg-gray-50 transition">

                    <td class="p-3 text-center text-gray-700">
                        {{ $log->created_at->format('d M Y H:i') }}
                    </td>

                    <td class="p-3 text-center text-gray-700">
                        {{ $log->user->name ?? '-' }}
                    </td>

                    <td class="p-3 text-center font-semibold text-gray-800">
                        {{ $log->action }}
                    </td>

                    {{-- MODULE BADGE --}}
                    <td class="p-3 text-center">
                        <span class="px-2 py-1 text-xs rounded-lg bg-blue-100 text-blue-700 font-medium">
                            {{ $log->module ?? '-' }}
                        </span>
                    </td>

                    {{-- DESCRIPTION --}}
                    <td class="p-3 text-center text-gray-700">
                        {{ $log->description ?? '-' }}
                    </td>

                    <td class="p-3 text-center text-gray-600 text-xs">
                        {{ $log->ip }}
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-500">
                        Tidak ada aktivitas.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>

</x-layouts.main>
