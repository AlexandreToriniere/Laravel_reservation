<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Prestation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendPrestationController extends Controller
{
    public function prestation()
    {
        $prestations = Prestation::all();
        return view ('prestations', compact('prestations'));
    }
}
