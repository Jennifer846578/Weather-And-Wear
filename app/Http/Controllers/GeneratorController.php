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
        // return $request;
        $clothes=wardrobe::where('userid',Auth::user()->id)->get();
        $jsonData = json_encode($clothes);
        $encodedJson = base64_encode($jsonData);
        $scriptPath = base_path('scripts/ModelStyleandWeather/Generator.py');
        $command = "python $scriptPath $encodedJson $request->weather $request->style";
        // return $command;
        $output = shell_exec($command);
        // return $output;
        $decodedOutput = json_decode($output, true);
        $OutersIds=$decodedOutput[0];
        $ShirtsIds=$decodedOutput[1];
        $PantsIds=$decodedOutput[2];
        $outfits=[
            'outers' => [],
            'shirts' => [],
            'pants' => [],
        ];

        $cleanedOuterIds = array_filter($OutersIds, fn($id) => $id !== null);
        $wardrobeOuterItems = Wardrobe::whereIn('id', $cleanedOuterIds)->get()->keyBy('id');
        foreach ($OutersIds as $index => $id) {
            if ($id !== null && isset($wardrobeOuterItems[$id])) {
                $outfits['outers'][$index] = $wardrobeOuterItems[$id]; // Maintain index position
            } else {
                // If ID is null, it remains null (already pre-filled)
                $outfits['outers'][$index] = null;
            }
        }

        $cleanedShirtIds = array_filter($ShirtsIds, fn($id) => $id !== null);
        $wardrobeShirtItems = Wardrobe::whereIn('id', $cleanedShirtIds)->get()->keyBy('id');
        foreach ($ShirtsIds as $index => $id) {
            if ($id !== null && isset($wardrobeShirtItems[$id])) {
                $outfits['shirts'][$index] = $wardrobeShirtItems[$id]; // Maintain index position
            } else {
                // If ID is null, it remains null (already pre-filled)
                $outfits['shirts'][$index] = null;
            }
        }

        $cleanedPantIds = array_filter($PantsIds, fn($id) => $id !== null);
        $wardrobePantItems = Wardrobe::whereIn('id', $cleanedPantIds)->get()->keyBy('id');
        foreach ($PantsIds as $index => $id) {
            if ($id !== null && isset($wardrobePantItems[$id])) {
                $outfits['pants'][$index] = $wardrobePantItems[$id]; // Maintain index position
            } else {
                // If ID is null, it remains null (already pre-filled)
                $outfits['pants'][$index] = null;
            }
        }
        session([
            'Outfits'=>$outfits,
            'PopUp'=>0,
            'History'=>0,
            'Style'=>$request->style,
            'Weather'=>$request->weather
        ]);

        return redirect()->route('home');





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
