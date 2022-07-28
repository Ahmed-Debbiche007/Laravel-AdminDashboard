<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index($id)
    {
        return view('dashboard.client' , [
            'clients' => Client::latest()->find($id),
        ]);
    }

    // Show  the admin's "add client" form
    public function addclients()
    {
        return view('dashboard.addClient', [
            'clients' =>  Client::latest(),
            'allclients' =>  Client::latest()-> get() -> count(),
        ]);
    }
    
    public function store(Request $request){
        
        $formFields= $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'matFisc' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'tel' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
      
        $formFields['role']="Client";
        $formFields['is_admin']=0;
        Client::create($formFields);

        return redirect('/Clients')->withSuccess('Client  ajouté avec succées.');
    }

    //This function let the admin edit any user, let the guest user edit his profile 
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'address' => ['required', 'string'],
            'tel' => ['required', 'string'],
            'email' => 'required|string|email|max:255',
        ]);
        $client->name = $request->input('name');
        $client->matFisc = $request->input('last_name');
        $client->address = $request->input('address');
        $client->tel = $request->input('tel');
        $client->email = $request->input('email');

        
        $client->update();

        return redirect('/Clients')->withSuccess('Client  modifié avec succées.');
    }

    //This function let the admin edit any user's password, let the guest user edit his password 
    public function updatePassword(Request $request, Client $client){
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
        return redirect('/Clients')->withSuccess('Client  modifié avec succées.');
    }

    //This function let the admin delete any users
    public function destroy(Client $client){
        $client->delete();
        return redirect('/Clients')->withSuccess('Client  supprimé avec succées');

    }

    public function makeUser(Client $client){
        $user = new User();
        $user->name = $client->name;
        $user->last_name = " ";
        $user->photo = $client->photo;
        $user->address =$client->address ; 
        $user->tel =$client->tel ; 
        $user->email =$client->email ; 
        $user->role ="Client"; 
        $user->is_admin =0; 
        $user->password =$client->password;
        $user->save();
        return redirect('/Dashboard')->withSuccess('Utilisateur ajouté avec succées.');

    }
    

}
