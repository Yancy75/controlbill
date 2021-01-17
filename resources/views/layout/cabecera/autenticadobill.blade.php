<div class="col-md-3 left_col meto1">
    <div class="scroll-view ">
      <div class="navbar nav_title" style="border: 0;">
        <a href="{{ url('/') }}" class="site_title logo"><img src="{{ asset('images/Goldenicon.png') }}" class="logoy"><span> ControlBill! UNO</span></a>
      </div>
      <div class="clearfix"></div>
      <br>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            @include('menu.menu')
        </div>
    </div>
  </div>
<div class="top_nav">
       <div class="nav_menu meto">
           <div class="nav toggle"><a id="menu_toggle"><i class="fa fa-bars"></i></a></div>
         <nav class="nav navbar-nav">
            <ul class=" navbar-right auten">
              <li class="nav-item dropdown open" style="padding-right: 2em;">
                 <a href="#" class="btn btn-info by"  id="modal"><i class="fa fa-user"></i></a>
              </li>
              <li class="nav-item" style="/*padding-right: 30em;*/">
                 <img src="{{ asset('images/Goldensombra.png') }}" class="goldenlog1">
               </li>
            <!-- <li class="nav-item" style="padding-left: 15px;"><a href="{{ route('controlBill') }}" type="button" class="btn btn-primary by"><i class="fa fa-files-o"></i> Control Bills</a></li>
             <li class="nav-item"><a href="{{ route('payRoll') }}" type="button" class="btn btn-success by"><i class="fa fa-money"></i> Payroll</a></li>-->
           </ul>
         </nav>
       </div>
     </div>
