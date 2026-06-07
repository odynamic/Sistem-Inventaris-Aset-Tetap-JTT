<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil admin.
     */
    public function index()
    {
        // Pastikan Anda mendapatkan data user yang sedang login
        $user = auth()->user(); 
        
        return view('admin.profile.index', compact('user'));
    }

    /**
     * Mengupdate data pribadi atau foto profil.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        if ($request->action_type === 'update_photo') {
            // Logika Update Foto
            $request->validate(['photo' => 'nullable|image|max:2048']);

            if ($request->hasFile('photo')) {
                // Hapus foto lama jika ada
                if ($user->profile_photo) {
                    Storage::disk('public')->delete($user->profile_photo);
                }
                
                // Simpan foto baru
                $path = $request->file('photo')->store('profile-photos', 'public');
                $user->update(['profile_photo' => $path]);
            }
            return back()->with('success', 'Foto profil berhasil diperbarui.');

        } elseif ($request->action_type === 'update_details') {
            // Logika Update Detail (NPP & Phone)
            $request->validate([
                'npp' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
                'phone' => ['nullable', 'string', 'max:15'],
            ]);

            $user->update([
                'npp' => $request->npp,
                'phone' => $request->phone,
            ]);

            return back()->with('success', 'Data profil berhasil diperbarui.');
        }

        return back()->with('error', 'Aksi tidak valid.');
    }

    /**
     * Mengupdate password admin.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        auth()->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password berhasil diubah.');
    }
}