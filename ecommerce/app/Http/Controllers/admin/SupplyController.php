<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Image;
use AdminHelper;
use URL;
use App\Models\Supplier;
use Illuminate\Support\Facades\Redirect;

class SupplyController extends Controller
{
    

    public function index()
    { 
        $data['main'] = 'Suppliyer';
        $data['active'] = 'All Suppliyer';
        $data['title'] = '  '; 
        $data['supliyers']= Supplier::latest()->get();
        return view('admin.supply.index',$data);
    } 
     
    public function create()
    { 
        $data['main'] = 'Categories';
        $data['active'] = 'All Categories';
        $data['title'] = '  ';
      
        return view('admin.supply.create', $data); 
    }
 
    public function store(Request $request)
    {
       
        $result = Supplier::create($request->all());
  
        if ($result) {
            return redirect('admin/supply')
                ->with('success', 'created successfully.');
        } else {
            return redirect('admin/supply')
                ->with('error', 'No successfully.');
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
         

        $data['supply']=Supplier::where('id',$id)->first();
        $data['main'] = 'Zone';
        $data['active'] = 'Update supply';
        $data['title'] = 'Update Zone Information';        
        return view('admin.supply.edit', $data);
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
        $result=  Supplier::find($id)->update($request->all());

        if ($result) {
            return redirect('admin/supply')
                ->with('success', 'Updated successfully.');
        } else {
            return redirect('admin/supply')
                ->with('error', 'No successfully.');
        }
    }
  

}
