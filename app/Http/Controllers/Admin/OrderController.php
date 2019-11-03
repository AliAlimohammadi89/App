<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('Admin.Order.Index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('Admin.Order.Create');
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
//         unset($request->all('category'));\
        $categories = $request->input('category');
//
//        unset($request['category']);
        $SpecialtyFields = json_encode($request->input('SpecialtyFields'));

        //   dd($categories,$request->all(),$request->input(),$SpecialtyFields);
//
//
//
//
//
//
//        $product = Order::create($request->all());
//
//        dd($product);
//
//
//        $product->categories()->attach($categories);


        $cover = $request->file('image');
//        if($cover){
//          dd(  $request['image']);
//
//
//        }


//       $p2= Category::create($request->all());


        //  dd($cover,$request);
        $extension = $cover->getClientOriginalExtension() ? $cover->getClientOriginalExtension() : "";

        $SpecialtyFields = json_encode($request->input('SpecialtyFields'));
        $resultCreate = Order::create([
            "title" => $request->title,
            "description" => $request->description,
            "image" => $extension,
            "SpecialtyFields" => $SpecialtyFields,


        ]);


        $resultCreate->categories()->attach($categories);
        if ($cover) {
            $originalImage = $cover;
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path() . '/images/Orders/';
            $thumbnailImage->resize(200, 200);
            $thumbnailImage->save($thumbnailPath . 'Order_' . $resultCreate->id . '.' . $extension);
//            dd($originalImage, $thumbnailImage);
//            $p = Storage::disk('public')->put('/images2/category_' . $resultCreate->id . '.' . $extension, File::get($cover));
            //  dd($request->all());
        }


        // return redirect(Route('Order'));
        return Redirect::to('Orders')
            ->with('success', 'اطلاعات با موفقیت ثبت شد ');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Order $product
     * @return Response
     */
    public function show(Order $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $categoryID
     * @return Response
     */
    public function edit($categoryID)
    {


        $where = array('id' => $categoryID);
        $items = Order::where($where)->first();

//        return view('Admin/Category.edit', $data);

//        return view('Admin/Category/Edit');
//        dd($items);


        return view('Admin/Order/Edit', [
            'Order_data' => $items
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order $product
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',

        ]);

        $categories = $request->input('category');

        unset($request['category']);
        // dd($categories,$request->all());
        $SpecialtyFields = json_encode($request->input('SpecialtyFields'));
        if ($request->file('image')) {
            $cover = $request->file('image');

            $update = ['title' => $request->title,
                'description' => $request->description,
                'image' => $cover->getClientOriginalExtension(),
                'SpecialtyFields' => $SpecialtyFields
            ];
        } else {
            $update = ['title' => $request->title,
                'description' => $request->description,
                'SpecialtyFields' => $SpecialtyFields
            ];
        }
        $product = Order::where('id', $id)->update($update);
        $where = array('id' => $id);
        $items = Order::where($where)->first();
        $items->categories()->sync($categories);

        //  dd($items);


        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $originalImage = $request->file('image');
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path() . '/images/Orders/';
            $thumbnailImage->resize(200, 200);
            $thumbnailImage->save($thumbnailPath . 'Order_' . $id . '.' . $extension);
//            dd($originalImage, $thumbnailImage);
//            $p = Storage::disk('public')->put('/images2/category_' . $resultCreate->id . '.' . $extension, File::get($cover));
            //  dd($request->all());
        }


        return Redirect::to('Orders')
            ->with('success', 'اطلاعات با موفقیت ثبت شد ');


        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $product
     * @return RedirectResponse
     */
    public function destroy($productId)
    {
        //  $thumbnailPath = 'D:\reeact-native\LaravelReact-native\reactproject\public\images';

        $Order = Order::find($productId);

        $Order->categories()->detach();

        $result = Order::where('id', $productId)->delete();


        $thumbnailPath = public_path() . '/images/Orders/' . 'Order_' . $productId . '.' . $Order->image;


        File::delete($thumbnailPath);


//        $resultCreate->categories()->attach($categories);


        // $result->categories()->detach([$categoryID]);

        //   dd($result);


        return Redirect::to('Orders')
            ->with('success', 'اطلاعات با هذف شد ');
    }
}
