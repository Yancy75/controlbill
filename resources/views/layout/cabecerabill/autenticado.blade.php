<style>
.dropdown-menu { top: 13px !important;}
</style>
<div class="col-md-3 left_col meto1">
    <div class="scroll-view">
      <div class="navbar nav_title" style="border: 0;">
        <a href="{{ url('/') }}" class="site_title logo"><img src="{{ asset('images/Goldenicon.png') }}" class="logoy"><span> ControlBill! DOS</span></a>
      </div>
      <div class="clearfix"></div>
      <br>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          @include('menu.menu_payroll')
        </div>
    </div>
  </div>
<div class="top_nav">
<div class="nav_menu meto">
    <div class="nav toggle"><a id="menu_toggle"><i class="fa fa-bars"></i></a></div>
    <nav class="nav navbar-nav">
        <ul class=" navbar-right">
          <li class="nav-item dropdown open" style="padding-top: .8em;">
             <a href="javascript:;" class="btn btn-info by dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-user"></i></a>
               <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                 <a class="dropdown-item" href="#" id="modal"><i class="fa fa-sign-out pull-right"></i> LogOut</a>
               </div>
          </li>
          <li class="nav-item" style="padding-right: 1em;">
             <img src="{{ asset('images/Goldensombra.png') }}" class="goldenlog1">
           </li>
        </ul>
  </nav>
</div>
</div>
