<?php

namespace App\Http\Controllers;

use App\Utils\VeritransPayments;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    protected $veritransPayments;

    /**
     * Create a new controller instance.
     *
     * @param VeritransPayments $payments
     */
    public function __construct(VeritransPayments $payments)
    {
        $this->veritransPayments = $payments;
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

    public function card()
    {
        $order_id = "order_C" . time();
        return view('card.authorize', compact('order_id'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cardPayment(Request $request)
    {

        $data = $request->only("orderId", "amount", "withCapture", "jpo1", "jpo2", "token");
        $data_view = $this->veritransPayments->CreditCardAuthorize($data);
        return view('card.authorize_result',compact('data_view'));
    }
}
