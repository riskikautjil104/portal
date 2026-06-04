<?php

namespace App\Http\Controllers\Admin;

use App\Models\PortalLink;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PortalLinkController
{
    public function index(): View
    {
        $links = PortalLink::orderBy('order')->paginate(15);
        return view('admin.portal.index', compact('links'));
    }

    public function create(): View
    {
        return view('admin.portal.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'order' => 'required|integer',
            'active' => 'boolean',
        ]);

        PortalLink::create($validated);

        return redirect()->route('admin.portal-links.index')->with('success', 'Link berhasil ditambahkan');
    }

    public function edit(PortalLink $portalLink): View
    {
        return view('admin.portal.edit', compact('portalLink'));
    }

    public function update(Request $request, PortalLink $portalLink): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'order' => 'required|integer',
            'active' => 'boolean',
        ]);

        $portalLink->update($validated);

        return redirect()->route('admin.portal-links.index')->with('success', 'Link berhasil diperbarui');
    }

    public function destroy(PortalLink $portalLink): RedirectResponse
    {
        $portalLink->delete();
        return redirect()->route('admin.portal-links.index')->with('success', 'Link berhasil dihapus');
    }
}
