<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\PharmacyRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Decimal;

class PharmacyRegisterController extends Controller
{
    //
    public function create()
    {
        return view('Pharmacies.create');
    }
    public function store(Request $request)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $pharmacyRegister = new PharmacyRegister();
        $pharmacyRegister->name = $validated['name'];
        $pharmacyRegister->user_id = Auth::id();
        $pharmacyRegister->latitude = (float)$validated['latitude'];

// Use the latitude and longitude values as needed
        $pharmacyRegister->longitude = (float)$validated['longitude'];
        $pharmacyRegister->save();

        return redirect()->route('home')->with('success', 'Pharmacy registration submitted successfully!');
   

    }
    public function edit(PharmacyRegister $pharmacyRegister)
    {
        return view('Pharmacies.edit', compact('pharmacyRegister'));
    }
    public function update(Request $request, PharmacyRegister $pharmacyRegister)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $pharmacyRegister->name = $validated['name'];
        $pharmacyRegister->latitude = (float)$validated['latitude'];
        $pharmacyRegister->longitude = (float)$validated['longitude'];
        $pharmacyRegister->save();

        return redirect()->route('home')->with('success', 'Pharmacy details updated successfully!');
    }
    public function destroy(PharmacyRegister $pharmacyRegister)
    {
        $pharmacyRegister->delete();

        return redirect()->route('home')->with('success', 'Pharmacy registration deleted successfully!');
    }
    public function index(){
        if(auth()->user()->is_admin ==true){
            $pharmacyRegisters=PharmacyRegister::all();
            return view('Pharmacies.applications',compact('pharmacyRegisters'));
}
    }
    public function accept(PharmacyRegister $pharmacyRegister){
        $pharmacy=new Pharmacy();
        $pharmacy->name=$pharmacyRegister->name;
        $pharmacy->latitude=$pharmacyRegister->latitude;
        $pharmacy->longitude=$pharmacyRegister->longitude;
        $pharmacy->state=false;
        $pharmacy->user_id=$pharmacyRegister->user->id;
        $pharmacy->save();
        $pharmacyRegister->delete();
        return redirect()->route('PharmaciesRegisters.index');
    }
    public function decline(PharmacyRegister $pharmacyRegister){
        $pharmacyRegister->delete();
        return redirect()->route('PharmaciesRegisters.index');
    }
}
