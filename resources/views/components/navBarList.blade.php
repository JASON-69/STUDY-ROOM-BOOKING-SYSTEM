<li>
    <a href="{{ route('home') }}" @class([
        'nav-link',
        'link-dark' => !request()->routeIs('home'),
        'active' => request()->routeIs('home'),
    ])>
        <i class="bi bi-speedometer2 me-2"></i>
        Dashboard
    </a>
</li>
<li>
    <a href="{{ route('calendar') }}" @class([
        'nav-link',
        'link-dark' => !request()->routeIs('calendar'),
        'active' => request()->routeIs('calendar'),
    ])>
        <i class="bi bi-table me-2"></i>
        Calendar
    </a>
</li>
<li>
    <a href="{{ route('application') }}" @class([
        'nav-link',
        'link-dark' => !request()->routeIs('application') && !request()->routeIs('application.date'),
        'active' => request()->routeIs('application') || request()->routeIs('application.date'),
    ])>
        <i class="bi bi-envelope-paper me-2"></i>
        Application Form
    </a>
</li>
<li>
    <a href="{{ route('profile') }}" @class([
        'nav-link',
        'link-dark' => !request()->routeIs('profile'),
        'active' => request()->routeIs('profile'),
    ])>
        <i class="bi bi-people me-2"></i>
        Profile
    </a>
</li>
