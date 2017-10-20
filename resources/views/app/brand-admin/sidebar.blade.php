<ul class="sidebar-nav nav-brand-admin">
    <li class="dashboard">
        <a href="{{ route('brand-admin.dashboard') }}">
            <i class="fa fa-dashboard"></i>
            Dashboard
        </a>
    </li>
    <li class="live-candidates">
        <a href="{{ route('brand-admin.live-candidates') }}">
            <i class="fa fa-users"></i>
            Active Candidates
        </a>
    </li>
    <li class="cv-processing">
        <a href="{{ route('brand-admin.cv-processing') }}">
            <span class="badged-text">
                <i class="fa fa-address-card"></i>
                CVs Processing
                <span class="badge badge-green">
                    {{ $brandAdmin->getNotificationCount() }}
                </span>
            </span>
        </a>
    </li>
    <li class="cv-requests-pending">
        <a href="{{ route('brand-admin.cv-requests') }}">
            <i class="fa fa-address-card-o"></i>
            CVs Requested
        </a>
    </li>
    <li class="unsuccessful-candidates">
        <a href="{{ route('brand-admin.unsuccessful-candidates') }}">
            <i class="fa fa-thumbs-o-down"></i>
            Unsuccessful Candidates
        </a>
    </li>
    <li class="candidate-database">
        <a href="{{ route('brand-admin.candidates') }}">
            <i class="fa fa-address-book"></i>
            Candidate Database
        </a>
    </li>
    <li class="hirer-database">
        <a href="{{ route('brand-admin.hirers') }}">
            <i class="fa fa-database"></i>
            Employer Database
        </a>
    </li>
    <li class="hirer-database">
        <a href="{{ route('brand-admin.law-firms') }}">
            <i class="fa fa-database"></i>
            Employer Management
        </a>
    </li>
    <li class="blog-dashboard">
        <a href="{{ url('quarx/dashboard') }}">
            <i class="fa fa-dashboard"></i>
            Blog Dashboard
        </a>
    </li>
    <li class="change-password">
        <a href="{{ route('brand-admin.password.change') }}">
            <i class="fa fa-key"></i>
            Change Password
        </a>
    </li>
    <li class="logout">
        <a href="{{ url('logout') }}">
            <i class="fa fa-sign-out"></i>
            Logout
        </a>
    </li>
</ul>

