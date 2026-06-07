<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Traits\RecordsActivity;

class UserProfileController extends Controller
{
    use RecordsActivity;
    public function index()
    {
        return view('user.profile.index', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'npp'   => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048',
        ]);

        // ✔ PERBAIKAN: gunakan profile_photo, bukan photo
        if ($request->hasFile('photo')) {

            // Delete foto lama jika ada
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Upload foto baru
            $user->profile_photo = $request->file('photo')
                ->store('profile_photos', 'public');
        }

        // Update data lain
        $user->npp   = $request->npp;
        $user->phone = $request->phone;
        $user->save();

        $this->recordActivity(
    action: 'Update Profil',
    module: 'Profil',
    description: 'User mengubah profilnya'
);


        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password'     => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        $this->recordActivity(
    action: 'Update Profil',
    module: 'Profil',
    description: 'User mengubah profilnya'
);


        return back()->with('success', 'Password berhasil diubah.');
    }
}
