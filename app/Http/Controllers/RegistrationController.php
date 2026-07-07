<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function create()
    {
        $setting = \App\Models\Setting::firstOrCreate([]);
        
        if (!$setting->is_registration_open) {
            return redirect('/')->with('error', 'Maaf, pendaftaran anggota baru Ikatan Mahasiswa Kalukku saat ini sedang ditutup.');
        }

        return view('pendaftaran', compact('setting'));
    }

    public function store(Request $request)
    {
        $setting = \App\Models\Setting::firstOrCreate([]);
        
        if (!$setting->is_registration_open) {
            return redirect('/')->with('error', 'Maaf, pendaftaran anggota IMK saat ini sedang ditutup.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'address_majene' => 'nullable|string',
            'address_kalukku' => 'required|string',
            'high_school' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'study_program' => 'required|string|max:255',
            'entry_year' => 'required|string|max:4',
            'phone' => 'required|string|max:20',
            'parent_permit_file' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
        ], [
            'parent_permit_file.mimes' => 'Format file izin orang tua harus berupa PDF, JPG, PNG, atau DOCX.',
            'parent_permit_file.max' => 'Ukuran file izin orang tua maksimal 5MB.',
        ]);

        if ($request->hasFile('parent_permit_file')) {
            $file = $request->file('parent_permit_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/registrations', $fileName, 'public');
            $validated['parent_permit_file'] = $filePath;
        }

        \App\Models\Registration::create($validated);

        return redirect()->back()->with([
            'success' => 'Pendaftaran berhasil dikirim! Silakan tunggu informasi selanjutnya dari pengurus.',
            'registration_success' => true,
            'whatsapp_link' => $setting->whatsapp_group_link
        ]);
    }
}
