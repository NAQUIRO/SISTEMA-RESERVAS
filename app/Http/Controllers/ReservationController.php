<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Reservation::with('table')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_id' => 'required|exists:tables,id',
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'number_of_guests' => 'required|integer|min:1',
            'reservation_date' => 'required|date|after:now',
            'special_requests' => 'nullable|string'
        ]);

        $table = Table::findOrFail($validated['table_id']);
        
        // Verificar si la mesa está disponible
        $date = date('Y-m-d', strtotime($validated['reservation_date']));
        $time = date('H:i:s', strtotime($validated['reservation_date']));
        
        if (!$table->isAvailable($date, $time)) {
            return response()->json([
                'message' => 'La mesa no está disponible para la fecha y hora seleccionada'
            ], 422);
        }

        return Reservation::create($validated);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Reservation::with('table')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservation = Reservation::findOrFail($id);
        
        $validated = $request->validate([
            'table_id' => 'sometimes|required|exists:tables,id',
            'customer_name' => 'sometimes|required|string',
            'customer_email' => 'sometimes|required|email',
            'customer_phone' => 'sometimes|required|string',
            'number_of_guests' => 'sometimes|required|integer|min:1',
            'reservation_date' => 'sometimes|required|date|after:now',
            'special_requests' => 'nullable|string'
        ]);

        if (isset($validated['table_id']) && isset($validated['reservation_date']) && 
            ($validated['table_id'] != $reservation->table_id || 
             $validated['reservation_date'] != $reservation->reservation_date)) {
            
            $table = Table::findOrFail($validated['table_id']);
            $date = date('Y-m-d', strtotime($validated['reservation_date']));
            $time = date('H:i:s', strtotime($validated['reservation_date']));
            
            if (!$table->isAvailable($date, $time)) {
                return response()->json([
                    'message' => 'La mesa no está disponible para la fecha y hora seleccionada'
                ], 422);
            }
        }

        $reservation->update($validated);
        return $reservation->load('table');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return response()->noContent();
    }

    public function updateStatus(Request $request, string $id)
    {
        $reservation = Reservation::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $reservation->update($validated);
        return $reservation->load('table');
    }
}
