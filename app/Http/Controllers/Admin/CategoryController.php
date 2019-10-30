<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return view('Admin.Category.Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('Admin/Category/Create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
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
        $extension = $cover->getClientOriginalExtension() ? $cover->getClientOriginalExtension() : "";


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
     * @param Category $category
     * @return Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
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
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {


        $request->validate([
            'title' => 'required',
            'description' => 'required',

        ]);


        if ($request->file('image')) {

//            $cover = $request->file('image');
//            $extension = $request->file('image')->getClientOriginalExtension() ? $cover->getClientOriginalExtension() : "";

            $update = [
                'title' => $request->title,
                'description' => $request->description,
                'image' => $request->file('image')->getClientOriginalExtension(),
            ];

        } else {
            $update = [
                'title' => $request->title,
                'description' => $request->description,

            ];

        }
        Category::where('id', $id)->update($update);


        if ($request->file('image')) {
            $originalImage = $request->file('image');
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path() . '/images/Categories/';
            $thumbnailImage->resize(200, 200);
            $thumbnailImage->save($thumbnailPath . 'Category_' . $id . '.' . $request->file('image')->getClientOriginalExtension());
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
     * @param Category $category
     * @return RedirectResponse
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
