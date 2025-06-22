<!DOCTYPE html>
<html>

<head>
    <title>Touride - Booking Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .summary-card {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .summary-label {
            font-weight: 500;
            color: #6c757d;
        }

        .summary-value {
            font-size: 1.1rem;
        }

        .modal-content {
            border-radius: 20px;
        }

        .star-rating {
            direction: rtl;
            display: inline-block;
            cursor: pointer;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #ddd;
            font-size: 24px;
            padding: 0 2px;
            cursor: pointer;
            transition: all 0.2s ease;
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
    </style>
    @if (!$review['rating'])
        <style>
            .star-rating label:hover,
            .star-rating label:hover~label,
            .star-rating input:checked~label {
                color: #ffc107;
            }
        </style>
    @else
        <style>
            .star-rating input:checked~label {
                color: #ffc107;
            }
        </style>
    @endif
</head>

<body>

    <div class="container">
        <a href="javascript:history.back()" class="d-block mt-4 text-decoration-none text-secondary">&larr; Back</a>
        <form method="post" action="{{ route('user.history.review', ['id' => $booking->id]) }}" method="POST">
            @csrf

            <div class="summary-card">
                <h2 class="mb-4">Booking Summary #BK-{{ $booking->booking_id }}</h2>
                <div class="row mb-4">
                    <div class="col">
                        <div class="fs-4">Car Info</div>
                        <div class="mb-2">
                            <div class="summary-label">Name</div>
                            <div class="summary-value">{{ $booking->car->name }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Period</div>
                            <div class="summary-value">{{ $booking->period }} Day(s)</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">PickUp</div>
                            <div class="summary-value">{{ date('d M Y, H:i', strtotime($booking->pickup_date)) }} -
                                {{ $booking->pickup_location }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Return</div>
                            <div class="summary-value">{{ date('d M Y, H:i', strtotime($booking->return_date)) }} -
                                {{ $booking->dropoff_location }}</div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="fs-4">Pricing Summary</div>

                        <div class="mb-2">
                            <div class="summary-label">Base Price</div>
                            <div class="summary-value">Rp.{{ number_format($booking->calculated_price) }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Insurance</div>
                            <div class="summary-value">Rp.{{ number_format($booking->car->insurance) }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Service Fee</div>
                            <div class="summary-value">Rp.{{ number_format($booking->car->service_fee) }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Total</div>
                            <div class="summary-value">
                                Rp.{{ number_format($booking->calculated_price + $booking->car->insurance + $booking->car->service_fee) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="fs-4">Renter Info</div>

                        <div class="mb-2">
                            <div class="summary-label">Customer</div>
                            <div class="summary-value">Antoni</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Phone</div>
                            <div class="summary-value">08123123</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Email</div>
                            <div class="summary-value">Antoni@g</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="fs-4">Payment Method</div>

                        <div class="mb-2">
                            <div class="summary-label">Bank Name</div>
                            <div class="summary-value">{{ $booking->payment->payment_method->bank_name ?? '-' }}</div>
                        </div>
                    </div>
                </div>
                @if ($can_rating)
                    <div class="row mt-2 mb-2">
                        <div class="col-12">
                            <div class="rating-card">
                                <div class="fs-4 mb-2">Rating</div>
                                <div class="star-rating animated-stars">
                                    <input type="radio" id="star5" name="rating" value="5"
                                        {{ $review['rating'] == 5 ? 'checked' : '' }}
                                        {{ $review['rating'] ? 'disabled' : '' }}>
                                    <label for="star5" class="fa-solid fa-star"></label>
                                    <input type="radio" id="star4" name="rating" value="4"
                                        {{ $review['rating'] == 4 ? 'checked' : '' }}
                                        {{ $review['rating'] ? 'disabled' : '' }}>
                                    <label for="star4" class="fa-solid fa-star"></label>
                                    <input type="radio" id="star3" name="rating" value="3"
                                        {{ $review['rating'] == 3 ? 'checked' : '' }}
                                        {{ $review['rating'] ? 'disabled' : '' }}>
                                    <label for="star3" class="fa-solid fa-star"></label>
                                    <input type="radio" id="star2" name="rating" value="2"
                                        {{ $review['rating'] == 2 ? 'checked' : '' }}
                                        {{ $review['rating'] ? 'disabled' : '' }}>
                                    <label for="star2" class="fa-solid fa-star"></label>
                                    <input type="radio" id="star1" name="rating" value="1"
                                        {{ $review['rating'] == 1 ? 'checked' : '' }}
                                        {{ $review['rating'] ? 'disabled' : '' }}>
                                    <label for="star1" class="fa-solid fa-star"></label>
                                </div>
                                @if (!$review)
                                    <p class="text-muted mt-2">Click to rate</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if (!$review['rating'] && empty($review['description']))
                            <div class="col-12">
                                <div class="fs-4">Review</div>
                                <div class="mb-2">
                                    <textarea class="form-control" name="description" id="" cols="30" rows="10"
                                        placeholder="What's your thought about our services..." {{ $review['rating'] ? 'disabled' : '' }}>{{ $review['description'] }}</textarea>
                                </div>
                            </div>
                        @else
                            <div class="blog-comment mt-4">
                                <h3 class="text-success">Review</h3>
                                <hr />
                                <div class="all-comments">
                                    <ul class="comments">
                                        <li class="clearfix">
                                            <img src="https://bootdey.com/img/Content/user_1.jpg" class="avatar"
                                                alt="">
                                            <div class="post-comments">
                                                <p class="meta">
                                                    {{ date('m d, Y', strtotime($review->created_at)) }} <span
                                                        class="name">{{ $review->user->name }}</span> says : <i
                                                        class="pull-right"></i></p>
                                                <p>
                                                    {{ $review->description }}
                                                </p>
                                            </div>

                                            @if ($review->reply)
                                                <ul class="comments">
                                                    <li class="clearfix">
                                                        <img src="https://bootdey.com/img/Content/user_3.jpg"
                                                            class="avatar" alt="">
                                                        <div class="post-comments">
                                                            <p class="meta">
                                                                {{ date('m d, Y', strtotime($review->reply->created_at)) }}
                                                                <span class="name">Atmin</span>
                                                                says : <i class="pull-right"></i></p>
                                                            <p>
                                                                {{ $review->reply->description }}
                                                            </p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                <div class="text-end mt-4">
                    <a href="{{ route('user.history') }}" class="btn btn-outline-secondary">Back</a>
                    @if (!$review['rating'] && $can_rating)
                        <button type="submit" class="btn btn-success">Send Review</button>
                    @endif
                </div>
            </div>

        </form>
    </div>

    <!-- Modal Booking Confirmed -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="rounded-circle bg-success d-inline-flex align-items-center justify-content-center"
                            style="width: 80px; height: 80px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white"
                                class="bi bi-check-lg" viewBox="0 0 16 16">
                                <path
                                    d="M13.485 1.929a.75.75 0 0 1 1.06 1.06l-8 8a.75.75 0 0 1-1.06 0l-4-4a.75.75 0 0 1 1.06-1.06L6 9.439l7.485-7.51z" />
                            </svg>
                        </div>
                    </div>
                    <h4 class="fw-bold">Booking Confirmed!</h4>
                    <p class="text-muted mb-3">Your booking has been successfully submitted.</p>
                    <a href="{{ route('user.history') }}" class="btn btn-primary px-4">Go to Booking History</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @if (!$review['rating'])
        <script>
            document.querySelectorAll('.star-rating:not(.readonly) label').forEach(star => {
                star.addEventListener('click', function() {
                    this.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 200);
                });
            });
        </script>
    @endif

    <script src="https://kit.fontawesome.com/16d156c4be.js" crossorigin="anonymous"></script>
</body>

</html>
