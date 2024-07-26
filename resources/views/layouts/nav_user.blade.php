<div class="py-1 bg-primary">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                        <span class="text">0812-2222-7754</span>
                    </div>
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                        <span class="text">telemarketing@hsp.net.id</span>
                    </div>
                    <div class="login-button">
                        @guest
                        <a href="{{ url('login') }}" class="btn btn-success me-3"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
                        <a href="{{ url('register') }}" class="btn btn-success me-3"><i class="fas fa-user-plus me-1"></i> Register</a>
                        @else
                        <a href="/profile" class="btn btn-success me-3"><i class="fas fa-user-circle me-1"></i> Profile</a>
                        <a href="{{ url('logout') }}" class="btn btn-success me-3" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ url('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco_navbar" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('home') }}">
            <img src="resources/template_user/images/logo.png" width="100" height="100" alt="Logo">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a href="{{ url('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('shop') }}">Shop</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('about') }}" class="nav-link">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('contact') }}" class="nav-link">Contact</a>
                </li>
                <li class="nav-item cta cta-colored">
                    <a href="{{ url('cart') }}" class="nav-link">
                        <span class="icon-shopping_cart"></span>[0]
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>