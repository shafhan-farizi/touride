@extends('components.layouts.user.layouts.app')

@section('title', 'Contact Us')

@section('styles')
    <style>
        /* Navbar */
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

        /* Contact Us */
        #contact {
            padding: 4rem 0;
        }

        #contact .section-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: #0c1b33;
            margin-bottom: 3rem;
        }

        #contact form {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        #contact .form-group label {
            font-weight: 600;
            color: #0c1b33;
            margin-bottom: 0.5rem;
            display: block;
        }

        #contact .form-control {
            border-radius: 8px;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            font-size: 1rem;
        }

        #contact .form-control:focus {
            border-color: #0c1b33;
            box-shadow: 0 0 0 0.2rem rgba(12, 27, 51, 0.25);
        }

        #contact button.btn-primary {
            background-color: #0c1b33;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
        }

        #contact button.btn-primary:hover {
            background-color: #091326;
        }

        #contact .col-md-6 h5 {
            font-weight: 700;
            color: #0c1b33;
            margin-top: 1.5rem;
        }

        #contact .col-md-6 p,
        #contact .col-md-6 a {
            color: #333;
            font-size: 1rem;
            line-height: 1.6;
            text-decoration: none;
        }

        #contact .col-md-6 a:hover {
            text-decoration: underline;
        }

        @media (max-width: 767px) {
            #contact .col-md-6 {
                margin-bottom: 2rem;
            }

            .main-header .container {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar-links {
                margin-top: 1rem;
            }
        }
    </style>
@endsection

@section('content')
    <section id="contact">
        <div class="container">
            <h2 class="section-title text-center">Contact Us</h2>
            <div class="row gx-5 gy-4">

                <!-- Contact Form -->
                <div class="col-md-6">
                    <form>
                        <div class="form-group mb-3">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Enter your name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Your Email</label>
                            <input type="email" id="email" class="form-control" placeholder="Enter your email"
                                required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="message">Your Message</label>
                            <textarea id="message" rows="5" class="form-control" placeholder="Write your message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="col-md-6">
                    <h5>📍 Address</h5>
                    <p>Jl. Sudirman No. 123, Jakarta, Indonesia</p>
                    <h5>📞 WhatsApp</h5>
                    <p><a href="https://wa.me/6281234567890" target="_blank">+62 812-3456-7890</a></p>
                    <h5>📧 Email</h5>
                    <p><a href="mailto:info@touride.id">info@touride.id</a></p>
                    <h5>🕒 Working Hours</h5>
                    <p>Monday – Sunday: 08.00 – 20.00</p>
                </div>

            </div>
        </div>
    </section>
@endsection