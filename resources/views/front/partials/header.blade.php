<header>
    <div class="container">
        <div class="header-wrap">
            <div class="header-top d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ route('welcome') }}"><img src="welcome/img/logo.png" alt=""></a>
                </div>
                <div class="main-menubar d-none d-md-flex align-items-center">
                    <nav>
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('studio') }}">{{ __('Blog') }}</a>
                        <a href="{{ route('teams') }}">{{ __('Team') }}</a>
                        <a href="{{ route('locations') }}">{{ __('Locations') }}</a>
                        <a href="{{ route('privacy') }}">{{ __('Privacy') }}</a>
                        <a href="{{ route('terms') }}">{{ __('Terms') }}</a>
                    </nav>
                </div>
                <div class="main-menubar d-sm-flex align-items-center d-md-none">
                    <nav class="hide nav-hamburger">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('studio') }}">{{ __('Blog') }}</a>
                        <a href="{{ route('teams') }}">{{ __('Team') }}</a>
                        <a href="{{ route('locations') }}">{{ __('Locations') }}</a>
                        <a href="{{ route('privacy') }}">{{ __('Privacy') }}</a>
                        <a href="{{ route('terms') }}">{{ __('Terms') }}</a>
                    </nav>
                    <div class="menu-bar"><span class="lnr lnr-menu"></span></div>
                </div>
            </div>
        </div>
    </div>
</header>
