<ul class="profile-steps p-lr-15" style="">
    <li>
        <a 
            {!! $editing ? 'href="'. route('candidate.profile.details') .'"' : '' !!} 
            {{ \Request::route()->getName() == "candidate.profile.details" || \Request::route()->getName() == "candidate.register.details" ? 'class=active' : '' }}
        >
            Your Details
        </a>
    </li>
    <li>
        <a 
            {!! $editing ? 'href="'. route('candidate.profile.your-profile') .'"' : '' !!} 
            {{ \Request::route()->getName() == "candidate.profile.your-profile" || \Request::route()->getName() == "candidate.register.your-profile" ? 'class=active' : '' }}
        >
            Your Profile
        </a>
    </li>
    <li>
        <a 
            {!! $editing ? 'href="'. route('candidate.profile.preferences') .'"' : '' !!} 
            {{ \Request::route()->getName() == "candidate.profile.preferences" || \Request::route()->getName() == "candidate.register.preferences" ? 'class=active' : '' }}
        >
            Preferences
        </a>
    </li>
    <li>
        <a 
            {!! $editing ? 'href="'. route('candidate.profile.cv') .'"' : '' !!} 
            {{ \Request::route()->getName() == "candidate.profile.cv" || \Request::route()->getName() == "candidate.register.cv" ? 'class=active' : '' }}
        >
            Upload CV
        </a>
    </li>
    @if(!$editing)
        <li>
            <a 
                {!! $editing ? 'href="'. route('candidate.register.review') .'"' : '' !!} 
                {{ \Request::route()->getName() == "candidate.register.review" ? 'class=active' : '' }}
            >
                Review & Go Live
            </a>
        </li>
    @endif
</ul>
