<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/student/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ __('layouts/main-sidebar.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('layouts/main-sidebar.Program') }} </li>


        <!-- الامتحانات-->
        <li>
            <a href="{{ route('exam.index') }}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">الامتحانات</span></a>
        </li>


        <!-- Settings-->
        <li>
            <a href="{{ route('profileStudent.index') }}"><i class="fas fa-id-card-alt"></i><span class="right-nav-text">الملف
                    الشخصي</span></a>
        </li>

    </ul>
</div>
