<?php

namespace App\Http\Controllers;

use App\Utils\VeritransPayments;
use Illuminate\Http\Request;

class ConvenienceController extends Controller
{
    protected $payments;

    public function __construct(VeritransPayments $payments)
    {
        $this->payments = $payments;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function cvsAuthorize()
    {
        $order_id = "order_CVS" . time();
        return view('cvs.authorize', compact('order_id'));
    }

    /**
     * @param Request $request
     */
    public function cvsPayment(Request $request)
    {
        $dataReq = $request->only("orderId", "serviceOptionType", "amount",
            "name1", "name2", "telNo", "payLimit", "payLimitHhmm", "pushUrl");
        $dataResponse = $this->payments->CvsAuthorize($dataReq['serviceOptionType'], $dataReq['orderId'], $dataReq['amount'],
            $dataReq['name1'], $dataReq['name2'], $dataReq['telNo'], $dataReq['payLimit'], $dataReq['payLimitHhmm'], $dataReq['pushUrl']);
        return view('cvs.authorize_result', compact('dataResponse'));
    }
}
