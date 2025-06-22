<header class="main-header">
    <div class="container d-flex justify-content-between align-items-center flex-wrap">
        <a href="{{ route('home') }}" class="logo">Touride</a>
        <nav class="navbar-links d-flex align-items-center">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('cars') }}">Cars</a>
            <a href="{{ route('contact') }}">Contact Us</a>
            @auth
                <div class="dropdown">
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
            @auth
                @include('components.layouts.user.components.profile')
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light ms-3">Login</a>
            @endauth
        </nav>
    </div>
</header>
