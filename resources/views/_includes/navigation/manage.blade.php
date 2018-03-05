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
            <li><a href="{{route('municipalities.index')}}">Manage Municipalities</a></li>
            <li><a href="{{route('polling-stations.index')}}">Manage Polling Stations</a></li>
        </ul>
        <p class="menu-label">
            Elections
        </p>
        <ul class="menu-list">
            <li><a>Manage Elections</a></li>
            <li><a>Election Types</a></li>
            <li><a>Electoral Lists</a></li>
        </ul>
    </aside>
</div>