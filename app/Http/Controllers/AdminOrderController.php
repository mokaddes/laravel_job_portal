<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       $this->middleware(['auth', 'admin']);
    }


    public function index()
    {
        $orders = Order::where('user_id', '=', Auth::user()->id)->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $industry = DB::table('organization')->get();
        $countries = DB::table('country')->get();
        return view('admin.orders.create', compact('industry', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'email'             => 'required',
            'contact_persion'   => 'required',
            'country'           => 'required',
            'company'           => 'required',
        ]);
        $order = new Order();
        $order->company = $request->company;
        $order->country = $request->country;
        $order->street = $request->street;
        $order->house_no = $request->house_no;
        $order->postal_code = $request->postal_code;
        $order->city = $request->city;
        $order->region = $request->region;
        $order->tax_id = $request->tax_id;
        $order->salutation = $request->salutation;
        $order->contact_persion = $request->contact_persion;
        $order->email = $request->email;
        $order->user_id = Auth::user()->id;
        $order->save();
        return redirect()->route('orders.index')->with('success', 'Order Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $industry = DB::table('organization')->get();
        $countries = DB::table('country')->get();
        return view('admin.orders.edit', compact('industry', 'countries', 'order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $valid = $request->validate([
            'email'             => 'required',
            'contact_persion'   => 'required',
            'country'           => 'required',
            'company'           => 'required',
        ]);

        $order->company = $request->company;
        $order->country = $request->country;
        $order->street = $request->street;
        $order->house_no = $request->house_no;
        $order->postal_code = $request->postal_code;
        $order->city = $request->city;
        $order->region = $request->region;
        $order->tax_id = $request->tax_id;
        $order->salutation = $request->salutation;
        $order->contact_persion = $request->contact_persion;
        $order->email = $request->email;
        $order->user_id = Auth::user()->id;
        $order->update();
        return redirect()->route('orders.index')->with('success', 'Order Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order Delete');
    }
}
