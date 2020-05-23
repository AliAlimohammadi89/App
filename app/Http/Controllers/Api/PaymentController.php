<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Payment;
use App\Product;
use Illuminate\Http\Request;
use SoapClient;

class PaymentController extends Controller
{
    protected $MerchantID = 'f83cc956-f59f-11e6-889a-005056a205be'; //Required

    public function payment()
    {
        // validation
        $this->validate(request(), [
            'product_id' => 'required',
        ]);


        $product = Product::findOrFail(request('product_id'));
        $price = $product->price;

        $Description = "خرید $product->title"; // Required
        $Email = auth()->user()->email; // Optional
        $CallbackURL = 'http://192.168.1.100:8000/api/product/buy/callback'; // Required

        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $this->MerchantID,
                'Amount' => $price,
                'Description' => $Description,
                'Email' => $Email,
                'CallbackURL' => $CallbackURL,
            ]
        );

        //Redirect to URL You can do it also by creating a form
        if ($result->Status == 100) {

            auth()->user()->payments()->create([
                'resnumber' => $result->Authority,
                'price' => $price,
                'product_id' => $product->id
            ]);

            return redirect('https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
        } else {
            echo 'ERR: ' . $result->Status;
        }
    }

    public function callback()
    {
        $Authority = request('Authority');

        $payment = Payment::whereResnumber($Authority)->firstOrFail();
        $product = Product::findOrFail($payment->product_id);

        if (request('Status') == 'OK') {
            $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $this->MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $payment->price,
                ]
            );

            if ($result->Status == 100) {
                if ($this->PaymentRegistration($payment)) {
                    return "<div style=''>با تشکر عملیات مورد نظر با موفقیت انجام شد</div> ";
                }
            } else {
                echo 'Transaction failed. Status:' . $result->Status;
            }
        } else {
            echo 'Transaction canceled by user';
        }
    }

    private function PaymentRegistration($payment)
    {
        $payment->update([
            'payment' => 1
        ]);

        return true;
    }
}
