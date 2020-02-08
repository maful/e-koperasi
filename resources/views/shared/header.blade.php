<div class="header py-4">
    <div class="container">
        <div class="d-flex">
            <a class="header-brand" href="{{ route('home') }}">
                {{ __('app_name') }}
            </a>
            <div class="d-flex order-lg-2 ml-auto">
                @include('shared.lang')
                <div class="dropdown">
                    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar" style="background-image: url(https://randomuser.me/api/portraits/men/43.jpg)"></span>
                    <span class="ml-2 d-none d-lg-block">
                        <span class="text-default">{{ Auth::user()->name }}</span>
                        <small class="text-muted d-block mt-1">Administrator</small>
                    </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="{{ url('profile') }}">
                            <i class="dropdown-icon fe fe-user" aria-hidden="true"></i> {{ __('menu.profile') }}
                        </a>
                    </div>
                </div>
            </div>
            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
            </a>
        </div>
    </div>
</div>

<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 ml-auto">
            </div>
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link"><i class="fe fe-home" aria-hidden="true"></i> {{ __('menu.home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('members.index') }}" class="nav-link"><i class="fe fe-users" aria-hidden="true"></i> {{ __('menu.member') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('deposits.index') }}" class="nav-link"><i class="fe fe-dollar-sign" aria-hidden="true"></i> {{ __('menu.deposit') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('withdrawals.index') }}" class="nav-link"><i class="fe fe-hash" aria-hidden="true"></i> {{ __('menu.withdrawal') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('mutations') }}" class="nav-link"><i class="fe fe-printer" aria-hidden="true"></i> {{ __('menu.mutation') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('bankinterests') }}" class="nav-link"><i class="fe fe-box" aria-hidden="true"></i> {{ __('menu.interest') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('profile') }}" class="nav-link"><i class="fe fe-user" aria-hidden="true"></i> {{ __('menu.profile') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fe fe-log-out" aria-hidden="true"></i> {{ __('menu.logout') }}</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
