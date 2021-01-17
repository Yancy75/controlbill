
<div class="menu_section active">
  <h3>General</h3>
    <ul class="nav side-menu" style="">
    <li><a href="{{ url('Dashboard_payroll') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    @if(auth()->user()->level == 'admin')
    <li><a><i class="fa fa-edit"></i> Settings <span class="fa fa-chevron-down"></span></a>
      <ul class="nav child_menu">
          <li><a href="{{ route('user_list') }}">Users</a></li>
          <li><a href="{{ route('supermarket_list') }}">Supermarket List</a></li>
          @if(session()->get('supermarket_id') >= 1)
        <li><a href="{{ route('general_setting_supermarket', ['id_supermarket' => session()->get('supermarket_id')]) }}">Supermarket Payroll</a></li>
          @endif
      </ul>
    </li>
    @endif
    @if(session()->get('supermarket_id') >= 1)
        <li><a><i class="fa fa-money"></i> Payroll <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
              <li><a href="{{ route('payroll_setting', ['id_supermarket' => session()->get('supermarket_id')]) }}">Run/View Payroll</a></li>
              <li><a href="{{ route('employees_list', ['id_supermarket' => session()->get('supermarket_id'), 'view' => 'a']) }}">Employees List</a></li>
          </ul>
        </li>

        <li><a><i class="fa fa-database"></i> Store Data <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{ route('view_sale', ['id_supermarket' => session()->get('supermarket_id')]) }}">Store Sales</a></li>
                <li><a href="{{ route('ver_reporte_department', ['id_supermarket' => session()->get('supermarket_id')]) }}">Departments</a></li>
                <li><a href="{{ route('view_purchase', ['id_supermarket' => session()->get('supermarket_id')]) }}">Purchase</a></li>
                <li><a href="{{ route('view_expenses', ['id_supermarket' => session()->get('supermarket_id')]) }}">Expense</a></li>
            </ul>
        </li>

        <li><a><i class="fa fa-file-text-o"></i> Reports <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{ route('view_report', ['id_supermarket' => session()->get('supermarket_id')]) }}">Store Sale Report</a></li>
            </ul>
        </li>
    @endif

    </ul>
</div>
