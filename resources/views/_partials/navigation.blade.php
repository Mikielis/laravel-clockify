<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container-fluid">
        <ul class="navbar-nav">
            @can('dashboard_view')
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">{{ _('Dashboard') }}</a>
                </li>
            @endcan
            @can('client_view')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clients') }}">{{ _('Clients') }}</a>
                </li>
            @endcan
            @can('project_view')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('projects') }}">{{ _('Projects') }}</a>
                </li>
            @endcan
            @can('timesheet_view')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('timesheet') }}">{{ _('Timesheet') }}</a>
                </li>
            @endcan
        </ul>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('userActivities')  }}">{{ _('User activities') }}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">{{ _('Logout') }}</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
