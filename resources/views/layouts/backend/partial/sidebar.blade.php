<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{ route('app.dashboard') }}" class="{{ Request::is('app/dashboard') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>

                <li class="app-sidebar__heading">Access Control</li>
                <li>
                    <a href="{{ route('app.role.index') }}" class="{{ Request::is('app/role*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-check"></i>
                        Roles
                    </a>
                </li>
                <li>
                    <a href="{{ route('app.user.index') }}" class="{{ Request::is('app/user*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Users
                    </a>
                </li>

                <li class="app-sidebar__heading">Components</li>
                <li>
                    <a href="{{ route('app.category.index') }}" class="{{ Request::is('app/category*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-diskette"></i>
                        Categories
                    </a>
                </li>

                <li>
                    <a href="{{ route('app.product.index') }}" class="{{ Request::is('app/product*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-keypad"></i>
                        Products
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-server"></i>
                        Stocks
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('app.stock.create') }}" class="{{ Request::is('app/stock/create') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Add Stock
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('app.manage.stock.index') }}" class="{{ Request::is('app/manage/stock') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Stock Manage
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('app.manage.stock.history.index') }}" class="{{ Request::is('app/manage/stock/history') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Stock Manage History
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="app-sidebar__heading">System</li>
                <li>
                    <a href="{{ route('app.backup.index') }}" class="{{ Request::is('app/backup*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-cloud"></i>
                        Backups
                    </a>
                </li>
                <li>
                    <a href="{{ route('app.setting.general.index') }}" class="{{ Request::is('app/setting*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-config"></i>
                        Settings
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>