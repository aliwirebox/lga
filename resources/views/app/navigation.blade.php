<div class="navigation">
    <a href="#" class="close-sidebar">
        <i class="nq-sprite"></i>
    </a>
    <nav class="navbar">

        @if(checkAuth())
            <ul class="nav navbar-nav">
                <li class="username-item">
                    {{ $user->getFullName() }}
                    <span class="badge badge-black">
                        {{ $user->getNotificationCount() }}
                    </span>
                </li>
            </ul>
        @endif
    </nav>

    <div class="nav-right">
        <div class="social" style="">
            <a href="https://twitter.com/NQSolicitors" target="_blank" class="nq-sprite nq-social nq-twitter"></a>
            <a href="https://www.linkedin.com/company/nqsolicitors.com?trk=company_logo" target="_blank"  class="nq-sprite nq-social nq-linkedin"></a>
        </div>
    </div>
</div>
