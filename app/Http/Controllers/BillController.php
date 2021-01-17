<?php

namespace App\Http\Controllers;

use App\Tienda;
use Illuminate\Http\Request;
use App\Bill;
use App\Item;
use App\Vendor;
use Carbon\Carbon;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bill');
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
    public function store(Request $request, Bill $bill)
    {
        $info = $request->input('data');
        $bill->tienda_id      = $info['tienda_id'];
        $bill->item_id        = $info['item_id'];
        $bill->vendor_id      = $info['vendor_id'];
        $bill->description    = $info['description'];
        $bill->qty            = $info['qty'];
        $bill->price          = $info['price'];
        $bill->product_amount = $info['product_amount'];
        $bill->unit           = $info['unit'];
        $bill->status         = "open";
        $bill->fecha_bill     = $info['fecha_bill'];
        $bill->created_at     = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
        $bill->updated_at     = Carbon::now('America/New_York')->format('Y-m-d h:i:s');

        $bill->save();

        return response()->json($bill);
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
    public function destroy($id, Request $request, Bill $bill)
    {
        $info = $request->all();

        $bill::where("id", $id)
                ->where("status", "open")
                ->delete();

        return response()->json($info);
    }

    public function searchStore(Request $request, Tienda $tienda)
    {
        $store = $request->input('searchFor');

        $info = $tienda::where("code", $store)->get();

        if($info->isEmpty())
        {
            return response()->json(['mensaje' => "There isn't store with this code"]);
        }

        return response()->json($info);
    }

    public function searchPlu(Request $request, Item $item)
    {
        $inf = $request->input('searchFor');

        $info = $item::where("plu", $inf)->get();

        if($info->isEmpty())
        {
            return response()->json(['mensaje' => "This PLU doesn't exist"]);
        }
        return response()->json($info);
    }

    public function searchVendor(Request $request, Vendor $vendor)
    {
        $inf = $request->all();

        $info = $vendor->all();

        if($info->isEmpty())
        {
            return response()->json(['mensaje' => "There isn't vendor"]);
        }
        return response()->json($info);
    }

    public function rutaSearchProductsBillOpen(Request $request, Bill $bill)
    {
        $datos = $request->all();
        $info = $bill::where('vendor_id', $datos["dato"][0])
            ->select('*', 'bills.id as bill_id', 'items.id as item2_id')
            ->leftjoin('items', 'bills.item_id', '=', 'items.id')
            ->where('bills.fecha_bill', 'like', $datos["dato"][1]."%")
            ->where('bills.tienda_id', $datos["dato"][2])
            ->where('bills.status', 'open')
            ->get();
        if($info->isEmpty())
        {
            return response()->json(['mensaje' => "No hay productos"]);
        }
        return response()->json($info);
    }

    public function saveProductsBillOpen(Request $request, Bill $bill)
    {
        $datos = $request->input('dato');
        $bill::where('tienda_id', $datos[2])
                ->where('vendor_id', $datos[0])
                ->where('fecha_bill', 'like', $datos[1].'%')
                ->update(['status' => 'close']);
        return response()->json($datos);

    }

    public function getBills()
    {
        return view('get_bill');
    }

    public function SearchBills(Request $request, Bill $bill)
    {
        $info  = [];
        $datos = $request->input('dato');

        if($datos[2] == 0)
        {
            $info = $bill::select('bills.*', 'tiendas.name as tienda_name', 'vendors.vendor as vendor_name')
                ->leftjoin('tiendas', 'bills.tienda_id', '=', 'tiendas.id')
                ->leftjoin('vendors', 'bills.vendor_id', '=', 'vendors.id')
                ->whereBetween('fecha_bill', [$datos[0], $datos[1]])
                ->where('tiendas.code', $datos[3])
                ->get();
        }
        else
        {
            $info = $bill::select('bills.*', 'tiendas.name as tienda_name', 'vendors.vendor as vendor_name')
                ->leftjoin('tiendas', 'bills.tienda_id', '=', 'tiendas.id')
                ->leftjoin('vendors', 'bills.vendor_id', '=', 'vendors.id')
                ->where('vendor_id', $datos[2])
                ->where('tiendas.code', $datos[3])
                ->whereBetween('fecha_bill', [$datos[0], $datos[1]])
                ->get();
        }

        return response()->json($info);
    }

    public function irInicio()
    {
        return view('principal');
    }
}
