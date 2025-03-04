<?php

namespace App\Http\Controllers;

use App\Models\wardrobe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        
        $clothes=wardrobe::where('userid',Auth::user()->id)->get();
        $jsonData = json_encode($clothes);
        $encodedJson = base64_encode($jsonData);

        $scriptPath = base_path('scripts/Generator.py');
        $command = "python $scriptPath $encodedJson $request->weather $request->style 2>&1";
        $output = shell_exec($command);
        return $output;
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
