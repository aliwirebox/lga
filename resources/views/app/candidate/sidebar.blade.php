<ul class="sidebar-nav nav-candidate">
    @if ($candidate->isLive())
        <li class="dashboard">
            <a href="{{ route('candidate.dashboard') }}">
                <i class="fa fa-dashboard"></i>
                Dashboard
            </a>
        </li>
        <li class="live-vacancies">
            <a href="{{ route('candidate.live-vacancies') }}">
                <i class="fa fa-desktop"></i>
                Your Jobs
            </a>
            <span
                    class=" hidden menu-tip glyphicon glyphicon-question-sign"
                    aria-hidden="true"
                    data-toggle="tooltip"
                    data-placement="auto"
                    title="Your Jobs displays a list of vacancies for which your CV has been sent and helps you to track your progress through the hiring process."
            >
            </span>
        </li>
        <li class="cv-requests-pending">
            <a href="{{ route('candidate.cv-requests-pending') }}">
                <i class="fa fa-address-card-o"></i>
                <span class="badged-text">
                    CV Requests Pending
                    <span class="badge badge-green">
                        {{ $candidate->getNotificationCount() }}
                    </span>
                </span>
            </a>
            <span
                    class="hidden menu-tip glyphicon glyphicon-question-sign"
                    aria-hidden="true"
                    data-toggle="tooltip"
                    data-placement="auto"
                    title="CV Requests Pending displays a list of requests for your CV for which {{ config('brand.identity.domain') }} is yet to receive a response. Accepted requests will move into ‘Your Jobs’ and Declined requests will be removed from your Dashboard."
            >
            </span>
        </li>
        <li class="unsuccessful-vacancies">
            <a href="{{ route('candidate.unsuccessful-vacancies') }}">
                <i class="fa fa-thumbs-o-down"></i>
                Unsuccessful Vacancies
            </a>
            <span
                    class="menu-tip glyphicon glyphicon-question-sign"
                    aria-hidden="true"
                    data-toggle="tooltip"
                    data-placement="auto"
                    title="Unsuccessful Vacancies displays a list of vacancies which are no longer being considered and helps you to track your progress through the hiring process."
            >
            </span>
        </li>
        <li class="my-profile-preferences">
            <a href="{{ route('candidate.profile') }}">
                <i class="fa fa-user"></i>
                My Profile &amp; Preferences
            </a>
            <span
                    class="hidden menu-tip glyphicon glyphicon-question-sign"
                    aria-hidden="true"
                    data-toggle="tooltip"
                    data-placement="auto"
                    title="You can edit your work Preferences at any time. If you are not experiencing many CV Requests, then you may wish to broaden your Preferences. Conversely, if you are receiving too many CV Requests for roles that you are not interested in, then you may wish to narrow your Preferences."
            >
            </span>
        </li>
    @endif
    <li class="change-password">
        <a href="{{ route('candidate.password.change') }}">
            <i class="fa fa-key"></i>
            Change Password
        </a>
    </li>
    <li class="change-password">
        <a href="{{ route('candidate.register.preferences') }}">
            <i class="fa fa-file"></i>
            Continue creating profile
        </a>
    </li>
    <li class="logout">
        <a href="{{ url('logout') }}">
            <i class="fa fa-sign-out"></i>
            Logout
        </a>
    </li>
</ul>
