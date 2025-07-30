<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo text-center">
                    <a href="{{ route('dashboard') }}">Kiddix APP</a>
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
            <ul class="menu list-unstyled">
                <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="sidebar-link">
                        <i class="bi bi-speedometer2"></i> <span>Панель управления</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs([
                    'child','child_debit','child_end','child_show','child_show_group','child_show_davomad'
                ]) ? 'active' : '' }}">
                    <a href="{{ route('child') }}" class="sidebar-link">
                        <i class="bi bi-emoji-smile-fill"></i> <span>Дети</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs([
                    'child_vakancy','child_vakancy_show','child_vakancy_create'
                ]) ? 'active' : '' }}">
                    <a href="{{ route('child_vakancy') }}" class="sidebar-link">
                        <i class="bi bi-door-open-fill"></i> <span>Посещения</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs([
                    'groups','groups_arxiv','groups_show_child','child_show_darslar','groups_show_child_update','groups_show_davomad','groups_new','groups_show'
                ]) ? 'active' : '' }}">
                    <a href="{{ route('groups') }}" class="sidebar-link">
                        <i class="bi bi-diagram-3-fill"></i> <span>Группы</span>
                    </a>
                </li>
                @if(auth()->user()->type == 'direktor' OR auth()->user()->type == 'menejer')
                    <li class="sidebar-item {{ request()->routeIs([
                        'hodim_davomad_meneger','hodim_davomad_tarbiyachi','hodim_davomad_techer','hodim_davomad_hodim'
                    ]) ? 'active' : '' }}">
                        <a href="{{ route('hodim_davomad_meneger') }}" class="sidebar-link">
                            <i class="bi bi-calendar-check"></i> <span>Посещаемость сотрудников</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('kassa') ? 'active' : '' }}">
                        <a href="{{ route('kassa') }}" class="sidebar-link">
                            <i class="bi bi-cash-stack"></i> <span>Касса</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->type == 'direktor')
                    <li class="sidebar-item {{ request()->routeIs('moliya') ? 'active' : '' }}">
                        <a href="{{ route('moliya') }}" class="sidebar-link">
                            <i class="bi bi-bar-chart-fill"></i> <span>Финансы</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('chart') ? 'active' : '' }}">
                        <a href="{{ route('chart') }}" class="sidebar-link">
                            <i class="bi bi-pie-chart-fill"></i> <span>Статистика (Jarayonda)</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->type == 'direktor' OR auth()->user()->type == 'menejer')
                    <li class="sidebar-item {{ request()->routeIs('report') ? 'active' : '' }}">
                        <a href="{{ route('report') }}" class="sidebar-link">
                            <i class="bi bi-file-earmark-text-fill"></i> <span>Отчет (Jarayonda)</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs([
                        'meneger_show','oshpaz_show','oshpaz_paymart','hodim_techer_tarix','hodim_techer_paymart',
                        'hodim_tarbiyachi_show','hodim_tarbiyachi_show_tarix','hodim_tarbiyachi_show_paymart',
                        'hodim','hodim_tarbiyachi','meneger_show_paymart','hodim_boshqa_show','hodim_boshqa_show_tulovlar',
                        'hodim_vacancy_show','hodim_techer','hodim_techer_show','hodim_oshpazlar','hodim_boshqalar',
                        'hodim_vacancy','hodim_vacancy_create'
                    ]) ? 'active' : '' }}">
                        <a href="{{ route('hodim') }}" class="sidebar-link">
                            <i class="bi bi-person-badge"></i> <span>Сотрудники</span>
                        </a>
                    </li>
                @endif

                <li class="sidebar-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile') }}" class="sidebar-link">
                        <i class="bi bi-person-circle"></i> <span>Профиль</span>
                    </a>
                </li>
                @if(auth()->user()->type == 'direktor')
                    <li class="sidebar-item {{ request()->routeIs('setting') ? 'active' : '' }}">
                        <a href="{{ route('setting') }}" class="sidebar-link">
                            <i class="bi bi-gear-fill"></i> <span>Настройки</span>
                        </a>
                    </li>
                @endif
                <li class="sidebar-item">
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="sidebar-link text-danger">
                        <i class="bi bi-box-arrow-right"></i> <span>Выход</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<style>
    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        border-radius: 10px;
        color: #333;
        transition: all 0.2s ease-in-out;
    }

    .sidebar-link:hover {
        background-color: #f1f1f1;
        color: #0d6efd;
    }

    .sidebar-item.active .sidebar-link {
        background-color: #0d6efd;
        color: #fff;
    }

    .sidebar-link i {
        font-size: 1.2rem;
    }

    .sidebar-link span {
        font-weight: 500;
        font-size: 15px;
    }
</style>
