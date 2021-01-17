<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Bill;
use App\Item;
use App\Tienda;
use App\Vendor;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports');
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
    public function store(Request $request)
    {
        //
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

    public function getReports(Request $request, Bill $bill)
    {
        $info = $request->input('dato');
        $bills = $this->getBillsBetweenDates($bill, $info);

        if($bills->isEmpty())
        {
            return response()->json(['mensaje' => "There aren't bills between those dates"]);
        }

        $bills_up = $this->getUnitPrice($bills);

        $orden = $this->ordenItem($bills_up);

        return response()->json($orden);
    }

    protected function ordenItem($bills_up)
    {
        $info       = [];

        foreach($bills_up as $bill)
        {
            $info[$bill->description][] =
            [
                'store'       => $bill->tname,
                'store_code'  => $bill->tconde,
                'vendor'      => $bill->vendor,
                'unit_price'  => $bill->unit_price,
                'fecha_bill'  => $bill->fecha_bill,
            ];
        }

        foreach ($info as $key => $inf)
        {
            usort($info[$key], function($a, $b){
                return $a['unit_price'] <=> $b['unit_price'];
            });
        }

        return $info;
    }

    protected function getUnitPrice($bills)
    {
        $info = [];
        foreach ($bills as $bill)
        {
            $bill->unit_price = number_format($bill->price / $bill->product_amount, 2, '.', ',');
            $info[] = $bill;
        }
        return $info;
    }

    protected function getBillsBetweenDates($bill, $info)
    {
        return $bill::select('bills.*','tiendas.code as tconde', 'tiendas.name as tname', 'vendors.vendor as vendor')
                ->leftjoin('tiendas', 'bills.tienda_id', '=', 'tiendas.id')
                ->leftjoin('vendors', 'bills.vendor_id', '=', 'vendors.id')
                ->whereBetween('fecha_bill', [$info[0], $info[1]])->get();
    }

    public function formReport2()
    {
        return view('reportsplu');
    }

    public function searchReportsPlu(Request $request)
    {
        $dato = $request->all();
        $bill = new Bill();
        $info = [];

        $datos = $bill::select('*')->leftjoin('vendors', 'bills.vendor_id', '=', 'vendors.id')
                    ->leftjoin('items', 'bills.item_id', '=', 'items.id')
                    ->leftjoin('tiendas', 'bills.tienda_id', '=', 'tiendas.id')
                    ->where('items.plu', '=', $dato['dato'][2])
                    ->whereBetween('bills.fecha_bill', [$dato['dato'][0], $dato['dato'][1]])
                    ->get();

        if($datos->isNotEmpty())
        {
            $info = $datos;
        }
        return response()->json($info);
    }
}
