<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Order;
use App\Product;
use App\OrderProduct;
use Cartalyst\Stripe\Exception\CardErrorException;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        try{

            $contents = Cart::content()->map(function ($item){
                return $item->model->slug . ', ' .$item->qty;
            })->values()->toJson();


            $charge =  Stripe::charges()->create([
                    'amount' => Cart::total() / 100 ,
                    'currency' => 'EGP' ,
                    'source' => $request->stripeToken,
                    'description' => 'nothing',
                    'receipt_email' => $request->email ,
                    'metadata' => [
                        'contents' => $contents,
                        'quantity' => Cart::instance('default')->count(),
                    ],
                ]);

            $this->addToOrdersTables($request,null);
            Cart::instance('default')->destroy();
            return redirect()->route('confirmation.index')->with('success_message' ,'Thank You , Your order is confirmed and shipped now' );

        }catch(CardErrorException $e){
            $this->addToOrdersTables($request,$e->getMessage());
            return back()->withErrors('Error ' .$e->getMessage());
        }
    }

    protected function addToOrdersTables($request,$error){
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : 2,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_subtotal' => $this->getNumbers()->get('newSubtotal'),
            'billing_total' => $this->getNumbers()->get('newTotal'),
            'error' => $error,
        ]);

        foreach (Cart::content() as $item){
            OrderProduct::create([
                'order_id'=> $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

    }

    private function getNumbers()
    {

        $newSubtotal = (Cart::subtotal() / 100);
        $newTotal = $newSubtotal;
        return collect([
            'newSubtotal' => $newSubtotal,
            'newTotal' => $newTotal,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
