<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Gallery;
use App\Models\Member;
use App\Models\News;
use App\Models\Organization;
use App\Models\Registration;
use App\Models\Setting;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Ringkasan konten & aktivitas untuk halaman dashboard admin.
     */
    public function index()
    {
        $now = Carbon::now();
        $since = $now->copy()->subDays(30);

        $setting = Setting::first();

        $stats = [
            'news' => [
                'total' => News::count(),
                'recent' => News::where('created_at', '>=', $since)->count(),
            ],
            'galleries' => [
                'total' => Gallery::count(),
                'recent' => Gallery::where('created_at', '>=', $since)->count(),
            ],
            'registrations' => [
                'total' => Registration::count(),
                'recent' => Registration::where('created_at', '>=', $since)->count(),
            ],
            'attachments' => [
                'total' => Attachment::count(),
                'recent' => Attachment::where('created_at', '>=', $since)->count(),
            ],
        ];

        // Tren pendaftar 6 bulan terakhir.
        // Sengaja dihitung per bulan memakai rentang tanggal, bukan fungsi SQL
        // seperti DATE_FORMAT() (MySQL) atau strftime() (SQLite), supaya query
        // ini tetap jalan apa pun driver database yang dipakai.
        $trend = collect(range(5, 0))->map(function ($offset) use ($now) {
            $start = $now->copy()->subMonths($offset)->startOfMonth();
            $end = $start->copy()->endOfMonth();

            return [
                'label' => $start->translatedFormat('M'),
                'count' => Registration::whereBetween('created_at', [$start, $end])->count(),
            ];
        });

        return view('dashboard', [
            'stats' => $stats,
            'trend' => $trend,
            // Pembagi minimal 1 agar tidak pernah terjadi pembagian dengan nol
            // saat belum ada pendaftar sama sekali.
            'trendMax' => max(1, (int) $trend->max('count')),
            'isRegistrationOpen' => (bool) ($setting->is_registration_open ?? false),
            'orgPeriod' => $setting->org_period ?? null,
            'memberCount' => Member::count(),
            'organizationCount' => Organization::count(),
            'hiddenAttachmentCount' => Attachment::where('is_hidden', true)->count(),
            'recentRegistrations' => Registration::latest()->take(5)->get([
                'id', 'name', 'university', 'study_program', 'created_at',
            ]),
            'recentNews' => News::latest()->take(5)->get([
                'id', 'title', 'slug', 'created_at',
            ]),
        ]);
    }
}
