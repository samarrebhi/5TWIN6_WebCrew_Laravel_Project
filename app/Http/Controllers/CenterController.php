<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centers=Center::all();
        return view('Front.Centers.centers',compact('centers'));
    }


    public function showCenters()
    {
        $centers = Center::all(); 
        return view('Back.showcenters', compact('centers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Front.Centers.createCenter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $center=Center::create($request->all());
        $center->save();
        return redirect()->route('centers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $center=center::find($id);
        return view('Front.Centers.show',compact('center'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $center =Center::find($id);
        return view ('Front.Centers.edit',compact('center'));
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
        $center=['name'=>$request->name,
        'description'=>$request->description,
        'address'=>$request->address,
        'phone'=>$request->phone,
        "email"=>$request->email];
        Center::whereId($id)->update($center);
        //$center->save();
        return redirect()->route('centers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $center=Center::find($id);
        $center->delete();
        return redirect()->route('centers.index')
        ->with('success','Center deleted successuflly');

    }
}
