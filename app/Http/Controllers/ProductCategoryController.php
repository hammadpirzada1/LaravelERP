<?php

namespace App\Http\Controllers;

use App\Model\ProductCategory;
use App\Model\Log;
use Illuminate\Http\Request;

use Auth;
use Response;

class ProductCategoryController extends Controller
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
        $category = ProductCategory::all();
        return view('admin.category.category_list', compact('category')); 
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

        return view('admin.category.category_create');
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
            'title' => 'required'
        ]);
        
        ProductCategory::create($request->all());

        Log::create(['module_name'=>'category_create', 'user_id'=>Auth::id()]);

        return redirect()->route('category.index')->with('success','Record Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = ProductCategory::find($id);
        return Response::json($category);
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

        $category = ProductCategory::find($id);
        return Response::json($category);
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
            'title' => 'required' 
        ]);

        ProductCategory::find($request->category_id)->update($request->all());

        Log::create(['module_name'=>'category_update', 'user_id'=>Auth::id()]);
        
        return redirect()->route('category.index')->with('success','Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if(!$this->checkPermission())
            return redirect('home');
        
        
        $category = ProductCategory::find($request->category_id)->delete();

        Log::create(['module_name'=>'category_delete', 'user_id'=>Auth::id()]);

        return redirect()->route('category.index')->with('success','Record Deleted Successfully');
    }
}
