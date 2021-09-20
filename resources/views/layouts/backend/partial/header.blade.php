<div class="app-header header-shadow">
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
    <div class="app-header__content">
        <div class="app-header-left">
            <div class="search-wrapper">
                <div class="input-holder">
                    <input type="text" class="search-input" placeholder="Type to search">
                    <button class="search-icon"><span></span></button>
                </div>
                <button class="close"></button>
            </div>
            <ul class="header-menu nav">
                <li class="dropdown nav-item">
                    <a href="javascript:void(0);" class="nav-link">
                        <i class="nav-link-icon fa fa-cog"></i>
                        Visit Site
                    </a>
                </li>
            </ul>
        </div>
        <div class="app-header-right">
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    class="p-0 btn">
                                    <img height="40" width="40" class="rounded-circle" src="{{ Auth::user()->getFirstMediaUrl('image') != null ?  Auth::user()->getFirstMediaUrl('image') : config('app.placeholderImage').'160.png' }}"
                                        alt="">
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('app.profile.index') }}" tabindex="0" class="dropdown-item"><i class="pe-7s-user mr-2"></i>Profile</a>

                                    <a href="#" tabindex="0" class="dropdown-item"><i class="pe-7s-lock mr-2"></i>Change Password</a>

                                    <a href="#" tabindex="0" class="dropdown-item"><i class="pe-7s-tools mr-2"></i>Settings</a>

                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <button type="button" tabindex="0" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="pe-7s-power mr-2"></i>Logout
                                    </button>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content-left ml-3">
                            <div class="widget-heading">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="widget-subheading">
                                {{ Auth::user()->role->name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>