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
            'clients' => client::find($id)
        ]);
    }

    // Show  the admin's "add client" form
    public function addclients()
    {
        return view('dashboard.addClient', [
            'clients' => client::all(),
            'allclients' => client::latest() -> get() -> count(),
        ]);
    }
    
    //This function let the admin add new clients
    public function store(Request $request){
        $formFields= $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
        ]);

        client::create($formFields);
        $user =[
            'name' => $formFields['name'],
            'last_name' => $formFields['last_name'],
            'email' => $formFields['email'],
            'password' => $request->input('password'),
            'role' => 'Client',
        ];

        user::create($user);

        return redirect('/Clients')->withSuccess('Client added successfully!');
    }

    //This function let the admin edit any client, let the guest client edit his profile 
    public function update(Request $request, client $client, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);
        $client->name = $request->input('name');
        $client->last_name = $request->input('last_name');
        $client->update();
       
       $user->name= $request->input('name');
       $user->last_name=  $request->input('last_name');
       $user->email=  $request->input('email');
       $user->role= 'Client';
        $user->update();
        return redirect()->route('Clients')->withSuccess('Client updated successfully.');
    }

    //This function let the admin edit any client's password, let the guest client edit his password 
    public function updatePassword(Request $request, client $client, user $user){
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
        // $user->password = $request->input('new_password');
        return redirect()->route('home')->withSuccess('Client updated successfully.');
    }

    //This function let the admin delete any clients
    public function destroy(client $client, User $user){
        $client->delete();
       // $user-> delete();
        return redirect('/Clients')->withSuccess('Client deleted successfully.');

    }
    

}
