@extends('components.layouts.user.layouts.app')

@section('title', 'Account Settings')

@section('styles')
    <style>
        /* ========== Navbar Style ========== */
        .main-header {
            background-color: #0c1b33;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .main-header .logo {
            color: #fff;
            font-weight: bold;
            font-size: 1.6rem;
            font-family: 'Segoe UI', sans-serif;
            text-decoration: none;
        }

        .navbar-links a {
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            font-size: 1rem;
            margin-left: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-links a:hover {
            color: #f4d03f;
        }
        /* ========== Page Body ========== */
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .settings-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .settings-container h2 {
            font-weight: 600;
            margin-bottom: 30px;
        }

        .settings-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .btn-edit {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: background 0.3s ease;
        }

        .btn-edit:hover {
            background-color: #0b5ed7;
        }

        .icon-label {
            font-weight: 500;
            margin-bottom: 6px;
            display: block;
        }

        .form-actions {
            display: none;
            gap: 10px;
            margin-top: 25px;
        }


        form .mb-3 {
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="settings-container">
        <div class="settings-header">
            <h3><i class="bi bi-person-circle me-2"></i>Account Settings</h3>
        </div>

        <form id="settingsForm">
            <div class="mb-3">
                <label class="icon-label"><i class="bi bi-person-fill"></i> Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" readonly>
            </div>
            <div class="mb-3">
                <label class="icon-label"><i class="bi bi-envelope-fill"></i> Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" readonly>
            </div>
            <div class="mb-3">
                <label class="icon-label"><i class="bi bi-telephone-fill"></i> Phone Number</label>
                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" readonly>
            </div>
            <div class="mb-3">
                <label class="icon-label"><i class="bi bi-geo-alt-fill"></i> Address</label>
                <textarea name="address" class="form-control" rows="3" readonly>{{ $user->address }}</textarea>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="emailNotif" class="form-check-input" id="emailNotif" disabled checked>
                <label class="form-check-label" for="emailNotif"><i class="bi bi-bell-fill me-1"></i>Allow Email
                    Notifications</label>
            </div>
            <div class="form-actions" id="formActions">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle me-1"></i>Save</button>
                <button type="button" class="btn btn-outline-secondary" id="cancelBtn">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </button>
            </div>
        </form>
    </div>
@endsection