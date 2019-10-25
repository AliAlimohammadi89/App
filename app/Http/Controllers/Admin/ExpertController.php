<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Expert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Expert.Index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Expert.Create');
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
//         unset($request->all('product'));\
        $products = $request->input('product');
//
//        unset($request['product']);
//        // dd($products,$request->all());
//
//
//
//
//
//
//        $Expert = Expert::create($request->all());
//
//        dd($Expert);
//
//
//        $Expert->products()->attach($products);


        $cover = $request->file('image');
//        if($cover){
//          dd(  $request['image']);
//
//
//        }


//       $p2= product::create($request->all());


        //  dd($cover,$request);
        $extension = $cover->getClientOriginalExtension() ? $cover->getClientOriginalExtension() : "";


        $resultCreate = Expert::create([
            "title" => $request->title,
            "description" => $request->description,
            "image" => $extension,
            "price" => $request->price

        ]);

        $resultCreate->products()->attach($products);


        if ($cover) {
            $originalImage = $cover;
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path() . '/images/Experts/';
            $thumbnailImage->resize(200, 200);
            $thumbnailImage->save($thumbnailPath . 'Expert_' . $resultCreate->id . '.' . $extension);
//            dd($originalImage, $thumbnailImage);
//            $p = Storage::disk('public')->put('/images2/product_' . $resultCreate->id . '.' . $extension, File::get($cover));
            //  dd($request->all());
        }


        // return redirect(Route('Expert'));
        return Redirect::to('Experts')
            ->with('success', 'اطلاعات با موفقیت ثبت شد ');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Expert $Expert
     * @return \Illuminate\Http\Response
     */
    public function show(Expert $Expert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $productID
     * @return \Illuminate\Http\Response
     */
    public function edit($productID)
    {


        $where = array('id' => $productID);
        $items = Expert::where($where)->first();

//        return view('Admin/product.edit', $data);

//        return view('Admin/product/Edit');
//        dd($items);


        return view('Admin/Expert/Edit', [
            'Expert_data' => $items
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Expert $Expert
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',

        ]);

        $products = $request->input('product');

        unset($request['product']);
//          dd($products,$request->all());
//

        $cover = $request->file('image');
        $extension = $cover->getClientOriginalExtension() ? $cover->getClientOriginalExtension() : "";


        $update = ['title' => $request->title, 'description' => $request->description, 'image' => $extension];
        $Expert = Expert::where('id', $id)->update($update);
        $where = array('id' => $id);
        $items = Expert::where($where)->first();
        $items->products()->sync($products);

        //  dd($items);


        if ($cover) {
            $originalImage = $cover;
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path() . '/images/Experts/';
            $thumbnailImage->resize(200, 200);
            $thumbnailImage->save($thumbnailPath . 'Expert_' . $id . '.' . $extension);
//            dd($originalImage, $thumbnailImage);
//            $p = Storage::disk('public')->put('/images2/product_' . $resultCreate->id . '.' . $extension, File::get($cover));
            //  dd($request->all());
        }


        return Redirect::to('Experts')
            ->with('success', 'اطلاعات با موفقیت ثبت شد ');


        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Expert $Expert
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($ExpertId)
    {
        //  $thumbnailPath = 'D:\reeact-native\LaravelReact-native\reactproject\public\images';

        $Expert = Expert::find($ExpertId);

        $Expert->products()->detach();

        $result = Expert::where('id', $ExpertId)->delete();


        $thumbnailPath = public_path() . '/images/Experts/' . 'Expert_' . $ExpertId . '.' . $Expert->image;


        File::delete($thumbnailPath);


//        $resultCreate->products()->attach($products);


        // $result->products()->detach([$productID]);

        //   dd($result);


        return Redirect::to('Experts')
            ->with('success', 'اطلاعات با هذف شد ');
    }
}
