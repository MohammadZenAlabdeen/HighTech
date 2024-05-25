<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\PharmacyRegister;
use App\Models\User;
use Illuminate\Http\Request;
use PDO;

class ViewController extends Controller
{
    public function home(){
        $usersCount=User::count();
        $pharmaciesCount=Pharmacy::count();
        $pharmacyApplicationsCount=PharmacyRegister::count();
        if(auth()->user()->pharmacy){
            $pharmacy=auth()->user()->pharmacy;
            $medicineCount=$pharmacy->medicine()->count();
            return view('Home',compact('usersCount','pharmaciesCount','pharmacyApplicationsCount','pharmacy','medicineCount'));

        }
        if(auth()->user()->pharmacyRegister){
            $pharmacyRegister=auth()->user()->pharmacyRegister;
            return view('Home',compact('usersCount','pharmaciesCount','pharmacyApplicationsCount','pharmacyRegister'));

        }
        return view('Home',compact('usersCount','pharmaciesCount','pharmacyApplicationsCount'));

    }
}
