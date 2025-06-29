<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo text-center">
                    <a href="{{ route('dashboard') }}">Brend Nomi</a>
                </div>
                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
<ul class="menu">
    <li class="sidebar-item {{ request()->routeIs(['dashboard']) ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class='sidebar-link'>
            <i class="bi bi-speedometer2"></i><span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->routeIs(['child'],['child_debit'],['child_end']) ? 'active' : '' }}">
        <a href="{{ route('child') }}" class='sidebar-link'>
            <i class="bi bi-people-fill"></i><span>Bolalar</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->routeIs(['child_vakancy','child_vakancy_show']) ? 'active' : '' }}">
        <a href="{{ route('child_vakancy') }}" class='sidebar-link'>
            <i class="bi bi-people-fill"></i><span>Tashriflar</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->routeIs(['groups'],['groups_arxiv'],['groups_new'],['groups_show']) ? 'active' : '' }}">
        <a href="{{ route('groups') }}" class='sidebar-link'>
            <i class="bi bi-diagram-3-fill"></i><span>Guruhlar</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-calendar-check-fill"></i><span>Hodimlar Davomadi</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->routeIs(['kassa']) ? 'active' : '' }}">
        <a href="{{ route('kassa') }}" class='sidebar-link'>
            <i class="bi bi-cash-stack"></i><span>Kassa</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->routeIs(['moliya']) ? 'active' : '' }}">
        <a href="{{ route('moliya') }}" class='sidebar-link'>
            <i class="bi bi-bar-chart-line-fill"></i><span>Moliya</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-pie-chart-fill"></i><span>Statistika</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-file-earmark-text-fill"></i><span>Hisobot</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->routeIs(['hodim']) ? 'active' : '' }}">
        <a href="{{ route('hodim') }}" class='sidebar-link'>
            <i class="bi bi-person-badge-fill"></i><span>Hodimlar</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->routeIs(['profile']) ? 'active' : '' }}">
        <a href="{{ route('profile') }}" class='sidebar-link'>
            <i class="bi bi-person-circle"></i><span>Profil</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->routeIs(['setting']) ? 'active' : '' }}">
        <a href="{{ route('setting')  }}" class='sidebar-link'>
            <i class="bi bi-gear-fill"></i><span>Sozlamalar</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class='sidebar-link text-danger'>
            <i class="bi bi-box-arrow-right text-danger"></i><span>Chiqish</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
</ul>

        </div>
    </div>
</div>

