<?php

namespace App\Http\Controllers;

use App\Models\wardrobe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

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

    public function UndoAddWardrobe(Request $request)
    {
        $data=wardrobe::findOrFail($request->id);
        $imagepath=public_path('Asset/Wardrobe/Images/'.$data->imagePath);
        if(File::exists($imagepath)){
            File::delete($imagepath);
        }
        $data->delete();
        return redirect()->route('wardrobe_page');

    }
    public function indexone()
    {
        $id=session('dataid');
        $dominantColor = session('dominantColor', '#FFFFFF'); // Default ke putih jika tidak ada
        $data=wardrobe::findOrFail($id);
        // $imagepath=$data->imagePath;
        // return $id;
        // dd($data->imagePath, $dominantColor);
        return view('details',compact('data', 'dominantColor'));
        // return session('dataid');
        // return view('details');
    }

    public function backToIndexOne(Request $request){
        $data=wardrobe::findOrFail($request->id);
        return view('details',compact('data'));
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

    public function indextwobret(Request $request)
    {
        $data=wardrobe::findOrFail($request->id);
        return view('detailsBottom',compact('data'));
    }

    public function indextwotret(Request $request)
    {
        $data=wardrobe::findOrFail($request->id);
        return view('detailsTop',compact('data'));
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
        $notification="yes";
        return view('wardrobe',compact('notification'));
    }

    public function showWardrobe()
    {
        return view('wardrobe');
    }

    public function showWardrobeCategory($category,$favourite,$style,$editted)
    {
        // $results=wardrobe::where('userid',Auth::user()->id)->get();
        // $result=wardrobe::where('userid',Auth::user()->id)->where('category',$category);
        if($favourite==='no'){
            if($style!=="All"){
                $results=wardrobe::where('userid',Auth::user()->id)->where('category',$category)->where('style',$style)->get();
            }else{

                $results=wardrobe::where('userid',Auth::user()->id)->where('category',$category)->get();
            }
        }else{
            if($style==="All"){
                $results=wardrobe::where('userid',Auth::user()->id)->where('category',$category)->where('favourite','yes')->get();
            }else{
                $results=wardrobe::where('userid',Auth::user()->id)->where('category',$category)->where('favourite','yes')->where('style',$style)->get();
            }
        }
        // return $editted.$style.$category.$favourite;
        return view('blazer',compact('results','favourite','category','style','editted'));
        // return $category.$favourite.$style;
        // return $style;
        // return view('blazer',compact('results','category','favourite','style'));

        // return $category;
    }

    public function favWardrobe(Request $request)
    {
        $data=wardrobe::findOrFail($request->id);
        $data->favourite=$request->favouriteValue;
        $data->save();
        return redirect()->route('wardrobe_page_category',['category'=>$data->category,'style'=>$request->style,'favourite'=>$request->favourite,'editted'=>'no']);
        // return $data->category;
    }

    public function deleteWardrobeClothes(Request $request)
    {
        $data=wardrobe::findOrFail($request->id);
        $imagepath=public_path('Asset/Wardrobe/Images/'.$data->imagePath);
        if(File::exists($imagepath)){
            File::delete($imagepath);
        }
        $dataCopy=wardrobe::findOrFail($request->idCopy);
        if($data->imagePath!==$dataCopy->imagePath){
            $imagepaths=public_path('Asset/Wardrobe/Images/'.$dataCopy->imagePath);
            if(File::exists($imagepaths)){
                File::delete($imagepaths);
            }
        }
        $dataCopy->delete();
        $category=$data->category;
        $data->delete();
        return redirect()->route('wardrobe_page_category',['category'=>$data->category,'style'=>$request->style,'favourite'=>$request->favourite,'editted'=>'no']);
    }

    public function editWardrobeOne(Request $request)
    {
        $favourite=$request->favourite;
        $style=$request->style;
        $data=wardrobe::findOrFail($request->id);
        $dataCopy=new wardrobe();
        $dataCopy->userid=$data->userid;
        $dataCopy->style="Copy of id ".$data->id;
        $dataCopy->imagePath=$data->imagePath;
        $dataCopy->category=$data->category;
        $dataCopy->color=$data->color;
        $dataCopy->favourite=$data->favourite;
        $dataCopy->save();
        return view('editClothes',compact('data','dataCopy','favourite','style'));
        // return $data;
    }

    public function GetEditWardrobeOne(Request $request)
    {
        $favourite=$request->favourite;
        $style=$request->style;
        $data=wardrobe::findOrFail($request->id);
        $dataCopy=wardrobe::findOrFail($request->idCopy);
        return view('editClothes',compact('data','dataCopy','favourite','style'));
    }

    public function deleteEditWardrobe(Request $request)
    {
        $data=wardrobe::findOrFail($request->id);
        $dataCopy=wardrobe::findOrFail($request->idCopy);
        if($data->imagePath!==$dataCopy->imagePath){
            $imagepath=public_path('Asset/Wardrobe/Images/'.$dataCopy->imagePath);
            if(File::exists($imagepath)){
                File::delete($imagepath);
            }
        }
        $dataCopy->delete();
        return redirect()->route('wardrobe_page_category',['category'=>$data->category,'style'=>$request->style,'favourite'=>$request->favourite,'editted'=>'no']);
    }

    // public function ChangeWardrobeImage(Request $request)
    // {
    //     $data=wardrobe::findOrFail($request->id);
    //     $request->validate([
    //         'image'=>'required|image|mimes:png,jpeg|max:1024'
    //     ]);
    //     $imagepath=time().'.'.$request->image->extension();
    //     $request->image->move(public_path('Asset/Wardrobe/Images'),$imagepath);
    //     $data->imagePath=$imagepath;
    //     $data->save();
    //     return redirect()->route('editClothes_page_get')->with('data',$data);
    // }

    // public function editWardrobeGet()
    // {
    //     $data=session('data');
    //     return view('editClothes',compact('data'));
    // }

    public function editClothesTopBottomPage(Request $request)
    {
        $favourite=$request->favourite;
        $style=$request->style;
        $data=wardrobe::findOrFail($request->id);
        $dataCopy=wardrobe::findOrFail($request->idCopy);
        $dataCopy->color=$request->color;



        // $data=wardrobe::findOrFail($request->id);
        // if($request->top==="top"){
        //     return view('editTopClothes',compact('data'));
        // }{
        //     return view('editBottomClothes',compact('data'));
        // }
        if($request->image===null){
            $dataCopy->imagePath=$data->imagePath;
        }else{
            $request->validate([
                'image'=>'required|image|mimes:png,jpeg|max:131072'
            ]);
            $imagepath=time().'.'.$request->image->extension();
            $request->image->move(public_path('Asset/Wardrobe/Images'),$imagepath);
            $dataCopy->imagePath=$imagepath;
        }
        $dataCopy->save();
        // $data->save();
        if($request->option==="top"){
            // return $dataCopy."Top ini mang".$data;
            return view('editTopClothes',compact('data','dataCopy','favourite','style'));
        }else{
            return view('editBottomClothes',compact('data','dataCopy','favourite','style'));
        }
        // return $datas.$data;

    }

    public function editClothesTopBottomReturnPage(Request $request)
    {
        $style=$request->style;
        $favourite=$request->favourite;
        $data=wardrobe::findOrFail($request->id);
        $dataCopy=wardrobe::findOrFail($request->idCopy);
        $BotCategories=['Cargo','Jeans','Jogger','Legging','Shorts','Skirt','Trousers'];
        if(in_array($dataCopy->category,$BotCategories)){
            return view('editBottomClothes',compact('data','dataCopy','favourite','style'));
        }else{
            return view('editTopClothes',compact('data','dataCopy','favourite','style'));
        }
    }

    public function EditClothesCategory(Request $request)
    {
        $favourite=$request->favourite;
        $style=$request->style;
        // $data=wardrobe::findOrFail($request->id);
        // $data->category=$request->category;
        // $data->save();
        // return view('editStyleClothes',compact('data'));
        $dataCopy=wardrobe::findOrFail($request->idCopy);
        $dataCopy->category=$request->category;
        $dataCopy->save();
        $data=wardrobe::findOrFail($request->id);
        return view('editStyleClothes',compact('data','dataCopy','favourite','style'));
        // return $dataCopy;
        // return $request;
    }

    public function EditClothesStyle(Request $request)
    {
        $style=$request->style;
        $favourite=$request->favourite;
        $dataCopy=wardrobe::findOrFail($request->idCopy);
        $data=wardrobe::findOrFail($request->id);
        $category=$data->category;
        if($data->imagePath!==$dataCopy->imagePath){
            $imagepath=public_path('Asset/Wardrobe/Images/'.$data->imagePath);
            if(File::exists($imagepath)){
                File::delete($imagepath);
            }
        }
        $data->imagePath=$dataCopy->imagePath;
        $data->color=$dataCopy->color;
        $data->category=$dataCopy->category;
        $data->style=$request->style;
        $data->save();
        $dataCopy->delete();
        return redirect()->route('wardrobe_page_category',['category'=>$category,'favourite'=>$favourite,'style'=>$style,'editted'=>'yes']);
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
        $data=new wardrobe();
        $data->userid=Auth::user()->id;
        $request->validate([
            'image'=>'required|image|mimes:png,jpeg|max:131072'
        ]);
        $imagepath=time().'.'.$request->image->extension();
        $originalImagePath = public_path('Asset/Wardrobe/Images/' . $imagepath);
        $request->image->move(public_path('Asset/Wardrobe/Images'),$imagepath);

        // Memanggil API Python untuk menghapus background dan mendeteksi warna dominan
        $client = new Client();
        $response = $client->post('http://127.0.0.1:5000/process-image', [
            'multipart' => [
                [
                    'name' => 'image',
                    'contents' => fopen($originalImagePath, 'r'),
                ],
            ],
        ]);

        $responseData = json_decode($response->getBody(), true);
        $dominantColor = $responseData['dominantColor'] ?? '#FFFFFF';
        $outputImagePath = base_path('flask-api/' . $responseData['imagePath']);

        if (file_exists($outputImagePath)) {
            File::copy($outputImagePath, $originalImagePath);
            // Log::info("✅ File berhasil disalin ke: " . $originalImagePath);
        } else {
            // Log::error("❌ Gambar hasil API tidak ditemukan: " . $outputImagePath);
        }

         // Simpan path gambar dan warna dominan ke database
        $data->imagePath = $imagepath;
        $data->save();

        return redirect()->route('details_page')->with([
            'dataid' => $data->id,
            'dominantColor' => $dominantColor
        ]);
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
