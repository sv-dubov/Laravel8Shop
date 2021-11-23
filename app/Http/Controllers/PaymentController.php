<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use DB;
use Cart;
use Illuminate\Http\Request;
use Session;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $cart = Cart::Content();
        $settings = DB::table('settings')->first();

        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['payment'] = $request->payment;

        if ($request->payment == 'stripe') {
            return view('pages.payment.stripe', compact('data', 'cart', 'settings'));
        } elseif ($request->payment == 'paypal') {
            # code...
        } elseif ($request->payment == 'ideal') {
            # code...
        } else {
            echo "Cash on delivery";
        }
    }

    public function stripeCharge(Request $request)
    {
        $total = $request->total;
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51JxBBQIbU4kXLV49WBmT2H1NZPvIz2jewJwJ81LW6UnVi2xMwEQD5kjHnPbIaDcw2BOJkEXHHlxADvsWC2iJnkl900SxtEBP06');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
            'amount' => $total * 100,
            'currency' => 'usd',
            'description' => 'Gastronom Rivne details',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);

        $data = array();
        $data['user_id'] = Auth::id();
        $data['payment_id'] = $charge->payment_method;
        $data['paying_amount'] = $charge->amount;
        $data['balance_transaction'] = $charge->balance_transaction;
        $data['stripe_order_id'] = $charge->metadata->order_id;
        $data['shipping'] = $request->shipping;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['payment_type'] = $request->payment_type;
        $data['status_code'] = mt_rand(100000,999999);
        if (Session::has('coupon')) {
            $data['subtotal'] = Session::get('coupon')['balance'];
        } else {
            $data['subtotal'] = Cart::Subtotal();
        }
        $data['status'] = 0;
        $data['date'] = date('d-m-y');
        $data['month'] = date('F');
        $data['year'] = date('Y');
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();
        $order_id = DB::table('orders')->insertGetId($data);

        //Insert shippings table
        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->ship_name;
        $shipping['ship_phone'] = $request->ship_phone;
        $shipping['ship_email'] = $request->ship_email;
        $shipping['ship_address'] = $request->ship_address;
        $shipping['ship_city'] = $request->ship_city;
        $shipping['created_at'] = Carbon::now();
        $shipping['updated_at'] = Carbon::now();
        DB::table('shippings')->insert($shipping);

        //Insert order details table
        $content = Cart::content();
        $details = array();
        foreach ($content as $row) {
            $details['order_id'] = $order_id;
            $details['product_id'] = $row->id;
            $details['product_name'] = $row->name;
            $details['color'] = $row->options->color;
            $details['size'] = $row->options->size;
            $details['quantity'] = $row->qty;
            $details['single_price'] = $row->price;
            $details['total_price'] = $row->qty * $row->price;
            $details['created_at'] = Carbon::now();
            $details['updated_at'] = Carbon::now();
            DB::table('order_details')->insert($details);
        }
        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        return redirect()->to('/')->with('status', 'Order was completed successfully');
    }

    public function successOrdersList()
    {
        $order = DB::table('orders')->where('user_id', Auth::id())->where('status', 3)->orderBy('id', 'desc')->limit(5)->get();
        return view('pages.order_return', compact('order'));
    }

    public function returnOrderRequest($id)
    {
        DB::table('orders')->where('id', $id)->update(['return_order' => 1]);
        return redirect()->back()->with('status', 'Order was requested for return');
    }
}
