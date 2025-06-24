<!DOCTYPE html>
<html>

<head>
    <title>Car Detail - Touride</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .car-main-img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-radius: 0.75rem;
        }

        .interior-img {
            width: 48%;
            height: 100px;
            object-fit: cover;
            border-radius: 0.5rem;
        }

        .interior-wrapper {
            display: flex;
            gap: 4%;
            margin-top: 1rem;
        }

        .card-custom {
            border-radius: 1rem;
            padding: 1.5rem;
            margin: 40px auto;
            max-width: 700px;
            background-color: #fff;
        }

        .rating-section {
            margin-bottom: 1rem;
        }

        .back-link {
            margin-bottom: 1rem;
            display: inline-block;
            color: #6c757d;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
            color: #343a40;
        }

        .blog-comment::before,
        .blog-comment::after,
        .blog-comment-form::before,
        .blog-comment-form::after {
            content: "";
            display: table;
            clear: both;
        }

        .blog-comment ul {
            list-style-type: none;
            padding: 0;
        }

        .blog-comment img {
            opacity: 1;
            filter: Alpha(opacity=100);
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -o-border-radius: 4px;
            border-radius: 4px;
        }

        .blog-comment img.avatar {
            position: relative;
            float: left;
            margin-left: 0;
            margin-top: 0;
            width: 65px;
            height: 65px;
        }

        .blog-comment .post-comments {
            border: 1px solid #eee;
            margin-bottom: 20px;
            margin-left: 85px;
            margin-right: 0px;
            padding: 10px 20px;
            position: relative;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -o-border-radius: 4px;
            border-radius: 4px;
            background: #fff;
            color: #6b6e80;
            position: relative;
        }

        .blog-comment .name {
            font-weight: 600;
            color: #333;
        }

        .blog-comment .meta {
            font-size: 13px;
            color: #aaaaaa;
            padding-bottom: 8px;
            margin-bottom: 10px !important;
            border-bottom: 1px solid #eee;
        }

        .blog-comment ul.comments ul {
            list-style-type: none;
            padding: 0;
            margin-left: 85px;
        }

        .blog-comment-form {
            padding-left: 15%;
            padding-right: 15%;
            padding-top: 40px;
        }

        .blog-comment h3,
        .blog-comment-form h3 {
            margin-bottom: 10px;
            font-size: 26px;
            line-height: 30px;
            font-weight: 800;
        }

        .all-comments {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card shadow card-custom">
            <a href="javascript:history.back()" class="back-link">← Back</a>

            <img src="{{ $car->image }}" class="car-main-img mb-4" alt="{{ $car->name }}">

            <h3 class="mb-2">{{ $car->name }}</h3>
            <p class="text-muted mb-1"><strong>Type:</strong> {{ $car->type }}</p>
            <p class="text-muted mb-1"><strong>Plate Number:</strong> {{ $car->plate_number }}</p>
            <p><strong>Price per day:</strong> Rp.{{ number_format($car->rental_price) }}</p>
            <p><strong>Status:</strong> <span
                    class="badge {{ $car->status == 'rented' ? 'bg-danger' : 'bg-success' }}">{{ $car->status }}</span>
            </p>

            <div class="rating-section">
                <span class="text-warning fs-5">
                    @php
                        $full_star = floor($rating);
                        $has_half_star = $rating - $full_star >= 0.5;
                    @endphp
                    @for ($i = 0; $i < 5; $i++)
                        @if ($i < $full_star)
                            <i class="fa-solid fa-star"></i>
                        @elseif($has_half_star && $i == $full_star)
                            <i class="fa-regular fa-star-half-stroke"></i>
                        @else
                            <i class="fa-regular fa-star"></i>
                        @endif
                    @endfor
                </span>
                <small class="text-muted">({{ $rating }} / 5.0)</small>
            </div>

            @auth
                @if (!$is_booking)
                    <div class="mt-4">
                        <a href="{{ route('cars.booking', ['id' => $car->id]) }}" class="btn btn-primary px-4">
                            Book Now
                        </a>
                    </div>
                @endif
            @endauth
            <div class="blog-comment mt-4">
                <h3 class="text-success">Comments</h3>
                <hr />
                <div class="all-comments">
                    <ul class="comments">
                        @forelse ($reviews as $review)
                            <li class="clearfix">
                                <img src="https://i.pinimg.com/736x/1d/f1/1c/1df11cbf1369672cf98d2e57eca35781.jpg" class="avatar" alt="">
                                <div class="post-comments">
                                    <p class="meta">{{ date('m d, Y', strtotime($review->created_at)) }} <span
                                            class="name">{{ $review->user->name }}</span> says : <i
                                            class="pull-right"></i></p>
                                    <p>
                                        {{ $review->description }}
                                    </p>
                                </div>
                                @if ($review->reply()->exists())
                                    <ul class="comments">
                                        <li class="clearfix">
                                            <img src="https://i.pinimg.com/736x/9d/6f/6d/9d6f6dededf9c55cd966730d4d45d364.jpg" class="avatar"
                                                alt="">
                                            <div class="post-comments">
                                                <p class="meta">
                                                    {{ date('m d, Y', strtotime($review->reply->created_at)) }}
                                                    <span class="name">Atmin</span> says : <i class="pull-right"></i>
                                                </p>
                                                <p>
                                                    {{ $review->reply->description }}
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                @endif
                            </li>
                        @empty
                            <div class="card">
                                <div class="card-body">
                                    <h5>No Reviews.</h5>
                                </div>
                            </div>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/16d156c4be.js" crossorigin="anonymous"></script>
</body>

</html>
