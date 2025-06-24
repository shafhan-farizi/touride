<div class="dropdown mt-2 ms-3">
    <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center gap-2" type="button"
        data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-person-circle fs-5"></i>
        {{ auth()->user()->name }}
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow">
        <li class="dropdown-item"><a class="text-secondary" href="{{ route('user.profile') }}">My Profile</a></li>
        <li class="dropdown-item"><a class="text-secondary" href="{{ route('user.payment-method') }}">Payment Methods</a></li>
        <li class="dropdown-item"><a class="text-secondary" href="{{ route('user.history') }}">Booking History</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <li class="dropdown-item"><button type="submit" class="btn text-danger">Logout</button></li>
        </form>
    </ul>
</div>
