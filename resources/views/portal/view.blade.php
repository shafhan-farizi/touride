<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us - Touride</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
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

    h2 {
      font-weight: 700;
      color: #343a40;
    }

    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      transition: transform 0.2s ease-in-out;
      background-color: #fff;
    }

    .card:hover {
      transform: scale(1.03);
    }

    .card-img-top {
      height: 200px;
      object-fit: cover;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }

    .card-body {
      padding: 1rem 1.25rem;
    }

    .card-title {
      font-size: 1.1rem;
      font-weight: bold;
      color: #333;
    }

    .card-text {
      color: #555;
      font-size: 0.95rem;
    }

    .btn-outline-secondary {
      width: 100%;
      margin-bottom: 0.5rem;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
    }

    .btn-disabled {
      pointer-events: none;
      opacity: 0.6;
    }

    #searchInput {
      border-radius: 8px;
      padding: 0.6rem 1rem;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
      margin-bottom: 80px;
    }

    @media (max-width: 768px) {
      .card-title {
        font-size: 1rem;
      }

      .card-text {
        font-size: 0.9rem;
      }

      .main-header nav a {
        margin-left: 10px;
      }
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <header class="main-header">
    <div class="container d-flex justify-content-between align-items-center flex-wrap">
      <a href="{{ route('home') }}" class="logo">Touride</a>
      <nav class="navbar-links">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('view') }}">Cars</a>
        <a href="{{ route('contact') }}">Contact Us</a>
        <a href="/login">Login</a>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container py-5">
    <h2 class="text-center mb-4">Explore Our Cars</h2>

    <!-- Search Bar -->
    <div>
      <input type="text" id="searchInput" class="form-control" placeholder="Search cars by name or type..." />
    </div>

    <!-- Cards Row -->
    <div class="row mt-3" id="carContainer"></div>
  </div>

  <!-- Script -->
  <script>
    const cars = [
      { name: "2025 Rolls-Royce Ghost Series II", type: "Luxury", price: "$1000/day", img: "https://i.pinimg.com/736x/84/3f/9e/843f9e53e3106f68ed87b603b0af1205.jpg" },
      { name: "Audi R8 S2 Spyder V10", type: "Sport", price: "$850/day", img: "https://i.pinimg.com/736x/cf/92/b7/cf92b7e810e210074a0196804a85e28c.jpg" },
      { name: "Mazda CX-5", type: "SUV", price: "$100/day", img: "https://i.pinimg.com/736x/e0/a6/68/e0a6682eb88c1f82b003111304867024.jpg" },
      { name: "Toyota Alphard", type: "MPV", price: "$120/day", img: "https://i.pinimg.com/736x/88/57/1f/88571fb626c3c0f5199a71ab0a78b7c4.jpg" },
      { name: "BYD Atto 3", type: "Electric", price: "$90/day", img: "https://i.pinimg.com/736x/66/b4/c0/66b4c08e6a3a043aab2c0e86c9b6e890.jpg" },
      { name: "Mercedes-Benz E300", type: "Sedan", price: "$200/day", img: "https://i.pinimg.com/736x/b9/3b/eb/b93beb29fad9fae11b35c1381da3f9b9.jpg" },
      { name: "Porsche Cayenne", type: "SUV", price: "$350/day", img: "https://i.pinimg.com/736x/33/1b/3c/331b3c5bdb378b36c98f67f6ef3ab424.jpg" },
      { name: "BMW X5", type: "SUV", price: "$250/day", img: "https://i.pinimg.com/736x/e7/d9/6c/e7d96c88e4e70a104cfd1f300dd46515.jpg" },
      { name: "Civic Type R", type: "Sport", price: "$150/day", img: "https://i.pinimg.com/736x/c5/de/51/c5de51dd90c81e3c3ffa7590f06ec024.jpg" },
      { name: "Cherry Tiggo 8 Pro", type: "SUV", price: "$110/day", img: "https://i.pinimg.com/736x/a1/8d/64/a18d645da58ca03fd343fe302c9d9186.jpg" },
      { name: "Hyundai Creta", type: "SUV", price: "$95/day", img: "https://i.pinimg.com/736x/47/27/dc/4727dc5bfc88738193f68532870b49b5.jpg" },
      { name: "Jaguar F-Pace", type: "SUV", price: "$220/day", img: "https://i.pinimg.com/736x/eb/b5/32/ebb5321e541b7907d94fbda03bf6f802.jpg" },
      { name: "Baleno Hatchback", type: "Hatchback", price: "$70/day", img: "https://i.pinimg.com/736x/87/70/3c/87703ce5fc4c3640452f4aa881841831.jpg" },
      { name: "Honda HR-V", type: "SUV", price: "$100/day", img: "https://i.pinimg.com/736x/ed/a0/bd/eda0bd911e4c0a16c6ff6a7507db2cb1.jpg" },
      { name: "City Hatchback", type: "Hatchback", price: "$80/day", img: "https://i.pinimg.com/736x/83/6f/30/836f30b71a67f0a1a040961952052806.jpg" },
      { name: "Mercedes-Benz SL", type: "Convertible", price: "$900/day", img: "https://i.pinimg.com/736x/5b/1c/b0/5b1cb0be33f314d47185affaa9616f33.jpg" },
      { name: "Mini Cooper S", type: "Compact", price: "$130/day", img: "https://i.pinimg.com/736x/68/c8/5a/68c85a066c453439d14ecfe4cb3566fc.jpg" },
      { name: "Range Rover Velar", type: "Midsize SUV", price: "$80/day", img: "https://i.pinimg.com/736x/a2/b0/dd/a2b0dd30c5a9249bc819f31ed230d99e.jpg" }
    ];

    const container = document.getElementById("carContainer");
    const searchInput = document.getElementById("searchInput");

    function renderCars(carList) {
      container.innerHTML = "";
      carList.forEach(car => {
        const col = document.createElement("div");
        col.className = "col-md-4 mb-4";

        col.innerHTML = `
          <div class="card h-100">
            <img src="${car.img}" class="card-img-top" alt="${car.name}">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">${car.name}</h5>
              <p class="card-text">Type: ${car.type}</p>
              <p class="card-text">Price: ${car.price}</p>
              <a href="#" class="btn btn-outline-secondary">View Details</a>
              <button class="btn btn-primary mt-auto btn-disabled">Login to Book Now</button>
            </div>
          </div>
        `;
        container.appendChild(col);
      });
    }

    searchInput.addEventListener("input", () => {
      const keyword = searchInput.value.toLowerCase();
      const filtered = cars.filter(car =>
        car.name.toLowerCase().includes(keyword) ||
        car.type.toLowerCase().includes(keyword)
      );
      renderCars(filtered);
    });

    renderCars(cars);
  </script>
</body>

</html>