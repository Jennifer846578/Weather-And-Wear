<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;


class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('profile');
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
        // $request->validate([
        //     'profile_image' => 'image|mimes:png,jpg|max:4098',
        // ]);

        //
        $data=User::find($id);
        $data->gender=$request->gender;
        $data->name=$request->name;
        // if($request->profileimage !=  NULL){
            
        // }
        $request->validate([
            'profileimage'=>"image|mimes:png,jpeg|max:1024"
        ]);
        // return $data->profileimage.$request->profileimage;
        if($request->profileimage!=NULL && $data->profileimage!=$request->profileimage ){
            if($data->profileimage!='noprofile.png'){
                if(file_exists(public_path('Asset/Profile/'.$data->profileimage))){
                    File::delete(public_path('Asset/Profile/'.$data->profileimage));
                };
            }
            $imagePath=time().'.'.$request->profileimage->extension();
            $request->profileimage->move(public_path('Asset/Profile'),$imagePath);
            $data->profileimage=$imagePath;
        }
        
        
        // if(file_exists(public_path('Asset\Profile'.$data->profileimage))){
        //     File::delete(public_path('Asset/Profile/'.$data->profileimage));
        // }

        // $profileimagename = now().'.'.$request->file('profileimage')->getClientOriginalExtension();
        // $request->file('profileimage')->move(public_path('Asset/Profile'), $profileimagename);
        // $data->profileimage = $profileimagename;

        $data->save();
        return redirect()->route('profile_page');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
