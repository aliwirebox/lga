<div class="top-nav">
    <ul>
        <li><a href="{{ route('hirer.search.candidatefilters') }}"><i class="fa fa-search-plus"></i></a></li>
        <li><a href="{{ route('hirer.dashboard') }}"><i class="fa fa-dashboard"></i></a></li>
        <li><a href="{{ route('hirer.live-candidates') }}"><i class="fa fa-desktop"></i></a></li>
        <li><a href="{{ route('hirer.cv-requests') }}"><i class="fa fa-address-card-o"></i></a></li>
        <li><a href="{{ route('hirer.details.edit') }}"><i class="fa fa-user"></i></a></li>
        <li><a href="{{ route('hirer.password.change') }}"><i class="fa fa-key"></i></a></li>
        <li><a href="#"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out"></i>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form></li>
    </ul>
</div>
