@extends('components.layouts.user.layouts.app')

@section('title', 'Payment Methods')

@section('styles')
    <style>
        body {
            background-color: #f7f8fa;
        }

        .main-header {
            background-color: #0c1b33;
            padding: 15px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-links a {
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            margin-left: 25px;
            text-decoration: none;
            font-weight: 500;
        }

        .navbar-links a:hover {
            color: #f4d03f;
        }

        .payment-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
        }

        .payment-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            transition: 0.3s;
        }

        .payment-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
        }

        .payment-card.active {
            border-color: #f4d03f;
            background-color: #fffbea;
        }

        .payment-card .left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .payment-card .icon {
            font-size: 2rem;
            color: #0c1b33;
        }

        .toast-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2000;
            animation: fadeOut 3s forwards;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            80% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                display: none;
            }
        }

        .selected-banner {
            background: linear-gradient(to right, #0c1b33, #1f3a63);
            color: #fff;
            border-radius: 10px;
            padding: 12px 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .selected-banner .btn {
            background-color: #f4d03f;
            color: #000;
            border: none;
        }

        .selected-banner .btn:hover {
            background-color: #f7e582;
        }
    </style>
@endsection

@section('content')

    <!-- Payment Methods -->
    <div class="payment-container">
        <h2 class="mb-4">Payment Methods</h2>

        @forelse ($payment_methods as $pm)
            <div class="payment-card">
                <div class="left">
                    <div class="icon">
                        <i class="bi {{ $pm->type == 'atm' ? 'bi-bank2' : 'bi-phone' }}"></i>
                    </div>
                    <div>
                        <strong>{{ $pm->bank_name }}</strong><br>
                        <small>{{ $pm->pin }}</small>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmDeleteModal" data-delete-id="{{ $pm->id }}">
                        <i class="bi bi-trash me-1"></i> Delete
                    </button>
                </div>
            </div>
        @empty
            <div class="payment-card">
                <div class="fs-4 text-center">Empty.</div>
            </div>
        @endforelse
        <hr class="my-4">

        <h5 class="mb-3">Add New Payment Method</h5>
        <form action="{{ route('user.payment-method.add', ['id' => Auth::user()->id]) }}" method="post" class="row g-2">
            @csrf
            <div class="col-md-5">
                <select class="form-select" name="bank_name" aria-label="Default select example" required>
                    <option selected>Select Bank</option>
                    <option value="GoPay">GoPay</option>
                    <option value="BCA">BCA</option>
                    <option value="OVO">OVO</option>
                    <option value="Mandiri">Mandiri</option>
                    <option value="BRI">BRI</option>
                    <option value="Jago">Jago</option>
                </select>
            </div>
            <div class="col-md-5">
                <input type="text" name="pin" class="form-control" placeholder="Account Number / Phone" required>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-warning">Add</button>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Confirm Deletion
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this payment method?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('user.payment-method.delete') }}" method="POST">
                        @csrf
                        @method('delete')

                        <input type="hidden" name="delete_id" id="deleteIdInput">
                        <button type="submit" name="delete_payment" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const confirmDeleteModal = document.getElementById('confirmDeleteModal');
        confirmDeleteModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const deleteId = button.getAttribute('data-delete-id');
            const deleteInput = confirmDeleteModal.querySelector('#deleteIdInput');
            deleteInput.value = deleteId;
        });
    </script>
@endsection
