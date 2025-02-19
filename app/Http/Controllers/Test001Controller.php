<?php

namespace App\Http\Controllers;

use App\Models\test001;
use Illuminate\Http\Request;

class Test001Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $IMAGE=session('IMAGE');
        return view('test001',compact('IMAGE'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'image'=>"required|image|mimes:png,jpeg|max:1024"
        ]);
        $imagePath=time().'.'.$request->image->extension();
        $request->image->move(public_path('Asset/Profile'),$imagePath);
        return redirect()->route('test.index')->with('IMAGE',$imagePath);
    }

    /**
     * Display the specified resource.
     */
    public function show(test001 $test001)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(test001 $test001)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, test001 $test001)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(test001 $test001)
    {
        //
    }
}
