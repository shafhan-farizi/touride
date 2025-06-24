@php 
    $base_path = basename(request()->path());
@endphp
<header class="main-header">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid align-items-center">
            <a href="{{ route('home') }}" class="logo navbar-brand">Touride</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon bg-light rounded-1"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item d-flex align-items-center">
                        <a href="{{ route('home') }}" class="nav-link text-white {{ $base_path == '' ? 'active' : '' }}" aria-current="page">Home</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a href="{{ route('cars') }}" class="nav-link text-white {{ $base_path == 'cars' ? 'active' : '' }}">Cars</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a href="{{ route('contact') }}" class="nav-link text-white {{ $base_path == 'contact' ? 'active' : '' }}">Contact Us</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        @auth
                            <div class="dropdown bell">
                                <button type="button" class="btn btn-primary position-relative mx-4 dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-bell"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ count(auth()->user()->notification_customer) }}+
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </button>
                                <ul class="dropdown-menu">
                                    @forelse(auth()->user()->notification_customer()->latest()->get() as $notif)
                                        <li class="p-2">
                                            <div class="flex flex-col dropdown-item flex-wrap">
                                                <p class="fw-bold my-0">{{ $notif->title }}</p>
                                                <p class="my-0">{{ $notif->message }}</p>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="p-2">
                                            <div class="dropdown-item">Nothing.</div>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        @endauth
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        @auth
                            @include('components.layouts.user.components.profile')
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-light ms-3 login-butt">Login</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
