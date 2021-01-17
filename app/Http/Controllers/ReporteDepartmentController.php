<?php

namespace App\Http\Controllers;

use App\Reportdeparment;
use App\Reportpayrolldepartment;
use App\Supermarket;
use App\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReporteDepartmentController extends Controller
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
        $super = Supermarket::find($id_supermarket);

        if(auth()->user()->level != 'admin')
        {
            return redirect()->back();
        }

        $department = Reportdeparment::where('supermarket_id', '=', $id_supermarket)->get();

        $info = [];


        if($department->isNotEmpty())
        {
            $info = $department;
        }

        return view('report.view_department', compact('info', 'super'));

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
        $department = new Reportdeparment();

        $datos      = $request->all();

        $department->supermarket_id = $datos['dato'][0];
        $department->name           = $datos['dato'][1];
        $department->status         = "active";
        $department->created_at = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
        $department->updated_at = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
        $department->save();
        return response()->json($datos['dato'][0]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $report_payroll_dep = [];
        $report_depart = Reportdeparment::find($id);
        if($report_depart)
        {
            $supermarket         = Supermarket::find($report_depart->supermarket_id);

            $payroll_depart      = Department::where('supermarket_id', '=', $report_depart->supermarket_id)->get();

            $rep_pay_departments = Reportpayrolldepartment::where('report_department_id', '=', $id)
                ->where('status', '=', 'active')
                ->get();
            if($rep_pay_departments->isNotEmpty())
            {
                foreach ($rep_pay_departments as $rpd)
                {
                    $report_payroll_dep[$rpd->payroll_department_id] = $rpd->payroll_department_id;
                }
            }

            if($payroll_depart->isEmpty())
            {
                return redirect()->back()->withErrors(['msg', "Department of the payroll didn't found"]);
            }
            return view('report.department_report_add_department_payroll', compact('payroll_depart', 'report_depart', 'supermarket', 'report_payroll_dep'));
        }
        return redirect()->back()->withErrors(['msg', "Department of the report didn't found"]);

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

    public function departmentModify(Request $request)
    {
        $info = $request->all();

        $department = Reportdeparment::find($info['dato'][0]);

        $department->name   = $info['dato'][1];
        $department->status = $info['dato'][2];

        $department->save();
        return response()->json('Updated');
    }

    public function linkReportPaymentDepartment(Request $request)
    {
        $data = $request->all();

        //Recibo todos los id de todas los departamentos del payroll
        foreach ($data as $key => $datos)
        {
            //Reviso cada entrada individual

            //Me aseguro de identificar cuales departamentos fueron seleccionados viendo si la variable key es igual al
            //key del arreglo que quiero evaluar
            if($key == "idDepartmentPayroll_".$datos)
            {
                //determino si en el arreglo existe el key que tiene la informacion si el departamento se selecciono
                // si existe es porque se selecciono
                if(array_key_exists("departmentPayroll_".$datos, $data))
                {
                    $link_departments1 = Reportpayrolldepartment::where('supermarket_id', '=', $data['supermaket_id'])
                        ->where('report_department_id', '=', $data['report_department_id'])
                        ->where('payroll_department_id', '=', $datos)
                        ->get();
                    if($link_departments1->isEmpty())
                    {
                        $link_departments = new Reportpayrolldepartment();

                        $link_departments->supermarket_id        = $data['supermaket_id'];
                        $link_departments->report_department_id  = $data['report_department_id'];
                        $link_departments->payroll_department_id = $datos;
                        $link_departments->status                = "active";
                        $link_departments->created_at            = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
                        $link_departments->updated_at            = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
                        $link_departments->save();
                    }
                    elseif ($link_departments1[0]->status == 'inactive')
                    {
                        $link_departments1[0]->status = 'active';
                        $link_departments1[0]->save();
                    }
                }
                else
                {
                    // Si no existe fue porque no se selecciono
                    //
                    $link_departments = Reportpayrolldepartment::where('supermarket_id', '=', $data['supermaket_id'])
                        ->where('report_department_id', '=', $data['report_department_id'])
                        ->where('payroll_department_id', '=', $datos)
                        ->where('status', '=', 'active')
                        ->get();

                    if($link_departments->isNotEmpty())
                    {
                        $link_departments[0]->status = "inactive";
                        $link_departments[0]->save();
                    }
                }
            }
        }
        return redirect()->route('report_depart_add_payrolldepartment', ["id" => $data['report_department_id']]);
    }
}
