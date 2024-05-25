<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Medicine;
use App\Models\Pharmacy;

class MedicineController extends Controller
{ 
    public function all(){
        if(auth()->user()->is_admin){
            $medicines = Medicine::with('pharmacy')->get();
            return view('Medicines.all',compact('medicines'));
        }
    }
    public function index(Pharmacy $pharmacy)
    {
        // Check if the authenticated user owns the pharmacy
        if ($pharmacy->user->id != auth()->user()->id) {
            abort(403); // Forbidden
        }

        $medicines = Medicine::where('pharmacy_id', $pharmacy->id)->with('pharmacy')->get();
        return view('Medicines.index', compact('medicines', 'pharmacy'));
    }


    public function create()
    {
        return view('Medicines.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'company' => 'required',
            'count' => 'required|numeric|min:0',
        ]);
    
        $pharmacy = Auth::user()->pharmacy;
    
        $medicine = new Medicine();
        $medicine->name = $validatedData['name'];
        $medicine->company = $validatedData['company'];
        $medicine->count = $validatedData['count'];
        $medicine->pharmacy_id = $pharmacy->id;
        $medicine->save();
return redirect()->route('pharmacy.medicines.index',$pharmacy);
    }

    public function show(Medicine $medicine)
    {
        // Check if the user owns the pharmacy for this medicine
        if ($medicine->pharmacy->user_id != auth()->user()->id||auth()->user()->is_admin==false) {
            abort(403); // Forbidden
        }

        return view('Medicines.show', compact('medicine'));
    }


    public function edit(Pharmacy $pharmacy,Medicine $medicine)
    {
        // Check if the user owns the pharmacy for this medicine
        if ($medicine->pharmacy->user->id != auth()->user()->id||auth()->user()->is_admin==false) {
            abort(403); // Forbidden
        }

        return view('Medicines.edit', compact('pharmacy','medicine'));
    }


    public function update(Request $request,Pharmacy $pharmacy, Medicine $medicine)
    {
        // Check if the user owns the pharmacy for this medicine
        if ($medicine->pharmacy->user->id != auth()->user()->id||auth()->user()->is_admin==false) {
            abort(403); // Forbidden
        }
    
        $validatedData = $request->validate([
            'name' => 'required',
            'company' => 'required',
            'count' => 'required|numeric|min:0',
        ]);
    
        $medicine->name = $validatedData['name'];
        $medicine->company = $validatedData['company'];
        $medicine->count = $validatedData['count'];
        $medicine->save();
    
        return redirect()->route('pharmacy.medicines.index',$pharmacy)->with('success', 'Medicine updated successfully.');
    }

    public function destroy(Medicine $medicine)
    {
        // Check if the user owns the pharmacy for this medicine
        if ($medicine->pharmacy->user->id != auth()->user()->id||auth()->user()->is_admin==false) {
            abort(403); // Forbidden
        }
    
        $medicine->delete();
        return redirect()->route('pharmacy.medicines.index',$medicine->pharmacy);
    }
}
