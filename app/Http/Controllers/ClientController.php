<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index($id)
    {
        return view('dashboard.client' , [
            'clients' => user::latest()->where('role','like','Client')->find($id),
        ]);
    }

    // Show  the admin's "add client" form
    public function addclients()
    {
        return view('dashboard.addClient', [
            'clients' =>  user::latest()->where('role','like','Client'),
            'allclients' =>  user::latest()->where('role','like','Client')-> get() -> count(),
        ]);
    }
    
    public function store(Request $request){
        
        $formFields= $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'tel' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
      
        $formFields['role']="Client";
        $formFields['is_admin']=0;
        User::create($formFields);

        return redirect('/Clients')->withSuccess('Client added successfully.');
    }

    //This function let the admin edit any user, let the guest user edit his profile 
    public function update(Request $request, User $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'address' => ['required', 'string'],
            'tel' => ['required', 'string'],
            'email' => 'required|string|email|max:255',
        ]);
        $client->name = $request->input('name');
        $client->last_name = $request->input('last_name');
        $client->address = $request->input('address');
        $client->tel = $request->input('tel');
        $client->email = $request->input('email');
        $client->role ="Client";
        $client->is_admin =0;
        
        $client->update();

        return redirect('/Clients')->withSuccess('Client updated successfully.');
    }

    //This function let the admin edit any user's password, let the guest user edit his password 
    public function updatePassword(Request $request, User $client){
        $request->validate([
            'password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password',
        ]);
        if (!is_null($request->input('password'))) {
            $isPass = Hash::check(request('password'), $client->password);
            if ($isPass == true) {
                $client->password = $request->input('new_password');
            } else {
                return redirect()->back()->withInput();
            }
        }
        $client->update();
        return redirect('/Clients')->withSuccess('Client updated successfully.');
    }

    //This function let the admin delete any users
    public function destroy(User $client){
        $client->delete();
        return redirect('/Clients')->withSuccess('Client deleted successfully.');

    }
    

}
