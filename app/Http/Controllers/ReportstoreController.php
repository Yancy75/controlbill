<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Payrollset;
use App\Purchase;
use App\Sale;
use App\Supermarket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportstoreController extends Controller
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

        $info = [];
        $supermarket = Supermarket::find($id_supermarket);
        return view('report.view_report', compact('supermarket', 'info'));
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
     * @param  int  $id_supermarket
     * @return \Illuminate\Http\Response
     */
    public function show($id_supermarket, Request $request)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $data     = $request->all();
        $datei    = $data["inputDate"];
        $datef    = $data["inputDatef"];
        $payroll  = $this->calculoPayroll($data["inputDate"], $data["inputDatef"]);
        $purchase = $this->calculoPurchase($data["inputDate"], $data["inputDatef"]);
        $sale     = $this->calculoSale($data["inputDate"], $data["inputDatef"]);
        $expense  = $this->calculoExpense($data["inputDate"], $data["inputDatef"]);
        $info     = 'Report';
        $supermarket = Supermarket::find($id_supermarket);

        return view('report.view_report', compact('supermarket', 'payroll', 'purchase', 'sale', 'expense', 'datei', 'datef', 'info'));
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

    private function calculoPayroll($date, $datef)
    {
        $d  = new Carbon(str_replace('-', '/',$date));
        $df = new Carbon(str_replace('-', '/',$datef));

        $payroll_set_all_period  = [];
        $monto_por_departamentos = [];
        $total                   = 0;
        $datos                   = [];

        $week_number_d  = $d->week();
        $week_number_df = $df->week();
        for($i = $week_number_d; $i <= $week_number_df; $i++)
        {
            $week_start  = $d->week($i)->startOfWeek(Carbon::SUNDAY)->format('Y-m-d');
            $payrollset = Payrollset::select('employees.id as emp_id', 'payrollsets.id as ps_id'
            , 'employees.department_id as emp_dep_id', 'payrollsets.*'
            , 'reportpayrolldepartments.report_department_id as report_dep_id', 'reportdeparments.name as report_dep_name'
            , 'generalsets.regular_hours as gen_regular_hours', 'generalsets.porcentage as ge_porcentage')
                ->leftJoin('employees','employees.id', '=', 'payrollsets.employee_id')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->leftJoin('reportpayrolldepartments', 'reportpayrolldepartments.payroll_department_id', '=', 'departments.id')
                ->leftJoin('reportdeparments', 'reportpayrolldepartments.report_department_id', '=', 'reportdeparments.id')
                ->leftJoin('generalsets', 'payrollsets.supermarket_id', '=', 'generalsets.supermarket_id')
                ->leftJoin('supermarkets', 'payrollsets.supermarket_id', '=', 'supermarkets.id')
                ->where("period_starting", '=', $week_start)
                ->where("employees.status", '=', 'active')
                ->where("reportpayrolldepartments.status", '=', 'active')
                ->where("supermarkets.status", '=', 'active')
                ->get();
            if($payrollset->isNotEmpty())
            {
                $payroll_set_all_period[] = $payrollset;
            }
        }

        foreach($payroll_set_all_period as $ps)
        {
            //Repaso todos el arregle para hacer los calculos correspondientes
            foreach ($ps as $p)
            {
                // primero valido si ese key NO existe. Si NO existe inicializo las variables de control de calculo
                if (!array_key_exists($p->report_dep_name, $monto_por_departamentos))
                {
                    $monto_por_departamentos[$p->report_dep_name]['pto']       = 0;
                    $monto_por_departamentos[$p->report_dep_name]['overTime']  = 0;
                    $monto_por_departamentos[$p->report_dep_name]['grossWage'] = 0;
                    $monto_por_departamentos[$p->report_dep_name]['totalWage'] = 0;
                    $monto_por_departamentos[$p->report_dep_name]['taxes']     = 0;
                    $monto_por_departamentos[$p->report_dep_name]['netWage']   = 0;
                    $monto_por_departamentos[$p->report_dep_name]['bonus']     = 0;
                }
                //Calculo el grossWage = hora regular * el valor de las horas
                //Valido si hay horas extras
                if($p->working_hours > $p->gen_regular_hours)
                {
                    $gross_wage = $p->gen_regular_hours * $p->pay_hour;
                    $monto_por_departamentos[$p->report_dep_name]['grossWage'] += $gross_wage;

                    $over_time_hours = $p->working_hours - $p->gen_regular_hours;
                    $over_time_date  = $p->pay_hour * (1+($p->ge_porcentage/100));
                    $monto_por_departamentos[$p->report_dep_name]['overTime'] += $over_time_hours * $over_time_date;
                }
                else
                {
                    $gross_wage = $p->working_hours * $p->pay_hour;
                    $monto_por_departamentos[$p->report_dep_name]['grossWage'] += $gross_wage;
                }

                //calculo los PTO
                if($p->pto > 0)
                {
                    $pto = $p->pto * $p->pay_hour;
                    $monto_por_departamentos[$p->report_dep_name]['pto'] += $pto;
                }

                // Calculo el total Wage es es la suma del grossWage + OverTime + PTO
                //No le sumo para atras el TOTALWAGE por que el arreglo con las variables gross, overtime y pto van a cumulando los valores y solo quiero quedarme con el ultimo calculo
                $monto_por_departamentos[$p->report_dep_name]['totalWage'] = $monto_por_departamentos[$p->report_dep_name]['grossWage'] + $monto_por_departamentos[$p->report_dep_name]['overTime'] + $monto_por_departamentos[$p->report_dep_name]['pto'];

                //Taxes
                $monto_por_departamentos[$p->report_dep_name]['taxes'] += $p->taxes;

                //bonus
                $monto_por_departamentos[$p->report_dep_name]['bonus'] += $p->ajust_bonus;

                //NetWage
                $monto_por_departamentos[$p->report_dep_name]['netWage'] = $monto_por_departamentos[$p->report_dep_name]['totalWage'] - $monto_por_departamentos[$p->report_dep_name]['taxes'] + $monto_por_departamentos[$p->report_dep_name]['bonus'];

            }
        }

        //Recorro todos los departamentos para calcular el total sin departamento
        foreach($monto_por_departamentos as $m)
        {
            $total += $m['netWage'];
        }
        $datos['total'] = $total;
        $datos['departamentos'] = $monto_por_departamentos;
        return $datos;
    }

    private function calculoPurchase($date, $datef)
    {
        $monto_por_departamentos = [];
        $total                   = 0;
        $datos                   = [];

        $d  = new Carbon(str_replace('-', '/',$date));
        $df = new Carbon(str_replace('-', '/',$datef));

        //Obtengo el dia del domingo de esa semana para contar toda la semana
        $first_day_week_d  = $d->startOfWeek(Carbon::SUNDAY)->format('Y-m-d');

        //Obtengo el dia del sabado, ultimo dia, de esa semana para contar toda la semana
        $first_day_week_df = $df->endOfWeek(Carbon::SATURDAY)->format('Y-m-d');

        $purchase = Purchase::select('reportdeparments.*', 'purchases.*', 'reportdeparments.id as report_dep_id', 'purchases.id as purchase_id')
            ->leftJoin('reportdeparments', 'purchases.report_department_id', '=', 'reportdeparments.id')
            ->leftJoin('supermarkets', 'purchases.supermarket_id', '=', 'supermarkets.id')
            ->whereBetween('date', [$first_day_week_d, $first_day_week_df])
            ->where('purchases.status', '=', 'active')
            ->where("supermarkets.status", '=', 'active')
            ->get();

        foreach ($purchase as $p)
        {
            if (!array_key_exists($p->name, $monto_por_departamentos))
            {
                $monto_por_departamentos[$p->name]['total'] = 0;
            }
            $monto_por_departamentos[$p->name]['total'] += $p->amount;
        }

        foreach($monto_por_departamentos as $m)
        {
            $total += $m['total'];
        }
        $datos["total"]         = $total;
        $datos["departamentos"] = $monto_por_departamentos;

        return $datos;
    }

    private function calculoSale($date, $datef)
    {
        $monto_por_departamentos = [];
        $total                   = 0;
        $datos                   = [];

        $d  = new Carbon(str_replace('-', '/',$date));
        $df = new Carbon(str_replace('-', '/',$datef));

        //Obtengo el dia del domingo de esa semana para contar toda la semana
        $first_day_week_d  = $d->startOfWeek(Carbon::SUNDAY)->format('Y-m-d');

        //Obtengo el dia del sabado, ultimo dia, de esa semana para contar toda la semana
        $first_day_week_df = $df->endOfWeek(Carbon::SATURDAY)->format('Y-m-d');

        $sale = Sale::select('reportdeparments.*', 'sales.*', 'reportdeparments.id as report_dep_id', 'sales.id as sale_id')
            ->leftJoin('reportdeparments', 'sales.report_department_id', '=', 'reportdeparments.id')
            ->leftJoin('supermarkets', 'sales.supermarket_id', '=', 'supermarkets.id')
            ->whereBetween('date', [$first_day_week_d, $first_day_week_df])
            ->where('sales.status', '=', 'active')
            ->where("supermarkets.status", '=', 'active')
            ->get();

        foreach ($sale as $p)
        {
            if (!array_key_exists($p->name, $monto_por_departamentos))
            {
                $monto_por_departamentos[$p->name]['total'] = 0;
            }
            $monto_por_departamentos[$p->name]['total'] += $p->amount;
        }

        foreach($monto_por_departamentos as $m)
        {
            $total += $m['total'];
        }
        $datos["total"]         = $total;
        $datos["departamentos"] = $monto_por_departamentos;

        return $datos;
    }

    private function calculoExpense($date, $datef)
    {
        $monto_por_departamentos = [];
        $total                   = 0;
        $datos                   = [];

        $d  = new Carbon(str_replace('-', '/',$date));
        $df = new Carbon(str_replace('-', '/',$datef));

        //Obtengo el dia del domingo de esa semana para contar toda la semana
        $first_day_week_d  = $d->startOfWeek(Carbon::SUNDAY)->format('Y-m-d');

        //Obtengo el dia del sabado, ultimo dia, de esa semana para contar toda la semana
        $first_day_week_df = $df->endOfWeek(Carbon::SATURDAY)->format('Y-m-d');

        $expense = Expense::select('expenses.*')
            ->leftJoin('supermarkets', 'expenses.supermarket_id', '=', 'supermarkets.id')
            ->whereBetween('date', [$first_day_week_d, $first_day_week_df])
            ->where('expenses.status', '=', 'active')
            ->where("supermarkets.status", '=', 'active')
            ->get();

        foreach ($expense as $p)
        {
            if (!array_key_exists($p->concept, $monto_por_departamentos))
            {
                $monto_por_departamentos[$p->concept]['total'] = 0;
            }
            $monto_por_departamentos[$p->concept]['total'] += $p->amount;
        }

        foreach($monto_por_departamentos as $m)
        {
            $total += $m['total'];
        }
        $datos["total"]         = $total;
        $datos["departamentos"] = $monto_por_departamentos;

        return $datos;
    }
}
