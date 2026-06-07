<header class="w-full bg-white border-b border-gray-200 px-6 h-20 flex items-center justify-between shadow-sm">

    <!-- LEFT -->
    <div class="flex items-center gap-4">
        <button 
            @click="openSidebar = !openSidebar"
            class="text-gray-600 hover:text-gray-800"
        >
            <i class="ph ph-list text-3xl"></i>
        </button>

        <div class="flex flex-col leading-tight">
            <h2 class="text-[20px] font-semibold text-gray-800">
                {{ $title ?? 'Dashboard' }}
            </h2>
            <span class="text-[11px] text-gray-500 tracking-wide">
                Inventaris Aset Tetap Palikanci
            </span>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-1">

        <!-- NOTIFICATION -->
        <div x-data="{ openNotif: false }" class="relative">
            <button 
                @click="openNotif = !openNotif"
                class="relative text-gray-600 hover:text-gray-800 cursor-pointer"
            >
                <i class="ph ph-bell-simple text-[22px]"></i>

                @php
                    $unread = auth()->user()->unreadNotifications()->count();
                @endphp

                @if ($unread > 0)
                    <span class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] px-1.5 rounded-full">
                        {{ $unread }}
                    </span>
                @endif
            </button>

            <!-- DROPDOWN -->
            <div 
                x-show="openNotif"
                @click.away="openNotif = false"
                x-transition.opacity.scale.80
                class="absolute right-[-12px] top-10 w-80 bg-white shadow-lg rounded-xl border border-gray-200 z-50 overflow-hidden"
            >
                <div class="absolute right-6 -top-2 w-0 h-0 border-l-8 border-r-8 border-b-8 border-transparent border-b-white"></div>

                {{-- HEADER WITH MARK ALL --}}
                <div class="px-4 py-3 bg-gray-50 border-b flex justify-between items-center">
                    <h4 class="text-sm font-semibold text-gray-700">Notifikasi</h4>
                    @if($unread > 0)
                        <form action="{{ route('notifications.markAllRead') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="text-xs text-blue-600 hover:underline">
                                Tandai semua terbaca
                            </button>
                        </form>
                    @endif
                </div>

                {{-- LIST NOTIFICATIONS --}}
                <div class="max-h-80 overflow-y-auto">
                    @forelse (auth()->user()->notifications as $notif)
                        <form id="notifForm{{ $notif->id }}" action="{{ route('notifications.read', $notif->id) }}" method="POST">
                            @csrf
                            <button type="button"
                                    onclick="document.getElementById('notifForm{{ $notif->id }}').submit();"
                                    class="w-full text-left block px-4 py-3 hover:bg-gray-50 transition border-b">
                                <div class="flex items-start gap-3">
                                    <i class="ph ph-bell text-gray-500 text-lg mt-1"></i>

                                    <div class="flex-1">
                                        <p class="text-sm {{ $notif->read_at ? 'text-gray-600' : 'font-semibold text-gray-800' }}">
                                            {{ $notif->data['message'] ?? 'Notifikasi' }}
                                        </p>

                                        <span class="text-[11px] text-gray-400">
                                            {{ $notif->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </button>
                        </form>
                    @empty
                        <div class="p-6 text-center text-gray-500 text-sm">
                            <i class="ph ph-bell-simple text-3xl mb-2 block text-gray-400"></i>
                            Tidak ada notifikasi
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

@php
    $profileRoute = auth()->user()->role === 'admin' ? 'admin.profile.index' : 'user.profile.index';
@endphp

<a href="{{ route($profileRoute) }}"
    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 cursor-pointer transition">

    @if(auth()->user()->profile_photo)
        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
            class="w-9 h-9 rounded-full object-cover shadow-md">
    @else
        <div class="w-9 h-9 bg-gray-300 rounded-full flex items-center justify-center font-bold text-sm">
            {{ strtoupper(auth()->user()->name[0]) }}
        </div>
    @endif

    <div class="text-sm font-medium text-gray-700">
        {{ auth()->user()->name }}
    </div>

</a>
    </div>

</header>
