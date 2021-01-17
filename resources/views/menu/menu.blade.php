<div class="menu_section active">
<h3>General Bills</h3>
<ul class="nav side-menu">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a><i class="fa fa-credit-card"></i> Bills <span class="fa fa-chevron-down"></span></a>
      <ul class="nav child_menu">
        <li><a href="{{ asset('/') }}">Add bill</a></li>
        <li><a href="{{ route('getBill') }}">Bills</a></li>
      </ul>
    </li>
    <li><a><i class="fa fa-line-chart"></i> Vendor <span class="fa fa-chevron-down"></span></a>
      <ul class="nav child_menu">
        <li><a href="{{ route('formVendor') }}">Add Vendor</a></li>
      {{--  <li><a href="#">Ver Reportes2</a></li> --}}
      </ul>
    </li>
    <li><a><i class="fa fa-paste"></i> Reports <span class="fa fa-chevron-down"></span></a>
      <ul class="nav child_menu">
        <li><a href="{{ route('getReport') }}">Report</a></li>
        <li><a href="{{ route('getReport2') }}">Report PLU</a></li>
      </ul>
    </li>
</ul>
</div>
