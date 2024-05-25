<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request){
        $validator=Validator::make($request->all(),['password'=>'string|min:8|required','email'=>'string|required']);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        if(Auth::attempt($request->only(['email','password']))){
                return redirect()->route('home');
            
        }else{
            return redirect()->back()->withErrors(['Error'=>'Wrong info entered']);
        }
    }
    public function register(Request $request){
        $validator=Validator::make($request->all(),['name'=>'string|required|max:255',
        'password'=>'string|min:8|required|confirmed','email'=>'string|required|unique:users,email']);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        $user = new User();
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password=Hash::make($request->input('password'));
        $user->is_admin=false;
        $user->save();
        Auth::attempt($request->only(['email','password']));
        return redirect()->route('home');
    }
    public function logout(){
        Auth()->logout();
        session()->invalidate();
        return redirect()->route('Users.showlogin');
    }
    public function showlogin(){
        return view('Users.login');
    }
    public function showregister(){
        return view('Users.register');
    }
    public function index(){
        if(auth()->user()->is_admin==true){
            $users=User::all();
            return view('Users.index',compact('users'));
        }else{
            return redirect()->back()->withErrors(['Error'=>'Not authorised']);
        }
    }
    public function show(User $user){
        return view('Users.show',compact('user'));
        }
    public function admin(User $user){
        $user->is_admin=true;
        $user->save();
        return redirect()->route('Users.index');
    }
    public function delete(User $user){
        if($user->pharmacyRegister){
            $user->pharmacyRegister()->delete();
        }
        if($user->pharmacy){
            $user->pharmacy()->medicine()->delete();
            $user->pharmacy()->schedule()->delete();
            $user->pharmacy()->delete();
        }
        $user->delete();
        return redirect()->route('Users.index');
    }
    public function edit(User $user){
        if($user->id===auth()->user()->id){
            return view('Users.edit',compact('user'));
        }else{
            return redirect()->back()->withErrors(['Error'=>'Not authorised']);
        }
    }
    public function update(User $user, Request $request) {
        // Validate the input
        if (array_key_exists('new_password', $request->all())) {
            $validator = Validator::make($request->all(), [
                'name' => 'string|required|max:255',
                'new_password' => 'string|min:8|confirmed',
                'email' => 'string|required|email',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'string|required|max:255',
                'email' => 'string|required|email',
            ]);
        }
    
        // Check for validation errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
    
        // Update the user information
        $user->name = $request->input('name');
        $user->email = $request->input('email');
    
        if (array_key_exists('new_password', $request->all())) {
            $user->password = Hash::make($request->input('new_password'));
        }
    
        // Save the updated user information
        $user->save();
    
        // Redirect to the user info page with a success message
        return redirect()->route('Users.show', $user->id)->with('success', 'User updated successfully');
    }
    
}
