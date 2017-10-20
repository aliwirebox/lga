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
            title="Your Searches & Matches displays a list of your Searches, which will continue to search the database for Matches on your behalf. New Matches, which you are yet to view, will be flagged up in the ‘Unseen’ column."
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
            title="Active Candidates displays a list of Candidates whose CVs you have received via the site. This function helps you to track each Candidate’s progress through the hiring process."
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
            title="CVs Requested displays a list of Candidates whose CV you have requested and for which {{ config('brand.identity.domain') }} is yet to receive a response. Accepted requests will move into ‘Active Candidates’ and Declined requests will be removed from your Dashboard."
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
        <a href="{{ url('logout') }}">
            <i class="fa fa-sign-out"></i>
            Logout
        </a>
    </li>
</ul>
