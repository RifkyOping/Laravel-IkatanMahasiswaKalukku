<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Carbon;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $since = Carbon::now()->subDays(30);

        // Dihitung di level collection karena datanya sudah diambil semua,
        // jadi tidak perlu query tambahan ke database.
        $recentUsers = $users
            ->filter(fn ($user) => $user->created_at && $user->created_at->greaterThanOrEqualTo($since))
            ->count();

        return view('admin.users.index', [
            'users' => $users,
            'totalUsers' => $users->count(),
            'recentUsers' => $recentUsers,
            'newestUser' => $users->first(),
        ]);
    }
}
