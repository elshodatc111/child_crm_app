<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo text-center">
                    <a href="index.html">Brend Nomi</a>
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
                <li class="sidebar-item active ">
                    <a href="index.html" class='sidebar-link'><i class="bi bi-grid-fill"></i><span>Dashboard</span></a>
                </li>

                <li class="sidebar-item ">
                    <a href="index.html" class='sidebar-link'><i class="bi bi-grid-fill"></i><span>Dashboard</span></a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'><i class="bi bi-grid-fill"></i><span>Multi-level Menu</span></a>
                    <ul class="submenu ">
                        <li class="submenu-item  has-sub">
                            <a href="#" class="submenu-link">First Level</a>
                            <ul class="submenu submenu-level-2 ">
                                <li class="submenu-item ">
                                    <a href="ui-multi-level-menu.html" class="submenu-link">Second Level</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="#" class="submenu-link">Second Level Menu</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu-item  has-sub">
                            <a href="#" class="submenu-link">Another Menu</a>
                            <ul class="submenu submenu-level-2 ">
                                <li class="submenu-item ">
                                    <a href="#" class="submenu-link">Second Level Menu</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  ">
                    <a href="application-email.html" class='sidebar-link'><i class="bi bi-envelope-fill"></i><span>Email Application</span></a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class='sidebar-link text-danger'><i class="bi bi-lock text-danger"></i><span>Chiqish</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

            </ul>
        </div>
    </div>
</div>
