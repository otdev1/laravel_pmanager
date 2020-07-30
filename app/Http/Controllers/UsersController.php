<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::check() ){    
            $users = User::all();

            return view('users.index', ['users'=> $users]);  
        }
        return view('auth.autologin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = User::find($user->id);

        $role = Role::find($user->role_id);

        return view('users.show', ['user' => $user, 'role' => $role]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit', ['user' => $user, 'roles' => $roles]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $userUpdate = User::where('id', $user->id)
                                  ->update([
                                        'name'=> $request->input('name'), 
                                        'first_name'=> $request->input('fname'), 
                                        'last_name'=> $request->input('lname'),
                                        'role_id' => $request->input('role_id'),
                                        'email'=> $request->input('email'),
                                    ]);

        if($userUpdate){
            return redirect()->route('users.show',['user' => $user->id]) 
            ->with('success','user updated successfully');
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $findUser = User::find( $request->input('uid'));
        
		if($findUser->delete()){

            return redirect()->route('users.index') 
            ->with('success' , 'Profile deleted');
        }

        return back()->withInput()->with('error','Company could not be deleted');
    }

    public function showChangePasswordForm($user_id)
    {
        return view('users.changepassword',['user_id' => $user_id]);
    }

    public function changepassword(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if( !(Hash::check($request->input('current-password'), $user->password)) ){
           
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if( strcmp( $request->input('current-password'), $request->input('new-password') ) == 0){

            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        $user->password = bcrypt($request->input('new-password'));
        $user->save();

        return redirect()->route('users.show', ['user'=> $user->id])->with('success','Password changed successfully');
    }

    public function guestAdmin()
    {
        $user = User::find('4');

        if(!$user){

            User::create([
                'id' => '4',
                'name' => 'guestadmin',
                'email' => 'guestadmin@pmanager.net',
                'first_name' =>'John',
                'last_name' =>'Doe',
                'role_id' => '1',
                'password' => Hash::make('password'),
            ]);
            
            return back();

        }
        else
        {
            if( Auth::attempt(['email' => $user->email, 'password' => $user->password]) ){
                return redirect()->intended();
            }
        }
        
    }
}
