<aside class="nq-sidebar backend">
    <div class="branding">
        <a class="nq-sprite top-logo-2" href="{{ getUserHomeRoute() }}"></a>
    </div>
    <div class="sidebar-body">
        @if ($menu == 'candidates')
            @include('app.candidate.sidebar', ['candidate' => $user])
        @elseif ($menu == 'hirers')
            @include('app.hirer.sidebar', ['hirer' => $user])
        @elseif ($menu == 'nq_admins')
            @include('app.nq-admin.sidebar', ['nqAdmin' => $user])
        @else
            <ul class="sidebar-nav nav-user">
                <li class="login">
                    <a href="{{ url('login') }}">
                        Login
                    </a>
                </li>
                <li class="forgot-password">
                    <a href="{{ url('password/reset') }}">
                        Forgot Password
                    </a>
                </li>
            </ul>
        @endif
    </div>
    <div class="sidebar-footer">
        <ul class="sidebar-nav">
            <li><a class="sidebar-link" href="tel:02037099165"><strong>020 3709 9165</strong></a> <i
                        class="nq-sprite nq-icon nq-phone"></i></li>
            <li><a class="sidebar-link" href="mailto:info@NQSolicitors.com"><strong>info@NQSolicitors.com</strong></a>
                <i class="nq-sprite nq-icon nq-pointer"></i></li>
            <li>NQ Recruitment Ltd<br>
                Central Court<br>
                25 Southampton Buildings<br>
                London, WC2A 1AL <i class="nq-sprite nq-icon nq-pin"></i></li>
        </ul>
    </div>
</aside>
