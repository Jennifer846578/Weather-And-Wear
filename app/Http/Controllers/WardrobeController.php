<?php

namespace App\Http\Controllers;

use App\Models\wardrobe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WardrobeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $session=session('imgpath');
        $who=session('who');
        return view('wardrobe',compact('session','who'));
    }
    public function indexone()
    {
        $id=session('dataid');
        $data=wardrobe::findOrFail($id);
        // $imagepath=$data->imagePath;
        // return $id;
        return view('details',compact('data'));
        // return session('dataid');
        // return view('details');
    }

    public function indextwob(Request $request)
    {
        $data=wardrobe::findOrFail($request->id);
        $data->color=$request->color;
        $data->save();
        // $imagepath=$data->imagePath;
        return view('detailsBottom',compact('data'));
        // return $request->color;
    }
    public function indextwot(Request $request)
    {
        $data=wardrobe::findOrFail($request->id);
        $data->color=$request->color;
        $data->save();
        // $imagepath=$data->imagePath;
        return view('detailsTop',compact('data'));
        // return $data;
    }
    public function indexthree(Request $request)
    {
        $data=wardrobe::findOrFail($request->id);
        $data->category=$request->category;
        $data->save();
        return view('detailsStyle',compact('data'));
    }

    public function indexfour(Request $request)
    {
        $data=wardrobe::findOrFail($request->id);
        $data->style=$request->style;
        $data->save();
        return view('wardrobe');
    }

    public function showBlazer()
    {
        $results=wardrobe::where('userid',Auth::user()->id)->get();
        return view('blazer',compact('results'));
        // return $results;
    }

    public function favBlazer(Request $request)
    {
        $data=wardrobe::findOrFail($request->id);
        $data->favourite=$request->favourite;
        $data->save();
        return redirect()->route('blazer_fav');
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
        $data=new wardrobe();
        $data->userid=Auth::user()->id;
        $request->validate([
            'image'=>'required|image|mimes:png,jpeg|max:1024'
        ]);
        $imagepath=time().'.'.$request->image->extension();
        $request->image->move(public_path('Asset/Wardrobe/Images'),$imagepath);
        $data->imagePath=$imagepath;
        $data->save();
        return redirect()->route('details_page')->with('dataid',$data->id);
        // return redirect()->route('wardrobe_page')->with('imgpath',$data->imagePath)->with('who',$data->userid);
        // return $imagepath;
    }

    /**
     * Display the specified resource.
     */
    public function show(wardrobe $wardrobe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(wardrobe $wardrobe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, wardrobe $wardrobe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(wardrobe $wardrobe)
    {
        //
    }
}
