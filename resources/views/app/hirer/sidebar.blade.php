<ul class="sidebar-nav nav-hirer">
    <li class="new-search">
        <a href="{{ route('hirer.search.candidatefilters') }}">
            <i class="fa fa-search-plus"></i>
            New Search
        </a>
    </li>
    <li class="dashboard">
        <a href="{{ route('hirer.dashboard') }}">
            <i class="fa fa-gear"></i>
            Dashboard
        </a>
    </li>
    <li class="saved-searches-and-matches">
        <a href="{{ route('hirer.search.savedsearches') }}">
            <i class="fa fa-search"></i>
            <span class="badged-text">
                Saved Searches &amp; Matches
                <span class="badge badge-white">
                    {{ $hirer->getNotificationCount() }}
                </span>
            </span>
        </a>
        <span 
            class="menu-tip glyphicon glyphicon-question-sign" 
            aria-hidden="true" 
            data-toggle="tooltip" 
            data-placement="auto"
            title="Saved Searches & Matches displays a list of your Saved Searches, which will continue to search the database for Matches on your behalf. New Matches, which you are yet to view, will be flagged up in the ‘Unseen’ column."
        >
        </span>
    </li>
    <li class="live-candidates">
        <a href="{{ route('hirer.live-candidates') }}">
            <i class="fa fa-desktop"></i>
            Live Candidates
        </a>
        <span 
            class="menu-tip glyphicon glyphicon-question-sign" 
            aria-hidden="true" 
            data-toggle="tooltip" 
            data-placement="auto"
            title="Live Candidates displays a list of Candidates whose CVs you have received via the site. This function helps you to track each Candidate’s progress through the hiring process."
        >
        </span>
    </li>
    <li class="cv-requests">
        <a href="{{ route('hirer.cv-requests') }}">
            <i class="fa fa-address-card-o"></i>
            CV Requests
        </a>

        <span 
            class="menu-tip glyphicon glyphicon-question-sign" 
            aria-hidden="true" 
            data-toggle="tooltip" 
            data-placement="auto"
            title="CV Requests displays a list of Candidates whose CV you have requested and for which {{ config('brand.identity.domain') }} is yet to receive a response. Accepted requests will move into ‘Live Candidates’ and Declined requests will be removed from your Dashboard."
        >
        </span>
    </li>
    <li class="unsuccessful-candidates">
        <a href="{{ route('hirer.unsuccessful-candidates') }}">
            <i class="fa fa-thumbs-o-down"></i>
            Unsuccessful Candidates
        </a>

        <span 
            class="menu-tip glyphicon glyphicon-question-sign" 
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
            Edit Details
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
            <i class="fa fa-external-link"></i>
            Logout
        </a>
    </li>
</ul>
