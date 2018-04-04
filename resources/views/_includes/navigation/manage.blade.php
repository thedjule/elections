@if (Auth::user()->hasRole('superadministrator'))
    <div class="side-menu">
        <aside class="menu">
            <p class="menu-label">
                General
            </p>
            <ul class="menu-list">
                <li><a href="{{route('manage.dashboard')}}">Dashboard</a></li>
            </ul>
            <p class="menu-label">
                Users
            </p>
            <ul class="menu-list">
                <li><a href="{{route('users.index')}}">Manage Users</a></li>
                <li><a href="{{route('roles.index')}}">Roles</a></li>
                <li><a href="{{route('permissions.index')}}">Permissions</a></li>
            </ul>
            <p class="menu-label">
                Municipalities
            </p>
            <ul class="menu-list">
                <li><a href="{{route('default-municipalities.index')}}">Manage Municipalities</a></li>
                <li><a href="{{route('default-polling-stations.index')}}">Manage Polling Stations</a></li>
            </ul>
            <p class="menu-label">
                Elections
            </p>
            <ul class="menu-list">
                <li><a href="{{route('elections.index')}}">Manage Elections</a></li>
                <li><a href="{{route('electionTypes.index')}}">Election Types</a></li>
                <li><a href="{{route('electoral-lists.index')}}">Electoral Lists</a></li>
            </ul>
        </aside>
    </div>
@endif