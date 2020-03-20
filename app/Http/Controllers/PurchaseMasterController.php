<?php

namespace App\Http\Controllers;

use App\Model\PurchaseMaster;
use App\Model\Log;
use App\User;
use Illuminate\Http\Request;
use Response;
use Auth;

class PurchaseMasterController extends Controller
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
        $user = User::all();
        
        $user_id = [];
        foreach($user as $users){
            $user_id[$users->id] = $users->id;
        }

        $purchase = PurchaseMaster::all();
        return view('admin.purchase.purchase_list', compact('purchase', 'user_id'));
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

        $this->validate($request,[ 
            'title' => 'required|string|max:250',
            'user_id' => 'required',
            'total_invoice' => 'required|int',
            'discount' => 'required|int',
            'amount_paid' => 'required|int',
            'amount_due' => 'required|int',

        ]);
        
        PurchaseMaster::create($request->all());

        Log::create(['module_name'=>'purchase_create', 'user_id'=>Auth::id()]);

        return redirect()->route('purchase.index')->with('success','Record Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseMaster  $purchaseMaster
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase = PurchaseMaster::find($id);
        return Response::json($purchase);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseMaster  $purchaseMaster
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$this->checkPermission())
            return redirect('home');
        
        $purchase = PurchaseMaster::find($id);
        return Response::json($purchase);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseMaster  $purchaseMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$this->checkPermission())
            return redirect('home');
        
        $this->validate($request,[ 
            'title' => 'required|string|max:250',
            'user_id' => 'required',
            'total_invoice' => 'required|int',
            'discount' => 'required|int',
            'amount_paid' => 'required|int',
            'amount_due' => 'required|int',
        ]);

        PurchaseMaster::find($request->purchase_id)->update($request->all());

        Log::create(['module_name'=>'purchase_update', 'user_id'=>Auth::id()]);
        
        return redirect()->route('purchase.index')->with('success','Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseMaster  $purchaseMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if(!$this->checkPermission())
        return redirect('home');

        PurchaseMaster::find($request->purchase_id)->delete();

        Log::create(['module_name'=>'purchase_delete', 'user_id'=>Auth::id()]);

        return redirect()->route('purchase.index')->with('success','Record Deleted Successfully');
    }
}
