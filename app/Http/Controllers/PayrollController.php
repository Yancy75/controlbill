<?php

namespace App\Http\Controllers;

use App\Employees;
use App\HistoricoCliente;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Supermarket;
use Carbon\Carbon;
use App\User;
use App\Department;
use App\Rolluser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PayrollController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payroll.login_payroll');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->level != 'admin')
        {
            return redirect()->back();
        }

        return view('payroll.add_supermarket');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->level != 'admin')
        {
            return redirect()->back();
        }

        $validatedData = $request->validate([
            'inputName' => 'required',
            'inputAddress' => 'required',
        ]);
        $input = $request->all();

        $supermarket = new Supermarket();

        $supermarket->name       = $input['inputName'];
        $supermarket->address    = $input['inputAddress'];
        $supermarket->status     = 'active';
        $supermarket->created_at = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
        $supermarket->updated_at = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
        $supermarket->save();
        return redirect()->route('supermarket_list');
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

    public function dashboard()
    {
        $info = [];
        $supermarket = Rolluser::where('user_id', '=', Auth::user()->id)
            ->leftjoin('supermarkets', 'rollusers.supermarket_id', '=', 'supermarkets.id')
            ->get();

        if($supermarket->isNotEmpty())
        {
            $info = $supermarket;
        }
        return view('payroll.dashboard', compact('info'));
    }

    public function supermarket()
    {
        //valido si el usuario tiene privilegios de administrador
        if(auth()->user()->level != 'admin')
        {
            return redirect()->back();
        }
        //----------------

        $supermarket = new Supermarket();

        $info_super  = $supermarket->all();
        $info = [];

        if($info_super->isNotEmpty())
        {
            $info = $info_super;
        }

        return view('payroll.list_supermarket', compact('info'));
    }

    public function userList()
    {
        if(auth()->user()->level != 'admin')
        {
            return redirect()->back();
        }

        $user = new User();
        $info_user = $user->all();
        $info = [];

        if($info_user->isNotEmpty())
        {
            $info = $info_user;
        }

        return view('payroll.user_list', compact('info'));
    }

    public function addUser()
    {
        if(auth()->user()->level != 'admin')
        {
            return redirect()->back();
        }

        return view('payroll.add_user');
    }

    public function addingUser(Request $request)
    {
        if(auth()->user()->level != 'admin')
        {
            return redirect()->back();
        }

        $info = $request->all();

        $user = new User();

        $user->name = $info['inputName'];
        $user->username = $info['inputUsername'];
        $user->email = $info['inputEmail'];
        $user->password = Hash::make($info['inputPassword']);
        $user->status = 'active';
        $user->level = $info['inputLevel'];
        $user->created_at = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
        $user->updated_at = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
        $user->save();
        return redirect()->route('user_list');
    }

    public function modifySupermarket($id)
    {
        $super = Supermarket::find($id);

        $department = Department::where('supermarket_id', '=', $super->id)->get();

        $dep = [];

        if($department->isNotEmpty())
        {
            $dep = $department;
        }

        return view('payroll.modify_supermarket', compact('super', 'dep'));
    }

    public function modifyingSupermarket($id, Request $request)
    {
        $info = $request->all();

        $supermarket = Supermarket::find($id);

        $supermarket->name = $info["inputName"];
        $supermarket->address = $info["inputAddress"];
        $supermarket->status = $info["inputStatus"];
        $supermarket->save();

        return redirect()->back();
    }

    public function departmentList($id)
    {
        $super = Supermarket::find($id);

        if(auth()->user()->level != 'admin')
        {
            return redirect()->back();
        }

        $department = Department::where('supermarket_id', '=', $id)->get();

        $info = [];


        if($department->isNotEmpty())
        {
            $info = $department;
        }

        return view('payroll.department_list', compact('info', 'super'));
    }

    public function departmentAdd(Request $request)
    {
        $department = new Department();
        $datos      = $request->all();

        $department->supermarket_id = $datos['dato'][0];
        $department->name           = $datos['dato'][1];
        $department->status         = "active";
        $department->created_at = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
        $department->updated_at = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
        $department->save();
        return response()->json($datos['dato'][0]);
    }

    public function departmentModify(Request $request)
    {
        $info = $request->all();

        $department = Department::find($info['dato'][0]);

        $department->name   = $info['dato'][1];
        $department->status = $info['dato'][2];

        $department->save();

        return response()->json('Updated');

    }

    public function rollUserList($id)
    {
        if(auth()->user()->level != 'admin')
        {
            return redirect()->back();
        }

        $supermarket = Supermarket::find($id);

        $user = User::where('status', '=', 'active')->get();

        $roll_user = Rolluser::where('supermarket_id', '=', $id)->get();

        $info = [];
        if($roll_user->isNotEmpty())
        {
            $c = 0;
            foreach ($user as $u)
            {
                $info[$c]['user_id']        = $u->id;
                $info[$c]['name']           = $u->name;
                $info[$c]['level']          = $u->level;
                $info[$c]['supermarket_id'] = $id;

                foreach ($roll_user as $ru)
                {
                    if($ru->user_id == $u->id)
                    {
                        $info[$c]['roll_id']     = $ru->id;
                    }
                    elseif(!array_key_exists('roll_id',$info[$c])){
                        $info[$c]['roll_id']     = 0;
                    }
                }
                $c++;
            }
        }
        else
        {
            $c = 0;
            foreach ($user as $u)
            {
                $info[$c]['user_id']        = $u->id;
                $info[$c]['name']           = $u->name;
                $info[$c]['level']          = $u->level;
                $info[$c]['roll_id']        = 0;
                $info[$c]['supermarket_id'] = $id;

                $c++;
            }
        }
        return view("payroll.list_user_roll_super", compact('info', 'supermarket'));
    }

    public function rollIn($user_id, $super_id)
    {
        if(auth()->user()->level != 'admin')
        {
            return redirect()->back();
        }

        $roll = new Rolluser();

        $roll->supermarket_id = $super_id;
        $roll->user_id = $user_id;
        $roll->created_at = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
        $roll->updated_at = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
        $roll->save();

        return redirect()->back();
    }

    public function rollOut($id)
    {
        if(auth()->user()->level != 'admin')
        {
            return redirect()->back();
        }

        $roll = Rolluser::find($id);
        $roll->delete();

        return redirect()->back();
    }

    public function modifyUser($id)
    {
        if(auth()->user()->level != 'admin')
        {
            return redirect()->back();
        }

        $user = User::find($id);

        return view('payroll.modify_user', compact('user'));
    }

    public function modifyingUser($id, Request $request)
    {
        if(auth()->user()->level != 'admin')
        {
            return redirect()->back();
        }

        $user = User::find($id);
        $info = $request->all();

        $user->name     = $info['inputName'];
        $user->username = $info['inputUsername'];
        $user->email    = $info['inputEmail'];
        $user->status   = $info['inputStatus'];
        $user->level    = $info['inputLevel'];
        $user->save();
        return redirect()->back();
    }

    public function passwordUser($id)
    {
        if(auth()->user()->level != 'admin')
        {
            return redirect()->back();
        }

        $user = User::find($id);

        return view('payroll.password_user', compact('user'));
    }

    public function passwordChangeUser($id, Request $request)
    {
        if(auth()->user()->level != 'admin')
        {
            return redirect()->back();
        }

        $user = User::find($id);

        $user->password = Hash::make($request->input('inputPassword'));

        $user->save();

        return redirect()->route('modify_user', ['id' => $id]);
    }

    public function selectSupermarket($id)
    {
        $info = [];
        $supermarket = Rolluser::where('user_id', '=', Auth::user()->id)
            ->leftjoin('supermarkets', 'rollusers.supermarket_id', '=', 'supermarkets.id')
            ->get();

        if($supermarket->isNotEmpty())
        {
            $info = $supermarket;
            session()->put('supermarket_id', $id);
            $super_seleccionado = Supermarket::find($id);
            session()->put('supermarket_name_s', $super_seleccionado->name);
        }
        return view('payroll.dashboard', compact('info'));
    }

    public function employeeList($id_supermarket, $view = 'a')
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $employees = [];
        if($view == 'a')
        {
            $employees = Employees::select('*', 'employees.supermarket_id as empsupermarket_id', 'employees.name as empname', 'departments.name as depname', 'employees.status as empstatus', 'employees.id as emplid')
                ->where('employees.supermarket_id', '=', $id_supermarket)
                ->where('employees.status', '=', 'active')
                ->leftjoin('departments', 'employees.department_id', '=', 'departments.id')
                ->get();
        }
        elseif ($view == 't')
        {
            $employees = Employees::select('*', 'employees.supermarket_id as empsupermarket_id', 'employees.name as empname', 'departments.name as depname', 'employees.status as empstatus', 'employees.id as emplid')
                ->where('employees.supermarket_id', '=', $id_supermarket)
                ->where('employees.status', '=', 'inactive')
                ->leftjoin('departments', 'employees.department_id', '=', 'departments.id')
                ->get();
        }
        elseif ($view == 'al')
        {
            $employees = Employees::select('*', 'employees.supermarket_id as empsupermarket_id', 'employees.name as empname', 'departments.name as depname', 'employees.status as empstatus', 'employees.id as emplid')
                ->where('employees.supermarket_id', '=', $id_supermarket)
                ->leftjoin('departments', 'employees.department_id', '=', 'departments.id')
                ->get();
        }

        $supermarket = Supermarket::find($id_supermarket);
        $info = [];

        if($employees->isNotEmpty())
        {
            $info = $employees;
        }
        return view('payroll.list_employee', compact('info', 'supermarket', 'view'));
    }

    public function employeeAdd($id_supermarket)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $supermarket = Supermarket::find($id_supermarket);
        $department  = Department::where('supermarket_id', '=', $id_supermarket)
            ->where('status', '=', 'active')
            ->get();
        return view('payroll.add_employee', compact('supermarket', 'department'));
    }

    public function addingEmployee(Request $request)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $employee = new Employees();
        $data     = $request->all();
        $date     = new Carbon($data["inputHiredDate"]);

        $employee->supermarket_id = $data['inputIdSupermarket'];
        $employee->department_id  = $data['inputDepartment'];
        $employee->name           = $data['inputName'];
        $employee->last_name      = $data['inputLastName'];
        $employee->address        = $data['inputAddress'];
        $employee->city           = $data['inputCity'];
        $employee->state          = $data['inputState'];
        $employee->zip_code       = $data['inputZip'];
        $employee->gender         = $data['inputGender'];

        //Busco la expresion regular para eliminar los parentesis, el guion y los espacios en blanco
        $pattern ="/[()-]*\s*/";
        $replacement = '';

        $employee->mobil             = preg_replace($pattern, $replacement, $data['inputMobil']);
        $employee->emergency_phone   = preg_replace($pattern, $replacement, $data['inputEmergencyPhone']);
        $employee->emergency_contact = $data['inputEmergencyContact'];
        $employee->email             = $data['inputEmail'];
        $employee->level             = 'normal';
        $employee->inicial_date      = $date->format('Y-m-d');
        $employee->status            = 'active';
        $employee->created_at        = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
        $employee->updated_at        = Carbon::now('America/New_York')->format('Y-m-d h:i:s');
        $employee->save();

        //Llamo la function para crear el historico. en este caso como se esta creando el empleado no tengo que mandar nada
        $this->historical_created_employee($employee);

        return redirect()->route('employee_payroll_setting', ['id' => $employee->id, 'view_modify' => 'm']);
//        return redirect()->route('employees_list', ['id_supermarket' => $data['inputIdSupermarket']]);
    }

    public function modifyEmployee($id, $view_modify)
    {
        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $employee    = Employees::find($id);
        $department  = Department::where('supermarket_id', '=', $employee->supermarket_id)->get();
        $dep_usuario = 'None';

        if($department->isNotEmpty())
        {
            foreach ($department as $dep)
            {
                if($dep->id == $employee->department_id)
                {
                    $dep_usuario = $dep->name;
                }
            }
        }

        if(!is_null($employee->inicial_date))
        {
            $date_i = new Carbon(str_replace('-', '/',$employee->inicial_date));
            $employee->inicial_date = $date_i->format('m/d/Y');
        }

        if(!is_null($employee->end_date))
        {
            $date_e = new Carbon(str_replace('-', '/',$employee->end_date));
            $employee->end_date = $date_e->format('m/d/Y');
        }

        if(!is_null($employee->rehide_date))
        {
            $date_r = new Carbon(str_replace('-', '/',$employee->rehide_date));
            $employee->rehide_date = $date_r->format('m/d/Y');
        }

        $historico = HistoricoCliente::where('employee_id', '=', $id)
                    ->leftJoin('users', 'historico_clientes.user_id', '=', 'users.id')
                    ->orderBy('historico_clientes.id', 'desc')
                    ->get();
        return view('payroll.modify_employee', compact('employee', 'department', 'dep_usuario', 'view_modify', 'historico'));
    }

    public function modifyingEmployee($id, Request $request)
    {

        if(empty(session()->get('supermarket_id')))
        {
            return redirect('Dashboard_payroll');
        }
        $employee = Employees::find($id);
        $info     = $request->all();
        $date     = new Carbon($info["inputHiredDate"]);

        $employee->name          = $info['inputName'];
        $employee->last_name     = $info['inputLastName'];
        $employee->address       = $info['inputAddress'];

        //Busco la expresion regular para eliminar los parentesis, el guion y los espacios en blanco
        $pattern ="/[()-]*\s*/";
        $replacement = '';
        $employee->city              = $info['inputCity'];
        $employee->state             = $info['inputState'];
        $employee->zip_code          = $info['inputZip'];
        $employee->gender            = $info['inputGender'];
        $employee->mobil             = preg_replace($pattern, $replacement, $info['inputMobil']);
        $employee->email             = $info['inputEmail'];
        $employee->emergency_contact = $info['inputEmergencyContact'];
        $employee->emergency_phone   = preg_replace($pattern, $replacement, $info['inputEmergencyPhone']);
        $employee->inicial_date      = $date->format('Y-m-d');
        $employee->department_id     = $info['inputDepartment'];

        if (!(array_key_exists('inputFiredDate', $info)&&array_key_exists('inputReasonFiredDate', $info)))
        {

        }
        elseif(is_null($info['inputFiredDate']) || is_null($info['inputReasonFiredDate']))
        {
            if(is_null($info['inputFiredDate']) && is_null($info['inputReasonFiredDate']))
            {

            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'inputFiredDate' => 'required',
                    'inputReasonFiredDate' => 'required',
                ]);
                return redirect()->back()->withError($validator->errors())->withInput();
            }
        }
        elseif (!is_null($info['inputFiredDate']) && !is_null($info['inputReasonFiredDate']))
        {
            $date_end                = new Carbon($info["inputFiredDate"]);
            $employee->end_date      = $date_end->format('Y-m-d');
            $employee->reason        = $info['inputReasonFiredDate'];
            $employee->authorized_by = $info['inputauthorizedBy'];
            $employee->detail        = $info['inputDetail'];
            $employee->status        = 'inactive';
        }

        //Rehide
        if(array_key_exists("inputauthorizedRehideBy", $info))
        {
            if(!empty($info['inputReHiredDate']))
            {
                $date_rehide                    = new Carbon($info["inputReHiredDate"]);
                $employee->authorized_rehide_by = $info['inputauthorizedRehideBy'];
                $employee->rehide_date          = $date_rehide->format('Y-m-d');
                $employee->rehired              = 'si';
                $employee->status               = 'active';
            }
        }

        //Obtengo los atributos originales antes de cambiarlos
        $original = $employee->getOriginal();
        $employee->save();

        //Solo obtengo los cambios que se hicieron. debo grabarlo antes de sacar los cambios
        $changes  = $employee->getChanges();

        $this->historical_employee($id, $original, $changes);

        return redirect()->back();

    }

    private function historical_created_employee($data)
    {
        $historico = new HistoricoCliente();

        $historico->user_id     = auth()->user()->id;
        $historico->employee_id = $data->id;
        $historico->accion      = 'Employee Created';
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
            if( $key != "updated_at")
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
