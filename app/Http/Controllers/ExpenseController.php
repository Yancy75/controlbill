<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Supermarket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
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

        $info    = [];
        $expense = Expense::where('supermarket_id', '=', $id_supermarket)->get();

        if($expense->isNotEmpty())
        {
            $c = 0;
            foreach($expense as $p)
            {
                $info[$c]           = $p;
                $date               = new Carbon($p->date);
                $info[$c]['date_f'] = $date->format('m-d-Y');
                $c++;
            }
        }
        return view('report.view_expenses', compact('info', 'id_supermarket'));
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
        $supermarket = Supermarket::find($id_supermarket);

        return view('report.add_expense', compact('supermarket'));
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

        $expense = new Expense();

        $expense->supermarket_id = $dato["inputIdSupermarket"];
        $expense->concept        = $dato["inputConcept"];
        $expense->date           = $datebd;
        $expense->amount         = $dato["inputAmount"];
        $expense->status         = "active";

        $expense->save();
        return redirect()->route('view_expenses', ['id_supermarket' => $dato["inputIdSupermarket"]]);
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
     * @param  int  $id_expense
     * @param  int  $id_supermarket
     * @return \Illuminate\Http\Response
     */
    public function edit($id_expense, $id_supermarket)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $info        = [];
        $supermarket = Supermarket::find($id_supermarket);
        $expense     = Expense::where("id", "=", $id_expense)->get();

        if($expense->isNotEmpty())
        {
            $info            = $expense[0];
            $date            = new Carbon($expense[0]->date);
            $info->date_show = $date->format('m-d-Y');
        }
        return view('report.modify_expense', compact('info', 'supermarket'));
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
        $expense = Expense::find($data['inputIdExpense']);
        $date = new Carbon(str_replace('-', '/',$data["inputDate"]));

        $expense->concept = $data["inputConcept"];
        $expense->amount  = $data["inputAmount"];
        $expense->date    = $date->format('Y-m-d');
        $expense->status  = $data["inputStatus"];
        $expense->save();

        return redirect()->route('modify_expense', ['id_expense' => $expense->id, 'id_supermarket' => $id_supermarket]);
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
