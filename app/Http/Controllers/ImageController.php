<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Anakadote\ImageManager\Facades\ImageManager;
use App\Models\gallary_images;
class ImageController extends Controller
{
    public function store(Request $request) { 

        $request->validate([
            'image' => ['required', 'mimes:jpg,png,jpeg'],
            'category'=> ['required'],
            'caption'=>['required','max:255']
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_name = rand(1000,9999).time().'.'.$file->extension();
            $request->image->move(public_path('img'), $image_name);    

            
        } 
        gallary_images::create([
            "user_id" =>auth()->user()->id,
            "caption"=>$request->caption,
            "category"=>$request->category,
            "image" => $image_name
        ]);
         return redirect()->back()->with('success',"image Uploaded");
               
    }

    public function delete($id)
    {
        $image = gallary_images::findOrFail($id);
        $user=auth()->user()->id;
        if($image->user_id != $user){
            return abort(403);
        }
        $file_path = public_path('/img/'.$image->image);
        if(\File::exists($file_path)){
            \File::delete($file_path);
        }
        gallary_images::destroy($id);
        return redirect()->back()->with('success',"image Deleted");
 
    }

}
