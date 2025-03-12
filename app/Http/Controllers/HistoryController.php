<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\wardrobe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $histories=History::where('userid',Auth::user()->id)->get();
        $outfits=[];
        foreach ($histories as $history){
            $outfit=[];
            if($history->outerid===null){
                array_push($outfit,null);
            }else{
                array_push($outfit,wardrobe::findOrFail($history->outerid));
            }
            array_push($outfit,wardrobe::findOrFail($history->shirtid));
            if($history->pantid===null){
                array_push($outfit,null);
            }else{
                array_push($outfit,wardrobe::findOrFail($history->pantid));
            }
            $historyid=[
                "historyId"=>$history->id,
                "style"=>$history->style,
                "weather"=>$history->weather,
                "dt"=>$history->dt,
                "outfit"=>$outfit,
            ];
            array_push($outfits,$historyid);
        }
        // return view('history');
        return view('history',compact('outfits'));
        
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
        $clothes=wardrobe::where('userid',Auth::user()->id)->get();
        $jsonData = json_encode($clothes);
        $encodedJson = base64_encode($jsonData);
        $data=[
            'weather'=>$request->weather,
            'style'=>$request->style,
            'idOuter'=>intval($request->idOuter),
            'idTop'=>intval($request->idShirt),
            'idPant'=>intval($request->idPant),
            'rate'=>intval($request->rate),

        ];
        $jsonData2 = json_encode($data);
        $encodedJson2 = base64_encode($jsonData2);
        $scriptPath = base_path('scripts/ModelStyleandWeather/UpdateUserData.py');
        $command = "python $scriptPath $encodedJson $encodedJson2 2>&1";
        $output = shell_exec($command);
        //saving the data 
        $data=new History();
        $data->dt=$request->dt;
        $data->weather=$request->weather;
        $data->style=$request->style;
        $data->userid=Auth::user()->id;
        $data->outerid=$request->idOuter;
        $data->shirtid=$request->idShirt;
        $data->pantid=$request->idPant;
        $data->save();
        
        //redirect back to the homepage
        $OutersIds=[intval($request->idOuter)];
        $ShirtsIds=[intval($request->idShirt)];
        $PantsIds=[intval($request->idPant)];
        $outfits=[
            'outers' => [],
            'shirts' => [],
            'pants' => [],
        ];
        
        $cleanedOuterIds = array_filter($OutersIds, fn($id) => $id !== null);
        $wardrobeOuterItems = wardrobe::whereIn('id', $cleanedOuterIds)->get()->keyBy('id');
        foreach ($OutersIds as $index => $id) {
            if ($id !== null && isset($wardrobeOuterItems[$id])) {
                $outfits['outers'][$index] = $wardrobeOuterItems[$id]; // Maintain index position
            } else {
                // If ID is null, it remains null (already pre-filled)
                $outfits['outers'][$index] = null;
            }
        }

        $cleanedShirtIds = array_filter($ShirtsIds, fn($id) => $id !== null);
        $wardrobeShirtItems = wardrobe::whereIn('id', $cleanedShirtIds)->get()->keyBy('id');
        foreach ($ShirtsIds as $index => $id) {
            if ($id !== null && isset($wardrobeShirtItems[$id])) {
                $outfits['shirts'][$index] = $wardrobeShirtItems[$id]; // Maintain index position
            } else {
                // If ID is null, it remains null (already pre-filled)
                $outfits['shirts'][$index] = null;
            }
        }

        $cleanedPantIds = array_filter($PantsIds, fn($id) => $id !== null);
        $wardrobePantItems = wardrobe::whereIn('id', $cleanedPantIds)->get()->keyBy('id');
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
            'History'=>1,
            'PopUp'=>0,
        ]);



        return redirect()->route('home');


    }

    /**
     * Display the specified resource.
     */
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(History $history)
    {
        //
    }
}
