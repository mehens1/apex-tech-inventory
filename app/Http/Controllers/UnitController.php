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

    public function store()
    {
        $units = Unit::all();

        return view('portal.createUnits', [
            'units' => $units,
        ]);

        return view('portal.createUnits', $data);
    }

    public function createUnit(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $unit = Unit::where('name', $validatedData['title'])->first();

        if ($unit) {
            // Error Unit already exists

        }
        else {
            $unitData = [
                'name' => $validatedData['title'],
            ];

            $unit = Unit::create($unitData);
        }

    }

    public function edit(Unit $unit)
    {
        return view('units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $validatedData = $request->validate( [
            'title' => 'required|string|max:255',
        ]);

        $unit->update($validatedData);

        return redirect()->route('units')->('success', 'Unit updated successfully!');
    }
}
