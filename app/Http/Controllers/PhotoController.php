<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PhotoStoreRequest;
use App\Models\Category;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photo = Photo::all();
        $cate = Category::all();
        return view('admin.photoList', ['title' => 'Photo', 'photo' => $photo, 'cate' => $cate]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->hasFile('photo_render'));
        try{
            if($request->hasFile('photo_render')){
                $photo = $request->file('photo_render');
                $imageName = Str::random(32) . "." . $photo->getClientOriginalExtension();
    
                Storage::disk('public')->putFileAs('gallery', $photo,$imageName);
            }
    
           Photo::create([
            'photo_render' => $imageName,
            'photo_alt' => $request->photo_alt,
            'photo_order' => $request->photo_order,
            'id_category' => $request->category_id,
           ]);
            return redirect()->back();

        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went teribbly wrong sowwy');
        }
    }

    /**
     * Display the specified resource.
     */


    public function update(Request $request, $id)
    {
        try {
            $photo = Photo::findOrFail($id);

            // Update photo fields
            $photo->update([
                'id_category' => $request->input('category_id', $photo->id_category),
                'photo_alt' => $request->input('photo_alt', $photo->photo_alt),
                'photo_order' => $request->input('photo_order', $photo->photo_order),
            ]);

            // Handle image upload
            if ($request->hasFile('photo_render')) {
                // Delete old image
                Storage::disk('public')->delete('/gallery//' . $photo->photo_render);

                // Store new image
                $imageName = Str::random(32) . '.' . $request->file('photo_render')->getClientOriginalExtension();
                $request->file('photo_render')->storeAs('gallery', $imageName, 'public');

                // Update image path in the database
                $photo->update(['photo_render' => $imageName]);
            }

            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went teribbly wrong sowwy');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $filePath = "/gallery//".$photo->photo_render;
        // Delete the old file if it exists
        if ($photo->photo_render && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }


        // Delete the photo record from the database
        $photo->delete();

        return redirect()->back();
    }
}
