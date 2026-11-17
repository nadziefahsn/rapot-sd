<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RapotItem;

class RapotController extends Controller
{
    public function lembar3()
    {
        $ekskuls = RapotItem::where('kategori', 'ekskul')->get();
        $muloks = RapotItem::where('kategori', 'mulok')->get();

        return view('rapot.lembar3', compact('ekskuls', 'muloks'));
    }
}