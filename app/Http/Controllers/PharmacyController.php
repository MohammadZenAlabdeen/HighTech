<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function index(){
        if(auth()->user()->is_admin==true){
            $pharmacies=Pharmacy::all();
            return view('Pharmacies.index',compact('pharmacies'));
        }
    }
    public function show(Pharmacy $pharmacy)
    {
        return view('pharmacies.show', compact('pharmacy'));
    }

    public function state(Pharmacy $pharmacy)
    {
        $pharmacy->state = !$pharmacy->state; // Toggle the state
        $pharmacy->save();

        return redirect()->route('Phamracies.show', $pharmacy)->with('success', 'Pharmacy state updated successfully!');
    }
    public function delete(Pharmacy $pharmacy){
        if(auth()->user()->is_admin == true || auth()->user()->id == $pharmacy->user_id){
        $pharmacy->delete();
        return redirect()->route('home');
    }
    }
    public function edit(Pharmacy $pharmacy){
    if(auth()->user()->id == $pharmacy->user_id){
        return view('Pharmacies.pharmacyEdit',compact('pharmacy'));
    }
    }
    public function update(Request $request, Pharmacy $pharmacy){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        $pharmacy->name=$validated['name'];
        $pharmacy->latitude=$validated['latitude'];
        $pharmacy->longitude=$validated['longitude'];
        $pharmacy->save();
        return redirect()->route('Phamracies.show',$pharmacy);
    }
}
