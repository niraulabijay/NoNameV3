<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="ion-close"></i>
    </button>

    <div class="left-side-logo d-block d-lg-none">
        <div class="text-center">

            <a href="index.html" class="logo"><img src="{{ asset('admin/assets/images/logo-dark.png') }}" height="20" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">

        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Examiner</li>

                <li>
                    <a href="{{ route('examiner.dashboard') }}" class="waves-effect">
                        <i class="dripicons-meter"></i>
                        <span> Dashboard <span class="badge badge-success badge-pill float-right">3</span></span>
                    </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-question"></i>
                        <span>Quiz Setup </span> <span class="menu-arrow float-right">
                            <i class="mdi mdi-chevron-right"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('examiner.quiz') }}">Quizzies</a></li>
                    </ul>
                </li>


                <li>
                    <a href="{{ route('examiner.profile') }}" class="waves-effect">
                        <i class="dripicons-user"></i>
                        <span> User <span class="badge badge-success badge-pill float-right">3</span></span>
                    </a>
                </li>



            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->
