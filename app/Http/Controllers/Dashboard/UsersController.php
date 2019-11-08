<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create_users')->only('create');
        $this->middleware('permission:read_users')->only('index');
        $this->middleware('permission:update_users')->only('edit');
        $this->middleware('permission:delete_users')->only('destroy');
    } // end of construct

    public function index(Request $request)
    {

        $users = User::whereRoleIs('admin')
            ->where(function ($q) use ($request) {

                return $q->when($request->search, function ($query) use ($request) {

                    return $query->where('first_name', 'like', '%' . $request->search . '%')
                        ->orWhere('last_name', 'like', '%' . $request->search . '%');
                });
            })->latest()->paginate(10);

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

        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);

        if ($request->image) {
            $img = Image::make($request->image);
            // resize the image to a width of 300 and constrain aspect ratio (auto height)
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            // save image
            $img->save(public_path('uploads/images/users/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        } // end if image

        $user = User::create($request_data);
        $user->attachRole('admin');

        if ($request->permissions) {
            $user->syncPermissions($request->permissions);
        }

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

        if ($request->permissions) {
            $user->syncPermissions($request->permissions);
        }

        session()->flash('success', \Lang::get('site.updated_successfully'));

        return \redirect()->route('dashboard.users.index');
    } // end of update

    public function destroy(User $user)
    {
        if ($user->image != 'default.png') {
            \Storage::disk('public_uploads')->delete('/images/users/' . $user->image);
        }
        $user->delete();

        session()->flash('success', \Lang::get('site.deleted_successfully'));

        return \redirect()->route('dashboard.users.index');
    } // end of destroy
}
