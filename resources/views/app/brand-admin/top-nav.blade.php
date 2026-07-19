<div class="top-nav">
    <ul>
        <li><a href="{{ route('brand-admin.dashboard') }}" title="Dashboard"><i class="fa fa-dashboard" ></i></a></li>
        <li><a href="{{ route('brand-admin.live-candidates') }}" title="Active Candidates"><i class="fa fa-users"></i></a></li>
        <li><a href="{{ route('brand-admin.cv-processing') }}" title="CV Processing"><i class="fa fa-address-card"></i></a></li>
        <li><a href="{{ route('brand-admin.cv-requests') }}" title="CVs Requested"><i class="fa fa-address-card-o"></i></a></li>
        <li><a href="{{ route('brand-admin.candidates') }}" title="Candidates"><i class="fa fa-address-book"></i></a></li>
        <li><a href="{{ route('brand-admin.hirers') }}" title="Employers"><i class="fa fa-database"></i></a></li>
        <li><a href="{{ url('quarx/dashboard') }}" title="Blog Dashboard"><i class="fa fa-bullhorn"></i></a></li>
        <li><a href="{{ route('brand-admin.password.change') }}" title="Change Password"><i class="fa fa-key"></i></a></li>
        <li><a href="#"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out"></i>
        Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form></li>
    </ul>
</div>
