<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <style>
            body {
                background-image: url('{{ asset('images/background auth.png') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-color: #ffffff; /* Fallback color */
            }

            #line {
                position: relative;
            }

            #line::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 35%;
                width: 20px;
                height: 2px;
                background-color: #A0A7AA;
            }

            #line::after {
                content: '';
                position: absolute;
                top: 50%;
                right: 35%;
                width: 20px;
                height: 2px;
                background-color: #A0A7AA;
            }

            @media screen and (max-width: 1200px) {
                .bg-background {
                    width: 80% !important;
                    right: 2rem !important;
                    left: 2rem;
                    transform: translate(1rem, 0) !important;
                }
            }
        </style>
        <link href='https://cdn.boxicons.com/fonts/transformations.min.css' rel='stylesheet'>
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="absolute bg-background flex gap-6 p-6 md:p-10" style="width: 40%;top: 10rem; right: 10rem;border: 5px solid #307B75;border-radius: 30px;background-color: #fefefe">
            <div class=" flex w-full flex-col gap-2">
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
