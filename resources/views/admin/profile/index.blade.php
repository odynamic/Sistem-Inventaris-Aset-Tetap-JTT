{{-- 🌟 Ganti LAYOUT di sini 🌟 --}}
<x-layouts.main title="Profil Pengguna">

@php
    $edit = request('edit') === 'true';
@endphp

{{-- KONTEN UTAMA --}}
<div class="max-w-2xl mx-auto space-y-8 py-8"> 

    {{-- HEADER --}}
    <div class="flex items-center gap-4 mb-2">
        <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-10">
        {{-- Ganti Judul ke "Profil Admin" --}}
        <h1 class="text-2xl font-semibold text-gray-900">Profil Admin</h1> 
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg shadow-sm">
            {{ session('success') }}
        </div>
    @endif
    
    {{-- CARD PROFIL --}}
    {{-- 🛑 KELAS SHADOW ASLI USER: shadow-md, border-gray-100 --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-8"> 

        {{-- FOTO & NAMA --}}
        <div class="flex flex-col items-center mb-8">

            <div class="relative">
                <img 
                    src="{{ $user->profile_photo ? asset('storage/'.$user->profile_photo) : asset('assets/images/default_profile.png') }}"
                    {{-- 🛑 KELAS RING ASLI USER: ring-4 ring-white --}}
                    class="w-32 h-32 rounded-full object-cover shadow-md ring-4 ring-white" 
                >

                @if($edit)
                    {{-- ✅ FORM FOTO (Rute Admin) --}}
                    <form id="photoForm" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="action_type" value="update_photo">
                        <input type="file" id="photoInput" name="photo"
                                class="hidden" accept="image/*"
                                onchange="document.getElementById('photoForm').submit()">
                    </form>

                    <button
                        onclick="document.getElementById('photoInput').click()"
                        class="absolute bottom-1 right-1 bg-blue-600 hover:bg-blue-700 transition text-white p-2 rounded-full shadow-md"
                    >
                        <i class="ph ph-camera text-lg"></i>
                    </button>
                @endif
            </div>

            <h2 class="mt-4 text-xl font-semibold text-gray-900">{{ $user->name }}</h2>
            <p class="text-gray-500 text-sm">{{ $user->email }}</p>
            {{-- ❌ HAPUS SPAN ROLE ADMIN yang tidak ada di view user --}}
        </div>

        {{-- FORM UPDATE DATA PRIBADI --}}
        {{-- ✅ FORM DATA PRIBADI (Rute Admin) --}}
        <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="action_type" value="update_details">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- NPP --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">NPP</label>
                    <input type="text" name="npp"
                        value="{{ old('npp', $user->npp) }}"
                        {{ $edit ? '' : 'readonly' }}
                        class="w-full mt-1 px-3 py-2 border rounded-lg 
                            {{ $edit ? 'border-gray-300 bg-white' : 'bg-gray-100 cursor-not-allowed' }}
                            @error('npp') border-red-500 @enderror">
                    @error('npp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Phone --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Nomor HP</label>
                    <input type="text" name="phone"
                        value="{{ old('phone', $user->phone) }}"
                        {{ $edit ? '' : 'readonly' }}
                        class="w-full mt-1 px-3 py-2 border rounded-lg 
                            {{ $edit ? 'border-gray-300 bg-white' : 'bg-gray-100 cursor-not-allowed' }}
                            @error('phone') border-red-500 @enderror">
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Nama --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" value="{{ $user->name }}" readonly
                           class="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-100 cursor-not-allowed">
                </div>

                {{-- Email --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Email</label>
                    <input type="email" value="{{ $user->email }}" readonly
                           class="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-100 cursor-not-allowed">
                </div>

            </div>

            {{-- BUTTON --}}
            <div class="text-right pt-4">
                @if(!$edit)
                    <a href="?edit=true"
                        class="px-6 py-2.5 rounded-xl text-white font-medium shadow-md hover:shadow-lg transition inline-block"
                        style="background:#0F3B89;">
                        Edit Profil
                    </a>
                @else
                    <button type="submit"
                        class="px-6 py-2.5 rounded-xl text-white font-medium shadow-md hover:shadow-lg transition"
                        style="background:#0F3B89;">
                        Simpan Perubahan
                    </button>

                    {{-- ✅ TOMBOL BATAL (Rute Admin) --}}
                    <a href="{{ route('admin.profile.index') }}"
                        class="ml-3 px-5 py-2 rounded-xl text-gray-600 bg-gray-100 hover:bg-gray-200 transition">
                        Batal
                    </a>
                @endif
            </div>

        </form>

        {{-- DIVIDER --}}
        <div class="border-t my-10"></div>

        {{-- PASSWORD (hanya tampil di edit) --}}
        @if($edit)
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Ubah Password</h3>

            {{-- ✅ FORM PASSWORD (Rute Admin) --}}
            <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="action_type" value="update_password">

                <div>
                    <label class="text-sm font-medium text-gray-700">Password Baru</label>
                    <input type="password" name="new_password"
                            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg @error('new_password') border-red-500 @enderror">
                    @error('new_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="new_password_confirmation"
                            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg @error('new_password_confirmation') border-red-500 @enderror">
                    @error('new_password_confirmation') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="text-right">
                    <button type="submit"
                        class="px-6 py-2.5 rounded-xl text-white font-medium shadow-md hover:shadow-lg transition"
                        style="background:#0F3B89;">
                        Ubah Password
                    </button>
                </div>

            </form>
        @endif

    </div>

</div>

</x-layouts.main>
