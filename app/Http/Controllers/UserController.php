<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withTrashed()->get();
        return view("pages.users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = \Spatie\Permission\Models\Role::all();
        return view("pages.users.create", compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        unset($input['avatar']);
        unset($input['role']);
        $input['password'] = bcrypt($input['password']);
        
        try {          

            DB::beginTransaction();
            
            $user = User::create($input);
            $user->assignRole($request->role);

            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $fileName = time() . 'avatar_'.$user->id.'.'.$avatar->getClientOriginalExtension();                
                $avatar->storeAs('public/avatars', $fileName);                
                $user->avatar = "avatars/". $fileName;
                $user->save();
            }

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');

        }catch(Exception $ex) {
            DB::rollBack();
            if (isset($fileName)) {
                Storage::delete('public/avatars/'.$fileName);
            }
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user  = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }

        $roles = \Spatie\Permission\Models\Role::all();
        return view("pages.users.edit", compact("user", "roles"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $oldUser = User::find($id);

        if (!$oldUser) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }

        $input = $request->all();
        unset($input['avatar']);
        unset($input['role']);

        if ($request->password) {
            $input['password'] = bcrypt($input['password']);
        } else {
            unset($input['password']);
        }

        $oldFileName = $oldUser->avatar;

        try {

            DB::beginTransaction();

            $oldUser->update($input);
            $oldUser->syncRoles($request->role);

            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $fileName = time() . $oldUser->id.'.'.$avatar->getClientOriginalExtension();                
                $avatar->storeAs('public/avatars', $fileName);                
                $oldUser->avatar = "avatars/". $fileName;
                $oldUser->save();

                if ($oldFileName) {
                    Storage::delete('public/'.$oldFileName);
                }
            }

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
        }
        catch(Exception $ex) {
            DB::rollBack();
            if (isset($fileName)) {
                Storage::delete('public/avatars/'.$fileName);
            }
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }

        try {

            DB::beginTransaction();
            if ($user->deleted_at) {
                $user->restore();
                DB::commit();
                return redirect()->route('users.index')->with('success', 'Usuario restaurado correctamente');

            } else {
                $user->delete();
                DB::commit();
                return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
            }            
        }
        catch(Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
