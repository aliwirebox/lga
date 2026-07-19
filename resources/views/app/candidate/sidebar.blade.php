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
                    title="Your Jobs are the jobs where your CV has been sent. You can track the progress of currently active jobs through this section. We will regularly update the status of the current roles you are involved with."
            >
            </span>
        </li>
        <li class="cv-requests-pending">
            <a href="{{ route('candidate.cv-requests-pending') }}">
                <i class="fa fa-address-card-o"></i>
                <span class="badged-text">
                    CV Requests
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
                    title="CVs that have been requested however we are yet to receive a reply will be shown in the CVs Requested section. CVs that have been accepted will move the candidate to the Active Candidates section and declined CV requests will be removed from your dashboard."
            >
            </span>
        </li>
        <li class="unsuccessful-vacancies">
            <a href="{{ route('candidate.unsuccessful-vacancies') }}">
                <i class="fa fa-thumbs-o-down"></i>
                Unsuccessful Jobs
            </a>
            <span
                    class="hidden menu-tip glyphicon glyphicon-question-sign"
                    aria-hidden="true"
                    data-toggle="tooltip"
                    data-placement="auto"
                    title="Unsuccessful Jobs displays a list of jobs which are no longer being considered and helps you to track your progress through the hiring process."
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
    @if (!$candidate->isLive())
        <li class="change-password">
            <a href="{{ route('candidate.register.preferences') }}">
                <i class="fa fa-file"></i>
                Continue creating profile
            </a>
        </li>
    @endif
    <li class="logout">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
            <i class="fa fa-sign-out"></i>
            Logout
        </button>
    </form>
</li>
</ul>
