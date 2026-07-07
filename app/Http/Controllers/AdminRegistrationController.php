<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Registration;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class AdminRegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::latest()->paginate(10);
        $setting = Setting::firstOrCreate([]);
        return view('admin.registrations.index', compact('registrations', 'setting'));
    }

    public function toggleStatus(Request $request)
    {
        $setting = Setting::firstOrCreate([]);
        $setting->update([
            'is_registration_open' => $request->has('is_registration_open')
        ]);

        $status = $setting->is_registration_open ? 'dibuka' : 'ditutup';
        return redirect()->back()->with('success', "Pendaftaran anggota telah $status.");
    }

    public function show(Registration $registration)
    {
        return view('admin.registrations.show', compact('registration'));
    }

    public function destroy(Registration $registration)
    {
        if ($registration->parent_permit_file) {
            Storage::disk('public')->delete($registration->parent_permit_file);
        }
        $registration->delete();
        return redirect()->route('admin.registrations.index')->with('success', 'Data pendaftar berhasil dihapus.');
    }

    public function destroyAll()
    {
        $registrations = Registration::all();
        foreach ($registrations as $registration) {
            if ($registration->parent_permit_file) {
                Storage::disk('public')->delete($registration->parent_permit_file);
            }
            $registration->delete();
        }
        return redirect()->route('admin.registrations.index')->with('success', 'Semua data pendaftar berhasil dihapus.');
    }

    public function exportCsv(Request $request)
    {
        $separatorInput = $request->query('separator', 'comma');
        $separator = $separatorInput === 'semicolon' ? ';' : ',';

        $fileName = 'data_pendaftar_imk_' . date('Y-m-d_H-i-s') . '.csv';
        $registrations = Registration::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = [
            'No', 'Nama Lengkap', 'Tempat Lahir', 'Tanggal Lahir', 'Jenis Kelamin', 
            'Alamat di Majene', 'Alamat di Kalukku', 'Asal Sekolah', 
            'Universitas', 'Fakultas', 'Program Studi', 'Tahun Masuk', 
            'No. WhatsApp', 'Tanggal Daftar'
        ];

        $callback = function() use($registrations, $columns, $separator) {
            $file = fopen('php://output', 'w');
            
            // Add BOM to fix UTF-8 in Excel
            fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

            fputcsv($file, $columns, $separator);

            $no = 1;
            foreach ($registrations as $reg) {
                $row = [
                    $no++,
                    $reg->name,
                    $reg->birth_place,
                    $reg->birth_date,
                    $reg->gender,
                    $reg->address_majene,
                    $reg->address_kalukku,
                    $reg->high_school,
                    $reg->university,
                    $reg->faculty,
                    $reg->study_program,
                    $reg->entry_year,
                    $reg->phone,
                    $reg->created_at->format('Y-m-d H:i:s'),
                ];
                fputcsv($file, $row, $separator);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
