<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employees;
use App\HistoricoCliente;
use App\Payrollset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Supermarket;
use App\Generalset;
use App\Employeeset;
use Illuminate\Support\Facades\DB;



class PayrollsetController extends Controller
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
    public function index()
    {
        //
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
     * @param  int  $id_supermarket
     * @return \Illuminate\Http\Response
     */
    public function edit($id_supermarket)
    {
        $supermarket = Supermarket::find($id_supermarket);
        $dato        = Generalset::where('supermarket_id', '=', $id_supermarket)->get();
        $info        = [];

        if($dato->isNotEmpty())
        {
            $info = $dato;
        }

        return view('payrollset.general_setting_supermarket', compact('supermarket', 'info'));

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
        $info        = $request->all();
        $supermarket = Supermarket::find($id_supermarket);
        $dato        = Generalset::where('supermarket_id', '=', $id_supermarket)->get();

        if($dato->isEmpty())
        {
            $dato = new Generalset();
            $dato->supermarket_id = $id_supermarket;
            $dato->regular_hours  = $info['inputRegularHours'];
            $dato->pto_hours      = $info['inputPTO'];
            $dato->porcentage     = $info['inputPOverHour'];
            $dato->created_at     = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
            $dato->updated_at     = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
            $dato->save();

            return redirect()->back();
        }

        $dato[0]->supermarket_id = $id_supermarket;
        $dato[0]->regular_hours  = $info['inputRegularHours'];
        $dato[0]->pto_hours      = $info['inputPTO'];
        $dato[0]->porcentage     = $info['inputPOverHour'];

        $dato[0]->save();

        return redirect()->back();

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

    public function employeePayrollSetting($id, $view_modify)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $employee = Employees::find($id);
        $setting  = Employeeset::where('employee_id', '=', $id)->get();
        $general  = Generalset::where('supermarket_id', '=', $employee->supermarket_id)->get();
        $info     = [];
        $pto_date_activation = '';

        if($general->isEmpty())
        {
            return redirect()->route('general_setting_supermarket', ['id_supermarket' => session()->get('supermarket_id')]);
        }

        if($setting->isNotEmpty())
        {
            $info = $setting;
            if(!is_null($setting[0]->pto_date_activation))
            {
                $pto_date_activation_bd = Carbon::createFromFormat('Y-m-d', $setting[0]->pto_date_activation);
                $pto_date_activation = $pto_date_activation_bd->format('m-d-Y');
            }
            else
            {
                $pto_date_activation = '';
            }
        }

        return view('payrollset.employee_payroll_setting', compact('employee', 'info', 'view_modify', 'general', 'pto_date_activation'));
    }

    public function enterEmployeePayrollSetting(Request $request)
    {
        $info        = $request->all();
        $dato        = Employeeset::where('employee_id', '=', $info["inputIdEmployee"])->get();

        if($dato->isEmpty())
        {
            $dato = new Employeeset();
            $dato->employee_id           = $info["inputIdEmployee"];
            $dato->pay_hour              = $info['inputPayHours'];
            $dato->pto_accumulate_yearly = 0;
            $dato->year                  = Carbon::now('America/New_York')->format('Y');
            $dato->salary_type           = $info['inputTypeSalary'];
            $dato->salary_except         = $info['inputSalaryExcept'];
            $dato->contract_hours        = $info['inputContractHours'];
            $dato->on_book               = $info['inputOnBook'];
            $dato->created_at            = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
            $dato->updated_at            = Carbon::now('America/New_York')->format('Y-m-d h:i:s');

            $hired_date = Employees::select('inicial_date')->where('id', '=', $info["inputIdEmployee"])->get();
            $pto_date_activation = Carbon::createFromFormat('Y-m-d', $hired_date[0]->inicial_date);

            $dato->pto_date_activation = $pto_date_activation->addMonth(3)->format('Y-m-d');
            $dato->save();

            $this->historical_created_employee_payroll($dato);

            return redirect()->back();
        }

        $dato[0]->employee_id           = $info["inputIdEmployee"];
        $dato[0]->pay_hour              = $info['inputPayHours'];

        //Valido si es el mismo ano que se esta cargando la informacion y la que esta en la base de datos.
        //Si no es el mismo ano actualizo el PTO a 0 y el ano al actual
        if($dato[0] < Carbon::now('America/New_York')->format('Y'))
        {
            $dato[0]->year               = Carbon::now('America/New_York')->format('Y');
            $dato[0]->pto_accumulate_yearly = 0;
        }

        $dato[0]->salary_type             = $info['inputTypeSalary'];
        $dato[0]->hours_calculated_salary = $info['inputHoursToCalculatedSalary'];
        $dato[0]->on_book                 = $info['inputOnBook'];
// Si el tipo de salario es 'hourly' reinicio el salary except y el contract hours
        if($info["inputTypeSalary"] == "hourly")
        {
            $dato[0]->salary_except  = NULL;
            $dato[0]->contract_hours = 0;
        }
        elseif ($info["inputTypeSalary"] == "salary")
        {
            $dato[0]->salary_except  = $info['inputSalaryExcept'];
            $dato[0]->contract_hours = $info['inputContractHours'];
        }
        //Obtengo los atributos originales antes de cambiarlos
        $original = $dato[0]->getOriginal();

        $dato[0]->save();

        //Solo obtengo los cambios que se hicieron. debo grabarlo antes de sacar los cambios
        $changes  = $dato[0]->getChanges();

        $this->historical_employee($info["inputIdEmployee"], $original, $changes);

        return redirect()->back();
    }

    public function payrollSetting($id_supermarket)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }

        $payroll = Payrollset::select('period_starting')
            ->distinct()
            ->where('supermarket_id', '=', $id_supermarket)
            ->orderBy('period_starting', 'desc')
            ->limit(10)
            ->get();

        $supermarket = Supermarket::find($id_supermarket);
        return view('payrollset.select_period_payroll_setting', compact('supermarket', 'payroll'));
    }

    public function setPayrollSetting($id_supermarket, Request $request)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }

        $date       = new Carbon($request->input('inputDate'));
        $date_bd    = $date->format('Y-m-d');
        $date_begin = $date->format('m-d-Y');
        $date_end   = $date->add(6, 'day')->format('m-d-Y');

        //Aqui valido si la fecha que eligieron ya tiene el Payroll hecho. Si tiene el Payroll lo redirecciona al view
        //del payroll en vez de a llenar el payroll
        $date_exist = $this->validateIfDateExist($date_bd);
        if($date_exist)
        {
            return redirect()->route('view_payroll_info', ['date' => $date_begin ]);
        }
        $supermarket          = Supermarket::find($id_supermarket);
        $department           = Department::where('supermarket_id', '=', $id_supermarket)
                                ->where('status', '=', 'active')
                                ->get();

        if($department->isNotEmpty())
        {
            $employeeByDepartment = $this->getEmployeeByDepartment($department);
        }

        $generalSet = Generalset::where('supermarket_id', '=', $supermarket->id)->get();
        return view('payrollset.payroll_cal', compact('supermarket', 'date_bd', 'date_begin','date_end' , 'employeeByDepartment', 'generalSet', 'department'));
    }

    private function validateIfDateExist($date_bd)
    {
        $payrollset = Payrollset::where('period_starting', '=', $date_bd)->get();
        if($payrollset->isEmpty())
        {
            return false;
        }

        return true;
    }

    private function getEmployeeByDepartment($department)
    {
        $info = [];
        $c    = 0;
        foreach ($department as $dep)
        {
            $employees = Employees::select('*', 'employeesets.id as id_empl_set', 'employees.id as id_empl')
                ->leftjoin('employeesets', 'employees.id', '=', 'employee_id')
                ->where('department_id', '=', $dep['id'])
                ->where('employees.status', '=', 'active')
                ->get();
            $info[$c] = collect([
                'department_name' => $dep->name,
                'employee_info'   => $employees
            ]);

            $c++;
        }
        return $info;
    }

    public function addPayrollInfo(Request $request)
    {
        $info    = $request->input('dato');
        $date    = '';

        foreach ($info as $inf)
        {
            $payroll = new Payrollset();

            $c = 0;
            foreach ($inf as $in)
            {

                if($in == 'NaN')
                {
                    $inf[$c] = 0;
                }
                $c = $c+1;
            }
            $payroll->supermarket_id       = session()->get('supermarket_id');
            $payroll->employee_id          = $inf[1];
            $payroll->period_starting      = Carbon::createFromFormat('m-d-Y', $inf[0])->format('Y-m-d');
            $payroll->pay_hour             = $inf[2];
            $payroll->working_hours        = $inf[3];
            $payroll->pto                  = $inf[4];
            $payroll->ajust_bonus          = $inf[5];
            $payroll->check_gross          = $inf[6];
            $payroll->check_net            = $inf[7];
            $payroll->taxes                = $inf[8];
            $payroll->direct_deposit       = $inf[9];
            $payroll->type_salary          = strtolower($inf[10]);
            $payroll->regular_hours_amount = $inf[11];
            $payroll->created_at           = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
            $payroll->updated_at           = Carbon::now('America/New_York')->format('Y-m-d h:i:s');

            if($inf[4] > 0)
            {
                $this->addPTO($inf[1], $inf[4]);
            }
            $payroll->save();
            $date = $inf[0];
        }
        $mensaje = ['mensaje' =>'Success'];
        return response()->json($mensaje);
    }

    private function addPTO($id_employ, $pto)
    {
        $employ_setting = Employeeset::where('employee_id', '=', $id_employ)
            ->get();

        if($employ_setting[0]->year == Carbon::now('America/New_York')->format('Y'))
        {
            $employ_setting[0]->pto_accumulate_yearly = $employ_setting[0]->pto_accumulate_yearly + $pto;
        }
        else{
            $employ_setting[0]->pto_accumulate_yearly  = $pto;
            $employ_setting[0]->year                   = Carbon::now('America/New_York')->format('Y');
        }
        $employ_setting[0]->save();

        return;
    }

    public function viewPayrollInfo($date)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $id_supermarket = session()->get('supermarket_id');
        $dates       = Carbon::createFromFormat('m-d-Y', $date);
        $date_begin  = $dates->format('m-d-Y');
        $date_db     = $dates->format('Y-m-d');
        $date_end    = $dates->add(6, 'day')->format('m-d-Y');

        $supermarket          = Supermarket::find($id_supermarket);
        $department           = Department::where('supermarket_id', '=', $id_supermarket)
            ->where('status', '=', 'active')
            ->get();
        if($department->isNotEmpty())
        {
            $payrollSetByEmployee = $this->getPayrollSetByEmployee($department, $date_db);
        }

        $generalSet = Generalset::where('supermarket_id', '=', $supermarket->id)->get();
        return view('payrollset.view_payroll', compact('supermarket', 'date_db', 'date_begin','date_end' , 'payrollSetByEmployee', 'generalSet', 'department'));
    }

    private function getPayrollSetByEmployee($department, $date_db)
    {
        $supermarket_id = session()->get('supermarket_id');
        $info = [];
        $c    = 0;
        foreach ($department as $dep)
        {
            $employees = Employees::select('*', 'employeesets.id as id_empl_set', 'employees.id as id_empl', 'payrollsets.id as id_pay', 'payrollsets.pay_hour as pay_hour_pay')
                ->leftjoin('employeesets', 'employees.id', '=', 'employee_id')
                ->leftjoin('payrollsets', 'employees.id', '=', 'payrollsets.employee_id')
                ->where('employees.department_id', '=', $dep['id'])
                ->where('payrollsets.period_starting', '=', $date_db)
//                ->where('employees.status', '=', 'active')
                ->get();
            $info[$c] = collect([
                'department_name' => $dep->name,
                'employee_info'   => $employees
            ]);

            $c++;
        }
        return $info;
    }

    public function viewPayrollInfoWithoutMenu($date)
    {
        set_time_limit(90);
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $payrollInfo = [];
        $id_supermarket = session()->get('supermarket_id');
        $dates       = Carbon::createFromFormat('m-d-Y', $date);
        $date_begin  = $dates->format('m-d-Y');
        $date_db     = $dates->format('Y-m-d');
        $date_end    = $dates->add(6, 'day')->format('m-d-Y');

        $supermarket          = Supermarket::find($id_supermarket);
        $department           = Department::where('supermarket_id', '=', $id_supermarket)
            ->where('status', '=', 'active')
            ->get();

        $generalSet = Generalset::where('supermarket_id', '=', $supermarket->id)->get();

        if($department->isNotEmpty())
        {
            $payrollSetByEmployee = $this->getPayrollSetByEmployee($department, $date_db);

            //Variables para los totales
            $totales['total_direct_deposit'] = 0;
            $totales['total_gross_wage']     = 0;
            $totales['total_net_wage']       = 0;
            $totales['total_cash']           = 0;
            $totales['total_taxes']          = 0;

            foreach ($payrollSetByEmployee as $p)
            {
                //Variables para los totales
                $totales['total_por_departamento'][$p['department_name']] = 0;
                $totales['porcentaje_total_por_departamento'][$p['department_name']] = 0;

                if($p['employee_info']->isNotEmpty())
                {
                    $c = 0;
                    foreach ($p['employee_info'] as $pi)
                    {
                        $payrollInfo[$p['department_name']][$c]['control'] = $c + 1;
                        $payrollInfo[$p['department_name']][$c]['id_empl'] = $pi['id_empl'];
                        $payrollInfo[$p['department_name']][$c]['name'] = $pi['name']." ".$pi['last_name'];
                        $payrollInfo[$p['department_name']][$c]['salary_type'] = $pi['type_salary'];
                        $payrollInfo[$p['department_name']][$c]['working_hours'] = $pi['working_hours'];

                        $payrollInfo[$p['department_name']][$c]['regular_hours'] = number_format($pi['regular_hours_amount'],2);

                        $payrollInfo[$p['department_name']][$c]['pay_hour_pay'] = number_format($pi['pay_hour_pay'],2);

                        //////////////////////////////////////////////////////////////

                        if($pi['working_hours'] > $pi['regular_hours_amount'])
                        {
                            $payrollInfo[$p['department_name']][$c]['over_time_hour'] = number_format($pi['working_hours'],2) - number_format($pi['regular_hours_amount'],2);
                        }
                        else
                        {
                            $payrollInfo[$p['department_name']][$c]['over_time_hour'] = 0;
                        }

                        ////////////////////////////////////////////////////////////
                        if($pi['working_hours'] > $pi['regular_hours_amount'])
                        {
                            $payrollInfo[$p['department_name']][$c]['over_time_rate'] = number_format($pi['pay_hour'],2) * (1 + (number_format($pi['regular_hours_amount']/100,2)));
                        }
                        else
                        {
                            $payrollInfo[$p['department_name']][$c]['over_time_rate'] = 0;
                        }

                        ////////////////////////////////////////////////////////////
                        if($pi['working_hours'] > $pi['regular_hours_amount'])
                        {
                            $payrollInfo[$p['department_name']][$c]['gross_wage'] = number_format($pi['regular_hours_amount'],2) * number_format($pi['pay_hour_pay'],2);
                        }
                        else
                        {
                            $payrollInfo[$p['department_name']][$c]['gross_wage'] = number_format($pi['working_hours'],2) * number_format($pi['pay_hour_pay'],2);
                        }

                        ////////////////////////////////////////////////////////////
                        if($pi['working_hours'] > $pi['regular_hours_amount'])
                        {
                            $overTime = number_format($pi['working_hours'],2) - number_format($pi['regular_hours_amount'],2);
                            $overTimehour = number_format($pi['pay_hour'],2) * (1 + (number_format($pi['regular_hours_amount']/100,2)));
                            $payrollInfo[$p['department_name']][$c]['over_time_wage'] = $overTime * $overTimehour;
                        }
                        else
                        {
                            $payrollInfo[$p['department_name']][$c]['over_time_wage'] = 0;
                        }

                        ////////////////////////////////////////////////////////////////////

                        $payrollInfo[$p['department_name']][$c]['pto'] = $generalSet[0]['pto'];

                        $payrollInfo[$p['department_name']][$c]['pto_amount_paid'] = $pi['pto'] * $pi['pay_hour_pay'];
                        $payrollInfo[$p['department_name']][$c]['total_wage']      = ($pi['pto'] * $pi['pay_hour_pay']) + $payrollInfo[$p['department_name']][$c]['over_time_wage'] + $payrollInfo[$p['department_name']][$c]['gross_wage'];
                        $payrollInfo[$p['department_name']][$c]['ajust_bonus']     = $pi['ajust_bonus'];
                        $payrollInfo[$p['department_name']][$c]['check_gross']     = $pi['check_gross'];
                        $payrollInfo[$p['department_name']][$c]['check_net']       = $pi['check_net'];
                        $payrollInfo[$p['department_name']][$c]['taxes']           = $pi['taxes'];
                        $payrollInfo[$p['department_name']][$c]['direct_deposit']  = $pi['direct_deposit'];
                        $payrollInfo[$p['department_name']][$c]['t_gross_wage']    = ($payrollInfo[$p['department_name']][$c]['pto_amount_paid']  + $payrollInfo[$p['department_name']][$c]['over_time_wage']  + $payrollInfo[$p['department_name']][$c]['gross_wage']) + $pi['ajust_bonus'];
                        $payrollInfo[$p['department_name']][$c]['net_wage']        = ($payrollInfo[$p['department_name']][$c]['pto_amount_paid']  + $payrollInfo[$p['department_name']][$c]['over_time_wage']  + $payrollInfo[$p['department_name']][$c]['gross_wage']) + $pi['ajust_bonus'] - $pi['taxes'];
                        $payrollInfo[$p['department_name']][$c]['cash']            = (($payrollInfo[$p['department_name']][$c]['pto_amount_paid'] + $payrollInfo[$p['department_name']][$c]['over_time_wage'] + $payrollInfo[$p['department_name']][$c]['gross_wage']) + $pi['ajust_bonus'] - $pi['taxes']) - $pi['direct_deposit'];

                        $totales['total_por_departamento'][$p['department_name']] = $totales['total_por_departamento'][$p['department_name']] + $payrollInfo[$p['department_name']][$c]['t_gross_wage'];
                        $totales['total_direct_deposit']                          = $totales['total_direct_deposit'] + $payrollInfo[$p['department_name']][$c]['direct_deposit'];
                        $totales['total_gross_wage']                              = $totales['total_gross_wage'] + $payrollInfo[$p['department_name']][$c]['t_gross_wage'];
                        $totales['total_net_wage']                                = $totales['total_net_wage'] + $payrollInfo[$p['department_name']][$c]['net_wage'];
                        $totales['total_cash']                                    = $totales['total_cash'] + $payrollInfo[$p['department_name']][$c]['cash'];
                        $totales['total_taxes']                                   = $totales['total_taxes'] + $pi['taxes'];

                        $c++;
                    }
                }
            }
            foreach ($totales['total_por_departamento'] as $key => $t)
            {
                $totales['porcentaje_total_por_departamento'][$key] = number_format(($totales['total_por_departamento'][$key]/$totales['total_gross_wage']) * 100,2,'.',',');
            }
        }
//        $pdf = \App::make('dompdf.wrapper');
//        $pdf->loadView('payrollset.view_payroll_print', ['supermarket' => $supermarket, 'date_db' => $date_db,'date_begin' => $date_begin, 'date_end' => $date_end,'payrollSetByEmployee'  => $payrollSetByEmployee,'generalSet' => $generalSet, 'department' => $department, 'payrollInfo' => $payrollInfo, 'totales' => $totales]);
//        $pdf->setPaper('a4', 'landscape')->setWarnings(false);
//        return $pdf->download();
        return view('payrollset.view_payroll_print', compact('supermarket', 'date_db', 'date_begin','date_end' , 'payrollSetByEmployee', 'generalSet', 'department', 'payrollInfo', 'totales'));
    }

    public function viewPayrollInfoWithoutMenuDouble($date)
    {
        set_time_limit(90);
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $id_supermarket = session()->get('supermarket_id');
        $dates       = Carbon::createFromFormat('m-d-Y', $date);
        $date_begin  = $dates->format('m-d-Y');
        $date_db     = $dates->format('Y-m-d');
        $date_end    = $dates->add(6, 'day')->format('m-d-Y');

        $supermarket          = Supermarket::find($id_supermarket);
        $department           = Department::where('supermarket_id', '=', $id_supermarket)
            ->where('status', '=', 'active')
            ->get();
        if($department->isNotEmpty())
        {
            $payrollSetByEmployee = $this->getPayrollSetByEmployee($department, $date_db);
        }

        $generalSet = Generalset::where('supermarket_id', '=', $supermarket->id)->get();

        $payroll_info = [];

        foreach ($payrollSetByEmployee as $k => $ps)
        {
            $c = 0;
            foreach ($ps["employee_info"] as $key => $pay_inf)
            {
                $payroll_info[$ps["department_name"]][$c]['name'] = $pay_inf->name." ".$pay_inf->last_name;

                $payroll_info[$ps["department_name"]][$c]["general_pto_hours"] = $pay_inf->regular_hours_amount;
//                $payroll_info[$ps["department_name"]][$c]["general_pto_hours"] = $generalSet[0]->pto_hours;

                if ($pay_inf->working_hours > $pay_inf->regular_hours_amount)
                {
                    /////Gross Wage///////
                    $payroll_info[$ps["department_name"]][$c]["gross_wage"] = number_format($pay_inf->regular_hours_amount,2) * number_format($pay_inf->pay_hour_pay,2);

                    ///Overtime Wage
                    $overTime = number_format($pay_inf->working_hours,2)  - number_format($pay_inf->regular_hours_amount,2);
                    $overTimehour = number_format($pay_inf->pay_hour,2) * (1 + (number_format($pay_inf->regular_hours_amount/100,2)));
                    $payroll_info[$ps["department_name"]][$c]["overtime_wage"] = number_format($overTime,2) * number_format($overTimehour,2);
                }
                else
                {
                    /////Gross Wage///////
                    $payroll_info[$ps["department_name"]][$c]["gross_wage"] = number_format($pay_inf->working_hours,2) * number_format($pay_inf->pay_hour_pay,2);

                    ///Overtime Wage/////
                    $payroll_info[$ps["department_name"]][$c]["overtime_wage"] = 0;
                }

                $payroll_info[$ps["department_name"]][$c]["pto"] = number_format($pay_inf->pto,2) * number_format($pay_inf->pay_hour_pay,2);

                $payroll_info[$ps["department_name"]][$c]["list_pto"] = $this->getPTOList($pay_inf["id_empl"], $date_db, $date_begin, $date_end);

                $payroll_info[$ps["department_name"]][$c]["ajust_bonus"] = $pay_inf->ajust_bonus;

                $payroll_info[$ps["department_name"]][$c]["total_wage"] = $payroll_info[$ps["department_name"]][$c]["pto"] + $payroll_info[$ps["department_name"]][$c]["overtime_wage"] + $payroll_info[$ps["department_name"]][$c]["gross_wage"];

                $payroll_info[$ps["department_name"]][$c]["taxes"] = $pay_inf->taxes;

                $payroll_info[$ps["department_name"]][$c]["salary_type"] = $pay_inf->salary_type;

                $payroll_info[$ps["department_name"]][$c]["net_pay"] = $payroll_info[$ps["department_name"]][$c]["total_wage"] + $payroll_info[$ps["department_name"]][$c]["ajust_bonus"] - $pay_inf->taxesx;

                $payroll_info[$ps["department_name"]][$c]["cash"] = $payroll_info[$ps["department_name"]][$c]["net_pay"] - $pay_inf->direct_deposit;

                $payroll_info[$ps["department_name"]][$c]["direct_deposit"] = $pay_inf->direct_deposit;

                $payroll_info[$ps["department_name"]][$c]["pto_activation"] = $pay_inf->pto_date_activation;

                $payroll_info[$ps["department_name"]][$c]["on_book"] = $pay_inf->on_book;

                if(!empty($payroll_info[$ps["department_name"]][$c]["list_pto"]))
                {
                    $payroll_info[$ps["department_name"]][$c]["pto_restante"] = $payroll_info[$ps["department_name"]][$c]["general_pto_hours"] - $payroll_info[$ps["department_name"]][$c]["list_pto"]["pto_usados"];
                    $payroll_info[$ps["department_name"]][$c]["pto_usadas"]   = $payroll_info[$ps["department_name"]][$c]["list_pto"]["pto_usados"];
                }
                else{
                    $payroll_info[$ps["department_name"]][$c]["pto_restante"] = $payroll_info[$ps["department_name"]][$c]["general_pto_hours"];
                    $payroll_info[$ps["department_name"]][$c]["pto_usadas"]   = 0;
                }

                $c++;
            }
        }
        $year = Carbon::now()->format('Y');

      //  $pdf = \App::make('dompdf.wrapper');
      //  $pdf->loadView('payrollset.view_payroll_double_print', ['supermarket' => $supermarket, 'date_db' => $date_db,'date_begin' => $date_begin, 'date_end' => $date_end,'payrollSetByEmployee'  => $payrollSetByEmployee,'generalSet' => $generalSet, 'department' => $department, 'payroll_info' => $payroll_info, 'year' => $year]);
      //  $pdf->setPaper('a4', 'landscape')->setWarnings(false);
      //  return $pdf->download();
        return view('payrollset.view_payroll_double_print', compact('supermarket', 'date_db', 'date_begin','date_end' , 'payrollSetByEmployee', 'generalSet', 'department', 'payroll_info', 'year'));
    }

    private function getPTOList($id, $date, $inicio, $final)
    {
        $payroll = new Payrollset();

        $generalset = new Generalset();

//        $pto_list = $payroll::select('pto', 'created_at')
        $pto_list = $payroll::select('pto', 'period_starting')
                ->where('employee_id', '=', $id)
//                ->where('created_at', '>=', $date." 23:59:59")
                ->where('period_starting', '<=', $date)
                ->where('pto', '>', 0)
                ->get();

        $info = [];

        if($pto_list->isNotEmpty())
        {
            $generalpto = $generalset::select('pto_hours')
                ->where('supermarket_id', '=', $pto_list[0]->supermarket_id)
                ->get();

//            dd($generalpto);

            $c = 0;
            $usados = 0; // lo usare para calcular el total de los PTO usados

            foreach ($pto_list as $pt)
            {
                $info['list'][$c]['pto'] = $pt->pto;
                $fecha = $pt->period_starting;

                $dates = Carbon::createFromFormat('Y-m-d', $fecha);

                $info['list'][$c]['inicio'] = $dates->format('m-d-Y');
                $info['list'][$c]['final'] = $dates->add(6, 'day')->format('m-d-Y');

                $usados = $usados + $pt->pto;
                $c++;
            }
            $info['pto_usados'] = $usados;
        }

        return $info;
    }

    public function modifyEmploeePayrollInfo($id)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $info = Payrollset::select("*", "payrollsets.id as id_payset", "employees.id as id_emp", "employeesets.id as id_empset", "payrollsets.pay_hour as pay_hour_pay", "employeesets.pay_hour as pay_hour_empset")
                ->leftjoin('employees', 'payrollsets.employee_id', '=', 'employees.id')
                ->leftjoin('employeesets', 'employees.id', '=', 'employeesets.employee_id')
                ->where('payrollsets.id', '=', $id)
                ->get();
        $generalSet = Generalset::where('supermarket_id', '=', $info[0]->supermarket_id)->get();
        $supermarket = Supermarket::find($info[0]->supermarket_id);

        $dates       = Carbon::createFromFormat('Y-m-d', $info[0]->period_starting);
        $date_begin  = $dates->format('m-d-Y');
        $date_db     = $dates->format('Y-m-d');
        $date_end    = $dates->add(6, 'day')->format('m-d-Y');

        return view('payrollset.modify_employee_payroll_info', compact('info', 'generalSet', 'supermarket', 'date_begin', 'date_end'));
    }

    public function updateEmploeePayrollInfo(Request $request)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $info = $request->all();
        $payrollset = Payrollset::find($info['inputPayset']);

        $payrollset->pay_hour       = $info["inputRegRate"];
        $payrollset->working_hours  = $info["inputTotalOfHours"];
        $payrollset->pto            = $info["inputTPOHour"];
        $payrollset->ajust_bonus    = $info["inputBonus"];
        $payrollset->check_gross    = $info["inputCheckGrossPay"];
        $payrollset->check_net      = $info["inputCheckNetPay"];
        $payrollset->taxes          = $info["inputTaxes"];
        $payrollset->direct_deposit = $info["inputDirectDeposit"];

        $payrollset->save();

        return redirect()->back();
    }

    public function addIndividualEmployee($date)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $id_supermarket = session()->get('supermarket_id');
        $dates       = Carbon::createFromFormat('m-d-Y', $date);
        $date_begin  = $dates->format('m-d-Y');
        $date_db     = $dates->format('Y-m-d');
        $date_end    = $dates->add(6, 'day')->format('m-d-Y');

        $employee = DB::select("select * from employees where not exists (select * from payrollsets where payrollsets.employee_id = employees.id and payrollsets.period_starting = '$date_db') and employees.status = 'active' and employees.supermarket_id = '$id_supermarket'");

        if(empty($employee))
        {
            return redirect()->back()->with('menssage', 'There is no employee out of the payroll');
        }
        $supermarket = Supermarket::find($id_supermarket);

        return view('payrollset.select_add_employee_payroll', compact('id_supermarket', 'date', 'date_begin', 'date_end', 'employee', 'supermarket'));
    }

    public function addingEmployeeToPayroll($id_supermarket, Request $request)
    {
        $info = $request->all();
        $dates       = Carbon::createFromFormat('m-d-Y', $info['date']);
        $date_db     = $dates->format('Y-m-d');
        $payroll = new Payrollset();

        $payroll->supermarket_id  = $id_supermarket;
        $payroll->employee_id     = $info['employee_id'];
        $payroll->period_starting = $date_db;
        $payroll->pay_hour        = 0;
        $payroll->working_hours   = 0;
        $payroll->pto             = 0;
        $payroll->ajust_bonus     = 0;
        $payroll->check_gross     = 0;
        $payroll->check_net       = 0;
        $payroll->taxes           = 0;
        $payroll->direct_deposit  = 0;
        $payroll->created_at      = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
        $payroll->updated_at      = Carbon::now('America/New_York')->format('Y-m-d h:i:s');

        $payroll->save();

        return redirect()->route('modify_employee_payroll_info', ['id' => $payroll->id]);
    }

    public function activarPTOAlLegarFechaDeActivacion()
    {
        $date = Carbon::now('America/New_York')->format('Y-m-d');

        $datos = Employeeset::where('pto_date_activation', '<=', $date)
                            ->where('pto_status', '=', 'inactive')->get();
        if($datos->isNotEmpty())
        {
            foreach ($datos as $dato)
            {
                $dato->pto_status = 'active';
                $dato->save();
            }
        }
    }

    private function historical_created_employee_payroll($data)
    {
        $historico = new HistoricoCliente();

        $historico->user_id     = auth()->user()->id;
        $historico->employee_id = $data->employee_id;
        $historico->accion      = 'Employee Payroll setting Created';
        $historico->date        = Carbon::now('America/New_York')->format('Y-m-d');
        $historico->created_at  = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
        $historico->updated_at  = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
        $historico->save();

        return;
    }

    private function historical_employee($employee_id, $original, $changes)
    {

        foreach($changes as $key => $datos)
        {
            if( $key != "updated_at" && $original[$key] != $datos)
            {
                $historico = new HistoricoCliente();
                $historico->user_id     = auth()->user()->id;
                $historico->employee_id = $employee_id;
                $historico->accion      = "The $key changed form {$original[$key]} to $datos";
                $historico->date        = Carbon::now('America/New_York')->format('Y-m-d');
                $historico->created_at  = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
                $historico->updated_at  = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
                $historico->save();

            }
        }

        return;
    }
}
