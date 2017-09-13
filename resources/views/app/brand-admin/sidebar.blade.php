<ul class="sidebar-nav nav-brand-admin">
    <li class="dashboard">
        <a href="{{ route('brand-admin.dashboard') }}">
            Dashboard
        </a>
    </li>
    <li class="live-candidates">
        <a href="{{ route('brand-admin.live-candidates') }}">
            Live Candidates
        </a>
    </li>
    <li class="cv-processing">
        <a href="{{ route('brand-admin.cv-processing') }}">
            <span class="badged-text">
                CVs Processing
                <span class="badge badge-white">
                    {{ $brandAdmin->getNotificationCount() }}
                </span>
            </span>
        </a>
    </li>
    <li class="cv-requests-pending">
        <a href="{{ route('brand-admin.cv-requests') }}">
            CV Requests Pending
        </a>
    </li>
    <li class="unsuccessful-candidates">
        <a href="{{ route('brand-admin.unsuccessful-candidates') }}">
            Unsuccessful Candidates
        </a>
    </li>
    <li class="candidate-database">
        <a href="{{ route('brand-admin.candidates') }}">
            Candidate Database
        </a>
    </li>
    <li class="hirer-database">
        <a href="{{ route('brand-admin.hirers') }}">
            Hirer Database
        </a>
    </li>
    <li class="blog-dashboard">
        <a href="{{ url('quarx/dashboard') }}">
            Blog Dashboard
        </a>
    </li>
    <li class="change-password">
        <a href="{{ route('brand-admin.password.change') }}">
            Change Password
        </a>
    </li>
    <li class="logout">
        <a href="{{ url('logout') }}">
            Logout
        </a>
    </li>
</ul>

