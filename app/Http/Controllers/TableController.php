<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Table::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|unique:tables',
            'capacity' => 'required|integer|min:1',
            'location' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        return Table::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Table::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $table = Table::findOrFail($id);
        
        $validated = $request->validate([
            'number' => 'sometimes|required|unique:tables,number,' . $id,
            'capacity' => 'sometimes|required|integer|min:1',
            'location' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $table->update($validated);
        return $table;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $table = Table::findOrFail($id);
        $table->delete();
        return response()->noContent();
    }

    public function getAvailableTables($date, $time)
    {
        return Table::where('is_active', true)
            ->get()
            ->filter(function ($table) use ($date, $time) {
                return $table->isAvailable($date, $time);
            })
            ->values();
    }
}
