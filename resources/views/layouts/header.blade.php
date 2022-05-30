<div class="header">
    <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>
    </div>
    <div class="header-right">
        <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                    <i class="dw dw-settings2"></i>
                </a>
            </div>
        </div>
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        <img src="{{asset('storage/'.Auth::user()->gambar)}}" alt="">
                    </span>
                    <span class="user-name">Hello, {{Auth::user()->name}} !</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <span style="background-color: rgb(117, 161, 243)" class="dropdown-item">{{Auth::user()->role}}</span>
                    <a class="dropdown-item" href="{{route('profile.show', Auth::user()->id)}}"><i class="dw dw-user1"></i> Profile</a>
                    <a class="dropdown-item" href="{{route('profile.edit', Auth::user()->id)}}"><i class="dw dw-settings2"></i> Setting</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="dw dw-logout"></i>{{ __('Log Out') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

