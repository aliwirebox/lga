<div class="top-nav">
    <ul>
        @if ($candidate->isLive())
        <li><a href="{{ route('candidate.dashboard') }}"><i class="fa fa-dashboard"></i></a></li>
        <li><a href="{{ route('candidate.live-vacancies') }}"><i class="fa fa-desktop"></i></a></li>
        <li><a href="{{ route('candidate.cv-requests-pending') }}"><i class="fa fa-address-card-o"></i></a></li>
        <li><a href="{{ route('candidate.profile') }}"><i class="fa fa-user"></i></a></li>
        @endif
        <li><a href="{{ route('candidate.password.change') }}"><i class="fa fa-key"></i></a></li>
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