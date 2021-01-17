<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\Reportdeparment;
use App\Supermarket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_supermarket)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }

        $info     = [];
        $purchase = Purchase::where('supermarket_id', '=', $id_supermarket)->get();

        if($purchase->isNotEmpty())
        {
            $c = 0;
            foreach($purchase as $p)
            {

                $info[$c]                      = $p;
                $depa                          = Reportdeparment::find($p->report_department_id);
                $date                          = new Carbon($p->date);
                $info[$c]['date_f']            = $date->format('m-d-Y');
                $info[$c]['department_report'] = $depa->name;
                $c++;
            }
        }
        return view('report.view_purchases', compact('info', 'id_supermarket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_supermarket)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $info        = [];
        $department  = Reportdeparment::where('supermarket_id', '=', $id_supermarket)->get();
        $supermarket = Supermarket::find($id_supermarket);

        if($department->isNotEmpty())
        {
            $info = $department;
        }

        return view('report.add_purchases', compact('info', 'supermarket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $dato   = $request->all();
        $date   = new Carbon($dato['inputDate']);
        $datebd = $date->format('Y-m-d');

        $purchase = new Purchase();

        $purchase->supermarket_id       = $dato["inputIdSupermarket"];
        $purchase->report_department_id = $dato["inputDepartment"];
        $purchase->date                 = $datebd;
        $purchase->amount               = $dato["inputAmount"];
        $purchase->status               = "active";

        $purchase->save();

        return redirect()->route('view_purchase', ['id_supermarket' => $dato["inputIdSupermarket"]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_purchase, $id_supermarket)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $info        = [];
        $supermarket = Supermarket::find($id_supermarket);
        $purchase    = Purchase::where("id", "=", $id_purchase)->get();
        $department  = Reportdeparment::where('supermarket_id', '=', $id_supermarket)->get();

        if($purchase->isNotEmpty())
        {
            $info            = $purchase[0];
            $depa_name       = Reportdeparment::find($purchase[0]->report_department_id);
            $info->depa_name = $depa_name->name;
            $date            = new Carbon($purchase[0]->date);
            $info->date_show = $date->format('m-d-Y');
        }
        return view('report.modify_purchase', compact('info', 'supermarket', 'department'));
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
     * @param  int  $id_supermarket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_supermarket)
    {
        $data = $request->all();
        $purchase = Purchase::find($data['inputIdPurchase']);

        $date = new Carbon(str_replace('-', '/',$data["inputDate"]));

        $purchase->report_department_id = $data["inputDepartment"];
        $purchase->amount               = $data["inputAmount"];
        $purchase->date                 = $date->format('Y-m-d');
        $purchase->status               = $data["inputStatus"];
        $purchase->save();

        return redirect()->route('modify_purchase', ['id_purchase' => $purchase->id, 'id_supermarket' => $id_supermarket]);
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
