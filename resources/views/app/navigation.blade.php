<div class="navigation">
    <a href="#" class="close-sidebar">
        <i class="brand-sprite"></i>
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
            <a href="{{  config('brand.social.twitter.url')  }}" target="_blank" class="brand-sprite brand-social brand-twitter"></a>
            <a href="{{  config('brand.social.linkedin.url')  }}" target="_blank"  class="brand-sprite brand-social brand-linkedin"></a>
        </div>
    </div>
</div>
