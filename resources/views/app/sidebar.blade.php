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
</aside>
