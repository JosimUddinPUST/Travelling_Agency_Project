<div class="navbar-area" id="stickymenu">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('uploads/logo.png') }}" alt="No Image">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('uploads/logo.png') }}" alt="">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{ Request::is('/') ? 'active':'' }}">
                            <a href="{{ route('home') }}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item {{ Request::is('about') ? 'active':'' }}">
                            <a href="{{ route('about') }}" class="nav-link">About</a>
                        </li>
                        <li class="nav-item {{ Request::is('destinations') || Request::is('destination-details/*') ? 'active':'' }}">
                            <a href="{{ route('destinations') }}" class="nav-link">Destinations</a>
                        </li>
                        <li class="nav-item {{ Request::is('package*') ? 'active':'' }}">
                            <a href="{{ route('packages') }}" class="nav-link">Packages</a>
                        </li>
                        <li class="nav-item {{ Request::is('team-members')? 'active':'' }}">
                            <a href="{{ route('team_members') }}" class="nav-link">Team</a>
                        </li>
                        <li class="nav-item {{ Request::is('faq')? 'active':'' }}">
                            <a href="{{ route('faq') }}" class="nav-link">FAQ</a>
                        </li>
                        <li class="nav-item {{ Request::is('blog') || Request::is('post-details/*') || Request::is('blog-category/*') ? 'active' : '' }}">
                            <a href="{{ route('blog') }}" class="nav-link">Blog</a>
                        </li>
                        <li class="nav-item {{ Request::is('contact')? 'active':'' }}">
                            <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
