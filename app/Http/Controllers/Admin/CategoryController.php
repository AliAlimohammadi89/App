<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Admin.Category.Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin/Category/Create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        $cover = $request->file('image');
//        if($cover){
//          dd(  $request['image']);
//
//
//        }


//       $p2= Category::create($request->all());


        //   dd($cover,$request);
        $extension = $cover->getClientOriginalExtension()?$cover->getClientOriginalExtension():"";


        $resultCreate = Category::create([
            "title" => $request->title,
            "description" => $request->description,
            "image" => $extension,

        ]);

        if ($cover) {
            $originalImage = $cover;
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path() . '/images/Categories/';
            $thumbnailImage->resize(200, 200);
            $thumbnailImage->save($thumbnailPath . 'Category_' . $resultCreate->id . '.' . $extension);
//            dd($originalImage, $thumbnailImage);
//            $p = Storage::disk('public')->put('/images2/category_' . $resultCreate->id . '.' . $extension, File::get($cover));
            //  dd($request->all());
        }
        return view('Admin.Category.Index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit($categoryID)
    {


        $where = array('id' => $categoryID);
        $items = Category::where($where)->first();

//        return view('Admin/Category.edit', $data);

//        return view('Admin/Category/Edit');


        return view('Admin/Category/Edit', [
            'Category_data' => $items
        ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {


        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',

        ]);
        $cover = $request->file('image');
        $extension = $cover->getClientOriginalExtension()?$cover->getClientOriginalExtension():"";

        $update = ['title' => $request->title, 'description' => $request->description, 'image' =>$extension];
        Category::where('id', $id)->update($update);





        if ($cover) {
            $originalImage = $cover;
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path() . '/images/Categories/';
            $thumbnailImage->resize(200, 200);
            $thumbnailImage->save($thumbnailPath . 'Category_' . $id . '.' . $extension);
//            dd($originalImage, $thumbnailImage);
//            $p = Storage::disk('public')->put('/images2/category_' . $resultCreate->id . '.' . $extension, File::get($cover));
            //  dd($request->all());
        }




        return Redirect::to('Categories')
            ->with('success', 'اطلاعات با موفقیت ثبت شد ');


        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($categoryID)
    {

        $Category = Category::find($categoryID);

        $Category->products()->detach();


        Category::where('id', $categoryID)->delete();


        $thumbnailPath = public_path() . '/images/Categories/' . 'Category_' . $categoryID . '.' . $Category->image;


        File::delete($thumbnailPath);




        return Redirect::to('Categories')
            ->with('success', 'اطلاعات با هذف شد ');
        //
    }
}
