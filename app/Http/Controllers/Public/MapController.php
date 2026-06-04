<?php

namespace App\Http\Controllers\Public;

use App\Models\StudentLocation;
use Illuminate\View\View;

class MapController
{
    public function index(): View
    {
        $locations = StudentLocation::all();
        return view('public.map', compact('locations'));
    }
}
