<aside class="brand-sidebar backend">
    <div class="sidebar-body">
        @if ($menu == 'candidates')
            @include('app.candidate.sidebar', ['candidate' => $user])
        @elseif ($menu == 'hirers')
            @include('app.hirer.sidebar', ['hirer' => $user])
        @elseif ($menu == 'brand_admins')
            @include('app.brand-admin.sidebar', ['brandAdmin' => $user])
        @else
            <ul class="sidebar-nav nav-user">
                <li class="login">
                    <a href="{{ url('login') }}">
                        <i class="fa fa-sign-in"></i>
                        Login
                    </a>
                </li>
                <li class="forgot-password">
                    <a href="{{ url('password/reset') }}">
                        <i class="fa fa-key"></i>
                        Forgot Password
                    </a>
                </li>
            </ul>
        @endif
    </div>
</aside>
