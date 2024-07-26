<header class="header-navbar fixed">
    <div class="header-wrapper">
        <div class="header-left">
            <div class="sidebar-toggle action-toggle"><i class="fas fa-bars"></i></div>
        </div>
        <div class="header-content">
            <div class="theme-switch-icon"></div>
            <!-- Menghapus dropdown pesan dan notifikasi -->
            <div class="dropdown dropdown-menu-end">
                <a href="#" class="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="label">
                        <!-- Menampilkan informasi pengguna yang sedang login -->
                        @if(Auth::check())
                            <span>{{ Auth::user()->name }}</span>
                            <div>{{ Auth::user()->role }}</div> <!-- asumsi ada atribut role -->
                        @else
                            <span>Tamu</span>
                            <div>Guest</div>
                        @endif
                    </div>
                    <img class="img-user" src="{{ asset('resources/template_admin/assets/images/avatar1.png') }}" alt="user">
                </a>
                <ul class="dropdown-menu small">
                    <li class="menu-content ps-menu">
                        @if(Auth::check())
                            <a href="#">
                                <div class="description">
                                    <i class="ti-user"></i> Profil
                                </div>
                            </a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); 
                                   document.getElementById('logout-form').submit();">
                                <div class="description">
                                    <i class="ti-power-off"></i> Keluar
                                </div>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}">
                                <div class="description">
                                    <i class="ti-key"></i> Login
                                </div>
                            </a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>