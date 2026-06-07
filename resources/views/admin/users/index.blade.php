<x-layouts.main title="Data User">

<div x-data="userModals()" class="relative">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/images/logo_jasamarga_icon.png') }}" class="h-9" alt="">
            <h1 class="text-xl font-semibold text-gray-800 tracking-wide">Data User</h1>
        </div>

        <button @click="openCreate()"
           class="px-4 py-2 rounded-lg flex items-center gap-2 text-sm shadow 
                  hover:opacity-90 transition text-white"
           style="background:#0F3B89">
            <i class="ph ph-plus text-lg"></i> Tambah User
        </button>
    </div>


    {{-- FILTER & SEARCH --}}
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">

            {{-- FILTER ROLE --}}
            <div>
                <label class="text-[10px] text-gray-600 font-medium">Role</label>
                <select name="role"
                    class="w-full mt-1 px-2.5 py-1.5 border rounded-lg text-sm"
                    onchange="this.form.submit()">
                    <option value="">Semua</option>
                    <option value="admin" @selected(request('role')=='admin')>Admin</option>
                    <option value="user"  @selected(request('role')=='user')>User</option>
                </select>
            </div>

            {{-- SEARCH --}}
            <div class="md:col-span-3">
                <label class="text-[10px] text-gray-600 font-medium">Pencarian</label>
                <div class="flex gap-2 mt-1">
                    <input type="text" name="search"
                        class="w-full px-2.5 py-1.5 border rounded-lg text-sm"
                        placeholder="Cari nama/email user..."
                        value="{{ request('search') }}">

                    <button class="px-4 py-1.5 bg-[#0F3B89] text-white rounded-lg">
                        Cari
                    </button>

                    @if(request()->filled('search') || request()->filled('role'))
                        <a href="{{ route('admin.users.index') }}"
                            class="px-4 py-1.5 bg-gray-200 text-gray-800 rounded-lg text-sm">
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>


    {{-- TABLE --}}
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
        <table class="w-full text-sm border-collapse">
            <thead>
            <tr class="bg-[#F4F6FA] text-gray-600 uppercase text-[11px] tracking-wide text-center">
                <th class="p-2 border">Nama</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Role</th>
                <th class="p-2 border w-[90px]">Aksi</th>
            </tr>
            </thead>

            <tbody>
                @forelse ($users as $u)
                <tr class="border-b hover:bg-gray-50 transition text-center">
                    <td class="p-2 text-[13px] font-medium text-left">{{ $u->name }}</td>
                    <td class="p-2 text-[13px]">{{ $u->email }}</td>
                    <td class="p-2 text-[13px] uppercase">{{ $u->role }}</td>

                    <td class="p-2">
                        <div class="flex items-center justify-center gap-2">

                            {{-- EDIT --}}
                            <button @click="openEdit({{ $u }})"
                                class="flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 transition">
                                <i class="ph ph-pencil-simple text-[16px]"></i>
                            </button>

                            {{-- DELETE --}}
<button @click="openDelete({{ $u->id }})"
                                class="flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition">
                                <i class="ph ph-trash text-[16px]"></i>
                            </button>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-3 text-gray-500 text-sm">
                        Tidak ada data user.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>

{{-- ========================= --}}
{{-- MODAL CREATE / EDIT USER --}}
{{-- ========================= --}}
<div x-show="openUserModal" x-cloak class="fixed inset-0 flex items-center justify-center bg-black/40 backdrop-blur-sm z-[999]">

    <div x-show="openUserModal" x-transition.scale.90 class="bg-white rounded-2xl p-7 w-[430px] shadow-2xl relative">

        {{-- ICON --}}
        <div class="flex justify-center mb-4">
            <div class="w-14 h-14 rounded-full bg-[#0F3B89]/10 flex items-center justify-center">
                <i class="ph ph-user text-3xl" style="color:#0F3B89"></i>
            </div>
        </div>

        {{-- TITLE --}}
        <h2 class="text-lg font-semibold text-gray-800 text-center mb-4"
            x-text="isEdit ? 'Edit User' : 'Tambah User'"></h2>

        {{-- FORM --}}
        <form :action="formAction" method="POST" class="space-y-3">
            @csrf

            {{-- FIX WAJIB!! method PUT tidak boleh pakai template --}}
            <input x-show="isEdit" type="hidden" name="_method" value="PUT">

            {{-- NAMA --}}
            <div>
                <label class="text-xs text-gray-600 font-medium">Nama</label>
                <input type="text" name="name" x-model="form.name"
                       class="w-full mt-1 px-3 py-2 border rounded-lg text-sm focus:ring-[#0F3B89]">
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="text-xs text-gray-600 font-medium">Email</label>
                <input type="email" name="email" x-model="form.email"
                       class="w-full mt-1 px-3 py-2 border rounded-lg text-sm focus:ring-[#0F3B89]">
            </div>

            {{-- ROLE --}}
            <div>
                <label class="text-xs text-gray-600 font-medium">Role</label>
                <select name="role" x-model="form.role"
                        class="w-full mt-1 px-3 py-2 border rounded-lg text-sm focus:ring-[#0F3B89]">
                        <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            {{-- PASSWORD (hanya create) --}}
            <div x-show="!isEdit">
                <label class="text-xs text-gray-600 font-medium">Password</label>
                <input type="password" name="password"
                       class="w-full mt-1 px-3 py-2 border rounded-lg text-sm focus:ring-[#0F3B89]">
            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end gap-2 pt-3">
                <button type="button"
                        @click="closeUserModal()"
                        class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 text-sm hover:bg-gray-300">
                    Batal
                </button>

                <button class="px-4 py-2 rounded-lg text-sm text-white"
                        style="background:#0F3B89">
                    Simpan
                </button>
            </div>

        </form>

    </div>
</div>

<!-- DELETE MODAL -->
<div 
    x-show="openDeleteModal" 
    x-cloak 
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm"
>
    <div 
        @click.away="openDeleteModal = false" 
        class="bg-white w-full max-w-md rounded-2xl p-6 text-center shadow-xl"
    >
        {{-- ICON TRASH --}}
        <div class="flex justify-center mb-3">
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                <i class="ph ph-trash text-red-600 text-3xl"></i>
            </div>
        </div>



        <!-- Title -->
        <h2 class="text-xl font-semibold mb-2">Hapus Akun?</h2>

        <!-- Subtitle -->
        <p class="text-gray-600 mb-6">
            Akun ini akan dihapus permanen dan tindakan ini tidak dapat dibatalkan.
        </p>

        <!-- Buttons -->
        <div class="flex justify-center gap-3">
            <button 
                @click="openDeleteModal = false" 
                class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100"
            >
                Batal
            </button>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button 
                    class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700"
                >
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

</div>


<script>
function userModals() {
    return {
        openUserModal: false,
        openDeleteModal: false, // <= FIXED
        isEdit: false,
        formAction: "",
        deleteId: null,

        form: {
            name: "",
            email: "",
            role: "user",
        },

        // CREATE
        openCreate() {
            this.isEdit = false;
            this.formAction = "/admin/users";
            this.form = { name:"", email:"", role:"user" };
            this.openUserModal = true;
        },

        // EDIT
        openEdit(user) {
            this.isEdit = true;
            this.formAction = `/admin/users/${user.id}`;
            this.form = {
                name: user.name,
                email: user.email,
                role: user.role,
            };
            this.openUserModal = true;
        },

        closeUserModal() {
            this.openUserModal = false;
        },

        // DELETE
        openDelete(id) {
            this.deleteId = id;
            this.openDeleteModal = true; // <= FIX
            document.getElementById('deleteForm').action = `/admin/users/${id}`;
        }
    }
}
</script>


</x-layouts.main>
