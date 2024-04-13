<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ __('layouts/main-sidebar.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('layouts/main-sidebar.Program') }} </li>

        <!-- Grades-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Grades-menu">
                <div class="pull-left"><i class="fas fa-school"></i><span
                        class="right-nav-text">{{ __('layouts/main-sidebar.Grades') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Grades-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('grade.index') }}">{{ __('layouts/main-sidebar.Grades_List') }}</a></li>

            </ul>
        </li>
        <!-- classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes-menu">
                <div class="pull-left"><i class="fa fa-building"></i><span
                        class="right-nav-text">{{ __('layouts/main-sidebar.classes') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('Classroom.index') }}">{{ __('layouts/main-sidebar.classes_List') }}</a></li>
            </ul>
        </li>


        <!-- sections-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                        class="right-nav-text">{{ __('layouts/main-sidebar.sections') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('sections.index') }}">{{ __('layouts/main-sidebar.sections_List') }}</a></li>
            </ul>
        </li>


        <!-- students-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i
                    class="fas fa-user-graduate"></i>{{ __('layouts/main-sidebar.students') }}<div class="pull-right">
                    <i class="ti-plus"></i>
                </div>
                <div class="clearfix"></div>
            </a>
            <ul id="students-menu" class="collapse">
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse"
                        data-target="#Student_information">{{ __('layouts/main-sidebar.Student_information') }}<div
                            class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Student_information" class="collapse">
                        <li> <a href="{{ route('students.create') }}">{{ __('layouts/main-sidebar.Add_student') }}</a>
                        </li>
                        <li> <a
                                href="{{ route('students.index') }}">{{ __('layouts/main-sidebar.students_List') }}</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse"
                        data-target="#Students_upgrade">{{ __('layouts/main-sidebar.Promotion') }}<div
                            class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Students_upgrade" class="collapse">
                        <li> <a href="{{ route('promotion.index') }}">{{ __('layouts/main-sidebar.Promotion') }}</a>
                        </li>
                        <li> <a
                                href="{{ route('promotion.create') }}">{{ __('layouts/main-sidebar.administration_Promotion') }}</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse"
                        data-target="#Graduate students">{{ __('layouts/main-sidebar.Graduate_students') }}<div
                            class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Graduate students" class="collapse">
                        <li> <a
                                href="{{ route('Graduated.create') }}">{{ __('layouts/main-sidebar.add_Graduate') }}</a>
                        </li>
                        <li> <a
                                href="{{ route('Graduated.index') }}">{{ __('layouts/main-sidebar.list_Graduate') }}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>



        <!-- Teachers-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i></i><span
                        class="right-nav-text">{{ __('layouts/main-sidebar.Teachers') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('teachers.index') }}">{{ __('layouts/main-sidebar.Teachers_List') }}</a> </li>
            </ul>
        </li>


        <!-- Parents-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                <div class="pull-left"><i class="fas fa-user-tie"></i><span
                        class="right-nav-text">{{ __('layouts/main-sidebar.Parents') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ url('add_parent') }}">{{ __('layouts/main-sidebar.Parents_List') }}</a> </li>
            </ul>
        </li>

        <!-- Accounts-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                        class="right-nav-text">{{ __('layouts/main-sidebar.Accounts') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('Fees.index') }}">الرسوم الدراسية</a> </li>
                <li> <a href="{{ route('Fees_Invoices.index') }}">الفواتير</a> </li>
                <li> <a href="{{ route('Receipt_Student.index') }}">سندات القبض</a> </li>
                <li> <a href="{{ route('ProcessingFee.index') }}">استبعاد رسوم</a> </li>
                <li> <a href="{{ route('Payment_students.index') }}">سندت الصرف</a> </li>
            </ul>
        </li>

        <!-- Attendance-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
                <div class="pull-left"><i class="fas fa-calendar-alt"></i><span
                        class="right-nav-text">{{ __('layouts/main-sidebar.Attendance') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('Attendance.index') }}">قائمة الطلاب</a> </li>
            </ul>
        </li>

        <!-- Subjects-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Subjects">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">المواد
                        الدراسية</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Subjects" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('subjects.index') }}">قائمة المواد</a> </li>
            </ul>
        </li>

        <!-- Quizzes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">الاختبارات</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('Quizzes.index') }}">قائمة الاختبارات</a> </li>
                {{-- <li> <a href="{{ route('questions.index') }}">قائمة الاسئلة</a> </li> --}}
            </ul>
        </li>


        <!-- library-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-icon">
                <div class="pull-left"><i class="fas fa-book"></i><span
                        class="right-nav-text">{{ __('layouts/main-sidebar.library') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="library-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('library.index') }}">قائمة الكتب</a> </li>
            </ul>
        </li>


        <!-- Online classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                <div class="pull-left"><i class="fas fa-video"></i><span
                        class="right-nav-text">{{ __('layouts/main-sidebar.Onlineclasses') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('online_classes.index') }}">حصص اونلاين مع زوم</a> </li>
            </ul>
        </li>


        <!-- Settings-->
        <li>
            <a href="{{ route('settings.index') }}"><i class="fas fa-cogs"></i><span
                    class="right-nav-text">{{ __('layouts/main-sidebar.Settings') }} </span></a>
        </li>



        <!-- Users-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Users-icon">
                <div class="pull-left"><i class="fas fa-users"></i><span
                        class="right-nav-text">{{ __('layouts/main-sidebar.Users') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Users-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('users.index') }}">قائمة المستخدمين</a> </li>
            </ul>
        </li>

        <!-- Profile -->
        <li>
            <a href="{{ route('profileUser.index') }}"><i class="fas fa-user"></i><span class="right-nav-text">الملف
                    الشخصي </span></a>
        </li>

    </ul>
</div>
