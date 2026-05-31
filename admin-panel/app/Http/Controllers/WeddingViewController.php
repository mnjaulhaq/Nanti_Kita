<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use Illuminate\Http\Request;

class WeddingViewController extends Controller
{
    public function show($slug, Request $request)
    {
        $wedding = Wedding::where('slug', $slug)->firstOrFail();
        $tamuDariUrl = $request->query('to');

        if (empty($tamuDariUrl) || strtolower($tamuDariUrl) == 'namatamu') {
            $tamuDariUrl = null;
        }

        $rsvps = $wedding->rsvps()->latest()->get();

        return view('themes.rustic', compact('wedding', 'tamuDariUrl', 'rsvps'));
    }
}
