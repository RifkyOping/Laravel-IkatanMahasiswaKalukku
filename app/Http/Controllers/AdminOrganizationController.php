<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class AdminOrganizationController extends Controller
{
    public function index()
    {
        // withCount menghindari N+1 query: sebelumnya jumlah anggota dihitung
        // dengan $org->members()->count() di dalam loop Blade, yang berarti satu
        // query tambahan untuk setiap baris.
        $organizations = Organization::withCount('members')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.organizations.index', compact('organizations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'section' => 'required|in:pembina,pengawas,ketua,sekretaris,bendahara,divisi',
            'sort_order' => 'nullable|integer',
        ]);

        Organization::create($validated);

        return redirect()->route('admin.organizations.index')->with('success', 'Divisi/Jabatan berhasil ditambahkan.');
    }

    public function edit(Organization $organization)
    {
        return view('admin.organizations.edit', compact('organization'));
    }

    public function update(Request $request, Organization $organization)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'section' => 'required|in:pembina,pengawas,ketua,sekretaris,bendahara,divisi',
            'sort_order' => 'nullable|integer',
        ]);

        $organization->update($validated);

        return redirect()->route('admin.organizations.index')->with('success', 'Divisi/Jabatan berhasil diperbarui.');
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();

        return redirect()->route('admin.organizations.index')->with('success', 'Divisi/Jabatan berhasil dihapus.');
    }
}
