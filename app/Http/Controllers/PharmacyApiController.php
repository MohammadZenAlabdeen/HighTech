<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
const EARTH_RADIUS = 6371;

class PharmacyApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $longitude = $request->input('longitude');
        $latitude = $request->input('latitude');
    
        $pharmacies = Pharmacy::all();
        $pharmaciesWithDistance = [];
    
        foreach ($pharmacies as $pharmacy) {
            $lat1 = deg2rad(number_format((float)$latitude, 6));
            $lon1 = deg2rad(number_format((float)$longitude, 6));
            $lat2 = deg2rad(number_format((float)$pharmacy->latitude, 6));
            $lon2 = deg2rad(number_format((float)$pharmacy->longitude, 6));
    
            $dlon = $lon2 - $lon1;
            $dlat = $lat2 - $lat1;
    
            $a = sin($dlat/2) * sin($dlat/2) + cos($lat1) * cos($lat2) * sin($dlon/2) * sin($dlon/2);
            $c = 2 * atan2(sqrt($a), sqrt(1-$a));
            $distance = EARTH_RADIUS * $c;
    
            if ($distance) { // adjust the distance threshold as needed
                $pharmaciesWithDistance[] = [
                    'id' => $pharmacy->id,
                    'name' => $pharmacy->name,
                    'state' =>$pharmacy->state ? 'open':'closed',
                    'latitude' =>(float) $pharmacy->latitude,
                    'longitude' =>(float) $pharmacy->longitude,
                    'distance' => round($distance, 2), // round the distance to 2 decimal places
                ];
            }
        }
    
        usort($pharmaciesWithDistance, function ($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });
    
        return response()->json($pharmaciesWithDistance);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
