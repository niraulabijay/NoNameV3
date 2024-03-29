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
                <li class="menu-title">Main</li>

                <li>
                    <a href="index.html" class="waves-effect">
                        <i class="dripicons-meter"></i>
                        <span> Dashboard <span class="badge badge-success badge-pill float-right">3</span></span>
                    </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-briefcase"></i> <span> Setup </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('admin.categories') }}">Categories</a></li>
                        <li><a href="{{ route('admin.courses') }}">Courses</a></li>
                        <li><a href="{{ route('admin.subjects') }}">Subjects</a></li>
                        <li><a href="{{ route('admin.chapters') }}">Chapters</a></li>
                        <li><a href="{{ route('admin.questions') }}">Questions</a></li>
                    </ul>
                </li>

                {{--<li class="menu-title">Extra</li>--}}

                {{--<li class="has_sub">--}}
                    {{--<a href="javascript:void(0);" class="waves-effect"><i class="dripicons-location"></i><span> Maps </span> <span class="badge badge-danger badge-pill float-right">2</span></a>--}}
                    {{--<ul class="list-unstyled">--}}
                        {{--<li><a href="maps-google.html"> Google Map</a></li>--}}
                        {{--<li><a href="maps-vector.html"> Vector Map</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{----}}
                {{--<li>--}}
                    {{--<a href="calendar.html" class="waves-effect"><i class="dripicons-calendar"></i><span> Calendar </span></a>--}}
                {{--</li>--}}

                <li>
                    <a href="{{ route('admin.quiz') }}" class="waves-effect">
                        <i class="dripicons-meter"></i>
                        <span> Quiz <span class="badge badge-success badge-pill float-right">3</span></span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.user') }}" class="waves-effect">
                        <i class="dripicons-meter"></i>
                        <span> User <span class="badge badge-success badge-pill float-right">3</span></span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.note') }}" class="waves-effect">
                        <i class="dripicons-meter"></i>
                        <span> Note <span class="badge badge-success badge-pill float-right">3</span></span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.flashcard') }}" class="waves-effect">
                        <i class="dripicons-meter"></i>
                        <span> Flash Card <span class="badge badge-success badge-pill float-right">3</span></span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.questionset') }}" class="waves-effect">
                        <i class="dripicons-meter"></i>
                        <span>Question Set <span class="badge badge-success badge-pill float-right">3</span></span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.syllabi') }}" class="waves-effect">
                        <i class="dripicons-meter"></i>
                        <span>Syllabus <span class="badge badge-success badge-pill float-right">3</span></span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.notification') }}" class="waves-effect">
                        <i class="dripicons-meter"></i>
                        <span>Notification <span class="badge badge-success badge-pill float-right">3</span></span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('excel') }}" class="waves-effect">
                        <i class="dripicons-pamphlet"></i>
                        <span>Excel Upload</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.examiner') }}" class="waves-effect">
                        <i class="dripicons-meter"></i>
                        <span>Examiner <span class="badge badge-success badge-pill float-right">3</span></span>
                    </a>
                </li>


            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->
