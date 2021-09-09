<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Throwable;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users = User::orderBy('id','desc')->paginate(5);
       //dd($users);
       return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('name','desc')->get();
        $roles = Role::orderBy('name')->get();
        return view('admin.user.create', ['users' => $users, 'roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        
        //$user->roles()->sync($request->input('roles', []));

        if($request->file('image')){
            $url = Storage::put('images', $request->file('image'));
            $user->image()->create([
                'url' => $url
            ]);
        }
        if($request->roles){
            $user->roles()->attach($request->roles);
        }
        if($user){
            return redirect('usuario')->with('success', 'Nuevo usuario creado con exito');
        }
        else{
            return redirect('usuario/crear')->with('error', 'Error al crear al usuario');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name','desc')->get();
        return view('admin.user.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $user = User::findOrFail($id);
            $user->update($request->all());
            //$user->update($request->validated());
            if($request->file('image')){
                $url = Storage::put('images', $request->file('image'));

                if($user->image){
                    Storage::delete($user->image->url);
                    $user->image->update([
                        'url' => $url
                    ]);
                }
                else{
                    $user->image()->create([
                        'url' => $url
                    ]);
                }
            }

            if($request->roles){
                $user->roles()->attach($request->roles);
            }
            
            return redirect('usuario')->with('success', 'Usuario actualizado exitosamente');
        }
        catch(Throwable $e){
            return redirect('usuario')->with('error','Error al actualizar al usuario'.$e);
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
        $user = User::findOrFail($id);
        $result = $user->delete();

        if($user->image){
            Storage::delete($user->image->url);
            $user->image->delete();
        }

        if($result){
            return redirect('usuario')->with('success', 'Usuario eliminado exitosamente');
        }
        else{
            return redirect('usuario')->with('error', 'Error al eliminar al usuario');
        }
    }
}
