@extends('components.layouts.user.layouts.app')

@section('title', 'Contact Us')

@section('styles')
    {{-- <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        .main-header {
            background-color: #0c1b33;
            padding: 1rem 0;
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

        /* Profile dropdown */
        .dropdown-menu {
            background-color: #fff;
            border-radius: 10px;
            padding: 0.5rem 0;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1050;
            top: 100% !important;
            left: auto !important;
            right: 0 !important;
        }

        .dropdown-menu::before {
            content: '';
            display: block;
            position: absolute;
            top: -8px;
            right: 14px;
            width: 12px;
            height: 12px;
            background-color: #fff;
            transform: rotate(45deg);
            box-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
            z-index: -1;
        }


        .dropdown-menu .dropdown-item {
            font-size: 0.95rem;
            padding: 10px 20px;
            color: #0c1b33;
            transition: background 0.2s ease;
            white-space: nowrap;
        }


        .dropdown-menu .dropdown-item:hover {
            background-color: #f4f4f4;
            color: #0c1b33;
        }


        .dropdown-divider {
            margin: 0.5rem 0;
        }


        .dropdown-menu .text-danger {
            color: #d9534f !important;
            font-weight: 500;
        }

        #contact {
            padding: 4rem 0;
            background-color: #f8f9fa;
        }

        #contact .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0c1b33;
            margin-bottom: 2rem;
        }

        #contact .form-group label {
            font-weight: 600;
            color: #0c1b33;
            margin-bottom: 0.5rem;
        }

        #contact .form-control {
            border-radius: 8px;
            padding: 0.75rem;
        }

        #contact .form-control:focus {
            border-color: #0c1b33;
            box-shadow: 0 0 0 0.2rem rgba(12, 27, 51, 0.2);
        }

        #contact button.btn-primary {
            background-color: #0c1b33;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 6px;
        }

        #contact button.btn-primary:hover {
            background-color: #091326;
        }

        #contact .info-box h5 {
            font-weight: 700;
            color: #0c1b33;
            margin-top: 1rem;
        }

        #contact .info-box p,
        #contact .info-box a {
            color: #555;
            font-size: 1rem;
            line-height: 1.6;
            text-decoration: none;
        }

        #contact .info-box a:hover {
            text-decoration: underline;
        }

        .icon-circle {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #0c1b33;
            color: white;
            border-radius: 50%;
            margin-right: 10px;
        }
    </style> --}}
@endsection

@section('content')
    <section id="contact">
        <div class="container">
            <h2 class="section-title text-center">Get In Touch</h2>
            <div class="row gx-5 gy-4">
                <div class="col-md-6">
                    <form action="/send-contact" method="POST">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter your name" required autocomplete="name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter your email" required autocomplete="email">
                        </div>
                        <div class="form-group mb-4">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5" class="form-control" placeholder="Write your message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="col-md-6 info-box">
                    <div class="mb-3 d-flex align-items-center">
                        <div class="icon-circle"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <h5>Address</h5>
                            <p>Jl. Sudirman No. 123, Jakarta, Indonesia</p>
                        </div>
                    </div>

                    <div class="mb-3 d-flex align-items-center">
                        <div class="icon-circle"><i class="bi bi-whatsapp"></i></div>
                        <div>
                            <h5>WhatsApp</h5>
                            <p><a href="https://wa.me/6281234567890" target="_blank" rel="noopener">+62 812-3456-7890</a>
                            </p>
                        </div>
                    </div>

                    <div class="mb-3 d-flex align-items-center">
                        <div class="icon-circle"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <h5>Email</h5>
                            <p><a href="mailto:info@touride.id">info@touride.id</a></p>
                        </div>
                    </div>

                    <div class="mb-3 d-flex align-items-center">
                        <div class="icon-circle"><i class="bi bi-clock-fill"></i></div>
                        <div>
                            <h5>Working Hours</h5>
                            <p>Monday – Sunday: 08.00 – 20.00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
