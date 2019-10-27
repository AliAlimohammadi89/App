<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Admin.Customer.Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin/Customer/Create');

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


//       $p2= Customer::create($request->all());


        //   dd($cover,$request);
        $extension = $cover->getClientOriginalExtension() ? $cover->getClientOriginalExtension() : "";


        $resultCreate = Customer::create([

            "First_Name" => $request->First_Name,
            "Last_Name" => $request->Last_Name,
            "Phone_Number" =>  $request->Phone_Number,
            "Address" =>  $request->Address,
            "image" => $extension,

        ]);

        if ($cover) {
            $originalImage = $cover;
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path() . '/images/Customers/';
            $thumbnailImage->resize(200, 200);
            $thumbnailImage->save($thumbnailPath . 'Customer_' . $resultCreate->id . '.' . $extension);
//            dd($originalImage, $thumbnailImage);
//            $p = Storage::disk('public')->put('/images2/customer_' . $resultCreate->id . '.' . $extension, File::get($cover));
            //  dd($request->all());
        }
        return view('Admin.Customer.Index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($customerID)
    {


        $where = array('id' => $customerID);
        $items = Customer::where($where)->first();

//        return view('Admin/Customer.edit', $data);

//        return view('Admin/Customer/Edit');


        return view('Admin/Customer/Edit', [
            'Customer_data' => $items
        ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Customer $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {


        $request->validate([
            'First_Name' => 'required',
            'Last_Name' => 'required',
            'Phone_Number' => 'required',
        ]);
        $cover = $request->file('image');
        $extension = $cover->getClientOriginalExtension() ? $cover->getClientOriginalExtension() : "";

        $update = ['First_Name' => $request->First_Name, 'Last_Name' => $request->Last_Name,'Address' => $request->Address, 'Phone_Number' => $request->Phone_Number, 'image' => $extension];
        Customer::where('id', $id)->update($update);


        if ($cover) {
            $originalImage = $cover;
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path() . '/images/Customers/';
            $thumbnailImage->resize(200, 200);
            $thumbnailImage->save($thumbnailPath . 'Customer_' . $id . '.' . $extension);
//            dd($originalImage, $thumbnailImage);
//            $p = Storage::disk('public')->put('/images2/customer_' . $resultCreate->id . '.' . $extension, File::get($cover));
            //  dd($request->all());
        }


        return Redirect::to('Customers')
            ->with('success', 'اطلاعات با موفقیت ثبت شد ');


        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Customer $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($customerID)
    {

        $Customer = Customer::find($customerID);

//        $Customer->products()->detach();


        Customer::where('id', $customerID)->delete();


        $thumbnailPath = public_path() . '/images/Customers/' . 'Customer_' . $customerID . '.' . $Customer->image;


        File::delete($thumbnailPath);


        return Redirect::to('Customers')
            ->with('success', 'اطلاعات با موفقیت هذف شد ');
        //
    }
}
