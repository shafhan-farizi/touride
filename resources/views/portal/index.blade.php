<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Touride - Luxury Car Rental</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('css/user/landing.css') }}" />
</head>

<body>

  <!-- Navbar -->
  <header class="main-header">
    <div class="container d-flex justify-content-between align-items-center flex-wrap">
      <a href{{ route('home') }}" class="logo">Touride</a>
      <nav class="navbar-links">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('view') }}">Cars</a>
        <a href="{{ route('contacts') }}">Contact Us</a>
        <a href="/login">Login</a>

      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section id="home" class="hero-section d-flex align-items-center justify-content-center text-center">
    <div class="hero-content">
      <h1>Drive With Comfort</h1>
      <p>Experience top-tier vehicles for every journey</p>
    </div>
  </section>

  <section id="about" class="about-us container my-5">
    <h2 class="section-title text-center mb-4">About Us</h2>
    <p class="lead text-justify">
      At <strong>Touride</strong>, we offer an exclusive selection of cars of several types including cars commonly used
      by families to cars with large capacity. We also provide world-class cars to attend prestigious events.
    </p>
    <p class="text-justify">
      Whether you're attending a special event, business meeting or simply want to experience the thrill of driving a
      high-performance car, we provide a seamless and luxurious rental experience.
      Our fleet includes all types of vehicles from sleek sports cars to elegant sedans and powerful SUVs, all
      maintained to the highest standards. With flexible rental packages and shuttle services, we ensure a hassle-free
      experience that puts you directly behind the wheel of a luxury car.
    </p>
    <p class="text-justify">
      We also offer spacious family vehicles such as the Toyota Avanza and Daihatsu Xenia, perfect for group travel and
      family trips, providing ample space and comfort. We are committed to providing exceptional customer service, with
      a focus on comfort and satisfaction.
      At <strong>Touride</strong>, your journey begins with us — a place where luxury meets convenience.
    </p>
  </section>


  <!-- Car Collection -->
  <section id="cars" class="car-collection container py-5">
    <h2 class="section-title text-center mb-5">Our Car Collection</h2>
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="https://i.pinimg.com/736x/e0/a6/68/e0a6682eb88c1f82b003111304867024.jpg" class="card-img-top"
            alt="Ferrari">
          <div class="card-body">
            <h5 class="card-title">Ferrari F8</h5>
            <p class="card-text">🏎️ Supercar — <span class="text-warning">★★★★★</span><br>Feel the rush with Ferrari,
              Lamborghini, and McLaren.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="https://i.pinimg.com/736x/e7/d9/6c/e7d96c88e4e70a104cfd1f300dd46515.jpg" class="card-img-top"
            alt="Rolls-Royce">
          <div class="card-body">
            <h5 class="card-title">Rolls-Royce Ghost</h5>
            <p class="card-text">🚘 Luxury Sedan — <span class="text-warning">★★★★★</span><br>Experience pure comfort
              from Mercedes to BMW.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="https://i.pinimg.com/736x/ec/8d/f2/ec8df2c7251bb41f16456b440356f252.jpg" class="card-img-top"
            alt="Range Rover">
          <div class="card-body">
            <h5 class="card-title">Range Rover Sport</h5>
            <p class="card-text">🚙 Sport SUV — <span class="text-warning">★★★★☆</span><br>Powerful yet refined models
              from Audi and Porsche.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Services -->
  <section id="services" class="our-services py-5">
    <div class="container">
      <h2 class="section-title text-center mb-5">Our Services</h2>
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="service-card text-center">
            <h4>📅 Seamless Booking</h4>
            <p>Reserve your car in just a few clicks—our platform makes it easy.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="service-card text-center">
            <h4>🚗 Door-to-Door Delivery</h4>
            <p>Get your rental delivered straight to your location hassle-free.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="service-card text-center">
            <h4>📦 Custom Rental Plans</h4>
            <p>Flexible packages: daily, weekly, or monthly — all tailored to you.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Customer Testimonials -->
  <section id="testimonials" class="testimonials py-5 bg-light">
    <div class="container">
      <h2 class="section-title text-center mb-5">What Our Customers Say</h2>
      <div class="row">

        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <p class="card-text">"Touride made my weekend getaway super smooth. The car was clean, and service was
                top-notch!"</p>
            </div>
            <div class="card-footer bg-white border-0 d-flex align-items-center">
              <img src="https://i.pravatar.cc/50?img=11" class="rounded-circle mr-3" alt="Customer Photo">
              <div>
                <strong>Jeno</strong><br>
                <small>South Jakarta</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <p class="card-text">"Rented a car for a business meeting, and it went perfectly. Highly recommend Touride
                for professional service."</p>
            </div>
            <div class="card-footer bg-white border-0 d-flex align-items-center">
              <img src="https://i.pravatar.cc/50?img=12" class="rounded-circle mr-3" alt="Customer Photo">
              <div>
                <strong>Mark</strong><br>
                <small>West Jakarta</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <p class="card-text">"Touride's SUV was perfect for my family trip. Spacious, comfortable, and delivered
                right on time."</p>
            </div>
            <div class="card-footer bg-white border-0 d-flex align-items-center">
              <img src="https://i.pravatar.cc/50?img=13" class="rounded-circle mr-3" alt="Customer Photo">
              <div>
                <strong>Kai</strong><br>
                <small>Central Jakarta</small>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>


  <!-- Footer -->
  <footer id="contact" class="footer text-center py-4">
    <p>&copy; 2025 Touride. All rights reserved.</p>
    <p>Designed with ❤️ using Bootstrap.</p>
  </footer>

</body>

</html>