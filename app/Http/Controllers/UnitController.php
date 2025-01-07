<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends BaseController
{
    public function index()
    {
        $units = Unit::all();
        $data = [
            'units' => $units,
        ];
        return view('portal.units', $data);
    }
}
