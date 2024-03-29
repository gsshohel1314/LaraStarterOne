<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.role.index');
        $roles = Role::all();
        return view('backend.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.role.create');
        $modules = Module::all();
        return view('backend.role.form', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.role.create');
        $this->validate($request, [
            'name' => 'required|unique:roles',
            'permissions' =>'required|array',
            'permissions.*' => 'integer'
        ]);

        Role::create([
            'name' => $request->name,
            'slug' =>Str::slug($request->name),
        ])->permissions()->sync($request->input('permissions'), []);
        
        notify()->success("Role Added","Success");
        return redirect()->route('app.role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        Gate::authorize('app.role.edit');
        $modules = Module::all();
        return view('backend.role.form', compact('modules', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        Gate::authorize('app.role.edit');
        $role->update([
            'name' => $request->name,
            'slug' =>Str::slug($request->name)
        ]);
        $role->permissions()->sync($request->input('permissions'));

        notify()->success("Role Updated","Success");
        return redirect()->route('app.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Gate::authorize('app.role.delete');
        if($role->deletable){
            $role->delete();
            notify()->success("Role Deleted","Success");
        }else{
            notify()->error("You can't delete system role","Error");
        }
        return back();
    }
}
