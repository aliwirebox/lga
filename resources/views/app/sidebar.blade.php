<aside class="brand-sidebar backend">
    <div class="branding">
        <a class="brand-sprite top-logo-2" href="{{ getUserHomeRoute() }}"></a>
    </div>
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
    <div class="sidebar-footer">
        <ul class="sidebar-nav">
            <li><a class="sidebar-link" href="tel:{{ config('brand.phones.mainspaced') }}"><strong>{{ config('brand.phones.mainspaced') }}</strong></a> <i
                        class="brand-sprite brand-icon brand-phone"></i></li>
            <li><a class="sidebar-link" href="mailto:{{  config('brand.email.info')  }}"><strong>{{ config('brand.email.info') }}</strong></a>
                <i class="brand-sprite brand-icon brand-pointer"></i></li>
            <li>
                {{  config('brand.identity.legalname')  }}<br>
                @foreach(config('brand.address') as $line)
                    {{ $line }}<br />
                @endforeach
                <i class="brand-sprite brand-icon brand-pin"></i>
            </li>
        </ul>
    </div>
</aside>
