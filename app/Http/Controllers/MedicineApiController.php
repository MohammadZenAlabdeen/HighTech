<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class MedicineApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function search(Request $request)
    {
        $name=$request->input('name');
        $medicines = Medicine::whereRaw("name LIKE ?", '%' . $name . '%')->with('pharmacy')->get();
        foreach($medicines as $medicine){
            $medicine->pharmacy->latitude=(float)$medicine->pharmacy->latitude;
            $medicine->pharmacy->longitude=(float)$medicine->pharmacy->longitude;
            $medicine->save();

        }

                return response()->json($medicines,200);
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
