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
            return back()->with('error', 'Unit already exists!');
        }
        else {
            $unitData = [
                'name' => $validatedData['title'],
            ];

            $unit = Unit::create($unitData);
        }

        return redirect()->route('units')->with('success', 'Unit created successfully!');

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

        $existingunit = Unit::where('name', $validatedData['title'])->first();

        if ($existingunit) {
            return back()->with('error', 'Unit already exists!');
        }
        else {
            $unitData = [
                'name' => $validatedData['title'],
            ];
            $unit->update($unitData);
        }

        return redirect()->route('units')->with('success', 'Unit updated successfully!');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();

        return redirect()->route('units')->with('success', 'Unit deleted successfully!');
    }
}
