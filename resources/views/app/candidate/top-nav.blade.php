<div class="top-nav">
    <ul>
        @if ($candidate->isLive())
        <li><a href="{{ route('candidate.dashboard') }}"><i class="fa fa-dashboard"></i></a></li>
        <li><a href="{{ route('candidate.live-vacancies') }}"><i class="fa fa-desktop"></i></a></li>
        <li><a href="{{ route('candidate.cv-requests-pending') }}"><i class="fa fa-address-card-o"></i></a></li>
        <li><a href="{{ route('candidate.profile') }}"><i class="fa fa-user"></i></a></li>
        @endif
        <li><a href="{{ route('candidate.password.change') }}"><i class="fa fa-key"></i></a></li>
        <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i></a></li>
    </ul>
</div>