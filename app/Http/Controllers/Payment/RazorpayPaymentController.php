<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;

class RazorpayPaymentController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('content.payment.payment');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $input = $request->all();

        // $api = new Api({{env("ROZO_API_KEY")}}, {{env("ROZO_SECRET_KEY")}});
        $api = new Api("rzp_test_KPvuflmxXQPkmk", "VBosmsMvKGboKGeodlwZfBcd");


        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        // dd($payment);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));

            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }

        Session::put('success', 'Payment successful');
        return redirect()->route('dashboard-analytics');
    }
}
