<aside 
    x-data
    :class="openSidebar ? 'w-64' : 'w-18'"
    class="hidden lg:flex flex-col min-h-screen transition-all duration-300 shadow-[4px_0_12px_rgba(0,0,0,0.25)] bg-white"
>

    {{-- HEADER --}}
    <div class="bg-white border-b flex items-center justify-center h-20 transition-all duration-300">

        {{-- Logo Besar --}}
        <img 
            x-show="openSidebar"
            x-transition.opacity
            src="{{ asset('assets/images/logo_jasamarga.png') }}"
            class="h-12 object-contain"
        >

        {{-- Logo Kecil --}}
        <img 
            x-show="!openSidebar"
            x-transition.opacity
            src="{{ asset('assets/images/logo_jasamarga_icon.png') }}"
            class="h-7 object-contain"
        >
    </div>

    <div class="flex flex-col flex-1">

        <div class="flex-1 px-3 py-5 text-white overflow-y-visible"
             style="background: linear-gradient(to bottom, #0f3b89ff, #154da6ff 40%, #005BAC);">

            <nav class="flex flex-col gap-1 pl-1">
                
                {{-- DASHBOARD --}}
                <x-sidebar.item icon="house" href="{{ route('admin.dashboard') }}" name="Dashboard" />

                {{-- ASET --}}
                <span x-show="openSidebar"
                      x-transition.opacity
                      class="px-3 text-[10px] tracking-widest text-[#FFEB8A] font-bold uppercase mt-4 mb-1">
                    Aset
                </span>

                <x-sidebar.item icon="archive-box" href="{{ route('admin.assets.index') }}" name="Data Aset" />
                <x-sidebar.item icon="files" href="{{ route('admin.submissions.index') }}" name="Pengajuan Aset" />


                {{-- SURVEI --}}
                <span x-show="openSidebar"
                      x-transition.opacity
                      class="px-3 text-[10px] tracking-widest text-[#FFEB8A] font-bold uppercase mt-4 mb-1">
                    Survei
                </span>

                <x-sidebar.item icon="clipboard-text" href="{{ route('admin.surveys.index') }}" name="Jadwal Survei" />


                {{-- PENGATURAN --}}
                <span x-show="openSidebar"
                      x-transition.opacity
                      class="px-3 text-[10px] tracking-widest text-[#FFEB8A] font-bold uppercase mt-4 mb-1">
                    Pengaturan
                </span>

                <x-sidebar.item icon="buildings" href="{{ route('admin.rooms.index') }}" name="Ruangan" />
                <x-sidebar.item icon="users-four" href="{{ route('admin.users.index') }}" name="User Unit" />
                <x-sidebar.item icon="list-dashes" href="{{ route('admin.activity.index') }}" name="Activity Log" />


                {{-- LAPORAN --}}
                <span x-show="openSidebar"
                      x-transition.opacity
                      class="px-3 text-[10px] tracking-widest text-[#FFEB8A] font-bold uppercase mt-4 mb-1">
                    Laporan
                </span>

                <x-sidebar.item icon="clipboard" href="{{ route('admin.reports.index') }}" name="Laporan" />

            </nav>
        </div>

{{-- USER BOTTOM --}}
<div class="px-4 py-4 bg-[#003873] text-white border-t border-white/10">

    {{-- Expanded --}}
    <div x-show="openSidebar"
         x-transition.opacity
         class="flex items-center justify-between">

        <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3">

            {{-- Foto Profil atau Inisial --}}
            @if(auth()->user()->profile_photo)
                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                     class="w-8 h-8 rounded-full object-cover shadow-md">
            @else
                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center font-bold">
                    {{ strtoupper(auth()->user()->name[0]) }}
                </div>
            @endif

            <div class="leading-tight">
                <div class="font-semibold text-[12px]">{{ auth()->user()->name }}</div>
                <div class="text-[10px] text-[#FFDE59]">ADMIN</div>
            </div>

        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-white/80 hover:text-white transition">
                <i class="ph ph-sign-out text-xl"></i>
            </button>
        </form>

    </div>

    {{-- Collapsed --}}
    <div x-show="!openSidebar"
         x-transition.opacity
         class="relative flex justify-center group">

        <a href="{{ route('user.profile.index') }}">
            {{-- Foto Profil atau Inisial --}}
            @if(auth()->user()->profile_photo)
                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                     class="w-10 h-10 rounded-full object-cover shadow-md mb-1">
            @else
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center font-bold mb-1">
                    {{ strtoupper(auth()->user()->name[0]) }}
                </div>
            @endif
        </a>

        <form method="POST" action="{{ route('logout') }}"
              class="absolute -right-10 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition">
            @csrf
            <button class="bg-gray-900 px-2 py-1 rounded text-xs flex items-center gap-1">
                <i class="ph ph-sign-out text-sm"></i> Logout
            </button>
        </form>

    </div>

</div>



    </div>

</aside>
