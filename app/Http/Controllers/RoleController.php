<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Model\Log;
use Auth;

class RoleController extends Controller
{

    public function checkPermission() {
        if(auth()->user()->hasRole('admin'))
            return true;
        else
            return false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->checkPermission())
            return redirect('home');

        $role = Role::all();


        return view('admin.role.role_list', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->checkPermission())
            return redirect('home');

        return view('admin.role.role_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->checkPermission())
            return redirect('home');

        $this->validate($request,[ 
            'name' => 'required|string|max:250',
        ]);
        Role::create(['name' => $request->name]);

        Log::create(['module_name'=>'role_create', 'user_id'=>Auth::id()]);

        return redirect()->route('role.index')->with('success','Record Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$this->checkPermission())
            return redirect('home');
        
        $role = Role::findById($id);
        return view('admin.role.role_detail',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$this->checkPermission())
            return redirect('home');

        $role = Role::findById($id);
        return view('admin.role.role_update',compact('role'));
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
        if(!$this->checkPermission())
            return redirect('home');

        $this->validate($request,[ 
            'name' => 'required|string|max:250',
        ]);
        Role::findById($id)->update($request->all());

        Log::create(['module_name'=>'role_update', 'user_id'=>Auth::id()]);

        return redirect()->route('role.index')->with('success','Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->checkPermission())
            return redirect('home');
        
        Role::findById($id)->delete();

        Log::create(['module_name'=>'role_delete', 'user_id'=>Auth::id()]);

        return redirect()->route('role.index')->with('success','Record Deleted Successfully');
    }
}
