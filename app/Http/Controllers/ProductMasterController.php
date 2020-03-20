<?php

namespace App\Http\Controllers;

use App\Model\ProductMaster;
use App\Model\ProductCategory;
use App\Model\Log;
use App\User;
use App\Model\Unit;
use Auth;
use Response;

use Illuminate\Http\Request;

class ProductMasterController extends Controller
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
        $unit = Unit::with('products')->get();

        $unit_name = [];
        foreach($unit as $units){
            $unit_name[$units->id] = $units->name;
        }

        $category = ProductCategory::with('product_master')->get();

        $category_name = [];
        foreach($category as $categories){
            $category_name[$categories->id] = $categories->title;
        }

        $product = ProductMaster::all();
        return view('admin.product.product_list', compact('product', 'category_name', 'unit_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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

        $this->validate($request, [ 
            'title' => 'required|string|max:250',
            'product_category_id' => 'required',
            'unit_id' => 'required', 
            'inventory_val' => 'required',
            'price' => 'required|int',
            'discount' => 'required|int',
            'threshold' => 'required',
            'status' => 'required',
            // 'created_by' => 'required',            
            'short_desc' => 'required|string|max:250',
            // 'long_desc' => 'required|string',
        ]);
                
        $product = ProductMaster::create([
            'title'=>$request->title, 
            'product_category_id' => $request->product_category_id,
            'unit_id' => $request->unit_id, 
            'inventory_val' => $request->inventory_val,
            'price' => $request->price,
            'discount' => $request->discount,
            'threshold' => $request->threshold,
            'status' => $request->status,
            'created_by' => Auth::id(),            
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
        ]);

        Log::create(['module_name'=>'product_create', 'user_id'=>Auth::id()]);

        return redirect()->route('product.index')->with('success','Record Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = ProductMaster::find($id);
        return Response::json($product);
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
        
        $product = ProductMaster::find($id);
        return Response::json($product);
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
            'title' => 'required|string|max:250',
            'product_category_id' => 'required',
            'unit_id' => 'required', 
            'inventory_val' => 'required',
            'price' => 'required|int',
            'discount' => 'required|int',
            'threshold' => 'required',
            'status' => 'required',
            // 'created_by' => 'required',            
            'short_desc' => 'required|string|max:250',
            // 'long_desc' => 'required|string',
        ]);

        ProductMaster::find($request->product_id)->update([
            'title'=>$request->title, 
            'product_category_id' => $request->product_category_id,
            'unit_id' => $request->unit_id, 
            'inventory_val' => $request->inventory_val,
            'price' => $request->price,
            'discount' => $request->discount,
            'threshold' => $request->threshold,
            'status' => $request->status,
            'modified_by' => Auth::id(),            
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
        ]);

        Log::create(['module_name'=>'product_update', 'user_id'=>Auth::id()]);

        return redirect()->route('product.index')->with('success','Record Updated Successfully');
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
    
        ProductMaster::find($request->product_id)->delete();

        Log::create(['module_name'=>'product_delete', 'user_id'=>Auth::id()]);

        return redirect()->route('product.index')->with('success','Record Deleted Successfully');

    }
 
}
