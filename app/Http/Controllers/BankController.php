<?php

namespace App\Http\Controllers;

use App\Utils\VeritransPayments;
use Illuminate\Http\Request;

class BankController extends Controller
{
    protected $payments;

    /**
     * BankController constructor.
     * @param VeritransPayments $payments
     */
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bankAuthorize()
    {
        $order_id = "order_B" . time();
        return view('bank.authorize', compact('order_id'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bankPayment(Request $request)
    {
        $dataReq = $request->only("orderId", "serviceOptionType", "amount",
            "name1", "name2", "kana1", "kana2", "payLimit", "pushUrl", "contents", "contentsKana");
        $dataResponse = $this->payments->BankAuthorize($dataReq);
        return view('bank.authorize_result', compact('dataResponse'));
    }
}
