<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
            <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>

        <li class="nav-item has-treeview {{ request()->is('website/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-head-side-cough"></i>
                <p>
                    Manage Website
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('view.headline') }}" class="nav-link {{ request()->is('website/view/headline') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Headline</p>
                    </a>
                </li>
                <li class="nav-item open">
                    <a href="{{ route('view.description') }}" class="nav-link {{ request()->is('website/view/description') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Main Description</p>
                    </a>
                </li>
                <li class="nav-item open">
                    <a href="{{ route('view.slider') }}" class="nav-link {{ request()->is('website/view/slider') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Slider</p>
                    </a>
                </li>
                <li class="nav-item open">
                    <a href="{{ route('view.notice') }}" class="nav-link {{ request()->is('website/view/notice') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Noticeboard</p>
                    </a>
                </li>
                <li class="nav-item open">
                    <a href="{{ route('view.date') }}" class="nav-link {{ request()->is('website/view/date') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Result Published Date</p>
                    </a>
                </li>
                <li class="nav-item open">
                    <a href="{{ route('view.admission') }}" class="nav-link {{ request()->is('website/view/admission') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Admission</p>
                    </a>
                </li>
            </ul>
        </li>

        @if(Auth::user()->role == 'Admin')
            <li class="nav-item has-treeview {{ request()->is('users/*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Manage User
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview open">
                    <li class="nav-item open">
                        <a href="{{ route('view.user') }}" class="nav-link {{ request()->is('users/view') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View User</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endif


        <li class="nav-item has-treeview {{ request()->is('profile/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-circle"></i>
                <p>
                    Manage Profile
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('view.profile') }}" class="nav-link {{ request()->is('profile/view') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Profile</p>
                    </a>
                </li>
                <li class="nav-item open">
                    <a href="{{ route('change.password') }}" class="nav-link {{ request()->is('profile/change/password') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Change Password</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview {{ request()->is('setup/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>
                    Manage Setup
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('view.class') }}" class="nav-link {{ request()->is('setup/view/class') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Student Class</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('view.year') }}" class="nav-link {{ request()->is('setup/view/year') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Student Year</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('view.fee.category') }}" class="nav-link {{ request()->is('setup/view/free/category') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fee Category</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('view.fee.amount') }}" class="nav-link {{ request()->is('setup/view/fee/amount') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fee Category Amount</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('view.exam') }}" class="nav-link {{ request()->is('setup/view/exam') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Exam Type</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('view.subject') }}" class="nav-link {{ request()->is('setup/view/subject') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Subject</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('view.assign.subject') }}" class="nav-link {{ request()->is('setup/view/assign/subject') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Assign Subject</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('view.designation') }}" class="nav-link {{ request()->is('setup/view/designation') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Designation</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview {{ request()->is('student/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-graduate"></i>
                <p>
                    Student Managment
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('view.student') }}" class="nav-link {{ request()->is('student/view') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Student Registration</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('view.student.roll') }}" class="nav-link {{ request()->is('student/view/roll') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Roll Generate</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('view.student.attendance') }}" class="nav-link {{ request()->is('student/view/attendance') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Student Attendance</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('view.student.reg.fee') }}" class="nav-link {{ request()->is('student/reg/fee/view') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Registration Fee</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('view.student.monthly.fee') }}" class="nav-link {{ request()->is('student/monthly/fee/view') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Monthly Fee</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('view.student.exam.fee') }}" class="nav-link {{ request()->is('student/exam/fee/view') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Exam Fee</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview {{ request()->is('employee/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-secret"></i>
                <p>
                     Manage Employee
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('view.employee') }}" class="nav-link {{ request()->is('employee/view') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Employee Registration</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('view.employee.salary') }}" class="nav-link {{ request()->is('employee/view/salary') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Employee Salary</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('view.employee.leave') }}" class="nav-link {{ request()->is('employee/view/leave') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Employee Leave</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('view.employee.attendance') }}" class="nav-link {{ request()->is('employee/view/attendance') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Employee Attendance</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('view.employee.monthly.salary') }}" class="nav-link {{ request()->is('employee/view/monthly/salary') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Monthly Salary</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview {{ request()->is('marks/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Marks Managment
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('add.marks') }}" class="nav-link {{ request()->is('marks/add') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Marks Entry</p>
                    </a>
                </li>
                <li class="nav-item open">
                    <a href="{{ route('edit.marks') }}" class="nav-link {{ request()->is('marks/edit') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Edit Marks</p>
                    </a>
                </li>
                <li class="nav-item open">
                    <a href="{{ route('view.grade') }}" class="nav-link {{ request()->is('marks/view/grade') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Grade Points</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview {{ request()->is('account/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-calculator"></i>
                <p>
                    Account Managment
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('view.student.fee') }}" class="nav-link {{ request()->is('account/view/student/fee') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Student Fee</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('account.view.employee.salary') }}" class="nav-link {{ request()->is('account/view/employee/salary') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Employee Salary</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('view.other.cost') }}" class="nav-link {{ request()->is('account/view/other/cost') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Other Cost</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview {{ request()->is('reports/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-database"></i>
                <p>
                    Report Managment
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('report.view.profit') }}" class="nav-link {{ request()->is('reports/view/profit') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Monthly Profit</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('report.view.marksheet') }}" class="nav-link {{ request()->is('reports/view/marksheet') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Marksheet</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('report.view.attendance') }}" class="nav-link {{ request()->is('reports/view/attendance') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Attendance Report</p>
                    </a>
                </li>
                <li class="nav-item open">
                    <a href="{{ route('report.view.result') }}" class="nav-link {{ request()->is('reports/view/result') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Students Result</p>
                    </a>
                </li>
                <li class="nav-item open">
                    <a href="{{ route('report.view.id_card') }}" class="nav-link {{ request()->is('reports/view/id-card') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Students ID Card</p>
                    </a>
                </li>
                <li class="nav-item open">
                    <a href="{{ route('report.view.admit.card') }}" class="nav-link {{ request()->is('reports/view/admit-card') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Admit Card</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview {{ request()->is('sms/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-sms"></i>
                <p>
                    Manage SMS
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('view.bulk.sms') }}" class="nav-link {{ request()->is('sms/view/bulk/sms') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Bulk SMS</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview open">
                <li class="nav-item open">
                    <a href="{{ route('view.teacher.bulk.sms') }}" class="nav-link {{ request()->is('sms/view/teacher') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Bulk SMS for Teacher</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="{{ route('view.settings') }}" class="nav-link {{ request()->is('settings/view') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                    Settings
                </p>
            </a>
        </li>

    </ul>

</nav>
