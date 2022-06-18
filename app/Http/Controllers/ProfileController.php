<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        return view('profile' , [
            'users' => user::find($id)
        ]);
    }

    

   

    public function store(Request $request){
        $formFields= $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => 'required'
        ]);

        User::create($formFields);

        return redirect('/Dashboard');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->update();

        return redirect()->route('home')->withSuccess('Profile updated successfully.');
    }

    public function updatePassword(Request $request, User $user){
        $request->validate([
            'password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password',
        ]);
        if (!is_null($request->input('password'))) {
            $isPass = Hash::check(request('password'), $user->password);
            if ($isPass == true) {
                $user->password = $request->input('new_password');
            } else {
                return redirect()->back()->withInput();
            }
        }
        $user->update();
        return redirect()->route('home')->withSuccess('Profile updated successfully.');
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->route('home')->withSuccess('Profile deleted successfully.');

    }
    
    
}