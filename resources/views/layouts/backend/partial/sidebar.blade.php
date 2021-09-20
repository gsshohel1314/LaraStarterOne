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