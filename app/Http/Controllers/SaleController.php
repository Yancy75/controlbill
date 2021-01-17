<?php

namespace App\Http\Controllers;

use App\Reportdeparment;
use App\Sale;
use App\Supermarket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
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
        $sale = Sale::where('supermarket_id', '=', $id_supermarket)->get();

        if($sale->isNotEmpty())
        {
            $c = 0;
            foreach($sale as $p)
            {

                $info[$c]                      = $p;
                $depa                          = Reportdeparment::find($p->report_department_id);
                $date                          = new Carbon($p->date);
                $info[$c]['date_f']            = $date->format('m-d-Y');
                $info[$c]['department_report'] = $depa->name;
                $c++;
            }
        }
        return view('report.view_sales', compact('info', 'id_supermarket'));
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

        return view('report.add_sale', compact('info', 'supermarket'));
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

        $sale = new Sale();

        $sale->supermarket_id       = $dato["inputIdSupermarket"];
        $sale->report_department_id = $dato["inputDepartment"];
        $sale->date                 = $datebd;
        $sale->amount               = $dato["inputAmount"];
        $sale->status               = "active";

        $sale->save();
        return redirect()->route('view_sale', ['id_supermarket' => $dato["inputIdSupermarket"]]);
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
     * @param  int  $id_sale
     * @param  int  $id_supermarket
     * @return \Illuminate\Http\Response
     */
    public function edit($id_sale, $id_supermarket)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $info        = [];
        $supermarket = Supermarket::find($id_supermarket);
        $sale        = Sale::where("id", "=", $id_sale)->get();
        $department  = Reportdeparment::where('supermarket_id', '=', $id_supermarket)->get();

        if($sale->isNotEmpty())
        {
            $info            = $sale[0];
            $depa_name       = Reportdeparment::find($sale[0]->report_department_id);
            $info->depa_name = $depa_name->name;
            $date            = new Carbon($sale[0]->date);
            $info->date_show = $date->format('m-d-Y');
        }
        return view('report.modify_sale', compact('info', 'supermarket', 'department'));
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
        $sale = Sale::find($data['inputIdSale']);
        $date = new Carbon(str_replace('-', '/',$data["inputDate"]));

        $sale->report_department_id = $data["inputDepartment"];
        $sale->amount               = $data["inputAmount"];
        $sale->date                 = $date->format('Y-m-d');
        $sale->status               = $data["inputStatus"];
        $sale->save();

        return redirect()->route('modify_sale', ['id_sale' => $sale->id, 'id_supermarket' => $id_supermarket]);
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
