@props(['icon', 'name', 'href'])

@php
    $isActive = request()->url() === $href;
@endphp

<a href="{{ $href }}"
   class="relative group flex items-center rounded-lg transition-all duration-150
          {{ $isActive ? 'bg-[#0F2A56] border-l-4 border-[#FFC20E]' : 'hover:bg-[#113165]' }}"
   :class="openSidebar ? 'px-3 py-2 gap-2 justify-start' : 'px-0 py-2 justify-center'">

    {{-- ICON --}}
    <i class="ph ph-{{ $icon }} text-[18px] opacity-90"></i>

    {{-- TEXT --}}
    <span x-show="openSidebar"
          class="font-medium text-[13px] whitespace-nowrap">
        {{ $name }}
    </span>

    {{-- TOOLTIP saat collapse --}}
    <div x-show="!openSidebar"
         class="absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded shadow-lg opacity-0
                group-hover:opacity-100 transition">
        {{ $name }}
    </div>

</a>
