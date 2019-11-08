<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard.users.index', \compact('users'));
    } // end of index

    public function create()
    {
        return view('dashboard.users.create');
    } // end of create

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'permissions']);
        $request_data['password'] = bcrypt($request->password);

        $user = User::create($request_data);
        $user->syncPermissions($request->permissions);
        $user->attachRole('admin');

        session()->flash('success', \Lang::get('site.added_successfully'));

        return \redirect()->route('dashboard.users.index');
    } // end of store

    public function edit(User $user)
    {
        return view('dashboard.users.edit', \compact('user'));
    } // end of edit

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);


        $request_data = $request->except(['permissions']);
        $user->update($request_data);

        $user->syncPermissions($request->permissions);

        session()->flash('success', \Lang::get('site.updated_successfully'));

        return \redirect()->route('dashboard.users.index');
    } // end of update

    public function destroy(User $user)
    { }
}
