<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrainTreeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index($theme_id)
    {
        $token = \Braintree_ClientToken::generate();
        $data = array(
            'token' => $token,
            'theme_id' => $theme_id,
            'user_id' => auth()->id()
        );
        return view('payment')->with($data);
    }

    public function makeCardPayment(Request $request){
        $nonceFromClient = $request->input('payment-method-nonce');
        $result = \Braintree_Transaction::sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $nonceFromClient,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);
        if ($result->success) {
            $data = array(
                'transaction' => $result->transaction,
                'user' => auth()->user(),
                'theme_id' => $request->theme_id,
            );
            return view('successPayment')->with($data);
        } else
            return view('failPayment');
    }

    public function makePaypalPayment(Request $request){
        $nonceFromClient = $request->nonce;
        $result = \Braintree_Transaction::sale([
            "amount" => '10.00',
            "paymentMethodNonce" => $nonceFromClient,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);
        if ($result->success) {
            $data = array(
                'transaction' => $result->transaction,
                'user' => auth()->user(),
                'theme_id' => $request->theme_id,
            );
            return view('successPayment')->with($data);
        } else
            return view('failPayment');

    }

}

