<?php

namespace App\Http\Controllers;

use App\Model\OrderMaster;
use App\Model\OrderItems;
use App\Model\ProductMaster;
use App\User;
use App\Model\Log;
use Auth;
use Illuminate\Http\Request;
use Response;

class OrderMasterController extends Controller
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
        $count = 0;

        $product = ProductMaster::all();

        $order_master = OrderMaster::all();

        $order = OrderMaster::with('user')->get();

        $items = OrderMaster::with('product_masters')->get();
        foreach ($items as $key) 
        {
            $items_availability[$count] = $key;
            $count++;
        }

        return view('admin.order.order_list', compact('order', 'product', 'order_master','items_availability'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = ProductMaster::all();
        
        return view('admin.order.order_create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[  
            'title' => 'required|string|max:250',
            'discount' => 'required|int',
            'purchase_unit' => 'required|int',
            'status' => 'required',
        ]);
        $order_master = OrderMaster::create($request->all());

        $product = ProductMaster::all();
        $order = OrderMaster::with('user')->get();

        Log::create(['module_name'=>'order_create', 'user_id'=>Auth::id()]);
        
        // return view('admin.order.order_item', compact('order_master', 'order', 'product'));
        
        // $order_id = Response::json($order);
        
        // return view('admin.order.order_list', compact('order_id', 'product', 'order')); 
        
        return redirect()->route('order.index')->with('success','Order Updated Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = OrderMaster::with('user')->find($id);
        $item = OrderMaster::with('product_masters')->find($id);

        return Response::json([$order, $item]);

        // return view('admin.order.order_detail',compact('order', 'item'));
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

        $order = OrderMaster::find($id);

        return Response::json($order);
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
            'discount' => 'required|int',
            'purchase_unit' => 'required|int',
            'status' => 'required',
        ]);

        OrderMaster::find($request->order_id)->update($request->all());

        Log::create(['module_name'=>'order_update', 'user_id'=>Auth::id()]);

        return redirect()->route('order.index')->with('success','Order Updated Successfully');
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

        OrderMaster::find($request->order_id)->delete();

        Log::create(['module_name'=>'order_delete', 'user_id'=>Auth::id()]);

        return redirect()->route('order.index')->with('success','Order Deleted Successfully');
    }

    public function cart(Request $request)
    {
        if(!$this->checkPermission())
            return redirect('home');
        
        $order = OrderMaster::find($request->order_master_id);

        $order->product_masters()->detach();

        for($i = 0; $i < count($request->product_master_id); $i++)
        {
            $order->product_masters()->attach($request->product_master_id[$i], ['discount'=> $request->discount, 'discount_unit'=> $request->discount_unit]);
        
        }
        return redirect()->route('order.index')->with('success','Order Created Successfully');
    }

}
