<ul class="sidebar-nav nav-hirer">
    <li class="new-search">
        <a href="{{ route('hirer.search.candidatefilters') }}">
            <i class="fa fa-search-plus"></i>
            Search
        </a>
    </li>
    <li class="dashboard">
        <a href="{{ route('hirer.dashboard') }}">
            <i class="fa fa-dashboard"></i>
            Dashboard
        </a>
    </li>
    <li class="saved-searches-and-matches">
        <a href="{{ route('hirer.search.savedsearches') }}">
            <i class="fa fa-search"></i>
            <span class="badged-text">
                Your Searches &amp; Matches
                <span class="badge badge-white">
                    {{ $hirer->getNotificationCount() }}
                </span>
            </span>
        </a>
        <span 
            class="hidden menu-tip glyphicon glyphicon-question-sign" 
            aria-hidden="true" 
            data-toggle="tooltip" 
            data-placement="auto"
            title="Your recent saved searches are displayed in Your Searches &amp; Matches. Whenever candidates register that match your saved search, the Unseen column will display how many new matches there are."
        >
        </span>
    </li>
    <li class="live-candidates">
        <a href="{{ route('hirer.live-candidates') }}">
            <i class="fa fa-desktop"></i>
            Active Candidates
        </a>
        <span 
            class="hidden menu-tip glyphicon glyphicon-question-sign" 
            aria-hidden="true" 
            data-toggle="tooltip" 
            data-placement="auto"
            title="You will see candidates who are currently in the hiring process with you in the active candidates section. We will update their status so you are always informed."
        >
        </span>
    </li>
    <li class="cv-requests">
        <a href="{{ route('hirer.cv-requests') }}">
            <i class="fa fa-address-card-o"></i>
            CVs Requested
        </a>

        <span 
            class="hidden menu-tip glyphicon glyphicon-question-sign" 
            aria-hidden="true" 
            data-toggle="tooltip" 
            data-placement="auto"
            title="CVs that have been requested however we are yet to receive a reply for will be shown in the CVs Requested section. CVs that have been accepted will move the candidate to the Active Candidates section and declined CV requests will be removed from your dashboard."
        >
        </span>
    </li>
    <li class="unsuccessful-candidates">
        <a href="{{ route('hirer.unsuccessful-candidates') }}">
            <i class="fa fa-thumbs-o-down"></i>
            Unsuccessful Candidates
        </a>

        <span 
            class="hidden menu-tip glyphicon glyphicon-question-sign" 
            aria-hidden="true" 
            data-toggle="tooltip" 
            data-placement="auto"
            title="Unsuccessful Candidates displays a list of Candidates who are longer being considered for your vacancies. This function helps you to track each Candidate’s progress through the hiring process."
        >
        </span>
    </li>
    <li class="edit-details">
        <a href="{{ route('hirer.details.edit') }}">
            <i class="fa fa-user"></i>
            Your Account
        </a>
    </li>
    <li class="change-password">
        <a href="{{ route('hirer.password.change') }}">
            <i class="fa fa-key"></i>
            Change Password
        </a>
    </li>
    <li class="logout">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
            <i class="fa fa-sign-out"></i>
            Logout
        </button>
    </form>
</li>
    </li>
</ul>
