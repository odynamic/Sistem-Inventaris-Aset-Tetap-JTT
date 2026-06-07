<x-layouts.main title="Tambah User">

{{-- HEADER --}}
<div class="flex items-center justify-between mb-4">
    <div class="flex items-center gap-3">
        <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-8" alt="">
        <h1 class="text-lg font-semibold text-gray-800 tracking-wide">Tambah User</h1>
    </div>

    <a href="{{ route('admin.users.index') }}"
        class="px-3 py-1.5 bg-white border rounded-lg text-xs text-gray-700 hover:bg-gray-100">
        <i class="ph ph-arrow-left text-xs"></i> Kembali
    </a>
</div>


<div class="bg-white p-6 rounded-xl shadow border max-w-xl mx-auto">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 gap-3 text-xs">

            {{-- NAME --}}
            <div>
                <label class="text-[11px] font-medium">Nama</label>
                <input type="text" name="name"
                    class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-[#0F3B89]" required>
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="text-[11px] font-medium">Email</label>
                <input type="email" name="email"
                    class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-[#0F3B89]" required>
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="text-[11px] font-medium">Password</label>
                <input type="password" name="password"
                    class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-[#0F3B89]" required>
            </div>

            {{-- ROLE --}}
            <div>
                <label class="text-[11px] font-medium">Role</label>
                <select name="role"
                    class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-[#0F3B89]">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

        </div>

        <button class="mt-5 px-4 py-2 text-xs rounded-lg text-white shadow"
                style="background:#0F3B89">
            <i class="ph ph-check text-xs"></i> Simpan
        </button>

    </form>
</div>

</x-layouts.main>
