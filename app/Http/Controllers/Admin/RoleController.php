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
use App\Http\Requests\RoleStoreRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->paginate(5);
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        $roles = Role::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        if($request->file('image')){
            $url = Storage::put('images', $request->file('image'));
            $roles->image()->create([
                'url'   => $url
            ]);
        }

        if($roles){
            return redirect('rol')->with('success', 'Rol creado con exito');
        }
        else{
            return redirect('rol/crear')->with('error', 'Error al crear el rol');
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
        $role = Role::findOrFail($id);
        return view('admin.role.edit', compact('role'));
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
            $role = Role::findOrFail($id);
            $role->update($request->all());

            if($request->file('image')){
                $url = Storage::put('images', $request->file('image'));

                if($role->image){
                    Storage::delete($role->image->url);
                    $role->image->update([
                        'url' => $url
                    ]);
                }
                else{
                    $role->image()->create([
                        'url' => $url
                    ]);
                }
            }

            

            return redirect('rol')->with('success', 'Rol actualizdo con exito');
        }
        catch (Throwable $e){
            return redirect('rol')->with('error', 'Error al crear el rol'.$e);
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
        $role = Role::findOrFail($id);
        $result = $role->delete();
        if($result){
            return redirect('rol')->with('success', 'Rol eliminado con exito');
        }
        else{
            return redirect('rol')->with('error', 'Error al eliminar el rol');
        }
    }
}
