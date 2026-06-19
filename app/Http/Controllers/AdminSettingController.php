<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::firstOrCreate([], [
            'address' => 'Sekretariat IMK<br>Kabupaten Majene, Sulawesi Barat',
            'email' => 'info@imkkalukku.org',
            'phone' => '+62 812 3456 7890',
            'instagram' => 'https://instagram.com',
            'facebook' => 'https://facebook.com',
            'whatsapp' => 'https://wa.me/6281234567890',
            'youtube' => 'https://youtube.com',
        ]);

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
            'whatsapp' => 'nullable|url',
            'youtube' => 'nullable|url',
            'ketua_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'sekretaris_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'bendahara_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp',
        ]);

        $setting = Setting::firstOrCreate([]);
        
        $data = $request->except(['ketua_photo', 'sekretaris_photo', 'bendahara_photo']);
        // Checkboxes only send value if checked. If not present, it means false.
        $data['show_address'] = $request->has('show_address');
        $data['show_email'] = $request->has('show_email');
        $data['show_phone'] = $request->has('show_phone');
        $data['show_instagram'] = $request->has('show_instagram');
        $data['show_facebook'] = $request->has('show_facebook');
        $data['show_whatsapp'] = $request->has('show_whatsapp');
        $data['show_youtube'] = $request->has('show_youtube');

        $photos = ['ketua_photo', 'sekretaris_photo', 'bendahara_photo'];
        foreach ($photos as $photo) {
            if ($request->hasFile($photo)) {
                if ($setting->$photo) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($setting->$photo);
                }
                $data[$photo] = $request->file($photo)->store('pengurus', 'public');
            }
        }

        $setting->update($data);

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
