<header class="primary">
    <div class="firstbar">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="brand">
                        <a href="{{ route('index') }}">
                            <img src="{{ asset('bower_components/magz-master-theme/images/logo.png') }}"
                                alt="Magz Logo">
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <form class="search" method="GET" action="{{ route('guest.articles.search') }}"
                        autocomplete="off">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control"
                                    placeholder="{{ __('Type something here') }}" value="{{ $query ?? '' }}">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="ion-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3 col-sm-12 text-right">
                    @auth
                        <ul class="nav-icons">
                            <li><span>{{ __('Hello') }}</span> <span
                                    class="text-danger bold">{{ Auth::user()->name }}</span></li>

                            <li class="dropdown">
                                <a id="dLabel" data-target="#" href="http://example.com/" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">
                                    <span id="notiNum" class="ion-ios-bell">
                                        @if (Auth::user()->unread_notification)
                                            <span class="badge badge-danger">
                                                {{ Auth::user()->unread_notification }}
                                            </span>
                                        @endif
                                    </span>
                                </a>
                                <ul class="dropdown-menu notify-drop" aria-labelledby="dLabel">
                                    <div class="notify-drop-title">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">{{ __('Your Notifications') }}</div>
                                            <div class="col-md-6 col-sm-6 col-xs-6 text-right"><a href="#"
                                                    class="rIcon allRead" data-tooltip="tooltip" data-placement="bottom"
                                                    title="{{ __('Mark all as read') }}"><i
                                                        class="ion-android-checkmark-circle"></i></a></div>
                                        </div>
                                    </div>
                                    <div class="drop-content">
                                        @foreach (Auth::user()->notifications as $notification)
                                            <li class="@if (!$notification->read_at) unchecked @endif">
                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                    <div class="notify-img"><img src="http://placehold.it/45x45" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a class="link-view"
                                                        href="#"
                                                        data-id="{{ $notification->id }}">{{ $notification->data['message'] }}</a>
                                                    <hr>
                                                    <p class="time">{{ $notification->created_at }}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </div>
                                    <div class="notify-drop-footer text-center">
                                    </div>
                                </ul>
                            </li>

                        </ul>


                    @endauth
                    @guest
                        <ul class="nav-icons">
                            <li><a href="{{ route('register') }}"><i class="ion-person-add"></i>
                                    <div>{{ __('Register') }}</div>
                                </a></li>
                            <li><a href="{{ route('login') }}"><i class="ion-person"></i>
                                    <div>{{ __('Login') }}</div>
                                </a></li>
                        </ul>
                    @endguest

                </div>
            </div>
        </div>
    </div>

    <!-- Start nav -->
    <nav class="menu">
        <div class="container">
            <div class="brand">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('bower_components/magz-master-theme/images/logo.png') }}" alt="Magz Logo">
                </a>
            </div>
            <div class="mobile-toggle">
                <a href="#" data-toggle="menu" data-target="#menu-list"><i class="ion-navicon-round"></i></a>
            </div>
            <div class="mobile-toggle">
                <a href="#" data-toggle="sidebar" data-target="#sidebar"><i class="ion-ios-arrow-left"></i></a>
            </div>
            <div id="menu-list">
                <ul class="nav-list">
                    <li class="for-tablet nav-title"><a>{{ __('Menu') }}</a></li>
                    <li class="for-tablet"><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li class="for-tablet"><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                    <li><a href="{{ route('index') }}">{{ __('Home') }}</a></li>
                    <li class="dropdown magz-dropdown">
                        <a href="#">{{ 'Categories' }}<i class="ion-ios-arrow-right"></i></a>
                        <ul class="dropdown-menu">
                            @foreach ($categories as $category)
                                <li class="dropdown">
                                    <a href="{{ route('guest.categories.show', $category->slug) }}">{{ $category->name }}
                                        @if (count($category->subCategories) > 0)
                                            <i class="ion-ios-arrow-right"></i>
                                        @endif
                                    </a>
                                    @includeWhen(count($category->subCategories) > 0, 'guest.layout.sub-category', [
                                        'categories' => $category->subCategories,
                                    ])
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown magz-dropdown"><a href="#"> {{ __('Pages') }} <i
                                class="ion-ios-arrow-right"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">{{ __('About') }}</a></li>
                            <li><a href="#">{{ __('Contact') }}</a></li>
                        </ul>
                    </li>
                    @auth
                        <li class="dropdown magz-dropdown"><a href="#">{{ __('Personal') }} <i
                                    class="ion-ios-arrow-right"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('user.info') }}"><i class="icon ion-person"></i>
                                        {{ __('My Account') }}</a></li>

                                @if (Auth::user()->isActive())
                                    <li><a href="{{ route('user.articles.index') }}"><i
                                                class="icon ion-document-text"></i>
                                            {{ __('Manage Articles') }}</a></li>
                                @endif

                                @if (Auth::user()->is_admin)
                                    <li><a href="{{ route('admin.index') }}"><i
                                                class="icon ion-android-color-palette"></i>
                                            {{ __('Dashboard') }}</a></li>
                                @endif

                                <li class="divider"></li>
                                <li><a href="#"
                                        onclick="event.preventDefault();document.getElementById('logout').submit()"><i
                                            class="icon ion-log-out"></i> {{ __('Logout') }}</a></li>
                                <form action="{{ route('logout') }}" id="logout" method="post">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <!-- End nav -->
</header>
